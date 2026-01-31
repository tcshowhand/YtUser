<?php
require '../../../../../zb_system/function/c_system_base.php';
ob_clean();
?>
var GV = {
  ROOT: "<?php echo $zbp->host; ?>",
  WEB_ROOT: "<?php echo $zbp->host; ?>zb_users/plugin/YtUser/",
  JS_ROOT: "/style/js/"
};
<?php
$s = ob_get_clean();
$m = 'W/' . md5($s);
header('Content-Type: application/x-javascript; charset=utf-8');
header('Etag: ' . $m);
echo $s;
die();
