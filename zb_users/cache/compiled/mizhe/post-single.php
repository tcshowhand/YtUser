<div class="single cate<?php  echo $article->Category->ID;  ?> auth<?php  echo $article->Author->ID;  ?>">
	<div class="program">
		<div class="proname">
			<h2><span>今日特卖：</span><?php  echo $article->Title;  ?></h2>
		</div>
		<div class="probox">
			<div class="prodetail">
				<?php if ($article->Metas->proprice) { ?> <div class="proprice"><span>￥<i><?php  echo $article->Metas->proprice;  ?></i></span><a href="<?php if ($article->Metas->prourl) { ?> <?php  echo $article->Metas->prourl;  ?> <?php }else{  ?>javascript: <?php } ?>" target="_blank" class="now">去抢购</a><?php }else{  ?><div class="proready"><span class="noprice">暂无报价</span><a href="<?php if ($article->Metas->prourl) { ?> <?php  echo $article->Metas->prourl;  ?> <?php }else{  ?>javascript: <?php } ?>" target="_blank" class="ready">即将开始</a> <?php } ?></div>
				<div class="proinfo">
					<span><em>原价</em><?php if ($article->Metas->promarket) { ?> <del>￥<?php  echo $article->Metas->promarket;  ?></del><?php }else{  ?>暂无  <?php } ?></span>
					<span><em>折扣</em><i><?php if ($article->Metas->proprice && $article->Metas->promarket) {echo mizhe_zhekou($article->Metas->proprice,$article->Metas->promarket).'折';}else{echo '暂无';} ?></i></span>
					<span><em>节省</em><i><?php if ($article->Metas->proprice && $article->Metas->promarket) {echo '￥'.mizhe_sheng($article->Metas->proprice,$article->Metas->promarket);}else{echo '暂无';} ?></i></span>
				</div>
				<div class="pronum">已有<i><?php  echo $article->ViewNums;  ?></i>人在抢购该商品</div>
				<div class="protime">
					<p>离抢购结束还剩:</p>
					<span class="settime" endTime="<?php  echo $article->Metas->protime;  ?>"></span>
				</div>
				<div class="protags"></div>
			</div>
			<?php 
			  $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
			  $content = $article->Content;
			  preg_match_all($pattern,$content,$matchContent);
			  if(isset($matchContent[1][0]))
			  $temp=$matchContent[1][0];
			  else
			  $temp="{$host}zb_users/theme/{$theme}/style/images/proimg.jpg";
			 ?>
			<div class="proimg"><a href="<?php if ($article->Metas->prourl) { ?> <?php  echo $article->Metas->prourl;  ?> <?php }else{  ?>javascript: <?php } ?>" target="_blank"><img src="<?php  echo $temp;  ?>" alt="<?php  echo $article->Title;  ?>" /></a></div>
		</div>
		<div class="protags">
			<span class="protaglist"><?php  foreach ( $article->Tags as $tag) { ?><a href="<?php  echo $tag->Url;  ?>"><?php  echo $tag->Name;  ?></a><?php }   ?></span>
			<span class="proshare">
				<?php  echo $zbp->Config('mizhe')->PostSHARE;  ?>
			</span>
		</div>
	</div>
	<div class="singlebanner"><?php  echo $zbp->Config('mizhe')->PostSINGLEADS;  ?></div>
	<div class="content">
		<div class="articlecon">
			<i class="seller"></i>
			<em>掌柜说</em>
			<?php  echo $article->Content;  ?>
		</div>
	</div>
	<div class="content">
		<div class="contitle"><h3>猜你喜欢</h3><a href="<?php  echo $article->Category->Url;  ?>">更多推荐»</a></div>
		<div class="conbox">
			<ul>
				<?php  foreach ( GetList(15,$category->ID) as $more) { ?>
				<li>
					<?php 
					  $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
					  $content = $more->Content;
					  preg_match_all($pattern,$content,$matchContent);
					  if(isset($matchContent[1][0]))
					  $temp=$matchContent[1][0];
					  else
					  $temp="{$host}zb_users/theme/{$theme}/style/images/proimg.jpg";
					 ?>
					<div class="conimg"><a href="<?php  echo $more->Url;  ?>"><img src="<?php  echo $temp;  ?>" alt="" /></a></div>
					<div class="conname"><a href="<?php  echo $more->Url;  ?>"><?php  echo $more->Title;  ?></a></div>
					<div class="condetail"><em><?php if ($more->Metas->proprice) { ?>￥<i><?php  echo $more->Metas->proprice;  ?></i> <?php }else{  ?>暂无报价 <?php } ?></em><?php if ($more->Metas->promarket) { ?> <del>￥<?php  echo $more->Metas->promarket;  ?></del> <?php }else{  ?>　 <?php } ?></div>
				</li>
				<?php }   ?>
			</ul>
		</div>
	</div>

	<?php if (!$article->IsLock) { ?>
	<?php  include $this->GetTemplate('comments');  ?>
	<?php } ?>
</div>