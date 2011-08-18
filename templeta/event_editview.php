<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $event['name']; ?> 活动编辑 - 去耍网 </title>

<link href="../css/css_reset.css" rel="stylesheet" type="text/css" />
<link href="../css/global.css" rel="stylesheet" type="text/css" />

<script src="../js/jquery-1.4.min.js" type="text/javascript"></script>
<script src="../js/xheditor-zh-cn.min.js" type="text/javascript"></script>

<script src="../js/twoCalendar.js"  type="text/javascript" ></SCRIPT>
<script src="../js/time_picker/jquery.ptTimeSelect.js"  type="text/javascript" ></SCRIPT>
<link href="../js/time_picker/jquery.ptTimeSelect.css" rel="stylesheet" type="text/css" />


<script>  
/*$(document).ready(function(){  
$('#login_form').html5form();  
});  */

$(document).ready(function(){  
	$('#timestart').ptTimeSelect();
}); 


function checkPost(){
	
	if(document.getElementById('event_name').value==''){
		alert('请输入活动名称');
		return false;
	}
	
	if(document.getElementById('when').value=='' || document.getElementById('when').value=='点击选择日期' || document.getElementById('timestart').value==''  ){
		alert('请输入活动时间');
		return false;
	}
	
	if(document.getElementById('site').value==''){
		alert('请输入活动地点');
		return false;
	}
	
	/*if(document.getElementById('content').value==''){
		alert('请输入活动内容');
		return false;
	}*/
	
	return true;
	
}
</script>

<style>
.title{ font-size:14px; font-weight:bold}
.input{ margin:10px 0;}
.input .item_left{ display:inline-block; width:140px; text-align:right; font-size:14px; line-height:16px;}
.input li input{ width:250px; height:25px; margin-left:15px; font-size:18px;font-family:Tahoma, Geneva, sans-serif; }
.input li textarea{width:730px; height:335px;  }
#xhe0_container{ margin-left:15px;}
.input li{ margin-bottom:10px;}
.input li p{ margin-bottom:20px;}
#radio{ width:25px; height:25px; vertical-align: middle;}
</style>

</head>

<body>
<div id="warpper">
    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/top_bar.php');?>
             
    <div class="content_all" style="padding:20px; width:960px;">
        <fieldset style="background-color:#FFF; border:solid 1px #b0bb0b;"><legend class="title" style="background-color:#FFF; border:solid 1px #b0bb0b; margin-left:50px; padding:3px;">编辑活动</legend>
        
        <form action="event.php" method="post" name="form">
        <ul class="input">
        	<li><span class="item_left">活动名称:</span><input name="event_name" type="text" id="event_name" value="<?php echo $event['name']; ?>"/></li>
            <li><span class="item_left">日期:</span><input onblur="if(this.value==''){this.value='点击选择日期';this.style.color='#ccc';}" onfocus="if(this.value=='点击选择日期'){this.value='';this.style.color='#ccc';}MyCalendar.SetDate(this)" value="<?php echo substr($event['target_time'],0,10); ?>" type="text" name="when" class="train_search_input"  id="when"> 时间:<input name="timestart" id="timestart" style="width:90px;"  value="<?php echo substr($event['target_time'],11,18); ?>"/></li>
        	<li><span class="item_left">地点:</span><input name="site" type="text"  id="site" value="<?php echo $event['site']; ?>"/></li>
            <li><span class="item_left">内容简介:</span><textarea name="content" cols="" rows="" class="xheditor {skin:'default'};" id="content"><?php echo $event['content']; ?></textarea></li>
            <li><span class="item_left">消费方式:</span>
            	<label><input name="afford" type="radio" value="1" id="radio" <?php  echo $event['afford']==1?"checked='checked'":'' ?> /><img src="images/tag_aa_payment.png" style="vertical-align:middle;" />&nbsp;AA共摊</label>, 大概￥<input name="pay" type="text" style="width:35px; margin-left:1px;"  value="<?php echo $event['pay']; ?>"/>
                <label><input name="afford" type="radio" value="2" id="radio" <?php  echo $event['afford']==2?"checked='checked'":'' ?>/><img src="images/tag_ipay_payment.png" style="vertical-align:middle;"/>&nbsp;爷请客</label>
                <label><input name="afford" type="radio" value="3" id="radio" <?php  echo $event['afford']==3?"checked='checked'":'' ?>/><img src="images/tag_yes_payment.png" style="vertical-align:middle;"/>&nbsp;东主请客</label>
           </li>
            
            <li><span class="item_left"> </span><button style="font-size: 14px;    height: 32px;    line-height: 28px;    margin: 15px 0 0 15px; font-weight:bold;" type="submit" onclick="return checkPost();">提交编辑</button>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="if( confirm('确认清空所有内容？')){document.form.reset();}" class="bk">重置</a><input name="action" type="hidden" value="doEdit" /><input name="eid" type="hidden" value="<?php echo $event['id']; ?>" /></li>
            
        </ul>
        </form>
        </fieldset>
        
        
        
    </div>
    
    
    
    
</div><!--//warpper -->
</body>
</html>