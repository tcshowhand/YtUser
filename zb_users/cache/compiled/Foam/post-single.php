<div class="post">
	<div class="postblock">
		<h3 class="posttitle"><?php  echo $article->Title;  ?></h3>
		<div class="postintro">




<?php  foreach ( $article->imgs as $slides) { ?>
<?php  echo $slides;  ?>
<br>
<?php }   ?>



			<?php  echo $article->Content;  ?>
		</div>
		<p class="posttags">Tags：
		<?php  foreach ( $article->Tags as $tag) { ?>
		         <a href="<?php  echo $tag->Url;  ?>" title="<?php  echo $tag->Name;  ?>"><?php  echo $tag->Name;  ?></a> 
		<?php }   ?>
		</p>
	</div>
	<div class="postinfo">
		<span class="time"><?php  echo $article->Time('Y年m月d日');  ?></span><span class="articate"><a href="<?php  echo $article->Category->Url;  ?>"><?php  echo $article->Category->Name;  ?></a></span><span class="commnum"><a href="<?php  echo $article->Url;  ?>#comments"><?php if ($article->CommNums==0) { ?>
Add Comment
<?php }elseif($article->CommNums==1) {  ?>
1 Comment
<?php }else{  ?>
<?php  echo $article->CommNums;  ?> Comments
<?php } ?></a></span><span class="viewnum"><?php  echo $article->ViewNums;  ?>℃</span>
	</div>
	<div class="singlebar">
	<?php if ($article->Prev) { ?>
		<a class="l" href="<?php  echo $article->Prev->Url;  ?>" title="上一篇">上一篇：<?php  echo $article->Prev->Title;  ?></a>
	<?php } ?>
	<?php if ($article->Next) { ?>
		<a class="r" href="<?php  echo $article->Next->Url;  ?>" title="下一篇">下一篇：<?php  echo $article->Next->Title;  ?></a>
	<?php } ?>
	</div>
</div>

<?php if (!$article->IsLock) { ?>
<?php  include $this->GetTemplate('comments');  ?>
<?php } ?>