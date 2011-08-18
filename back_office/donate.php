<?php 
include_once('conn.php');

include_once('login_check.php');

include_once('class/db.class.php');		//引入数据库操作类

//-----------------------------------------------------------------------------------------------------


//实例化数据库对象
$db	=	new	db();



//默认显示捐赠列表
	if(empty($_GET['action'])){

		$cpage_html	=	'';
		$list	=	$db->find('contribution', ' 1=1 order by cid desc ',20,'donate.php' ,$cpage_html);
		//var_dump ($cpage_html);

		include("Tpl/donateList.php");
	}



//编辑捐赠
	if($_GET['action']=='edit'){

		$donate_item	=	$db->find_one('contribution', " cid =  ".$_GET['id']);
		
		//获取该单号所有书的数据
		$book_list	=	$db->find('book', " cid = '".$_GET['id']."' order by id desc ",200,'donate.php' ,$cpage_html);
		$book_all_num	=	$db->find_sql("select sum(quantity) as nu from book where  cid = ".$_GET['id'],10,'donate.php' ,$cpage_html_no);
		include("Tpl/donateEdit.php");
	}


	if($_GET['action']=='doEdit'){
		
		noEmptyCk("user_name","捐赠人必须填写");
		noEmptyCk("contact","联系方式必须填写");
		noEmptyCk("quantity","数量必须填写");
		noEmptyCk("weight","货物重量必须填写");
		noEmptyCk("logical_type","运输方式必须填写");
		noEmptyCk("address","发货地必须填写");
		noEmptyCk("logistics_ccode","物流公司必须填写");
		noEmptyCk("logistics_num","运单号必须填写");

		$data	 =	array(
			'cname'				=>	 trim($_POST['user_name']),
			'contact'			=>	 trim($_POST['contact']),
			'ctype'				=>	 $_POST['logical_type'],
			'address'			=>	 trim($_POST['address']),
			'quantity'			=>	 trim($_POST['quantity']),
			'weight'				=>	 trim($_POST['weight']),
			'cost'					=>	 trim($_POST['cost']),
			'pay_who'			=>	 trim($_POST['pay_who']),
			'quantity'			=>	 trim($_POST['quantity']),
			'memo'				=>	 addslashes($_POST['memo']),
			'description'					=>	 addslashes($_POST['desc']),
			'received_time'			=>	 trim($_POST['received_time']),
			'send_time'					=>	 trim($_POST['send_time']),
			'logistics_ccode'			=>	 trim($_POST['logistics_ccode']),
			'logistics_num'				=>	 trim($_POST['logistics_num']),
			'state'								=>	 trim($_POST['state']),
			'deal_state'					=>	 trim($_POST['deal_state'])
		);

		$where	=	" cid = ".$_POST['cid'];
		
		//dump($data);
		$result	=	$db->update('contribution', $data, $where);

		if($result){
			echo "<script type='text/javascript' >alert('更新成功!'); location.href='donate.php?id=".$_POST["cid"]."&action=edit'</script>";
			die();
		}else{
			echo "<script type='text/javascript' >alert('error: 系统忙或出错, 请重试!'); history.go(-1)</script>";
			die();
		}
	}

	
	
	
	
	
