<?php 

include_once('conn.php');

include_once('login_check.php');

include_once('class/db.class.php');		//�������ݿ������


//ʵ�������ݿ����
$db	=	new	db();

//������Ŀ������  $total_record_num
//global $cpage_html;	//�����ҳhtml����


	//Ĭ����ҳ
	if(empty($_GET['action'])){
		include("Tpl/indexpicList.php");
	}



	//����ͼƬ����
	if($_GET['action']=='doAdd'){
		

		//��鼰�ϴ�����
		if (empty($_FILES['pic_url']['type'])){//�ж����ļ��ϴ�
			echo "<script language='javascript'>alert('�������ϴ�һ��ͼƬ!');window.history.go(-1);</script>";
			exit();
		}

		
		//�趨ͼƬ����·��
		$folder_upload="../upload/";
		

		//�ǿյĵ�ַ�ͱ���
		if ($_FILES['pic_url']['type'] != ""){
			
				//�ļ�����
				$file_id = 'main_image';
				$upfile = $file_id.".jpg";

				//�ƶ������ļ�
				$result	=	move_uploaded_file($_FILES['pic_url']['tmp_name'],$folder_upload.$upfile);

		}//�ļ������ж��ǿ�end



		if($result){
			echo "<script type='text/javascript' >alert('�滻�ɹ�!'); location.href='index_pic.php'</script>";
			die();
		}else{
			echo "<script type='text/javascript' >alert('error: ϵͳæ, ������!'); history.go(-1)</script>";
			die();
		}

	}



?>