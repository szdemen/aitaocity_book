<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $event['name']; ?> 活动编辑 - 去耍网 </title>

<link href="../css/css_reset.css" rel="stylesheet" type="text/css" />
<link href="../css/global.css" rel="stylesheet" type="text/css" />

<script>

var error	=	0;
function noEmptyCk(id,tips){
	if(document.getElementById(id).value==''){
		alert(tips);
		error	=	1;
	}
}

function checkPost(){
	
	noEmptyCk('uname','请输入名称');
	noEmptyCk('phone','请输入电话号码');
	
	if(error=='0'){
		return true;
	}else{
		return false;
	}
	
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
#submit{font-size: 14px;    height: 32px;    line-height: 28px;    margin: 15px 0 0 15px; font-weight:bold;}
</style>

</head>

<body>
<div id="warpper">
    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/top_bar.php');?>
             
    <div class="content_all" style="padding:20px; width:960px;">
        <fieldset style="background-color:#FFF; border:solid 1px #b0bb0b;"><legend class="title" style="background-color:#FFF; border:solid 1px #b0bb0b; margin-left:50px; padding:3px;">个人资料编辑</legend>
        
        <form action="user.php" method="post" name="form" enctype="multipart/form-data">
        <ul class="input">
        	<li><span class="item_left">用户邮箱:</span><input name="email" type="text" id="email" value="<?php echo $user['email']; ?>" disabled="disabled"/>这个不能改</li>
            <li><span class="item_left">用户名称:</span><input name="uname" type="text" id="uname" value="<?php echo $user['name']; ?>" /></li>
            <li><span class="item_left">电话:</span><input name="phone" type="text" id="phone" value="<?php echo $user['phone']; ?>" /></li>
            <li><span class="item_left">密码:</span><input name="pw" type="password" id="email" />（如不需修改请留空）</li>
            <li><span class="item_left">确认密码:</span><input name="pw2" type="password" id="email" >（如不需修改请留空）</li>
            
            <li><span class="item_left">用户头像:</span><input name="photo_file" type="file" /><img src="/user_upload/user_header_<?php echo $user['uid']; ?>.jpg?<?php echo time(); ?>" width="40" height="40" onerror="javascript:this.src='/user_upload/error.gif'" style="vertical-align:middle;"/>(只支持JPG文件，自动缩放到100*100)</li>
            <li>
                <span class="item_left"> </span><button id="submit" type="submit" onclick="return checkPost();">更新个人资料</button>&nbsp;&nbsp;
                <input name="action" type="hidden" value="doEdit" />
                <input name="uid" type="hidden" value="<?php echo $user['uid']; ?>" />
            </li>
            
        </ul>
        </form>
        </fieldset>
        
        
        
    </div>
    
    
    
    
</div><!--//warpper -->
</body>
</html>