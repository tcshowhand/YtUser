<?php
class nbsmcate extends nbseo_batch {

	/**
	 * Build queue
	 * @return null
	 */
	public function get_queue() {
		
		global $zbp;
	$sql = $zbp->db->sql->Select(
		$zbp->table['Category'],
		array("MIN(cate_ID)","MAX(cate_ID)"),
		null,
		array('cate_ID'=>'DESC'),
		null,
		null
	);
	$array = $zbp->db->Query($sql);
	
	$minid=$array[0]["MIN(cate_ID)"];
	$maxid=$array[0]["MAX(cate_ID)"];
	$i=0;$j=1;
for ($i=$minid;$i<=$maxid;){
			$this->set_queue('buildsitemap', $i.'|'.$j.'|'.$maxid);
      $i=$i+$zbp->Config('Nobird_Sitemap')->BigDataPer;
      $j++;

}
	}
	
	/**
	 * Check BOM
	 * @param string $param 
	 * @return null
	 */
	public function buildsitemap($param) {
	global $zbp;

$array=explode('|',$param); 
$param=$array[0];
$j=$array[1];		
$maxid=$array[2];		
if (!$zbp->CheckPlugin('Pad')) {
$xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><?xml-stylesheet type="text/xsl" href="'.$zbp->host.'zb_users/plugin/Nobird_Seo_Tools/Sitemap/sitemap.xsl"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:mobile="http://www.google.com/schemas/sitemap-mobile/1.0" />');
}else{
$xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><?xml-stylesheet type="text/xsl" href="'.$zbp->host.'zb_users/plugin/Nobird_Seo_Tools/Sitemap/sitemap.xsl"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" />');

}

$where=array();
$b=$param;
$e=$param+$zbp->Config('Nobird_Sitemap')->BigDataPer;
$where[] = array('between','cate_ID',$b,$e);
			$array=$zbp->GetCategoryList(
		null,
		$where,
		array('cate_ID'=>'ASC'),
		null,
		null,
		false
		);
		$boolok=false;

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
	$zbp->Config('Nobird_Sitemap')->CateLimit = $c->ID;
	$zbp->SaveConfig('Nobird_Sitemap');
		if($maxid==$c->ID){
		$boolok=true;
	}
	}
file_put_contents($zbp->path . 'sitemap_category_'.$j.'.xml',$xml->asXML());

$filename = ZBP_PATH.'sitemap.xml';
$filecontent = file_get_contents($filename);
$newxml = simplexml_load_string($filecontent);        //读取xml文件

$sitemap = $newxml->addChild('sitemap');
$sitemap->addChild('loc', $zbp->host.'sitemap_category_'.$j.'.xml');
$sitemap->addChild('lastmod',date('c',time()));	
file_put_contents($filename,$newxml->asXML());

		
			$this->output('success', '队列:'.$j . ' - 创建完成!');

if($boolok){
			$this->output('success', '分类sitemap - 创建完成!');

}
			$this->output('success', '跳转到下一个任务：<script language="javascript" type="text/javascript">
           window.location.href="'.$zbp->host.'zb_users/plugin/Nobird_Seo_Tools/Batch/nbseo_batch_main.php?module=nbsmpage";
    </script>');
	}
	
	

	

	
}
