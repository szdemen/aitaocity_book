
<?php 
include_once('header.php');

$donate_type = array(1=>'书籍');

?>


<div style="padding:15px;">
<!--<a href="news.php?action=add" class="link_orange">[添加新闻]</a> --><br>

<div style="padding:10px; margin:0 0 15px 0;">
    <form action="project.php" method="get">
    	<fieldset><legend>搜索</legend>
        		联系人 <input name="cname" type="text" value="<?=$_GET["cname"]?>" />
                联系方式	<input name="contact" type="text"  value="<?=$_GET["contact"]?>" />
                地址	<input name="address" type="text"  value="<?=$_GET["address"]?>" />
               项目名称<input name="pname" type="text"  value="<?=$_GET["pname"]?>" />
                 <input name="" type="submit" value="search" />
        		<input name="action" type="hidden" value="search" />
        </fieldset>
    	
    </form>
    
</div>

<table width="1000" border="1" class="date_table">
    <tr>
        <th>编号</th>
        <th>项目名称</th>
        <th>联系人</th>
        <th>联系方式</th>
        <th>地址</th>
        <th>发布时间</th>
        <th>TOP</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    
  <?php
  	if(!empty($list))
     foreach($list as $key_d => $value_d) {
?>
<tr>
        <td><?=str_pad($value_d['pid'],7,'0',STR_PAD_LEFT)?></td>
          <td><?=$value_d['pname']?></td>
          <td><?=$value_d['cname']?></td>
          <td><?=$value_d['contact']?></td>
          <td><?=$value_d['address']?>kg</td>
         <td><?=$value_d['add_time']?></td>
         <td><?=$value_d['istop']=='1'?'TOP':'-'  ?></td>
         <td><?=$value_d['state']=='1'?'显示':'<span style="color:red">隐藏</span>'  ?></td>
          <td><a href="project.php?pid=<?=$value_d['pid']?>&action=edit" class="link_orange">编辑</a> / <a href="project.php?id=<?=$value_d['pid']?>&action=del" class="link_orange" onclick="return confirm('确定删除?')">删除</a></td>
    </tr>
<?php }?>
</table>
<br />
<?=$cpage_html?>
</div>


</body>
</html>