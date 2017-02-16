<?php
function Nobird_Seo_Tools_Spider_ShowError($id,$text,$a,$b){
    global $zbp;
  if ($zbp->Config('Nobird_Spider')->UseSpider){
    if($text==$zbp->lang['error'][2]){
        $HttpStatus =404;
    }else{
        $HttpStatus =500;
    }

    //插入数据
  Nobird_Seo_Tools_Spider_InsertLog($HttpStatus);
}
}
function Nobird_Seo_Tools_Spider_InsertLog($status='200'){
	global $zbp;
	
	$arrayspider=array(
          'Baiduspider' => '百度',
          'Googlebot' => '谷歌',
          'Sosospider' => '搜搜',
          'YoudaoBot' => '有道',
          'bingbot' => '必应',
          'Sogou web spider' => '搜狗',
          'Yahoo! Slurp' => '雅虎',
          'Alexa' => 'Alexa',
          '360Spider' => '360'          
              );
	$agent="";
	$domain=GetVars('HTTP_HOST', 'SERVER');//$_SERVER['HTTP_HOST'];
	$url=GetVars('REQUEST_URI', 'SERVER');//$_SERVER['REQUEST_URI'];
	$ip=GetGuestIP();
	$dateline=time();
	$regex = '/Baiduspider|Googlebot|Sosospider|YoudaoBot|bingbot|Sogou web spider|Yahoo! Slurp|Alexa|360Spider/i';

  if (preg_match($regex, GetVars('HTTP_USER_AGENT', 'SERVER'),$match)){
    $agent = $arrayspider[$match[0]];
  }
		


	$url='http://'.$domain.$url;
	if($url&&$agent){
    $spider=new nobird_seo_tools_spider();
    $spider->spidername=$agent;
    $spider->spiderip=$ip;
    $spider->dateline=$dateline;
    $spider->url=$url;
    $spider->status=$status;
    //$spider->status=Nobird_check_url_exists($url);
   // $spider->status= GetVars('REDIRECT_STATUS', 'SERVER');//$_SERVER["REDIRECT_STATUS"];
    $spider->Save();
	

	}
}


function Nobird_check_url_exists($url) {
	$ajax = Network::Create();
	$ajax->open('GET', $url);
	$ajax->send();
	return ($ajax->status);
}



$table['Nobird_Spider_Table']='%pre%nobird_spider';
$datainfo['Nobird_Spider_Table']=array(
    'ID'=>array('t_ID','integer','',0),
    'spidername'=>array('t_spidername','string',200,''),
    'spiderip'=>array('t_spiderip','string',200,''),
    'dateline'=>array('t_dateline','integer','','0'),
    'url'=>array('t_url','string',255,''),
    'status'=>array('t_status','string',255,'1'),
    'Meta'=>array('t_meta','string','','')
);



class nobird_seo_tools_spider extends Base {
	function __construct()
	{
		global $zbp;
		parent::__construct($zbp->table['Nobird_Spider_Table'],$zbp->datainfo['Nobird_Spider_Table']);
	}

	public function __set($name, $value)
	{
		parent::__set($name, $value);
	}

	public function __get($name)
	{
		return parent::__get($name);
	}



	function Save(){
		global $zbp;
		return parent::Save();
	}
	
	function Del(){
		global $zbp;
		return parent::Del();
	}
}

if ($zbp->db->ExistTable($zbp->table['Nobird_Spider_Table']) == false) {
	$s=$zbp->db->sql->CreateTable($zbp->table['Nobird_Spider_Table'],$zbp->datainfo['Nobird_Spider_Table']);
	$zbp->db->QueryMulit($s);
}	


function Nobird_Spider_CreateTable(){
	global $zbp;
	if ($zbp->db->ExistTable($zbp->table['Nobird_Spider_Table']) == false) {
	$s=$zbp->db->sql->CreateTable($zbp->table['Nobird_Spider_Table'],$zbp->datainfo['Nobird_Spider_Table']);
	$zbp->db->QueryMulit($s);
}	
}

function Nobird_Spider_Uninstall(){
	global $zbp;
	if ($zbp->db->ExistTable($zbp->table['Nobird_Spider_Table']) == true) {
	$s=$zbp->db->sql->DelTable($zbp->table['Nobird_Spider_Table']);
	$zbp->db->QueryMulit($s);
	$zbp->DelConfig('Nobird_Spider');
}
}


function Nobird_Spider_Install(){
	global $zbp;
	Nobird_Spider_CreateTable();
	if(!$zbp->Config('Nobird_Spider')->HasKey('Version')) {
	$zbp->Config('Nobird_Spider')->Version = '1.0';
	$zbp->Config('Nobird_Spider')->UseSpider = 1;//默认启用

	$zbp->SaveConfig('Nobird_Spider');
	}
	
}
?>