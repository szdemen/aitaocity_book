
<?php 
include_once('conn.php');
//include_once('login_check.php');

//加密解密函数
include_once("function/encode_inc.php");

//实例化对象
include_once('class/db.class.php');		//引入数据库操作类
$db	=	new	db();








//添加项目
if($_REQUEST['action']=='add'){

	//加载模版
	include_once('templeta/projectAdd.php');

}


//添加项目
if($_REQUEST['action']=='addProject'){
	
		//检测
		noEmptyCk('pname','必须填写项目名称');
		noEmptyCk('description','必须填写项目描述');
		noEmptyCk('need','必须填写项目需求');
		noEmptyCk('cname','必须填写联系人');
		noEmptyCk('contact','必须填写联系方式');
		noEmptyCk('address','必须填写联系地址');
		
		//uid
		if(!empty($GLOBALS['user_id'])){
			$uid	=	$GLOBALS['user_id'];
		}else{
			$uid	= 0;
		}
		
		$data	=	array(
							'pname'=>trim($_POST['pname']),
							'description'=>addslashes($_POST['description']),
							'need'=>addslashes($_POST['need']),
							'cname'=>trim($_POST['cname']),
							'contact'=>trim($_POST['contact']),
							'address'=>trim($_POST['address']),
							'add_uid'=>$uid,
							'add_time'=>date("Y-m-d H:i:s")
							);
		
		$result	=	$db->insert('project',$data);
		if(!$result){
				echo "<script>alert('服务器忙碌，请再次尝试');history.go(-1);</script>";
				die();
		}else{
				echo "<script>alert('添加需求信息成功，现在跳转回需求资料页面列表');location.href='/project.php?action=list';</script>";
				die();
		}
		
		
		
}





//项目列表
if($_REQUEST['action']=='list' || empty($_REQUEST['action'])){
	//读取资料, 最新10条项目, 外加5个top项目
	$cpage_html	=	'';
	$list_new	=	$db->find('project', ' state=1 order by pid desc ',20,'project.php' ,$cpage_html);
	
	$cpage_html_top	=	'';
	$list_top	=	$db->find('project', ' state=1 and istop=1 order by pid,istop desc ',5,'project.php' ,$cpage_html_top);
	
	//dump($list_new);
	//dump($list_top);
	include("templeta/projectList.php");
}


//单独查看project
if($_REQUEST['action']=='view'){
	
	noEmptyCk('pid','空pid错误');
	
	if(!is_numeric($_GET['pid'])){
			echo "<script>alert('pid error');history.go(-1);</script>";
			die();
	}
	
	$value_n	=	$db->find_one('project', ' state=1 and pid ='.$_GET['pid']);
	$list_top	=	$db->find('project', ' state=1 and istop=1 order by pid,istop desc ',5,'project.php' ,$cpage_html_top);
	
	include("templeta/projectView.php");
	
}



//search
if($_REQUEST['action']=='search'){
	

	if(empty($_GET['kw'])){
			echo "<script>alert('请输入查询的关键词');history.go(-1);</script>";
			die();
	}
	
	$cpage_html	=	"";
	$list_search	=	$db->find('project', ' pname like \'%'.$_GET['kw'].'%\'  and state=1 order by pid,istop desc ',20,'project.php?action=search' ,$cpage_html);
	$list_top	=	$db->find('project', ' state=1 and istop=1 order by pid,istop desc ',5,'project.php' ,$cpage_html_top);
	
	include("templeta/projectSearchList.php");
	
}

















