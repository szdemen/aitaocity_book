<?php include_once("head.php"); ?>


<form action="search.php" method="get" enctype="multipart/form-data"  name="form">
		<div class="form_wrapper">
        		<div class="form_title"><img src="images/logo_search.gif" class="logo">请填写以下内容以检索您的捐赠情况</div>
                
                <ul class="form_item">
                		<li><span class="form_item_name">联系人</span> <span class="form_item_input"><input name="user_name" type="text" placeholder="联系人名称" id="user_name"></span></li>                        
                        <li><span class="form_item_name">联系方式</span> <span class="form_item_input"><input name="contact" type="text" placeholder="联系方式" id="contact"></span></li>
                     
                        <li><span class="form_item_name">发货地址</span> <span class="form_item_input"><input name="address" type="text" placeholder="发货地址" id="address"/></span></li>
                        <li><span class="form_item_name">运单号码</span> <span class="form_item_input"><input name="nu" type="text" placeholder="运单号码" id="nu"/></span></li>                      
                        
                </ul>
                
        </div>
        
        <input name="action" type="hidden" value="doSearch">
        <button class="btn_all_submit">搜  索</button>
</form>

<?php include_once("footer.php"); ?>