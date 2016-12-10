<li>
	<div class="postname"><a href="<?php  echo $article->Url;  ?>" title="<?php  echo $article->Title;  ?>"><?php  echo $article->Title;  ?></a></div>
	<div class="postimg">
		<?php if ($article->catalogIsTop) { ?>
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
		<a href="<?php  echo $article->Url;  ?>" title="<?php  echo $article->Title;  ?>" alt="<?php  echo $article->Title;  ?>"><img src="<?php  echo $temp;  ?>" alt="" /></a>
		<div class="postunder"></div>
		<div class="postinfo"><span><?php if ($article->Metas->proprice && $article->Metas->promarket) {echo mizhe_zhekou($article->Metas->proprice,$article->Metas->promarket).'折';}else{echo '';} ?> <del><?php if ($article->Metas->promarket) { ?> 原价:￥<?php  echo $article->Metas->promarket;  ?> <?php }else{  ?>  <?php } ?></del></span><i><?php  echo $article->ViewNums;  ?>人已开抢</i></div>
	</div>
	<div class="postsale">
		<div class="postprice"><?php if ($article->Metas->proprice) { ?> ￥<i><?php  echo $article->Metas->proprice;  ?></i> <?php }else{  ?>暂无报价 <?php } ?></div>
		<div class="postbtn"><a href="<?php  echo $article->Url;  ?>"></a></div>
	</div>
	<div class="posttags">
		<?php  foreach ( $article->Tags as $tag) { ?> <a href="<?php  echo $tag->Url;  ?>"><?php  echo $tag->Name;  ?></a><?php  }   ?>
	</div>
</li>