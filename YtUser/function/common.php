<?php
$upid = (int) $zbp->Config('YtUser')->upid;
if ($upid == 0) {
  if (empty($zbp->Config('YtUser')->YtUser_UserEdit)) {
    $zbp->Config('YtUser')->YtUser_UserEdit = '?UserEdit';
    $zbp->SaveConfig('YtUser');
  }
  $zbp->Config('YtUser')->api_articleinfo = $zbp->host . 'zb_users/plugin/YtUser/common/articleInfo.php';
  $zbp->Config('YtUser')->api_login = $zbp->host . 'zb_users/plugin/YtUser/common/verify.php';
  $zbp->Config('YtUser')->api_register = $zbp->host . 'zb_users/plugin/YtUser/common/register.php';
  $r = $zbp->db->ExistTable('%pre%consume');
  if ($r) {
    $sql = "RENAME TABLE " . $zbp->option['ZC_MYSQL_PRE'] . "consume TO " . $zbp->option['ZC_MYSQL_PRE'] . "ytuser_consume";
    $zbp->db->Query($sql);
  }
  $r = $zbp->db->ExistTable('%pre%ytverification');
  if ($r) {
    $sql = "RENAME TABLE " . $zbp->option['ZC_MYSQL_PRE'] . "ytverification TO " . $zbp->option['ZC_MYSQL_PRE'] . "ytuser_verification";
    $zbp->db->Query($sql);
  }
  $r = $zbp->db->ExistTable('%pre%favorite');
  if ($r) {
    $sql = "RENAME TABLE " . $zbp->option['ZC_MYSQL_PRE'] . "favorite TO " . $zbp->option['ZC_MYSQL_PRE'] . "ytuser_favorite";
    $zbp->db->Query($sql);
  }
  $r = $zbp->db->ExistTable('%pre%prepaid');
  if ($r) {
    $sql = "RENAME TABLE " . $zbp->option['ZC_MYSQL_PRE'] . "prepaid TO " . $zbp->option['ZC_MYSQL_PRE'] . "ytuser_prepaid";
    $zbp->db->Query($sql);
  }
  $r = $zbp->db->ExistTable('%pre%activate');
  if ($r) {
    $sql = "RENAME TABLE " . $zbp->option['ZC_MYSQL_PRE'] . "activate TO " . $zbp->option['ZC_MYSQL_PRE'] . "ytuser_activate";
    $zbp->db->Query($sql);
  }
  $zbp->Config('YtUser')->upid = 1;
  $zbp->SaveConfig("YtUser");
}

if ($upid == 1) {
  $zbp->Config('YtUser')->api_changepassword = $zbp->host . 'zb_users/plugin/YtUser/common/changepassword.php';
  $zbp->Config('YtUser')->api_sbuy = $zbp->host . 'zb_users/plugin/YtUser/common/YtSbuy.php';
  $zbp->Config('YtUser')->upid = 2;
  $zbp->SaveConfig("YtUser");
}

if ($upid == 2) {
  $usertable = str_replace('%pre%', $zbp->option['ZC_SQLITE_PRE'], $zbp->table['ytuser_ytuser']);
  $hasKey = $zbp->db->ExistColumn($usertable, 'tc_vip');
  if (!$hasKey) {
    $zbp->db->sql->get()->ALTER($zbp->table['ytuser_ytuser'])
      ->ADDCOLUMN('tc_vip integer DEFAULT \'0\'')
      ->ADDCOLUMN('tc_cknum integer DEFAULT \'0\'')
      ->ADDCOLUMN('tc_cktime integer DEFAULT \'0\'')
      ->query;
  }
  $hasKey = $zbp->db->ExistTable($zbp->table['ytuser_ck']);
  if (!$hasKey) {
    $s = $zbp->db->sql->CreateTable($zbp->table['ytuser_ck'], $zbp->datainfo['ytuser_ck']);
    @$zbp->db->QueryMulit($s);
  }
  $hasKey = $zbp->db->ExistColumn($zbp->table['ytuser_ytuser'], 'tc_type');
  if (!$hasKey) {
    $zbp->db->sql->get()->ALTER($zbp->table['ytuser_ytuser'])
      ->ADDCOLUMN('tc_type integer DEFAULT \'0\'')
      ->query;
  }
  $zbp->Config('YtUser')->upid = 3;
  $zbp->Config('YtUser')->api_integral = $zbp->host . 'zb_users/plugin/YtUser/common/Integral.php';
  $zbp->SaveConfig("YtUser");
}

