<style>
.temp_bookedit_li li{display:block; margin-bottom:8px;}
.temp_bookedit_li li input{ width:310px; height:20px; font-size:16px; padding:2px;}
</style>
<form action="donate.php?action=doBookedit" method="post" style="padding:15px; clear:both;">

<ul class="temp_bookedit_li">
<li>ISBN: <input name="isbn" type="text"  value="<?php echo $book['isbn']; ?>"/></li>
<li>书名: <input name="bookname" type="text" value="<?php echo $book['bookname']; ?>"/></li>
<li>数量: <input name="quantity" type="text"    value="<?php echo $book['quantity']; ?>"/></li>
</ul>

<input name="id" type="hidden" value="<?php echo $book['id']; ?>">
<input name="" type="submit" value="保存" class="button_normal" />&nbsp;&nbsp;<input name="" type="button" value="放弃修改, 返回" class="button_normal"  onclick="tb_remove();"/>


</form>
