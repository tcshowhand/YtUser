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
  if(!empty($_POST['limit_dir1'])){
    $zbp->Config('YtUser')->limit_dirz1 = json_encode($_POST['limit_dir1']);
  }else{
    $zbp->Config('YtUser')->limit_dirz1=json_encode([]);
  }
  if(!empty($_POST['limit_dir1'])){
    $zbp->Config('YtUser')->limit_dirz2 = json_encode($_POST['limit_dir2']);
  }else{
    $zbp->Config('YtUser')->limit_dirz2=json_encode([]);
  }
  $zbp->Config('YtUser')->contribute_on = (int)GetVars('contribute_on','POST');
  $zbp->Config('YtUser')->contribute_jf = GetVars('contribute_jf','POST');
  $zbp->Config('YtUser')->contribute_level = (int)GetVars('contribute_level','POST');
  $zbp->Config('YtUser')->contribute_status = (int)GetVars('contribute_status','POST');
  $zbp->Config('YtUser')->topprice = (int)GetVars('topprice','POST');
  $zbp->Config('YtUser')->certifititle = (int)GetVars('certifititle','POST');
  $zbp->Config('YtUser')->dspost_on = (int)GetVars('dspost_on','POST');
  $zbp->Config('YtUser')->buypay_on = (int)GetVars('buypay_on','POST');
  $zbp->Config('YtUser')->contribute_text = GetVars('contribute_text','POST');
  $zbp->Config('YtUser')->tverifycode_on = (int)GetVars('tverifycode_on','POST');
  $zbp->SaveConfig('YtUser');

  $zbp->SetHint('good','修改成功');
  Redirect('./contribute.php');
}

$blogtitle='用户中心';     	  		 	 	 	    			
require $blogpath . 'zb_system/admin/admin_header.php';    						 	   			   	 	
require $blogpath . 'zb_system/admin/admin_top.php';   	     	  					    	    		
?>
<div id="divMain">
    <div class="divHeader"><?php echo $blogtitle;?></div>
    <div class="SubMenu">
        <?php echo YtUser_SubMenu('contribute'); ?>
    </div>
    <div id="divMain2">
        <form enctype="multipart/form-data" method="post" action="?act=save">
            <input type="hidden" name="csrfToken" value="<?php echo $zbp->GetCSRFToken(); ?>">
            <table border="1" class="tableFull tableBorder">
                <tr>
                    <th><p align='left'><b>选项</b><br><span class='note'></span></p></th>
                    <th>说明</th>
                </tr>
                <tr>
                <td><p align='left'><b>设置投稿标题限制字数</b></p></td>
                <td><input type="text" name="certifititle" style="width:150px;" value="<?php echo (int)$zbp->Config('YtUser')->certifititle ? $zbp->Config('YtUser')->certifititle : "0" ;?>" style="width:89%;" />0为不限制</td>
                </tr>

                <tr>
                    <td><p align='left'><b>是否开启投稿送积分</b></p></td>
                    <td><input type="text" class="checkbox" name="contribute_on" value="<?php echo $zbp->Config('YtUser')->contribute_on;?>"></td>
                </tr>
                <tr>
                    <td><p align='left'><b>投稿成功奖励积分</b></p></td>
                    <td><input type="text" name="contribute_jf" style="width:150px;" value="<?php echo (int)$zbp->Config('YtUser')->contribute_jf ? $zbp->Config('YtUser')->contribute_jf : "5" ;?>" style="width:89%;">
                    <p>正数，审核文章的时候奖励；负数发帖的时候扣除，如文章未被审核通过删除后返还积分</p>
                </td>
                </tr>
                <tr>
                    <td><p align='left'><b>可以投稿的用户最低等级</b></p></td>
                    <td>
                        <select class="yt-level edit" name="contribute_level" id="contribute_level">
                            <?php echo OutputOptionItemsOfMemberLevel($zbp->Config('YtUser')->contribute_level); ?>
                        </select>
                        <p>设置完后还需要通过“<a href="<?php echo $zbp->host; ?>zb_users/plugin/AppCentre/main.php?id=1608" target="_blank">分类权限角色分配器</a>”插件来设置相关用户组仅能在哪个分类投稿。</p>
                        <p>如果当前分组没有发稿权限，还需要通过“<a href="<?php echo $zbp->host; ?>zb_users/plugin/AppCentre/main.php?id=235" target="_blank">Z-Blog角色分配器</a>”插件来设置相关分组的权限。</p>
                    </td>
                </tr>
                <tr>
                    <td><p align='left'><b>投稿后的文章状态：</b></p></td>
                    <td>
                        <select class="yt-status edit" name="contribute_status" id="contribute_status">
                            <option value="0">公开</option>
                            <option value="1">草稿</option>
                            <option value="2" selected="selected">审核</option> 
                        </select>
                    </td>
                </tr>

                <tr>
                    <td><p align='left'><b>置顶一天扣积分</b></p></td>
                    <td><input type="text" name="topprice" style="width:150px;" value="<?php echo (int)$zbp->Config('YtUser')->topprice ? $zbp->Config('YtUser')->topprice : "0" ;?>" style="width:89%;">
                    <p>全局置顶文章一天需要扣的积分，为0时，不显示置顶功能</p>
                    </td>
                </td>

                <tr>
                    <td><p align='left'><b>售卖功能</b></p></td>
                    <td><input type="text" class="checkbox" name="buypay_on" value="<?php echo $zbp->Config('YtUser')->buypay_on;?>">
                    <p>投稿被积分（支付）购买后，可获得对应的积分</p>
                    </td>
                </tr>

                <tr>
                    <td class="td30"><p align='left'><b>投稿页相关说明文字</b></p></td>
                    <td><textarea name="contribute_text" style="width:90%;height:100px;" /><?php echo htmlspecialchars($zbp->Config('YtUser')->contribute_text);?></textarea></td>
                </tr>

                <tr>
                    <td><p align='left'><b>是否关闭投稿验证码</b></p></td>
                    <td><input type="text" class="checkbox" name="tverifycode_on" value="<?php echo $zbp->Config('YtUser')->tverifycode_on;?>"></td>
                </tr>

                <tr>
                    <td class="td30"><p align='left'><b>扩展字段</b></p></td>
                    <td id="article_sort1">
                    <div class="sortbox1" style="margin: 10px 0;">
                        <?php 
                        $list1 = json_decode($zbp->Config('YtUser')->limit_dirz1,true);
                        $list2 = json_decode($zbp->Config('YtUser')->limit_dirz2,true);
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


            </table>
            <hr/>
            <p>
                <input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>">
            </p>
        </form>

        <script type="text/javascript">
            ActiveLeftMenu("aPluginMng");
            var x = <?php echo $zbp->Config('YtUser')->contribute_status;?>;
            $(".yt-status").val(x);
        </script>

        <script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/YtUser/logo.png';?>");</script>	

    </div>

</div>

<script>
  var itemStr1 = `
<div class = "sortline">
    <input class = "sort-title" type = "text" name = "limit_dir1[]" value = "" placeholder="字段名" />
    <input class = "sort-title" type = "text" name = "limit_dir2[]" value = "" placeholder="字段" />
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