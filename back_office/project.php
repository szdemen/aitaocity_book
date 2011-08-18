<?php 
include_once('conn.php');

include_once('login_check.php');

include_once('class/db.class.php');		//引入数据库操作类

//-----------------------------------------------------------------------------------------------------


//实例化数据库对象
$db	=	new	db();



//默认显示项目列表
	if(empty($_GET['action'])){

		$cpage_html	=	'';
		$list	=	$db->find('project', ' 1=1 order by pid desc ',20,'project.php' ,$cpage_html);
		//var_dump ($cpage_html);

		include("Tpl/projectList.php");
	}



//编辑项目内容
	if($_GET['action']=='edit'){

		$project_item	=	$db->find_one('project', " pid =  ".$_GET['pid']);
		include("Tpl/projectEdit.php");
	}


	if($_GET['action']=='doEdit'){
		
		noEmptyCk("pid","项目ID错误");
		noEmptyCk("pname","项目名必须填写");
		noEmptyCk("cname","联系人必须填写");
		noEmptyCk("contact","联系方式必须填写");
		noEmptyCk("address","地址必须填写");
		
		noEmptyCk("description","项目内容必须填写");
		
		if(empty($_POST['istop'])){
				$istop	=	0;
		}else{
				$istop	=	1;
		}

		$data	 =	array(
							'pname'=>trim($_POST['pname']),
							'img_url'=>trim($_POST['img_url']),
							'description'=>addslashes($_POST['description']),
							'need'=>addslashes($_POST['need']),
							'result'=>addslashes($_POST['result']),
							'cname'=>trim($_POST['cname']),
							'contact'=>trim($_POST['contact']),
							'address'=>trim($_POST['address']),
							'state'=>trim($_POST['state']),
							'istop'=>trim($_POST['istop'])
		);

		$where	=	" pid = ".$_POST['pid'];
		
		//dump($data);
		$result	=	$db->update('project', $data, $where);

		if($result){
			echo "<script type='text/javascript' >alert('更新成功!'); location.href='project.php?pid=".$_POST["pid"]."&action=edit'</script>";
			die();
		}else{
			echo "<script type='text/javascript' >alert('error: 系统忙或出错, 请重试!'); history.go(-1)</script>";
			die();
		}
	}

	

//搜索处理
if($_GET['action']=='search'){
		if(empty($_GET['pname']) &&	empty($_GET['cname'])	&& empty($_GET['contact'])){
				echo "<script>alert('请填写搜索条件');history.go(-1);</script>";	
				die();
		}
		$sql	=	" 1=1 ";
		
		if(!empty($_GET['pname'])){
				$sql	.=	" and pname like '%".$_GET['pname']."%' ";
		}
		
		if(!empty($_GET['cname'])){
				$sql	.=	" and cname like '%".$_GET['cname']."%' ";
		}
		
		if(!empty($_GET['contact'])){
				$sql	.=	" and contact like '%".$_GET['contact']."%' ";
		}
		
		
		$cpage_html	=	'';
		$list	=	$db->find('project', $sql.' order by pid desc ',40,'project.php?action=search' ,$cpage_html);

		include("Tpl/projectList.php");
}






//-----------------------------------------------------------------------------------------------

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
