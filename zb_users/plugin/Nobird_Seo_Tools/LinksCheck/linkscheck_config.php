<?php

function NB_Getlink(){
		global $zbp;
	$txt = Nobird_Seo_Tools_LinksCheck_GetAll($zbp->host);
preg_match_all ('/<a.*?href=\"(.*?)\".*?>(.*?)<\/a>/i',$txt,$match);
//第一次匹配出页面所有的a标签
$str='';
		$count=1;
$temphost=substr($zbp->host,0,strlen($zbp->host)-1);
foreach ($match[0] as $val){

  if (!stripos($val,$temphost)&&!stripos($val,'#')&&!stripos($val,'javascript:')){  //如果不是内链
     echo '<tr check="'.$count.'">';
    preg_match_all ('/<a.*?href=\"(.*?)\".*?>(.*?)<\/a>/i',$val,$result); //进行第二次匹配(其实应该只需要匹配一次就行...数组好复杂...)
    echo '<td class="td5">'.$count.'</td><td class="td20">'.$result[0][0].'</td><td  class="td20" type="url">'.$result[1][0].'</td><td  class="td20">'.$result[2][0].'</td><td class="td20" type="result"></td>';
  #  echo '<td  type="result"></td>'. "\r\n";
  echo '</tr>';  
  $count++;
   }
   }
}

	
function Nobird_Seo_Tools_LinksCheck_GetAll($url) {
	$ajax = Network::Create();
	$ajax->open('GET', $url);
	$ajax->setRequestHeader('User-Agent', 'Baiduspider+(+http://www.baidu.com/search/spider.htm)');
	$ajax->send();
	return Nobird_Seo_Tools_LinksCheck_characet($ajax->responseText);
}

function Nobird_Seo_Tools_LinksCheck_characet($data){ //统一转码 utf-8
	  if( !empty($data) ){
	    $fileType = mb_detect_encoding($data , array('UTF-8','GBK','LATIN1','BIG5')) ;
	    if( $fileType != 'UTF-8'){
	      $data = mb_convert_encoding($data ,'utf-8' , $fileType);
	    }
	  }
	  return $data;
}



?>