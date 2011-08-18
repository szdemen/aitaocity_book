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
		//$list	=	$db->find('pic', ' 1=1 order by id desc ',40,'pic.php' ,$cpage_html);
		$list	=	$db->find('album', ' 1=1 order by id desc ',40,'pic.php' ,$cpage_html);
		//var_dump ($cpage_html);
		foreach($list as $key =>  $value){
			$album[$value['id']]	=	$db->find('pic', ' album_id = '.$value['id'].' order by id desc ',100,'pic.php' ,$cpage_html_pic);
		}
		//var_dump($album);
		include("Tpl/picList.php");
	}




	//添加pic
	if($_GET['action']=='add'){
		include("Tpl/picAdd.php");
	}


	//处理图片过程
	if($_GET['action']=='doAdd'){
		
		//=======================图片调整大小函数==================================
		function ImageResize($srcFile,$toW,$toH,$toFile="") //缩略图函数.
		{
		   if($toFile==""){ $toFile = $srcFile; }
		   $info = "";
		   $data = GetImageSize($srcFile,$info);
		   switch ($data[2]) 
		   {
			case 1:
			  if(!function_exists("imagecreatefromgif")){
			   echo "你的GD库不能使用GIF格式的图片，请使用Jpeg或PNG格式！<a href='javascript:go(-1);'>返回</a>";
			   exit();
			  }
			  $im = ImageCreateFromGIF($srcFile);
			  break;
			case 2:
			  if(!function_exists("imagecreatefromjpeg")){
			   echo "你的GD库不能使用jpeg格式的图片，请使用其它格式的图片！<a href='javascript:go(-1);'>返回</a>";
			   exit();
			  }
			  $im = ImageCreateFromJpeg($srcFile);    
			  break;
			case 3:
			  $im = ImageCreateFromPNG($srcFile);    
			  break;
		  }
		  $srcW=ImageSX($im);
		  $srcH=ImageSY($im);
		  $toWH=$toW/$toH;
		  $srcWH=$srcW/$srcH;
		  if($toWH<=$srcWH){
			   $ftoW=$toW;
			   $ftoH=$ftoW*($srcH/$srcW);
		  }
		  else{
			  $ftoH=$toH;
			  $ftoW=$ftoH*($srcW/$srcH);
		  }    
		  if($srcW>$toW||$srcH>$toH)
		  {
			 if(function_exists("imagecreatetruecolor")){
				@$ni = ImageCreateTrueColor($ftoW,$ftoH);
				if($ni) ImageCopyResampled($ni,$im,0,0,0,0,$ftoW,$ftoH,$srcW,$srcH);
				else{
				 $ni=ImageCreate($ftoW,$ftoH);
				  ImageCopyResized($ni,$im,0,0,0,0,$ftoW,$ftoH,$srcW,$srcH);
				}
			 }else{
				$ni=ImageCreate($ftoW,$ftoH);
				ImageCopyResized($ni,$im,0,0,0,0,$ftoW,$ftoH,$srcW,$srcH);
			 }
			if(function_exists('imagejpeg')) ImageJpeg($ni,$toFile,93);
			else ImagePNG($ni,$toFile);
			 ImageDestroy($ni);
		  }
		  ImageDestroy($im);
		}
	//=================================================================================
	
	
		//检查及上传处理
		if (empty($_FILES['pic_url']['type'][0])){//判断无文件上传
			echo "<script language='javascript'>alert('请至少上传一张图片!');window.history.go(-1);</script>";
			exit();
		}
		
		//空标题处理
		if (empty($_POST['title']) && empty($_POST['album_id'])){
			echo "<script language='javascript'>alert('必须填写相册名称!');window.history.go(-1);</script>";
			exit();
			//$_POST['title']	=	"";
		}
		
		//创建相册
		if(empty($_POST['album_id'])){
			
			//可以存在同名相册, id不同
			$data	 =	array(
							'name'	=>	 $_POST['title'],
						);

			//添加
			$result	=	$db->insert('album', $data);
			
			$album_id	=	$result;
		}else{
			$album_id	=	$_POST['album_id'];
			//已有标题的情况
			$title	=	$db->find_one('album', ' id = '.$_POST['album_id'].' limit 1 ',40,'pic.php' ,$cpage_html_temp);
			$_POST['title']	 =	$title['name'];
		}
		
		
		//设定图片保存路径
		$folder_upload="../upload/";
		
		//保存图片
		for ($i=0;$i<count($_FILES['pic_url']['tmp_name']);$i++) 
			{ 
				//非空的地址就保存
				if ($_FILES['pic_url']['type'][$i] != ""){
					
						//文件改名
						$file_id = substr(md5($_FILES["pic_url"]["tmp_name"][$i] + rand()*100000), 0, 16);
						$upfile = $file_id.".jpg";

						//移动复制文件
						$upload_ok	=	move_uploaded_file($_FILES['pic_url']['tmp_name'][$i],$folder_upload.$upfile);
						//echo $upload_ok;
						
						//生成缩略图
						ImageResize('../upload/'.$file_id.'.jpg','72','72',"../upload/thumb/".$file_id.'.jpg');
						
						$data	 =	array(
							'title'	=>	 $_POST['title'],
							'url'	=>	 $file_id.'.jpg',
							'album_id'	=>	$album_id,
							'add_time'	=> date("Y-m-d H:i:s")
						);

						//添加
						//var_dump($data);
						$result	=	$db->insert('pic', $data);

				}//文件类型判定非空end
			}
		//图片插入end for 循环end


		if($result){
			echo "<script type='text/javascript' >alert('增加成功!'); location.href='pic.php'</script>";
			die();
		}else{
			echo "<script type='text/javascript' >alert('error: 系统忙, 请重试!'); history.go(-1)</script>";
			die();
		}

	}








	//删除pic
	if($_GET['action']=='del'){

		if(empty($_GET['id']) || !is_numeric($_GET['id'])){
			echo "<script type='text/javascript' >alert('参数错误!'); history.go(-1)</script>";
			die();
		}
		
		
		$pic_item	=	$db->find_one('pic', " id =  ".$_GET['id']);
		if(!file_exists('../upload/'.$pic_item['url'])){
			echo "<script type='text/javascript' >alert('pic id not exist!'); history.go(-1)</script>";
			die();
		}
		
		//删除文件
		unlink('../upload/'.$pic_item['url']);
		unlink('../upload/thumb/'.$pic_item['url']);

		$where	=	"id = ".$_GET['id'];

		//删除处理
		$result	=	$db->del('pic', $where);
		
		if($result){
			echo "<script type='text/javascript' >alert('pic del success!'); location.href='pic.php'</script>";
			die();
		}else{
			echo "<script type='text/javascript' >alert('error: 系统忙, 请重试!'); history.go(-1)</script>";
			die();
		}
	}
	
	
	
	
	
	
	//修改缩略图,面板
	if($_GET['action']=='thumbremake'){
		include("Tpl/picResize.php");
	}


	//生成缩略图
	if($_GET['action']=='dothumbremake'){
		
		/*72*72*/
		if(empty($_POST['url']) || empty($_POST['x1']) || empty($_POST['y1']) || empty($_POST['w']) || empty($_POST['h'])){
			echo "<script type='text/javascript' >alert('partent not exist!'); history.go(-1)</script>";
			die();
		}
		
		//imagecreatetruecolor(72, 72);
		$pic_url	=	$_POST['url'];
		
		//生成缩略图
		$img_r = imagecreatefromjpeg("../upload/$pic_url");
		$dst_r = ImageCreateTrueColor( 72, 72 );
		$result	=	imagecopyresampled($dst_r,$img_r,0,0,$_POST['x1'],$_POST['y1'],72,72,$_POST['w'],$_POST['h']);
		imagejpeg($dst_r,"../upload/thumb/$pic_url",100);
		
		if($result){
			echo "<script type='text/javascript' >alert('remake success!'); location.href='pic.php'</script>";
		}else{
			echo "<script type='text/javascript' >alert('remake fail!'); history.go(-1)</script>";
			die();
		}
		
		
	}
?>