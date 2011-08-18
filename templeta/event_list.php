<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>我发布的活动 - 去耍网 </title>

<link href="../css/css_reset.css" rel="stylesheet" type="text/css" />
<link href="../css/global.css" rel="stylesheet" type="text/css" />

<script src="../js/jquery-1.4.min.js" type="text/javascript"></script>

<script>
$(document).ready(function(){  
	$("table tr:not(:first):odd").addClass("tableGreenBc");
}); 
</script>

<style>
.title{ font-size:14px; font-weight:bold}
.input{ margin:10px 0;}
.input .item_left{ display:inline-block; width:140px; text-align:right; font-size:14px; line-height:16px;}
.input li input{ width:250px; height:25px; margin-left:15px; font-size:18px;font-family:Tahoma, Geneva, sans-serif; }
.input li textarea{width:730px; height:335px;  }
#xhe0_container{ margin-left:15px;}
.input li{ margin-bottom:10px;}
.input li p{ margin-bottom:20px;}
#radio{ width:25px; height:25px; vertical-align: middle;}
</style>

</head>

<body>
<div id="warpper">
    
    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/top_bar.php');?>
             
    <div class="content_all" style="padding:20px; width:960px;">
        <fieldset style="background-color:#FFF; border:solid 1px #b0bb0b;"><legend class="title" style="background-color:#FFF; border:solid 1px #b0bb0b; margin-left:50px; padding:3px;">我发布的活动</legend>
        
        	<table width="850" border="1" style="margin:15px auto;" class="table">
              <tr>
                <th>活动唯一编号</th>
                <th>活动标题</th>
                <th>活动时间</th>
                <th>发布时间</th>
                <th>操作</th>
              </tr>
              <?php
					if(!empty($elist))
					 foreach($elist as $key_e => $value_e) {
				?>
              <tr>
                <td><?php echo sprintf("%03d", $value_e['id']);?></td>
                <td><a href="event.php?action=viewEvent&id=<?php echo $value_e['id']?>"  class="bk"><?php echo $value_e['name']?></a></td>
                <td><?php echo $value_e['target_time']?></td>
               <td><?php echo $value_e['add_time']?></td>
                <td><a href="event.php?action=viewEdit&id=<?php echo $value_e['id']?>" class="bk">[编辑]</a>/ 
				<?php if($value_e['state']=='1'){ 
					echo "<a href='/event.php?action=changeState&id=".$value_e['id']."&changeto=0' class='stateOn'></a>";
				}
				else{
					 echo "<a href='/event.php?action=changeState&id=".$value_e['id']."&changeto=1' class='stateOff'></a>";
				}
				?>
                </td>
              </tr>
              <?php }?>
            </table>
		
        <br />
		<?php echo $cpage_html?>
        
        
        </fieldset>
        
    </div>
    
    
    
    
</div><!--//warpper -->
</body>
</html>