<?php include_once("head.php"); ?>


<script type="text/javascript">
            function myCheck()
            {
               
                  if(document.form.user_name.value=="")
                  {
                     alert("用户名不可为空");
                     document.form.user_name.focus();
                     return false;
                  }
				  
				  if(document.form.email.value=="")
                  {
                     alert("电邮地址不可为空");
                     document.form.email.focus();
                     return false;
                  }
				  
				  if(document.form.phone.value=="")
                  {
                     alert("联系电话不可为空");
                     document.form.phone.focus();
                     return false;
                  }
				  
				  if(document.form.pw.value=="")
                  {
                     alert("密码不可为空");
                     document.form.pw.focus();
                     return false;
                  }
				  
				  if(document.form.pw2.value=="")
                  {
                     alert("确认密码不可为空");
                     document.form.pw.focus();
                     return false;
                  }
              
               return true;
              
            }
</script>

<form action="user.php" method="post" enctype="multipart/form-data"  onsubmit="return myCheck()" name="form">
		<div class="form_wrapper">
        		<div class="form_title"><img src="images/logo_reg.gif" class="logo">欢迎注册爱淘城公益计划捐助平台<br>请全部填写以下的内容, 以便于查阅管理您的捐助书籍以及捐助计划落实情况</div>
                
                <ul class="form_item">
                		                       
            <li><span class="form_item_name">用户名</span> <span class="form_item_input"><input name="user_name" type="text" placeholder="请填写用户名称" id="user_name"></span> 限定中文字符, 英文字符, 请勿使用特殊符号</li>
                        <li><span class="form_item_name">电子邮箱</span> <span class="form_item_input"><input name="email" type="email" placeholder="Email地址" id="email"></span></li>
                        <li><span class="form_item_name">联系电话</span> <span class="form_item_input"><input name="phone" type="text" placeholder="联系电话号码" id="phone"/> 请务必填写正确有效的号码便于与您联系</span></li>
                        <li><span class="form_item_name">登录密码</span> <span class="form_item_input"><input name="pw" type="password" id="pw"/></span></li>
                        <li><span class="form_item_name">确认密码</span> <span class="form_item_input"><input name="pw2" type="password" id="pw2"/></span></li>
                       
                        
          </ul>
                
        </div>
        <input name="action" type="hidden" value="reg">
        <button class="btn_all_submit">确认提交</button>
        
        
</form>
<?php include_once("footer.php"); ?>