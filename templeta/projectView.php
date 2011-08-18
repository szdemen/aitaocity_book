<?php include_once("head.php"); ?>

<div class="project_list">
		<div style="padding:5px;"><a href="/">&gt;主页</a> - <a href="project.php">捐助项目</a> - 查看详情 / <a href="#" onClick="history.go(-1);">返回列表</a></div>
		<ul>
        		<li>
                		<h2><span class="title"><?php echo $value_n["pname"];?></span><span class="ptime"><?php echo substr($value_n["add_time"],0,10);?></span></h2>
                        <p class="content"><?php echo $value_n["description"];?></p>
                        <p class="more"></p>
                        <p class="contact">联系人: <?php echo $value_n["cname"];?> / 联系方式: <?php echo $value_n["contact"];?> /联系地址: <?php echo $value_n["address"];?></p>
                </li>
        </ul>
        
</div>

<div class="project_rpanel">
		<div class="psearch">
        		<span class="search_title">项目搜索</span>
                <form action="project.php?action=search" method="get">
                		<input name="" type="text" class="input_text" /><input name="" type="submit" value="搜 索" class="submit" />
                </form>
        </div>
        
        <!--热门项目 -->
		<div class="top_project">
        		<div class="topp_title">这些项目急需您的爱心:</div>
        		<ul>
                <?php if(!empty($list_top)){ 
							 foreach($list_top as $key_t => $value_t) {
				?>
        		 		<li> <a href="project.php?action=view&pid=<?php echo $value_t["pid"];?>"><img src="<?=empty($value_t["img_url"])?' ':$value_t["img_url"];?>" onerror="this.src='images/img_error_pitem.gif'" alt="<?php echo $value_t["pname"];?>"/></a> <h3><?php echo $value_t["pname"];?></h3> <span><?php echo substr($value_t["add_time"],0,10);?><br /><a href="project.php?action=view&pid=<?php echo $value_t["pid"];?>">查看完整的项目内容</a> </span></li>
                <?php } }else{?>
               			<li>暂无信息</li>
                <?php }?>
                </ul>
        </div>
</div>



<!-- JiaThis Button BEGIN -->
<script type="text/javascript" src="http://v2.jiathis.com/code/jiathis_r.js?move=0&amp;btn=r1.gif" charset="utf-8"></script>
<!-- JiaThis Button END -->
<?php include_once("footer.php"); ?>