// print_r(alphaID("32",false,6));
// print_r(alphaID("GBAAAB",true,6));
// 加密解密数字
function YtUser_alphaID($in, $to_num = false, $pad_up = false, $passKey = null)
{
  $index = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  if ($passKey !== null) {

    for ($n = 0; $n < strlen($index); $n++) {
      $i[] = substr($index, $n, 1);
    }

    $passhash = hash('sha256', $passKey);
    $passhash = (strlen($passhash) < strlen($index))
      ? hash('sha512', $passKey)
      : $passhash;

    for ($n = 0; $n < strlen($index); $n++) {
      $p[] = substr($passhash, $n, 1);
    }

    array_multisort($p, SORT_DESC, $i);
    $index = implode($i);
  }

  $base = strlen($index);

  if ($to_num) {
    $in = strrev($in);
    $out = 0;
    $len = strlen($in) - 1;
    for ($t = 0; $t <= $len; $t++) {
      $bcpow = bcpow($base, $len - $t);
      $out = $out + strpos($index, substr($in, $t, 1)) * $bcpow;
    }

    if (is_numeric($pad_up)) {
      $pad_up--;
      if ($pad_up > 0) {
        $out -= pow($base, $pad_up);
      }
    }
    $out = sprintf('%F', $out);
    $out = substr($out, 0, strpos($out, '.'));
  } else {
    if (is_numeric($pad_up)) {
      $pad_up--;
      if ($pad_up > 0) {
        $in += pow($base, $pad_up);
      }
    }

    $out = "";
    for ($t = floor(log($in, $base)); $t >= 0; $t--) {
      $bcp = bcpow($base, $t);
      $a = floor($in / $bcp) % $base;
      $out = $out . substr($index, $a, 1);
      $in = $in - ($a * $bcp);
    }
    $out = strrev($out); // reverse
  }

  return $out;
}


function ytuser_error($title, $url = '')
{
  $array = array("code" => "0", "msg" => $title, "url" => $url);
  $array = ytuser_toJson($array);
  print $array;
}

function ytuser_success($title, $url = '')
{
  $array = array("code" => "1", "msg" => $title, "url" => $url);
  $array = ytuser_toJson($array);
  print $array;
}

function ytuser_toJson($array, $options = JSON_UNESCAPED_UNICODE)
{
  return json_encode($array, $options);
}

function ytuser_dom_element_load($text)
{
  $dom_document = new DOMDocument();
  $internalErrors = libxml_use_internal_errors(true);
  @$dom_document->loadHTML('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head><body>' . $text . '</body></html>');
  libxml_use_internal_errors($internalErrors);
  return $dom_document;
}
function ytuser_dom_element_serialize($dom_document)
{
  $body_node = $dom_document->getElementsByTagName('body')->item(0);
  $body_content = '';
  if ($body_node !== NULL) {
    foreach ($body_node->getElementsByTagName('script') as $node) {
      ytuser_dom_element($dom_document, $node);
    }
    foreach ($body_node->getElementsByTagName('style') as $node) {
      ytuser_dom_element($dom_document, $node, '/*', '*/');
    }
    foreach ($body_node->childNodes as $child_node) {
      $body_content .= $dom_document->saveXML($child_node);
    }
    $body_content = str_replace('&nbsp', '', $body_content);
    return preg_replace('|<([^> ]*)/>|i', '<$1 />', $body_content);
  } else {
    return $body_content;
  }
}

function ytuser_dom_element($dom_document, $dom_element, $comment_start = '//', $comment_end = '')
{
  foreach ($dom_element->childNodes as $node) {
    if (get_class($node) == 'DOMCdataSection') {
      $embed_prefix = "\n<!--{$comment_start}--><![CDATA[{$comment_start} ><!--{$comment_end}\n";
      $embed_suffix = "\n{$comment_start}--><!]]>{$comment_end}\n";
      $data = str_replace(']]>', ']]]]><![CDATA[>', $node->data);
      $fragment = $dom_document->createDocumentFragment();
      $fragment->appendXML($embed_prefix . $data . $embed_suffix);
      $dom_element->appendChild($fragment);
      $dom_element->removeChild($node);
    }
  }
}

/**
 * 判断是否为微信访问
 */
function YtUser_is_wechat()
{
  if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
    return true;
  }
  return false;
}

// 检查手机格式，中国手机不带国家代码，国际手机号格式为：国家代码-手机号       
function YtUser_check_mobile($mobile)
{
  if (preg_match('/(^(13\d|14\d|15\d|16\d|17\d|18\d|19\d)\d{8})$/', $mobile)) {
    return true;
  } else {
    if (preg_match('/^\d{1,4}-\d{5,11}$/', $mobile)) {
      if (preg_match('/^\d{1,4}-0+/', $mobile)) {
        return false;
      }
      return true;
    }
    return false;
  }
}

