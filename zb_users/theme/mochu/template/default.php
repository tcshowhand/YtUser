<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2style="font-size:60px;margin-bottom:32px;color:f00;">已举报，请注意查收你的法院通知单！</h2>你的行为已经对我的版权产生的威胁，已把您电脑的IP地址上报给国家版权中心，请注意查收邮寄给您的法院信函！</div>';die();?>
{template:header}{if $zbp->Config('mochu')->postagdon5 == '1'}<div class="hagd container">
{$zbp->Config('mochu')->postagd5}</div>{/if}
{if $zbp->Config('mochu')->postyagdon5 == '1'}<div class="hyagd container">
{$zbp->Config('mochu')->postyagd5}</div>{/if}
<div class="container main">
	<div class="main-lf lf">
		<div class="mainct">
			<div class="miaobao">
			<div class="postt"> <div class="noticet"> <ul><li></li><li>{$zbp->Config('mochu')->postgao}</li></ul></div></div>
			</div>
			{if $zbp->Config('mochu')->onhuandeng=="1" }
			{template:mochu_huandeng}
			{/if}
			<div class="liebiao">
				{foreach $articles as $article}
  				{if $article.IsTop}
				{template:post-istop}
				{/if}
				{/foreach}
{if $zbp->Config('mochu')->postagdon=="1"}<div class="agd" >{$zbp->Config('mochu')->postagd}</div>{/if}
{if $zbp->Config('mochu')->postyagdon=="1"}<div class="yagd" >{$zbp->Config('mochu')->postyagd}</div>{/if}
			    {foreach $articles as $article}
				{if $article.IsTop}
				{else}
				{template:post-multi}
				{/if}
				{/foreach}
			</div>
			<div class="pagebar">{template:pagebar}</div>
		</div>
	</div>
<div class="main-lr lf">
		{template:sidebar}
{if $zbp->Config('mochu')->gensui=="1"}
<div id="float" class="div1">
{template:sidebar4}
<div class="clear"></div>
</div>{/if}</div>
<div class="clear"></div></div>
{template:footer}