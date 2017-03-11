<?php  /* Template Name:页头 */  ?>

<?php 
$post_css = null;
$post_js = null;
if ($type == 'article'){
	if ($article->Metas->post_css)$post_css = $article->Metas->post_css;
	if ($article->Metas->post_script)$post_js = $article->Metas->post_script;
}
 ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="Share-Source-Verification" content="<?php  echo $host;  ?>">
<meta http-equiv="Cache-Control" content="no-transform">
<meta http-equiv="Cache-Control" content="no-siteapp">
<meta name="generator" content="<?php  echo $zblogphp;  ?>" />
<?php if ($zbp->Config('dmam')->headmate) { ?><?php  echo $zbp->Config('dmam')->headmate;  ?><?php } ?>
<?php if ($zbp->Config('dmam')->theme_seo) { ?>
<?php  include $this->GetTemplate('b_header_seo');  ?>
<?php }else{  ?>
<!-- 主题自带SEO关闭 -->
<title><?php  echo $name;  ?><?php if ($title) { ?>-<?php  echo $title;  ?><?php } ?></title>
<?php } ?>
<?php  echo dmam_load_source('header',$type,$post_js);  ?>
<?php  echo $header;  ?>
<link rel="stylesheet" href="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/<?php  echo $style;  ?>.css" type="text/css" media="all"/>
<?php if ($zbp->Config('dmam')->apple_ico) { ?>
<link rel="apple-touch-icon-precomposed" href="<?php  echo $zbp->Config('dmam')->apple_ico;  ?>">
<meta name="apple-mobile-web-app-title" content="<?php if ($type == 'article') { ?><?php  echo $article->Title;  ?><?php }else{  ?><?php  echo $name;  ?><?php } ?>"/>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<?php } ?>
<?php if ($type=='index'&&$page=='1') { ?>
<link rel="alternate" type="application/rss+xml" href="<?php  echo $feedurl;  ?>" title="<?php  echo $name;  ?>" />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php  echo $host;  ?>zb_system/xml-rpc/?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php  echo $host;  ?>zb_system/xml-rpc/wlwmanifest.xml" /> 
<?php } ?>
<?php if ($zbp->Config('dmam')->pics_fv) { ?>
<link rel="shortcut icon" href="<?php  echo $zbp->Config('dmam')->pics_fv;  ?>"><?php }else{  ?><link rel="shortcut icon" href="<?php  echo $host;  ?>favicon.ico">
<?php } ?>
<?php  echo dmam_head_css($post_css);  ?>
</head>
<body class="D_M <?php  echo $type;  ?> <?php  echo $zbp->Config('dmam')->topbar_fix?'dm-topbar-fixed':'';  ?>">