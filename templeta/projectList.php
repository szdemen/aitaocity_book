<?php include_once("head.php"); ?>




<div class="project_list">
		<ul>
        		<?php if(!empty($list_new)){ 
							 foreach($list_new as $key_n => $value_n) {
				?>
        		<li>
                		<h2><span class="title"><?php echo $value_n["pname"];?> <a href="project.php?action=view&pid=<?php echo $value_n["pid"];?>"><查看内容></a></span><span class="ptime"><?php echo substr($value_n["add_time"],0,10);?></span></h2>
                        <p class="content"><?php echo content_cut($value_n["description"], 300, 0);?> (......)</p>
                        <p class="more"><a href="project.php?action=view&pid=<?php echo $value_n["pid"];?>">查看完整的项目内容</a></p>
                        <p class="contact">联系人: <?php echo $value_n["cname"];?> / 联系方式: <?php echo $value_n["contact"];?> /联系地址: <?php echo $value_n["address"];?></p>
                </li>
                <?php } }else{?>
                <li><h2>非常抱歉, 暂无项目信息</h2></li>
                <?php }?>
        </ul>
        
        <?=$cpage_html?>
</div>

<div class="project_rpanel">
		<div class="psearch">
        		<span class="search_title">项目搜索</span>
                <form action="project.php" method="get">
                		<input name="kw" type="text" class="input_text" /><input name="" type="submit" value="搜 索" class="submit" /><input name="action" type="hidden" value="search" />
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