{* Template Name:文章和页面 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">打开这个网页的是傻逼</h2>吼吼!</div>';die();?>
	{if $zbp->user->ID}
	<dl>
	<dd>
	<ul class="am-nav">
	<li><a class="am-icon-user" href="{$host}?User"> 用户中心</a></li>
	<li><a class="am-icon-pencil-square-o" href="{$host}?Articleedt"> 发布投稿</a></li>
	<li><a class="am-icon-list-alt" href="{$host}?Articlelist"> 我的文章</a></li>
	<li><a class="am-icon-comments" href="{$host}?Commentlist"> 我的评论</a></li>
	<li><a class="am-icon-shopping-bag" href="{$host}?Paylist"> 我的订单</a></li>
	<li><a class="am-icon-angellist" href="{$host}?Integral"> 积分充值</a></li>
	<li><a class="am-icon-diamond" href="{$host}?Upgrade"> VIP月充</a></li>
	</ul>
	</dd>
	</dl>
	{/if}