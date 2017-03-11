<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2style="font-size:60px;margin-bottom:32px;color:f00;">已举报，请注意查收你的法院通知单！</h2>你的行为已经对我的版权产生的威胁，已把您电脑的IP地址上报给国家版权中心，请注意查收邮寄给您的法院信函！</div>';die();?>
<div class="main-lf lf">
  <div class="mainct">
    <div class="miaobao">
      <span class="place lf">当前位置：<a href="{$host}" title="{$name}">首页</a> - <a href="#">其他</a> - 正文</span>
      <span class="yan lr">{$zbp->Config('mochu')->postyan}</span>
      <div class="clear"></div>
    </div>
 <article class="wennr">
				<header class="wennr-top">
					<h1><a href="{$article.Url}" title="{$article.Title}">{$article.Title}</a></h1>
					<h6><i class="fa fa-clock-o"></i>{$article.Time('Y-m-d')}<i class="fa fa-folder-open"></i><a href="{$article.Category.Url}" title="分类 {$article.Category.Name} 的全部文章" rel="category tag">{$article.Category.Name}</a><i class="fa fa-user"></i>{$article.Author.StaticName}<i class="fa fa-eye"></i>{$article.ViewNums}°c</h6>
					<span class="lr" id="fontsize"><a href="javascript:wennrsize(18)">A<sup>+</sup></a>&nbsp;<a href="javascript:wennrsize(15)">A<sup>-</sup></a></span>
				</header>
				<div class="zhengwen" id="wennr-wen">
					{$article.Content}
				</div>
				<div class="clear"></div>
				{if $zbp->Config('mochu')->onzongzan =='1'}
				<div class="wennr-zan">
				{if $zbp->Config('mochu')->onzan=="1"}
				{$zbp->Config('mochu')->postzan}
				{else}
					<a href="javascript:;" class="sf-praise-sdk" sfa='click' data-postid='{$article.ID}' data-value="1">
<i class="fa fa-thumbs-o-up"></i><i class="sf-praise-sdk" sfa='num' data-value='1' data-postid='{$article.ID}'>{$sf_praise_sdk.value1}</i>人喜欢
</a><a href="javascript:;" class="sf-praise-sdk zshang" sfa='click' data-postid='{$article.ID}' data-value="2">
<i class="fa fa-thumbs-o-down"></i><i class="sf-praise-sdk" sfa='num' data-value='2' data-postid='{$article.ID}'>{$sf_praise_sdk.value2}</i>人鄙视
</a><a href="javascript:;" id="ondashang" ><i class="fa fa-credit-card"></i>打赏本站</a>{/if}
				</div>
				{/if}
				<div class="clear"></div>
                {if $zbp->Config('mochu')->onfen=="1"}
				<div class="wennr-fen">
				{$zbp->Config('mochu')->postfen}
				</div>{/if}								
				<footer class="wennr-foot-cn">
					    <p><span>本文来源：</span><a href="{$host}" target="_blank">{$name}</a> </p>
						<p><span>本文地址：</span><a href="{$article.Url}">{$article.Url}</a></p>
                        {$zbp->Config('mochu')->postwennrcop}
				</footer>			
			</article>
    <div class="clear"></div>
    {if $zbp->Config('mochu')->postagdon3=="1"}
    <div class="agd wnrg" >{$zbp->Config('mochu')->postagd3}</div>
    {/if}
    {if $zbp->Config('mochu')->postyagdon3=="1"}
    <div class="yagd wnrg" >{$zbp->Config('mochu')->postyagd3}</div>
    {/if}
    {if !$article.IsLock}
    <div class="pinglun">
      <h3><i class="fa fa-comments-o"></i>发表评论</h3>
      {if $zbp->Config('mochu')->onping=="0"}
      {template:comments}
      {else}
      <div class="pinglunnr"> {$zbp->Config('mochu')->postping} </div>
      {/if} </div>
    {/if} </div>
</div>
