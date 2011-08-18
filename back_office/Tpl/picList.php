
<?php 
include_once('header.php');

$article_type = array(1=>'企业动态', 2=>'媒体报道', 3=>'专题');

?>


<div style="padding:15px;">
<a href="pic.php?action=add" class="link_orange">[添加新相册]</a><br>
<?php foreach($list as $akey => $avalue){?>

<fieldset><legend><?php echo $avalue['name']; ?></legend>
    <ul class="pic_list">  
      <?php
        if(!empty($album))
         foreach($album[$avalue['id']] as $key_pic => $value_pic) {
    ?>
            <li><img src="/upload/thumb/<?=$value_pic['url']?>?<?php echo  time(); ?>" /><br /><a href="pic.php?id=<?=$value_pic['id']?>&action=thumbremake&url=<?=$value_pic['url']?>" class="link_orange">重设小图</a> /<a href="pic.php?id=<?=$value_pic['id']?>&action=del" class="link_orange" onclick="return confirm('确定删除?')">删除</a></li>
    
    <?php }?>
    <li><a href="pic.php?action=add&album_id=<?php echo $avalue['id']; ?>">追加图片至此相册</a></li>
    </ul>
</fieldset>
<?php }?>


<br />
<?=$cpage_html?>
</div>


</body>
</html>