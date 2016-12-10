<?php  include $this->GetTemplate('header');  ?>
<body class="<?php  echo $type;  ?>">
	<div class="wrapper">
		<?php  include $this->GetTemplate('navbar');  ?>
		<div class="box">
			<div class="singlebox">
				<?php if ($article->Type==ZC_POST_TYPE_ARTICLE) { ?>
				<?php  include $this->GetTemplate('post-single');  ?>
				<?php }else{  ?>
				<?php  include $this->GetTemplate('post-page');  ?>
				<?php } ?>
				<div class="sidebar">
					<div class="sidebox">
						<div class="sidetitle">
							<h3>大家正在买...</h3>
						</div>
						<div class="sidecon">
							<ul>
								<?php  foreach ( GetList(5,$category->ID) as $article) { ?>
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
									<div class="sideimg"><a href="<?php  echo $article->Url;  ?>"><img src="<?php  echo $temp;  ?>" alt="" /></a></div>
									<div class="sidename"><a href="<?php  echo $article->Url;  ?>"><?php if ($article->Metas->proprice) { ?><em>￥<?php  echo $article->Metas->proprice;  ?></em> <?php }else{  ?>暂无报价<?php } ?><?php  echo $article->Title;  ?></a></div>
									<div class="sidedetail"><span><?php if ($article->Metas->promarket) { ?>原价: <del>￥<?php  echo $article->Metas->promarket;  ?></del> <?php }else{  ?>暂无报价 <?php } ?></span><a href="<?php  echo $article->Url;  ?>">去抢购</a></div>
								</li>
								<?php }   ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		
<?php  include $this->GetTemplate('sfooter');  ?>