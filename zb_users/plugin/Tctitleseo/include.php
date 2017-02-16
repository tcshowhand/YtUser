<?php
RegisterPlugin("Tctitleseo","ActivePlugin_Tctitleseo");

function ActivePlugin_Tctitleseo() {
	global $zbp;
	Add_Filter_Plugin('Filter_Plugin_Template_GetTemplate','Tctitleseo_ChangeHeader');
	Add_Filter_Plugin('Filter_Plugin_Admin_TopMenu','Tctitleseo_AddMenu');
	Add_Filter_Plugin('Filter_Plugin_ViewPost_Template','Tctitleseo_Content');
	Add_Filter_Plugin('Filter_Plugin_Edit_Response5','Tctitleseo_Filter_Plugin_Edit_Response5');
	Add_Filter_Plugin('Filter_Plugin_Category_Edit_Response','Tctitleseo_Category_Edit_Response');
}

function InstallPlugin_Tctitleseo(){
	global $zbp;
		if(!$zbp->Config('Tctitleseo')->title_keywords){
		$zbp->Config('Tctitleseo')->title_keywords='关键词';
		$zbp->Config('Tctitleseo')->title_description='描述';
		$zbp->Config('Tctitleseo')->title_change=true;
		$zbp->SaveConfig('Tctitleseo');
		}
}

function Tctitleseo_AddMenu(&$m){
	global $zbp;
	$m[]=MakeTopMenu("root",'SEO',$zbp->host . "zb_users/plugin/Tctitleseo/main.php","","topmenu_Tctitleseo");
}

function Tctitleseo_Content(&$template){
global $zbp;
if($zbp->Config('Tctitleseo')->title_picalt){
$article = $template->GetTags('article');
$pattern = "/<img(.*?)src=('|\")([^>]*).(bmp|gif|jpeg|jpg|png|swf)('|\")(.*?)>/i";
$replacement = '<img alt="'.$article->Title.'" src=$2$3.$4$5/>';
$content = preg_replace($pattern, $replacement, $article->Content);
$article->Content = $content;
$template->SetTags('article', $article);
}
}

function Tctitleseo_ChangeHeader($template,$file){
	global $zbp;
	$GLOBALS['Filter_Plugin_Template_GetTemplate']['Tctitleseo_ChangeHeader'] = PLUGIN_EXITSIGNAL_NONE;
	if($file=='header'){
		$GLOBALS['Filter_Plugin_Template_GetTemplate']['Tctitleseo_ChangeHeader'] = PLUGIN_EXITSIGNAL_RETURN;
		return $zbp->usersdir . 'plugin/Tctitleseo/titleseo.php';
	}
}



function Tctitleseo_Filter_Plugin_Edit_Response5(){
        global $zbp;
?>
            <textarea name="ueimg" id="ueimg" style="display:none"></textarea>
            <style>
            .txziduan table {width: 100%;}
            .txziduan tr td {vertical-align: middle;}
            .ias_trigger  {background-color: #5cb85c;color: #eee !important;display: block;font-size: 14px;line-height: 35px;text-align: center;}
            </style>

            <?php
	global $zbp,$article;
    echo "<script type=\"text/javascript\" src=\"{$zbp->host}zb_users/plugin/Tctitleseo/script/lib.upload.js\"></script>";
	echo '<div class="txziduan">';
	echo '<table id="nbdiany">
    <p align="left" class="uploadimg">需要图片的时候使用：
<input name="meta_tccptu" id="edtTitle" type="text" class="uplod_img" style="width: 60%;" value="'.$article->Metas->tccptu.'" />
<strong class="button" style="
    color: #ffffff;    font-size: 1.1em;    height: 29px;      padding: 6px 18px 6px 18px;    margin: 0 0.5em;    background: #3a6ea5;    border: 1px solid #3399cc;    cursor: pointer;
">浏览文件</strong>
</p>
    <tr>
    <td width="14%">关键词</td>
    <td><input style="width:95%" name="meta_tc_keywords" value="'.$article->Metas->tc_keywords.'"/></td>
    </tr>
    <tr>
    <td width="14%">描述</td>
    <td><input style="width:95%" name="meta_tc_description" value="'.$article->Metas->tc_description.'"/></td>
    </tr>
    <tr>
	';	
            echo '</table>';
            echo'<br/></div>';
}

function Tctitleseo_Category_Edit_Response() {
    global $zbp,$cate;
    echo '
      <p>
        <span class="title">关键词:</span><br />
        <textarea name="meta_tc_keywords" type="text" id="edtIntro" style="width:98%;">' . $cate->Metas->tc_keywords . '</textarea>
      </p>
      <p>
        <span class="title">描述:</span><br />
        <textarea name="meta_tc_description" type="text" id="edtIntro" style="width:98%;">' . $cate->Metas->tc_description . '</textarea>
      </p>
    ';
}

function UninstallPlugin_Tctitleseo(){
	global $zbp;

}
?>