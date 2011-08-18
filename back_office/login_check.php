<?php 

	//加密解密函数
	include_once("function/encode_inc.php");


	//非空检测
	if(empty($_COOKIE['admin'])){
		echo "<script type='text/javascript' >alert('请先登录!'); location.href='index.php'</script>";
		die();
	}
	
	//解密内容对照
	$pw	=	authcode($_COOKIE['admin']);

	if($pw=="admin_right_ok"){
		//nothing
	}else{
		echo "<script type='text/javascript' >alert('验证出错, 请重新登录!'); location.href='index.php'</script>";
		die();
	}

?>