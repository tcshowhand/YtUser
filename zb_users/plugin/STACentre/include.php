<?php

#注册插件
RegisterPlugin("STACentre", "ActivePlugin_STACentre");

<<<<<<< HEAD
function ActivePlugin_STACentre() {

    Add_Filter_Plugin('Filter_Plugin_Admin_SettingMng_SubMenu', 'STACentre_AddMenu');

}

function STACentre_AddMenu() {
    global $zbp;
    echo '<a href="' . $zbp->host . 'zb_users/plugin/STACentre/main.php"><span class="m-left">静态化管理中心</span></a>';
}
=======
function ActivePlugin_STACentre()
{

    Add_Filter_Plugin('Filter_Plugin_Admin_SettingMng_SubMenu', 'STACentre_AddMenu');
}

function STACentre_AddMenu()
{
    global $zbp;
    echo '<a href="' . $zbp->host . 'zb_users/plugin/STACentre/main.php"><span class="m-left">静态化管理中心</span></a>';
}
>>>>>>> 37e8180d570715b5e4a53c38df53482c36fdad82
