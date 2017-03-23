<?php

class IMAGE{
	
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
		//$this->cachefile=$blogpath.'zb_users/plugin/IMAGE/cache/'.substr($this->md5,0,2).'/'.substr($this->md5,2,2).'/'.substr($this->md5,4,2).'/'.$this->md5.'.dat';
		$this->cachefile=$blogpath.'static/'.$this->encodesrc.'-'.$this->width.'-'.$this->height.'-'.$this->cuttype.'-a.jpg';


	}

	public static function showpic($imgsrc){
		$size = getimagesize($imgsrc); //获取mime信息
		$fp=fopen($imgsrc, "rb"); //二进制方式打开文件
		header("Content-type: {$size['mime']}");
		fpassthru($fp); // 输出至浏览器
		fclose($fp);
	}

	public function checkHost(){
		global $zbp;
		$url='';
		if(isset($_SERVER["HTTP_REFERER"])){
			$url=$_SERVER["HTTP_REFERER"];
		}
		if(IMAGE::startWith($url,$zbp->host)){
			return true;
		}
		$otherurl=$zbp->Config('IMAGE')->otherurl;
		if(empty($otherurl)==true){
			return false;
		}
		$temp=explode(",",$otherurl);
		if(!isset($temp)){
			return false;
		}
		foreach($temp as $str){
			if(IMAGE::startWith($url,trim($str))){
				return true;
			}
		}
		return false;
	}

	public function output(){
		global $zbp;
		global $blogpath;
		
		$checkhost=$zbp->Config('IMAGE')->checkhost;
		if(isset($checkhost) && $checkhost==1){
			if($this->checkHost()==false){
				IMAGE::showpic($blogpath.'zb_users/plugin/IMAGE/daolian.jpg');
				die();
			}
		}
		if(file_exists($this->cachefile)==true){
			IMAGE::showpic($this->cachefile);
		}else{
			$this->handler=new IMAGE_ThumbHandler();
				if(IMAGE::startWith($this->src,$zbp->host)){
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
						$this->handler=new IMAGE_ThumbHandler();
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
						IMAGE::showpic($this->cachefile);
					}
				}elseif(!IMAGE::startWith($this->src,$zbp->host)&&$zbp->Config('IMAGE')->CacheExternalUrl){
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
						$this->handler=new IMAGE_ThumbHandler();
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
						IMAGE::showpic($this->cachefile);
					}
				}
			
			
			
		}
		
	}

	
	public static function getPics(&$article,$width,$height,$cuttype=0){
		global $zbp;
	
		/*
		$pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
		$pattern='/<img(.*?)src="(.*?)(?=")/';
        */
        $pattern='/<img.*?src="(.*?)(?=")/';

		$content = $article->Content;
		preg_match_all($pattern,$content,$matchContent);
		$arr = array();
		if(isset($matchContent[1][0]))
		{
			foreach($matchContent[1] as $url){
				if(IMAGE::endWith(trim($url),'bmp')||IMAGE::endWith(trim($url),'BMP') ){
					$arr[]=$url;
				}else{
					$arr[]=IMAGE::getPicUrlBy($url,$width,$height,$cuttype);
				}
			}	
		}
		$article->IMAGE=$arr;
		$article->IMAGE_COUNT=count($arr);
		if($article->IMAGE_COUNT>0){
			$article->IMAGE_First=$arr[0];
		}else{
			$article->IMAGE_First=null;
		}
	}

	public static function getPicUrlBy($url,$width,$height,$cuttype=0){
		global $zbp;
		$flag=$zbp->Config('IMAGE')->on;
		$changeurl=$zbp->Config('IMAGE')->changeurl;
		if(isset($flag) && $flag==1){
      if(IMAGE::startWith($url,$zbp->host)){
          if(isset($changeurl) && $changeurl==1){
            return $zbp->host.'static/'.urlencode(IMAGE_urlsafe_b64encode($url)).'-'.$width.'-'.$height.'-'.$cuttype.'-a.jpg';
          }else{
            return $zbp->host.'zb_users/plugin/IMAGE/pic.php?src='.urlencode(IMAGE_urlsafe_b64encode($url)).'&width='.$width.'&height='.$height.'&cuttype='.$cuttype;
          }
      }elseif(!IMAGE::startWith($url,$zbp->host)){
        if($zbp->Config('IMAGE')->CacheExternalUrl){
            if(isset($changeurl) && $changeurl==1){
              return $zbp->host.'static/'.urlencode(IMAGE_urlsafe_b64encode($url)).'-'.$width.'-'.$height.'-'.$cuttype.'-a.jpg';
            }else{
              return $zbp->host.'zb_users/plugin/IMAGE/pic.php?src='.urlencode(IMAGE_urlsafe_b64encode($url)).'&width='.$width.'&height='.$height.'&cuttype='.$cuttype;
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
		$bean=new IMAGE();
		$bean->src=IMAGE_urlsafe_b64decode(urldecode(GetVars("src","GET")));
		$bean->encodesrc=GetVars("src","GET");
		//$bean->src=GetVars("src","GET");
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