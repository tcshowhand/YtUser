<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="u8">
<!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php  echo $name;  ?>-<?php  echo $title;  ?></title>
<meta name="author" content="豫唐网络">

<!-- Bootstrap -->
<link rel="stylesheet" type="text/css"  href="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/fonts/font-awesome/css/font-awesome.css">

<!-- Nivo Lightbox
================================================== -->
<link rel="stylesheet" href="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/css/nivo-lightbox.css" >
<link rel="stylesheet" href="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/css/nivo_lightbox_themes/default/default.css">

<!-- Stylesheet
================================================== -->
<link rel="stylesheet" type="text/css"  href="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/<?php  echo $style;  ?>.css">
<link rel="stylesheet" type="text/css" href="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/css/responsive.css">

<script src="<?php  echo $host;  ?>zb_system/script/common.js" type="text/javascript"></script>
<script src="<?php  echo $host;  ?>zb_system/script/c_html_js_add.php" type="text/javascript"></script>
<?php  echo $header;  ?>
<?php if ($type=='index'&&$page=='1') { ?>
	<link rel="alternate" type="application/rss+xml" href="<?php  echo $feedurl;  ?>" title="<?php  echo $name;  ?>" />
	<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php  echo $host;  ?>zb_system/xml-rpc/?rsd" />
	<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php  echo $host;  ?>zb_system/xml-rpc/wlwmanifest.xml" />
<?php } ?>