<?php
class nbsmtag extends nbseo_batch {

	/**
	 * Build queue
	 * @return null
	 */
	public function get_queue() {
		
		global $zbp;

$count=GetValueInArrayByCurrent($zbp->db->Query('SELECT COUNT(*) AS num FROM ' . $GLOBALS['table']['Tag']), 'num');

	$i=0;
	$j=$count;
	$j=ceil($j/$zbp->Config('Nobird_Sitemap')->BigDataPer);

	$zbp->Config('Nobird_Sitemap')->TagLimit = '0';
	$zbp->SaveConfig('Nobird_Sitemap');
	
for ($i=$j;$i>0;){
			$this->set_queue('buildsitemap2', $i);
      $i--;
}


}
	
	/**
	 * Check BOM
	 * @param string $param 
	 * @return null
	 */
	public function buildsitemap2($param) {
	global $zbp;

if (!$zbp->CheckPlugin('Pad')) {
$xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><?xml-stylesheet type="text/xsl" href="'.$zbp->host.'zb_users/plugin/Nobird_Seo_Tools/Sitemap/sitemap.xsl"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:mobile="http://www.google.com/schemas/sitemap-mobile/1.0" />');
}else{
$xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><?xml-stylesheet type="text/xsl" href="'.$zbp->host.'zb_users/plugin/Nobird_Seo_Tools/Sitemap/sitemap.xsl"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" />');

}



    $pagebar = new Pagebar($zbp->host.'sitemap_tag_{%page%}.xml');
	$pagebar->PageCount = $zbp->Config('Nobird_Sitemap')->BigDataPer;
	$pagebar->PageNow = $param;
	$pagebar->PageBarCount = 10;
	$pagebar->UrlRule->Rules['{%page%}'] = $param;
	

    $where=array();
	$select = '*';
	$order = array('tag_ID' => 'ASC');
	$limit = array(($pagebar->PageNow - 1) * $pagebar->PageCount, $pagebar->PageCount);
	$option = array('pagebar' => $pagebar);
	
	$array = $zbp->GetTagList(
		$select, 
		$where,
		$order,
		$limit,
		$option,
		true
	);


$boolok=false;

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
if(	$zbp->Config('Nobird_Sitemap')->TagLimit < $value->ID){
	$zbp->Config('Nobird_Sitemap')->TagLimit = $value->ID;
	$zbp->SaveConfig('Nobird_Sitemap');
}
	if($param==1){
		$boolok=true;
	}	
	}
	
file_put_contents($zbp->path . 'sitemap_tag_'.$param.'.xml',$xml->asXML());

$filename = ZBP_PATH.'sitemap.xml';
$filecontent = file_get_contents($filename);
$newxml = simplexml_load_string($filecontent);        //读取xml文件

$sitemap = $newxml->addChild('sitemap');
$sitemap->addChild('loc', $zbp->host.'sitemap_tag_'.$param.'.xml');
$sitemap->addChild('lastmod',date('c',time()));	
file_put_contents($filename,$newxml->asXML());


		
			$this->output('success', '队列:'.$param . ' - 创建完成!');
if($boolok){
			$this->output('success', '标签sitemap - 创建完成!');	
}
			$this->output('success', '跳转到下一个任务：<script language="javascript" type="text/javascript">
           window.location.href="'.$zbp->host.'zb_users/plugin/Nobird_Seo_Tools/Batch/nbseo_batch_main.php?module=nbsmcoustom";
    </script>');
}


	
	
	

	

	
}
