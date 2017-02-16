<?php
//重制间接模板中间件！
$Tctitleseo_name=$name;
$Tctitleseo_title=$title;

if($zbp->Config('Tctitleseo')->title_change){
	if(!($type=='index'&&$page=='1')){
		$name=$Tctitleseo_title;
		$title=$Tctitleseo_name;
	}
}

include $zbp->usersdir . 'cache/compiled/default/header.php';

if($zbp->Config('Tctitleseo')->title_change){
	if(!($type=='index'&&$page=='1')){
		$name=$Tctitleseo_name;
		$title=$Tctitleseo_title;
	}
}

if($type=='index'){
	$keywords = $zbp->Config('Tctitleseo')->title_keywords;
	$description = $zbp->Config('Tctitleseo')->title_description;
}elseif($type=='category'){
	$keywords = $category->Metas->tc_keywords;
	$description = $category->Metas->tc_description;
}elseif($type=='author'){
	$keywords = $author->Name;
	$description = $author->Intro;
}elseif($type=='tag'){
	$keywords = $tag->Name;
	$description = $tag->Intro;
}elseif($type=='article'||$type=='page'){
	$keywords =$article->Metas->tc_keywords;
	$description = $article->Metas->tc_description;
}

if(isset($keywords)&&strlen($keywords)>0){
	echo '<meta name="keywords" content="'.htmlspecialchars($keywords).'" />' . "\r\n";
}

if(isset($description)&&strlen($description)>0){
	echo '<meta name="description" content="'.htmlspecialchars($description).'" />' . "\r\n";
}

?>