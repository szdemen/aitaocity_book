<?php

//global $cpage_html;	//�����ҳhtml����


class db
{
	/*
	*��ȡ����
	*
	*����
	*table
	*sql
	*ÿҳ��¼����
	*��תurl
	*/
	function find($table, $sql, $num_perpage=10, $url="?", &$cpage_html){


		//_______________________________��ҳ��������ͳ��_________________________________________
		if(!empty($table)){
				$sql_now = "select * from $table WHERE ".$sql   ;//���ɲ�ѯ��¼����SQL���
		}else{
				$sql_now = $sql   ;//���ɲ�ѯ��¼����SQL���
		}
			
		
		$rs = mysql_query($sql_now) or die("�޷�ִ��SQL��䣺$sql_now "); //��ѯ��¼��

		
		$cpage	=	new	cpage;	//ʵ������ҳ��
		$cpage_html	=	$cpage->make_cpage(mysql_num_rows($rs), $num_perpage, $url);	 //����: ��¼����, ÿҳ����, ��ת��ַ
		//var_dump($cpage_html);
		$limit_num	=	$cpage->getLimitNum($num_perpage);



		//________________________________�������_________________________________________

		if(!empty($table)){

			if($num_perpage != 0){	 //�з�ҳ
				$sql_now = "select * from $table WHERE ".$sql." LIMIT ".$limit_num['top'].",".$limit_num['bottom']." ";
			}else{	//�޷�ҳ
				$sql_now = "select * from $table WHERE ".$sql   ;//���ɲ�ѯ��¼����SQL���
			}

		}else{

			if($num_perpage != 0){	 //�з�ҳ
				$sql_now = $sql   ;
			}else{	//�޷�ҳ
				$sql_now = $sql   ;//���ɲ�ѯ��¼����SQL���
			}
			
		}
		//$row = mysql_fetch_assoc($rs); 

		$rs = mysql_query($sql_now) or die("�޷�ִ��SQL��䣺$sql_now "); //��ѯ��¼��

		$result	=	array();
		while($row = mysql_fetch_assoc($rs)){
			//var_dump($row);
			$result[]	 =	$row;
		}

		return	$result;
	}



	/*
	*ֻ�Ƕ�ȡ1������
	*
	*����
	*table
	*sql
	*/
	function find_one($table, $sql){


		if(!empty($table)){
			$sql_now = "select * from $table WHERE ".$sql   ;//���ɲ�ѯ��¼����SQL���
		}else{
			$sql_now = $sql   ;//���ɲ�ѯ��¼����SQL���
		}
		$rs = mysql_query($sql_now) or die("�޷�ִ��SQL��䣺$sql_now "); //��ѯ��¼��
	
		$result	=	array();
		while($row = mysql_fetch_assoc($rs)){
			$result[]	 =	$row;
			break;
		}

		return	$result[0];

	}



	//ֱ�Ӳ�ѯsql
	function find_sql($sql, $num_perpage=10, $url="?", &$cpage_html){

		//_______________________________��ҳ��������ͳ��_________________________________
		if(!empty($sql)){
				$sql_now = $sql   ;
		}else{
			return false;
		}
		$rs = mysql_query($sql_now) or die("�޷�ִ��SQL��䣺$sql_now "); //��ѯ

		$cpage	=	new	cpage;	//ʵ������ҳ��
		$cpage_html	=	$cpage->make_cpage(mysql_num_rows($rs), $num_perpage, $url);	 //����: ��¼����, ÿҳ����, ��ת��ַ
		$limit_num	=	$cpage->getLimitNum($num_perpage);



		//________________________________�������_________________________________________
		if(!empty($sql)){
			if($num_perpage != 0){	 //�з�ҳ
				$sql_now = $sql." LIMIT ".$limit_num['top'].",".$limit_num['bottom']." ";
			}else{
				$sql_now= $sql;
			}

		}else{
			return false;
		}


		//$rs = mysql_query($sql_now) or die("�޷�ִ��SQL��䣺$sql_now "); //��ѯ
		$result	=	array();
		while($row = mysql_fetch_assoc($rs)){
			$result[]	 =	$row;
		}

		return	$result;
	}



	/*
	*insert
	*
	*����
	*table
	*array date
	*where sql
	*/
	function insert($table, $data){

		if(empty($data) ||  empty($table) ){
			return false;
		}

		$array_num	 =	count($data);

		//�ӹ��ַ���
		$insert_filed	=	"";
		$insert_value	=	"";

		$i	=	1;
		foreach($data as $key_d => $val_d){
			$insert_filed	.=	$key_d;
			if($i!=$array_num	){
				$insert_filed	.=	", ";
			}

			$insert_value	.=	"'$val_d'";
			if($i!=$array_num	){
				$insert_value	.=	", ";
			}
			//echo $i;
			$i++;
		}

		//�ϳ�
		$sql	=	"INSERT INTO $table ($insert_filed)VALUES($insert_value) ";
		//echo $sql;
		$result	=	mysql_query($sql);
		return $result;

	}


