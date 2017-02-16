<?php
class nbsmcoustom extends nbseo_batch {

	/**
	 * Build queue
	 * @return null
	 */
	public function get_queue() {
		
		global $zbp;
	$sql = $zbp->db->sql->Select(
		$zbp->table['nobird_seo_tools_sitemap_coustom'],
		array("MIN(Sitemap_ID)","MAX(Sitemap_ID)"),
		null,
		array('Sitemap_ID'=>'DESC'),
		null,
		null
	);
	$array = $zbp->db->Query($sql);
	
	$minid=$array[0]["MIN(Sitemap_ID)"];
	$maxid=$array[0]["MAX(Sitemap_ID)"];
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
$where[] = array('between','Sitemap_ID',$b,$e);
$order=array('Sitemap_ID'=>'ASC');
$sql= $zbp->db->sql->Select($zbp->table['nobird_seo_tools_sitemap_coustom'],'*',$where,$order,null,null);
$array=$zbp->GetListType('nobird_seo_tools_sitemap_coustom',$sql);

/*
			$array=$zbp->GetCategoryList(
		null,
		$where,
		array('cate_ID'=>'ASC'),
		null,
		null,
		false
		);
*/
		$boolok=false;

	foreach ($array as $c) {
		$url = $xml->addChild('url');
		$url->addChild('loc', $c->Url);
if (!$zbp->CheckPlugin('Pad')) {
  $mobileurl = $url->addChild('mobile:mobile');
  $mobileurl->addAttribute('type', 'pc,mobile');
}
		$url->addChild('lastmod',date('c',$c->Lastmod));	
        $url->addChild('changefreq', $c->Changefreq);
        $url->addChild('priority', $c->Priority);
	$zbp->Config('Nobird_Sitemap')->CoustomLimit = $c->ID;
	$zbp->SaveConfig('Nobird_Sitemap');
		if($maxid==$c->ID){
		$boolok=true;
	}
	}
file_put_contents($zbp->path . 'sitemap_coustom_'.$j.'.xml',$xml->asXML());

$filename = ZBP_PATH.'sitemap.xml';
$filecontent = file_get_contents($filename);
$newxml = simplexml_load_string($filecontent);        //读取xml文件

$sitemap = $newxml->addChild('sitemap');
$sitemap->addChild('loc', $zbp->host.'sitemap_coustom_'.$j.'.xml');
$sitemap->addChild('lastmod',date('c',time()));	
file_put_contents($filename,$newxml->asXML());

		
			$this->output('success', '队列:'.$j . ' - 创建完成!');

if($boolok){
			$this->output('success', '自定义Url的sitemap - 创建完成!');

	}



      $zbp->SetHint('good','全站Sitemap创建完成!');

			$this->output('success', '全部创建完成 ：<script language="javascript" type="text/javascript">
           window.location.href="'.$zbp->host.'zb_users/plugin/Nobird_Seo_Tools/Sitemap/sitemap_large.php";
    </script>');
	

	

	
}
}
