
<?php include_once('header.php'); ?>



相册编辑:<br />

<form action="album.php?action=doEdit" method="post" style="margin:15px; clear:both;">

<div class="input_item">
	<h3>标题</h3><label><input name="title" type="text" class="input_text_normal"  value="<?php echo $item['name']; ?>"/></label>
</div>


<input name="id" type="hidden" value="<?php echo $item['id']; ?>">
<br />
<br />
<input name="" type="submit" value="保存" class="button_normal" />&nbsp;&nbsp;<input name="" type="button" value="放弃修改, 返回" class="button_normal" onclick="history.go(-1)" />


</form>


</body>
</html>