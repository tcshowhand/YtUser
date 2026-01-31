<?php
require '../../../../zb_system/function/c_system_base.php';        
$zbp->Load();           
        
Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError','RespondError',PLUGIN_EXITSIGNAL_RETURN);
   
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}   
$verifycode=trim($_POST['verifycode']);                 
if(!$zbp->CheckValidCode($verifycode,'Resetpassword')){         
    ytuser_error('验证码错误，请重新输入.');die();
}          
$username=trim($_POST['username']);             
$hash=trim($_POST['hash']);  
$password=trim($_POST['password']);

if (strlen($password) < $zbp->option['ZC_PASSWORD_MIN'] || strlen($password) > $zbp->option['ZC_PASSWORD_MAX']) {
    ytuser_error('密码只能由A-Za-z0-9`~!?@#$%^&*-_字符组成，且不能小于8位、大于20位。');die();
}     
if (!CheckRegExp($password, '[password]')) {     
    ytuser_error('密码只能由A-Za-z0-9`~!?@#$%^&*-_字符组成，且不能小于8位、大于20位。');die();
}               
              
if(YtUser_password_verify_emailhash($username,$hash)  === true){ 
    $m = $zbp->GetMemberByName($username);
    $m->Password = md5(md5($password) .$m->Guid);
    $m->Save();
    ytuser_success('修改成功！');die();
}else{
    ytuser_error('信息有误，重置密码失败！');die(); 	
}               
?>