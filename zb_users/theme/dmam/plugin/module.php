<?php
//重建模块首先加载项目
function dmam_rebuild_Main() {
	global $zbp;
	$zbp->RegBuildModule('hotviewpost','dmam_R_hotviewpost');
	$zbp->RegBuildModule('hotcommpost','dmam_R_hotcommpost');
	$zbp->RegBuildModule('readers','dmam_R_readers');
	$zbp->RegBuildModule('guess','dmam_guess');
	$zbp->RegBuildModule('sidebartab','dmam_side_tab');
}

function dmam_R_hotviewpost() {
	global $zbp;
	return dmam_side_post($typein='hotviewpost',$typeinid='');
	}
function dmam_R_hotcommpost() {
	global $zbp;
	return dmam_side_post($typein='hotcommpost',$typeinid='');
	}
function dmam_R_readers() {
	global $zbp;
	return dmam_page_readers_cache('side');
	}

function dmam_side_post($typein,$typeinid) {
	global $zbp;
	$articles = '';
	if (!$typeinid)$typeinid = 1;
	$s = '';
	if ($typein == 'widget_author_post'){
		$articles = $zbp->GetArticleList('*', array(array('=', 'log_Type', 0),array('=', 'log_AuthorID', $typeinid), array('=', 'log_Status', 0)), array('log_PostTime' => 'DESC'), 6, null,false);
		
		foreach ($articles as $article) {
		$s .= '<li><a '.dmam_isblank(true).' href="' . $article->Url. '">' . $article->Title. '</a></li>';
		}
	}else{
	$i = '';
		if ($typein == 'hotviewpost'){
			$i = isset($zbp->modulesbyfilename['hotviewpost']->MaxLi)?$zbp->modulesbyfilename['hotviewpost']->MaxLi:6;
			$articles = $zbp->GetArticleList('*', array(array('=', 'log_Type', 0), array('=', 'log_Status', 0)), array('log_ViewNums' => 'DESC'), $i, null,false);
		}elseif ($typein == 'hotcommpost'){
			$i = isset($zbp->modulesbyfilename['hotcommpost']->MaxLi)?$zbp->modulesbyfilename['hotcommpost']->MaxLi:6;
			$articles = $zbp->GetArticleList('*', array(array('=', 'log_Type', 0), array('=', 'log_Status', 0)), array('log_CommNums' => 'DESC'), $i, null,false);	
		}else{
			$i = isset($zbp->modulesbyfilename['previous']->MaxLi)?$zbp->modulesbyfilename['previous']->MaxLi:6;
			$articles = $zbp->GetArticleList('*', array(array('=', 'log_Type', 0), array('=', 'log_Status', 0)), array('log_ID' => 'DESC'), $i, null,false);	
		}
		
		foreach ($articles as $article) {
			if ($typein == 'hotviewpost'){
				$typee = '<small>阅读 (' . $article->ViewNums. ')</small>';
			}elseif ($typein == 'hotcommpost'){
				$typee = '<small>评论 (' . $article->CommNums. ')</small>';	
			}else{
				$typee = '';	
			}
			$sidepostimg = '';
			$sidepostimg = $zbp->host.'zb_users/theme/'.$zbp->theme.'/style/images/covers/'.rand(1,20).'.jpg';
			if ($zbp->CheckPlugin('dm_tools')) {
				dm_tools_thumb::getPics($article,400,250,4);
				if ($article->dm_tools_thumb_COUNT>0){
					$sidepostimg = $article->dm_tools_thumb[0];
					if ($article->Metas->post_style_order && $article->Metas->post_style_order > 1 && !strpos($article->Metas->post_style_order,',')){
					$sidepostimg = $article->dm_tools_thumb[$article->Metas->post_style_order-1];
					}
				}
				$sidepostimg = $article->Metas->thumbnail?dm_tools_thumb::getPicUrlBy($article->Metas->thumbnail,400,250,4):$sidepostimg;
			}

			if ($article->Metas->post_style == "txt"){
					$s .= '<li><a '.dmam_isblank(true).' href="' . $article->Url. '"><p class="sidepost-bd-nopic">' . $article->Title.$typee.'</p></a></li>';
					}
			else{
					$s .= '<li><a '.dmam_isblank(true).' href="' . $article->Url. '"><p class="sidepost-hd"><img '.dmam_islasy('',$sidepostimg).'"></p><p class="sidepost-bd">' . $article->Title.$typee.'</p></a></li>';
			}
		}
	}
	
	return $s;
}

function dmam_side_tab(){
	global $zbp;
	$s =  '<div class="am-tabs side-tabs">
  <ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
    <li class="am-active"><a href="">猜你喜欢</a></li>
    <li><a href="">热评文章</a></li>
    <li><a href="">热门文章</a></li>
  </ul>
  <div class="am-tabs-bd">
    <div class="am-tab-panel am-active">'.dmam_guess().'</div>
    <div class="am-tab-panel">'.dmam_side_post($typein="hotcommpost",$typeinid="").'</div>
    <div class="am-tab-panel">'.dmam_side_post($typein="hotviewpost",$typeinid="").'</div>
  </div>
</div>';
	return $s;
}

