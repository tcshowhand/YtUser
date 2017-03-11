<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2style="font-size:60px;margin-bottom:32px;color:f00;">已举报，请注意查收你的法院通知单！</h2>你的行为已经对我的版权产生的威胁，已把您电脑的IP地址上报给国家版权中心，请注意查收邮寄给您的法院信函！</div>';die();?>
{template:header}
{if $zbp->Config('mochu')->postagdon7 == '1'}
<div class="hagd container">
{$zbp->Config('mochu')->postagd7}
</div>
{/if}
{if $zbp->Config('mochu')->postyagdon7 == '1'}
<div class="hyagd container">
{$zbp->Config('mochu')->postyagd7}
</div>
{/if}
<div class="container main">
			{if $article.Type==ZC_POST_TYPE_ARTICLE}
			{template:post-single}
			{else}
			{template:post-page}
			{/if}
	<div class="main-lr lf">
		{template:sidebar3}
		{if $zbp->Config('mochu')->gensui3=="1"}
		<div id="float" class="div1">
		{template:sidebar4}
		<div class="clear"></div>
		</div>
		{/if}
	</div>
</div>
{template:footer}