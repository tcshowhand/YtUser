<?php
/*
 * @package z_hide(回复或登录可见)
 * @version 1.0
Plugin Name: 回复或登录可见
Plugin URI: 
Description: 本插件可以隐藏文章中的任意部分内容，当访客登录或评论后可查看隐藏内容
Author: Mr.
Version: 1.0
Author URI: http://dafuli.net
*/

#注册插件
RegisterPlugin("z_hide","ActivePlugin_z_hide");

function ActivePlugin_z_hide() {
	Add_Filter_Plugin('Filter_Plugin_PostComment_Succeed', 'z_hide_comm');
	Add_Filter_Plugin('Filter_Plugin_ViewPost_Template','z_hide_html');
	Add_Filter_Plugin('Filter_Plugin_Edit_Response3', 'z_hide_Edit');
}
function z_hide_html(&$template){
	global $zbp;
	$PID=$template->GetTags('article')->ID;
	$content=$template->GetTags('article')->Content;
	$template->GetTags('article')->Content=z_hide_str($content,$PID);
}
function InstallPlugin_z_hide() {}
function UninstallPlugin_z_hide() {
	global $zbp;
	$zbp->DelConfig('z_hide');
}
function z_hide_comm(&$cmt){
	global $zbp;
	$CmtLogID = $cmt->LogID;
	setcookie("comment_cv_".$CmtLogID, "1", time()+86400, "/");
}
function z_hide_str($str,$pid){//
	global $zbp;
	$z_hide_Login=$zbp->Config('z_hide')->z_hide_Login;
	$z_hide_Register=$zbp->Config('z_hide')->z_hide_Register;
	$z_hide_User=$zbp->Config('z_hide')->z_hide_User;
	$z_hide_Commnet=$zbp->Config('z_hide')->z_hide_Commnet;
	if($z_hide_User == ''){
		$z_hide_User=$zbp->user->Url;
	} 
	preg_match_all('/<p[^>]*>[^<]*\[hide_[l|c]v\][\s\S]*?[^<]*<\/p>(.+?)<p[^>]*>[^<]*\[\/hide_[l|c]v\][\s\S]*?[^<]*<\/p>/is',$str,$mat);
	$x=count($mat[0]);
	if ($x>0)
	{
		if(preg_match_all('/<p[^>]*>[^<]*\[hide_cv\][\s\S]*?[^<]*<\/p>(.+?)<p[^>]*>[^<]*\[\/hide_cv\][\s\S]*?[^<]*<\/p>/is', $str,$mat_cv)){
			if($zbp->user->ID >0 || isset($_COOKIE["comment_cv_".$pid])){
				foreach( $mat_cv[0] as $key=>$val ){
                $str = str_replace($val,'<div style="border:1px dashed #999; padding:10px; margin:10px 0; line-height:200%;  background-color:#f9f9f9; overflow:hidden; clear:both;"><span style="font-size:16px;color:#07a00d">以下是评论可见内容。</span><span style="color:#F44336;font-size:14px;">(已评论)</span>'.$mat_cv[1][$key].'</div>', $str);
				}
			}else{
				$hide_cv = '<div style="border:1px dashed #999; padding:10px; margin:10px 0; line-height:200%; color:#F00; background-color:#f9f9f9; overflow:hidden; clear:both;"><span style="font-size:18px;color:#777;">此处内容需要评论后才能查看。</span><div style="clear:left;"></div><a rel="nofollow" href="'.$z_hide_Commnet.'" title="点击评论" style="color:#00BF30">点击去评论</a></div>';
				$str = str_replace($mat_cv[0], $hide_cv, $str);	
			}	
		}
		if(preg_match_all('/<p[^>]*>[^<]*\[hide_lv\][\s\S]*?[^<]*<\/p>(.+?)<p[^>]*>[^<]*\[\/hide_lv\][\s\S]*?[^<]*<\/p>/is', $str,$mat_lv)){
			if($zbp->user->ID > 0){
				foreach( $mat_lv[0] as $key=>$val ){
                $str = str_replace($val,'<div style="border:1px dashed #F60; padding:10px; margin:10px 0; line-height:200%;  background-color:#FFF4FF; overflow:hidden; clear:both;"><span style="font-size:16px;color:#03A9F4">亲爱的用户：[<span><a style="color:#07a00d" target="_blank" rel="nofollow" href="'.$z_hide_User.'">'.$zbp->user->Name.'</a></span>] 以下是登录可见的内容。</span>'.$mat_lv[1][$key].'</div>', $str);

				}
			}else{
				$hide_notice = '<div style="border:1px dashed #F60; padding:10px; margin:10px 0; line-height:200%; color:#F00; background-color:#FFF4FF; overflow:hidden; clear:both;"><span style="font-size:18px;">此处内容已经被作者隐藏，需要登录才能查看。</span><div style="clear:left;"></div><a target="_blank" rel="nofollow" href="'.$z_hide_Login.'" title="登陆" style="color:#00BF30">点击登陆</a>&nbsp;<a target="_blank" rel="nofollow" href="'.$z_hide_Register.'" title="注册" style="color:#00BF30">注册账号?</a></div>';
				$str = str_replace($mat_lv[0], $hide_notice, $str);
			}
			//return $str;
		}
		return $str;
	}else{
	return $str;
}}
function z_hide_Edit(){
global $zbp;	
   	echo '<a href="javascript:void(0);" onclick="add_z_hide_lv();">[登陆可见]</a>';
	echo '<a href="javascript:void(0);" onclick="add_z_hide_cv();">[回复可见]</a>';
	echo '<script type=\'text/javascript\' charset="utf-8"  src=\''.$zbp->host.'zb_users/plugin/z_hide/edit.js\'></script>';
}