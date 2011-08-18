
<?php 
include_once('header.php');

$article_type = array(1=>'企业动态', 2=>'媒体报道', 3=>'专题');

?>


<div style="padding:15px;">
<a href="news.php?action=add" class="link_orange">[添加新闻]</a><br>


<table width="850" border="1" class="date_table">
    <tr>
        <th>ID</th>
        <th>标题</th>
        <th>内容(前30字预览)</th>
        <!-- <th>类型</th> -->
        <th>显示状态</th>
        <th>发布时间</th>
        <th>操作</th>
    </tr>
    
  <?php
  	if(!empty($list))
     foreach($list as $key_news => $value_news) {
?>
<tr>
        <td><?=$value_news['id']?></td>
          <td><?=$value_news['title']?></td>
          <td><?=substr(strip_tags($value_news['content']),0,30)?></td>
         <!--  <td><?php  echo $article_type[$value_news['type']] ?></td> -->
          <td><?=$value_news['state']=='1'?'显示':'隐藏'  ?></td>
         <td><?=$value_news['date']?></td>
          <td><a href="news.php?id=<?=$value_news['id']?>&action=edit" class="link_orange">编辑</a> / <a href="news.php?id=<?=$value_news['id']?>&action=del" class="link_orange" onclick="return confirm('确定删除?')">删除</a></td>
    </tr>
<?php }?>
</table>
<br />
<?=$cpage_html?>
</div>


</body>
</html>