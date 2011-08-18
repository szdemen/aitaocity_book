

<?php include_once('header.php'); ?>



主页图片替换:<br />

<form action="index_pic.php?action=doAdd" method="post" style="margin:15px; clear:both;" enctype="multipart/form-data">

<div class="input_item">
	
    <h3>主页大图</h3><label>注意上传尺寸必须为: 宽1000px, 高380px</label>
</div>


<div class="input_item">
	<h3>上传图片</h3><label><input name="pic_url" type="file"  id="pic_url" style="border: solid 1px #0099ff; "/>(只接受jpg文件)</label>

</div>

<br />
<br />
<input name="" type="submit" value="上传图片" class="button_normal"  style="clear:both; float:left;"/>
</form>


</body>
</html>