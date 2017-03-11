<?php
function mochu_addleft(&$n){
	global $zbp;
	$n[]=MakeTopMenu("root","墨初主题高级版配置",$zbp->host . "zb_users/theme/mochu/editor.php?act=jiben","","topmenu_mochu");
	}
/*后台列表函数*/
function mochu_SubMenu($id){
	$arySubMenu = array(
		0 => array('前端设置', 'yangshi', 'left', false),
        1 => array('基本设置', 'jiben', 'left', false),
		2 => array('幻灯片', 'huandeng', 'left', false),
		3 => array('广告设置', 'agd', 'left', false),		
		4 => array('首页公告', 'gonggao', 'left', false),
		5 => array('搜索优化', 'youhua', 'left', false),
	);
	foreach($arySubMenu as $k => $v){
		echo '<a href="?act='.$v[1].'" '.($v[3]==true?'target="_blank"':'').'><span class="m-'.$v[2].' '.($id==$v[1]?'m-now':'').'">'.$v[0].'</span></a>';
	}
}
/*结束*/
function mochu_shuju(){
		global $zbp;
	//配置初始化	
if(!$zbp->Config('mochu')->HasKey('version'))
	{   $zbp->Config('mochu')->version = '3.1';
	    $zbp->Config('mochu')->peizhishuju = '0';
		$zbp->Config('mochu')->postshop = '1';
		$zbp->Config('mochu')->postbaidu = '<form target="_blank" action="http://so.feiniaomy.com/cse/site">
<input type="text" name="q"  value="百度站内搜索" onFocus="if (value ==\'百度站内搜索\'){value =\'\'}" onBlur="if (value ==\'\'){value=\'百度站内搜索\'}">
<button type="submit" ><i class="fa fa-search"></i></button><input type="hidden" name="cc" value="http://c.feiniaomy.com"></form>';
	    $zbp->Config('mochu')->onimg = '1';
		$zbp->Config('mochu')->onzhiimg = '1';
		$zbp->Config('mochu')->onslimg = '1';
		$zbp->Config('mochu')->ontnav = '0';
		$zbp->Config('mochu')->onydnav = '0';
		$zbp->Config('mochu')->onmblei = '1';
		$zbp->Config('mochu')->onzongzan = '1';
		$zbp->Config('mochu')->onzan = '0';
		$zbp->Config('mochu')->onping = '0';
	    $zbp->Config('mochu')->onhuandeng = '0';
		$zbp->Config('mochu')->onoffdeng = '0';
		$zbp->Config('mochu')->gensui = '1';
	    $zbp->Config('mochu')->gensui2 = '1';
		$zbp->Config('mochu')->gensui3 = '1';
		$zbp->Config('mochu')->onlink = '0';
		$zbp->Config('mochu')->ondingbg = '0';
		$zbp->Config('mochu')->onbgimg = '1';
		$zbp->Config('mochu')->onbgcolor = 'f2f2f2';
		$zbp->Config('mochu')->onlju = '0';
		$zbp->Config('mochu')->onrju = '0';
		$zbp->Config('mochu')->onacolor = 'EA6000';
		$zbp->Config('mochu')->onzhicolor = 'ff6f3d';
		$zbp->Config('mochu')->onnavcolor = 'EA6000';
		$zbp->Config('mochu')->ongaocolor = '333';
		$zbp->Config('mochu')->postnav = 'PC端导航，不启用此项会调用模块中的导航模块';	
		$zbp->Config('mochu')->postydnav = '移动导航，不启用此项会调用模块中的导航模块';	
		$zbp->Config('mochu')->postgao = '公告：欢迎使用飞鸟博客的墨初主题！';	
		$zbp->Config('mochu')->postyan = '君子好学，自强不息！';
		$zbp->Config('mochu')->postlian = '<a href="javascript:;" target="_blank">扫码关注微信</a>
<a href="http://weibo.com/piaomeizi/profile?rightmod=1&wvr=6&mod=personinfo&is_all=1" target="_blank">关注新浪微博</a>
';	
		$zbp->Config('mochu')->postpage = '<li><span>•</span><a href="http://feiniaomy.com/sitemap.xml" target="_blank">站点地图</a></li>
<li><span>•</span><a href="http://feiniaomy.com/mianze.html" target="_blank">免责声明</a></li>
<li><span>•</span><a href="http://feiniaomy.com/liuyan.html" target="_blank">给我留言</a></li>
<li><span>•</span><a href="http://feiniaomy.com/tougao.html" target="_blank">给我投稿</a></li>
<li><span>•</span><a href="http://feiniaomy.com/feed.php" target="_blank">RSS订阅</a></li>
<li><span>•</span><a href="http://feiniaomy.com/tougao.html" target="_blank">捐助本站</a></li>
<li><span>•</span><a href="http://feiniaomy.com/post/17.html" target="_blank">墨初主题</a></li>';		
		$zbp->Config('mochu')->postwennrcop = '<p><span>关注我们：</span>微信搜索“xiaoqihvlove”添加我为好友</p><p><span>版权声明：</span>如无特别注明,转载请注明本文地址!</p>';
		$zbp->Config('mochu')->postfen = '<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_tieba" data-cmd="tieba" title="分享到百度贴吧"></a><a href="#" class="bds_copy" data-cmd="copy" title="分享到复制网址"></a></div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"image":{"viewList":["qzone","sqq","tsina","tqq","renren","weixin","tieba","copy"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","sqq","tsina","tqq","renren","weixin","tieba","copy"]}};with(document)0[(getElementsByTagName(\'head\')[0]||body).appendChild(createElement(\'script\')).src=\'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=\'+~(-new Date()/36e5)];</script>';
		$zbp->Config('mochu')->onfen = '1';
		$zbp->Config('mochu')->postzan = '第三方点赞代码，直接替换即可，启用时打开右边的开关，如使用应用中心的点赞插件，请关闭上面的总开关';
		$zbp->Config('mochu')->postlink = '<li><a href="http://www.feiniaomy.com" target="_blank">飞鸟博客</a></li>';
		$zbp->Config('mochu')->postping = '第三方评论代码';
		$zbp->Config('mochu')->postguqq = '540344537';
		$zbp->Config('mochu')->postguping = 'http://feiniaomy.com/liuyan.html';
		$zbp->Config('mochu')->postguon = '1';
		$zbp->Config('mochu')->postagd = '';
		$zbp->Config('mochu')->postagdon = '0';
		$zbp->Config('mochu')->postyagd = '';
		$zbp->Config('mochu')->postyagdon = '0';
		$zbp->Config('mochu')->postagd2 = '';
		$zbp->Config('mochu')->postagdon2 = '0';
		$zbp->Config('mochu')->postyagd2 = '';
		$zbp->Config('mochu')->postyagdon2 = '0';
		$zbp->Config('mochu')->postagd3 = '';
		$zbp->Config('mochu')->postagdon3 = '0';
		$zbp->Config('mochu')->postyagd3 = '';
		$zbp->Config('mochu')->postyagdon3 = '0';
		$zbp->Config('mochu')->postagd4 = '';
		$zbp->Config('mochu')->postagdon4 = '0';
		$zbp->Config('mochu')->postyagd4 = '';
		$zbp->Config('mochu')->postyagdon4 = '0';
		$zbp->Config('mochu')->ontuisong = '1';
		$zbp->Config('mochu')->posttuisong = '';		
		$zbp->Config('mochu')->description = '飞鸟博客是一个集HTML5网页制作,CSS3网页设计,科技数码,ZBLOG博客程序小知识等内容于一体的个人小型博客';
		$zbp->Config('mochu')->keywords = 'HTNL5网页设计,ZBLOG博客主题,zblog博客知识,CSS网页设计,科技数码,动态网页,JS脚本';
		$zbp->Config('mochu')->postagd5 = '';
		$zbp->Config('mochu')->postagdon5 = '0';
		$zbp->Config('mochu')->postyagd5 = '';
		$zbp->Config('mochu')->postyagdon5 = '0';
		$zbp->Config('mochu')->postagd6 = '';
		$zbp->Config('mochu')->postagdon6 = '0';
		$zbp->Config('mochu')->postyagd6 = '';
		$zbp->Config('mochu')->postyagdon6 = '0';
		$zbp->Config('mochu')->postagd7 = '';
		$zbp->Config('mochu')->postagdon7 = '0';
		$zbp->Config('mochu')->postyagd7 = '';
		$zbp->Config('mochu')->postyagdon7 = '0';	
		$zbp->Config('mochu')->tagcelan = '1';	
		$zbp->Config('mochu')->zikuanon = '1';
		$zbp->Config('mochu')->baisouon = '1';
		$zbp->Config('mochu')->headlink = '';		
		$zbp->SaveConfig('mochu');
	}
	
	$zbp->SaveConfig('mochu');	
}
//文章页挂钩
function mochu_shtu(){
global $zbp , $article;
echo '<script>
var container = document.createElement(\'script\');
$(container).attr(\'type\', \'text/plain\').attr(\'id\', \'img_editor\');
$("body").append(container);
_editor = UE.getEditor(\'img_editor\');
_editor.ready(function() {
  _editor.hide();
  $(".upload_button").click(function() {
    object = $(\'#meta_mochu_imgurl .input_text\');
    object2 = $(\'#meta_mochu_imgurl .show_img\');
    _editor.getDialog("insertimage").open();
    _editor.addListener(\'beforeInsertImage\',
    function(t, arg) {
      object.attr("value", arg[0].src);
      object2.attr("src", arg[0].src)
    })
  })
});
</script>';
echo '<div id="titleheader" class="editmod"><label for="meta_mochu_guanjianzi" class="editinputname">关键字</label>
<div><input id="edtAlias" type="text" name="meta_mochu_guanjianzi" value="'.htmlspecialchars($article->Metas->mochu_guanjianzi).'"/>  用英文“,”分割</div> </div>';
echo '<div id="titleheader" class="editmod"><label for="meta_mochu_description" class="editinputname">文章描述</label>
<div><textarea id="edtAlias" style="width:98%; height:80px; margin-top:5px;" type="text" name="meta_mochu_description" />'.htmlspecialchars($article->Metas->mochu_description).'</textarea>></div></div>';
if ($_GET['act'] == 'PageEdt') return;
echo '<label class="editinputname">文章缩略图：尺寸：270*180　注意：本地上传只能传一张图片</label>';
echo '       <table width="100%" border="1" style=" margin-top:6px;"> <tr id="meta_mochu_imgurl">';
echo '            <td valign="middle">';
echo '<input name="meta_mochu_imgurl" type="text" class="input_text" style="width:98%;" value="'.$article->Metas->mochu_imgurl.'">';
echo '			</td>';
echo '            <td valign="middle" width="20">';
echo '<input type="button" class="upload_button" value="本地上传">';
echo '            </td>';
echo '            <td valign="middle" width="125" align="right">';
echo '<img class="show_img" style="width:120px;height:80px;" src="'.$article->Metas->mochu_imgurl.'">';
echo '            </td>';
echo '        </tr></table>';
}

function mochu_shop(){
global $zbp , $article;
if ($_GET['act'] == 'PageEdt') return;
echo '<div id="alias" style="color:#FF0000" class="editmod">商品发布/主题发布/插件发布-----------------------------------------------------------------------可在主题设置中关闭-----------</div>';
echo '<div id="alias" class="editmod"><label for="meta_mochu_jiage" class="editinputname">商品价格/主题价格</label> <input id="edtAlias" type="text" name="meta_mochu_jiage" value="'.htmlspecialchars($article->Metas->mochu_jiage).'"/> 商品价格,写入数字，以元为单位</div>';
echo '<div id="alias" class="editmod"><label for="meta_mochu_yishou" class="editinputname">已售数量/主题数量</label> <input id="edtAlias" type="text" name="meta_mochu_yishou" value="'.htmlspecialchars($article->Metas->mochu_yishou).'"/> 输入数字，为整数</div>';
echo '<div id="alias" class="editmod"><label for="meta_mochu_shiyong" class="editinputname">商品活动/主题属性</label> <input id="edtAlias" type="text" name="meta_mochu_shiyong" value="'.htmlspecialchars($article->Metas->mochu_shiyong).'"/> 商品活动{主题属性,适合**程序}</div>';
echo '<div id="alias" class="editmod"><label for="meta_mochu_tedian" class="editinputname">商品简介/主题特点</label> <input id="edtAlias" type="text" name="meta_mochu_tedian" value="'.htmlspecialchars($article->Metas->mochu_tedian).'"/> 商品简介,说明{主题简介}</div>';
echo '<div id="alias" class="editmod"><label for="meta_mochu_tupian" class="editinputname">商品图片/主题图片</label> <input id="edtAlias" type="text" name="meta_mochu_tupian" value="'.htmlspecialchars($article->Metas->mochu_tupian).'"/> 600PX*480PX</div>';
echo '<div id="alias" class="editmod"><label for="meta_mochu_goumai" class="editinputname">购买地址/主题购买</label> <input id="edtAlias" type="text" name="meta_mochu_goumai" value="'.htmlspecialchars($article->Metas->mochu_goumai).'"/> 购买地址,可为外部链接</div>';
echo '<div id="alias" class="editmod"><label for="meta_mochu_yanshi" class="editinputname">查看商品/主题演示</label> <input id="edtAlias" type="text" name="meta_mochu_yanshi" value="'.htmlspecialchars($article->Metas->mochu_yanshi).'"/> 可为外部链接</div>';
echo '<div id="alias" class="editmod"><label for="meta_mochu_zhuanzhang" class="editinputname">直接转帐/赞助购买</label> <input id="edtAlias" type="text" name="meta_mochu_zhuanzhang" value="'.htmlspecialchars($article->Metas->mochu_zhuanzhang).'"/> 主题(插件)发布页专用</div>';
}
//转化标签
function mochu_Template(&$template){
	global $zbp;
	$a='';	
	$template->SetTags('mochu_cms_Archive',mochu_Archive());
	$template->SetTags('mochu_page_li',mochu_page_li());
	$template->SetTags('mochu_Readers',mochu_duzheqiang());
}


//文章归档
function mochu_Archive(){
	global $zbp;
	$str=file_get_contents($zbp->usersdir . 'cache/mochu_archive.txt');
	return $str;
}
function mochu_month($month){
$array = array('01','02','03','04','05','06','07','08','09','10','11','12');
return $array[$month-1];
}
function mochu_CacheArchive() {
	global $zbp;
	$fdate;
	$ldate;	
	$sql = $zbp->db->sql->Select($zbp->table['Post'], array('log_PostTime'), null, array('log_PostTime' => 'DESC'), array(1), null);
	$array = $zbp->db->Query($sql);
	$ldate = array(date('Y', $array[0]['log_PostTime']), date('m', $array[0]['log_PostTime']));	
	$sql = $zbp->db->sql->Select($zbp->table['Post'], array('log_PostTime'), null, array('log_PostTime' => 'ASC'), array(1), null);
	$array = $zbp->db->Query($sql);
	$fdate = array(date('Y', $array[0]['log_PostTime']), date('m', $array[0]['log_PostTime']));
	$arraydate = array();
	$arrayyer = array();
	$s = '';
	for ($i = $fdate[0]; $i < $ldate[0] + 1; $i++) {
		$arrayyer[] = $i ;
	}
	for ($i = $fdate[0]; $i < $ldate[0] + 1; $i++) {
		for ($j = 1; $j < 13; $j++) {
			$arraydate[] = strtotime($i . '-' . $j);
		}
	}	
	foreach ($arraydate as $key => $value) {
		if ($value - strtotime($ldate[0] . '-' . $ldate[1]) > 0)
			unset($arraydate[$key]);
		if ($value - strtotime($fdate[0] . '-' . $fdate[1]) < 0)
			unset($arraydate[$key]);
	}
	$arraydate = array_reverse($arraydate);
	$arrayyer = array_reverse($arrayyer);
	$s .='<div class="guidang">';
	foreach ($arrayyer as $key => $yer){
		$syer = $yer;
		$s .='<h2>';
		$s .=$syer;	
		$s .='&nbsp;年</h2>'; 
		foreach ($arraydate as $key => $value) {	
			$fdate = $value;  
	   		$phpyer =  strtotime($syer . '-1');
	   		$phpfyer =  strtotime($syer+1 . '-1');
		if($phpyer<=$fdate&&$fdate<$phpfyer){
			$ldate = (strtotime(date('Y-m-t', $value)) + 60 * 60 * 24);
			$order = array('log_PostTime'=>'DESC');
			$where = array(
          array('=','log_Status','0'),
          array('=','log_Type','0'),
          array('BETWEEN', 'log_PostTime', $fdate, $ldate)
          );
		$mochulist = $zbp->GetArticleList(array('*'),$where,$order,'30',''); 
		$s.='<div class="item">';
		$s.='<h3>'.mochu_month(date('n', $fdate)).'月&nbsp;<span>(&nbsp;'.sizeof($mochulist).'&nbsp;篇文章&nbsp;)</span></h3>';
		$s.='<ul >';	
      foreach ($mochulist as $key=>$article){
      	$s .= ' <li><span>'.$article->Time('d').'日:</span><a href="'.$article->Url.'">'.$article->Title.'</a><span>&nbsp;&nbsp;&nbsp;'.$article->CommNums.' 评论</span></li>';
      }
		$s.='</ul></div>';
	}}}
	$s .= '</div>';
		file_put_contents($zbp->usersdir . 'cache/mochu_archive.txt', $s);}


//样式表
function mochu_yangshi(){
	global $zbp;
	$strContent = @file_get_contents($zbp->usersdir . 'theme/mochu/source/style.css');
	$mochu ='';
	$mochucss = '';
	$mochukuan ='';
	$mochukuan2 = '';	
	if($zbp->Config('mochu')->onbgimg){
	$mochu .= 'background-image:url(/zb_users/cache/mochuimg/bgimg.png);';
	if($zbp->Config('mochu')->ondingbg){$mochu .= 'background-repeat:no-repeat;background-attachment:fixed;background-position:'.$zbp->Config('mochu')->onlju.'px '.$zbp->Config('mochu')->onrju.'px;';}
	}
	$mochu .= 'background-color:#'.$zbp->Config('mochu')->onbgcolor.';';
	$mochucss .= 'a:hover,.reed a:hover,.footer a:hover,#tbox a:hover,.wennr-top a:hover,.wennr a:hover,.wennr-zan a:hover i{color:#'.$zbp->Config('mochu')->onacolor.';}';	
	if ($zbp->Config('mochu')->onmblei=="1"){$mochucss .='.dinglei{display:inline;}';}
	$mochucss .='.reednr a:hover{color:#333;}.buy a:hover{background-color:#'.$zbp->Config('mochu')->onacolor.';}';
	$mochucss .= '.zhiding{color:#'.$zbp->Config('mochu')->onzhicolor.';}';
	$mochucss .='#divSearchPanel input[type="text"]{border: 1px solid #'.$zbp->Config('mochu')->onnavcolor.';}#divSearchPanel input[type="submit"],.archive-list-img-lei,.now-page,.buy a,#frmSumbit .button,button{background-color:#'.$zbp->Config('mochu')->onnavcolor.';}#yidongnavs li a.onhover,.onhover,.wennr-foot-cn a,.shopul li span,.zhengwen a,#tab li.tabhover{ color:#'.$zbp->Config('mochu')->onnavcolor.';}.footer{border-top:2px solid #'.$zbp->Config('mochu')->onnavcolor.';}';
	$mochucss .='#tbCalendar tbody td a{ color:#'.$zbp->Config('mochu')->onnavcolor.';}';
	$mochucss .='.noticet h3{color:#'.$zbp->Config('mochu')->ongaocolor.';}';
	$mochucss .='.link-con-a{color:#'.$zbp->Config('mochu')->onnavcolor.';border-left:3px solid #'.$zbp->Config('mochu')->onnavcolor.';}';
	$mochucss .='.zhengwen h1,.zhengwen h2,.zhengwen h3,.zhengwen h4,.zhengwen h5,.zhengwen h6{border-left:5px solid #'.$zbp->Config('mochu')->onnavcolor.';}';
	$mochucss .='.zhengwen blockquote p{color:#'.$zbp->Config('mochu')->onnavcolor.';text-indent: 1em;}';
	$mochucss .='.con:hover conhrhui a,.archive-list-lei,.conpspan,.archive-list-lei a,.rslides_here a,.nextnav-lf span,.celanbiao h3 i,.xiangguan-txt-lf i,.pinglun h3 i,.conhr,.item ul li a,.guidang h2{color:#'.$zbp->Config('mochu')->onnavcolor.';}';
	if($zbp->Config('mochu')->tagcelan){
	$mochucss .='#divTags li,#htagcelan li,#rtagcelan li{ float:left;background-image:none; margin:2px 5px 2px 0px; padding:0;border-bottom:none;font-size:14px;}#divTags a,#htagcelan a,#rtagcelan a{font-size:14px;font-family: Verdana,Microsoft YaHei;opacity: .9;padding: 5px 9px;border: 1px solid #ececec;}
#divTags .tags0 a,#htagcelan .tags0 a,#rtagcelan .tags0 a{color: #EA6000;}#divTags .tags1 a,#htagcelan .tags1 a,#rtagcelan .tags1 a{color: #16929D;}#divTags .tags2 a,#htagcelan .tags2 a,#rtagcelan .tags2 a{color: #CC0000;}#divTags .tags3 a,#htagcelan .tags3 a,#rtagcelan .tags3 a{color: #FF9933;}#divTags .tags4 a,#htagcelan .tags4 a,#rtagcelan .tags4 a{color: #05792D;}#divTags .tags5 a,#htagcelan .tags5 a,#rtagcelan .tags5 a{color: #FF95CA;}#divTags .tags6 a,#htagcelan .tags6 a,#rtagcelan .tags6 a{color: #99CC66;}#divTags .tags7 a,#htagcelan .tags7 a,#rtagcelan .tags7 a{color: #993300;}#divTags .tags8 a,#htagcelan .tags8 a,#rtagcelan .tags8 a{color: #003366;}#divTags li a:hover,#htagcelan li a:hover,#rtagcelan li a:hover{border: 1px dashed #'.$zbp->Config('mochu')->onacolor.';}';
	}
	else{
	$mochucss .='#divTags li,#htagcelan li,#rtagcelan li{ float:left; width:42%;}';	
	}	
	if($zbp->Config('mochu')->zikuanon){
	$mochukuan = '.container{max-width:1366px;margin:0 auto; padding:0px;}
.mainct{position:relative;margin-right:405px;}
.main-lr{position:relative; width:400px;margin-left:-400px;}
.div1{width:400px;}.div2{position:fixed;_position:absolute;top:65px;z-index:10; width:400px;}#tab li{ color:#bbb; box-sizing: border-box; display:block; background-image:none;float:left;padding-left:0px;height:40px;line-height:40px;cursor:pointer;width:100px;text-align:center; border-left:1px solid #ddd; border-bottom:1px solid #ddd; margin-left:-1px;font-size:16px;}';
	$mochukuan2 = '@media screen and (max-width:1600px){.container{max-width:1200px;}.mainct{margin-right:365px;}.main-lr{width:360px;margin-left:-360px;}#tab li{ width:90px;}.div1{width:358px;}.div2{width:358px;}}';
		}
	else{
	$mochukuan = '.container{max-width:1200px;margin:0 auto; padding:0px;}.mainct{position:relative;margin-right:365px;}.main-lr{position:relative;width:360px;margin-left:-360px;}#tab li{ color:#bbb; box-sizing: border-box; display:block; background-image:none;float:left;padding-left:0px;height:40px;line-height:40px;cursor:pointer;width:90px;text-align:center; border-left:1px solid #ddd; border-bottom:1px solid #ddd; margin-left:-1px;font-size:16px;}.div1{width:358px;}.div2{position:fixed;_position:absolute;top:65px;z-index:10; width:358px;}';
	$mochukuan2 = '';	
	}
	$strContent = str_replace("{%mochubody%}", $mochu, $strContent);
	$strContent = str_replace("{%mochukuan%}", $mochukuan, $strContent);
	$strContent = str_replace("{%mochucss%}", $mochucss, $strContent);
	$strContent = str_replace("{%mochukuan2%}", $mochukuan2, $strContent);
	 @file_put_contents($zbp->usersdir . 'theme/mochu/style/style.css', $strContent);
	
}
//首页分类页文章缩略图
function fasimg($article){
	global $zbp;
	$str = '';
	$strr='';
	$pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
	$content = $article->Content;
	preg_match_all($pattern,$content,$matchContent);
	if($article->Metas->mochu_imgurl){
		$strr  .= '<figure class="archive-list-img">';
		if($article->IsTop){
		$strr  .= '<div class="archive-list-img-lei">博主推荐</div>';}
		else{
		$strr  .= '<div class="archive-list-img-lei"><a href="'.$article->Category->Url.'" title="查看'.$article->Category->Name.'的全部文章">'.$article->Category->Name.'</a></div>';}
		$strr  .= ' <a target="_blank" href="'.$article->Url.'" title="'.$article->Title.'"><img src="'.$article->Metas->mochu_imgurl.'" alt="'.$article->Title.'"/></a></figure>';		
	}else if(isset($matchContent[1][0])){
		$str = $matchContent[1][0];	
		$strr  .= '<figure class="archive-list-img">';
		if($article->IsTop){
		$strr  .= '<div class="archive-list-img-lei">博主推荐</div>';}
		else{
		$strr  .= '<div class="archive-list-img-lei"><a href="'.$article->Category->Url.'" title="查看'.$article->Category->Name.'的全部文章">'.$article->Category->Name.'</a></div>';}
		$strr  .= ' <a target="_blank" href="'.$article->Url.'" title="'.$article->Title.'"><img src="'.$str.'" alt="'.$article->Title.'"/></a></figure>';	
		}
	else if($zbp->Config('mochu')->onslimg)
	{	$temp=rand(1,10);
		$str = $zbp->host . 'zb_users/theme/mochu/img/rand/'.$temp.'.jpg';
		$strr .= '<figure class="archive-list-img">';
		if($article->IsTop){
		$strr  .= '<div class="archive-list-img-lei">博主推荐</div>';}
		else{
		$strr  .= '<div class="archive-list-img-lei"><a href="'.$article->Category->Url.'" title="查看'.$article->Category->Name.'的全部文章">'.$article->Category->Name.'</a></div>';}
		$strr  .= '<a target="_blank" href="'.$article->Url.'" title="'.$article->Title.'"><img src="'.$str.'" alt="'.$article->Title.'"/></a></figure>';
		}	
	else{
		$str = '';
		$strr = '';
		}	
	return $strr;		

}
//提取页面数据
function mochu_page_li(){
global $zbp,$str,$order;$i;
    $str = '';
    $order = array('log_ViewNums'=>'DESC');
    $where = array(array('=','log_Template','mochu_page'));
    $array = $zbp->GetPageList(array('*'),$where,$order,'','');
    foreach ($array as $related) {
        $str .= "<li><a href=\"{$related->Url}\" title=\"{$related->Title}\" >{$related->Title}</a></li>";
    }
    return $str;	
}
//读者墙
function mochu_Readers(){
 global $zbp;
$sql = $zbp->db->sql->Select(
$zbp->table['Comment'],
array('COUNT(comm_ID) AS cnt, comm_Name, comm_HomePage , comm_Email'),
array(
array('<>', 'comm_AuthorID','1'),
array('<>', 'comm_Name', '访客'),
array('<>', 'comm_Name', 'admin'),
array('<>', 'comm_HomePage', ''),
array('CUSTOM', '1=1 GROUP BY comm_HomePage')
),
array('cnt' => 'DESC'),'',null);
$array=$zbp->db->Query($sql);
$i=0;
$s="<div class='duzhe'>";
	foreach ($array as $comment) {
	$r='';
	if($comment['comm_Email']){
	$r='http://gravatar.duoshuo.com/avatar/' .md5(strtolower($comment['comm_Email'])).'?s=60&d=mm&r=G';
	}
	else{
	$r='/zb_users/avatar/1.jpg';
	}
	if($i==0){
	$s .= '<a href="'.$comment['comm_HomePage'].'" class="duzhe-si duzhe-si1" rel="external nofollow" title="' . $comment['comm_Name'] . '" target="_blank"><h4>读者之状元</h4><img class="lf" src="'.$r.'" alt="avatar"  /><h6>'.$comment['comm_Name'] .'</h6><p>共评论'.$comment['cnt'].'次</p></a>';
	}elseif($i==1){
		$s .= '<a href="'.$comment['comm_HomePage'].'" class="duzhe-si duzhe-si2" rel="external nofollow" title="' . $comment['comm_Name'] . '" target="_blank"><h4>读者之榜眼</h4><img class="lf" src="'.$r.'" alt="avatar"  /><h6>'.$comment['comm_Name'] .'</h6><p>共评论'.$comment['cnt'].'次</p></a>';
	}elseif($i==2){
		$s .= '<a href="'.$comment['comm_HomePage'].'" class="duzhe-si duzhe-si3" rel="external nofollow" title="' . $comment['comm_Name'] . '" target="_blank"><h4>读者之探花</h4><img class="lf" src="'.$r.'" alt="avatar"  /><h6>'.$comment['comm_Name'] .'</h6><p>共评论'.$comment['cnt'].'次</p></a>';
	}elseif($i==3){
		$s .= '<a href="'.$comment['comm_HomePage'].'" class="duzhe-si duzhe-si4" rel="external nofollow" title="' . $comment['comm_Name'] . '" target="_blank"><h4>读者之进士</h4><img class="lf" src="'.$r.'" alt="avatar"  /><h6>'.$comment['comm_Name'] .'</h6><p>共评论'.$comment['cnt'].'次</p></a>';		
	}else{
		$s .= '<a href="'.$comment['comm_HomePage'].'" class="duzhe-yu" rel="external nofollow" title="' . $comment['comm_Name'] . '" target="_blank"><img src="'.$r.'" alt="avatar"  /><h6>'.$comment['comm_Name'] .'</h6></a>';}		
	$i++;	
	}	
$s .='<div class="clear"></div></div>';
file_put_contents($zbp->usersdir . 'cache/mochu_duzhe.txt', $s);
}
function mochu_duzheqiang(){
	global $zbp;
	$str=file_get_contents($zbp->usersdir . 'cache/mochu_duzhe.txt');
	return $str;
}
?>