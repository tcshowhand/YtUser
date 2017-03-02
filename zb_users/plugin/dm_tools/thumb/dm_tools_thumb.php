<?php
require 'thumbHander.php';

class dm_tools_thumb{
	
	public $src="";
	public $encodesrc="";
	public $width=null;
	public $height=null;
	public $file=null;
	public $cuttype=0;

	public $md5=null;
	public $cachefile=null;

	public function createmd5(){
		global $blogpath;
		if(empty($this->width)){
			$this->width=0;
		}
		if(empty($this->height)){
			$this->height=0;
		}
		if(empty($this->cuttype)){
			$this->cuttype=0;
		}
		$str=$this->src.'-'.$this->width.'-'.$this->height.'-'.$this->cuttype;
		$this->md5=md5($str);
		$this->cachefile=$blogpath.'thumbs/'.$this->encodesrc.'-'.$this->width.'-'.$this->height.'-'.$this->cuttype.'-a.jpg';


	}

	public static function showpic($imgsrc){
		$size = getimagesize($imgsrc); //获取mime信息
		$fp=fopen($imgsrc, "rb"); //二进制方式打开文件
		header("Content-type: {$size['mime']}");
		fpassthru($fp); // 输出至浏览器
		fclose($fp);
	}

	public function checkHost(){
		global $zbp,$dm_tools;
		$url='';
		if(isset($_SERVER["HTTP_REFERER"])){
			$url=$_SERVER["HTTP_REFERER"];
		}
		if(dm_tools_thumb::startWith($url,$zbp->host)){
			return true;
		}
		$otherurl=$zbp->Config($dm_tools['name'])->dm_tools_thumb_checkhostin;
		if(empty($otherurl)==true){
			return false;
		}
		$temp=explode("|",$otherurl);
		if(!isset($temp)){
			return false;
		}
		foreach($temp as $str){
			if(dm_tools_thumb::startWith($url,trim($str))){
				return true;
			}
		}
		return false;
	}

	public function output(){
		global $zbp,$dm_tools;
		global $blogpath;
		
		$checkhost=$zbp->Config($dm_tools['name'])->dm_tools_thumb_checkhost;
		if(isset($checkhost) && $checkhost==1){
			if($this->checkHost()==false){
				dm_tools_thumb::showpic($dm_tools['path'].'thumb/daolian.jpg');
				die();
			}
		}
		if(file_exists($this->cachefile)==true){
			dm_tools_thumb::showpic($this->cachefile);
		}else{
			$this->handler=new dm_tools_thumb_ThumbHandler();
				if(dm_tools_thumb::startWith($this->src,$zbp->host)){
					$this->file=$blogpath.substr($this->src,strlen($zbp->host));
					$this->handler->setSrcImg($this->file);
					$this->handler->setCutType($this->cuttype);
					if($this->cuttype==4){
						$this->handler->setCutType(3);
						$this->handler->setDstImg($this->cachefile);
						if($this->width==null || $this->width==0){
							$this->handler->createImg(100);
						}else if($this->height==null || $this->height==0){
							$this->handler->createImg($this->width);
						}else{
							$this->handler->createImg($this->width,$this->height);
						}
						$this->handler=new dm_tools_thumb_ThumbHandler();
						$this->handler->setSrcImg($this->cachefile);
						$this->handler->setCutType(2);
					}
					$this->handler->setDstImg($this->cachefile);
					if($this->width==null || $this->width==0){
						$this->handler->createImg(100);
					}else if($this->height==null || $this->height==0){
						$this->handler->createImg($this->width);
					}else{
						$this->handler->createImg($this->width,$this->height);
					}
					if(file_exists($this->cachefile)){
						dm_tools_thumb::showpic($this->cachefile);
					}
				}elseif(!dm_tools_thumb::startWith($this->src,$zbp->host)&&$zbp->Config($dm_tools['name'])->dm_tools_thumb_remoteimg){
					ob_start();
					readfile($this->src);
					$img = ob_get_contents();
					ob_end_clean();
					$size = strlen($img);
					$this->handler->setDstImg($this->cachefile);
					$fp2=@fopen($this->cachefile.'.tmp', "w");
					fwrite($fp2,$img);
					fclose($fp2);
					$this->handler->setSrcImg($this->cachefile.'.tmp');
					$this->handler->setDstImg($this->cachefile);
					$this->handler->setCutType($this->cuttype);
					if($this->cuttype==4){
						$this->handler->setCutType(3);
						$this->handler->setDstImg($this->cachefile);
						if($this->width==null || $this->width==0){
							$this->handler->createImg(100);
						}else if($this->height==null || $this->height==0){
							$this->handler->createImg($this->width);
						}else{
							$this->handler->createImg($this->width,$this->height);
						}
						$this->handler=new dm_tools_thumb_ThumbHandler();
						$this->handler->setSrcImg($this->cachefile);
						$this->handler->setCutType(2);
					}
					$this->handler->setDstImg($this->cachefile);
					if($this->width==null || $this->width==0){
						$this->handler->createImg(100);
					}else if($this->height==null || $this->height==0){
						$this->handler->createImg($this->width);
					}else{
						$this->handler->createImg($this->width,$this->height);
					}
					@unlink($this->cachefile.'.tmp');
					if(file_exists($this->cachefile)){
						dm_tools_thumb::showpic($this->cachefile);
					}
				}
			
			
			
		}
		
	}
	
