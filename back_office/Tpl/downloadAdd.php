

<?php include_once('header.php'); ?>



<script language="javascript" type="text/javascript" src="Tpl/Public/My97DatePicker/WdatePicker.js"></script>

<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>


下载项目添加:<br />

<form action="download.php?action=doAdd" method="post" style="margin:15px; clear:both;">

<div class="input_item">
	<h3>标题</h3><label><input name="d_name" type="text" class="input_text_normal"  /></label>
</div>

<div class="input_item">
    <h3>简介</h3>
    <label>
        <textarea name="d_desc" cols="160" rows="15"  id="content" ></textarea>
    </label>
</div>

<div class="input_item">
	<h3>链接地址</h3><label><input name="d_url" type="text" class="input_text_normal"  /></label>请输入绝对地址
</div>


<div class="input_item">
	<h3>文件体积</h3><label><input name="d_size" type="text" class="input_text_normal"  /></label>如"20MB"
</div>

<div class="input_item">
	<h3>排序</h3><label><input name="d_order" type="text" class="input_text_normal"  value="0" /></label> 0-255, 数字越大排序越前
</div>

<div class="input_item">
	<h3>所属产品分类</h3><label><select name="cate_id">
    	<?php 
			if(!empty($cate))
			foreach($cate as $key_cate => $val_cate){
		?>
	    <option value="<?=$val_cate['cate_id']?>"><?=$val_cate['name']?></option>
        <?php }?>
	</select></label>
</div>


<div class="input_item">
	<h3>Tag</h3><label><input name="d_tag" type="text" class="input_text_normal"  /></label>
用于相关性搜索结果,请用空格分开关键字</div>



<div class="input_item">
	<h3>发布时间</h3><label><input name="datetime" type="text"  class="input_text_normal" id="datetime" onClick="WdatePicker()"/></label>
</div>





<br />
<br />
<input type="submit" value="新增下载" class="button_normal" />


</form>


</body>
</html>