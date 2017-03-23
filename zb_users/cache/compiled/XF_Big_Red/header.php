
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="generator" content="<?php  echo $zblogphp;  ?>" />
    <?php if ($zbp->Config('XF_Big_Red')->seo=="a") { ?>
		<title><?php  echo $name;  ?>-<?php  echo $subname;  ?></title>
	<?php }else{  ?>
		<title><?php if ($type=="index") { ?><?php  echo $name;  ?>-<?php  echo $subname;  ?><?php }elseif($type=="category"&&$page=="1") {  ?><?php  echo $category->Name;  ?><?php if ($category->Metas->fjbt) { ?>-<?php  echo $category->Metas->fjbt;  ?><?php } ?>-<?php  echo $name;  ?><?php }elseif($type=="category"&&$page>"1") {  ?><?php  echo $category->Name;  ?><?php if ($category->Metas->fjbt) { ?>-<?php  echo $category->Metas->fjbt;  ?><?php } ?>-<?php  echo $name;  ?>-第<?php  echo $page;  ?>页<?php }elseif($type=="tag"&&$page=="1") {  ?><?php  echo $tag->Name;  ?><?php if ($tag->Metas->fjbt) { ?>-<?php  echo $tag->Metas->fjbt;  ?><?php } ?>-<?php  echo $name;  ?><?php }elseif($type=="tag"&&$page>"1") {  ?><?php  echo $tag->Name;  ?><?php if ($tag->Metas->fjbt) { ?>-<?php  echo $tag->Metas->fjbt;  ?><?php } ?>-<?php  echo $name;  ?>-第<?php  echo $page;  ?>页<?php }elseif($type=="date"&&$page=="1") {  ?><?php  echo $title;  ?> <?php  echo $name;  ?><?php }elseif($type=="date"&&$page>"1") {  ?><?php  echo $title;  ?> <?php  echo $name;  ?><?php }elseif($type=="article") {  ?><?php  echo $title;  ?><?php if ($article->Metas->fjbt) { ?>-<?php  echo $article->Metas->fjbt;  ?><?php } ?><?php if ($zbp->Config('XF_Big_Red')->post_category=="a") { ?>-<?php  echo $article->Category->Name;  ?><?php } ?>-<?php  echo $name;  ?><?php }elseif($type=="page") {  ?><?php  echo $title;  ?><?php if ($article->Metas->fjbt) { ?>-<?php  echo $article->Metas->fjbt;  ?><?php } ?>-<?php  echo $name;  ?><?php if ($zbp->Config('XF_Big_Red')->page_subname=="a") { ?>-<?php  echo $subname;  ?><?php } ?><?php }else{  ?><?php  echo $title;  ?>-<?php  echo $name;  ?><?php } ?></title>
	<?php } ?>
	<?php if ($zbp->Config('XF_Big_Red')->seo=="b") { ?>
		<?php if ($type=='index') { ?>
			<meta name="keywords" content="<?php  echo $zbp->Config('XF_Big_Red')->keywords;  ?>" />
			<meta name="description" content="<?php  echo $zbp->Config('XF_Big_Red')->description;  ?>" />
		<?php }elseif($type=='page') {  ?>
			<meta name="keywords" content="<?php  echo $title;  ?>,<?php  echo $name;  ?>"/>
			<meta name="description" content="<?php  echo $article->Metas->gjc;  ?>" />
			<meta name="author" content="<?php  echo $article->Metas->ms;  ?>" />
		<?php }elseif($type=='article') {  ?>
			<meta name="keywords" content="<?php  echo $article->Metas->gjc;  ?>" />
			<meta name="description" content="<?php  echo $article->Metas->ms;  ?>" />
		<?php }elseif($type=='category') {  ?>
			<meta name="Keywords" content="<?php  echo $category->Metas->gjc;  ?>" />
			<meta name="description" content="<?php  echo $category->Metas->ms;  ?>" />
		<?php }elseif($type=='tag') {  ?>
			<meta name="Keywords" content="<?php  echo $tag->Metas->gjc;  ?>" />
			<meta name="description" content="<?php  echo $tag->Metas->ms;  ?>" />
		<?php }else{  ?>
			<meta name="Keywords" content="<?php  echo $title;  ?>,<?php  echo $name;  ?>" />
			<meta name="description" content="<?php  echo $title;  ?>-<?php  echo $name;  ?>" />
		<?php } ?>
	<?php } ?>
	<link rel="shortcut icon" href="<?php  echo $host;  ?>favicon.ico" />
	<link rel="stylesheet" type="text/css" href="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/style.css"/>
	<?php if ($type=='article' || $type=='page') { ?>
		<link rel="stylesheet" type="text/css" href="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/js/art.css"/>
	<?php } ?>
	<script src="<?php  echo $host;  ?>zb_system/script/jquery-2.2.4.min.js" type="text/javascript"></script>
	<script src="<?php  echo $host;  ?>zb_system/script/zblogphp.js" type="text/javascript"></script>
	<script src="<?php  echo $host;  ?>zb_system/script/c_html_js_add.php" type="text/javascript"></script>
	<?php if ($type=='index'&&$page=='1') { ?>
		<link rel="alternate" type="application/rss+xml" href="<?php  echo $feedurl;  ?>" title="<?php  echo $name;  ?>" />
		<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php  echo $host;  ?>zb_system/xml-rpc/?rsd" />
		<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php  echo $host;  ?>zb_system/xml-rpc/wlwmanifest.xml" />
	<?php } ?>
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
	<?php  echo $header;  ?>
</head>
<body>
<style>body {padding-top: 0}#Header {position: relative;}</style>
<div class="wrap">
	<div id="Cover" class="mod-cover">
		<div class="cover">
			<div class="coverbg"></div>
			<div class="coverlogo">
				<?php if ($type=='article' || $type=='page') { ?>
					<h2><a href="<?php  echo $host;  ?>" title="<?php  echo $name;  ?>"><img src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/images/logo.png"></a></h2>
				<?php }else{  ?>
					<h1><a href="<?php  echo $host;  ?>" title="<?php  echo $name;  ?>"><img src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/images/logo.png"></a></h1>
				<?php } ?>
			</div>
			<div class="coverslogan">
				<p class="ll"></p>
				<span><?php  echo $zbp->Config('XF_Big_Red')->recommend;  ?></span>
				<p class="rl"></p>
			</div>
		</div>
	</div>
	<div id="Header">
		<div class="header">
			<div class="logo" style="width:144px;"><a href="<?php  echo $host;  ?>" title="<?php  echo $name;  ?>"><img src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/images/logo.png" style="height:30px"/></a></div>
			<div class="menulist large">
				<ul>
					<li class="menu" ><a href="<?php  echo $host;  ?>" class="menua">首页</a></li><?php  if(isset($modules['navbar'])){echo $modules['navbar']->Content;}  ?>
				</ul>
			</div>
			<div class="menulist medium">
				<ul>
					<li class="menu" ><a href="<?php  echo $host;  ?>" class="menua">首页</a></li><?php  if(isset($modules['navbar'])){echo $modules['navbar']->Content;}  ?>
				</ul>
			</div>
			<div class="headerSearch showbar">
				<form id="forms" name="search" action="<?php  echo $host;  ?>zb_system/cmd.php?act=search" method="post" >
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