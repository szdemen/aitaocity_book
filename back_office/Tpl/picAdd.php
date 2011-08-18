

<?php include_once('header.php'); ?>



<script language="javascript" type="text/javascript" src="/back_office/Tpl/public/My97DatePicker/WdatePicker.js"></script>
<script language="javascript" type="text/javascript" src="../js/jquery-1.6.min.js"></script>
<script src="../js/jquery.MultiFile.js" type="text/javascript" language="javascript"></script> 
<SCRIPT LANGUAGE="JavaScript">

	$(function(){ // wait for document to load 
	$('#pic_url').MultiFile({ 
	max: 10, 
	accept: 'jpg' ,
	STRING: { 	remove: '<img src="/images/delete_b.gif" height="16" width="16 alt="删除此项目"/>' 	} 
	}); 
	});
</SCRIPT>
图片添加:<br />

<form action="pic.php?action=doAdd" method="post" style="margin:15px; clear:both;" enctype="multipart/form-data">

<div class="input_item">
	<?php if(empty($_GET['album_id'])){?>
	<h3>标题</h3><label><input name="title" type="text" class="input_text_normal"  /></label>
    <?php }else{?>
    <h3> </h3><label>现添加图片至相册ID为: <?php echo $_GET['album_id']; ?> 的相册中.</label>
    <?php }?>
</div>


<div class="input_item">
	<h3>上传图片</h3><label><input name="pic_url[]" type="file"  id="pic_url" style="border: solid 1px #0099ff; "/>(只接受jpg文件, 可多次重复多选, 上限为10张图片)</label>

</div>

<br />
<br />
<input name="" type="submit" value="新增图片" class="button_normal"  style="clear:both; float:left;"/>
<input name="album_id" type="hidden" value="<?php echo $_GET['album_id']; ?>" />
</form>


</body>
</html>