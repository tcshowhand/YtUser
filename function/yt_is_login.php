<?php
function YtUser_ReplacePre(&$s) {
        global $zbp;
        $s = str_replace('%pre%', $zbp->db->dbpre, $s);
        return $s;
}

function YtUser_SubMenu($action){
    $array = array(
        array(
            'action' => 'guide',
            'url' => 'guide.php',
            'target' => '_self',
            'float' => 'left',
            'title' => '插件说明',
        ),
        array(
            'action' => 'base',
            'url' => 'base.php',
            'target' => '_self',
            'float' => 'left',
            'title' => '网站设置',
        ),
        array(
            'action' => 'viplist',
            'url' => 'viplist.php',
            'target' => '_self',
            'float' => 'left',
            'title' => 'VIP卡',
        ),
        array(
            'action' => 'recharge',
            'url' => 'recharge.php',
            'target' => '_self',
            'float' => 'left',
            'title' => '充值卡',
        ),
        array(
            'action' => 'buy',
            'url' => 'buy.php',
            'target' => '_self',
            'float' => 'left',
            'title' => '购买记录',
        ),
        array(
            'action' => 'certifi',
            'url' => 'certifi.php',
            'target' => '_self',
            'float' => 'left',
            'title' => '实名认证',
        ),
        array(
            'action' => 'rewrite',
            'url' => 'rewrite.php',
            'target' => '_self',
            'float' => 'left',
            'title' => '伪静态设置',
        ),
        array(
            'action' => 'testing',
            'url' => 'testing.php',
            'target' => '_self',
            'float' => 'left',
            'title' => '修复插件',
        ),
    );
    $str = '';
    $template = '<a href="$url" target="$target"><span class="m-$float$light">$title</span></a>';
    for ($i = 0; $i < count($array); $i++) {
        $str .= $template;
        $str = str_replace('$url', $array[$i]['url'], $str);
        $str = str_replace('$target', $array[$i]['target'], $str);
        $str = str_replace('$float', $array[$i]['float'], $str);
        $str = str_replace('$title', $array[$i]['title'], $str);
        $str = str_replace('$light', ($action == $array[$i]['action'] ? ' m-now' : ''), $str);
    }
    return $str;
}