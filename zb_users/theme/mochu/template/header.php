<!DOCTYPE html>
<html lang="{$lang['lang_bcp47']}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
<meta name="applicable-device" content="pc,mobile">
{if $type=='index'&&$page=='1'}
<title>{$name} - {$subname}{if $page>'1'} - 第{$pagebar.PageNow}页{/if}</title>
<meta name="Keywords" content="{$zbp->Config('mochu')->keywords}">
<meta name="description" content="{$zbp->Config('mochu')->description}">
{/if}
{if $type=='category'}
<title>{$category.Name} - {$name}-{$subname}{if $page>'1'} - 第{$pagebar.PageNow}页{/if}</title>
<meta name="Keywords" content="{$category.Name},{$category.Intro}">
<meta name="description" content="这是{$name}中关于{$category.Name}的分类目录,它包含{$category.Intro}等内容的文章">
{/if}
{if $type=='article'}
<title>{$title} - {$name}-{$subname}</title>
<meta name="keywords" content="{$article.Metas.mochu_guanjianzi}" />
<meta name="description" content="{$article->Metas->mochu_description}" />
{/if}
{if $type=='page'}
<title>{$title} - {$name}-{$subname}</title>
<meta name="keywords" content="{$article.Metas.mochu_guanjianzi}" />
<meta name="description" content="{$article->Metas->mochu_description}" />
{/if}
{if $type=='tag'}
<title>{$tag.Name} - {$name}-{$subname}{if $page>'1'} - 第{$pagebar.PageNow}页{/if}</title>
<meta name="Keywords" content="{$tag.Name},{$tag.Intro}">
<meta name="description" content="这是{$name}中关于{$tag.Name}标签的分类目录页,它包含有{$tag.Intro}等内容的文章">
{/if}
<meta name="generator" content="{$zblogphp}" />
<link rel="stylesheet" href="{$host}zb_users/theme/{$theme}/style/style.css" />
<link rel="stylesheet" href="http://apps.bdimg.com/libs/fontawesome/4.4.0/css/font-awesome.min.css" />
<script src="http://apps.bdimg.com/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
(window.jQuery) || document.write('<script type="text/javascript" src="{$host}zb_system/script/jquery-1.8.3.min.js"><\/script>'); 
</script>
<script src="{$host}zb_system/script/zblogphp.js" type="text/javascript"></script>
<script src="{$host}zb_system/script/c_html_js_add.php" type="text/javascript"></script>
<script src="{$host}zb_system/script/md5.js" type="text/javascript"></script>
<link href="{$host}zb_users/cache/mochuimg/favicon.ico" rel="icon">
<link href="{$host}zb_users/cache/mochuimg/favicon.ico" rel="shortcut icon">
<link href="{$host}zb_users/cache/mochuimg/favicon.ico" rel="apple-touch-icon">
{$header}
{if $type=='index'&&$page=='1'}
<link rel="alternate" type="application/rss+xml" href="{$feedurl}" title="{$name}" />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="{$host}zb_system/xml-rpc/?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="{$host}zb_system/xml-rpc/wlwmanifest.xml" />
{/if}
</head>
<body>
<div class="use">
<div class="container padd">
<div class="lf">
{if $user.ID>0}
<span class="cp-hello"></span><span class="cp-login"><a href="{$host}zb_system/cmd.php?act=login"></a></span><span class="cp-vrs"><a href="{$host}zb_system/cmd.php?act=misc&amp;type=vrs"></a></span><span class="logout"><a href="{$host}zb_system/cmd.php?act=logout">注销</a></span>
{else}
你好，欢迎访问我的博客！<a href="javascript:;" id="denglu">登录</a>
{/if}
</div>
<div class="lr">
{$zbp->Config('mochu')->headlink}
</div>
</div>
</div>
<header id="header">
	<div class="container padd">
		<h2 class="logo lf"><a href="{$host}" title="{$name}-{$subname}" ><img src="{$host}zb_users/cache/mochuimg/logo.png" alt="{$name}-{$subname}" title="{$name}-{$subname}"/></a></h2>
		<menu class="lr" id="nav">
			<ul class="pcmenu">
				<li id="navli"><a href="{$host}" title="{$name}" ><i class="fa fa-home"></i>首页</a></li>
				{if $zbp->Config('mochu')->ontnav=="0"}
				{module:navbar}
				{else}
				{$zbp->Config('mochu')->postnav}
				{/if}
				<li><a href="javascript:;" id="sousuo"><i class="fa fa-search"></i>搜索</a></li>		
			</ul>
			<span class="ydmenu">
			<a href="javascript:;" id="yddenglu"><i class="fa fa-user"></i></a>
			<a href="javascript:;" id="ydsousuo"><i class="fa fa-search"></i></a>
			<a href="javascript:;" id="xiala"><i class="fa fa-list-ul"></i></a>			
			</span>
		</menu>
		<div class="clear"></div>
	</div>
	<div id="sousuola">
	<div class="sousuo container">
	<a href="javascript:;" id="sguanbi">关闭</a>	
		<form name="search" method="post" action="{$host}/zb_system/cmd.php?act=search"><input type="text" name="q" size="11" value="本站站内搜索" onFocus="if (value =='本站站内搜索'){value =''}" onBlur="if (value ==''){value='本站站内搜索'}" /> <button type="submit" ><i class="fa fa-search"></i></button></form>
{if $zbp->Config('mochu')->baisouon}
{$zbp->Config('mochu')->postbaidu}
{/if}</div>
</div>
</header>
<div id="yidongnavs">
<ul>
<li><a href="javascript:;" title="关闭" class="guanbi" id="guanbi">关闭</a></li>
<li id="wapnavli"><a href="{$host}" title="{$name}" ><i class="fa fa-home"></i>首页</a></li>
{if $zbp->Config('mochu')->onydnav=="0"}
{module:navbar}
{else}
{$zbp->Config('mochu')->postydnav}
{/if}
</ul>
</div>