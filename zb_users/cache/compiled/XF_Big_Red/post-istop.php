
<?php IMAGE::getPics($article,160,120,3) ?>
<?php 
$temp=mt_rand(1,5);
$temp=$zbp->host."zb_users/theme/$theme/style/rand/$temp.jpg";
 ?>
<div class="feed_tegao long istop" data-href="<?php  echo $article->Url;  ?>">
    <h4><a href="<?php  echo $article->Url;  ?>" target="_blank"><?php  echo $article->Title;  ?></a></h4>
    <p class="picture">
		<a href="<?php  echo $article->Url;  ?>" target="_blank">
			<?php if ($article->IMAGE_COUNT>0) { ?>
				<img src="<?php  echo $article->IMAGE[0];  ?>" title="<?php  echo $article->Title;  ?>" alt="<?php  echo $article->Title;  ?>" />
			<?php }else{  ?>
				<img src="<?php  echo $temp;  ?>" title="<?php  echo $article->Title;  ?>" alt="<?php  echo $article->Title;  ?>" />
			<?php } ?>
		</a>
	</p>
	<?php $description = trim(SubStrUTF8(TransferHTML($article->Content,'[nohtml]'),78)).'...'; ?>
    <p class="summary"><?php  echo $description;  ?><a href="<?php  echo $article->Url;  ?>" class="more" target="_blank">[详情]</a></p>
    <div class="infos">
        <span class="time"><?php  echo $article->Time('Y-m-d');  ?></span>
    </div>
</div>
