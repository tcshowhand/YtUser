<?php echo'
	<meta charset="UTF-8">
	<div style="text-align:center;padding:60px 0;font-size:16px;">
		<h2 style="font-size:28px;margin-bottom:32px;color:000;">Theme ID: XF_Big_Red</h2>
		<h2 style="font-size:28px;margin-bottom:32px;color:000;">Author: 小锋博客</h2>
		<h2 style="font-size:28px;margin-bottom:32px;color:000;">Author URI: Www.SongHaiFeng.Com</h2>
		<h2 style="font-size:28px;margin-bottom:32px;color:000;">Author QQ: 284204003</h2>
		<h2 style="font-size:28px;margin-bottom:32px;color:000;">Author Email: 284204003@qq.com</h2>
	</div>
';die();?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="generator" content="{$zblogphp}" />
    {if $zbp->Config('XF_Big_Red')->seo=="a"}
		<title>{$name}-{$subname}</title>
	{else}
		<title>{if $type=="index"}{$name}-{$subname}{elseif $type=="category"&&$page=="1"}{$category.Name}{if $category.Metas.fjbt}-{$category.Metas.fjbt}{/if}-{$name}{elseif $type=="category"&&$page>"1"}{$category.Name}{if $category.Metas.fjbt}-{$category.Metas.fjbt}{/if}-{$name}-第{$page}页{elseif $type=="tag"&&$page=="1"}{$tag.Name}{if $tag.Metas.fjbt}-{$tag.Metas.fjbt}{/if}-{$name}{elseif $type=="tag"&&$page>"1"}{$tag.Name}{if $tag.Metas.fjbt}-{$tag.Metas.fjbt}{/if}-{$name}-第{$page}页{elseif $type=="date"&&$page=="1"}{$title} {$name}{elseif $type=="date"&&$page>"1"}{$title} {$name}{elseif $type=="article"}{$title}{if $article.Metas.fjbt}-{$article.Metas.fjbt}{/if}{if $zbp->Config('XF_Big_Red')->post_category=="a"}-{$article.Category.Name}{/if}-{$name}{elseif $type=="page"}{$title}{if $article.Metas.fjbt}-{$article.Metas.fjbt}{/if}-{$name}{if $zbp->Config('XF_Big_Red')->page_subname=="a"}-{$subname}{/if}{else}{$title}-{$name}{/if}</title>
	{/if}
	{if $zbp->Config('XF_Big_Red')->seo=="b"}
		{if $type=='index'}
			<meta name="keywords" content="{$zbp->Config('XF_Big_Red')->keywords}" />
			<meta name="description" content="{$zbp->Config('XF_Big_Red')->description}" />
		{elseif $type=='page'}
			<meta name="keywords" content="{$title},{$name}"/>
			<meta name="description" content="{$article.Metas.gjc}" />
			<meta name="author" content="{$article.Metas.ms}" />
		{elseif $type=='article'}
			<meta name="keywords" content="{$article.Metas.gjc}" />
			<meta name="description" content="{$article.Metas.ms}" />
		{elseif $type=='category'}
			<meta name="Keywords" content="{$category.Metas.gjc}" />
			<meta name="description" content="{$category.Metas.ms}" />
		{elseif $type=='tag'}
			<meta name="Keywords" content="{$tag.Metas.gjc}" />
			<meta name="description" content="{$tag.Metas.ms}" />
		{else}
			<meta name="Keywords" content="{$title},{$name}" />
			<meta name="description" content="{$title}-{$name}" />
		{/if}
	{/if}
	<link rel="shortcut icon" href="{$host}favicon.ico" />
	<link rel="stylesheet" type="text/css" href="{$host}zb_users/theme/{$theme}/style/style.css"/>
	{if $type=='article' || $type=='page'}
		<link rel="stylesheet" type="text/css" href="{$host}zb_users/theme/{$theme}/style/js/art.css"/>
	{/if}
	<script src="{$host}zb_system/script/jquery-2.2.4.min.js" type="text/javascript"></script>
	<script src="{$host}zb_system/script/zblogphp.js" type="text/javascript"></script>
	<script src="{$host}zb_system/script/c_html_js_add.php" type="text/javascript"></script>
	{if $type=='index'&&$page=='1'}
		<link rel="alternate" type="application/rss+xml" href="{$feedurl}" title="{$name}" />
		<link rel="EditURI" type="application/rsd+xml" title="RSD" href="{$host}zb_system/xml-rpc/?rsd" />
		<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="{$host}zb_system/xml-rpc/wlwmanifest.xml" />
	{/if}
    <script>
        var serverData = {
            logowidth: '144',
            logoheight: '30',
            coverlogoheight: '50',
            menuCount: 9,
            terms: '',
            menu: [],
            channelname: '',
            device: 'pc'
        }
    </script>
	{$header}
</head>
<body>
<style>body {padding-top: 0}#Header {position: relative;}</style>
<div class="wrap">
	<div id="Cover" class="mod-cover">
		<div class="cover">
			<div class="coverbg"></div>
			<div class="coverlogo">
				{if $type=='article' || $type=='page'}
					<h2><a href="{$host}" title="{$name}"><img src="{$host}zb_users/theme/{$theme}/style/images/logo.png"></a></h2>
				{else}
					<h1><a href="{$host}" title="{$name}"><img src="{$host}zb_users/theme/{$theme}/style/images/logo.png"></a></h1>
				{/if}
			</div>
			<div class="coverslogan">
				<p class="ll"></p>
				<span>{$zbp->Config('XF_Big_Red')->recommend}</span>
				<p class="rl"></p>
			</div>
		</div>
	</div>
	<div id="Header">
		<div class="header">
			<div class="logo" style="width:144px;"><a href="{$host}" title="{$name}"><img src="{$host}zb_users/theme/{$theme}/style/images/logo.png" style="height:30px"/></a></div>
			<div class="menulist large">
				<ul>
					<li class="menu" ><a href="{$host}" class="menua">首页</a></li>{module:navbar}
				</ul>
			</div>
			<div class="menulist medium">
				<ul>
					<li class="menu" ><a href="{$host}" class="menua">首页</a></li>{module:navbar}
				</ul>
			</div>
			<div class="headerSearch showbar">
				<form id="forms" name="search" action="{$host}zb_system/cmd.php?act=search" method="post" >
					<p class="searchbar">
						<a href="javascript:;" class="searchA"><i class="i"></i></a>
						<i class="txt">
							<i class="i"></i>
							<input name="q" type="text" >
						</i>
					</p>
					<button type="submit" class="search-submit" style="display: none">搜索</button>
				</form>
				<p class="sub-menu"><i class="icon-submenu"></i></p>
			</div>
		</div>
	</div>
	<div id="Body">
		<div class="body">
			<div class="left">
				<div id="banners">