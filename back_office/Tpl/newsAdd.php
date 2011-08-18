

<?php include_once('header.php'); ?>



<script language="javascript" type="text/javascript" src="/back_office/Tpl/public/My97DatePicker/WdatePicker.js"></script>
<script language="javascript" type="text/javascript" src="../js/jquery.min142.js"></script>

<script charset="utf-8" src="editor/kindeditor-min.js"></script>
		<script>
			KE.show({
				id : 'content',
			});
</script>


新闻添加:<br />

<form action="news.php?action=doAdd" method="post" style="margin:15px; clear:both;">

<div class="input_item">
	<h3>标题</h3><label><input name="title" type="text" class="input_text_normal"  /></label>
</div>


<!-- <div class="input_item">
	<h3>来源</h3><label><input name="source" type="text" class="input_text_normal"  /></label>
</div>

<div class="input_item">
	<h3>类型</h3><label><select name="type">
	    <option value="1">新闻</option>
	    <option value="2">媒体</option>
	    <option value="3">专题</option>
	</select></label>(选择"专题"类型时请注意内容为链接地址)
</div> -->

<div class="input_item"><h3>内容</h3>
    <label>
        <textarea name="content"  id="content" style="width:700px;height:300px;"></textarea>
    </label>
</div>

<div class="input_item">
	<h3>发布时间</h3><label><input name="datetime" type="text"  class="input_text_normal" id="datetime" onClick="WdatePicker()"/></label>

</div>

<br />
<br />
<input name="" type="submit" value="新增新闻" class="button_normal" />

</form>


</body>
</html>