<?php
require '../../../../zb_system/function/c_system_base.php';

require '../../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}

if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}

$blogtitle='Robots文件设置 - '.$Nobird_Plugin_Name.$Nobird_Plugin_Title;


if(count($_POST) > 0){
$strrobots=$_POST["ta_robots"];
		@file_put_contents($zbp->path . 'robots.txt',$strrobots);
}

if(count($_GET)>0){

if(GetVars('del','GET')=='3'){
		@unlink($zbp->path . 'robots.txt');
	}
	$zbp->SetHint('good');
	Redirect('./robots.php');
}




function show_robots(){
global $zbp;
$str=@file_get_contents(ZBP_PATH.'robots.txt');
if(!$str){
	$str='User-agent: *
Disallow: /zb_users/
Disallow: /zb_system/
Sitemap: '.$zbp->host.'sitemap.xml
';

	}
	return $str;
}



require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';


$default_tab=3;

?>
<div id="divMain">

  <div class="divHeader"><?php echo $blogtitle;?></div>
<div class="SubMenu"><?php Nobird_Seo_Tools_SubMenu();?></div>
  <div id="divMain2">

	<form id="edit" name="edit" method="post" enctype="multipart/form-data" action="robots.php">
<input id="reset" name="reset" type="hidden" value="" />


            <div class="content-box"><!-- Start Content Box -->
              
              <div class="content-box-header">
                <ul class="content-box-tabs">
                  <li><a href="#tab3" <?php if($default_tab==3)echo 'class="default-tab"'; ?> ><span>robots.txt 内容设置</span></a></li>
                </ul>
                <div class="clear"></div>
              </div>
              <!-- End .content-box-header -->
              
              <div class="content-box-content">

			  
                <div class="tab-content <?php if($default_tab==3)echo 'default-tab'; ?> " style='border:none;padding:0px;margin:0;' id="tab3">
<textarea id="ta_robots" style="width:99%;height:200px" name="ta_robots">
<?php echo htmlentities(show_robots())?>
</textarea>
                  <hr/>
                  <p>
                    <input type="submit" value="创建robots.txt" />
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="button" onclick="window.location.href='?del=3'" value="删除robots.txt" />
                    <hr/><span class="star"></span>			
				  </p>
                </div>
				
				
              </div>
              <!-- End .content-box-content --> 
              
            </div>
            <!-- End .content-box -->


	  <hr/>
	</form>

	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/logo.png';?>");</script>	
  </div>
</div>


<?php
require $blogpath . 'zb_system/admin/admin_footer.php';

RunTime();
?>