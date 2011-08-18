<?php include_once("head.php"); ?>

<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="back_office/js/hxeditor/xheditor-1.1.9-zh-cn.min.js"></script>

<script>
 $(document).ready(function() {
   	$('#t1').xheditor({tools:'mini'});
	$('#t2').xheditor({tools:'mini'});
 });
</script>        

<script type="text/javascript">

			function isEmpty(target,tips){
					var thing	=	document.getElementById(target);					
					if(thing.value==''){	//empty
						alert(tips);
						thing.focus();
						return false;
					}else{
						return true;	
					}
			}

            function myCheck()
            {
					if(!isEmpty('pname','项目名称不能为空')){ return false;};
					if($('#t1').val()==''){ alert('项目描述不能为空');return false;};
					if($('#t2').val()==''){ alert('需求描述不能为空');return false;};
					//(isEmpty('pname','项目名称不能为空'))?(return false):1;
					if(!isEmpty('cname','联系人不能为空')){ return false;};
					if(!isEmpty('contact','联系方式不能为空')){ return false;};
					if(!isEmpty('address','联系地址不能为空')){ return false;};
					
					return true;
            }
</script>

<form action="project.php" method="post" enctype="multipart/form-data"  onsubmit="return myCheck()" name="form">
		<div class="form_wrapper">
        		<div class="form_title"><img src="images/logo_donate.gif" class="logo">欢迎提交需要帮助的项目<br>请全部填写以下的内容, 以便于我们更好地公布此信息以及跟进捐助情况</div>
                
                <ul class="form_item">
                		                       
                        <li><span class="form_item_name">项目名称</span> <span class="form_item_input"><input name="pname" type="text" placeholder="请填写项目名称" id="pname"></span>如: 四川绵阳三台大佛寺孤儿学校急需少儿读物</li>
                         <li><span class="form_item_name">项目描述</span> <span class="form_item_input"><textarea name="description" cols="" rows="" class="textarea" id="t1"></textarea></span></li>
                         <li><span class="form_item_name">需求描述</span> <span class="form_item_input"><textarea name="need" cols="" rows=""  class="textarea"  id="t2"></textarea></span></li>
                         
                         <li><span class="form_item_name">联系人名称</span> <span class="form_item_input"><input name="cname" type="text" placeholder="请填写联系人名称" id="cname"></span></li>
                         <li><span class="form_item_name">联系方式</span> <span class="form_item_input"><input name="contact" type="text" placeholder="请填写联系方式" id="contact"></span>如手机号码, QQ号码, Email地址等 </li>
                         <li><span class="form_item_name">联系地址</span><span class="form_item_input"><input name="address" type="text" placeholder="请填写地址" id="address"></span>请尽可能详细</li> 
                         <li><span class="form_item_name"><span style="color:red;">注意事项: </span></span>以上填写的信息在提交后我们将会进行初步的审核, 如无问题将会尽快公布于本平台</li> 
                         
                           
          </ul>
                
        </div>
        <input name="action" type="hidden" value="addProject">
        <button class="btn_all_submit">确认提交</button>
        
        
</form>
<?php include_once("footer.php"); ?>