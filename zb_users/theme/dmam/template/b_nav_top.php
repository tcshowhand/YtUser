{* Template Name:顶部导航 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">打开这个网页的是傻逼</h2>吼吼!</div>';die();?>
{php}
$adminid = '';
if ($zbp->Config('dmam')->admin_id){
	$adminid = $zbp->Config('dmam')->admin_id; 
}
{/php}
<header id="dm-topbar" class="am-topbar">
<div class="topbar">
        <div class="container">
          <div class="am-g">

            <div class="am-u-md-12">
              <div class="topbar-right am-text-right am-fr">
                
				{if $adminid}
				{if $zbp.members[$adminid].Metas.user_xlwb}<a {dmam_isblank(true)} href="{$zbp.members[$adminid].Metas.user_xlwb}"><i class="am-icon-weibo"></i></a>{/if}
				{if $zbp.members[$adminid].Metas.user_txwb}<a {dmam_isblank(true)} href="{$zbp.members[$adminid].Metas.user_txwb}"><i class="am-icon-tencent-weibo"></i></a>{/if}
				{if $zbp.members[$adminid].Metas.user_renren}<a {dmam_isblank(true)} href="{$zbp.members[$adminid].Metas.user_renren}"><i class="am-icon-renren"></i></a>{/if}
				{if $zbp->Config('dmam')->pics_qq}<a href="javascript:void(0)" class="qq_button" data-am-modal="{target: '#qq-modal', closeViaDimmer: true, width: 200}" data-pic="{$zbp->Config('dmam')->pics_qq}"><i class="am-icon-qq"></i></a>{/if}
				{if $zbp->Config('dmam')->pics_wx}<a href="javascript:void(0)" class="wx_button" data-am-modal="{target: '#wx-modal', closeViaDimmer: true, width: 200}" data-pic="{$zbp->Config('dmam')->pics_wx}"><i class="am-icon-wechat"></i></a>{/if}
				{/if}
				
<!-- 			<i class="am-icon-facebook"></i>
                <i class="am-icon-twitter"></i>
                <i class="am-icon-google-plus"></i>
                <i class="am-icon-pinterest"></i>
                <i class="am-icon-instagram"></i>
                <i class="am-icon-linkedin"></i>
                <i class="am-icon-youtube-play"></i>
                <i class="am-icon-rss"></i> -->

{if $user.ID>0}
<div class="top_user">
<a href="{$host}zb_system/admin/?act=admin">【{$user.StaticName}】</a>
 </div>
{else}
<div class="top_user">
	{if $zbp->Config('dmam')->top_login}
		{if $zbp->CheckPlugin('YtUser')}
		<a href="{$host}?Login">登录</a>
		<a href="{$host}?Register">注册</a>
		{else}
		<a href="{$host}zb_system/cmd.php?act=login">登录</a>
		{if $zbp->CheckPlugin('RegPage')}<a href="{$host}?reg">注册</a>{/if}
		{/if}
	{/if}
 </div>
{/if}

                
              </div>
            </div>
          </div>
        </div>
      </div>
<div class="am-container">
{php}
$dm_logo='';
$dm_logo = $zbp->Config('dmam')->pics_logo?$zbp->Config('dmam')->pics_logo:$zbp->host.'zb_users/theme/dmam/style/images/logo.png';
{/php}

	{if $type == 'article'}
	<div class="am-topbar-brand"><a title="{$name}-{$title}" href="{$host}"><img alt="{$name}-{$title}" src="{$dm_logo}">{$name}-{$title}</a></div>
	{else}
	<h1 class="am-topbar-brand"><a title="{$name}-{$subname}" href="{$host}"><img alt="{$name}-{$subname}" src="{$dm_logo}">{$name}</a></h1>
	{/if}

 <ul id="dm-site-nav" class="am-nav am-topbar-nav">
{$modules['navbar'].Content}
</ul>
 <ul class="topnav-right" >
{$zbp->Config('dmam')->top_nav}
<li><a href="javascript:void(0)" data-search="{$host}zb_system/cmd.php?act=search" data-am-modal="{target: '#search-modal', closeViaDimmer: true, width: 300}" class="top_serch"><i class="am-icon-search"></i> 搜索</a></li>
 </ul>

</div>
</header>



<section id="dm-box" class="am-container am-g">