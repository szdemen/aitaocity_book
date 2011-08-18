
<?php include_once('header.php'); ?>


<div style="padding:15px;">
<a href="download.php?action=add" class="link_orange">[添加下载]</a>&nbsp;&nbsp;&nbsp;<a href="download.php?action=cateList" class="link_orange">[分类管理]</a><br>


<table width="800" border="1" class="date_table">
    <tr>
        <th>ID</th>
        <th>标题</th>
        <th>内容(预览)</th>
        <th>所属分类</th>
        <th>链接地址</th>
        <th>显示状态</th>
        <th>发布时间</th>
        <th>操作</th>
    </tr>
    
  <?php
  	if(!empty($list))
     foreach($list as $key_down => $value_down) {
?>
<tr>
        <td><?=$value_down['d_id']?></td>
          <td><?=$value_down['d_name']?></td>
          <td><?=substr(strip_tags($value_down['d_desc']),0,30)?></td>
          <td><?=$value_down['name']?></td>
          <td><a href="<?=$value_down['d_url']?>">link</a></td>
          <td><?=$value_down['state']=='1'?'显示':'隐藏'  ?></td>
         <td><?=$value_down['datetime']?></td>
          <td><a href="download.php?d_id=<?=$value_down['d_id']?>&action=edit" class="link_orange">编辑</a> / <a href="download.php?d_id=<?=$value_down['d_id']?>&action=del" class="link_orange" onclick="return confirm('确定删除?')">删除</a></td>
    </tr>
<?php }?>
</table>
<br />

</div>


</body>
</html>