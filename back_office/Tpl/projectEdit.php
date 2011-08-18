
<?php include_once('header.php'); ?>


<script language="javascript" type="text/javascript" src="Tpl/Public/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="js/hxeditor/xheditor-1.1.9-zh-cn.min.js"></script>

<script>
 $(document).ready(function() {
   	$('#description').xheditor({upImgUrl:"../upload.php",upImgExt:"jpg,jpeg,gif,png"});
	$('#need').xheditor();
	$('#result').xheditor();
 });
</script>
项目内容编辑:<br />

<form action="project.php?action=doEdit" method="post" style="margin:15px; clear:both;">

<div class="input_item">
	<h3>项目名称</h3><label><input name="pname" type="text" class="input_text_normal"  value="<?php echo $project_item['pname']; ?>"/></label>
</div>

<div class="input_item">
	<h3>项目小图</h3><label><input name="img_url" type="text" class="input_text_normal"  value="<?php echo $project_item['img_url']; ?>"/> size 65*65</label>
</div>


<div class="input_item">
	<h3>联系人</h3><label><input name="cname" type="text"  class="input_text_normal" value="<?php echo $project_item['cname']; ?>" /></label>
</div>

<div class="input_item">
	<h3>联系方式</h3><label><input name="contact" type="text"  class="input_text_normal" value="<?php echo $project_item['contact']; ?>" /></label>
</div>

<div class="input_item">
	<h3>地址</h3><label><input name="address" type="text"  class="input_text_normal" value="<?php echo $project_item['address']; ?>" /></label>
</div>




<div class="input_item">
	<h3>排序固顶</h3><label>
    	<input name="istop" type="checkbox" value="1" <?php if($project_item['istop']=='1') echo 'checked="checked"'; ?> /></label>
</div>



<div class="input_item"><h3>介绍</h3>
    <label>
        <textarea name="description"  id="description" style="width:880px;height:500px;"><?php echo $project_item['description']; ?></textarea>
    </label>
</div>

<div class="input_item"><h3>需求</h3>
    <label>
        <textarea name="need"  id="need" style="width:880px;height:500px;"><?php echo $project_item['need']; ?></textarea>
    </label>
</div>


<div class="input_item"><h3>跟进情况</h3>
    <label>
        <textarea name="result"  id="result" style="width:880px;height:500px;"><?php echo $project_item['result']; ?></textarea>
    </label>
</div>


<div class="input_item">
	<h3>添加时间</h3><label><input name="add_time" type="text" disabled="disabled"  class="input_text_normal" value="<?php echo $project_item['add_time']; ?>" /></label>
</div>


<div class="input_item">
	<h3>显示状态</h3><label><select name="state">
	    <option value="1" <?php if($project_item['state']=='1') echo 'selected'; ?>>显示</option>
	    <option value="0" <?php if($project_item['state']=='0') echo 'selected'; ?> >隐藏</option>
	</select></label>
</div>


<input name="pid" type="hidden" value="<?php echo $project_item['pid']; ?>">
<br />
<br />
<input name="" type="submit" value="保  存" class="button_normal" />&nbsp;&nbsp;<input name="" type="button" value="放弃修改, 返回" class="button_normal" onclick="history.go(-1)" />


</form>






</body>
</html>