<?php
require '../../../../zb_system/function/c_system_base.php';
$zbp->Load();
if (!$zbp->CheckPlugin('YtUser')) {die();}
$tradeno = GetVars('orderid', 'post');
if (empty($tradeno)) die();
$ver = new YtuserBuy();
$ver->LoadInfoByField('OrderID',$tradeno);
if ($ver->State == 0) {
  $cdata = array();
  $cdata['orderid'] = $ver->OrderID;
  $cdata['price'] = $ver->Pay;
  $cdata['returnurl'] = $zbp->host . $zbp->Config('YtUser')->YtUser_User;
  $cdata['payurl'] = $zbp->host . 'zb_users/plugin/YtUser/common/ytpay_notify_url.php';
  $cdata['mm'] = $zbp->Config('YtUser')->apisecret;
  ksort($cdata);
  reset($cdata);
  $sign = '';
  foreach ($cdata as $key => $val) {
    if ($sign) $sign .= '&';
    $sign .= "$key=$val";
  }
  $key = md5($sign);
  $zkey = GetVars('key', 'post');
  if ($key == $zkey) {
    print_r(strlen($tradeno));
    if (strlen($tradeno) == 23) {
      $vipstate = (int)(substr($tradeno, 0, 1));
      $Pricetemp=array('','2592000','7776000','31104000','3110400000','100','200','300');
      $uid = $ver->AuthorID;
      $newtime = (int)$Pricetemp[$vipstate];
      if ($vipstate < 5) {
        $keyvalue = array();
        $keyvalue['mem_Level'] = 4;
        $sql = $zbp->db->sql->Update($zbp->table['Member'], $keyvalue, array(array('=', 'mem_ID', $uid)));
        $zbp->db->Update($sql);
        $ytuser = new Ytuser();
        $ytuser->LoadInfoByField('Uid', $uid);
        if ($ytuser->Vipendtime < time()) {
          $ytuser->Vipendtime = time() + $newtime;
        } else {
          $ytuser->Vipendtime = $ytuser->Vipendtime + $newtime;
        }
        $ytuser->Save();
      } else {
        $title="支付宝充值" . $newtime . "积分";
        YtUser_add_coin($uid,0,$newtime,$title,0);
      }
    }
  }
}
echo 'success';
die();
