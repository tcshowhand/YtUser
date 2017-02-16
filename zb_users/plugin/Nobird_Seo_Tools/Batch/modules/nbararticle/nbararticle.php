<?php
class nbararticle extends nbseo_batch {

	/**
	 * Build queue
	 * @return null
	 */
	public function get_queue() {
		
		global $zbp;
/*
	$sql = $zbp->db->sql->Select(
		$zbp->table['Post'],
		array("*"),
		array(
			array('=', 'log_Type', '0'),
			array('=', 'log_Status', '0'),
		),
		array('log_ID' => 'DESC'),
		null,
		null
	);
	$array = $zbp->db->Query($sql);
*/
$count=GetValueInArrayByCurrent($zbp->db->Query('SELECT COUNT(*) AS num FROM ' . $GLOBALS['table']['Post'] . ' WHERE log_Type=0'), 'num');
	
	$i=1;
	$j=$count;
	$j=ceil($j/100);


	
	
for ($i=$j;$i>0;){
			$this->set_queue('buildarchive', $i);
      $i--;
}
	}
	
	/**
	 * Check BOM
	 * @param string $param 
	 * @return null
	 */
	public function buildarchive($param) {
	global $zbp;

		if(!file_exists($zbp->path . 'archiver/')){
			@mkdir($zbp->path . 'archiver/', 0755,true);	
		}

  $pagebar = new Pagebar($zbp->host.'archiver/archive_{%page%}.html');
	$pagebar->PageCount = 100;
	$pagebar->PageNow = $param;
	$pagebar->PageBarCount = 10;
	$pagebar->UrlRule->Rules['{%page%}'] = $param;
	

  $where=array();
  $where[]=array('=','log_Status',0);
	$select = '*';
	$order = array('log_ID' => 'DESC');
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
	
$boolok=false;
$strlist='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="zh-CN" />
	<title>'.$zbp->name.' Archivers</title>
	<meta name="keywords" content="'.$zbp->name.',Archivers,'.$zbp->name.'存档" />
	<meta name="description" content="'.$zbp->name.'所有日志" />
	<link rel="alternate" type="application/rss+xml" href="'.$zbp->host.'feed.php" title="'.$zbp->name.'" />
	<style type="text/css">
	* {font-size:12px; font-family: Verdana, Arial, Helvetica, sans-serif; line-height: 1.5em;}
	body { background: #F5FBFF; }
	.bodydiv { margin: 2em auto 0; width:720px; text-align:left; border: solid #86B9D6; border-width: 5px 1px 1px; background: #FFF; padding:1em; }
	h1 { font-size: 18px; background: #E8F7FC; color: #5086A5; text-align:center; padding:0.5em; }
	</style>
</head>
<body>
<div class="bodydiv">
	<h1>'.$zbp->name.' Archivers</h1>
	<p><a href="'.$zbp->host.'">'.$zbp->name.'</a> » <a href="'.$zbp->host.'archiver/">Archivers</a> » <a href="'.$zbp->host.'sitemap.xml">sitemap.xml</a></p>
	<ul>';
	
	foreach ($array as $key => $article) {
		$strlist .= '<li>[<a href="'.$article->Category->Url.'" target="_blank">'.$article->Category->Name.'</a>]&nbsp;&nbsp;<a href="'.$article->Url.'">'.$article->Title.'</a>&nbsp;('.$article->ViewNums.')&nbsp; '.$article->Time('Y-m-d H:i:s').' </li>'."\r\n";
	
	if(1==$param){
		$boolok=true;
	} 
		}

$strlist.='</ul>';

$strlist.='<p align="center">';
    $pagebar->buttons['‹‹']=$zbp->host.'archiver/';
    $pagebar->buttons[1]=$zbp->host.'archiver/';

    if($pagebar->PageNow==2){
      $pagebar->buttons['‹']=$zbp->host.'archiver/';
    }
          
    foreach ($pagebar->buttons as $key => $value) {
    if($key==$pagebar->PageNow){
        $strlist.= '<a href="#">' . $key . '</a>&nbsp;&nbsp;' ;
    }else{
        $strlist.= '<a href="'. $value .'">' . $key . '</a>&nbsp;&nbsp;' ;
    }
}
//var_dump($pagebar->buttons['‹‹']);die();
$strlist.='</p>';

$strlist.='<p align="center"> 共'.$pagebar->PageAll.'页&nbsp; 当前第'.$pagebar->PageNow.'页&nbsp;每页'.$pagebar->PageCount.'篇日志&nbsp;&nbsp;</p>';

$strlist.='	<p align="center">&copy; <a href="'.$zbp->host.'">'.$zbp->name.'</a> 最后更新时间:'.date('Y-m-d H:i:s',time()).'</p>
	<p align="center">Generated with Nobird_Seo_Tools by Nobird.</p>
</div>
</body>
</html>';
		
if($param==1){
file_put_contents($zbp->path . 'archiver/index.html',$strlist);
}else{		
file_put_contents($zbp->path . 'archiver/archive_'.$param.'.html',$strlist);
}


		
			$this->output('success', '队列:'.$param . ' - 创建完成!');
if($boolok){
      $zbp->SetHint('good','全站archive创建完成!');

			$this->output('success', '文章archive批量重建 全部创建完成 ：<script language="javascript" type="text/javascript">
           window.location.href="'.$zbp->host.'zb_users/plugin/Nobird_Seo_Tools/Sitemap/archive.php";
    </script>');
}

	}
	
	

	

	
}
