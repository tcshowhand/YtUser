<div class="post">
	<div class="postblock">
		<h3 class="posttitle"><a href="{$article.Url}">[置顶] {$article.Title}</a></h3>
		<div class="postintro">
			{$article.Intro}
			<p><a href="{$article.Url}">阅读全文»</a></p>
		</div>
	</div>
	<div class="postinfo"><span class="time">{$article.Time('Y年m月d日')}</span><span class="articate">{$article.Category.Name}</span><span class="commnum"><a href="{$article.Url}#comments">{if $article.CommNums==0}
Add Comment
{elseif $article.CommNums==1}
1 Comment
{else}
{$article.CommNums} Comments
{/if}</a></span><span class="viewnum">{$article.ViewNums}</span></div>
</div>