
<?php include_once('header.php'); ?>


<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

<script language="javascript" type="text/javascript" src="Tpl/Public/My97DatePicker/WdatePicker.js"></script>

下载项目编辑:<br />

<form action="download.php?action=doEdit" method="post" style="margin:15px; clear:both;">


<div class="input_item">
	<h3>标题</h3><label><input name="d_name" type="text" class="input_text_normal"  value="<?php echo $down['d_name']; ?>"/></label>
</div>

<div class="input_item">
    <h3>简介</h3>
    <label>
        <textarea name="d_desc" cols="160" rows="15"  id="d_desc" ><?php echo $down['d_desc']; ?></textarea>
    </label>
</div>

<div class="input_item">
	<h3>链接地址</h3><label><input name="d_url" type="text" class="input_text_normal"  value="<?php echo $down['d_url']; ?>"/></label>请输入绝对地址
</div>


<div class="input_item">
	<h3>文件体积</h3><label><input name="d_size" type="text" class="input_text_normal"  value="<?php echo $down['d_size']; ?>"/></label>如"20MB"
</div>

<div class="input_item">
	<h3>排序</h3><label><input name="d_order" type="text" class="input_text_normal"   value="<?php echo $down['d_order']; ?>"/></label> 0-255, 数字越大排序越前
</div>

<div class="input_item">
	<h3>所属产品分类</h3><label><select name="cate_id">
    	<?php 
			if(!empty($cate))
			foreach($cate as $key_cate => $val_cate){
		?>
	    <option value="<?=$val_cate['cate_id']?>" <?=$val_cate['cate_id']==$down['cate_id']?'selected':''?>><?=$val_cate['name']?></option>
        <?php }?>
	</select></label>
</div>


<div class="input_item">
	<h3>Tag</h3><label><input name="d_tag" type="text" class="input_text_normal"   value="<?php echo $down['d_tag']; ?>"/></label>
用于相关性搜索结果,请用空格分开关键字</div>



<div class="input_item">
	<h3>发布时间</h3><label><input name="datetime" type="text"  class="input_text_normal" id="datetime" onClick="WdatePicker()" value="<?php echo $down['datetime']; ?>"/></label>
</div>






<div class="input_item">
	<h3>显示状态</h3><label><select name="state">
	    <option value="1" <?php if($down['state']=='1') echo 'selected'; ?>>显示</option>
	    <option value="0" <?php if($down['state']=='0') echo 'selected'; ?> >隐藏</option>
	</select></label>
</div>


<input name="d_id" type="hidden" value="<?php echo $down['d_id']; ?>">
<br />
<br />
<input name="" type="submit" value="保存" class="button_normal" />&nbsp;&nbsp;<input name="" type="button" value="放弃修改, 返回" class="button_normal" onclick="history.go(-1)" />


</form>


</body>
</html>