<?php
class nbsmarticle extends nbseo_batch {

	/**
	 * Build queue
	 * @return null
	 */
	public function get_queue() {
		
		global $zbp;


$count=GetValueInArrayByCurrent($zbp->db->Query('SELECT COUNT(*) AS num FROM ' . $GLOBALS['table']['Post'] . ' WHERE log_Type=0'), 'num');

	$i=0;
	$j=$count;
	$j=ceil($j/$zbp->Config('Nobird_Sitemap')->BigDataPer);




$xmlhold = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><?xml-stylesheet type="text/xsl" href="'.$zbp->host.'zb_users/plugin/Nobird_Seo_Tools/Sitemap/sitemap.xsl"?><sitemapindex />');
$xmlhold->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');


$sitemap = $xmlhold->addChild('sitemap');
$sitemap->addChild('loc', $zbp->host.'sitemap_new.xml');
$sitemap->addChild('lastmod',date('c',time()));	

file_put_contents(ZBP_PATH.'sitemap.xml',$xmlhold->asXML());	
	
	$zbp->Config('Nobird_Sitemap')->ArticleLimit = '0';
	$zbp->SaveConfig('Nobird_Sitemap');
	
for ($i=$j;$i>0;){
			$this->set_queue('buildsitemap2', $i);
      $i--;
}

}



	public function buildsitemap2($param) {
	global $zbp;


    $pagebar = new Pagebar($zbp->host.'sitemap_article_{%page%}.xml');
	$pagebar->PageCount = $zbp->Config('Nobird_Sitemap')->BigDataPer;
	$pagebar->PageNow = $param;
	$pagebar->PageBarCount = 10;
	$pagebar->UrlRule->Rules['{%page%}'] = $param;
	

    $where=array();
    $where[]=array('=','log_Status',0);
	$select = '*';
	$order = array('log_ID' => 'ASC');
	$limit = array(($pagebar->PageNow - 1) * $pagebar->PageCount, $pagebar->PageCount);
	$option = array('pagebar' => $pagebar);
	
	$array = $zbp->GetArticleList(
		$select, 
		$where,
		$order,
		$limit,
		$option,
		true
	);


		
if (!$zbp->CheckPlugin('Pad')) {
$xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><?xml-stylesheet type="text/xsl" href="'.$zbp->host.'zb_users/plugin/Nobird_Seo_Tools/Sitemap/sitemap.xsl"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:mobile="http://www.google.com/schemas/sitemap-mobile/1.0" />');
}else{
$xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><?xml-stylesheet type="text/xsl" href="'.$zbp->host.'zb_users/plugin/Nobird_Seo_Tools/Sitemap/sitemap.xsl"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" />');

}
$boolok=false;
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

if($zbp->Config('Nobird_Sitemap')->ArticleLimit < $value->ID){
	$zbp->Config('Nobird_Sitemap')->ArticleLimit = $value->ID;
	$zbp->SaveConfig('Nobird_Sitemap');
}
	if(1==$param){
		$boolok=true;
	} 
	$lasttime=$value->PostTime;
		}
file_put_contents($zbp->path . 'sitemap_article_'.$param.'.xml',$xml->asXML());

$filename = ZBP_PATH.'sitemap.xml';
$filecontent = file_get_contents($filename);
$newxml = simplexml_load_string($filecontent);        //读取xml文件

$sitemap = $newxml->addChild('sitemap');
$sitemap->addChild('loc', $zbp->host.'sitemap_article_'.$param.'.xml');
$sitemap->addChild('lastmod',date('c',$lasttime));	
file_put_contents($filename,$newxml->asXML());

		
			$this->output('success', '队列:'.$param . ' - 创建完成!');
if($boolok){
			$this->output('success', '文章sitemap - 创建完成!');

			$this->output('success', '跳转到下一个任务：<script language="javascript" type="text/javascript">
           window.location.href="'.$zbp->host.'zb_users/plugin/Nobird_Seo_Tools/Batch/nbseo_batch_main.php?module=nbsmcate";
    </script>');
}
	}

	

	

	
}
