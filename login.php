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
				  
				  if(document.form.pw.value=="")
                  {
                     alert("密码不可为空");
                     document.form.pw.focus();
                     return false;
                  }
			}
</script>				  
<form action="user.php" method="post" enctype="multipart/form-data"  onsubmit="return myCheck()" name="form">
		<div class="form_wrapper">
        		<div class="form_title"><img src="images/logo_reg.gif" class="logo">欢迎登录爱淘城公益计划捐助平台<br>登录后您可以管理您的捐助信息以及跟进捐助后续情况, 若您还未有帐号, 请先<a href="/reg.php">注册</a></div>
                
                <ul class="form_item">
                		                       
            			<li><span class="form_item_name">用户名/电邮</span> <span class="form_item_input"><input name="user_name" type="text" placeholder="请填写用户名称" id="user_name"></span> 限定中文字符, 英文字符, 请勿使用特殊符号</li>
                        
                        <li><span class="form_item_name">登录密码</span> <span class="form_item_input"><input name="pw" type="password" id="pw"/></span></li>
                        
        </ul>
                
        </div>
        <input name="action" type="hidden" value="login">
        <button class="btn_all_submit">登 录</button>
        
        
</form>




<?php include_once("footer.php"); ?>