<?php
require '../../../../zb_system/function/c_system_base.php';
require '../../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}

$act = GetVars("act", "GET");
if ($act === "save") {
  CheckIsRefererValid();
  if(!empty($_POST['limit_zcdirz1'])){
    $zbp->Config('YtUser')->limit_zcdirz1 = json_encode($_POST['limit_zcdirz1']);
  }else{
    $zbp->Config('YtUser')->limit_zcdirz1=json_encode([]);
  }
  if(!empty($_POST['limit_zcdirz2'])){
    $zbp->Config('YtUser')->limit_zcdirz2 = json_encode($_POST['limit_zcdirz2']);
  }else{
    $zbp->Config('YtUser')->limit_zcdirz2=json_encode([]);
  }
  $zbp->Config('YtUser')->sms_on = GetVars('sms_on','POST');
	$zbp->Config('YtUser')->sms_upon = GetVars('sms_upon','POST');
  $zbp->Config('YtUser')->zc_verifycode_on = GetVars('zc_verifycode_on','POST');
  $zbp->Config('YtUser')->sms_limit = GetVars('sms_limit','POST');
  $zbp->Config('YtUser')->sms_count = GetVars('sms_count','POST');
  $zbp->Config('YtUser')->sms_sign = GetVars('sms_sign','POST');
  $zbp->Config('YtUser')->sms_code = GetVars('sms_code','POST');
  $zbp->Config('YtUser')->sms_verifycode = GetVars('sms_verifycode','POST');
  $zbp->SaveConfig('YtUser');

  $zbp->SetHint('good','修改成功');
  Redirect('./sms.php');
}

$blogtitle='用户中心';		 	
require $blogpath . 'zb_system/admin/admin_header.php';     							
require $blogpath . 'zb_system/admin/admin_top.php';    	    	  
    			   	 
?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
	<div class="SubMenu"><?php echo YtUser_SubMenu('sms'); ?></div>
  <div id="divMain2">
    <form enctype="multipart/form-data" method="post" action="?act=save">
    <input type="hidden" name="csrfToken" value="<?php echo $zbp->GetCSRFToken(); ?>">
    <table border="1" class="tableFull tableBorder">
    <tr>
      <th><p align='left'><b>选项</b><br><span class='note'></span></p></th>
      <th>说明</th>
    </tr>
    <tr>
      <td class="td30"><p align='left'><b>注册扩展字段</b></p></td>
      <td id="article_sort1">
        <div class="sortbox1" style="margin: 10px 0;">
        <?php 
          $list1 = json_decode($zbp->Config('YtUser')->limit_zcdirz1,true);
          $list2 = json_decode($zbp->Config('YtUser')->limit_zcdirz2,true);
          if(!empty($list1)){
            foreach ($list1 as $key=>$reg) {
            echo '<div class = "sortline">
            <input class = "sort-title" type = "text" name = "limit_dir1[]" value = "'.$reg.'" placeholder="内容" />
            <input class = "sort-title" type = "text" name = "limit_dir2[]" value = "'.$list2[$key].'" placeholder="字段" />
            <a href = "javascript:;" class = "nciaer_delbtn">[删除]</a></div>';
            }
          }
        ?>
        </div>
        <button class="newbtn1" type="button">+ 增加一行</button>
      </td>
    </tr>

    <tr>
      <td><p align='left'><b>注册方式</b></p></td>
      <td>
              <?php 
              $array=array();
              $array['0']="普通模式";
              $array['1']="手机号注册";
              $array['2']="邮箱注册";
              echo zbpform::radio('sms_on', $array, $zbp->Config('YtUser')->sms_on); ?>
              <p>如选择手机号或邮箱注册，请先安装并启动 - 相关的短信/邮箱插件(如未开启会导致用户无法注册账户)</p>
      </td>
    </tr>
    <tr>
      <td><p align='left'><b>是否开启强制手机号认证</b></p></td>
      <td><input type="text" class="checkbox" name="sms_upon" value="<?php echo $zbp->Config('YtUser')->sms_upon;?>" /></td>
    </tr>
    <tr>
      <td><p align='left'><b>N分钟内只可接收一条短信</b></p></td>
      <td><input type="text" name="sms_limit" style="width:150px;" value="<?php echo (int)$zbp->Config('YtUser')->sms_limit ? $zbp->Config('YtUser')->sms_limit : 5 ;?>" style="width:89%;" /></td>
    </tr>
    <tr>
      <td><p align='left'><b>一天仅可接受N条短信</b></p></td>
      <td><input type="text" name="sms_count" style="width:150px;" value="<?php echo (int)$zbp->Config('YtUser')->sms_count ? $zbp->Config('YtUser')->sms_count : 5 ;?>" style="width:89%;" /></td>
    </tr>
    <tr>
      <td><p align='left'><b>短信签名</b></p></td>
      <td><input type="text" name="sms_sign" style="width:150px;" value="<?php echo $zbp->Config('YtUser')->sms_sign ? $zbp->Config('YtUser')->sms_sign : '豫唐';?>" style="width:89%;" /></td>
    </tr>
    <tr>
      <td><p align='left'><b>模版CODE</b></p></td>
      <td><input type="text" name="sms_code" style="width:150px;" value="<?php echo $zbp->Config('YtUser')->sms_code ? $zbp->Config('YtUser')->sms_code : 'SMS_119225029' ;?>" style="width:89%;" /></td>
    </tr>
    <tr>
      <td><p align='left'><b>验证码变量</b></p></td>
      <td><input type="text" name="sms_verifycode" style="width:150px;" value="<?php echo $zbp->Config('YtUser')->sms_verifycode ? $zbp->Config('YtUser')->sms_verifycode : 'verifycode' ;?>" style="width:89%;" /></td>
    </tr>
    <tr>
      <td><p align='left'><b>短信案例：</b></p></td>
      <td>您的手机正在注册豫唐网账户，您的验证码为：${verifycode}</td>
    </table>
      <hr/>
      <p>
        <input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />
      </p>
    </form>

	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/YtUser/logo.png';?>");</script>
  </div>
</div>

<script>
  var itemStr1 = `
<div class = "sortline">
    <input class = "sort-title" type = "text" name = "limit_zcdirz1[]" value = "" placeholder="字段名" />
    <input class = "sort-title" type = "text" name = "limit_zcdirz2[]" value = "" placeholder="字段" />
    <a href = "javascript:;" class = "nciaer_delbtn">[删除]</a>
</div>
`;
  $(function() {
    $('.newbtn1').click(function() {
      $('.sortbox1').append(itemStr1);
    });
  });
  $('#article_sort1').on('click', '.nciaer_delbtn', function() {
    $(this).parent().remove();
  })
</script>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';       
RunTime();    	     		
?>