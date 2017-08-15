<li>
	<div class="tuanmainimg">
		<?php if ($article->IsTop) { ?>
		<em class="hot"></em>
		<?php } ?>
		<?php 
		  $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
		  $content = $article->Content;
		  preg_match_all($pattern,$content,$matchContent);
		  if(isset($matchContent[1][0]))
		  $temp=$matchContent[1][0];
		  else
		  $temp="{$host}zb_users/theme/{$theme}/style/images/proimg.jpg";
		 ?>
		<a href="<?php  echo $article->Url;  ?>"><img src="<?php  echo $temp;  ?>" alt="<?php  echo $article->Title;  ?>" /></a>
		<div class="tuanmainname"><a href="<?php  echo $article->Url;  ?>"><?php  echo $article->Title;  ?></a></div>
	</div>
	<div class="tuanmainsale">
		<?php if ($article->Metas->proprice) { ?> <span class="tuanmainprice">￥<i><?php  echo $article->Metas->proprice;  ?></i></span> <?php }else{  ?><span class="noprice">暂无报价</span> <?php } ?>
		<span class="tuanmaininfo"><del><?php if ($article->Metas->promarket) { ?> ￥<?php  echo $article->Metas->promarket;  ?> <?php }else{  ?>  <?php } ?></del><p><?php if ($article->Metas->proprice && $article->Metas->promarket) {echo mizhe_zhekou($article->Metas->proprice,$article->Metas->promarket).'折';}else{echo '';} ?></p></span>
		<span class="tuanmainnum"><?php  echo $article->ViewNums;  ?>人已开抢</span>
	</div>
</li>