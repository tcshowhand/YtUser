<?php
RegisterPlugin("default", "ActivePlugin_default");

function ActivePlugin_default() {
    global $zbp;
    Add_Filter_Plugin('Filter_Plugin_ViewPost_Template','aaaa');	
    $zbp->LoadLanguage('theme', 'default');
}


function aaaa(){
    print_r("12312321");
}