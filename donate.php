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

//-----------------------------------------------------------------------------------------------------



//添加捐赠
if($_REQUEST['action']=='add_donate'){

	//空输入检测
	if(!empty($_POST['user_name']) || !empty($_POST['contact'])   || !empty($_POST['quantity'])	|| !empty($_POST['weight'])	 || !empty($_POST['logical_type'])	|| !empty($_POST['address'])	|| !empty($_POST['com_code'])		|| !empty($_POST['nu'])){
				
		echo "数据处理中中...";
		
		if(!is_numeric($_POST['donate_type'])){
				echo "<script>alert('请勿输入异常数据');history.go(-1);</script>";
				die();
		}
		
		//pid 项目id处理
		if(!is_numeric($_POST['skuname'])){
				//为数字为项目pid
				
		}
		
		//uid处理, 可以默认不登录即可发布捐赠
		if(empty($_COOKIE['user_id'])){
			$uid	=	0;
		}else{
			$uid	=	$_COOKIE['user_id'];
		}
		
		//直接发到学校处理
		if(2==$_POST['logical_type']){
				if(empty($_POST['skuname'])){
						echo "<script>alert('请输入学校/项目名称');history.go(-1);</script>";
						die();
				}
		}else{
				//总部中转
				$_POST['skuname']	=	"";
		}
		
		//默认显示已写订单的捐赠
		$state	=	1;	
		
		//插入记录
		$data	=	array(
							'cname'=>trim($_POST['user_name']),
							'thing_type'=>trim($_POST['donate_type']),
							'address'=>trim($_POST['address']),
							'contact'=>trim($_POST['contact']),
							'quantity'=>$_POST['quantity'],
							'uid'=>$uid,
							
							'weight'=>trim($_POST['weight']),
							'ctype'=>trim($_POST['logical_type']),
							'pid'=>$_POST['skuname'],
							'thing_type'=>trim($_POST['donate_type']),
							'logistics_ccode'=>trim($_POST['com_code']),
							'logistics_num'=>trim($_POST['nu']),
							'memo'=>addslashes(nl2br($_POST['memo'])),
							
							'add_time'=>date("Y-m-d H:i:s")
							);
		
		$result	=	$db->insert('contribution',$data);
		if(!$result){
				echo "<script>alert('服务器忙碌，请再次尝试');history.go(-1);</script>";
				die();
		}
		
		echo "<script>alert('感谢您的爱心，现在跳转到首页');location.href='index.php';</script>";
		die();
		
	}else{//检测到有项目是空的
		echo "<script>alert('为了更好地跟进您的捐助详情, 请填写所有项目'); history.go(-1);</script>";	
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