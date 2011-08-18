<?php 

include_once('conn.php');

include_once('login_check.php');

include_once('class/db.class.php');		//引入数据库操作类

//实例化数据库对象
$db	=	new	db();


	//默认显示下载列表
	if(empty($_GET['action'])){

		$cpage_html	=	'';
		$list	=	$db->find_sql(" SELECT a.*,b.name FROM hw_download as a LEFT JOIN hw_down_cate as b ON a.cate_id = b.cate_id WHERE 1=1 order by d_order DESC, cate_id ASC  ", 20,'download.php',$cpage_html);

		include("Tpl/downloadList.php");
	}




	//添加下载
	if($_GET['action']=='add'){

		$cate	 =	$db->find("hw_down_cate","1=1");

		include("Tpl/downloadAdd.php");
	}



	if($_GET['action']=='doAdd'){

		if(empty($_POST['d_name']) || empty($_POST['d_url']) || empty($_POST['d_size'])){
			echo "<script type='text/javascript' >alert('标题, 连接地址, 软件体积均不能为空!'); history.go(-1)</script>";
			die();
		}

		$data	 =	array(
				'd_name'	=>	 $_POST['d_name'],
				'd_desc'	=>	 $_POST['d_desc'],
				'd_url'		=>	 $_POST['d_url'],
				'd_size'		=>	 $_POST['d_size'],
				'cate_id'		=>	 $_POST['cate_id'],
				'd_order'		=>	 $_POST['d_order'],
				'd_tag'		=>	 $_POST['d_tag'],
				'datetime'		=>	 $_POST['datetime'],
				'state'	=>	 '1',	//默认显示
			);

		//var_dump($data);
		//添加
		$result	=	$db->insert('hw_download', $data);

		if($result){
			echo "<script type='text/javascript' >alert('增加成功!'); location.href='download.php'</script>";
			die();
		}else{
			echo "<script type='text/javascript' >alert('error: 系统忙, 请重试!'); history.go(-1)</script>";
			die();
		}

	}









	//编辑下载
	if($_GET['action']=='edit'){

		$cate	 =	$db->find("hw_down_cate","1=1");

		$down	=	$db->find_one('hw_download', " d_id =  ".$_GET['d_id']);
		include("Tpl/downloadEdit.php");
	}


	if($_GET['action']=='doEdit'){

		if(empty($_POST['d_name']) || empty($_POST['d_url']) || empty($_POST['d_size'])){
			echo "<script type='text/javascript' >alert('标题, 连接地址, 软件体积均不能为空!'); history.go(-1)</script>";
			die();
		}

		$data	 =	array(
				'd_name'	=>	 $_POST['d_name'],
				'd_desc'	=>	 $_POST['d_desc'],
				'd_url'		=>	 $_POST['d_url'],
				'd_size'		=>	 $_POST['d_size'],
				'cate_id'		=>	 $_POST['cate_id'],
				'd_order'		=>	 $_POST['d_order'],
				'd_tag'		=>	 $_POST['d_tag'],
				'datetime'		=>	 $_POST['datetime'],
				'state'	=>	 $_POST['state'],	
			);

		$where	=	" d_id = ".$_POST['d_id'];

		$result	=	$db->update('hw_download', $data, $where);

		if($result){
			echo "<script type='text/javascript' >alert('更新成功!'); location.href='download.php'</script>";
			die();
		}else{
			echo "<script type='text/javascript' >alert('error: 系统忙, 请重试!'); history.go(-1)</script>";
			die();
		}
	}














	//删除
	if($_GET['action']=='del'){

		if(empty($_GET['d_id']) || !is_numeric($_GET['d_id'])){
			echo "<script type='text/javascript' >alert('参数错误!'); history.go(-1)</script>";
			die();
		}

		$where	=	"d_id = ".$_GET['d_id'];

		//删除处理
		$result	=	$db->del('hw_download', $where);

		if($result){
			echo "<script type='text/javascript' >alert('删除成功!'); location.href='download.php'</script>";
			die();
		}else{
			echo "<script type='text/javascript' >alert('error: 系统忙, 请重试!'); history.go(-1)</script>";
			die();
		}
	}


	//---------------------------------------------------------

	//分类列表
	if($_GET['action']=='cateList'){

		$cpage_html	=	'';
		$list	=	$db->find("hw_down_cate",'1=1',20,'download.php?action=cateList',$cpage_html);

		include("Tpl/download_cate_list.php");
	}


	//添加分类
	if($_GET['action']=='addCate'){

		include("Tpl/cate_add.php");
	}



	if($_GET['action']=='doAddCate'){

		if(empty($_POST['name']) ){
			echo "<script type='text/javascript' >alert('分类名称不能为空!'); history.go(-1)</script>";
			die();
		}

		$data	 =	array(
				'name'	=>	 $_POST['name'],
				'c_order'	=>	 $_POST['c_order'],
				'state'	=>	 '1',	//默认显示
			);

		//var_dump($data);
		//添加
		$result	=	$db->insert('hw_down_cate', $data);

		if($result){
			echo "<script type='text/javascript' >alert('增加成功!'); location.href='download.php?action=cateList'</script>";
			die();
		}else{
			echo "<script type='text/javascript' >alert('error: 系统忙, 请重试!'); history.go(-1)</script>";
			die();
		}

	}








	//编辑分类
	if($_GET['action']=='editCate'){

		$cate	=	$db->find_one('hw_down_cate', " cate_id =  ".$_GET['cate_id']);
		include("Tpl/cate_edit.php");
	}


	if($_GET['action']=='doEditCate'){

		if(empty($_POST['name']) ){
			echo "<script type='text/javascript' >alert('分类名称不能为空!'); history.go(-1)</script>";
			die();
		}

		$data	 =	array(
				'name'	=>	 $_POST['name'],
				'c_order'	=>	 $_POST['c_order'],
				'state'	=>	 $_POST['state'],
			);

		$where	=	" cate_id = ".$_POST['cate_id'];

		$result	=	$db->update('hw_down_cate', $data, $where);

		if($result){
			echo "<script type='text/javascript' >alert('更新成功!'); location.href='download.php?action=cateList'</script>";
			die();
		}else{
			echo "<script type='text/javascript' >alert('error: 系统忙, 请重试!'); history.go(-1)</script>";
			die();
		}
	}




	//删除
	if($_GET['action']=='delCate'){

		if(empty($_GET['cate_id']) || !is_numeric($_GET['cate_id'])){
			echo "<script type='text/javascript' >alert('参数错误!'); history.go(-1)</script>";
			die();
		}

		$where	=	"cate_id = ".$_GET['cate_id'];

		//删除处理
		$result	=	$db->del('hw_down_cate', $where);

		if($result){
			echo "<script type='text/javascript' >alert('删除成功!'); location.href='download.php?action=cateList'</script>";
			die();
		}else{
			echo "<script type='text/javascript' >alert('error: 系统忙, 请重试!'); history.go(-1)</script>";
			die();
		}
	}




?>