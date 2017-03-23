<?php
#注册插件
RegisterPlugin("Tc_Usercenter","ActivePlugin_Tc_Usercenter");

function ActivePlugin_Tc_Usercenter() {
    Add_Filter_Plugin('Filter_Plugin_Index_Begin','Tc_Usercenter_ViewPost_Template');
}

function InstallPlugin_Tc_Usercenter() {
    global $zbp;
    //配置初始化
       $t=new Module();
  $t->Name="Tc控制面板";
  $t->FileName="tccontrolpanel";
  $t->Source="Usercenter";
  $t->SidebarID=0;
  $t->Content .='<span class="cp-hello">';
    $t->Content .='<form method="post" action="#">';
    $t->Content .='<table style="width:100%;border:none;font-size:1.1em;line-height:2.5em;">';
    $t->Content .='<tr style=""><th style="border:none;" colspan="2" scope="col"><p> </p></th></tr>';
    $t->Content .='<input type="hidden" name="username" id="username" value="" />';
    $t->Content .='<input type="hidden" name="password" id="password" value="" />';
    $t->Content .='<input type="hidden" name="savedate" id="savedate" value="30" />';
    $t->Content .='<tr><td style="border:none;" ><input required="required" type="text" id="edtUserName" name="edtUserName"  value="' . GetVars('username','COOKIE') . '"/></td></tr>';
    $t->Content .='<tr><td style="border:none;" ><input required="required" type="password" id="edtPassWord" name="edtPassWord"  /> </td></tr>';
    $t->Content .='<tr><td style="border:none;" ><input type="checkbox" name="chkRemember" id="chkRemember" tabindex="3" /> (*记住当前登陆状态) &nbsp;&nbsp; <input id="btnPost" name="btnPost" type="submit" style="background:#3a6ea5;border:1px solid #3399cc;color:#ffffff;cursor: pointer;width:50px;font-size:1.0em;padding:0.2em" value="登 陆" /> </td></tr>';

    $t->Content .='</table>';
    $t->Content .='</form>';
    $t->Content .='</span><br/><span class="cp-login"><a href="'.$zbp->host.'zb_system/cmd.php?act=login"></a></span>&nbsp;&nbsp;<span class="cp-vrs"><a href="'.$zbp->host.'zb_system/cmd.php?act=misc&amp;type=vrs"></a></span>';
  $t->HtmlID="divtccontrolpanel";
  $t->Type="ul";
  $t->Save();

}


function Tc_Usercenter_ViewPost_Template() {

    global $zbp;

        if(isset($_GET['tccontrolpanel'])) {

            if(VerifyLogin()){
                if ($zbp->user->ID>0 && GetVars('redirect','COOKIE')) {
                    Redirect(GetVars('redirect','COOKIE'));
                }
                    Redirect($zbp->host );
            }else{
                Redirect($zbp->host);
            }
            //echo '验证登陆'; 

        }

    $zbp->header .='<script src="'.$zbp->host.'zb_system/script/md5.js" type="text/javascript"></script>' . "\r\n";
    $zbp->header .='<script src="'.$zbp->host.'zb_system/script/c_admin_js_add.php" type="text/javascript"></script>' . "\r\n";
    $zbp->footer .='
    <script type="text/javascript">
        $(document).ready(function(){
            $("input").attr("checked","checked");
        });

        $("#btnPost").click(function(){

            var strUserName=$("#edtUserName").val();
            var strPassWord=$("#edtPassWord").val();
            var strSaveDate=$("#savedate").val()

            if((strUserName=="")||(strPassWord=="")){
                alert("' . $zbp->lang['error']['66'] . '");
                return false;
            }

            $("#edtUserName").remove();
            $("#edtPassWord").remove();

            $("form").attr("action","'. $zbp->host .'?tccontrolpanel");
            $("#username").val(strUserName);
            $("#password").val(MD5(strPassWord));
            $("#savedate").val(strSaveDate);
        })

        $("#chkRemember").click(function(){
            $("#savedate").attr("value",$("#chkRemember").attr("checked")=="checked"?30:0);
        })
    </script>' . "\r\n";

}