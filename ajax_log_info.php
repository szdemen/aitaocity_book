<?php
session_start();
//sid验证

noEmptyCk('sid','sid错误');

$now_sid	=	session_id();
if($_GET['sid']	!= $now_sid){
	echo 'sid error';	
	die();
}

//参数检查
noEmptyCk('com','com code error');
noEmptyCk('nu','nu code error');


echo curlGet("http://api.kuaidi100.com/apione?com=".$_GET['com']."&nu=".$_GET['nu']."&show=2");


//非空提交检测
function noEmptyCk($id,$tips){
	if(empty($_REQUEST[$id])){
		echo $tips;	
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
?>