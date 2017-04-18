<?php 
$s = md5(str_replace('.', '', trim(uniqid('yt', true), 'yt')));
echo $s;
?>