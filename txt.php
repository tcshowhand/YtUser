<?php
require 'zb_system/function/c_system_base.php';
require 'zb_system/function/c_system_admin.php';

$zbp->Load();

$date = date('Y-m-d');
$max = 5;
echo '<meta http-equiv="content-type" content="text/html;charset=utf-8">';
if(isset($_COOKIE[$date])){
    if($_COOKIE[$date]>=$max){
        exit('已超过'.$max.'次');
    }else{
        $num = $_COOKIE[$date]+1;
        setcookie($date, $num, time()+86400);
    }
}else{
    $num = 1;
    setcookie($date, $num, time()+86400);
}
echo '第'.$num.'次访问';



?>