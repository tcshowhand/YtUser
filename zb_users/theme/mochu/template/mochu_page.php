<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2style="font-size:60px;margin-bottom:32px;color:f00;">已举报，请注意查收你的法院通知单！</h2>你的行为已经对我的版权产生的威胁，已把您电脑的IP地址上报给国家版权中心，请注意查收邮寄给您的法院信函！</div>';die();?>
{template:header}
<div class="container main">
    <div class="miaobao">
      <h4 class="place lf">当前位置：<a href="{$host}" title="{$name}">首页</a> - <a href="#">其他</a> - 正文</h4>
      <h4 class="yan lr">{$zbp->Config('mochu')->postyan}</h4>
      <div class="clear"></div>
    </div>
<div class="main-lf link-con-bg lf">
<div class="link-con-lf">
	<ul>
{$mochu_page_li}
	</ul>
</div>	
  <div class="link-con">
    <article class="link-h">
      <header class="link-top">
        <h2><a href="{$article.Url}" title="{$article.Title}">{$article.Title}</a></h2>
        <h6><i class="fa fa-user"></I> {$article.Author.StaticName}&nbsp;&nbsp;&nbsp;<i class="fa fa-clock-o"></i> {$article.Time('Y-m-d')}</h6>
      </header>
      <dd class="zhengwen"> {$article.Content} </dd>
     {if $article.Alias=="archive"}
	  {$mochu_cms_Archive}
	 {elseif $article.Alias=="duzhe"}
	 {$mochu_Readers}
	 {/if}
      <div class="clear"></div>
      {if $zbp->Config('mochu')->onzongzan =='1'}
      <div class="wennr-zan"> {if $zbp->Config('mochu')->onzan=="1"}
        {$zbp->Config('mochu')->postzan}
        {else} <a href="javascript:;" class="sf-praise-sdk" sfa='click' data-postid='{$article.ID}' data-value="1">
<i class="fa fa-thumbs-o-up"></i><i class="sf-praise-sdk" sfa='num' data-value='1' data-postid='{$article.ID}'>{$sf_praise_sdk.value1}</i>人喜欢
</a><a href="javascript:;" class="sf-praise-sdk zshang" sfa='click' data-postid='{$article.ID}' data-value="2">
<i class="fa fa-thumbs-o-down"></i><i class="sf-praise-sdk" sfa='num' data-value='2' data-postid='{$article.ID}'>{$sf_praise_sdk.value2}</i>人鄙视
</a><a href="javascript:;" id="ondashang"><i class="fa fa-credit-card"></i>打赏本站</a>{/if} </div>
      {/if}
      <div class="clear"></div>
      <div class="wennr-fen"> {$zbp->Config('mochu')->postfen} </div>
      <div class="wennr-foot">
        <div class="wennr-foot-cn">
          <p><strong>本文来源：</strong><a href="{$host}" target="_blank">{$name}</a> </p>
          <p><strong>本文地址：</strong><a href="{$article.Url}">{$article.Url}</a></p>
          {$zbp->Config('mochu')->postwennrcop} </div>
      </div>
    </article>
    <div class="clear"></div>
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
</div>
{template:footer}
