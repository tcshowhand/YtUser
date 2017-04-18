<?php 
RegisterPlugin('MapBaidu', 'ActivePlugin_MapBaidu');
function ActivePlugin_MapBaidu(){
	Add_Filter_Plugin('Filter_Plugin_ViewList_Template','MapBaidu_set');
	Add_Filter_Plugin('Filter_Plugin_ViewPost_Template','MapBaidu_set');
}

function MapBaidu_SubMenu(){
	$aryCSubMenu = array(	
		0 => array('地图配置', 'main.php', 'left', false),		
		7 => array('技术支持', 'http://www.ytecn.com/', 'left', true)
	);
	foreach($aryCSubMenu as $k => $v){
		echo '<a href="'.$v[1].'" '.($v[3]==true?'target="_blank"':'').'><span>'.$v[0].'</span></a>';
	}
}

function MapBaidu_set(&$template){
    global $zbp;
	$title=$zbp->Config('MapBaidu')->title;
	$content=$zbp->Config('MapBaidu')->content;
	$poi=$zbp->Config('MapBaidu')->poi;
    	$mapbaidu =  <<<eof
	<script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=73b9532bf882485372535b6b27e49dbc"></script>
	<script type="text/javascript" src="https://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.js"></script>
	<link rel="stylesheet" href="https://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.css" />
	<style>
	#mapContainer td{padding:0;box-sizing:content-box;-webkit-box-sizing:content-box;-moz-box-sizing:content-box; }
	#mapContainer{display:block;width:100%;height:400px}
	</style>
    <div id="mapContainer"></div>
    <script type="text/javascript">
        var map;
        var poi = new BMap.Point({$poi});
        //创建和初始化地图函数：
        function initMap() {
            createMap();//创建地图
            setMapEvent();//设置地图事件
            addMapControl();//向地图添加控件
            addMapOverlay();//向地图添加覆盖物
        }
        function createMap() {
            map = new BMap.Map("mapContainer");
            map.centerAndZoom(poi, 12);
        }
        function setMapEvent() {
            map.enableKeyboard();
            map.enableDragging();
            map.enableDoubleClickZoom();
            map.disableScrollWheelZoom();
        }
        function addClickHandler(target, window) {
            target.addEventListener("click", function () {
                target.openInfoWindow(window);
            });
        }
        
        function addMapOverlay() {
            var content = '<div style="margin:0;line-height:20px;padding:2px;">' +
                        '{$content}' +
                      '</div>';
            //创建检索信息窗口对象
            var searchInfoWindow = null;
            searchInfoWindow = new BMapLib.SearchInfoWindow(map, content, {
                title: "{$title}",
                width: 380,
                height: 85,
                panel: "panel",
                enableAutoPan: true,
                searchTypes: [
                    BMAPLIB_TAB_SEARCH,   //周边检索
                    BMAPLIB_TAB_TO_HERE,  //到这里去
                    BMAPLIB_TAB_FROM_HERE //从这里出发
                ]
            });

            var marker = new BMap.Marker(poi); //创建marker对象
            
            marker.addEventListener("click", function (e) {
                searchInfoWindow.open(marker);
            })
            searchInfoWindow.open(marker);
            addClickHandler(marker, searchInfoWindow);
            map.addOverlay(marker); //在地图中添加marker
        }
        //向地图添加控件
        function addMapControl() {
            var scaleControl = new BMap.ScaleControl({ anchor: BMAP_ANCHOR_BOTTOM_LEFT });
            scaleControl.setUnit(BMAP_UNIT_IMPERIAL);
            map.addControl(scaleControl);
            var navControl = new BMap.NavigationControl({ anchor: BMAP_ANCHOR_TOP_LEFT, type: BMAP_NAVIGATION_CONTROL_LARGE });
            map.addControl(navControl);
            var overviewControl = new BMap.OverviewMapControl({ anchor: BMAP_ANCHOR_BOTTOM_RIGHT, isOpen: false });
            map.addControl(overviewControl);
        }
        initMap();
    </script>
eof;
    $template->SetTags('mapbaidu', $mapbaidu);
}

function InstallPlugin_MapBaidu(){
	global $zbp;
	if(!$zbp->Config('MapBaidu')->HasKey('Version')){
		$zbp->Config('MapBaidu')->Version = '1.0';
		$zbp->Config('MapBaidu')->title='豫唐网络';
		$zbp->Config('MapBaidu')->content='地址：汤阴县豫唐网络科技有限公司<br>tel:15565739115';
		$zbp->Config('MapBaidu')->poi='114.364949,35.943385';
		$zbp->SaveConfig('MapBaidu');
	}
	$zbp->Config('MapBaidu')->Version = '1.0';
	$zbp->SaveConfig('MapBaidu');
}
function UninstallPlugin_MapBaidu(){
	global $zbp;
	if ($zbp->Config('MapBaidu')->clearSetting){
		$zbp->DelConfig('MapBaidu');
	}
}
?>