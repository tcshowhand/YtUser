<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('YT_johndoe')) {$zbp->ShowError(48);die();}
$blogtitle='主题配置-YT_johndoe';

$act = "";
if ($_GET['act']){
$act = $_GET['act'] == "" ? 'config' : $_GET['act'];
}

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';


if(isset($_POST['Forum'])){
foreach($_POST['Forum'] as $key=>$val){
$zbp->Config('YT_johndoe')->$key = $val;
}
$zbp->SaveConfig('YT_johndoe');
$zbp->ShowHint('good');
}

if(isset($_POST['tcadonly'])){
foreach($_POST['tcadonly'] as $key=>$val){
$zbp->Config('YT_johndoe')->$key = $val;
}
$zbp->SaveConfig('YT_johndoe');
$zbp->ShowHint('good');
}

if(isset($_POST['Mwidth'])){
foreach($_POST['Mwidth'] as $key=>$val){
$zbp->Config('YT_johndoe')->$key = $val;
}
$zbp->SaveConfig('YT_johndoe');
$zbp->ShowHint('good');
}

?>

<style>
input.text{background:#FFF;border:1px double #aaa;font-size:1em;padding:0.25em;}
p{line-height:1.5em;padding:0.5em 0;}
</style>
<div id="divMain">
    <div class="divHeader"><?php echo $blogtitle;?></div>
    <div class="SubMenu">
        <?php YT_johndoe_SubMenu($act);?>
        <a href="http://www.tyytwl.top/" target="_blank"><span class="m-left" style="color:#F00">帮助</span></a>
    </div>

    <div id="divMain2">
    <?php
    if ($act == 'config'){
    ?>
  <form id="form1" name="form1" method="post">
    <table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
    <tr>
      <th width="15%"><p align="center">配置名称</p></th>
      <th width="50%"><p align="center">配置内容</p></th>
      <th width="25%"><p align="center">配置说明</p></th>
    </tr>
    <tr>
      <td><label for="pagea"><p align="center">首页第一块页面选择</p></label></td>
      <td><p align="left"><select  class="edit" size="1" name="Forum[pagea]"><?php echo YT_johndoe_pagealls($zbp->Config('YT_johndoe')->pagea);?></select></p></td>
      <td><p align="left"></p></td>
    </tr>
    <tr>
      <td><label for="pageb"><p align="center">首页第二块页面选择</p></label></td>
      <td><p align="left"><select  class="edit" size="1" name="Forum[pageb]"><?php echo YT_johndoe_pagealls($zbp->Config('YT_johndoe')->pageb);?></select></p></td>
      <td><p align="left"></p></td>
    </tr>
    <tr>
      <td><label for="pagec"><p align="center">首页第三块页面选择</p></label></td>
      <td><p align="left"><select  class="edit" size="1" name="Forum[pagec]"><?php echo YT_johndoe_pagealls($zbp->Config('YT_johndoe')->pagec);?></select></p></td>
      <td><p align="left"></p></td>
    </tr>
    <tr>
      <td><label for="paged"><p align="center">首页第四块页面选择</p></label></td>
      <td><p align="left"><select  class="edit" size="1" name="Forum[paged]"><?php echo YT_johndoe_pagealls($zbp->Config('YT_johndoe')->paged);?></select></p></td>
      <td><p align="left"></p></td>
    </tr>
    <tr>
      <td><label for="pagee"><p align="center">首页第五块页面选择</p></label></td>
      <td><p align="left"><select  class="edit" size="1" name="Forum[pagee]"><?php echo YT_johndoe_pagealls($zbp->Config('YT_johndoe')->pagee);?></select></p></td>
      <td><p align="left"></p></td>
    </tr>
    <tr>
      <td><label for="casea"><p align="center">首页第一块分类</p></label></td>
      <td><p align="left"><select class="edit" size="1" name="Forum[casea]"><?php echo CreateOptoinsOfCategorys($zbp->Config('YT_johndoe')->casea);?></select></p></td>
      <td><p align="left">请填写分类摘要:</p></td>
    </tr>
    <tr>
      <td><label for="caseb"><p align="center">首页第二块分类</p></label></td>
      <td><p align="left"><select class="edit" size="1" name="Forum[caseb]"><?php echo CreateOptoinsOfCategorys($zbp->Config('YT_johndoe')->caseb);?></select></p></td>
      <td><p align="left">请填写分类摘要</p></td>
    </tr>
    <tr>
      <td><label for="tcadd"><p align="center">地址</p></label></td>
      <td><p align="left"><input type="text"  name="Forum[tcadd]"  style="width:95%;"  value="<?php echo $zbp->Config('YT_johndoe')->tcadd;?>" /></p></td>
      <td><p align="left"></p></td>
    </tr>
    <tr>
      <td><label for="tcmail"><p align="center">邮箱</p></label></td>
      <td><p align="left"><input type="text"  name="Forum[tcmail]"  style="width:95%;"  value="<?php echo $zbp->Config('YT_johndoe')->tcmail;?>" /></p></td>
      <td><p align="left"></p></td>
    </tr>
    <tr>
      <td><label for="tctel"><p align="center">电话</p></label></td>
      <td><p align="left"><input type="text"  name="Forum[tctel]"  style="width:95%;"  value="<?php echo $zbp->Config('YT_johndoe')->tctel;?>" /></p></td>
      <td><p align="left"></p></td>
    </tr>

  <tr>
    <td colspan="3">
        <input name="" type="Submit" class="button" value="保存"/>
    </td>
  </tr>
</table>
    </form>
    <?php
    }
  ?>
    
    </div>
</div></div>
<script type="text/javascript">ActiveTopMenu("topmenu_TcOne");</script> 
<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>