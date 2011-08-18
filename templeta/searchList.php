<?php include_once("head.php"); ?>


<script type="text/javascript" language="JavaScript" src="js/jquery-1.6.2.min.js?version=162"></script>
<script>
    	function getloginfo(com_code,nu){
        	//清空目标内容
			$('#logical_info').empty(); 
			$('#logical_info').show();
			
			$.ajax({  
			   type: "GET", 
			   url : "ajax_log_info.php",
			   dataType:'html',
			   data:  'com='+com_code+'&nu='+nu+'&show=3'+'&sid='+'<?php  echo session_id();?>',
			  // data:  'com='+com_code+'&nu='+nu+'&show=3',
			   success: function(data){
				   //alert('get!');
					$('#logical_info').html(data); 
						},
				error: function(data){
				   alert('Error loading '+data);  
				}
			});
			
        }

</script>


<?php
  	if(!empty($list)){
?>
		
	<table class="search_result">
    <tr>
        <th>查询条件 : <span class="greenfont">
		<?php  
		if(!empty($_GET['user_name'])){ echo $_GET['user_name'];}
		if(!empty($_GET['contact'])){ echo ' / '.$_GET['contact'];}
		if(!empty($_GET['address'])){ echo ' / '.$_GET['address'];}
		if(!empty($_GET['nu'])){ echo ' / '.$_GET['nu'];}
		?></span>
        </th>
        <th>检索到结果  <?php echo count($list); ?> 条, <a href="search.php">重新查询</a></th>
    </tr>	
		
<?php		
     foreach($list as $key_d => $value_d) {
?>
<tr>
        <td class="content">
		联系人: <?=$value_d['cname']?> / 捐助图书数量 <?=$value_d['quantity']?> 本 / 联系方式: <?=$value_d['contact']?> <br />
        提交时间: <?=$value_d['add_time']?> /  寄送方式: <?=$value_d['ctype']==1?'总部调配':'直接寄送'?> / 物流公司代号: <?=$value_d['logistics_ccode']?> / 物流单号: <?=$value_d['logistics_num']?> / <a href="#" onclick="getloginfo('<?=$value_d['logistics_ccode']?>','<?=$value_d['logistics_num']?>');">物流查询</a>
        
        	<div id="logical_info">1321312</div>
        	<!--附言 -->
            <div class="desc">提示: <br /><?=$value_d['description']?></div>
        
        </td>
          <td class="state">
          	<div class="deal_state_<?php echo $value_d["deal_state"];?>"></div>
          	<?php
				if(!empty($value_d['description'])){
					echo "收货时间: ".$value_d['received_time'].'<br />'; 
				}
				
				if(!empty($value_d['send_time'])){
					echo "出库时间: ".$value_d['send_time'].'<br />'; 
				}
			
			?>
          </td>

    </tr>
<?php }

	}else{		//空的搜索结果提示
?>

<table class="search_result">
    <tr>
        <th>查询条件 : <span class="greenfont">
		<?php  
		if(!empty($_GET['user_name'])){ echo $_GET['user_name'];}
		if(!empty($_GET['contact'])){ echo ' / '.$_GET['contact'];}
		if(!empty($_GET['address'])){ echo ' / '.$_GET['address'];}
		if(!empty($_GET['nu'])){ echo ' / '.$_GET['nu'];}
		?></span> 如果您对查询的结果存在疑问, 请直接联系我们
        </th>
        <th>没有检索到相关的结果, 请重新查询</th>
    </tr>			

<?php	}?>
</table>
<br />
<?=$cpage_html?>




<?php include_once("footer.php"); ?>