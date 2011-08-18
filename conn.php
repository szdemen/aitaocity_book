<?php
 $conn=mysql_connect("localhost","root","") or die("无法连接服务器！");
 mysql_select_db("love_atc",$conn) or die("无法连接数据库！") ;
 
 mysql_query("SET NAMES 'utf8'");
 
 /* 过滤所有GET过来变量 */
foreach ($_GET as $get_key=>$get_var)
{
if (is_numeric($get_var)) {
   $get[strtolower($get_key)] = get_int($get_var);
} else {
   $get[strtolower($get_key)] = get_str($get_var);
}
}

/* 过滤函数 */
//整型过滤函数
function get_int($number)
{
     return intval($number);
}
//字符串型过滤函数
function get_str($string)
{
     if (!get_magic_quotes_gpc()) {
return addslashes($string);
     }
     return $string;
}
//session_start(); 
?>