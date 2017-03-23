<?php
function dm_tools_remoteimg_main(&$article) {
	global $zbp,$dm_tools;
	if (!$zbp->Config($dm_tools['name'])->dm_tools_remoteimg_switch) return;
	set_time_limit(0);
	ZBlogException::ClearErrorHook();
	$content = $article->Content;
	$pattern = "/<img.*src=[\'|\"](.*)[\'|\"]\s*.*>/iU";
	preg_match_all($pattern,$content,$matchContent);
	$picArray = $matchContent[1];
	if ($picArray){		
		foreach($picArray as $key=>$rurl){			
			if(substr($rurl,0,strlen($zbp->host))!=$zbp->host) {
				$path=$zbp->usersdir.'upload/'.date('Y').'/'.date('m');			
				if(!file_exists($path)) mkdir($path,0755,true);
				$picname=date('YmdHis').'_'.rand(10000,99999).'.'.dm_tools_remoteimg_pictype($rurl);
				$pic=$path.'/'.$picname;
				$getpic=dm_tools_remoteimg_save($rurl,$pic,$picname);
				$picUrl=str_replace($zbp->path,$zbp->host,$pic);
				$article->Content=str_replace($rurl,$picUrl,$article->Content);
			}
		}
	}
}

function dm_tools_remoteimg_pictype ($file){
	global $zbp;
$img=GetHttpContent($file);
$filename=$zbp->usersdir.'cache/dm_tools_RemoteImages.dat';
$fp2=@fopen($filename, "w");
fwrite($fp2,$img);
fclose($fp2);
$info = getimagesize($filename);
$info=$info['mime'];
$info=explode('/', $info);
    $str = $info[1];
    return $str;
} 

function dm_tools_remoteimg_save($url,$filename="",$name) {
	global $zbp;
	if($url=="") return false;
		$ext=strrchr($name,".");
		if($ext!=".gif" && $ext!=".jpeg" && $ext!=".png") return false;
	$img = GetHttpContent($url);
	$size = strlen($img);
	$fp2=@fopen($filename, "a");
	fwrite($fp2,$img);
	fclose($fp2);
	$upload = new Upload;
	$upload->Name = $name;
	$upload->SourceName = $name;
	$upload->MimeType = "";
	$upload->Size = $size;
	$upload->AuthorID = $zbp->user->ID;
	$upload->Save();
	return true; 
}

