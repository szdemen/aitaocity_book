
<form action="/" enctype="multipart/form-data" method="post">
请输入isbn号,书籍数量, 格式如下<br />
isbn,num[换行]<br />
isbn,num<br />
<textarea name="data" cols="" rows="" style="width:500px; height:100px;">
</textarea><br />
<input name="go" type="submit" value="go" />

</form>

<?php

if(!empty($_POST["data"])){
	
	echo "输入数据<br>";
	echo nl2br($_POST["data"]);

	$isbn_list	=	explode("\r\n",  trim($_POST["data"]));
	//var_dump($books);
	
	echo "<hr>";
	
	//使用逗号分开isbn和数量
	$books_temp	=	array();
	foreach($isbn_list as $key => $value){
		if(strpos($value,',',0)){	//检测是否含有逗号, 以免单独输入
			$books_temp[$key]	=	array_slice(explode(',',$value),0,2);	//逗号拆开字符串, 取出前2个元素
		}else{
			//非正确输入
		}
	}
	echo "<hr>";
	echo "输入数据分割后数组内容:";
	dump($books_temp);
	
	
	
	
	
	//豆瓣的api key
	$douban_apikey	=	'?apikey=02306805bd08ff6406913811371afe2c';
	//豆瓣的isbn查询api地址
	$douban_isbnurl	=	"http://api.douban.com/book/subject/isbn/";
	//豆瓣查询间隔限制
	$time_douban	=	2;	//查询时间间隔为2s,保险些
	
	//定义一个用于插入数据库用的数组
	$insert_data	=	array();
	
	set_time_limit(0);	//脚本超时限制解除
	//开始获取数据
	if(!empty($books_temp))
	
	foreach($books_temp as $bkey => $bvalue){
		if( !empty($bvalue[0])){	//isbn判定非空进入获取
		
			try{
				$xml_text	=	curlGet($douban_isbnurl.trim($bvalue[0]).$douban_apikey);
				$xml = simplexml_load_string($xml_text);
				if('bad isbn'	!=	$xml_text){	//判定是否有效的ISBN
					 $insert_data[]	=	array(
							'isbn'		=>	 trim($bvalue[0]),
							'title'		=>	 (string)$xml->title,
							'doubanurl'		=>	 (string)'<a href="'.$xml->id.'">图书介绍链接</a>'
					 );
				}else{
					$insert_data[]	=	array(
							'isbn'		=>	 trim($bvalue[0]),
							'title'		=>	 'ISBN错误',
							'doubanurl'		=>	 'N/A'
					 );
				}
				 
			}
			catch (Exception $ex){ 
				 echo $ex->getTraceAsString();
			}
		}else{
			//空的isbn不需处理
		}
		sleep($time_douban);
	}
	
	//echo curlGet($douban_isbnurl.trim($books[1][0]).$douban_apikey);
	//$xmlstring		=	curlGet($douban_isbnurl.trim($books[1][0]).$douban_apikey);	
	//$xml = simplexml_load_string($xmlstring);
	echo "<hr>";
	echo "查询结果<br>";
	dump($insert_data);
	
	//echo $xml->title;
	
}


//curl function
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


function dump($vars, $label = '', $return = false)
{
    if (ini_get('html_errors')) {
        $content = "<pre>\n";
        if ($label != '') {
            $content .= "<strong>{$label} :</strong>\n";
        }
        $content .= htmlspecialchars(print_r($vars, true));
        $content .= "\n</pre>\n";
    } else {
        $content = $label . " :\n" . print_r($vars, true);
    }
    if ($return) { return $content; }
    echo $content;
    return null;
}

?>