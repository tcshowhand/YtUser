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
if (!$zbp->Config('YtUser')->notice){$zbp->Config('YtUser')->notice ='<li><a href="#">这里是顶部滚动公告内容</a></li>
<li><a href="#">插件设置里面自行修改</a></li>';}
if (!$zbp->Config('YtUser')->foot){$zbp->Config('YtUser')->foot ='页面底部内容';}
?>
<script type="text/javascript" src="<?php echo $zbp->host;?>zb_users/plugin/UEditor/ueditor.config.php"></script>
<script type="text/javascript" src="<?php echo $zbp->host;?>zb_users/plugin/UEditor/ueditor.all.min.js"></script>
<script type="text/javascript" src="<?php echo $zbp->host; ?>zb_users/plugin/YtUser/template/js/lib.upload.js"></script>
<script src="<?php echo $zbp->host; ?>zb_users/plugin/YtUser/template/source/jscolor.js" type="text/javascript"></script>
<div id="divMain">
    <div class="divHeader"><?php echo $blogtitle;?></div>
    <div class="SubMenu">
        <?php echo YtUser_SubMenu('skin'); ?>
        
    </div>
    <div id="divMain2">
        <form id="form10" enctype="multipart/form-data" method="post" action="save.php?type=skin">  
            <table border="1" class="tableFull tableBorder">
                <tr>
                    <th style="width:20%">说明</th>
                    <th style="width:80%">配置项</th>
                </tr>
                <tr>
                    <td class="td30"><p align='left'><b>是否开启自带模板</b></p></td>
                    <td><input type="text" class="checkbox" name="user_template_on" value="<?php echo $zbp->Config('YtUser')->user_template_on;?>" />（本主题由<a href="https://www.txcstx.com/" target="_blank" title="天兴工作室">天兴工作室</a>友情提供）</td>
                </tr>
                <tr>
                    <td>会员中心页面logo</td>
                    <td>
                        <div class="img-up-box">
                            <input name="logo" value="<?php echo $zbp->Config('YtUser')->logo;?>" style="width:390px;">
                            <input type="button" class="upimg-btn tx-submit-btn" value="点击上传">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>登录注册页面背景图</td>
                    <td>
                        <div class="img-up-box">
                            <input name="bg" value="<?php echo $zbp->Config('YtUser')->bg;?>" style="width:390px;">
                            <input type="button" class="upimg-btn tx-submit-btn" value="点击上传">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>logo右侧公告</td>
                    <td>
                        <textarea name="notice" type="text" id="notice" style="width:500px;height:100px;"><?php echo $zbp->Config('YtUser')->notice;?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>用户中心首页栏目</td>
                    <td>
                        <div class="img-up-box">
                            <input name="homeids" value="<?php echo $zbp->Config('YtUser')->homeids;?>" style="width:390px;">
                            *填写分类ID。 多个分类用","分割。 例如 1,2,3
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>底部版权等</td>
                    <td>
                        <textarea name="foot" type="text" id="foot" style="width:500px;height:100px;"><?php echo $zbp->Config('YtUser')->foot;?></textarea>
                    </td>
                </tr>
            </table>
            <table border="1" class="tableFull tableBorder">
                <tr>
                    <td width="25%">页面主色</td>
                    <td width="25%">
                        <input name="color1" type="text" class="color1 color" style="width:50%" value="#<?php echo $zbp->Config('YtUser')->color1;?>">
                    </td>
                    <td width="25%">辅助颜色</td>
                    <td width="25%">
                        <input name="color2" type="text" class="color color2" style="width:50%" value="#<?php echo $zbp->Config('YtUser')->color2;?>" />
                    </td>
                </tr>
                <tr>
                    <td width="25%">线的颜色</td>
                    <td width="25%">
                        <input name="color3" type="text" class="color color3" style="width:50%" value="#<?php echo $zbp->Config('YtUser')->color3;?>">
                    </td>
                    <td width="25%">点亮颜色</td>
                    <td width="25%">
                        <input name="color4" type="text" class="color color4" style="width:50%" value="#<?php echo $zbp->Config('YtUser')->color4;?>" />
                    </td>
                </tr>
                <tr>
                    <td width="25%">模块背景</td>
                    <td width="25%">
                        <input name="color5" type="text" class="color color5" style="width:50%" value="#<?php echo $zbp->Config('YtUser')->color5;?>">
                    </td>
                    <td width="25%">背景颜色</td>
                    <td width="25%">
                        <input name="color6" type="text" class="color color6" style="width:50%" value="#<?php echo $zbp->Config('YtUser')->color6;?>" />
                    </td>
                </tr>
                <tr>
                    <td width="25%">文字颜色</td>
                    <td width="25%">
                        <input name="color7" type="text" class="color color7" style="width:50%" value="#<?php echo $zbp->Config('YtUser')->color7;?>">
                    </td>
                    <td width="25%">链接文字颜色</td>
                    <td width="25%">
                        <input name="color8" type="text" class="color color8" style="width:50%" value="#<?php echo $zbp->Config('YtUser')->color8;?>" />
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <input name="" type="Submit" class="button" value="保存">
                        <a href="javascript:;" class="recovery-color">恢复默认配色</a>
                    </td>
                </tr>
            </table>
        </form>

        <script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
        <script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/YtUser/logo.png';?>");</script>	
    </div>
</div>
<script>
    $(".recovery-color").click(function () {
        $(".color1").val("2D2B32");
        $(".color2").val("111111");
        $(".color3").val("DDDDDD");
        $(".color4").val("CC0000");
        $(".color5").val("FFFFFF");
        $(".color6").val("FAFAFA");
        $(".color7").val("5E5E5E");
        $(".color8").val("6E6E6E");
        $("#form10").trigger('submit');
    });
</script>
<?php
require $blogpath . 'zb_system/admin/admin_footer.php';    	 	  		  
RunTime();    	 					 			 
?>