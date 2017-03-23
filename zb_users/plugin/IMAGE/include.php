<?php
#注册插件
RegisterPlugin("IMAGE","ActivePlugin_IMAGE");
require  dirname(__FILE__) . DIRECTORY_SEPARATOR .'thumbHander.php';
require  dirname(__FILE__) . DIRECTORY_SEPARATOR .'IMAGE.php';
function ActivePlugin_IMAGE() {
	
}



///
   function IMAGE_urlsafe_b64encode($string) {
       $data = base64_encode($string);
       $data = str_replace(array('+','/','='),array('~','_',''),$data);
       return $data;
    }
   function IMAGE_urlsafe_b64decode($string) {
       $data = str_replace(array('-','_'),array('+','/'),$string);
       $mod4 = strlen($data) % 4;
       if ($mod4) {
           $data .= substr('====', $mod4);
       }
       return base64_decode($data);
    }    
///



function IMAGE_deleteDir($dirName){ 
	if(is_dir($dirName)){
		if ( $handle = opendir( "$dirName" ) ) {  
			while ( false !== ( $item = readdir( $handle ) ) ) {  
				if ( $item != "." && $item != ".." ) {  
					if ( is_dir( "$dirName/$item" ) ) {  
						IMAGE_deleteDir( "$dirName/$item" );  
					} else {  
						unlink( "$dirName/$item" );
					}
				}  
			}  
	   }  
		closedir( $handle );  
		rmdir( $dirName );
	}
}

function InstallPlugin_IMAGE() {
	global $zbp;
	if(!$zbp->Config('IMAGE')->HasKey('version')) {
		$zbp->Config('IMAGE')->version=1.0;
		$zbp->Config('IMAGE')->checkhost=0;
		$zbp->Config('IMAGE')->on=1;
		$zbp->Config('IMAGE')->otherurl="";
		$zbp->Config('IMAGE')->changeurl=0;
		$zbp->Config('IMAGE')->CacheExternalUrl=0;
		$zbp->SaveConfig('IMAGE');	
	}
}
function UninstallPlugin_IMAGE() {
	global $zbp;
	global $blogpath;
	$file=$blogpath.'zb_users/static/';
	if(file_exists($file)){
		IMAGE_deleteDir($file);
	}
	$zbp->DelConfig('IMAGE');
}

//tclip($blogpath.'zb_users/plugin/IMAGE/daolian.jpg', $blogpath.'zb_users/plugin/IMAGE/daolian1.jpg',10,10);