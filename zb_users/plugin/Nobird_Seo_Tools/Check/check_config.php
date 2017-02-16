<?php
if (!function_exists('Nobird_AppCheck_SendMsg')){
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'function.php';   

}

function Nobird_Seo_Tools_Filter_Plugin_Check(){
  global $zbp;
  $appname='Nobird_Seo_Tools';
  $appid='481';  

  if($zbp->host=='http://www.birdol.com/'){
      $zbp->Config($appname)->AppCenterCheck=true;
      $zbp->SaveConfig($appname);
     // return true;
  }
  $checktime=$zbp->Config($appname)->AppCenterCheckTime;
  $now=time();
  if(ceil($now-$checktime)/(3600*24)<7){
    return true;
  }
	$postdate = array(
		'email'=>$zbp->Config('AppCentre')->username,
		'password'=>$zbp->Config('AppCentre')->password,
		'appid'=>$appid);
	$http_post = Network::Create();
if(!$http_post){

  $msg='';
  
}else{

	$http_post->open('POST',"http://app.zblogcn.com/api/index.php?api=isbuy");
	$http_post->setRequestHeader('Referer',substr($zbp->host,0,-1) . $zbp->currenturl);
	$http_post->send($postdate);
	$result = json_decode($http_post->responseText,true);
	//var_dump($result);die();
	if($result['ret']==0){
    if ($result['data']['buy']) {
        if(!$zbp->Config($appname)->AppCenterCheck){
          $zbp->Config($appname)->AppCenterCheck=true;
        }
      } else {
          $zbp->Config($appname)->AppCenterCheck=false;
    }
	}else{
          $zbp->Config($appname)->AppCenterCheck=false;
	}
          $zbp->Config($appname)->AppCenterCheckERR=$result['errcode'];
          $zbp->Config($appname)->AppCenterCheckTime=time();
          $zbp->SaveConfig($appname);    
Nobird_AppCheck_SendMsg($zbp->host,$appname,$zbp->Config($appname)->AppCenterCheck,$zbp->Config($appname)->AppCenterCheckERR);
  }
}


