<div class="post">
	<div class="postblock">
		<h3 class="posttitle"><a href="<?php  echo $article->Url;  ?>">[置顶] <?php  echo $article->Title;  ?></a></h3>
		<div class="postintro">
			<?php  echo $article->Intro;  ?>
			<p><a href="<?php  echo $article->Url;  ?>">阅读全文»</a></p>
		</div>
	</div>
	<div class="postinfo"><span class="time"><?php  echo $article->Time('Y年m月d日');  ?></span><span class="articate"><?php  echo $article->Category->Name;  ?></span><span class="commnum"><a href="<?php  echo $article->Url;  ?>#comments"><?php if ($article->CommNums==0) { ?>
Add Comment
<?php }elseif($article->CommNums==1) {  ?>
1 Comment
<?php }else{  ?>
<?php  echo $article->CommNums;  ?> Comments
<?php } ?></a></span><span class="viewnum"><?php  echo $article->ViewNums;  ?></span></div>
</div>