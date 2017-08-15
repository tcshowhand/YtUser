<?php
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config.php';
RegisterPlugin("mizhe","ActivePlugin_mizhe");

function ActivePlugin_mizhe(){
	Add_Filter_Plugin('Filter_Plugin_Admin_TopMenu','mizhe_AddMenu');
	Add_Filter_Plugin('Filter_Plugin_Edit_Response3','mizhe_Edit_Response');
	Add_Filter_Plugin('Filter_Plugin_Edit_End','mizhe_Edit_End');
}

function mizhe_AddMenu(&$m){
	global $zbp;
	$m[]=MakeTopMenu("root",'主题配置',$zbp->host . "zb_users/theme/mizhe/main.php?act=base","","topmenu_mizhe");
}

function mizhe_zhekou($proprice,$promarket) {
	global $zbp;
	$prodiscount = $proprice / $promarket;
	$prodiscount = $prodiscount * 10;
	$prodiscount = round($prodiscount, 1); 
	return $prodiscount;
}

function mizhe_sheng($proprice,$promarket) {
	global $zbp;
	$prosheng = $promarket - $proprice;
	$prosheng = round($prosheng, 1); 
	return $prosheng;
}

function mizhe_Edit_End() {
	global $zbp;
	echo "<script type=\"text/javascript\">
	$.datepicker.regional['zh-cn'] = {
	closeText: '完成',
	prevText: '上个月',
	nextText: '下个月',
	currentText: '现在',
	monthNames: ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
	monthNamesShort: ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
	dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],
	dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'],
	dayNamesMin: ['日','一','二','三','四','五','六'],
	weekHeader: '周',
	dateFormat: 'yy-mm-dd',
	firstDay: 1,
	isRTL: false,
	showMonthAfterYear: true,
	yearSuffix: ' 年  '
	};
	$.datepicker.setDefaults($.datepicker.regional['zh-cn']);
	$.timepicker.regional['zh-cn'] = {
	timeOnlyTitle: '时间',
	timeText: '时间',
	hourText: '小时',
	minuteText: '分钟',
	secondText: '秒钟',
	millisecText: '毫秒',
	currentText: '现在',
	closeText: '完成',
	timeFormat: 'hh:mm:ss',
	ampm: false
	};
	$.timepicker.setDefaults($.timepicker.regional['zh-cn']);
	$('#edtprotime').datetimepicker({
	showSecond: true
	//changeMonth: true,
	//changeYear: true
	});
	</script>";
}

function mizhe_Edit_Response(){
	global $zbp,$article;
	mizhe_CustomMeta_Response($article);
}

function mizhe_CustomMeta_Response(&$object){

	global $zbp;
	$array=array();
	$proprice_intro = '产品价格';
	$promarket_intro = '市场价';
	$protime_intro = '结束时间';
	$prourl_intro = '产品地址';
	if(is_array($array)==false)return null;
	if(count($array)==0)return null;
//	echo '<label for="cmbTemplate" class="editinputname" >自定义作用域:</label>';
	foreach ($array as $key => $value) {
		if($key==0) {
			$single_meta_intro = $proprice_intro;
		}elseif ($key==1) {
			$single_meta_intro = $promarket_intro;
		}elseif ($key==2) {
			$single_meta_intro = $prourl_intro;
		}else{
			$single_meta_intro = $protime_intro;
		}

		if(!$single_meta_intro)$single_meta_intro='Metas.' . $value;
		if ($value=='protime') {
			echo '<p><label for="'. $value .'" class="editinputname" >'. $single_meta_intro .'</label><input type="text" name="meta_' . $value . '" id="edtprotime"  value="'.htmlspecialchars($object->Metas->$value).'" style="width:65%;"/></p>';
		}else{
			echo '<p><label for="'. $value .'" class="editinputname" >'. $single_meta_intro .'</label><input type="text" name="meta_' . $value . '" value="'.htmlspecialchars($object->Metas->$value).'" style="width:65%;"/></p>';
		}
	}
}

