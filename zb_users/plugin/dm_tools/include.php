<?php
require dirname(__FILE__) . DIRECTORY_SEPARATOR .'thumb/dm_tools_thumb.php';
require dirname(__FILE__) . DIRECTORY_SEPARATOR .'remoteimg/dm_tools_remoteimg.php';
require dirname(__FILE__) . DIRECTORY_SEPARATOR .'articleimg/dm_tools_articleimg.php';
$dm_tools = array(
	"name" => "dm_tools",
	"id" => "",
	"type" => "plugin",
	"path" => dirname(__FILE__) . DIRECTORY_SEPARATOR,
	"url" => $GLOBALS['zbp']->host."zb_users/plugin/dm_tools/"
);
RegisterPlugin("dm_tools","ActivePlugin_dm_tools");

function ActivePlugin_dm_tools() {
	global $zbp,$dm_tools;
	Add_Filter_Plugin('Filter_Plugin_Edit_Begin','dm_tools_editor_begin');
	Add_Filter_Plugin('Filter_Plugin_Zbp_MakeTemplatetags','dm_tools_make_templatetags');
	Add_Filter_Plugin('Filter_Plugin_PostArticle_Core','dm_tools_remoteimg_main');
	Add_Filter_Plugin('Filter_Plugin_ViewPost_Template','dm_tools_articleimg_main');
	Add_Filter_Plugin('Filter_Plugin_ViewList_Core','dm_tools_ViewList_Core');
if ($zbp->CheckPlugin('my_tinymce')&&$zbp->Config($dm_tools['name'])->dm_tools_ueditorplugs_tinymce) {
	Add_Filter_Plugin('Filter_Plugin_My_Tinymce_Plugin','dm_tools_my_tinymce');
	Add_Filter_Plugin('Filter_Plugin_My_Tinymce_Buttons_2','dm_tools_my_tinymce_addbuttons');
	Add_Filter_Plugin('Filter_Plugin_My_Tinymce_JSHolder','dm_tools_my_tinymce_addjs');
	Add_Filter_Plugin('Filter_Plugin_My_Tinymce_EditorStyle','dm_tools_my_tinymce_addcss');
}
}
//过滤列表
function dm_tools_ViewList_Core(&$type,&$page,&$category,&$author,&$datetime,&$tag,&$w,&$pagebar){
	global $zbp,$dm_tools;;
	if ($zbp->Config($dm_tools['name'])->clist){
		if (strpos($zbp->Config($dm_tools['name'])->clist,':')){
			$arraylist = explode(':',$zbp->Config($dm_tools['name'])->clist);
			$arraylist_types = explode('|',$arraylist[0]);
			$arraylist_ids = explode('|',$arraylist[1]);
				if (in_array($type,$arraylist_types)){
							$w[]=array('NOT IN','log_ID',$arraylist_ids);
				}
		}else{
			$arraylist = explode('|',$zbp->Config($dm_tools['name'])->clist);
			$w[]=array('NOT IN','log_ID',$arraylist);
		}
	}
	if ($zbp->Config($dm_tools['name'])->clist_cat){
		if (strpos($zbp->Config($dm_tools['name'])->clist_cat,':')){
			$array_list = explode(':',$zbp->Config($dm_tools['name'])->clist_cat);
			$array_list_types = explode('|',$array_list[0]);
			$array_list_ids = explode('|',$array_list[1]);
		if (in_array($type,$array_list_types)){
			$w[]=array('NOT IN','log_CateID',$array_list_ids);
			}
		}else{
			$array_list = explode('|',$zbp->Config($dm_tools['name'])->clist_cat);
			$w[]=array('NOT IN','log_CateID',$array_list);
		}
	}

}
function dm_tools_make_templatetags(&$template){
	global $zbp,$dm_tools;
	if ($zbp->Config($dm_tools['name'])->x_head_title) {
		$zbp->header .= "<script type=\"text/javascript\">
   var OriginTitile = document.title;
    var titleTime;
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            document.title = '{$zbp->Config($dm_tools['name'])->x_head_outtitle}';
            clearTimeout(titleTime);
        }
        else {
            document.title = '{$zbp->Config($dm_tools['name'])->x_head_intitle} ' + OriginTitile;
            titleTime = setTimeout(function() {
                document.title = OriginTitile;
            }, 2000);
        }
    });
		</script>\n";
	}
	if ($zbp->CheckPlugin('UEditor')&&$zbp->Config($dm_tools['name'])->dm_tools_ueditorplugs_ueditor) {
		$zbp->header .='<link rel="stylesheet" rev="stylesheet" href="'. $dm_tools['url'].'editorplugs/uebuttons-post.css" type="text/css" media="all"/>';
	}
		$zbp->footer .= $zbp->Config($dm_tools['name'])->dm_tools_autobaidu_switch?"<script>(function(){var bp = document.createElement('script');bp.src = '//push.zhanzhang.baidu.com/push.js';var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(bp, s);})();</script>":'';
		if ($zbp->Config($dm_tools['name'])->dm_tools_autoso){
		$zbp->footer .= '<script>(function(){var src = (document.location.protocol == "http:") ? "http://js.passport.qihucdn.com/11.0.1.js?'.$zbp->Config($dm_tools['name'])->dm_tools_autoso.'":"https://jspassport.ssl.qhimg.com/11.0.1.js?'.$zbp->Config($dm_tools['name'])->dm_tools_autoso.'";document.write(\'<script src="\' + src + \'" id="sozz"><\/script>\');})();</script>';	
		}	

}
//tiny的按钮
function dm_tools_my_tinymce(&$plugins){
global $zbp,$dm_tools;
  $plugins[]=$dm_tools['name'];
}

