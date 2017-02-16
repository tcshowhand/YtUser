<?php

$table['Nobird_Keywords_table']= '%pre%keywordlinks';
$datainfo['Nobird_Keywords_table'] = array(
	'ID'=>array('KeyWord_ID','integer','',0),
	'Type'=>array('KeyWord_Type','integer','',0),
	'Title'=>array('KeyWord_Title','string',255,''),
	'Url'=>array('KeyWord_Url','string',255,''),
	'Des'=>array('KeyWord_Des','string',255,''),
	'Order'=>array('KeyWord_Order','integer','',99),
	'Code'=>array('KeyWord_Code','string',255,''),
	'IsUsed'=>array('KeyWord_IsUsed','boolean','',true),
	'Intro'=>array('KeyWord_Intro','string',255,''),
	'Addtime'=>array('KeyWord_Addtime','integer','',0),
	'Endtime'=>array('KeyWord_Endtime','integer','',0),
  'Meta'=>array('KeyWord_Meta','string','','')
);


class nobird_seo_tools_keyword extends Base {
	function __construct()
	{
		global $zbp;
		parent::__construct($zbp->table['Nobird_Keywords_table'],$zbp->datainfo['Nobird_Keywords_table']);
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





function Nobird_KeyWordLinks_GetKeyWord(){
	global $zbp,$str;
	$where = array(array('=','KeyWord_Type','0'),array('=','KeyWord_IsUsed','1'));
	$order = array('KeyWord_IsUsed'=>'DESC','KeyWord_ID'=>'ASC');
	$sql= $zbp->db->sql->Select($zbp->table['Nobird_Keywords_table'],'*',$where,$order,null,null);
	$array=$zbp->GetListType('nobird_seo_tools_keyword',$sql);

    $result=array();
    foreach($array as $key=>$value){
        $result[$value->Title] = $value->Url;
    }

	return $result;
}

function Nobird_KeyWordLinks_GetTagsKeyWord(){
	global $zbp;
	$num=	$zbp->Config('Nobird_Keywordlink')->Keywordlink_Num;
	if(!$num){$num=100;}
	$array = $zbp->GetTagList('','',array('tag_Count'=>'DESC'),array($num),'');
	$result=array();
	foreach($array as $key=>$value){
		$result[$value->Name] = $value->Url;
	}
	return $result;
}

function Nobird_KeyWordLinks_CreateTable(){
	global $zbp;
	if($zbp->db->ExistTable($zbp->table['Nobird_Keywords_table'])==false){
		$s=$zbp->db->sql->CreateTable($zbp->table['Nobird_Keywords_table'],$zbp->datainfo['Nobird_Keywords_table']);
		$zbp->db->QueryMulit($s);
	}
}


	if($zbp->db->ExistTable($zbp->table['Nobird_Keywords_table'])==false){
		$s=$zbp->db->sql->CreateTable($zbp->table['Nobird_Keywords_table'],$zbp->datainfo['Nobird_Keywords_table']);
		$zbp->db->QueryMulit($s);
	}



function Nobird_KeyWordLinks_Uninstall(){
	global $zbp;
	$s=$zbp->db->sql->DelTable($zbp->table['Nobird_Keywords_table']);
	$zbp->db->QueryMulit($s);
	$zbp->DelConfig('Nobird_Keywordlink');

}



function   Nobird_Seo_Tools_kwlink(&$template){
	global $zbp;
if($zbp->Config('Nobird_Keywordlink')->Keywordlink_UseCoustomKeys||$zbp->Config('Nobird_Keywordlink')->Keywordlink_UseTags){	
if($zbp->Config('Nobird_Keywordlink')->Keywordlink_UseCSS){
	$zbp->header.="\r\n".'<style>a.'.$zbp->Config('Nobird_Keywordlink')->Keywordlink_CLASSNAME.'{color:'.$zbp->Config('Nobird_Keywordlink')->Keywordlink_LinkColor.' !important;}</style>'."\r\n";
}	
	$article = $template->GetTags('article');
	if($article->ID==$zbp->Config('Nobird_Photo')->page_id){return true;}

	
	$str = $article->Content;
	#$key = new KeyReplace($str,array("鸟"=>"www.baidu.com","鸟儿"=>'http://birdol.com',"鸟儿博客"=>'google.com'));
	#$article->Content = $key->getResultText(); 
	
	$array_last = array();
	if($zbp->Config('Nobird_Keywordlink')->Keywordlink_UseCoustomKeys){
	    $array_last = Nobird_KeyWordLinks_GetKeyWord();
	}
	//var_dump($array_last);die();
	if ($zbp->Config('Nobird_Keywordlink')->Keywordlink_UseTags){
    $array2=Nobird_KeyWordLinks_GetTagsKeyWord();
    $array_content = array_merge($array2, $array_last);  
	}else{
    $array_content=$array_last;
	}
	//var_dump($array_content);die();

	if($zbp->Config('Nobird_Keywordlink')->Keywordlink_Times){
    $times=$zbp->Config('Nobird_Keywordlink')->Keywordlink_Times;
	}else{
    $times=1;
	}
	$key = new Nobird_KeyReplace($str,$array_content,true,array(),false,$times);
	$article->Content = $key->getResultText().'<!--'.$key->getRuntime().'-->'; 
}
}

function Nobird_Keywordlink_Install(){
	global $zbp;
	if(!$zbp->Config('Nobird_Keywordlink')->HasKey('Version')) {
	$zbp->Config('Nobird_Keywordlink')->Version = '1.0';
	$zbp->Config('Nobird_Keywordlink')->Keywordlink_UseTags = true;//默认启用Tag关键字链接
	$zbp->Config('Nobird_Keywordlink')->Keywordlink_UseCoustomKeys = true;
	$zbp->Config('Nobird_Keywordlink')->Keywordlink_Times = '1';//单个关键词在某一篇文章内被替换次数
	$zbp->Config('Nobird_Keywordlink')->Keywordlink_Num='100';//替换前多少个Tag 按使用次数排队
	$zbp->Config('Nobird_Keywordlink')->Keywordlink_CLASSNAME="keywordlink";//替换前多少个Tag 按使用次数排队
	$zbp->Config('Nobird_Keywordlink')->Keywordlink_UseCSS=false;
	$zbp->Config('Nobird_Keywordlink')->Keywordlink_LinkColor="#ff0000";

	$zbp->Config('Nobird_Keywordlink')->protect_pre = 1;//保护pre标签
	$zbp->Config('Nobird_Keywordlink')->protect_script = 1;//保护script标签
	$zbp->Config('Nobird_Keywordlink')->protect_vars = 1;//保护普通html标签

	$zbp->SaveConfig('Nobird_Keywordlink');
	}
	
}



?>