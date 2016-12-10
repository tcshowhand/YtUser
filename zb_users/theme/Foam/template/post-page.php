<div class="post">
	<div class="postblock">
		<h3 class="posttitle">{$article.Title}</h3>
		<div class="postintro">
			{$article.Content}
		</div>
	</div>
</div>

{if !$article.IsLock}
{template:comments}
{/if}