function dm_tools_my_tinymce_addbuttons(&$mce_buttons){
global $zbp,$dm_tools;
  if ($zbp->CheckRights('root')) {
  $mce_buttons[]=$dm_tools['name'];
 }
}

function dm_tools_my_tinymce_addjs(){
global $zbp,$dm_tools;
  echo '<script src="'.$dm_tools['url'].'editorplugs/tinymcebuttons.js" type="text/javascript"></script>'."\r\n";

}
function dm_tools_my_tinymce_addcss(&$mce_css){
  global $zbp,$dm_tools;
  $mce_css[]=$dm_tools['url'].'editorplugs/tinymcebuttons.css';
}

//Uditor按钮
function dm_tools_editor_begin(){
	global $zbp,$dm_tools;
	 echo $zbp->Config($dm_tools['name'])->dm_tools_autotags_switch?"<script src='" . $dm_tools['url'] . "autotags/plugin.js' type='text/javascript'></script>":'';
	if ($zbp->CheckPlugin('UEditor')&&$zbp->Config($dm_tools['name'])->dm_tools_ueditorplugs_ueditor) {
	echo '<script src="'. $dm_tools['url'].'editorplugs/uebuttons-editor.js" type="text/javascript"></script>';
	}
}

function dm_tools_base64_encode($string) {
   $data = base64_encode($string);
   $data = str_replace(array('+','/','='),array('~','_',''),$data);
   return $data;
}
function dm_tools_base64_decode($string) {
   $data = str_replace(array('-','_'),array('+','/'),$string);
   $mod4 = strlen($data) % 4;
   if ($mod4) {
	   $data .= substr('====', $mod4);
   }
   return base64_decode($data);
}    
function dm_tools_deleteDir($dirName){ 
	if(is_dir($dirName)&&file_exists($dirName)){
		if ( $handle = opendir( "$dirName" ) ) {  
			while ( false !== ( $item = readdir( $handle ) ) ) {  
				if ( $item != "." && $item != ".." ) {  
					if ( is_dir( "$dirName/$item" ) ) {  
						dm_tools_deleteDir( "$dirName/$item" );  
					} else {  
						unlink( "$dirName/$item" );
					}
				}  
			}  
	   }  
		closedir( $handle );  
		rmdir( $dirName );
	}
}

function dm_tools_save_config($a_sets_array,$b_redirect,$c_message) {
	global $zbp,$dm_tools;
		foreach ($a_sets_array as $key=>$a_set){
			$zbp->Config($dm_tools['name'])->$key = $a_set?GetVars($key,'POST'):GetVarsByDefault($key,'POST',$a_set);;
		}
		$zbp->SaveConfig($dm_tools['name']);
		$zbp->SetHint('good',$c_message);
		Redirect($b_redirect);
}
function dm_tools_default_config($a_sets_array,$haskey) {
	global $zbp,$dm_tools;
	if (!is_array($a_sets_array))return;
	if(!$zbp->Config($dm_tools['name'])->HasKey($haskey)) {
		foreach ($a_sets_array as $key=>$a_set){
		$zbp->Config($dm_tools['name'])->$key=$a_set?$a_set:false;
		}
		$zbp->SaveConfig($dm_tools['name']);	
	}
}
$dm_tools_configs_dmt = array(
	'version' => '1.1',
	"dm_tools_remoteimg_switch" => false,
	"dm_tools_autotags_switch" => true,
	"dm_tools_autobaidu_switch" => false,
	"dm_tools_autoso" => '',
	"dm_tools_ueditorplugs_ueditor" => true,
	"dm_tools_ueditorplugs_tinymce" => '',
	"clist_cat" => "",
	"clist" => "",
	"x_head_outtitle" => "",
	"x_head_intitle" => ""
);
$dm_tools_configs_articleimg = array(
	"dm_tools_articleimg_xtitle" => 2,
	"dm_tools_articleimg_xalt" => 2,
	"dm_tools_articleimg_lasttxt" => '第%d张'
);
$dm_tools_configs_thumb = array(
	"dm_tools_thumb_switch" => true,
	"dm_tools_thumb_remoteimg" => true,
	"dm_tools_thumb_checkhost" => false,
	"dm_tools_thumb_checkhostin" => false,
	"dm_tools_thumb_changeurl" => false
);
$dm_tools_configs_all = array_merge(
	$dm_tools_configs_dmt,
	$dm_tools_configs_articleimg,
	$dm_tools_configs_thumb
);
function InstallPlugin_dm_tools() {
	global $zbp,$dm_tools_configs_all;
	dm_tools_default_config($dm_tools_configs_all,"version");
}
function UninstallPlugin_dm_tools() {
	global $zbp,$blogpath,$dm_tools;
	dm_tools_deleteDir($blogpath.'thumbs/');
	$zbp->DelConfig($dm_tools['name']);
}