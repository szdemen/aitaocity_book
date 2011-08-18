

<?php 
include_once('conn.php');
//include_once('login_check.php');

//加密解密函数
include_once("function/encode_inc.php");

//实例化对象
include_once('class/db.class.php');		//引入数据库操作类
$db	=	new	db();

//------------------------------------------------------------



//检索, 默认页面
if( empty($_REQUEST['action'])){
		
		include_once('templeta/searchForm.php');	

}//检索




//显示搜索结果
if($_REQUEST['action']=='doSearch'){
	
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

		include("templeta/searchList.php");
}

//非空提交检测
function noEmptyCk($id,$tips){
	if(empty($_REQUEST[$id])){
		echo "<script>alert('$tips');history.go(-1);</script>";	
		die();
	}
}
?>
