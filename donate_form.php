<?php include_once("head.php"); ?>

<script type="text/javascript" language="JavaScript" src="js/jquery-1.6.2.min.js?version=162"></script>
<script type="text/javascript" language="JavaScript" src="js/logistics_com.js?version=1"></script>
<script type="text/javascript">

			var json =jsoncom;
  			json=json.company;
			
            function myCheck()
            {
               
                  if(document.form.user_name.value=="")
                  {
                     alert("请填写联系人名称");
                     document.form.user_name.focus();
                     return false;
                  }
				  
				  if(document.form.contact.value=="")
                  {
                     alert("联系方式不可为空");
                     document.form.contact.focus();
                     return false;
                  }
				  
				  if(document.form.quantity.value=="")
                  {
                     alert("书籍数量不可为空");
                     document.form.quantity.focus();
                     return false;
                  }
				  
				  if(document.form.weight.value=="")
                  {
                     alert("货物重量不可为空");
                     document.form.weight.focus();
                     return false;
                  }
				  
				  if(document.form.address.value=="")
                  {
                     alert("发货地址不可为空");
                     document.form.address.focus();
                     return false;
                  }
				  
				  //选了自行运输
				  if(document.form.logical_type.value=="2")
                  {
					  if(document.form.skuname.value==""){
							 alert("确认密码不可为空");
							 document.form.skuname.focus();
							 return false;
					 }
                  }
				  
				  if(document.form.com.value=="")
                  {
                     alert("运输公司不可为空");
                     document.form.com.focus();
                     return false;
                  }
				  
				   if(document.form.nu.value=="")
                  {
                     alert("运单不可为空");
                     document.form.nu.focus();
                     return false;
                  }
              
               return true;
              
            }
			
function traninput(comcode){
	//清空
	$("#com").val('');
	//find code info
	for(var j=0;j<json.length;j++){
				if(comcode==json[j].code){
					//填充运输公司名字到文本框
					$("#com").val(json[j].companyname);
					//填写运输公司代码
					$("#com_code").val(comcode);
				}
	}
	
	
}
</script>

<form action="donate.php" method="post" enctype="multipart/form-data" onsubmit="return myCheck()" name="form">
		<div class="form_wrapper">
        		<div class="form_title"><img src="images/logo_donate.gif" class="logo">非常感谢您使用爱淘城公益计划捐助平台<br>请填写以下的内容, 以便于您的捐助书籍得到更好的跟踪管理, 尽快到达孩子手中</div>
                
                <ul class="form_item">
                		<li><span class="form_item_name">捐助类型</span> <span class="form_item_input"><select name="donate_type" ><option value="1" selected>书籍</option></select></span></li>                        
                        <li><span class="form_item_name">联系人</span> <span class="form_item_input"><input name="user_name" type="text" placeholder="请填写联系人名称" id="user_name"></span></li>
                        <li><span class="form_item_name">联系方式</span> <span class="form_item_input"><input name="contact" type="text" placeholder="请填联系方式, 手机/QQ/Email" id="contact"> 联系QQ / 手机号码 / E-mail</span></li>
                        <li><span class="form_item_name">书籍数量</span> <span class="form_item_input num"><input name="quantity" type="text" placeholder="书籍本数" id="quantity"/></span></li>
                        <li><span class="form_item_name">货物重量</span> <span class="form_item_input num"><input name="weight" type="text" placeholder="货物重量" id="weight"/> kg</span></li>
                        <li><span class="form_item_name">运输方式</span> <span class="form_item_input auto">
                        		<label><input name="logical_type" type="radio" value="1" checked="checked">运输至爱淘城总部,调配后发送至学校</label><br>
                                <!--<span class="form_item_name"> </span> --><label><input name="logical_type" type="radio" value="2" id="logical_type">直接运输到有需要的学校</label>, 请输入学校名称 <input name="skuname" type="text" id="skuname"></span>
                        </li>
                        <li><span class="form_item_name">发货地址</span> <span class="form_item_input long"><input name="address" type="text" placeholder="请填发货地址" id="address"/></span></li>
                        
                        <li>
                        		<span class="form_item_name">快递公司</span> <span class="form_item_input num"><input name="com" type="text" disabled  id="com" value="点击下面选择" /><input name="com_code" type="hidden" value="" id="com_code"></span>
        <span class="form_item_name">运单号码</span> <span class="form_item_input"><input name="nu" type="text"  id="nu"/></span>
                                
                                <div style="margin:5px 0;"> 
                                	<span class="form_item_name">点击选择</span> 
                                    <span class="form_item_input lcom">
          									<strong><a href="#" onclick="traninput('ems');return false;">EMS</a></strong><strong><a href="#" onclick="traninput('shentong');return false;">申通</a></strong><strong><a href="#" onclick="traninput('yuantong');return false;">圆通</a></strong><strong><a href="#" onclick="traninput('zhongtong');return false;">中通</a></strong><strong><a href="#" onclick="traninput('huitongkuaidi');return false;">汇通</a></strong>

          									<strong><a href="#" onclick="traninput('ups');return false;">UPS</a></strong><strong><a href="#" onclick="traninput('shunfeng');return false;">顺丰</a></strong><strong><a href="#" onclick="traninput('yunda');return false;">韵达</a></strong><strong><a href="#" onclick="traninput('tiantian');return false;">天天</a></strong><strong><a href="#" onclick="traninput('zhaijisong');return false;">宅急送</a></strong>
          							</span>
          						</div>
                                
                                
                                
                        </li>
                        
                        
                        <li><span class="form_item_name">备注</span> <span class="form_item_input"><textarea name="memo" cols="" rows="" style="height:100px; width:505px; vertical-align: top;"></textarea></span></li>
                        
                </ul>
                
        </div>
        
        <input name="action" type="hidden" value="add_donate">
        <button class="btn_all_submit">确认提交</button>
</form>
<?php include_once("footer.php"); ?>