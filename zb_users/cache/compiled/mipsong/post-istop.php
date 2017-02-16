<li class="cate<?php  echo $article->Category->ID;  ?> auth<?php  echo $article->Author->ID;  ?>">
	<div class="timg">
		<em class="hot"></em>
		<?php 
		  $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
		  $content = $article->Content;
		  preg_match_all($pattern,$content,$matchContent);
		  if(isset($matchContent[1][0]))
		  $temp=$matchContent[1][0];
		  else
		  $temp="{$host}zb_users/theme/{$theme}/style/images/proimg.jpg";
		 ?>
		<a href="<?php  echo $article->Url;  ?>" title="[置顶]<?php  echo $article->Title;  ?>"><img src="<?php  echo $temp;  ?>" alt="<?php  echo $article->Title;  ?>" /></a>
		<div class="tinfo"><a href="<?php  echo $article->Url;  ?>" title="[置顶]<?php  echo $article->Title;  ?>">[置顶]<?php  echo $article->Title;  ?></a></div>
	</div>
	<div class="tsale">
		<?php if ($article->Metas->proprice) { ?> <span class="tprice">￥<i><?php  echo $article->Metas->proprice;  ?></i></span> <?php }else{  ?><span class="noprice">暂无报价</span> <?php } ?>
		<span class="tother"><p>
<?php 
	if ($article->Metas->proprice && $article->Metas->promarket) {
		echo mizhe_zhekou($article->Metas->proprice,$article->Metas->promarket).'折';
	}else{
		echo '';
	}
 ?>
			</p><del><?php if ($article->Metas->promarket) { ?> ￥<?php  echo $article->Metas->promarket;  ?> <?php }else{  ?>  <?php } ?></del></span>
		<a href="<?php  echo $article->Url;  ?>" class="tbtn"></a>
	</div>
</li>