	public static function getPics(&$article,$width,$height,$cuttype=0){
		global $zbp;
        $pattern='/<img.*?src="(.*?)(?=")/';
		$content = $article->Content;
		preg_match_all($pattern,$content,$matchContent);
		$arr = array();
		if(isset($matchContent[1][0]))
		{
			foreach($matchContent[1] as $url){
				if(dm_tools_thumb::endWith(trim($url),'bmp')||dm_tools_thumb::endWith(trim($url),'BMP') ){
					$arr[]=$url;
				}else{
					$arr[]=dm_tools_thumb::getPicUrlBy($url,$width,$height,$cuttype);
				}
			}	
		}
		$article->dm_tools_thumb=$arr;
		$article->dm_tools_thumb_COUNT=count($arr);
		if($article->dm_tools_thumb_COUNT>0){
			$article->dm_tools_thumb_First=$arr[0];
		}else{
			$article->dm_tools_thumb_First=null;
		}
	}

	public static function getPicUrlBy($url,$width,$height,$cuttype=0){
		global $zbp,$dm_tools;
		$flag=$zbp->Config($dm_tools['name'])->dm_tools_thumb_switch;
		$changeurl=$zbp->Config($dm_tools['name'])->dm_tools_thumb_changeurl;
		if(isset($flag) && $flag==1){
      if(dm_tools_thumb::startWith($url,$zbp->host)){
          if(isset($changeurl) && $changeurl==1){
            return $zbp->host.'thumbs/'.urlencode(dm_tools_base64_encode($url)).'-'.$width.'-'.$height.'-'.$cuttype.'-a.jpg';
          }else{
            return $dm_tools['url'].'thumb/pic.php?src='.urlencode(dm_tools_base64_encode($url)).'&width='.$width.'&height='.$height.'&cuttype='.$cuttype;
          }
      }elseif(!dm_tools_thumb::startWith($url,$zbp->host)){
        if($zbp->Config($dm_tools['name'])->dm_tools_thumb_remoteimg){
            if(isset($changeurl) && $changeurl==1){
              return $zbp->host.'thumbs/'.urlencode(dm_tools_base64_encode($url)).'-'.$width.'-'.$height.'-'.$cuttype.'-a.jpg';
            }else{
              return $dm_tools['url'].'thumb/pic.php?src='.urlencode(dm_tools_base64_encode($url)).'&width='.$width.'&height='.$height.'&cuttype='.$cuttype;
            }
        }else{
          return $url;
        }
			}
		}else{
			return $url;
		}
	}

	public static function getImgType($file_path){
        $type_list = array("1"=>"gif","2"=>"jpg","3"=>"png","4"=>"swf","5" => "psd","6"=>"bmp","15"=>"wbmp");
        if(file_exists($file_path)){
            $img_info = @getimagesize ($file_path);
            if(isset($type_list[$img_info[2]])){
                Return $type_list[$img_info[2]];
            }
        }else{
            die("文件不存在,不能取得文件类型!");
        }
    }

	public static function createBean(){
		$bean=new dm_tools_thumb();
		$bean->src=dm_tools_base64_decode(urldecode(GetVars("src","GET")));
		$bean->encodesrc=GetVars("src","GET");
		$bean->width=(int)GetVars("width","GET");
		$bean->height=(int)GetVars("height","GET");
		$bean->cuttype=(int)GetVars("cuttype","GET");
		$bean->createmd5();
		return $bean;
	}

	public static function startWith($tempstr, $needle) {
		return strpos($tempstr, $needle) === 0;
	}

	public static function endWith($str, $needle) {
		if(strlen($str)==0){
			return false;
		}
		if(strlen($str)<strlen($needle)){
			return false;
		}
		if(strlen($str)==strlen($needle)){
			return $str==$needle;
		}
		$temp=substr($str,strlen($str)-strlen($needle));
		return strpos($temp, $needle) === 0;
	}
}
?>