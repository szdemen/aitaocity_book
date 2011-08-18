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
		$book_list	=	$db->find('book', " cid = '".$_GET['id']."' order by cid desc ",200,'donate.php' ,$cpage_html);
		include("Tpl/donateEdit.php");
	}


	if($_GET['action']=='doEdit'){

		if(empty($_POST['title']) || empty($_POST['content']) || empty($_POST['datetime'])){
			echo "<script type='text/javascript' >alert('标题, 内容, 日期均不能为空!'); history.go(-1)</script>";
			die();
		}

		$data	 =	array(
			'title'		=>	 $_POST['title'],
			'content'		=>	 $_POST['content'],
			'date'		=>	 $_POST['datetime'],
			'state'	=>	 $_POST['state'],
		);

		$where	=	" id = ".$_POST['id'];

		$result	=	$db->update('news', $data, $where);

		if($result){
			echo "<script type='text/javascript' >alert('更新成功!'); location.href='news.php'</script>";
			die();
		}else{
			echo "<script type='text/javascript' >alert('error: 系统忙或出错, 请重试!'); history.go(-1)</script>";
			die();
		}
	}

//添加批量图书
if($_GET['action']=='addBatchbook'){
	
	noEmptyCk("cid","没有相关的cid号码");
	
	if(!empty($_POST["bookbatch"])){
	
	echo "输入数据<br>";
	echo nl2br($_POST["bookbatch"]);

	$isbn_list	=	explode("\r\n",  trim($_POST["bookbatch"]));
	//var_dump($books);
	
	echo "<hr>";
	
	//使用逗号分开isbn和数量
	$books_temp	=	array();
	foreach($isbn_list as $key => $value){
		if(strpos($value,',',0)){	//检测是否含有逗号, 以免单独输入
			$books_temp[$key]	=	array_slice(explode(',',$value),0,2);	//逗号拆开字符串, 取出前2个元素
		}else{
			//非正确输入
		}
	}
	echo "<hr>";
	echo "输入数据分割后数组内容:";
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
	if(!empty($books_temp))
	
	foreach($books_temp as $bkey => $bvalue){
		if( !empty($bvalue[0])){	//isbn判定非空进入获取
		
			try{
				$xml_text	=	curlGet($douban_isbnurl.trim($bvalue[0]).$douban_apikey);
				$xml = simplexml_load_string($xml_text);
				
				if('bad isbn'	!=	$xml_text){	//判定是否有效的ISBN
					 $insert_data	=	array(
							'isbn'		=>	 trim($bvalue[0]),
							'bookname'		=>	 (string)$xml->title,
							'url'		=>	 (string)$xml->id,
							'add_time'			=>	date("Y-m-d H:i:s"),
							'state'		=>	 '1',
							'cid'		=>	 $_POST["cid"]
					 );
				}else{
					$insert_data	=	array(
							'isbn'		=>	 trim($bvalue[0]),
							'bookname'		=>	 'ISBN错误',
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
		sleep($time_douban);
	}

	echo "<hr>";
	echo "查询结果<br>";
	dump($insert_data);
	
	//echo $xml->title;
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
