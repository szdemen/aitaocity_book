
<?php 
include_once('header.php');

$donate_type = array(1=>'书籍');

?>


<div style="padding:15px;">
<!--<a href="news.php?action=add" class="link_orange">[添加新闻]</a> --><br>

<div style="padding:10px; margin:0 0 15px 0;">
    <form action="donate.php" method="get">
    	<fieldset><legend>搜索</legend>
        		联系人 <input name="user_name" type="text" value="<?=$_GET["user_name"]?>" />
                联系方式	<input name="contact" type="text"  value="<?=$_GET["contact"]?>" />
                发货地址	<input name="address" type="text"  value="<?=$_GET["address"]?>" />
                 运单号码	<input name="nu" type="text"  value="<?=$_GET["nu"]?>" />
                 <input name="" type="submit" value="search" />
        		<input name="action" type="hidden" value="search" />
        </fieldset>
    	
    </form>
    
</div>

<table width="1000" border="1" class="date_table">
    <tr>
        <th>捐赠单号</th>
        <th>联系人</th>
        <th>联系方式</th>
        <th>书籍数量</th>
        <th>重量kg</th>
        <th>运费</th>
        <th>发货地</th>
        <th>快递公司</th>
        <th>运单</th>
        <th>备注30字</th>
        <th>发布时间</th>
        <th>状态</th>
        <th>物流状态</th>
        <th>操作</th>
    </tr>
    
  <?php
  	if(!empty($list))
     foreach($list as $key_d => $value_d) {
?>
<tr>
        <td><?=str_pad($value_d['cid'],7,'0',STR_PAD_LEFT)?></td>
          <td><?=$value_d['cname']?></td>
          <td><?=$value_d['contact']?></td>
         <!--  <td><?php  echo $donate_type[$value_d['type']] ?></td> -->
          <td><?=$value_d['quantity']?></td>
          <td><?=$value_d['weight']?>kg</td>
          <td><?=$value_d['cost']?>元</td>
          <td><?=$value_d['address']?></td>
          <td><?=$value_d['logistics_ccode']?></td>
          <td><?=$value_d['logistics_num']?></td>
          
          <td><?=substr(strip_tags($value_d['memo']),0,30)?></td>
         <td><?=$value_d['add_time']?></td>
         <td><?=$value_d['state']=='1'?'显示':'隐藏'  ?></td>
         <td>
		 	<?php if($value_d['deal_state']=='1') echo '途中'; ?>
            <?php if($value_d['deal_state']=='2') echo '在库'; ?>
            <?php if($value_d['deal_state']=='3') echo '已发'; ?>
            <?php if($value_d['deal_state']=='4') echo '抵达'; ?>         
         </td>
          <td><a href="donate.php?id=<?=$value_d['cid']?>&action=edit" class="link_orange">编辑</a> / <a href="donate.php?id=<?=$value_d['id']?>&action=del" class="link_orange" onclick="return confirm('确定删除?')">删除</a></td>
    </tr>
<?php }?>
</table>
<br />
<?=$cpage_html?>
</div>


</body>
</html>