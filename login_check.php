<?php 
	$login	=	0;
	$GLOBALS['user_id']	=	''; 
	//加密解密函数
	include_once($_SERVER['DOCUMENT_ROOT']."/function/encode_inc.php");


	//非空检测
	if(empty($_COOKIE['user_id']) || empty($_COOKIE['security'])){
		/*echo "<script type='text/javascript' >alert('请先登录!'); location.href='index.php'</script>";
		die();*/
	}else{
		//解密内容对照
		$pw	=	authcode($_COOKIE['security']);
		
				if($pw=="this is for aitaocity"){
					//nothing
					$login	=	1;
					$user_id	=	authcode($_COOKIE['user_id']);
					$GLOBALS['user_id']	=	$user_id;
					
					//--------debug output
					//echo '<span style=\'color:#fff\'>$user_id='.$user_id.' $GLOBALS='.$GLOBALS['user_id'].' login state = '.$login.'</span>' ;
				
				}else{
					echo "<script type='text/javascript' >alert('验证出错, 请重新登录!'); location.href='index.php'</script>";
					die();
				}
	}
	
	//echo $login;
	
	function makeGetout($login){
		if($login	==	0){ 
		 echo "<script>alert('您需要登录后才能继续');history.go(-1);</script>";
		 die();
		}
	}
?>