

<?php include_once('header.php'); ?>


分类添加:<br />

<form action="download.php?action=doAddCate" method="post" style="margin:15px; clear:both;">

<div class="input_item">
	<h3>分类名称</h3><label><input name="name" type="text" class="input_text_normal"  /></label>
</div>


<div class="input_item">
	<h3>排序</h3><label><input name="c_order" type="text" class="input_text_normal"  value="0" /></label> 0-255, 数字越大排序越前
</div>


<br />
<br />
<input type="submit" value="新增分类" class="button_normal" />


</form>


</body>
</html>