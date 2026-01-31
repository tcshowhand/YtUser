<?php
require '../../../../zb_system/function/c_system_base.php';
require '../../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}
if (isset($_GET['act'])){$act = $_GET['act'];}else{$act = 'base';}
$blogtitle='用户中心';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
?>

<div id="divMain">
    <div class="divHeader"><?php echo $blogtitle;?></div>
    <div class="SubMenu">
        <?php echo YtUser_SubMenu('show'); ?>
    </div>
    <div id="divMain2">

        <form enctype="multipart/form-data" method="post" action="save.php?type=base">  
            <input id="reset" name="reset" type="hidden" value="" />
            <table border="1" class="tableFull tableBorder">
                <tr>
                    <th class="td30"><p align='left'><b>标题</b><br><span class='note'></span></p></th>
                    <th>说明</th>
                </tr>
                <tr>
                    <td class="td30"><p align='left'><b>Z-Blog PHP交流群</b></p></td>
                    <td><a target="_blank" href="https://jq.qq.com/?_wv=1027&k=Pz1pUize"><img border="0" src="//pub.idqqimg.com/wpa/images/group.png" alt="Z-BlogPHP独立博客交流群" title="Z-BlogPHP独立博客交流群"></a> qq群号：4243058</td>
                </tr>
                <tr>
                    <td class="td30"><p align='left'><b>操作说明</b></p></td>
                    <td><a target="_blank" href="https://www.ytecn.com/post/306.html">	操作说明 常见问题 Wiki <-- 看这里</a></td>
                </tr>
                <tr>
                    <td class="td30"><p align='left'><b>特别说明</b></p></td>
                    <td>如因升级，导致插件的某些功能不能正常使用，请第一时间联系作者
                    <a target="_blank" href="http://sighttp.qq.com/authd?IDKEY=bf71bc4ac48db34056bd0887e2cfb81ad8fc41dd364350a8"><img border="0"  src="http://wpa.qq.com/imgd?IDKEY=bf71bc4ac48db34056bd0887e2cfb81ad8fc41dd364350a8&pic=51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a></td>
                </tr>
                <tr>
                    <td class="td30"><p align='left'><b></b></p></td>
                    <td>其他问题请<a href="https://app.zblogcn.com/zb_users/plugin/Workorder/workorder_post.php?appid=1139" target="_blank" title="提交工单">提交工单 <-- 可点击</a></td>
                </tr>
            </table>
        </form>

        <script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
        <script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/YtUser/logo.png';?>");</script>	
    </div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';   	    	 	    	    	    			    			 			 
RunTime(); 			     	  	  	  	 				
?>