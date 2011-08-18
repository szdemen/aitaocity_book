<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $event['name']; ?> - 去耍网 </title>

<link href="/css/css_reset.css" rel="stylesheet" type="text/css" />
<link href="/css/global.css" rel="stylesheet" type="text/css" />

<script src="/js/jquery-1.4.min.js" type="text/javascript"></script>

</head>

<body>
<div id="warpper">
    <?php include_once($_SERVER['DOCUMENT_ROOT'].'/top_bar.php');?>
    
    <div class="content_all">
    
    <div class="left">
    	<div class="event">
        
        	<div class="box_left">
            	<span class="pop">发起活动</span>
            	<img src="/user_upload/user_header_<?php echo $maker['uid']; ?>.jpg" class="user_head" onerror="javascript:this.src='/user_upload/error.gif'"/>
                <span class="name"><?php echo $maker['name']; ?></span>
                <span class="afford">活动费用方式: <br />
                <?php if($event['afford']==1){?>
                <img src="/images/tag_aa_payment.png" class="payment_tag"><br />AA制度
                <?php }else if($event['afford']==2){?>
                <img src="/images/tag_ipay_payment.png" class="payment_tag"><br />爷请客
                <?php }else{?>
                <img src="/images/tag_yes_payment.png" class="payment_tag"><br />东主有请
                <?php }?>
                </span>
                <span class="btn"><button class="come"></button><button class="not_come"></button></span>
            </div>
            
            <div class="box_right">
            	
            <h2 class="title"><?php echo $event['name']; ?><span class="come_num">+<?php echo $event['num_togo']; ?></span></h2>
                <span class="item"><em>时间:</em><?php echo $event['target_time']; ?> (星期5)</span>
                <span class="item"><em>地点:</em><?php echo $event['site']; ?></span>
                <span class="content"><?php echo $event['content']; ?></span>
                
                <span class="item"><em>报名情况:</em>
                	<ul class="user_list">
                    	<?php
							if(!empty($ticket))
							 foreach($ticket as $key_t => $value_t) {
						?>
                    	<li><?php if(0==$value_t['isgo']){?><img src="/images/tag_ohshit.png" class="ohshit"><?php }?><img src="/user_upload/user_header_<?php echo $value_t['uid']; ?>.jpg" width="40" height="40" onerror="javascript:this.src='/user_upload/error.gif'"/><br /><?php echo $value_t['name']; ?></li>
                        <?php } ?>
                	</ul>
                </span>
            </div>
            
        </div>
        <!--//event -->
        
    </div>
    <!--//left -->
    
    
	<div class="right">
    	<p>您正在查看单独的活动</p>
		<!-- JiaThis Button BEGIN -->
<script type="text/javascript" src="http://v2.jiathis.com/code/jiathis_r.js?type=left&amp;move=0&amp;btn=l1.gif" charset="utf-8"></script>
<!-- JiaThis Button END -->
        <hr class="line" />
        <p>创建您自己的活动非常简单</p>
        <p>
        <ul class="setup">
        	<li class='setup1 setup_all'>先注册或者登陆, 点击导航条的“添加活动”</li>
            <li class='setup2 setup_all'>填写活动的相关信息,例如活动时间,集合地点,活动内容,收费方式等资料</li>
            <li class='setup3 setup_all'>发布! 发送大家地址来参与~ 就是这么简单~</li>
        </ul>
        </p>
    </div>
    <!--//right -->
    
    </div>
    <!--//content_all -->
    
</div>
</body>
</html>