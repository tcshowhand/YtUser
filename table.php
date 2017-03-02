<?php
require 'zb_system/function/c_system_base.php';
require 'zb_system/function/c_system_admin.php';
$zbp->Load();



    $_POST['ID'] = '0';
    $_POST['Type'] = '0';
    $_POST['Content'] = "12312";
    $_POST['Template'] = 'single';
    $_POST['AuthorID'] = '1';
    $_POST['PostTime'] = '2017-02-26 17:00:13';
    $_POST['IsTop'] = '0';
    $_POST['IstopType'] = 'index';
    $_POST['IsLock'] = '0';
    $_POST['Intro'] = '';
    $_POST['Alias'] = '';

    $_POST['Title'] = "12321";
   
    $_POST['CateID'] = 2;//2电影
    $_POST['Status'] = 1;//0公开，1草稿，2审核


    PostArticle();

print_r("成功！");
?>