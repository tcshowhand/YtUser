<?php
require_once('./global.php');
Logout();
$ytUrl=$_SERVER['HTTP_REFERER'];
header('Location: '.$ytUrl);
?>