//添加单独的图书
if($_GET['action']=='addOnebook'){	
	
		noEmptyCk("cid","没有相关的cid号码");
	
		$insert_data	=	array(
			'isbn'		=>	 trim($_POST['isbn']),
			'bookname'		=>	trim($_POST['bookname']),
			'quantity'	=>	trim($_POST['quantity']),
			'add_time'			=>	date("Y-m-d H:i:s"),
			'state'		=>	 '1',
			'cid'		=>	 $_POST["cid"]
		);
		
		//插入数据库
		$result	=	$db->insert('book', $insert_data);
		if($result){
			echo "<script type='text/javascript' >alert('添加成功!');  location.href='donate.php?id=".$_POST["cid"]."&action=edit'</script>";
			//header("location:donate.php?id=".$_POST["cid"]);
		}else{
			echo "<script type='text/javascript' >alert('error: 系统忙或出错, 请重试!'); history.go(-1)</script>";
			die();
		}
}
	
	
	
	
	
	
//添加批量图书
if($_GET['action']=='addBatchbook'){
	
	noEmptyCk("cid","没有相关的cid号码");
	
	if(!empty($_POST["bookbatch"])){
	
	echo "输入数据<br>";	//显示用
	echo nl2br($_POST["bookbatch"]);

	$isbn_list	=	explode("\r\n",  trim($_POST["bookbatch"]));
	//var_dump($books);

	echo "<hr>";
	echo "输入数据分割后数组内容:";
	$books_temp	=	array();
	$books_temp	=	array_count_values($isbn_list);
	dump($books_temp);
	
	//豆瓣的api key
	$douban_apikey	=	'?apikey=02306805bd08ff6406913811371afe2c';
	//豆瓣的isbn查询api地址
	$douban_isbnurl	=	"http://api.douban.com/book/subject/isbn/";
	//豆瓣查询间隔限制
	$time_douban	=	2;	//查询时间间隔为2s,保险些
	
	//定义一个用于插入数据库用的数组
	$insert_data	=	array();
	
	set_time_limit(0);	//脚本超时限制解除
	//开始获取数据
	if(!empty($books_temp)){
	
	echo "<hr>";
	echo "查询结果<br>";
	
	foreach($books_temp as $bkey => $bvalue){
		if( !empty($bkey)){	//isbn判定非空进入获取
		
			try{
				$xml_text	=	curlGet($douban_isbnurl.trim($bkey).$douban_apikey);
				
				//判断是否xml文件
				if('<'	==	substr($xml_text,0,1)){
					$xml = simplexml_load_string($xml_text);
				}else{
					$xml	=	$xml_text;
				}
				
				if('bad isbn'	!=	$xml_text){	//判定是否有效的ISBN
					 $insert_data	=	array(
							'isbn'		=>	 trim($bkey),
							'bookname'		=>	 (string)$xml->title,
							'quantity'	=>	$bvalue,
							'url'		=>	 (string)$xml->id,
							'add_time'			=>	date("Y-m-d H:i:s"),
							'state'		=>	 '1',
							'cid'		=>	 $_POST["cid"]
					 );
				}else{
					$insert_data	=	array(
							'isbn'		=>	 trim($bkey),
							'bookname'		=>	 'ISBN错误',
							'quantity'	=>	$bvalue,
							'url'		=>	 'N/A',
							'add_time'			=>	date("Y-m-d H:i:s"),
							'state'		=>	 '0',
							'cid'		=>	 $_POST["cid"]
					 );
				}//判定是否有效的ISBN
				
				//插入数据库
				$result	=	$db->insert('book', $insert_data);
				 
			}
			catch (Exception $ex){ //抛出错误
				 echo $ex->getTraceAsString();
			}
		}else{
			//空的isbn不需处理
		}
		dump($insert_data);
		sleep($time_douban);
	}
	}//空数据判定
	
	//echo $xml->title;
	}
	echo "<a href='#' onclick='location.href='donate.php?id=".$_POST["cid"]."&action=edit''>返回</a>";
}


//搜索处理
if($_GET['action']=='search'){
		if(empty($_GET['user_name']) &&	empty($_GET['contact'])	&&	empty($_GET['address'])	&&	empty($_GET['nu'])){
				echo "<script>alert('请填写搜索条件');history.go(-1);</script>";	
				die();
		}
		$sql	=	" 1=1 ";
		
		if(!empty($_GET['user_name'])){
				$sql	.=	" and cname like '%".$_GET['user_name']."%' ";
		}
		
		if(!empty($_GET['contact'])){
				$sql	.=	" and contact like '%".$_GET['contact']."%' ";
		}
		
		if(!empty($_GET['address'])){
				$sql	.=	" and address like '%".$_GET['address']."%' ";
		}
		
		if(!empty($_GET['nu'])){
				$sql	.=	" and logistics_num like '%".$_GET['nu']."%' ";
		}		
		
		$cpage_html	=	'';
		$list	=	$db->find('contribution', $sql.' order by cid desc ',40,'donate.php?action=search' ,$cpage_html);

		include("Tpl/donateList.php");
}



//单独书籍编辑
if($_GET['action']=='bookedit'){

		if(empty($_GET['id'])){
				echo "book id error";	
				die();
		}
		$book	=	$db->find_one('book', " id =  ".$_GET['id']);
		include("Tpl/bookEdit.php");
}

if($_REQUEST['action']=='doBookedit'){
		if(empty($_REQUEST['id'])){
				echo "book id error";	
				die();
		}

		$data	=	array(
				'isbn'	=>	$_POST['isbn'],
				'bookname'	=>	$_POST['bookname'],
				'quantity'	=>	$_POST['quantity'],
		);

		$where	=	" id = ".$_POST['id'];

		$result	=	$db->update('book', $data, $where);
		if($result){
			echo "更新成功<script>setTimeout('',1000); top.window.location.reload();</script>";
			die();
		}else{
			echo "error: 系统忙或出错, 请重试!";
			die();
		}
}





//非空提交检测
function noEmptyCk($id,$tips){
	if(empty($_REQUEST[$id])){
		echo "<script>alert('$tips');history.go(-1);</script>";	
		die();
	}
}


function curlGet($url){ 
	$curl = curl_init(); 
	curl_setopt($curl, CURLOPT_URL, $url); 
	curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; )'); 
	curl_setopt($curl, CURLOPT_HEADER, 0); 
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($curl, CURLOPT_COOKIE, 'domain=www.aitaocity.com'); 
	$tmpInfo = curl_exec($curl); 
	curl_close($curl); 
	return $tmpInfo; 
} 


function dump($vars, $label = '', $return = false)
{
    if (ini_get('html_errors')) {
        $content = "<pre>\n";
        if ($label != '') {
            $content .= "<strong>{$label} :</strong>\n";
        }
        $content .= htmlspecialchars(print_r($vars, true));
        $content .= "\n</pre>\n";
    } else {
        $content = $label . " :\n" . print_r($vars, true);
    }
    if ($return) { return $content; }
    echo $content;
    return null;
}

?>