function InstallPlugin_mizhe(){
	global $zbp;
	if(!$zbp->Config('mizhe')->HasKey('Version')){
		$zbp->Config('mizhe')->Version = '1.0';
		$zbp->Config('mizhe')->PostLEFTNAV = '<li><a href="#" class="taoicon">淘宝登录</a></li><li><a href="#" class="qqicon">QQ登录</a></li><li><a href="#" class="weiboicon">微博登录</a></li>';
		$zbp->Config('mizhe')->PostRIGHTNAV = '<li><a href="#" class="myicon">我的米折</a></li><li><a href="#" class="friendicon">邀请好友</a></li><li><a href="#" class="helpicon">帮助中心</a></li><li><a href="#" class="sericon">客服在线</a></li>';
		$zbp->Config('mizhe')->PostBLOG = '<iframe width="125" height="24" frameborder="0" allowtransparency="true" marginwidth="0" marginheight="0" scrolling="no" border="0" src="http://widget.weibo.com/relationship/followbutton.php?language=zh_cn&width=136&height=24&uid=1787516913&style=2&btn=red&dpc=1"></iframe>';
		$zbp->Config('mizhe')->PostINDEXADS = '<a href="http://www.toyean.com/post/mizhe.html" target="_blank"><img src="/zb_users/theme/mizhe/include/ads.jpg" /></a>';
		$zbp->Config('mizhe')->PostCATALOGADS = '<a href="http://www.toyean.com/post/mizhe.html" target="_blank"><img src="/zb_users/theme/mizhe/include/ads.jpg" /></a>';
		$zbp->Config('mizhe')->PostSINGLEADS = '<a href="http://www.toyean.com/post/mizhe.html" target="_blank"><img src="/zb_users/theme/mizhe/include/ads.jpg" /></a>';
		$zbp->Config('mizhe')->PostSHARE = '<div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare"><a class="bds_qzone"></a><a class="bds_tsina"></a><a class="bds_tqq"></a><a class="bds_renren"></a><a class="bds_t163"></a><span class="bds_more">更多</span><a class="shareCount"></a></div><script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=738551" ></script><script type="text/javascript" id="bdshell_js"></script><script type="text/javascript">document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000);</script>';
		$zbp->Config('mizhe')->PostFLOATNAV = '<h3>米折特卖</h3><div><p>精选推荐</p><ul><li><a href="#" class="select">全部</a></li><li><a href="#">衣服</a></li><li><a href="#">鞋子</a></li><li><a href="#">包包</a></li><li><a href="#">美妆</a></li><li><a href="#">发现</a></li></ul><p>更多活动</p><dl><dd><a href="#">满199减10元</a></dd></dl></div>';
		$zbp->Config('mizhe')->PostFOOTSIGN = '<span><a href="javascript:"><img src="/zb_users/theme/mizhe/style/images/hot100.png" alt="" /></a></span><span><a href="javascript:"><img src="/zb_users/theme/mizhe/style/images/ec2012.png" alt="" /></a></span><span><a href="javascript:"><img src="/zb_users/theme/mizhe/style/images/cnnic.png" alt="" /></a></span><span><a href="javascript:"><img src="/zb_users/theme/mizhe/style/images/cxwz.png" alt="" /></a></span>';
		$zbp->SaveConfig('mizhe');
		mizhe_CreateTable();
		mizhe_DefaultCode();
	}
}

function mizhe_CreateTable(){
	global $zbp;
	$s=$zbp->db->sql->CreateTable($GLOBALS['mizhe_Table'],$GLOBALS['mizhe_DataInfo']);
	$zbp->db->QueryMulit($s);
}

function mizhe_DefaultCode(){
	global $zbp;
	$Arr_DF = explode('|',base64_decode($GLOBALS['DEFALUT_FLASH']));
	$r = new Base($GLOBALS['mizhe_Table'],$GLOBALS['mizhe_DataInfo']);
	$r->Title=$Arr_DF[0];
	$r->Img=$Arr_DF[1];
	$r->Url=$Arr_DF[2];
	$r->Save();
	$s = new Base($GLOBALS['mizhe_Table'],$GLOBALS['mizhe_DataInfo']);
	$s->Type=99;
	$s->Code='';
	$s->Save();
}

function UninstallPlugin_mizhe(){
	global $zbp;
	mizhe_EmptyCode();
	$zbp->DelConfig('mizhe');
}

function mizhe_EmptyCode(){
	global $zbp;
	$s=$zbp->db->sql->Delete($GLOBALS['mizhe_Table'],'');
	$zbp->db->QueryMulit($s);
}
?>