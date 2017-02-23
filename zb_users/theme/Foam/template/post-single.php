<div class="post">
	<div class="postblock">
		<h3 class="posttitle">{$article.Title}</h3>
		<div class="postintro">




{foreach $article.imgs as $slides}
{$slides}
<br>
{/foreach}



			{$article.Content}
		</div>
		<p class="posttags">Tags：
		{foreach $article.Tags as $tag}
		         <a href="{$tag.Url}" title="{$tag.Name}">{$tag.Name}</a> 
		{/foreach}
		</p>
	</div>
	<div class="postinfo">
		<span class="time">{$article.Time('Y年m月d日')}</span><span class="articate"><a href="{$article.Category.Url}">{$article.Category.Name}</a></span><span class="commnum"><a href="{$article.Url}#comments">{if $article.CommNums==0}
Add Comment
{elseif $article.CommNums==1}
1 Comment
{else}
{$article.CommNums} Comments
{/if}</a></span><span class="viewnum">{$article.ViewNums}℃</span>
	</div>
	<div class="singlebar">
	{if $article.Prev}
		<a class="l" href="{$article.Prev.Url}" title="上一篇">上一篇：{$article.Prev.Title}</a>
	{/if}
	{if $article.Next}
		<a class="r" href="{$article.Next.Url}" title="下一篇">下一篇：{$article.Next.Title}</a>
	{/if}
	</div>
</div>

{if !$article.IsLock}
{template:comments}
{/if}