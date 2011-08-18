
<?php include_once('header.php'); ?>


<script language="javascript" type="text/javascript" src="Tpl/Public/My97DatePicker/WdatePicker.js"></script>
<script charset="utf-8" src="editor/kindeditor-min.js"></script>
		<script>
			KE.show({
				id : 'memo',
			});
</script>

<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="js/tbox/thickbox-compressed.js"></script>
<link rel="stylesheet" href="js/tbox/thickbox.css" type="text/css" media="screen" />

捐赠单编辑:<br />

<form action="donate.php?action=doEdit" method="post" style="margin:15px; clear:both;">

<div class="input_item">
	<h3>捐赠单号</h3><label><input name="title" type="text" class="input_text_normal"  value="<?php echo $donate_item['cid']; ?>" readonly="readonly"/></label>
</div>


<div class="input_item">
	<h3>联系人</h3><label><input name="user_name" type="text"  class="input_text_normal" value="<?php echo $donate_item['cname']; ?>" /></label>
</div>

<div class="input_item">
	<h3>联系方式</h3><label><input name="contact" type="text"  class="input_text_normal" value="<?php echo $donate_item['contact']; ?>" /></label>
</div>

<div class="input_item">
	<h3>运输方式</h3><input name="logical_type" type="radio" value="1" <?php if($donate_item['ctype']=='1') echo 'checked="checked"'; ?>/>总部调配<input name="logical_type" type="radio" value="2" <?php if($donate_item['ctype']=='2') echo 'checked="checked"'; ?> />自行运输
</div>


<div class="input_item">
	<h3>发货地址</h3><label><input name="address" type="text"  class="input_text_normal" value="<?php echo $donate_item['address']; ?>" /></label>
</div>

<div class="input_item">
	<h3>本数</h3><label><input name="quantity" type="text"  class="input_text_normal" value="<?php echo $donate_item['quantity']; ?>" /></label>
</div>

<div class="input_item">
	<h3>重量</h3><label><input name="weight" type="text"  class="input_text_normal" value="<?php echo $donate_item['weight']; ?>" />kg</label>
</div>

<div class="input_item">
	<h3>费用</h3><label><input name="cost" type="text"  class="input_text_normal" value="<?php echo $donate_item['cost']; ?>" /></label>
</div>

<div class="input_item">
	<h3>到付</h3><label>
    	<input name="pay_who" type="checkbox" value="1" <?php if($donate_item['pay_who']=='1') echo 'checked="checked"'; ?> /> 取消打勾为对方已付</label>
</div>



<div class="input_item"><h3>用户备注内容</h3>
    <label>
        <textarea name="memo"  id="memo" style="width:700px;height:100px;"><?php echo $donate_item['memo']; ?></textarea>
    </label>
</div>

<div class="input_item"><h3>我们对其的批注</h3>
    <label>
        <textarea name="desc"  id="desc" style="width:700px;height:100px;"><?php echo $donate_item['description']; ?></textarea>
    </label>
</div>


<div class="input_item">
	<h3>收货时间</h3><label><input name="received_time" type="text"  class="input_text_normal" value="<?php echo $donate_item['received_time']; ?>" onClick="WdatePicker()"/></label>
</div>

<div class="input_item">
	<h3>总部发出时间</h3><label><input name="send_time" type="text"  class="input_text_normal" value="<?php echo $donate_item['send_time']; ?>" onClick="WdatePicker()"/></label>
</div>

<div class="input_item">
	<h3>物流公司</h3><label><input name="logistics_ccode" type="text"  class="input_text_normal" value="<?php echo $donate_item['logistics_ccode']; ?>" /></label>
</div>

<div class="input_item">
	<h3>运单号码</h3><label><input name="logistics_num" type="text"  class="input_text_normal" value="<?php echo $donate_item['logistics_num']; ?>" /></label>
</div>


<div class="input_item">
	<h3>显示状态</h3><label><select name="state">
	    <option value="1" <?php if($donate_item['state']=='1') echo 'selected'; ?>>显示</option>
	    <option value="0" <?php if($donate_item['state']=='0') echo 'selected'; ?> >隐藏</option>
	</select></label>
</div>

<div class="input_item">
	<h3>处理状态</h3><label><select name="deal_state">
	    <option value="1" <?php if($donate_item['deal_state']=='1') echo 'selected'; ?>>途中</option>
	    <option value="2" <?php if($donate_item['deal_state']=='2') echo 'selected'; ?> >在库</option>
        <option value="3" <?php if($donate_item['deal_state']=='3') echo 'selected'; ?>>已发</option>
	    <option value="4" <?php if($donate_item['deal_state']=='4') echo 'selected'; ?> >已抵达</option>
	</select></label>
</div>




<input name="cid" type="hidden" value="<?php echo $donate_item['cid']; ?>">
<br />
<br />
<input name="" type="submit" value="保存" class="button_normal" />&nbsp;&nbsp;<input name="" type="button" value="放弃修改, 返回" class="button_normal" onclick="history.go(-1)" />


</form>

<hr />
书单内容, 总计数量 <?=$book_all_num[0]['nu']?> 本


<div style="padding:20px;">
<table width="800" border="1" class="date_table">
    <tr>
        <th>书籍ID</th>
        <th>ISBN</th>
        <th>书名</th>
        <th>数量</th>
        <th>添加时间</th>
        <th>书籍状态</th>
        <th>操作</th>
    </tr>
    
  <?php
  	if(!empty($book_list))
     foreach($book_list as $key_b => $value_b) {
?>
<tr>
      <td><?=$value_b['id']?></td>
      <td><?=$value_b['isbn']?></td>
      <td><?=$value_b['bookname']?></td>
      <td><?=$value_b['quantity']?></td>
      <td><?=$value_b['add_time']?></td>
      <td><?=$value_b['state']=='1'?'正常':'<span style="color:red">资料错误</span>'  ?></td>
      <td><a href="donate.php?id=<?=$value_b['id']?>&action=bookedit&height=170&width=400" class="link_orange thickbox" >编辑</a> / <a href="donate.php?id=<?=$value_d['id']?>&action=delbook" class="link_orange" onclick="return confirm('确定删除?')">删除</a></td>
    </tr>
<?php }?>
</table>

<?php echo $cpage; ?>

<hr style="margin:10px;" />
<form action="donate.php?action=addOnebook" method="post" style="margin:15px; clear:both;">
添加单独一本书
<div class="input_item">	<h3>ISBN</h3><label><input name="isbn" type="text" class="input_text_normal"  value="" /></label></div>
<div class="input_item">	<h3>书名</h3><label><input name="bookname" type="text" class="input_text_normal"  value="" /></label></div>
<div class="input_item">	<h3>数量</h3><label><input name="quantity" type="text" class="input_text_normal"  value="" /></label></div>

<input name="cid" type="hidden" value="<?php echo $donate_item['cid']; ?>">
<br />
<br />
<input name="" type="submit" value="添加" class="button_normal" />
</form>

<hr style="margin:10px;" />
<form action="donate.php?action=addBatchbook" method="post" style="margin:15px; clear:both;">
批量添加书籍(样式为isbn,数量  使用换行分割)<br />
<label>
    <textarea name="bookbatch"  id="desc" style="width:500px;height:300px;"></textarea>
</label>

<input name="cid" type="hidden" value="<?php echo $donate_item['cid']; ?>">
<br />
<br />
<input name="" type="submit" value="批量添加" class="button_normal" />
</form>

</div>



</body>
</html>