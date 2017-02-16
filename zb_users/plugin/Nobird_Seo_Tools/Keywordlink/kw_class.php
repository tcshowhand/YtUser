<?php
  /*
   * 关键词匹配类
   * @author ylx <ylx123456@gmail.com>
   * @packet mipang
   * 使用实例
   * $str = "绿壳蛋鸡撒范德萨下一年，下一年1的洒落开房间卢卡斯地方军";
   * $key = new KeyReplace($str,array("xxxx"=>"sadf","下一年1"=>'http://baidu.com',"下一年"=>'google.com'));
   * echo $key->getResultText();
   * echo $key->getRuntime();
   * 来源 http://www.qaforcode.net/archives/506
   * 修改 Nobird, http://www.birdol.com
   */
function nobird_seo_tools_cmp($a, $b){
      if (mb_strlen($a) == mb_strlen($b)) {
 return 0;
      }
      return (mb_strlen($a) < mb_strlen($b)) ? 1 : -1;
    }
class Nobird_KeyReplace
{
  private $keys = array();
  private $text = "";
  private $runtime = 0;
  private $url = true;
  private $stopkeys = array();
  private $all = false;
  private $times = "1";
  /**
   * @access public    
   * @param string $text 指定被处理的文章
   * @param array $keys 指定字典词组array(key=>url,...) url可以是数组，如果是数组将随机替换其中的一个
   * @param array $stopkeys 指定停止词array(key,...) 这里面的词将不会被处理
   * @param boolean $url true 表示替换成链接否则只替换
   * @param boolean $all true 表示替换所有找到的词，否则只替换$this->times次
   */
  public function __construct($text='',$keys=array(),$url=true,$stopkeys=array(),$all=false,$times='1') {
    $this->keys = $keys;
    $this->text = $text;
    $this->url = $url;
    $this->stopkeys = $stopkeys;
    $this->all = $all;
    $this->times = $times;
  }

  /**
   * 获取处理好的文章
   * @access public    
   * @return string text
   */

  public function getResultText() {
    $start = microtime(true);
    $keys = $this->hits_keys();

    $keys_tmp = array_keys($keys);



    usort($keys_tmp,"nobird_seo_tools_cmp");

    foreach($keys_tmp as $key){
        if(strlen($key)<4){continue;}
      if(is_array($keys[$key])){
 $url = $keys[$key][rand(0,count($keys[$key])-1)];
      }else
 $url = $keys[$key];

      $this->text = $this->r_s($this->text,$key,$url);

    }
    $this->runtime = microtime(true)-$start;

    return $this->text;
  }
  /**
   * 获取处理时间
   * @access public    
   * @return float
   */
  public function getRuntime() {

    return '页面关键词匹配耗时'.$this->runtime.'秒';

  }

  /**
   * 设置关键词
   * @access public    
   * @param array $keys array(key=>url,...)
   */
  public function setKeys($keys) {

    $this->keys = $keys;

  }
  /**
   * 设置停止词
   * @access public    
   * @param array $keys array(key,...)
   */
  public function setStopKeys($keys) {

    $this->stopkeys = $keys;

  }
  /**
   * 设置文章
   * @access public    
   * @param string $text
   */
  public function setText($text) {

    $this->text = $text;

  }

  /**
   * 用来找到字符串里面命中的关键词
   * @access public
   * @return array $keys 返回匹配到的词array(key=>url,...)
   */
  public function hits_keys(){
    $ar = $this->keys;
    $ar = $ar?$ar:array();
    $result=array();
    $str = $this->text;
    foreach($ar as $k=>$url){
      $k = trim($k);
      if(!$k)
 continue;
      if(strpos($str,$k)!==false && !in_array($k,$this->stopkeys)){
 $result[$k] = $url;
      }
    }
    return $result?$result:array();
  }

  /**
   * 用来找到字符串里面命中的停止词
   * @access public
   * @return array $keys 返回匹配到的词array(key,...)
   */
  public function hits_stop_keys(){
    $ar = $this->stopkeys;
    $ar = $ar?$ar:array();
    $result=array();
    $str = $this->text;
    foreach($ar as $k){
      $k = trim($k);
      if(!$k)
 continue;
      if(strpos($str,$k)!==false && in_array($k,$this->stopkeys)){
 $result[] = $k;
      }
    }
    return $result?$result:array();
  }

