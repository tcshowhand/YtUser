<?php  include $this->GetTemplate('header');  ?>
<body class="<?php  echo $type;  ?>">
	<div class="sidenav">
		<?php  echo $zbp->Config('mizhe')->PostFLOATNAV;  ?>
	</div>
	<div class="wrapper">
		<?php  include $this->GetTemplate('navbar');  ?>
		<div class="box">
			<div class="banner"><?php  echo $zbp->Config('mizhe')->PostCATALOGADS;  ?></div>
			<?php if ($type=='category'&&$page=='1') { ?>
			<div class="tuan">
				<div class="tuancon">
					<div class="tuantitle"><h3>热荐专区</h3></div>
					<ul>
						<?php  foreach ( Getlist(6,$category->ID,null,null,null,null) as $related) { ?>
						<li>
							<div class="tuanimg">
								<?php if ($related->IsTop) { ?>
								<em class="hot"></em>
								<?php } ?>
								<?php 
								  $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
								  $content = $related->Content;
								  preg_match_all($pattern,$content,$matchContent);
								  if(isset($matchContent[1][0]))
								  $temp=$matchContent[1][0];
								  else
								  $temp="{$host}zb_users/theme/{$theme}/style/images/proimg.jpg";
								   ?>
								<a href="<?php  echo $related->Url;  ?>"><img src="<?php  echo $temp;  ?>" alt="" /></a>
								<div class="tuanname"><a href="<?php  echo $related->Url;  ?>"><?php $intro= preg_replace('/[\r\n\s]+/', '', trim(SubStrUTF8(TransferHTML($related->Title,'[nohtml]'),16))); ?><?php  echo $intro;  ?></a></div>
							</div>
							<div class="tuansale">
								<?php if ($related->Metas->proprice) { ?> <span class="tuanprice">￥<i><?php  echo $related->Metas->proprice;  ?></i></span> <?php }else{  ?><span class="noprice">暂无报价 <?php } ?></span>
								<span class="tuaninfo"><p><?php if ($related->Metas->proprice && $related->Metas->promarket) {echo mizhe_zhekou($related->Metas->proprice,$related->Metas->promarket).'折';}else{echo '';} ?></p><del><?php if ($related->Metas->promarket) { ?> ￥<?php  echo $related->Metas->promarket;  ?> <?php }else{  ?>  <?php } ?></del></span>
								<span class="tuannum"><?php  echo $related->ViewNums;  ?>人已开抢</span>
							</div>
						</li>
						<?php }   ?>
					</ul>
				</div>
				<div class="tuanside">
					<div class="tuansidetop"><h3>最热单品榜 TOP5</h3></div>
					<div class="tuansidecon">
						<ul>
							<?php  foreach ( GetList(5,0) as $article) { ?>
							<li>
								<?php 
								  $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
								  $content = $article->Content;
								  preg_match_all($pattern,$content,$matchContent);
								  if(isset($matchContent[1][0]))
								  $temp=$matchContent[1][0];
								  else
								  $temp="{$host}zb_users/theme/{$theme}/style/images/proimg.jpg";
								   ?>
								<div class="tuansideimg"><a href="<?php  echo $article->Url;  ?>"><img src="<?php  echo $temp;  ?>" alt="" /></a></div>
								<div class="tuansideinfo">
									<p><a href="<?php  echo $article->Url;  ?>"><?php $intro= preg_replace('/[\r\n\s]+/', '', trim(SubStrUTF8(TransferHTML($article->Title,'[nohtml]'),16))); ?><?php  echo $intro;  ?></a></p>
									<p><?php if ($article->Metas->proprice) { ?> ￥<?php  echo $article->Metas->proprice;  ?> <?php }else{  ?>暂无报价 <?php } ?></p>
								</div>
							</li>
							<?php }   ?>
						</ul>
					</div>
				</div>
			</div>
			<?php } ?>

			<div class="tuanmain">
				<ul>
					<?php if (count($articles)>0) { ?>
					<?php  foreach ( $articles as $article) { ?>
						<?php if (!$article->IsTop) { ?>
						<?php  include $this->GetTemplate('post-catalog');  ?>
						<?php } ?>
					<?php }   ?>
					<?php } ?>
				</ul>
			</div>
			<div class="pagebar"><?php  include $this->GetTemplate('pagebar');  ?><span class="pagebar-tip">下一页更多惊喜</span></div>
		</div>

<?php  include $this->GetTemplate('cfooter');  ?>