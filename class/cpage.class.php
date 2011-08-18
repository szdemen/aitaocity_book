<?php


class cpage {



	//���캯��, ��ȫ���ǿ��ж�
	function __construct($t_num, $perpage_p=20, $url){

		if(0==$t_num)
			return false;

		if(!is_numeric($perpage_p))
			return false;

		/*if(!is_numeric($per_page))
			return false;*/

		
			
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
		//$mpurl = "index.php?";
		$mpurl = $url."?";
		
		
		//��ҳ��
		$total_pages = ceil($total_num / $perpage);


		echo $t_num."-".$perpage."-". $curr_page ."-".$mpurl;

		var_dump($this->multi($t_num, $perpage, $curr_page, $mpurl));

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
		$multipage .= "<a href=\"#\" style='color:#fff; text-decoration:none;font-size:12px;padding:4px; border:solid 1px #1f72d0; background-color:#1f72d0;'>".$i.'</a> '; 
		} 
		} 
		$multipage .= $pages > $page ? " ... <a href=\"$mpurl&page=$pages\" class='link_cpage'>-></a>" : " <a href=\"$mpurl&page=$pages\" class='link_cpage'>-></a>"; 
		} 


		return $multipage; 
	} 
	//��ҳ����end

}
?>