//新建模块
function dmam_create_module(){
	global $zbp;
		if(!isset($zbp->modulesbyfilename['sidebartab'])){
			$t = new Module();
			$t->Name = '侧栏TAB';
			$t->IsHideTitle = 1;
			$t->FileName = 'sidebartab';
			$t->Source = "theme_dmam";
			$t->Content = dmam_side_tab();
			$t->HtmlID = 'divsidebartab';
			$t->Type = "div";
			$t->MaxLi= $t->MaxLi?$t->MaxLi:6;
			$t->Save();
		}
		if(!isset($zbp->modulesbyfilename['hotviewpost'])){
			$t = new Module();
			$t->Name = '热门文章';
			$t->FileName = 'hotviewpost';
			$t->Source = "theme_dmam";
			$t->Content = dmam_side_post($typein='hotviewpost',$typeinid='');
			$t->HtmlID = 'divhotviewpost';
			$t->Type = "ul";
			$t->MaxLi= $t->MaxLi?$t->MaxLi:6;
			$t->Save();
		}
		if(!isset($zbp->modulesbyfilename['hotcommpost'])){
			$t = new Module();
			$t->Name = '热评文章';
			$t->FileName = 'hotcommpost';
			$t->Source = "theme_dmam";
			$t->Content = dmam_side_post($typein='hotcommpost',$typeinid='');
			$t->HtmlID = 'divhotcommpost';
			$t->Type = "ul";
			$t->MaxLi= $t->MaxLi?$t->MaxLi:6;
			$t->Save();
		}		
		if(!isset($zbp->modulesbyfilename['readers'])){
			$t = new Module();
			$t->Name = '读者墙';
			$t->FileName = 'readers';
			$t->Source = "theme_dmam";
			$t->Content = dmam_page_readers_cache('side');
			$t->HtmlID = 'divreaders';
			$t->Type = "ul";
			$t->MaxLi= $t->MaxLi?$t->MaxLi:21;
			$t->Save();
		}
		if(!isset($zbp->modulesbyfilename['guess'])){
			$t = new Module();
			$t->Name = "猜你喜欢";
			$t->FileName = "guess";
			$t->Source = "theme_dmam";
			$t->SidebarID = 0;
			$t->IsHideTitle=false;
			$t->HtmlID = "divGuess";
			$t->Type = "ul";
			$t->MaxLi= $t->MaxLi?$t->MaxLi:6;
			$t->Content = dmam_guess();
			$t->Save();
		}
}
//猜你喜欢
function dmam_guess(){
	global $zbp;
	$str='';
	$sql = $zbp->db->sql->Select(
		$zbp->table['Post'],
		array("MIN(log_ID)","MAX(log_ID)"),
		array(
			array('=', 'log_Type', '0'),
			array('=', 'log_Status', '0'),
		),
		array('log_PostTime' => 'ASC'),
		null,
		null
	);
	$array = $zbp->db->Query($sql);
	$i=mt_rand($array[0]["MIN(log_ID)"],$array[0]["MAX(log_ID)"]);
	$order = '';
	$where = array(
          array('=','log_Status','0'),
          array('>','log_ID',$i)
          );
	$max= '';
	$max = isset($zbp->modulesbyfilename['guess']->MaxLi)?$zbp->modulesbyfilename['guess']->MaxLi:6;
	$array = $zbp->GetArticleList(array('*'),$where,$order,array($max),'');
	foreach ($array as $key=>$article) {
		$sidepostimg = '';
		$sidepostimg = $zbp->host.'zb_users/theme/'.$zbp->theme.'/style/images/covers/'.rand(1,20).'.jpg';
		if ($zbp->CheckPlugin('dm_tools')) {
			dm_tools_thumb::getPics($article,400,250,4);
			if ($article->dm_tools_thumb_COUNT>0){
				$sidepostimg = $article->dm_tools_thumb[0];
				if ($article->Metas->post_style_order && $article->Metas->post_style_order > 1 && !strpos($article->Metas->post_style_order,',')){
				$sidepostimg = $article->dm_tools_thumb[$article->Metas->post_style_order-1];
				}
			}
			$sidepostimg = $article->Metas->thumbnail?dm_tools_thumb::getPicUrlBy($article->Metas->thumbnail,400,250,4):$sidepostimg;
		}

			$str .= $sidepostimg?'<li><a '.dmam_isblank(true).' href="' . $article->Url. '"><p class="sidepost-hd"><img '.dmam_islasy('',$sidepostimg).'"></p><p class="sidepost-bd">' .$article->Title.'</p></a></li>':'';

	}
	return $str;
}

?>