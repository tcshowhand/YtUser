<div class="single">
	<div class="program">
		<div class="proname"><h2>{$article.Title}</h2></div>
		<div class="pagecon">
			{$article.Content}
		</div>
	</div>
	<div class="singlebanner">{$zbp->Config('mizhe')->PostSINGLEADS}</div>
	

	{if !$article.IsLock}
	{template:comments}
	{/if}
</div>