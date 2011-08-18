
<?php include_once('header.php'); ?>


分类编辑:<br />

<form action="download.php?action=doEditCate" method="post" style="margin:15px; clear:both;">



<div class="input_item">
	<h3>分类名称</h3><label><input name="name" type="text" class="input_text_normal"   value="<?php echo $cate['name']; ?>"/></label>
</div>


<div class="input_item">
	<h3>排序</h3><label><input name="c_order" type="text" class="input_text_normal"  value="<?php echo $cate['c_order']; ?>"/></label> 0-255, 数字越大排序越前
</div>

<div class="input_item">
	<h3>显示状态</h3><label><select name="state">
	    <option value="1" <?php if($cate['state']=='1') echo 'selected'; ?>>显示</option>
	    <option value="0" <?php if($cate['state']=='0') echo 'selected'; ?> >隐藏</option>
	</select></label>
</div>

<input name="cate_id" type="hidden" value="<?php echo $cate['cate_id']; ?>">
<br />
<br />
<input name="" type="submit" value="保存" class="button_normal" />&nbsp;&nbsp;<input name="" type="button" value="放弃修改, 返回" class="button_normal" onclick="history.go(-1)" />


</form>


</body>
</html>