  /**
   * 处理替换过程
   * @access private
   * @param string $text 被替换者
   * @param string $key 关键词
   * @param string $url 链接
   * @return string $text 处理好的文章
   */
  private function r_s($text,$key,$url){
    global $zbp;
    $tmp = $text;
    $stop_keys = $this->hits_stop_keys();
    $searcharray = $replacearray = $stopkeys = $tags = $a = $pre = array();

if($zbp->Config('Nobird_Keywordlink')->Keywordlink_CLASSNAME){
$classname=$zbp->Config('Nobird_Keywordlink')->Keywordlink_CLASSNAME;
}else{
$classname="keywordlink";
}

  $search= '/('.preg_quote($key).')/i';
  $replace = "<a title=\"$key\" href=\"$url\" target=\"_blank\" class=\"".$classname."\">$key</a>";
			/*
				$tmp = preg_replace("/(<script\s+.*?>.*?<\/script>)|(<a\s+.*?>.*?<\/a>)|(<img\s+.*?[\/]?>)|(<pre\s+.*?>.*?<\/pre>)|(<[^>]+>)/ies", "nbseo_base64_transform('encode', '<n_b_s_e_o>', '\\1\\2\\3\\4\\5', '</n_b_s_e_o>')", $tmp);
				$tmp = preg_replace($search, $replace, $tmp, $this->all?-1:$this->times);
				$tmp = preg_replace("/<n_b_s_e_o>(.*?)<\/n_b_s_e_o>/ies", "nbseo_base64_transform('decode', '', '\\1', '')", $tmp);
*/      
        if($zbp->Config('Nobird_Keywordlink')->protect_script){
        $tmp = preg_replace_callback("/(<script\s+.*?>.*?<\/script>)/is", "nbseo_base64_encode", $tmp);
        $tmp = preg_replace_callback("/(<script>.*?<\/script>)/is", "nbseo_base64_encode", $tmp);
        }
        $tmp = preg_replace_callback("/(<a\s+.*?>.*?<\/a>)/is", "nbseo_base64_encode", $tmp);
        $tmp = preg_replace_callback("/(<img\s+.*?[\/]?>)/is", "nbseo_base64_encode", $tmp);
        
        if($zbp->Config('Nobird_Keywordlink')->protect_pre){
          $tmp = preg_replace_callback("/(<pre\s+.*?>.*?<\/pre>)/is", "nbseo_base64_encode", $tmp);
        }
        if($zbp->Config('Nobird_Keywordlink')->protect_vars){
        $tmp = preg_replace_callback("/(<[^>]+>)/is", "nbseo_base64_encode", $tmp); 
        }
      
      //  var_dump(count($GLOBALS['nobird_seo_tools_array']));die();
				$tmp = preg_replace($search, $replace, $tmp, $this->all?-1:$this->times);
				$tmp = preg_replace_callback("/\[n_b_s_e_o\](.*?)\[\/n_b_s_e_o\]/is", "nbseo_base64_decode", $tmp);
    
    return $tmp;
  }
}

$nobird_seo_tools_array = array();


function nbseo_base64_encode($matches){
return nbseo_base64_transform('encode', '[n_b_s_e_o]', $matches[1], '[/n_b_s_e_o]');
}
function nbseo_base64_decode($matches){
return nbseo_base64_transform('decode', '', $matches[1], '');
}

function nbseo_base64_transform($type, $prefix, $string, $suffix) {
		global $nobird_seo_tools_array;
		if($type == 'encode') {
			$nobird_seo_tools_array[] = base64_encode(str_replace("\\\"", "\"", $string));
			return $prefix.(count($nobird_seo_tools_array) - 1).$suffix;
		} elseif($type == 'decode') {
			return $prefix.base64_decode($nobird_seo_tools_array[$string]).$suffix;
		}
	}
