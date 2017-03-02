{* Template Name:页头 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">打开这个网页的是傻逼</h2>吼吼!</div>';die();?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="Share-Source-Verification" content="{$host}">
<meta http-equiv="Cache-Control" content="no-transform">
<meta http-equiv="Cache-Control" content="no-siteapp">
<meta name="generator" content="{$zblogphp}" />
{if $zbp->Config('dmam')->headmate}{$zbp->Config('dmam')->headmate}{/if}
{if $zbp->Config('dmam')->theme_seo}
{template:b_header_seo}
{else}
<!-- 主题自带SEO关闭 -->
<title>{$name}{if $title}-{$title}{/if}</title>
{/if}
{dmam_load_source('header',$type)}
{$header}
<link rel="stylesheet" href="{$host}zb_users/theme/{$theme}/style/{$style}.css" type="text/css" media="all"/>
{if $zbp->Config('dmam')->apple_ico}
<link rel="apple-touch-icon-precomposed" href="{$zbp->Config('dmam')->apple_ico}">
<meta name="apple-mobile-web-app-title" content="{if $type == 'article'}{$article.Title}{else}{$name}{/if}"/>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
{/if}
{if $type=='index'&&$page=='1'}
<link rel="alternate" type="application/rss+xml" href="{$feedurl}" title="{$name}" />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="{$host}zb_system/xml-rpc/?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="{$host}zb_system/xml-rpc/wlwmanifest.xml" /> 
{/if}
{if $zbp->Config('dmam')->pics_fv}
<link rel="shortcut icon" href="{$zbp->Config('dmam')->pics_fv}">{else}<link rel="shortcut icon" href="{$host}favicon.ico">
{/if}
{php}dmam_head_css(){/php}
</head>
<body class="D_M {$type} {$zbp->Config('dmam')->topbar_fix?'dm-topbar-fixed':''}">