	/*
	*update
	*
	*����
	*table
	*array date
	*where sql
	*/

	function update($table, $date, $where){

		if(empty($date) || empty($where) ||  empty($table) ){
			return false;
		}

		$update_str	=	"";

		$array_num	 =	count($date);
		$i	=	1;
		foreach($date as $key_d => $val_d){
			$update_str	.=		$key_d." = '".$val_d."' ";
			if($i!=$array_num	){
				$update_str	.=	", ";
			}
			$i++;
		}
		
		$sql	=	"UPDATE $table SET $update_str WHERE $where ";
		//var_dump($sql);
		$result	=	mysql_query($sql);

		return $result;
	}



	//ɾ����¼
	function del($table,$where){
		if(empty($where) ||  empty($table) ){
			return false;
		}

		$sql	=	"DELETE FROM $table WHERE $where ";
		$result	=	mysql_query($sql);

		return $result;

	}



}






/*
-------------------------------------------��ҳ��-----------------------------------------------
*/




class cpage {



	//���캯��, ��ȫ���ǿ��ж�
	function make_cpage($t_num, $perpage_p=20, $url){

		if(0==$t_num)
			return false;

		if(!is_numeric($perpage_p))
			return false;
			
		//--------------------��ҳ�����趨------------------------

		$total_num =  $t_num;//�ܼ�¼ 


		//ÿҳ��ʾ��Ŀ����
		$perpage = $perpage_p;
		
		//��ȡ��ǰҳ��
		if(!empty($_GET['page']) && is_numeric($_GET['page'])){
		$curr_page = $_GET['page'];
		}
		else{
			$curr_page = 1;
		}
		
		//ҳ����ת�ĵ�ַ, �ǵü����û�����
		$mpurl = $url."?";
		

		//���빲�÷�ҳ����
		$cpage_html	= $this->multi($t_num, $perpage, $curr_page, $mpurl);	 //�����ҳ����
		//var_dump($cpage_html);

		return $cpage_html;

	}


	
	
	
	//--------------------��ҳ�����趨 end------------------------
	
	// ��ҳ���� 
	function multi($num, $perpage, $curr_page, $mpurl) { 
		$multipage = ''; 
		if($num > $perpage) { 
		$page = 10; 
		$offset = 4; 
		
		$pages = ceil($num / $perpage); 
		$from = $curr_page - $offset; 
		$to = $curr_page + $page - $offset - 1; 
		if($page > $pages) { 
		$from = 1; 
		$to = $pages; 
		} else { 
		if($from < 1) { 
		$to = $curr_page + 1 - $from; 
		$from = 1; 
		if(($to - $from) < $page && ($to - $from) < $pages) { 
		$to = $page; 
		} 
		} elseif($to > $pages) { 
		$from = $curr_page - $pages + $to; 
		$to = $pages; 
		if(($to - $from) < $page && ($to - $from) < $pages) { 
		$from = $pages - $page + 1; 
		} 
		} 
		} 
		$multipage .= "<a href=\"$mpurl&page=1\" class='link_cpage'><-</a> "; 
		for($i = $from; $i <= $to; $i++) { 
		if($i != $curr_page) { 
		$multipage .= "<a href=\"$mpurl&page=$i\" class='link_cpage'>$i</a> "; 
		} else { 
		$multipage .= "<a href=\"#\" style='color:#0088CC; text-decoration: underline;'>".$i.'</a> '; 
		} 
		} 
		$multipage .= $pages > $page ? " ... <a href=\"$mpurl&page=$pages\" class='link_cpage'>-></a>" : " <a href=\"$mpurl&page=$pages\" class='link_cpage'>-></a>"; 
		} 


		return $multipage; 
	} 
	//��ҳ����end


	//��ȡ��¼ƫ�������Ŀ�ͷ���
	function getLimitNum($num_perpage){

		//��ȡ��ǰҳ��
		if(!empty($_GET['page']) && is_numeric($_GET['page'])){
		$curr_page = $_GET['page'];
		}
		else{
			$curr_page = 1;
		}


		$num	=	array();

		$num['top']	=	($curr_page-1)*$num_perpage;
		$num['bottom']	=	$curr_page*$num_perpage;

		return $num;
	}

}
?>