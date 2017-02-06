<?php
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config.php';
RegisterPlugin("YT_johndoe","ActivePlugin_YT_johndoe");

function ActivePlugin_YT_johndoe() {
Add_Filter_Plugin('Filter_Plugin_Admin_TopMenu','YT_johndoe_AddMenu');
Add_Filter_Plugin('Filter_Plugin_Edit_Response5','YT_johndoe_Filter_Plugin_Edit_Response5');
}

function YT_johndoe_AddMenu(&$m){
    global $zbp;
    array_unshift($m, MakeTopMenu("root",'主题配置',$zbp->host . "zb_users/theme/YT_johndoe/main.php?act=config","","topmenu_YT_johndoe"));
}

function YT_johndoe_Filter_Plugin_Edit_Response5(){
global $zbp,$article;
echo "<script type=\"text/javascript\" src=\"{$zbp->host}zb_users/theme/YT_johndoe/script/lib.upload.js\"></script>";
echo '<p align="left" class="uploadimg">需要图片的时候使用：
<input name="meta_pic" id="edtTitle" type="text" class="uplod_img" style="width: 60%;" value="'.$article->Metas->pic.'" />
<strong class="button" style="
    color: #ffffff;    font-size: 1.1em;    height: 29px;      padding: 6px 18px 6px 18px;    margin: 0 0.5em;    background: #3a6ea5;    border: 1px solid #3399cc;    cursor: pointer;
">浏览文件</strong>
</p>';
}

function InstallPlugin_YT_johndoe(){
	global $zbp;
	//配置初始化	
        $zbp->Config('YT_johndoe')->casea=1;
        $zbp->Config('YT_johndoe')->caseb=1;
        $zbp->Config('YT_johndoe')->pagea=2;
        $zbp->Config('YT_johndoe')->pageb=2;
        $zbp->Config('YT_johndoe')->pagec=2;
        $zbp->Config('YT_johndoe')->paged=2;
        $zbp->Config('YT_johndoe')->pagee=2;
        $zbp->SaveConfig('YT_johndoe');
}

function UninstallPlugin_YT_johndoe() {
	global $zbp;
}
?>