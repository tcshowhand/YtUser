<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="u8">
<!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{$name}-{$title}</title>
<meta name="author" content="豫唐网络">

<!-- Bootstrap -->
<link rel="stylesheet" type="text/css"  href="{$host}zb_users/theme/{$theme}/style/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="{$host}zb_users/theme/{$theme}/style/fonts/font-awesome/css/font-awesome.css">

<!-- Nivo Lightbox
================================================== -->
<link rel="stylesheet" href="{$host}zb_users/theme/{$theme}/style/css/nivo-lightbox.css" >
<link rel="stylesheet" href="{$host}zb_users/theme/{$theme}/style/css/nivo_lightbox_themes/default/default.css">

<!-- Stylesheet
================================================== -->
<link rel="stylesheet" type="text/css"  href="{$host}zb_users/theme/{$theme}/style/{$style}.css">
<link rel="stylesheet" type="text/css" href="{$host}zb_users/theme/{$theme}/style/css/responsive.css">

<script src="{$host}zb_system/script/common.js" type="text/javascript"></script>
<script src="{$host}zb_system/script/c_html_js_add.php" type="text/javascript"></script>
{$header}
{if $type=='index'&&$page=='1'}
	<link rel="alternate" type="application/rss+xml" href="{$feedurl}" title="{$name}" />
	<link rel="EditURI" type="application/rsd+xml" title="RSD" href="{$host}zb_system/xml-rpc/?rsd" />
	<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="{$host}zb_system/xml-rpc/wlwmanifest.xml" />
{/if}