//非空提交检测
function noEmptyCk($id,$tips){
	if(empty($_REQUEST[$id])){
		echo "<script>alert('$tips');history.go(-1);</script>";	
		die();
	}
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


/**-------------------------------------------------------------
 * 生成摘要
 * @param (string) $body
 *  正文
 * @param (int) $size
 *  摘要长度
 * @param (int) $format
 *  输入格式 id
 */
function content_cut($body, $size, $format = NULL){
  $_size = mb_strlen($body, 'utf-8');
  
  if($_size <= $size) return $body;
  
  // 输入格式中有 PHP 过滤器
  if(!isset($format) && filter_is_php($format)){
    return $body;
  }
  
  $strlen_var = strlen($body);
  
  // 不包含 html 标签
  if(strpos($body, '<') === false){
    return mb_substr($body, 0, $size);
  }
  
  // 包含截断标志，优先
  if($e = strpos($body, '<!-- break -->')){
    return mb_substr($body, 0, $e);
  }
  
  // html 代码标记
  $html_tag = 0;
  
  // 摘要字符串
  $summary_string = '';
  
  /**
   * 数组用作记录摘要范围内出现的 html 标签
   * 开始和结束分别保存在 left 和 right 键名下
   * 如字符串为：<h3><p><b>a</b></h3>，假设 p 未闭合
   * 数组则为：array('left' => array('h3', 'p', 'b'), 'right' => 'b', 'h3');
   * 仅补全 html 标签，<? <% 等其它语言标记，会产生不可预知结果
   */
  $html_array = array('left' => array(), 'right' => array());
  for($i = 0; $i < $strlen_var; ++$i) {
    if(!$size){
      break;
    }
    
    $current_var = substr($body, $i, 1);
    
    if($current_var == '<'){
      // html 代码开始
      $html_tag = 1;
      $html_array_str = '';
    }else if($html_tag == 1){
      // 一段 html 代码结束
      if($current_var == '>'){
        /**
         * 去除首尾空格，如 <br /  > < img src="" / > 等可能出现首尾空格
         */
        $html_array_str = trim($html_array_str);
        
        /**
         * 判断最后一个字符是否为 /，若是，则标签已闭合，不记录
         */
        if(substr($html_array_str, -1) != '/'){
          
          // 判断第一个字符是否 /，若是，则放在 right 单元
          $f = substr($html_array_str, 0, 1);
          if($f == '/'){
            // 去掉 /
            $html_array['right'][] = str_replace('/', '', $html_array_str);
          }else if($f != '?'){
            // 判断是否为 ?，若是，则为 PHP 代码，跳过
            
            /**
             * 判断是否有半角空格，若有，以空格分割，第一个单元为 html 标签
             * 如 <h2 class="a"> <p class="a">
             */
            if(strpos($html_array_str, ' ') !== false){
              // 分割成2个单元，可能有多个空格，如：<h2 class="" id="">
              $html_array['left'][] = strtolower(current(explode(' ', $html_array_str, 2)));
            }else{
              /**
               * * 若没有空格，整个字符串为 html 标签，如：<b> <p> 等
               * 统一转换为小写
               */
              $html_array['left'][] = strtolower($html_array_str);
            }
          }
        }
        
        // 字符串重置
        $html_array_str = '';
        $html_tag = 0;
      }else{
        /**
         * 将< >之间的字符组成一个字符串
         * 用于提取 html 标签
         */
        $html_array_str .= $current_var;
      }
    }else{
      // 非 html 代码才记数
      --$size;
    }
    
    $ord_var_c = ord($body{$i});
    
    switch (true) {
      case (($ord_var_c & 0xE0) == 0xC0):
        // 2 字节
        $summary_string .= substr($body, $i, 2);
        $i += 1;
      break;
      case (($ord_var_c & 0xF0) == 0xE0):
        
        // 3 字节
        $summary_string .= substr($body, $i, 3);
        $i += 2;
      break;
      case (($ord_var_c & 0xF8) == 0xF0):
        // 4 字节
        $summary_string .= substr($body, $i, 4);
        $i += 3;
      break;
      case (($ord_var_c & 0xFC) == 0xF8):
        // 5 字节
        $summary_string .= substr($body, $i, 5);
        $i += 4;
      break;
      case (($ord_var_c & 0xFE) == 0xFC):
        // 6 字节
        $summary_string .= substr($body, $i, 6);
        $i += 5;
      break;
      default:
        // 1 字节
        $summary_string .= $current_var;
    }
  }

  if($html_array['left']){
    /**
     * 比对左右 html 标签，不足则补全
     */
    
    /**
     * 交换 left 顺序，补充的顺序应与 html 出现的顺序相反
     * 如待补全的字符串为：<h2>abc<b>abc<p>abc
     * 补充顺序应为：</p></b></h2>
     */
    $html_array['left'] = array_reverse($html_array['left']);
    
    foreach($html_array['left'] as $index => $tag){
      // 判断该标签是否出现在 right 中
      $key = array_search($tag, $html_array['right']);
      if($key !== false){
        // 出现，从 right 中删除该单元
        unset($html_array['right'][$key]);
      }else{
        // 没有出现，需要补全
        $summary_string .= '</'.$tag.'>';
      }
    }
  }
  return $summary_string;
}


?> 