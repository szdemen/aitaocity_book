<!DOCTYPE HTML>
<html>
<head>
<title>爱淘城公益捐书活动 - 让爱放飞梦想</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="爱淘城电子商务有限公司特别开展爱心捐书活动，并发出倡议，让你的爱心为贫困地区的孩子们带去另一片天空！" />
<meta name="keywords" content="让爱放飞梦想——爱淘城公益捐书活动_捐书公益_新浪博客,捐书公益,捐书,公益,小学生,爱淘城,教育" />
<link rel="stylesheet" href="css/global_style.css" />
</head>
<body>



<?php 
include_once('conn.php');
//include_once('login_check.php');

//加密解密函数
include_once("function/encode_inc.php");

//实例化对象
include_once('class/db.class.php');		//引入数据库操作类
$db	=	new	db();





//用户注册
if($_REQUEST['action']=='reg'){

	//email检测
	if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $_POST['email']))
	{
		echo "<script>alert('请输入正确的email格式');history.go(-1);</script>";	
		die();
	}
	
	//重名检测
	if(!empty($_POST['user_name']) && !empty($_POST['email'])){
		$result	=	$db->find_one('user',"`email` = '".$_POST['email']."'");
		
		if(!empty($result)){//重名
			echo "<script>alert('您注册的email已经存在了，请更换一个试试看');history.go(-1);</script>";	
			die();
		}
		
		if(empty($_POST['pw'])){ //密码
			echo "<script>alert('请输入您的登录密码');history.go(-1);</script>";
			die();
		}else{
			if($_POST['pw'] != $_POST['pw2']){
				echo "<script>alert('您两次输入的密码不相符，请再次尝试');history.go(-1);</script>";
				die();
			}
		}
		echo "注册进行中...";
		
		//插入记录
		$data	=	array(
							'name'=>trim($_POST['user_name']),
							'phone'=>trim($_POST['phone']),
							'email'=>trim($_POST['email']),
							'pw'=>md5($_POST['pw']),
							'add_time'=>date("Y-m-d H:i:s")
							);
		
		$result	=	$db->insert('user',$data);
		if(!$result){
				echo "<script>alert('后台忙碌，请再次尝试');history.go(-1);</script>";
				die();
		}
		//同时登录
		$uid	=	mysql_insert_id();
		SetCookie("user_id",  authcode($uid,'ENCODE') , time()+604800);//有效期1 week
		SetCookie("security",  authcode('this is for aitaocity','ENCODE') , time()+604800);//安全鉴别码有效期1 week
		SetCookie("name", $_POST['user_name'] );//有效期1 week
		
		echo "<script>alert('多谢注册，现在跳转到首页');location.href='index.php';</script>";
		die();
		
	}else{//留空
		echo "<script>alert('请输入您的注册email'); history.go(-1);</script>";	
		die();
	}
	
}//reg


//-----------------------查看
if($_REQUEST['action']=='viewEdit'){

	//login check
	makeGetout($login);
	
	//接收当前已登录的id
	$user_id	=	authcode($_COOKIE['user_id']);	//这句话比内置的获取uid还要先执行了
	
	$user	=	$db->find_one('user'," uid ='".$user_id."' ");
	
	//加载模版
	include_once('templeta/user_view.php');
	
}


//-----------------------编辑
if($_REQUEST['action']=='doEdit'){

	//login check
	makeGetout($login);

	//提示文本编码
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";

	//接收当前已登录的id
	$user_id	=	authcode($_COOKIE['user_id']);
	
	if(!$user_id){
		die('权限错误，请登陆再尝试');
	}
	
	noEmptyCk('uname','要写您的名称！');
	noEmptyCk('phone','也需要您的电话号码！');
	
	//密码有输入处理
	if(!empty($_POST['pw'])){
		if($_POST['pw']!=$_POST['pw2']){
			echo "<script>alert('两次密码不同');history.go(-1);</script>";	
			die();
		}
	}
	
	$new_pw	=	md5($_POST['pw']);
	
	//修改记录	
	if(!empty($_POST['pw'])){
		$data	=	array(
							'phone'=>$_POST['phone'],
							'name'=>$_POST['uname'],
							'passport'=>$new_pw,
							);
	}else{
		$data	=	array(
							'phone'=>$_POST['phone'],
							'name'=>$_POST['uname'],
							);
	}
	
	$result	=	$db->update('user',$data," uid = $user_id");
	if(!$result){
			echo "<script>alert('后台忙碌，请再次尝试');history.go(-1);</script>";
			die();
	}
	echo "<script>alert('个人信息修改成功，现在跳转回个人资料页面');location.href='/user.php?action=viewEdit';</script>";
	die();
	
	
}



//logout
if($_REQUEST['action']=='logout'){
	
	SetCookie("user_id",  ""); //清除
	SetCookie("security",  ""); //清除
	SetCookie("name",  ""); //清除
	
	echo "<script>alert('登出完成，现在跳转到首页');location.href='index.php';</script>";
	die();

}



//非空提交检测
function noEmptyCk($id,$tips){
	if(empty($_REQUEST[$id])){
		echo "<script>alert('$tips');history.go(-1);</script>";	
		die();
	}
}
?>
</body>
</html>