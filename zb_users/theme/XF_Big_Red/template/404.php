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
{* Template Name:404错误页 *}
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<meta http-equiv="Cache-Control" content="no-transform" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<meta name="applicable-device" content="pc,mobile">
<meta name="viewport" content="width=device-width,initial-scale=1.33,minimum-scale=1.0,maximum-scale=1.0">
<title>404 - 对不起，您查找的页面不存在！</title>
<style>
html, body, div, span, h1, h2, p, a, em, ul, li, form{margin: 0;padding: 0;border: 0;font-size: 100%;font: inherit;vertical-align: baseline;outline: none;}
html{height: 100%;}
body{height: 100%; font-size: 62.5%; line-height: 1; font-family: Arial, Tahoma, Verdana, sans-serif;}
ul{list-style: none;}
input{outline: none}
a{text-decoration: none}
a:hover{text-decoration: underline}
.clear{clear: both;zoom: 1}
.clear:before{content: ""; display: table;}
.clear:after{clear: both}
body{background: #dfdfdf url({$host}zb_users/theme/{$theme}/style/images/404_bg.jpg) repeat; font-family: Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; overflow: hidden;}
@-webkit-keyframes main{0%{-webkit-transform: scale3d(0.1, 0.1, 1); opacity: 0;}45%{-webkit-transform: scale3d(1.07, 1.07, 1); opacity: 1;}70%{-webkit-transform: scale3d(0.95, 0.95, 1)}100%{-webkit-transform: scale3d(1, 1, 1)}}
@-moz-keyframes main{0%{-moz-transform: scale(0.1, 0.1); opacity: 0;}45%{-moz-transform: scale(1.07, 1.07); opacity: 1;}70%{-moz-transform: scale(0.95, 0.95)}100%{-moz-transform: scale(1, 1)}}
@-webkit-keyframes logo{0%{opacity: 0}100%{opacity: 1}}
@-webkit-keyframes footer{0%{top: -30px}100%{top: 0}}
.clear{clear: both}
.clear:before,
.container:after{content: ""; display: table;}
.clear:after{clear: both}
.clear{zoom: 1}
.left{float: left}
.right{float: right}
#main{position: relative; width: 600px; margin: 0 auto; padding: 4% 0; animation: main .8s 1; animation-fill-mode: forwards; -webkit-animation: main .8s 1; -webkit-animation-fill-mode: forwards; -moz-animation: main .8s 1; -moz-animation-fill-mode: forwards; -o-animation: main .8s 1; -o-animation-fill-mode: forwards; -ms-animation: main .8s 1; -ms-animation-fill-mode: forwards;}
#main #header h1{position: relative; display: block; font: 72px 'TeXGyreScholaBold', Arial, sans-serif; color: #0061a5; text-shadow: 2px 2px #f7f7f7; text-align: center;}
#main #header h1 span.sub{position: relative; font-size: 21px; top: -20px; padding: 0 10px; font-style: italic;}
#main #header h1 span.icon{position: relative; display: inline-block; top: -6px; margin: 0 10px 5px 0; background: #0061a5; width: 50px; height: 50px; -moz-box-shadow: 1px 2px white; -webkit-box-shadow: 1px 2px white; box-shadow: 1px 2px white; -webkit-border-radius: 50px; -moz-border-radius: 50px; border-radius: 50px; color: #dfdfdf; font-size: 46px; line-height: 48px; font-weight: bold; text-align: center; text-shadow: 0 0;}
#main #content{position: relative; width: 600px; background: white; -moz-box-shadow: 0 0 0 3px #ededed inset, 0 0 0 1px #a2a2a2, 0 0 20px rgba(0,0,0,.15); -webkit-box-shadow: 0 0 0 3px #ededed inset, 0 0 0 1px #a2a2a2, 0 0 20px rgba(0,0,0,.15); box-shadow: 0 0 0 3px #ededed inset, 0 0 0 1px #a2a2a2, 0 0 20px rgba(0,0,0,.15); -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; z-index: 5;}
#main #content h2{background: url({$host}zb_users/theme/{$theme}/style/images/404_s-divider.jpg) no-repeat; background-position: bottom; padding: 12px 0 22px 0; font: 20px 'TeXGyreScholaRegular', Arial, sans-serif; color: #8e8e8e; text-align: center;}
#main #content p{position: relative; padding: 20px; font-size: 13px; line-height: 25px;text-indent: 2em; color: #b5b5b5;}
#main #content .utilities{padding: 20px;text-align: center;text-align: -moz-center !important;text-align: -webkit-center;}
#main #content .utilities form .input-container{position: relative; width: 290px;text-align: center; margin: 0 auto;}
#main #content .utilities form .input-container input[type=text]{width: 280px; height: 34px; padding: 0 8px; background: #F1F1F1; border: solid 1px #cdcdcd; outline: none; -moz-box-shadow: 0 3px 3px rgba(0,0,0,.05) inset; -webkit-box-shadow: 0 3px 3px rgba(0,0,0,.05) inset; box-shadow: 0 3px 3px rgba(0,0,0,.05) inset; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; font-size: 14px; color: #696969; -webkit-font-smoothing: antialiased; transition: all 0.3s ease-in-out; -webkit-transition: all 0.3s ease-in-out; -moz-transition: all 0.3s ease-in-out; -o-transition: all 0.3s ease-in-out; -ms-transition: all 0.3s ease-in-out;}
#main #content .utilities .input-container input[type=text]:focus{border: solid 1px #9f9f9f}
.fa-search{position: absolute; top: 6px; right: 2px; font-size: 20px; color: #696969;}
#main #content .utilities form .input-container button#search:hover{opacity: .6}
#main #content .buttons{text-align: center;margin-bottom: 20px;}
#main #content .buttons .button{display: inline-block; height: 34px; margin: 0 0 0 6px; padding: 0 18px; background: #006db0; background-image: linear-gradient(bottom, #0062a6 0%, #0079bb 100%); background-image: -o-linear-gradient(bottom, #0062a6 0%, #0079bb 100%); background-image: -moz-linear-gradient(bottom, #0062a6 0%, #0079bb 100%); background-image: -webkit-linear-gradient(bottom, #0062a6 0%, #0079bb 100%); background-image: -ms-linear-gradient(bottom, #0062a6 0%, #0079bb 100%); -moz-box-shadow: 0 0 0 1px #003255, 0 1px 3px rgba(0, 50, 85, 0.5), 0 1px #00acd8 inset; -webkit-box-shadow: 0 0 0 1px #003255, 0 1px 3px rgba(0, 50, 85, 0.5), 0 1px #00acd8 inset; box-shadow: 0 0 0 1px #003255, 0 1px 3px rgba(0, 50, 85, 0.5), 0 1px #00acd8 inset; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; font-size: 14px; line-height: 34px; color: white; font-weight: bold; text-shadow: 0 -1px #00385a; text-decoration: none;}
#main #content .buttons .button:hover{background: #0081c6; background-image: linear-gradient(bottom, #006fbb 0%, #008dce 100%); background-image: -o-linear-gradient(bottom, #006fbb 0%, #008dce 100%); background-image: -moz-linear-gradient(bottom, #006fbb 0%, #008dce 100%); background-image: -webkit-linear-gradient(bottom, #006fbb 0%, #008dce 100%); background-image: -ms-linear-gradient(bottom, #006fbb 0%, #008dce 100%); -moz-box-shadow: 0 0 0 1px #003255, 0 1px 3px rgba(0, 50, 85, 0.5), 0 1px #00c1e4 inset; -webkit-box-shadow: 0 0 0 1px #003255, 0 1px 3px rgba(0, 50, 85, 0.5), 0 1px #00c1e4 inset; box-shadow: 0 0 0 1px #003255, 0 1px 3px rgba(0, 50, 85, 0.5), 0 1px #00c1e4 inset;}
#main #content .buttons .button:active{background: #0081c6; background-image: linear-gradient(bottom, #008dce 0%, #006fbb 100%); background-image: -o-linear-gradient(bottom, #008dce 0%, #006fbb 100%); background-image: -moz-linear-gradient(bottom, #008dce 0%, #006fbb 100%); background-image: -webkit-linear-gradient(bottom, #008dce 0%, #006fbb 100%); background-image: -ms-linear-gradient(bottom, #008dce 0%, #006fbb 100%); -moz-box-shadow: 0 0 0 1px #003255, 0 1px 3px rgba(0, 50, 85, 0.5), 0 1px #00c1e4 inset; -webkit-box-shadow: 0 0 0 1px #003255, 0 1px 3px rgba(0, 50, 85, 0.5), 0 1px #00c1e4 inset; box-shadow: 0 0 0 1px #003255, 0 1px 3px rgba(0, 50, 85, 0.5), 0 1px #00c1e4 inset;}
#main #content .utilities .button-container .button:focus{color: black}
#main #footer{position: relative; margin:10px 0 0 0; padding: 5px 0; text-align: center; z-index: 1; animation: footer .4s .8s 1; animation-fill-mode: forwards; -webkit-animation: footer .4s .8s 1; -webkit-animation-fill-mode: forwards; -moz-animation: footer .4s .8s 1; -moz-animation-fill-mode: forwards; -o-animation: footer .4s .8s 1; -o-animation-fill-mode: forwards; -ms-animation: footer .4s .8s 1; -ms-animation-fill-mode: forwards;}
#main #footer ul{font: 13px 'TeXGyreScholaRegular', Arial, sans-serif; text-shadow: 0 1px white;}
#main #footer ul li{display: inline;}
#main #footer ul li a{font: 13px 'TeXGyreScholaRegular', Arial, sans-serif; color: #696969; text-shadow: 0 1px white; text-decoration: none;}
#main #footer ul li a:hover{color: #0061a5; text-decoration: underline;}
@media screen and (max-width: 610px){#main,#main #content{width: 99%;margin: 0 auto;}}
@media screen and (max-width: 480px){#main #content .utilities form .input-container{width:100%}#main #content .utilities form .input-container input[type=text]{width: 97%;}}
</style>
</head>
<body>
	<div id="main">
		<header id="header">
			<h1><span class="icon">!</span>404<span class="sub">not found</span></h1>
		</header>
		<div id="content">
			<h2>您打开的这个的页面不存在！</h2>
			<p>当您看到这个页面，表示您的访问出错，这个错误是您打开的页面不存在，请确认您输入的地址是正确的，如果是在本站点击后出现这个页面，请联系站长进行处理，或者请通过下边的搜索重新查找资源，{$name}感谢您的支持!</p>
			<div class="utilities">
				<form name="search" method="post" class="s-form" id="formkeyword" action="{$host}zb_system/cmd.php?act=search">
					<div class="input-container">
						<input name="q" size="11" autocomplete="off" id="edtSearch" type="text" class="s-key left" value="在这里搜索..." onfocus="if(this.value=='在这里搜索...'){this.value='';}"  onblur="if(this.value==''){this.value='在这里搜索...';}" onkeyup="lookup(this.value);" placeholder="搜索..." style="border:0"/>
						<input value="搜 索" id="btnPost" type="submit"  class="s-sub tra"  style="display:none"/>
						<i class="fa fa-search"></i>
					</div>
				</form>
				<div class="clear"></div>
			</div>
			<div class="buttons">
				<span><a class="button" href="#" onClick="history.go(-1);return true;">返回上页</a></span>
				<span><a class="button" href="{$host}">返回首页</a></span>
			</div>
			<div class="clear"></div>
		</div>
		<div id="footer">
			<ul>
				Powered By <li><a href="http://www.zblogcn.com/" rel="nofollow" target="_blank"> ZblogPhp</a></li>,Template By <li><a href="http://Www.SongHaiFeng.Com" target="_blank"> 小锋博客</a></li>
			</ul>
		</div>
	</div>
</body>
</html>