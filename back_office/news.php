<?php 

include_once('conn.php');

include_once('login_check.php');

include_once('class/db.class.php');		//引入数据库操作类


//实例化数据库对象
$db	=	new	db();

//公共条目数变量  $total_record_num
//global $cpage_html;	//输出换页html代码


	//默认显示新闻列表
	if(empty($_GET['action'])){

		$cpage_html	=	'';
		$list	=	$db->find('news', ' 1=1 order by id desc ',20,'news.php' ,$cpage_html);
		//var_dump ($cpage_html);

		include("Tpl/newsList.php");
	}




	//添加新闻
	if($_GET['action']=='add'){
		include("Tpl/newsAdd.php");
	}



	if($_GET['action']=='doAdd'){

		if(empty($_POST['title']) || empty($_POST['content']) || empty($_POST['datetime'])){
			echo "<script type='text/javascript' >alert('标题, 内容, 日期均不能为空!'); history.go(-1)</script>";
			die();
		}

		$data	 =	array(
				'title'	=>	 $_POST['title'],
				'content'	=>	 $_POST['content'],
				'date'	=>	 $_POST['datetime'],
				'state'	=>	 '1',	//默认显示
			);

		//添加
		$result	=	$db->insert('news', $data);

		if($result){
			echo "<script type='text/javascript' >alert('增加成功!'); location.href='news.php'</script>";
			die();
		}else{
			echo "<script type='text/javascript' >alert('error: 系统忙, 请重试!'); history.go(-1)</script>";
			die();
		}

	}









	//编辑新闻
	if($_GET['action']=='edit'){

		$news_item	=	$db->find_one('news', " id =  ".$_GET['id']);
		include("Tpl/newsEdit.php");
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














	//删除新闻
	if($_GET['action']=='del'){

		if(empty($_GET['id']) || !is_numeric($_GET['id'])){
			echo "<script type='text/javascript' >alert('参数错误!'); history.go(-1)</script>";
			die();
		}

		$where	=	"id = ".$_GET['id'];

		//删除处理
		$result	=	$db->del('news', $where);

		if($result){
			echo "<script type='text/javascript' >alert('删除成功!'); location.href='news.php'</script>";
			die();
		}else{
			echo "<script type='text/javascript' >alert('error: 系统忙, 请重试!'); history.go(-1)</script>";
			die();
		}
	}





?>