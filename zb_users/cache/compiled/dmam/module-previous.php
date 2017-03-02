<?php  /* Template Name:最近文章模块 */  ?>

<?php  foreach ( $articles as $article) { ?>
<?php 
$img_cover = '';
$img_cover = $zbp->host.'zb_users/theme/'.$zbp->theme.'/style/images/covers/'.rand(1,20).'.jpg';
if ($zbp->CheckPlugin('dm_tools')) {
	dm_tools_thumb::getPics($article,400,250,4);
	if ($article->dm_tools_thumb_COUNT>0){
		$img_cover = $article->dm_tools_thumb[0];
		if ($article->Metas->post_style_order && $article->Metas->post_style_order > 1 && !strpos($article->Metas->post_style_order,',')){
		$img_cover = $article->dm_tools_thumb[$article->Metas->post_style_order-1];
		}
	}
	$img_cover = $article->Metas->thumbnail?dm_tools_thumb::getPicUrlBy($article->Metas->thumbnail,400,250,4):$img_cover;
}
 ?>
<li>
	<a <?php  echo dmam_isblank(true);  ?> href="<?php  echo $article->Url;  ?>">
	<?php if ($article->Metas->post_style != "txt" && $img_cover) { ?>
	<p class="sidepost-hd"><img <?php  echo dmam_islasy('',$img_cover);  ?>></p>
	<?php } ?>
	<p class="sidepost-bd"><?php  echo $article->Title;  ?><small>发布于 <?php  echo $article->Time('m月d日 H:i');  ?></small></p>
	</a>
</li>
<?php }   ?>

