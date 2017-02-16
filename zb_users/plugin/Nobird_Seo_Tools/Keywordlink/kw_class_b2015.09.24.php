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
class Nobird_KeyReplace
{
  private $keys = array();
  private $text = "";
  private $runtime = 0;
  private $url = true;
  private $stopkeys = array();
  private $all = false;
  /**
   * @access public    
   * @param string $text 指定被处理的文章
   * @param array $keys 指定字典词组array(key=>url,...) url可以是数组，如果是数组将随机替换其中的一个
   * @param array $stopkeys 指定停止词array(key,...) 这里面的词将不会被处理
   * @param boolean $url true 表示替换成链接否则只替换
   * @param boolean $all true 表示替换所有找到的词，否则只替换第一次
   */
  public function __construct($text='',$keys=array(),$url=true,$stopkeys=array(),$all=false) {
    $this->keys = $keys;
    $this->text = $text;
    $this->url = $url;
    $this->stopkeys = $stopkeys;
    $this->all = $all;
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

    function cmp($a, $b){
      if (mb_strlen($a) == mb_strlen($b)) {
 return 0;
      }
      return (mb_strlen($a) < mb_strlen($b)) ? 1 : -1;
    }

    usort($keys_tmp,"cmp");

    foreach($keys_tmp as $key){

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

    $tmp = $text;

    $stop_keys = $this->hits_stop_keys();

    $stopkeys = $tags = $a = $pre = array();
##########pre标签保护
    if(preg_match_all("#<pre[^>]+>[^<]*</pre[^>]*>#su",$tmp,$m)){
      $pre=$m[0];
//var_dump($m[0]);
      foreach($m[0] as $k=>$z){
 $z = preg_replace("#\##s","\#",$z);
 $tmp = preg_replace("#<pre[^>]+>[^<]*</pre[^>]*>#su","[_pre".$k."_]",$tmp,1);
#echo $tmp;
      }

    };
#########    
    
        if(preg_match_all("#<a[^>]+>[^<]*</a[^>]*>#su",$tmp,$m)){
    //     if(preg_match_all("#(?i)<a[^>]*href=([\"\"'])?[^\"\"'][^>]*>.*?</a>#su",$tmp,$m)){

      $a=$m[0];

      foreach($m[0] as $k=>$z){
 $z = preg_replace("#\##s","\#",$z);

 $tmp = preg_replace('#'.$z.'#s',"[_a".$k."_]",$tmp,1);
      }

    };

    if(preg_match_all("#<[^>]+>#s",$tmp,$m)){
      $tags = $m[0];
      foreach($m[0] as $k=>$z){
 $z = preg_replace("#\##s","\#",$z);
 $tmp = preg_replace('#'.$z.'#s',"[_tag".$k."_]",$tmp,1);
      }
    }
    if(!empty($stop_keys)){
      if(preg_match_all("#".implode("|",$stop_keys)."#s",$tmp,$m)){
 $stopkeys = $m[0];
 foreach($m[0] as $k=>$z){
   $z = preg_replace("#\##s","\#",$z);
   $tmp = preg_replace('#'.$z.'#s',"[_s".$k."_]",$tmp,1);
 }
      }
    }
    $key1 = preg_replace("#([\#\(\)\[\]\*])#s","\\\\$1",$key);

    if($this->url)
      $tmp = preg_replace("#(?!\[_s|\[_a|\[_|\[_t|\[_ta|\[_tag)".$key1."(?!ag\d+_\]|g\d+_\]|\d+_\]|s\d+_\]|_\])#us",'<a href="'.$url.'" title="'.$key.'">'.$key.'</a>',$tmp,$this->all?-1:1);
	#		$tmp=preg_replace("/#(".$key1.")(?=[^<>]*<)/iU",'<a href="'.$url.'">${1}</a>',$tmp,1);

    else
      $tmp = preg_replace("#(?!\[_s|\[_a|\[_|\[_t|\[_ta|\[_tag)".$key1."(?!ag\d+_\]|g\d+_\]|\d+_\]|s\d+_\]|_\])#us",$url,$tmp,$this->all?-1:1);

    if(!empty($a)){

      foreach($a as $n=>$at){

 $tmp = str_replace("[_a".$n."_]",$at,$tmp);

      }    

    }   
#######pre标签还原
    if(!empty($pre)){

      foreach($pre as $n=>$at){

 $tmp = str_replace("[_pre".$n."_]",$at,$tmp);

      }    

    }   
#######    
    
    if(!empty($tags)){

      foreach($tags as $n=>$at){

 $tmp = str_replace("[_tag".$n."_]",$at,$tmp);

      }    

    }   
    if(!empty($stopkeys)){

      foreach($stopkeys as $n=>$at){

 $tmp = str_replace("[_s".$n."_]",$at,$tmp);

      }    

    }   
    return $tmp;
  }
}
