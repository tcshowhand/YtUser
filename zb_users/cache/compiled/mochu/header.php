<!DOCTYPE html>
<html lang="<?php  echo $lang['lang_bcp47'];  ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
<meta name="applicable-device" content="pc,mobile">
<?php if ($type=='index'&&$page=='1') { ?>
<title><?php  echo $name;  ?> - <?php  echo $subname;  ?><?php if ($page>'1') { ?> - 第<?php  echo $pagebar->PageNow;  ?>页<?php } ?></title>
<meta name="Keywords" content="<?php  echo $zbp->Config('mochu')->keywords;  ?>">
<meta name="description" content="<?php  echo $zbp->Config('mochu')->description;  ?>">
<?php } ?>
<?php if ($type=='category') { ?>
<title><?php  echo $category->Name;  ?> - <?php  echo $name;  ?>-<?php  echo $subname;  ?><?php if ($page>'1') { ?> - 第<?php  echo $pagebar->PageNow;  ?>页<?php } ?></title>
<meta name="Keywords" content="<?php  echo $category->Name;  ?>,<?php  echo $category->Intro;  ?>">
<meta name="description" content="这是<?php  echo $name;  ?>中关于<?php  echo $category->Name;  ?>的分类目录,它包含<?php  echo $category->Intro;  ?>等内容的文章">
<?php } ?>
<?php if ($type=='article') { ?>
<title><?php  echo $title;  ?> - <?php  echo $name;  ?>-<?php  echo $subname;  ?></title>
<meta name="keywords" content="<?php  echo $article->Metas->mochu_guanjianzi;  ?>" />
<meta name="description" content="<?php  echo $article->Metas->mochu_description;  ?>" />
<?php } ?>
<?php if ($type=='page') { ?>
<title><?php  echo $title;  ?> - <?php  echo $name;  ?>-<?php  echo $subname;  ?></title>
<meta name="keywords" content="<?php  echo $article->Metas->mochu_guanjianzi;  ?>" />
<meta name="description" content="<?php  echo $article->Metas->mochu_description;  ?>" />
<?php } ?>
<?php if ($type=='tag') { ?>
<title><?php  echo $tag->Name;  ?> - <?php  echo $name;  ?>-<?php  echo $subname;  ?><?php if ($page>'1') { ?> - 第<?php  echo $pagebar->PageNow;  ?>页<?php } ?></title>
<meta name="Keywords" content="<?php  echo $tag->Name;  ?>,<?php  echo $tag->Intro;  ?>">
<meta name="description" content="这是<?php  echo $name;  ?>中关于<?php  echo $tag->Name;  ?>标签的分类目录页,它包含有<?php  echo $tag->Intro;  ?>等内容的文章">
<?php } ?>
<meta name="generator" content="<?php  echo $zblogphp;  ?>" />
<link rel="stylesheet" href="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/style.css" />
<link rel="stylesheet" href="http://apps.bdimg.com/libs/fontawesome/4.4.0/css/font-awesome.min.css" />
<script src="http://apps.bdimg.com/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
(window.jQuery) || document.write('<script type="text/javascript" src="<?php  echo $host;  ?>zb_system/script/jquery-1.8.3.min.js"><\/script>'); 
</script>
<script src="<?php  echo $host;  ?>zb_system/script/zblogphp.js" type="text/javascript"></script>
<script src="<?php  echo $host;  ?>zb_system/script/c_html_js_add.php" type="text/javascript"></script>
<script src="<?php  echo $host;  ?>zb_system/script/md5.js" type="text/javascript"></script>
<link href="<?php  echo $host;  ?>zb_users/cache/mochuimg/favicon.ico" rel="icon">
<link href="<?php  echo $host;  ?>zb_users/cache/mochuimg/favicon.ico" rel="shortcut icon">
<link href="<?php  echo $host;  ?>zb_users/cache/mochuimg/favicon.ico" rel="apple-touch-icon">
<?php  echo $header;  ?>
<?php if ($type=='index'&&$page=='1') { ?>
<link rel="alternate" type="application/rss+xml" href="<?php  echo $feedurl;  ?>" title="<?php  echo $name;  ?>" />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php  echo $host;  ?>zb_system/xml-rpc/?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php  echo $host;  ?>zb_system/xml-rpc/wlwmanifest.xml" />
<?php } ?>
</head>
<body>
<div class="use">
<div class="container padd">
<div class="lf">
<?php if ($user->ID>0) { ?>
<span class="cp-hello"></span><span class="cp-login"><a href="<?php  echo $host;  ?>zb_system/cmd.php?act=login"></a></span><span class="cp-vrs"><a href="<?php  echo $host;  ?>zb_system/cmd.php?act=misc&amp;type=vrs"></a></span><span class="logout"><a href="<?php  echo $host;  ?>zb_system/cmd.php?act=logout">注销</a></span>
<?php }else{  ?>
你好，欢迎访问我的博客！<a href="javascript:;" id="denglu">登录</a>
<?php } ?>
</div>
<div class="lr">
<?php  echo $zbp->Config('mochu')->headlink;  ?>
</div>
</div>
</div>
<header id="header">
	<div class="container padd">
		<h2 class="logo lf"><a href="<?php  echo $host;  ?>" title="<?php  echo $name;  ?>-<?php  echo $subname;  ?>" ><img src="<?php  echo $host;  ?>zb_users/cache/mochuimg/logo.png" alt="<?php  echo $name;  ?>-<?php  echo $subname;  ?>" title="<?php  echo $name;  ?>-<?php  echo $subname;  ?>"/></a></h2>
		<menu class="lr" id="nav">
			<ul class="pcmenu">
				<li id="navli"><a href="<?php  echo $host;  ?>" title="<?php  echo $name;  ?>" ><i class="fa fa-home"></i>首页</a></li>
				<?php if ($zbp->Config('mochu')->ontnav=="0") { ?>
				<?php  if(isset($modules['navbar'])){echo $modules['navbar']->Content;}  ?>
				<?php }else{  ?>
				<?php  echo $zbp->Config('mochu')->postnav;  ?>
				<?php } ?>
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
		<form name="search" method="post" action="<?php  echo $host;  ?>/zb_system/cmd.php?act=search"><input type="text" name="q" size="11" value="本站站内搜索" onFocus="if (value =='本站站内搜索'){value =''}" onBlur="if (value ==''){value='本站站内搜索'}" /> <button type="submit" ><i class="fa fa-search"></i></button></form>
<?php if ($zbp->Config('mochu')->baisouon) { ?>
<?php  echo $zbp->Config('mochu')->postbaidu;  ?>
<?php } ?></div>
</div>
</header>
<div id="yidongnavs">
<ul>
<li><a href="javascript:;" title="关闭" class="guanbi" id="guanbi">关闭</a></li>
<li id="wapnavli"><a href="<?php  echo $host;  ?>" title="<?php  echo $name;  ?>" ><i class="fa fa-home"></i>首页</a></li>
<?php if ($zbp->Config('mochu')->onydnav=="0") { ?>
<?php  if(isset($modules['navbar'])){echo $modules['navbar']->Content;}  ?>
<?php }else{  ?>
<?php  echo $zbp->Config('mochu')->postydnav;  ?>
<?php } ?>
</ul>
</div>