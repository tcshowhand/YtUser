<?php

$table['nobird_seo_tools_sitemap_coustom']= '%pre%nobird_seo_tools_sitemap_coustom';
$datainfo['nobird_seo_tools_sitemap_coustom'] = array(
	'ID'=>array('Sitemap_ID','integer','',0),
	'Title'=>array('Sitemap_Title','string',255,''),
	'Url'=>array('Sitemap_Url','string',255,''),
	'Lastmod'=>array('Sitemap_Lastmod','integer','',0),
	'Changefreq'=>array('Sitemap_Changefreq','string',255,''),
	'Priority'=>array('Sitemap_Priority','string',255,''),
    'AppID'=>array('Sitemap_AppID','string',255,''),//网址来源，填写插件ID，默认Nobird_Seo_Tools
    'AddTime'=>array('Sitemap_AddTime','integer','',0),
    'Meta'=>array('Sitemap_Meta','string','','')
);



function Nobird_Seo_Tools_Edit_Response3() {
	?>
<div id="Nobird_Seo_Tools_PingTool" class="editmod">
  <label for="edtNobird_Seo_Tools_PingTool" class="editinputname">Ping:</label>
  <input id="edtNobird_Seo_Tools_PingTool" name="Nobird_Seo_Tools_PingTool" type="text" value="1" class="checkbox"/>
</div>
<?php
}




