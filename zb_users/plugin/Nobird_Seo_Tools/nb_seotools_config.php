<?php
$Nobird_Plugin_Name="Nobird_Seo_Tools";
$Nobird_Plugin_Title=" - Nobird为您提供的SEO功能";


function Nobird_Seo_Tools_SubMenu(){
	global $zbp,$bloghost;
$url = $_SERVER['PHP_SELF'];
$filename1 = explode('/',$url);
$filename = end($filename1);
//echo $filename; // use filename ,judgment focus
		echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/main.php"><span class="m-left ' . ($filename=='main.php'?'m-now':'') . '">首页</span></a>';
		echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Sitemap/sitemap.php"><span class="m-left ' . ($filename=='sitemap.php'?'m-now':'') . '">地图&存档</span></a>';
		echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/KeyAndDes/keyanddes.php"><span class="m-left ' . ($filename=='keyanddes.php'?'m-now':'') . '">页面Meta设置</span></a>';
		echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/BeautyTitle/beautytitle.php"><span class="m-left ' . ($filename=='beautytitle.php'?'m-now':'') . '">标题优化</span></a>';
		echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/HtmlMinify/htmlminify.php"><span class="m-left ' . ($filename=='htmlminify.php'?'m-now':'') . '">页面压缩</span></a>';
		echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Keywordlink/kwlink.php"><span class="m-left ' . ($filename=='kwlink.php'?'m-now':'') . '">内链系统</span></a>';
    echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Nofollow/nofollow.php"><span class="m-left ' . ($filename=='nofollow.php'?'m-now':'') . '">NoFollow</span></a>';
    echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/ImgAlt/imgalt.php"><span class="m-left ' . ($filename=='imgalt.php'?'m-now':'') . '">ImgAlt</span></a>';
		echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Spider/spider.php"><span class="m-left ' . ($filename=='spider.php'?'m-now':'') . '">蜘蛛查看</span></a>';
		echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Robots/robots.php"><span class="m-left ' . ($filename=='robots.php'?'m-now':'') . '">Robots.txt</span></a>';

		if ($filename=='spider.php'||$filename=='spider_error.php'){
#	echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Spider/spider_error.php"><span class="m-left ' . ($filename=='spider_error.php'?'m-now':'') . '">蜘蛛抓取错误查看</span></a>';
#	echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Spider/output.php"><span class="m-left">导出到CSV文件</span></a>';
#	echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Spider/clear.php"><span class="m-left">清空数据</span></a>';
	}
		echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/help.php"><span class="m-right ' . ($filename=='help.php'?'m-now':'') . '">帮助</span></a>';

}






?>