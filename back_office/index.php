<?php 


	//var_dump($_GET['action']);

	//登录
	if('login'==$_GET['action'] ){
		
		if(empty($_POST['name']) || empty($_POST['password'])){
			echo "<script type='text/javascript' >alert('请填写密码及登录名称!'); location.href='index.php'</script>";
			die();
		}

		
		//检测用户名和密码
		if( isUser($_POST['name'],$_POST['password']) ){
									
			//加密解密函数
			include_once("function/encode_inc.php");
			
			
			//登录成功
			SetCookie("admin",  authcode('admin_right_ok','ENCODE') , time()+21600);//有效期6小时
			
			//跳转到bo首页
			Header("Location:bo_index.php");
			
		}else{
			echo "<script type='text/javascript' >alert('passport or user name wrong!'); location.href='index.php'</script>";
			die();
		}
		
	}
	//登录end
	
	
	if('logout'==$_GET['action']){
		
		include_once("login_check.php");
		
		SetCookie("admin",  ""); //清除
		
		echo "<script type='text/javascript' >alert('logout done!');</script>";
		
		Header("Location:index.php");
		
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Back Office</title>

<link href="css/css_reset.css" rel="stylesheet" type="text/css" />
<link href="css/bo_global.css" rel="stylesheet" type="text/css" />



</head>

<body>


<div style="width:656px; height:296px; margin-top:120px; margin-left:auto; margin-right:auto; padding:100px 20px 20px;">


<fieldset style=" border:solid 1px #999; height:300px;"><legend style="margin-left:15px;">爱淘城书籍捐助系统登陆</legend>
<form action="index.php?action=login" method="post" style="padding-top:80px; text-align:center; font-size:20px; font-family:Arial, Helvetica, sans-serif;">


<p>登陆名<input name="name" type="text" style="width:250px; height:32px; border:solid 1px #CCC; padding:4px; -moz-border-radius: 5px;-khtml-border-radius: 5px;-webkit-border-radius: 5px;border-radius: 5px;vertical-align:middle;" /></p><br />
<p>&nbsp;密码&nbsp;&nbsp;<input name="password" type="password" style="width:250px; height:32px; border:solid 1px #CCC; padding:4px; -moz-border-radius: 5px;-khtml-border-radius: 5px;-webkit-border-radius: 5px;border-radius: 5px;vertical-align:middle;" /></p><br />

<input name="" type="submit" value="login"  style="width:77px; height:30px; border:none;"/><br />


</form>
</fieldset>
</div>



</body>
</html>
<?php

function isUser($name,$pw){
	$name	=	strtolower($name);
	$pw	=	strtolower(md5($pw));
	
	include_once('conn.php');
	include_once('class/db.class.php');	
	
	//实例化数据库对象
	$db	=	new	db();
	$result	=	$db->find_one('user', " name =  '".$name."' and pw = '".$pw."' and role = 2 and state = 1  ");
		
	if($result){
		return true;
	}else{
		return false;	
	}
}

?>