class nobird_seo_tools_sitemap_coustom extends Base {
	function __construct()
	{
		global $zbp;
		parent::__construct($zbp->table['nobird_seo_tools_sitemap_coustom'],$zbp->datainfo['nobird_seo_tools_sitemap_coustom']);
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




function Nobird_Seo_Tools_Baidu_JS(&$template){
        global $zbp;
	$article = $template->GetTags('article');

if($zbp->Config('Nobird_Sitemap')->Use_Baidu_JS && $article->Status=='0'){
  $zbp->footer.='<script>
(function(){
    var bp = document.createElement("script");
    var curProtocol = window.location.protocol.split(":")[0];
    if (curProtocol === "https") {
        bp.src = "https://zz.bdstatic.com/linksubmit/push.js";        
    }
    else {
        bp.src = "http://push.zhanzhang.baidu.com/push.js";
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
</script>';
  }
}



function Nobird_Seo_Tools_PingCenter($url, $article_url) {
	global $zbp;

	$s = '<?xml version="1.0"?>
	<methodCall><methodName>weblogUpdates.ping</methodName>
	<params>
	    <param>
	        <value>' . trim($article_url) . '</value>
	    </param>
	</params>
	</methodCall>';
$s='<?xml version="1.0" encoding="UTF-8"?>
<methodCall>
    <methodName>weblogUpdates.extendedPing</methodName>
    <params>
        <param>
            <value><string>'.$zbp->name.'</string></value>
        </param>
        <param>
            <value><string>'.$zbp->host.'</string></value>
        </param>
        <param>
            <value><string>' . trim($article_url) . '</string></value>
        </param>
        <param>
            <value><string>'.$zbp->host.'feed.php</string></value>
        </param>
    </params>
</methodCall>';
	$ajax = Network::Create();
	if (!$ajax) {
		throw new Exception('主机没有开启网络功能');
	}

	$ajax->open('POST', $url);
	$ajax->setRequestHeader('Content-Type', 'text/xml');
	$ajax->send($s);

//var_dump($ajax);die();

//	echo $url;

	$ajax = null;
	return;
}


function Nobird_Seo_Tools_PostToBaidu($article){
        global $zbp;


	if (GetVars('Nobird_Seo_Tools_PingTool', 'POST') != '1') {
		return;
	}

	global $zbp;

	$ping_data = $zbp->Config('Nobird_Seo_Tools')->pingtool_strData;
	if($ping_data){
	$ping_array = explode("\n", $ping_data);
    	for ($i = 0; $i < count($ping_array); $i++) {
    		Nobird_Seo_Tools_PingCenter(trim($ping_array[$i]), $article->Url);
    		echo $article->Url . "\n";
    	}
    }




if($zbp->Config('Nobird_Sitemap')->Use_SitemapPost&&!$article->Metas->Nobird_Seo_Tools_IsPing&&$article->Status=='0'){    


            $data = $article->Url;
     
        $pingurl=$zbp->Config('Nobird_Sitemap')->SitemapPostKey;//你的接口地址

	$ajax = Network::Create();
	if(!$ajax) throw new Exception('主机没有开启访问外部网络功能，无法开启实时推送！请联系主机服务商 或检查服务器配置！！');

	if($data){//POST
		$ajax->open('POST',$pingurl);
		$ajax->enableGzip();
		$ajax->setTimeOuts(0,0,0,0);
		$ajax->setRequestHeader('User-Agent','Nobird_Seo_Tools');
		$ajax->setRequestHeader('Content-Type','text/plain',true);
		$ajax->setRequestHeader('Cookie','');
		$ajax->send($data);
	}        
	//echo $data.$ajax->responseText;die();
	$response=json_decode($ajax->responseText);

if($ajax->status==200){
				//$zbp->SetHint('good','成功推送至百度 '.$response->success.' 条,今日剩余推送条数:'.$response->remain.'。');	
				$zbp->SetHint('good','成功推送至百度！');	
				$article->Metas->Nobird_Seo_Tools_IsPing=1;
				$article->Save();
		}else{
$arrayerrcode=array(
                    'site error'=>'站点未在站长平台验证',
                    'empty content'=>'post内容为空',
                    'only 2000 urls are allowed once'=>'每次最多只能提交2000条链接',
                    'over quota'=>'超过每日配额了，超配额后再提交都是无效的',
                    'token is not valid'=>'token错误',
                    'not found'=>'接口地址填写错误',
                    'internal error, please try later'=>'服务器偶然异常，通常重试就会成功'
                    );	
if(isset($arrayerrcode[$response->message])){
				$zbp->SetHint('bad','推送至百度发生错误，错误代码：'.$response->error.' 错误信息:'.$arrayerrcode[$response->message].'。');	

}else{
				$zbp->SetHint('bad','推送至百度发生错误，错误代码：'.$response->error.' 错误信息:'.$response->message.'。');	
}                    	
		}
		
		
}
}

function Nobird_Seo_Tools_PostToBaiduOld($article){
        global $zbp;
if($zbp->Config('Nobird_Sitemap')->Use_SitemapPost){        
        $lastmod=date('Y-m-d',$article->PostTime);//baidu sitemap post ,date Y-m-d, not date c
        $data='<?xml version="1.0" encoding="UTF-8"?>'."\r\n";
        $data.='   <urlset>'."\r\n";
        $data.='       <url>'."\r\n";
        $data.='           <loc><![CDATA['.$article->Url.']]></loc>'."\r\n";
        $data.='           <lastmod>'.$lastmod.'</lastmod>'."\r\n";
        $data.='           <changefreq>monthly</changefreq>'."\r\n";
        $data.='           <priority>0.5</priority>'."\r\n";
        $data.='       </url>'."\r\n";
        $data.='   </urlset>'."\r\n";
     
        $pingurl=$zbp->Config('Nobird_Sitemap')->SitemapPostKey;//你的接口地址

	$ajax = Network::Create();
	if(!$ajax) throw new Exception('主机没有开启访问外部网络功能，无法开启实时推送！请联系主机服务商 或检查服务器配置！！');

	if($data){//POST
		$ajax->open('POST',$pingurl);
		$ajax->enableGzip();
		$ajax->setTimeOuts(0,0,0,0);
		$ajax->setRequestHeader('User-Agent','Nobird_Seo_Tools');
		$ajax->setRequestHeader('Cookie','');
		$ajax->send($data);
	}        
	//echo $data;
		
		/*
		$responsexmlstr=$ajax->responseText;
		$responsexml = new SimpleXMLElement($responsexmlstr);
		$responsecode = $responsexml->params->param->value->int;
		echo $responsecode;die();

	
		<?xml version="1.0" encoding="UTF-8"?>
<methodResponse>
    <params>
        <param>
            <value>
                <int>200</int>
            </value>
        </param>
    </params>
</methodResponse>
		*/



//	if($responsecode=="200"){
//echo '成功';die();	
//	}
}
}


function Nobird_Seo_Tools_Sitemap($article){
	global $zbp;
if($article->Status=='0'){

if(!$zbp->Config('Nobird_Sitemap')->IndexPercent){
	$zbp->Config('Nobird_Sitemap')->IndexPercent = '1';
	$zbp->Config('Nobird_Sitemap')->CategoryPercent = '0.8';
	$zbp->Config('Nobird_Sitemap')->TagPercent = '0.8';
	$zbp->Config('Nobird_Sitemap')->ArticlePercent = '0.5';
	$zbp->Config('Nobird_Sitemap')->PagePercent = '0.6';
}

if (!$zbp->CheckPlugin('Pad')) {
$xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><?xml-stylesheet type="text/xsl" href="'.$zbp->host.'zb_users/plugin/Nobird_Seo_Tools/Sitemap/sitemap.xsl"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:mobile="http://www.google.com/schemas/sitemap-mobile/1.0" />');
}else{
$xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><?xml-stylesheet type="text/xsl" href="'.$zbp->host.'zb_users/plugin/Nobird_Seo_Tools/Sitemap/sitemap.xsl"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" />');

}

$url = $xml->addChild('url');
$url->addChild('loc', $zbp->host);
if (!$zbp->CheckPlugin('Pad')) {
  $mobileurl = $url->addChild('mobile:mobile');
  $mobileurl->addAttribute('type', 'pc,mobile');
}

$url->addChild('lastmod',date('c'));	
$url->addChild('changefreq', 'daily');
$url->addChild('priority', $zbp->Config('Nobird_Sitemap')->IndexPercent);
$where=array();
if($zbp->Config('Nobird_Sitemap')->Use_BigData){
$where[]=array('>','cate_ID',$zbp->Config('Nobird_Sitemap')->CateLimit);    
}
$array=$zbp->GetCategoryList(null,$where,array('cate_ID'=>'DESC'),null,null);
	foreach ($array as $c) {
		$url = $xml->addChild('url');
		$url->addChild('loc', $c->Url);
    if (!$zbp->CheckPlugin('Pad')) {
      $mobileurl = $url->addChild('mobile:mobile');
      $mobileurl->addAttribute('type', 'pc,mobile');
    }

		$url->addChild('lastmod',date('c'));	
        $url->addChild('changefreq', 'weekly');
        $url->addChild('priority', $zbp->Config('Nobird_Sitemap')->CategoryPercent);

	}

$where=array();
if($zbp->Config('Nobird_Sitemap')->Use_BigData){
$where[]=array('>','log_ID',$zbp->Config('Nobird_Sitemap')->ArticleLimit);    
}
$where[]=array('=','log_Status',0);
	$array=$zbp->GetArticleList(
		null,
		$where,
		array('log_PostTime' => 'DESC'),
		null,
		null,
		false
		);

	foreach ($array as $key => $value) {
		$url = $xml->addChild('url');
		$url->addChild('loc', $value->Url);
    if (!$zbp->CheckPlugin('Pad')) {
      $mobileurl = $url->addChild('mobile:mobile');
      $mobileurl->addAttribute('type', 'pc,mobile');
    }
		$url->addChild('lastmod',date('c',$value->PostTime));	
		$url->addChild('changefreq', 'monthly');
        $url->addChild('priority', $zbp->Config('Nobird_Sitemap')->ArticlePercent);

		}

$where=array();
if($zbp->Config('Nobird_Sitemap')->Use_BigData){
$where[]=array('>','log_ID',$zbp->Config('Nobird_Sitemap')->PageLimit);    
}
$where[]=array('=','log_Status',0);
	$array=$zbp->GetPageList(
		null,
		$where,
		array('log_PostTime' => 'DESC'),
		null,
		null
		);

	foreach ($array as $key => $value) {
		$url = $xml->addChild('url');
		$url->addChild('loc', $value->Url);
    if (!$zbp->CheckPlugin('Pad')) {
      $mobileurl = $url->addChild('mobile:mobile');
      $mobileurl->addAttribute('type', 'pc,mobile');
    }
		$url->addChild('lastmod',date('c',$value->PostTime));	
		$url->addChild('changefreq', 'monthly');
        $url->addChild('priority', $zbp->Config('Nobird_Sitemap')->PagePercent);

	}


$where=array();
if($zbp->Config('Nobird_Sitemap')->Use_BigData){
$where[]=array('>','tag_ID',$zbp->Config('Nobird_Sitemap')->TagLimit);    
}
	$array=$zbp->GetTagList('*', $where, array('tag_ID' => 'DESC'), null, null);

	foreach ($array as $key => $value) {
		$url = $xml->addChild('url');
		$url->addChild('loc', $value->Url);
    if (!$zbp->CheckPlugin('Pad')) {
      $mobileurl = $url->addChild('mobile:mobile');
      $mobileurl->addAttribute('type', 'pc,mobile');
    }
		$url->addChild('lastmod',date('c'));	
		$url->addChild('changefreq', 'weekly');
        $url->addChild('priority', $zbp->Config('Nobird_Sitemap')->TagPercent);

	}


if($zbp->Config('Nobird_Sitemap')->Use_BigData){
file_put_contents($zbp->path . 'sitemap_new.xml',$xml->asXML());
}else{
file_put_contents($zbp->path . 'sitemap.xml',$xml->asXML());
}
}
}

function Nobird_Sitemap_Install(){
	global $zbp;
	if(!$zbp->Config('Nobird_Sitemap')->HasKey('Version')) {
	$zbp->Config('Nobird_Sitemap')->Version = '1.2';
	$zbp->Config('Nobird_Sitemap')->Use_SitemapPost = false;
	$zbp->Config('Nobird_Sitemap')->SitemapPostKey = '请自行前往百度站长工具获取';
	$zbp->Config('Nobird_Sitemap')->Use_BigData = true;
	$zbp->Config('Nobird_Sitemap')->Use_Baidu_JS = true;
	$zbp->Config('Nobird_Sitemap')->BigDataPer = 1000;

	
	$zbp->SaveConfig('Nobird_Sitemap');
	}

		$s=$zbp->db->sql->CreateTable($zbp->table['nobird_seo_tools_sitemap_coustom'],$zbp->datainfo['nobird_seo_tools_sitemap_coustom']);
		$zbp->db->QueryMulit($s);

	
}



function Nobird_Sitemap_Uninstall(){
	global $zbp;
	$zbp->DelConfig('Nobird_Sitemap');
}



?>