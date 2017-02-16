<?php

class NB_checklink{

	//保存函数
	public static function getvar(){
		global $zbp;
		$actiontype=GetVars('actiontype', 'POST');
    if($actiontype=="set5"){
			NB_checklink::checkyoulian();
			die();
		}
	}



	//检查友链
	public static function checkyoulian(){
		global $zbp;
		$url=GetVars('url','POST');
		if(empty($url)){
			echo '错误';
		}else{
			$host=$zbp->host;
			$host=substr($host,0,strlen($host)-1);
			$ajax = Network::Create();
			$ajax->open('GET', $url);
			$ajax->setTimeOuts(10,10,0,0);
      $ajax->setRequestHeader('User-Agent', 'Baiduspider+(+http://www.baidu.com/search/spider.htm)');
			$ajax->send();
			$status=$ajax->status;
			echo '[Code：'.$status.']';
			if($status=='302' || $status=='301'){
				echo '对方网址包含重定向内容';
				die();
			}else if($status=='404'){
				echo 'ErrCode：404 对方地址无法打开！';
				die();
			}else if($status=='0'){
				echo '链接超时或网址无效';
				die();
			}
			$text=$ajax->responseText;
			#$text=NB_checklink::sf_skin1_removeHtml($text);
			preg_match_all('/<a.*href=[\"\'](.*)[\"\'].*>/iU',$text,$temp);
			$find=false;
			if($temp!=null && $temp[1]!=null){
				for($i=0;$i<count($temp[1]);$i++){
					$val=$temp[1][$i];
					$val2=$val;
					if(strpos($val2,$host)===false){
					}else{
						$find=true;
						break;
					}
				}
			}
			if($find==true){
				echo '<b style="color:#28C2A0;">Good！有反向链接。</b>';
			}else{
				echo '<b style="color:#F00000;">无反向链接！</b>';
			}
		}
	}


}

?>