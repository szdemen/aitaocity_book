<?php

//global $cpage_html;	//输出换页html代码


class db
{
	var $username;
	//var 

	/*
	*读取数据
	*
	*参数
	*table
	*sql
	*每页记录数量
	*跳转url
	*/
	function find($table, $sql, $num_perpage=20, $url="?", &$cpage_html){


		//_______________________________分页处理总数统计_________________________________________
		if(!empty($table)){
				$sql_now = "select * from $table WHERE ".$sql   ;//生成查询记录数的SQL语句
		}else{
				$sql_now = $sql   ;//生成查询记录数的SQL语句
		}
			
		
		$rs = mysql_query($sql_now) or die("无法执行SQL语句：$sql_now "); //查询记录数

		
		$cpage	=	new	cpage;	//实例化分页类
		$cpage_html	=	$cpage->make_cpage(mysql_num_rows($rs), $num_perpage, $url);	 //参数: 记录总数, 每页数量, 跳转地址
		//var_dump($cpage_html);
		$limit_num	=	$cpage->getLimitNum($num_perpage);



		//________________________________内容输出_________________________________________

		if(!empty($table)){

			if($num_perpage != 0){	 //有分页
				$sql_now = "select * from $table WHERE ".$sql." LIMIT ".$limit_num['top'].",".$limit_num['bottom']." ";
			}else{	//无分页
				$sql_now = "select * from $table WHERE ".$sql   ;//生成查询记录数的SQL语句
			}

		}else{

			if($num_perpage != 0){	 //有分页
				$sql_now = $sql   ;
			}else{	//无分页
				$sql_now = $sql   ;//生成查询记录数的SQL语句
			}
			
		}
		//$row = mysql_fetch_assoc($rs); 

		$rs = mysql_query($sql_now) or die("无法执行SQL语句：$sql_now "); //查询记录数

		$result	=	array();
		while($row = mysql_fetch_assoc($rs)){
			//var_dump($row);
			$result[]	 =	$row;
		}

		return	$result;
	}



	/*
	*只是读取1条数据
	*
	*参数
	*table
	*sql
	*/
	function find_one($table, $sql){


		if(!empty($table)){
			$sql_now = "select * from $table WHERE ".$sql   ;//生成查询记录数的SQL语句
		}else{
			$sql_now = $sql   ;//生成查询记录数的SQL语句
		}
		$rs = mysql_query($sql_now) or die("无法执行SQL语句：$sql_now "); //查询记录数
	
		$result	=	array();
		while($row = mysql_fetch_assoc($rs)){
			$result[]	 =	$row;
			break;
		}

		return	$result[0];


	}



	//直接查询sql
	function find_sql($sql, $num_perpage=10, $url="?", &$cpage_html){

		//_______________________________分页处理总数统计_________________________________
		if(!empty($sql)){
				$sql_now = $sql   ;
		}else{
			return false;
		}
		$rs = mysql_query($sql_now) or die("无法执行SQL语句：$sql_now "); //查询

		$cpage	=	new	cpage;	//实例化分页类
		$cpage_html	=	$cpage->make_cpage(mysql_num_rows($rs), $num_perpage, $url);	 //参数: 记录总数, 每页数量, 跳转地址
		$limit_num	=	$cpage->getLimitNum($num_perpage);



		//________________________________内容输出_________________________________________
		if(!empty($sql)){
			if($num_perpage != 0){	 //有分页
				$sql_now = $sql." LIMIT ".$limit_num['top'].",".$limit_num['bottom']." ";
			}else{
				$sql_now= $sql;
			}

		}else{
			return false;
		}


		//$rs = mysql_query($sql_now) or die("无法执行SQL语句：$sql_now "); //查询
		$result	=	array();
		while($row = mysql_fetch_assoc($rs)){
			$result[]	 =	$row;
		}

		return	$result;
	}



	/*
	*insert
	*
	*参数
	*table
	*array date
	*where sql
	*/
	function insert($table, $data){

		if(empty($data) ||  empty($table) ){
			return false;
		}

		$array_num	 =	count($data);

		//加工字符串
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

		//合成
		$sql	=	"INSERT INTO $table ($insert_filed)VALUES($insert_value) ";
		//echo $sql;
		$result	=	mysql_query($sql);
		$insert_id	=	mysql_insert_id();
		//echo $insert_id;
		return $insert_id;

	}


