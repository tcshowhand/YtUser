<?php  include $this->GetTemplate('header');  ?>
<body class="<?php  echo $type;  ?>">
	<div class="wrapper">
		<?php  include $this->GetTemplate('navbar');  ?>
		<div class="box">
			<div class="banner"><?php  echo $zbp->Config('mizhe')->PostCATALOGADS;  ?></div>
			<?php if ($type=='category'&&$page=='1') { ?>
			<div class="well">
				<div class="wellcon">
					<ul>
						<?php  foreach ( Getlist(6,$category->ID,null,null,null,null) as $related) { ?>
						<li>
							<div class="wellimg">
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
							</div>
							<div class="wellsale">
								<div class="wellname"><a href="<?php  echo $related->Url;  ?>"><?php $intro= preg_replace('/[\r\n\s]+/', '', trim(SubStrUTF8(TransferHTML($related->Title,'[nohtml]'),16))); ?><?php  echo $intro;  ?></a></div>
								<div class="wellinfo">
									<?php if ($related->Metas->proprice) { ?> <span class="wellprice">￥<i><?php  echo $related->Metas->proprice;  ?></i> <?php }else{  ?><span class="noprice">暂无报价 <?php } ?> <del><?php if ($related->Metas->promarket) { ?> ￥<?php  echo $related->Metas->promarket;  ?> <?php }else{  ?>  <?php } ?></del></span>
									<span class="wellbtn"><a href="<?php  echo $related->Url;  ?>"></a></span>
								</div>
							</div>
						</li>
						<?php }   ?>
					</ul>
				</div>
				<div class="wellside">
					<div class="wellsidetop"><h3>最热单品榜</h3></div>
					<div class="wellsidecon">
						<ul>
							<?php 
							$i=1;
							 ?>
							<?php  foreach ( GetList(6,0) as $article) { ?>
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
								<div class="simg"><a href="<?php  echo $article->Url;  ?>"><img src="<?php  echo $temp;  ?>" alt="<?php  echo $article->Title;  ?>" /></a></div>
								<div class="sinfo">
									<p>No.<?php  echo $i;  ?></p>
									<p><a href="<?php  echo $article->Url;  ?>"><?php $intro= preg_replace('/[\r\n\s]+/', '', trim(SubStrUTF8(TransferHTML($article->Title,'[nohtml]'),24))); ?><?php  echo $intro;  ?></a></p>
								</div>
							</li>
							<?php 
							$i=$i+1;
							 ?>
							<?php }   ?>
							
						</ul>
					</div>
				</div>
			</div>
			<?php } ?>

			<div class="post">
				<ul>
					<?php if (count($articles)>0) { ?>
					<?php  foreach ( $articles as $article) { ?>
						<?php if (!$article->IsTop) { ?>
						<?php  include $this->GetTemplate('post-tuan');  ?>
						<?php } ?>
					<?php }   ?>
					<?php } ?>
				</ul>
			</div>
			<div class="pagebar"><?php  include $this->GetTemplate('pagebar');  ?><span class="pagebar-tip">下一页更多惊喜</span></div>
		</div>

<?php  include $this->GetTemplate('cfooter');  ?>