<?php 
RegisterPlugin('SlidesExpress', 'ActivePlugin_SlidesExpress');
function ActivePlugin_SlidesExpress(){
	Add_Filter_Plugin('Filter_Plugin_Admin_LeftMenu','SlidesExpress_AddMenu');
	Add_Filter_Plugin('Filter_Plugin_ViewList_Template','SlidesExpress_set');
	Add_Filter_Plugin('Filter_Plugin_ViewPost_Template','SlidesExpress_set');
}
function SlidesExpress_AddMenu(&$m){
	global $zbp;
    $m[]=MakeLeftMenu("root","幻灯片管理",$zbp->host . "zb_users/plugin/SlidesExpress/main.php","nav_SlidesExpress","aSlidesExpress",$zbp->host . "zb_system/image/common/file_1.png");
}
function SlidesExpress_SubMenu($id){
	$aryCSubMenu = array(	
		0 => array('添加幻灯片', 'main.php', 'left', false),		
		7 => array('技术支持', 'http://www.ytecn.com/', 'right', true)
	);
	foreach($aryCSubMenu as $k => $v){
		echo '<a href="'.$v[1].'" '.($v[3]==true?'target="_blank"':'').'><span class="m-'.$v[2].' '.($id==$k?'m-now':'').'">'.$v[0].'</span></a>';
	}
}

function SlidesExpress_set(&$template){
    global $zbp;
    $slidesArray = json_decode($zbp->Config('SlidesExpress')->slidesArray,true);
    $template->SetTags('slidesArray', $slidesArray);
}

function InstallPlugin_SlidesExpress(){
	global $zbp;
	if(!$zbp->Config('SlidesExpress')->HasKey('Version')){
		$zbp->Config('SlidesExpress')->Version = '1.0';
		$zbp->Config('SlidesExpress')->slidesArray='[{"title":"这是标题","img":"'.$zbp->host . 'zb_users/plugin/SlidesExpress/images/slides/1.jpg","url":"'.$zbp->host . '","order":"1"}]';
		$zbp->SaveConfig('SlidesExpress');
	}
	$zbp->Config('SlidesExpress')->Version = '1.0';
	$zbp->SaveConfig('SlidesExpress');
}
function UninstallPlugin_SlidesExpress(){
	global $zbp;
	if ($zbp->Config('SlidesExpress')->clearSetting){
		$zbp->DelConfig('SlidesExpress');
	}
}

function SlidesExpress_Get_Flash($slidesArray){
    global $zbp;
    $str = '<style>*{ margin:0;padding:0;}#zd{width: 980px;height: 300px;overflow: hidden;position: relative;margin:0 auto;}#zd ul{position: absolute;left:0;top:0;}#zd ul li{width: 980px;height: 300px;float: left; }#zd img{width: 980px;height: 300px;}</style><div id="zd"><ul>';
    foreach ($slidesArray as $key => $reg) {
        $str .= "<li><a href='".$reg['url']."' title='".$reg['title']."' target='_blank'><img alt='".$reg['title']."' src='".$reg['img']."' /></a></li>\n";
    }
    $str .='</ul></div><script>var oul=$("zd").getElementsByTagName("ul")[0],oli=oul.getElementsByTagName("li"),timers=null,timer=null,i=0,oliW=oli[0].offsetWidth;oul.style.width=oli.length*oliW+"px";function $(id){return document.getElementById(id)}function getClass(obj,name){if(obj.currentStyle){return obj.currentStyle[name]}else{return getComputedStyle(obj,false)[name]}}function Stratmove(obj,json,funEnd,callback){clearInterval(obj.timer);obj.timer=setInterval(function(){for(var attr in json){var bStop=true,cuur=parseFloat(getClass(obj,attr)),speed=0;if(attr=="opacity"){cuur=Math.round(parseFloat(getClass(obj,attr))*100)}else{cuur=parseFloat(getClass(obj,attr))}speed=(json[attr]-cuur)/8;speed=speed>0?Math.ceil(speed):Math.floor(speed);if(cuur!=json[attr]){bStop=false}if(attr=="opacity"){obj.style["opacity"]=(cuur+speed)/100;obj.style["filter"]="alpha(opacity="+cuur+speed+")"}else{obj.style[attr]=Math.round(cuur+speed)+"px"}if(bStop){clearInterval(obj.timer);callback()}if(funEnd){funEnd()}}},30)}var arr=[];timers=setInterval(function(){Stratmove(oul,{"left":-oliW},null,calls)},3000);function calls(){arr.push(oli[0]);oul.removeChild(oli[0]);oul.appendChild(arr[0]);arr.splice(0,arr.length);oul.style.left=0};</script>';
    @file_put_contents($zbp->usersdir . 'theme/'.$zbp->theme.'/include/SlidesExpress.php', $str);
}

?>