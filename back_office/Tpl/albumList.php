
<?php 
include_once('header.php');

$article_type = array(1=>'企业动态', 2=>'媒体报道', 3=>'专题');

?>


<div style="padding:15px;">
<a href="pic.php?action=add" class="link_orange">[添加相册]</a><br>


<table width="850" border="1" class="date_table">
    <tr>
        <th width="133">ID</th>
        <th width="586">标题</th>
        <th width="109">操作</th>
    </tr>
    
  <?php
  	if(!empty($list))
     foreach($list as $key_news => $value_news) {
?>
<tr>
        <td><?=$value_news['id']?></td>
          <td><?=$value_news['name']?></td>
          <td><a href="album.php?id=<?=$value_news['id']?>&action=edit" class="link_orange">编辑</a> / <a href="album.php?id=<?=$value_news['id']?>&action=del" class="link_orange" onclick="return confirm('确定删除?')">删除</a></td>
    </tr>
<?php }?>
</table>
<br />
<?=$cpage_html?>
</div>


</body>
</html>