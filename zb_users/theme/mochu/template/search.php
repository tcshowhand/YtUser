<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2style="font-size:60px;margin-bottom:32px;color:f00;">已举报，请注意查收你的法院通知单！</h2>你的行为已经对我的版权产生的威胁，已把您电脑的IP地址上报给国家版权中心，请注意查收邮寄给您的法院信函！</div>';die();?>
{template:header}
{if $zbp->Config('mochu')->postagdon6 == '1'}
<div class="hagd container">
{$zbp->Config('mochu')->postagd6}
</div>
{/if}
{if $zbp->Config('mochu')->postyagdon6 == '1'}
<div class="hyagd container">
{$zbp->Config('mochu')->postyagd6}
</div>
{/if}
<div class="container main">
	<div class="main-lf lf">
		<div class="mainct">
			<div class="miaobao">
				<h4 class="place lf">当前位置：<a href="{$host}" title="{$name}">首页</a> - {$title} - 正文</h4>
				<h4 class="yan lr">{$zbp->Config('mochu')->postyan}</h4>
				<div class="clear"></div>
			</div>
			<div class="liebiao">
				{foreach $articles as $article}			
				{template:post-multi}			
				{/foreach}
			</div>
			<div class="pagebar">{template:pagebar}</div>
		</div>
	</div>
	<div class="main-lr lf">
		{template:sidebar2}
		{if $zbp->Config('mochu')->gensui=="1"}
		<div id="float" class="div1">
		{template:sidebar4}
		<div class="clear"></div>
		</div>
		{/if}
	</div>
</div>
{template:footer}