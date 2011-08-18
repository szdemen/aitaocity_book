
<?php include_once('header.php'); ?>


<div style="padding:15px;">
<a href="download.php?" class="link_orange">[返回下载列表]</a>&nbsp;&nbsp;&nbsp;<a href="download.php?action=addCate" class="link_orange">[添加分类]</a><br>


<table width="800" border="1" class="date_table">
    <tr>
        <th>ID</th>
        <th>名称</th>
        <th>显示状态</th>
        <th>排序</th>
        <th>操作</th>
    </tr>
    
  <?php
  	if(!empty($list))
     foreach($list as $key_down => $value_down) {
?>
<tr>
        <td><?=$value_down['cate_id']?></td>
          <td><?=$value_down['name']?></td>
          <td><?=$value_down['state']=='1'?'显示':'隐藏'  ?></td>
         <td><?=$value_down['c_order']?></td>
          <td><a href="download.php?cate_id=<?=$value_down['cate_id']?>&action=editCate" class="link_orange">编辑</a> / <a href="download.php?cate_id=<?=$value_down['cate_id']?>&action=delCate" class="link_orange" onclick="return confirm('确定删除?')">删除</a></td>
    </tr>
<?php }?>
</table>
<br />

</div>


</body>
</html>