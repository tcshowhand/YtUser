<?php
function YtUser_ReplacePre(&$s) {
        global $zbp;
        $s = str_replace('%pre%', $zbp->db->dbpre, $s);
        return $s;
}

function YtUser_SubMenu($id){
    $arySubMenu = array(
        0 => array('插件说明', 'guide', 'left', false),
        1 => array('网站设置', 'base', 'left', false),
        2 => array('VIP卡', 'upgrade', 'left', false),
        3 => array('充值卡', 'recharge', 'left', false),
        4 => array('购买记录', 'buy', 'left', false),
        5 => array('修复插件', 'testing', 'left', false),
    );
    foreach($arySubMenu as $k => $v){
        echo '<a href="?act='.$v[1].'"><span class="m-'.$v[2].' '.($id==$v[1]?'m-now':'').'">'.$v[0].'</span></a>';
    }
}
