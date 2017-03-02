<?php  /* Template Name:置顶 */  ?>

<?php 
$img_cover = '';
$img_cover = $zbp->host.'zb_users/theme/'.$zbp->theme.'/style/images/covers/'.rand(1,20).'.jpg';
if ($zbp->CheckPlugin('dm_tools')) {
	dm_tools_thumb::getPics($article,480,320,4);
	if ($article->dm_tools_thumb_COUNT>0){
		$img_cover = $article->dm_tools_thumb[0];
		if ($article->Metas->post_style_order && !strpos($article->Metas->post_style_order,',')){
		$img_cover = $article->Metas->post_style_order > 1?$article->dm_tools_thumb[$article->Metas->post_style_order-1]:$img_cover;
		}
		$img_cover = $article->Metas->thumbnail?dm_tools_thumb::getPicUrlBy($article->Metas->thumbnail,480,320,4):$img_cover;
	}
}
 ?>
  <li>
	<div class="am-gallery-item istop-<?php  echo $article->ID;  ?>">
		<a href="<?php  echo $article->Url;  ?>" class="">
		  <img <?php  echo dmam_islasy('',$img_cover);  ?> alt="<?php  echo $article->Title;  ?>"/>
			<h3 class="am-gallery-title"><?php  echo $article->Title;  ?></h3>
			<div class="am-gallery-desc"><?php  echo $article->Time('Y年m月d日');  ?></div>
		</a>
	</div>
  </li>