function ytuser_prefix_insert_post_ads($content, $ff, $seat = 2)
{
  global $zbp;
  $ad_code = $ff;
  return ytuser_prefix_insert_after_paragraph($ad_code, $seat, $content);
}

function ytuser_prefix_insert_after_paragraph($insertion, $paragraph_id, $content)
{
  $closing_p = '</p>';
  $paragraphs = explode($closing_p, $content);
  foreach ($paragraphs as $index => $paragraph) {
    if (trim($paragraph)) {
      $paragraphs[$index] .= $closing_p;
    }
    if ($paragraph_id == $index + 1) {
      $paragraphs[$index] .= $insertion;
    }
  }
  return implode('', $paragraphs);
}

function YtUser_payment_radio($int)
{
  $array = array("积分", "支付宝");
  foreach ($array as $key => $article) {
    echo '<input name="payment" type="radio" value="' . $key . '"';
    if ($key == $int) {
      echo 'checked="checked"';
    }
    echo '/>' . $article . '</label>';
  }
}
function Yt_Categories($default)
{
  global $zbp;
  foreach ($GLOBALS['hooks']['Filter_Plugin_OutputOptionItemsOfCategories'] as $fpname => &$fpsignal) {
    $fpreturn = $fpname($default);
    if ($fpsignal == PLUGIN_EXITSIGNAL_RETURN) {
      $fpsignal = PLUGIN_EXITSIGNAL_NONE;
      return $fpreturn;
    }
  }
  $s = null;
  foreach ($zbp->categoriesbyorder as $id => $cate) {
    $s .= '<option ' . ($default == $cate->ID ? 'selected="selected"' : '') . ' value="' . $cate->ID . '">' . $cate->SymbolName . '</option>';
  }
  return $s;
}
function ytecn_GetMemberList($select = null, $where = null, $order = null, $limit = null, $option = null)
{
  global $zbp;
  if (is_object($select) && get_parent_class($select) == 'SQL__Global') {
    $sql = $select->sql;
  } else {
    $sql = $zbp->db->sql->get()->from(array($zbp->table['Member'] => 'm'))
      ->where($where)
      ->option($option)
      ->leftjoin(array($zbp->table['ytuser_ytuser'] => 'pr'))
      ->on('m.mem_ID = pr.tc_uid')
      ->orderBy($order)
      ->limit($limit)
      ->sql;
    if (isset($option['pagebar'])) {
      if ($option['pagebar']->Count === null) {
        $query = $zbp->db->sql->get()->from(array($zbp->table['Member'] => 'm'))
          ->count(array('*' => 'num'))
          ->where($where)
          ->option($option)
          ->leftjoin(array($zbp->table['ytuser_ytuser'] => 'pr'))
          ->on('m.mem_ID = pr.tc_uid')
          ->query;
        $option['pagebar']->Count = GetValueInArrayByCurrent($query, 'num');
      }
      $option['pagebar']->Count = (int) $option['pagebar']->Count;
      $option['pagebar']->Make();
    }
  }
  $array = $zbp->GetListType('Member', $sql);
  if (isset($option['pagebar']) && is_object($option['pagebar'])) {
    $option['pagebar']->CurrentCount = count($array);
  }
  return $array;
}

function YtUser_password_verify_emailhash($name, $hash = '')
{
  global $zbp;
  if (($zbp->GetMemberByName($name)->ID)) {
    $m = $zbp->GetMemberByName($name);
    if ($hash === md5(md5($m->Password . $m->Email) . date('Ymdh'))) {
      return true;
    }
    if ($hash === md5(md5($m->Password . $m->Email) . date('Ymdh', strtotime("-1 Hour")))) {
      return true;
    }
    if ($hash == '') {
      return md5(md5($m->Password . $m->Email) . date('Ymdh'));
    }
    return false;
  } else {
    return false;
  }
}

//送积分
function YtUser_add_coin($uid, $pid = 0, $code = 0, $title = "", $class = 3)
{
  global $zbp;
  $YtConsume = new YtConsume();
  if ($zbp->user->Level > 2) {
    if ($class > 1) {
      $uid = $zbp->user->ID;
    }
  }
  $YtConsume->Uid = $uid;
  $YtConsume->Pid = $pid;
  $YtConsume->Time = time();
  $YtConsume->Money = $code;
  $YtConsume->Type = 0;
  $YtConsume->Class = $class;
  $YtConsume->Title = $title;
  $YtConsume->Save();

  $uuser = new Ytuser();
  $uuser->LoadInfoByField('Uid', $uid);
  if (!$uuser->ID) {
    $uuser->Uid = $uid;
    $uuser->Oid = 0;
    $uuser->Save();
  }
  $uuser->Price = $uuser->Price + $code;
  $uuser->Save();
}


