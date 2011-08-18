
<?php include_once('header.php'); ?>


<script language="javascript" type="text/javascript" src="Tpl/Public/My97DatePicker/WdatePicker.js"></script>
<script charset="utf-8" src="editor/kindeditor-min.js"></script>
		<script>
			KE.show({
				id : 'content',
			});
</script>

新闻编辑:<br />

<form action="news.php?action=doEdit" method="post" style="margin:15px; clear:both;">

<div class="input_item">
	<h3>标题</h3><label><input name="title" type="text" class="input_text_normal"  value="<?php echo $news_item['title']; ?>"/></label>
</div>

<!-- <div class="input_item">
	<h3>来源</h3>
	<label><input name="source" type="text" class="input_text_normal"  value="<?php echo $news_item['source']; ?>"/></label>
</div>


<div class="input_item">
	<h3>类型</h3><label><select name="type">
	    <option value="1" <?=(1==$news_item['type'])?' selected ':''?>>新闻</option>
	    <option value="2" <?=(2==$news_item['type'])?' selected ':''?>>媒体</option>
	    <option value="3" <?=(3==$news_item['type'])?' selected ':''?>>专题</option>
	</select></label>(选择"专题"类型时请注意内容为链接地址)
</div> -->


<div class="input_item"><h3>内容</h3>
    <label>
        <textarea name="content"  id="content" style="width:700px;height:300px;"><?php echo $news_item['content']; ?></textarea>
    </label>
</div>


<div class="input_item">
	<h3>发布时间</h3><label><input name="datetime" type="text"  class="input_text_normal" value="<?php echo $news_item['date']; ?>" onClick="WdatePicker()"/></label>
</div>


<div class="input_item">
	<h3>显示状态</h3><label><select name="state">
	    <option value="1" <?php if($news_item['state']=='1') echo 'selected'; ?>>显示</option>
	    <option value="0" <?php if($news_item['state']=='0') echo 'selected'; ?> >隐藏</option>
	</select></label>
</div>


<input name="id" type="hidden" value="<?php echo $news_item['id']; ?>">
<br />
<br />
<input name="" type="submit" value="保存" class="button_normal" />&nbsp;&nbsp;<input name="" type="button" value="放弃修改, 返回" class="button_normal" onclick="history.go(-1)" />


</form>


</body>
</html>