	/*
	*update
	*
	*参数
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
		//echo $sql; die();
		$result	=	mysql_query($sql);

		return $result;


	}



	//删除记录
	function del($table,$where){
		if(empty($where) ||  empty($table) ){
			return false;
		}

		$sql	=	"DELETE FROM $table WHERE $where ";
		$result	=	mysql_query($sql);

		return $result;

	}



	//截取内容规定字数内容------------------------
	function subContent($content){
		$temp	=	$this->mysubstr($content);
		return $this->closetags($temp);

	}

	function mysubstr($str) {
	//正确截取中文字符串
	$start = 1;
	$len = 801;
		$tmpstr = "";
		$strlen = $start + $len;
		 for($i = 0; $i < $strlen; $i++) {
			 if(ord(substr($str, $i, 1)) > 0xa0) {
				$tmpstr .= substr($str, $i, 2);
				$i++;
			 } else
				$tmpstr .= substr($str, $i, 1);
		 }
		 return $tmpstr;
	}


	function closetags($html){
	/*截取最后一个 < 之前的内容，确保字符串中所有HTML标签都以 > 结束*/
	$html=preg_replace("~<[^<>]+?$~i", "", $html);
	/*自动匹配补齐未关闭的HTML标签*/
	#put all opened tags into an array
	preg_match_all("#<([a-z]+)( .*[^/])?(?!/)>#iU",$html,$result);
	$openedtags=$result[1];
	#put all closed tags into an array
	preg_match_all("#</([a-z]+)>#iU",$html,$result);
	$closedtags=$result[1];
	$len_opened = count($openedtags);
	# all tags are closed
	if(count($closedtags) == $len_opened){
	   return $html;
	}
	$openedtags = array_reverse($openedtags);
	# close tags
	for($i=0;$i<$len_opened;$i++) {
	   if (!in_array($openedtags[$i],$closedtags)){
	   $html .= '</'.$openedtags[$i].'>';
	   } else {
		unset($closedtags[array_search($openedtags[$i],$closedtags)]);
	   }
	}
	return $html;
	}
	//end 截取内容规定字数内容------------------------



}






/*
-------------------------------------------分页类-----------------------------------------------
*/




class cpage {



	//构造函数, 安全及非空判定
	function make_cpage($t_num, $perpage_p=20, $url){

		if(0==$t_num)
			return false;

		if(!is_numeric($perpage_p))
			return false;
			
		//--------------------分页数据设定------------------------

		$total_num =  $t_num;//总记录 


		//每页显示项目数量
		$perpage = $perpage_p;
		
		//读取当前页码
		if(!empty($_GET['page']) && is_numeric($_GET['page'])){
		$curr_page = $_GET['page'];
		}
		else{
			$curr_page = 1;
		}
		
		//页码跳转的地址, 记得加上用户参数
		$mpurl = $url."?";
		

		//传入共用分页变量
		$cpage_html	= $this->multi($t_num, $perpage, $curr_page, $mpurl);	 //输出分页代码
		//var_dump($cpage_html);

		return $cpage_html;

	}


	
	
	
	//--------------------分页数据设定 end------------------------
	
	// 分页函数 
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
		$multipage .= "<a href=\"$mpurl&page=1\" class='link_cpage'>< </a> "; 
		for($i = $from; $i <= $to; $i++) { 
		if($i != $curr_page) { 
		$multipage .= "<a href=\"$mpurl&page=$i\" class='link_cpage'>$i</a> "; 
		} else { 
		$multipage .= "<a href=\"#\" style='color:#CC0000; text-decoration: underline;'>".$i.'</a> '; 
		} 
		} 
		$multipage .= $pages > $page ? " ... <a href=\"$mpurl&page=$pages\" class='link_cpage'> ></a>" : " <a href=\"$mpurl&page=$pages\" class='link_cpage'> ></a>"; 
		} 


		return $multipage; 
	} 
	//分页函数end


	//获取记录偏移数量的开头序号
	function getLimitNum($num_perpage){

		//读取当前页码
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

//上传文件处理
function uploadFile($file,$saveto){
	
}

//删除文件
function delFile($fileurl){
	
}


?>