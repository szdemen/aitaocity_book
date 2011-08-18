<?php 

include_once('conn.php');

include_once('login_check.php');

include_once('class/db.class.php');		//引入数据库操作类


//实例化数据库对象
$db	=	new	db();

//公共条目数变量  $total_record_num
//global $cpage_html;	//输出换页html代码


	//默认主页
	if(empty($_GET['action'])){
		include("Tpl/indexpicList.php");
	}



	//处理图片过程
	if($_GET['action']=='doAdd'){
		

		//检查及上传处理
		if (empty($_FILES['pic_url']['type'])){//判断无文件上传
			echo "<script language='javascript'>alert('请至少上传一张图片!');window.history.go(-1);</script>";
			exit();
		}

		
		//设定图片保存路径
		$folder_upload="../upload/";
		

		//非空的地址就保存
		if ($_FILES['pic_url']['type'] != ""){
			
				//文件改名
				$file_id = 'main_image';
				$upfile = $file_id.".jpg";

				//移动复制文件
				$result	=	move_uploaded_file($_FILES['pic_url']['tmp_name'],$folder_upload.$upfile);

		}//文件类型判定非空end



		if($result){
			echo "<script type='text/javascript' >alert('替换成功!'); location.href='index_pic.php'</script>";
			die();
		}else{
			echo "<script type='text/javascript' >alert('error: 系统忙, 请重试!'); history.go(-1)</script>";
			die();
		}

	}



?>