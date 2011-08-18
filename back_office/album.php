<?php 

include_once('conn.php');

include_once('login_check.php');

include_once('class/db.class.php');		//引入数据库操作类


//实例化数据库对象
$db	=	new	db();

//公共条目数变量  $total_record_num
//global $cpage_html;	//输出换页html代码


	//默认显示相册列表
	if(empty($_GET['action'])){

		$cpage_html	=	'';
		$list	=	$db->find('album', ' 1=1 order by id desc ',40,'album.php' ,$cpage_html);
		//var_dump ($cpage_html);

		include("Tpl/albumList.php");
	}



	//删除album
	if($_GET['action']=='del'){

		if(empty($_GET['id']) || !is_numeric($_GET['id'])){
			echo "<script type='text/javascript' >alert('参数错误!'); history.go(-1)</script>";
			die();
		}
		
		
		$pic_item	=	$db->find_one('album', " id =  ".$_GET['id']);
		if(!file_exists('../upload/'.$pic_item['url'])){
			echo "<script type='text/javascript' >alert('pic id not exist!'); history.go(-1)</script>";
			die();
		}
		
		
		//删除文件
		/*
		unlink('../upload/'.$pic_item['url']);
		unlink('../upload/thumb/'.$pic_item['url']);*/

		$where	=	"album_id = ".$_GET['id'];

		//删除处理
		$result	=	$db->del('pic', $where);
		
		$where	=	"id = ".$_GET['id'];
		$result	=	$db->del('album', $where);
		
		if($result){
			echo "<script type='text/javascript' >alert('pic del success!'); location.href='album.php'</script>";
			die();
		}else{
			echo "<script type='text/javascript' >alert('error: 系统忙, 请重试!'); history.go(-1)</script>";
			die();
		}
	}
	
	
	
	
	//编辑
	if($_GET['action']=='edit'){

		$item	=	$db->find_one('album', " id =  ".$_GET['id']);
		include("Tpl/albumEdit.php");
	}


	if($_GET['action']=='doEdit'){

		if(empty($_POST['title']) ){
			echo "<script type='text/javascript' >alert('标题不能为空!'); history.go(-1)</script>";
			die();
		}

		$data	 =	array(
			'name'		=>	 $_POST['title'],
		);

		$where	=	" id = ".$_POST['id'];

		$result	=	$db->update('album', $data, $where);

		if($result){
			echo "<script type='text/javascript' >alert('更新成功!'); location.href='album.php'</script>";
			die();
		}else{
			echo "<script type='text/javascript' >alert('error: 系统忙或出错, 请重试!'); history.go(-1)</script>";
			die();
		}
	}
	
	


?>