function YtUser_ReplacePre(&$s)
{
  global $zbp;
  $s = str_replace('%pre%', $zbp->db->dbpre, $s);
  return $s;
}

function YtUser_SubMenu($action)
{
  $array = array(
    array('action' => 'show', 'url' => 'show.php', 'target' => '_self', 'float' => 'left', 'title' => '插件说明'),
    array(
      'action' => 'guide',
      'url' => 'guide.php',
      'target' => '_self',
      'float' => 'left',
      'title' => '链接说明',
    ),
    array(
      'action' => 'base',
      'url' => 'base.php',
      'target' => '_self',
      'float' => 'left',
      'title' => '网站设置',
    ),
    array(
      'action' => 'skin',
      'url' => 'skin.php',
      'target' => '_self',
      'float' => 'left',
      'title' => '界面设置',
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
      'action' => 'contribute',
      'url' => 'contribute.php',
      'target' => '_self',
      'float' => 'left',
      'title' => '投稿设置',
    ),
    array(
      'action' => 'download',
      'url' => 'download.php',
      'target' => '_self',
      'float' => 'left',
      'title' => '下载站专享',
    ),
    array(
      'action' => 'payment',
      'url' => 'payment.php',
      'target' => '_self',
      'float' => 'left',
      'title' => '支付方式',
    ),
    array(
      'action' => 'sms',
      'url' => 'sms.php',
      'target' => '_self',
      'float' => 'left',
      'title' => '短信/邮箱注册',
    ),
    array(
      'action' => 'invite',
      'url' => 'invite.php',
      'target' => '_self',
      'float' => 'left',
      'title' => '注册邀请',
    ),
    array(
      'action' => 'rewrite',
      'url' => 'rewrite.php',
      'target' => '_self',
      'float' => 'left',
      'title' => '伪静态设置',
    ),
    array(
      'action' => 'wechat',
      'url' => 'wechat_menu_set.php',
      'target' => '_self',
      'float' => 'left',
      'title' => '微信公众号',
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
function ytuser_table_num($table, $fields)
{
  global $zbp;

  $datainfo = $zbp->datainfo[$table];
  $conditions = array();
  foreach ($fields as $field_key => $field_value) {
    $field_name = $datainfo[$field_key][0];
    $conditions[] = array('=', $field_name, $field_value);
  }
  $num = $zbp->db->sql->get()->select($zbp->table[$table])->count(array($datainfo['ID'][0] => 'num'))->where($conditions)->query[0]['num'];
  return $num;
}

function YtUser_Code_Create($n, $p = 0, $o = 0)
{
  global $zbp;
  $p = (int) $p;
  $n = (int) $n;
  $o = (int) $o;
  if ($p < 0) {
    $p = 0;
  }
  if ($o == 1) {
    for ($i = 0; $i < $n; $i++) {
      $r = new ytuser_code();
      $r->InviteCode = GetGuid();
      $r->Type = $o;
      $r->Price = $p;
      $r->Save();
    }
  }
}

function YtUser_Code_Del($n = 0, $o = 0)
{
  global $zbp;
  $o = (int) $o;
  if ($n < 1)
    die();
  if ($o < 1)
    die();
  $w = array();
  if ($n == 1) {
    $w[] = array('<>', 'reg_AuthorID', 0);
  }
  if ($n == 2) {
    $w[] = array('=', 'reg_AuthorID', 0);
  }
  $w[] = array('=', 'reg_Type', $o);
  $sql = $zbp->db->sql->Delete($zbp->table['ytuser_code'], $w);
  $zbp->db->Delete($sql);
}

function YtUser_xz1($lx = 1, $type = 1)
{
  global $zbp;
  $where = array();
  if ($lx == 1) {
    if ($type == 1)
      $where[] = array('>', 'reg_AuthorID', 0);
    if ($type == 2)
      $where[] = array('=', 'reg_AuthorID', 0);
  }
  if ($lx == 2) {
    if ($type == 1)
      $where[] = array('>', 'tc_AuthorID', 0);
    if ($type == 2)
      $where[] = array('=', 'tc_AuthorID', 0);
  }
  if ($lx == 3) {
    if ($type == 1)
      $where[] = array('>', 'reg_AuthorID', 0);
    if ($type == 2)
      $where[] = array('=', 'reg_AuthorID', 0);
  }
  $array = array();
  if ($lx == 1) {
    $sql = $zbp->db->sql->Select($zbp->table['ytuser_activate'], '*', $where, 'reg_ID DESC', null, null);
    $array = $zbp->GetListCustom($zbp->table['ytuser_activate'], $zbp->datainfo['ytuser_activate'], $sql);
  }

  if ($lx == 2) {
    $sql = $zbp->db->sql->Select($zbp->table['ytuser_prepaid'], '*', $where, 'tc_ID DESC', null, null);
    $array = $zbp->GetListCustom($zbp->table['ytuser_prepaid'], $zbp->datainfo['ytuser_prepaid'], $sql);
  }

  if ($lx == 3) {
    $sql = $zbp->db->sql->Select($zbp->table['ytuser_code'], '*', $where, 'reg_ID desc', null, null);
    $array = $zbp->GetListCustom($zbp->table['ytuser_code'], $zbp->datainfo['ytuser_code'], $sql);
  }
  $cc = "";
  foreach ($array as $key => $reg) {
    $cc .= $reg->InviteCode . "
";
  }
  header("Content-Type: application/octet-stream");
  $ua = $_SERVER["HTTP_USER_AGENT"];
  $filename = "list.txt";
  $encoded_filename = urlencode($filename);
  $encoded_filename = str_replace("+", "%20", $encoded_filename);
  if (preg_match("/MSIE/", $_SERVER['HTTP_USER_AGENT'])) {
    header('Content-Disposition: p_w_upload; filename="' . $encoded_filename . '"');
  } elseif (preg_match("/Firefox/", $_SERVER['HTTP_USER_AGENT'])) {
    header('Content-Disposition: p_w_upload; filename*="' . $filename . '"');
  } else {
    header('Content-Disposition: p_w_upload; filename="' . $filename . '"');
  }
  echo $cc;
  die();
}

function YtUser_Price_DelnoUsedCode()
{
  global $zbp;
  $sql = $zbp->db->sql->Delete($zbp->table['ytuser_prepaid'], array(array('=', 'tc_AuthorID', 0)));
  $zbp->db->Delete($sql);
}

function YtUser_Price_DelUsedCode()
{
  global $zbp;
  $sql = $zbp->db->sql->Delete($zbp->table['ytuser_prepaid'], array(array('<>', 'tc_AuthorID', 0)));
  $zbp->db->Delete($sql);
}

function YtUser_Price_CreateCode($n, $p = 100)
{
  global $zbp;
  $p = (int) $p;
  if ($p < 1) {
    $p = 100;
  }
  for ($i = 0; $i < $n; $i++) {
    $r = new Base($zbp->table['ytuser_prepaid'], $zbp->datainfo['ytuser_prepaid']);
    $r->InviteCode = GetGuid();
    $r->Price = $p;
    $r->Save();
  }
}

function YtUser_Price_EmptyCode()
{
  global $zbp;
  $sql = $zbp->db->sql->Delete($zbp->table['ytuser_prepaid'], null);
  $zbp->db->Delete($sql);
}

function YtUser_DelUsedCode()
{
  global $zbp;
  $sql = $zbp->db->sql->Delete($zbp->table['ytuser_activate'], array(array('<>', 'reg_AuthorID', 0)));
  $zbp->db->Delete($sql);
}
function YtUser_DelUsedCoden()
{
  global $zbp;
  $sql = $zbp->db->sql->Delete($zbp->table['ytuser_activate'], array(array('=', 'reg_AuthorID', 0)));
  $zbp->db->Delete($sql);
}

function YtUser_EmptyCode()
{
  global $zbp;
  $sql = $zbp->db->sql->Delete($zbp->table['ytuser_activate'], null);
  $zbp->db->Delete($sql);
}

function YtUser_CreateCode($n, $p = 30)
{
  global $zbp;
  $p = (int) $p;
  if ($p < 1) {
    $p = 7;
  }
  for ($i = 0; $i < $n; $i++) {
    $r = new Base($zbp->table['ytuser_activate'], $zbp->datainfo['ytuser_activate']);
    $r->InviteCode = GetGuid();
    $r->Level = $p;
    $r->Save();
  }
}

function ytuser_tCheckIsRefererValid()
{
  global $zbp;
  $flag = CheckCSRFTokenValid();
  if ($flag && $zbp->option['ZC_ADDITIONAL_SECURITY']) {
    $flag = CheckHTTPRefererValid();
  }
  if (!$flag) {
    ytuser_error('非法访问');
    die();
  }
}