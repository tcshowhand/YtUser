<?php

function Nobird_Seo_Tools_Filter_Plugin_Edit_End(){
global $zbp;
if($zbp->Config('Nobird_BeautyTitle')->check){
	echo '<script src="'. $zbp->host .'zb_users/plugin/Nobird_Seo_Tools/BeautyTitle/common.js" type="text/javascript"></script>';
}
}

function Nobird_Seo_Tools_BeautyTitle(&$templates){
	global $zbp,$article;

if ($zbp->Config('Nobird_BeautyTitle')->BeautyTitle_IsUse){
	$templates['header'] = preg_replace("/<title>.+<\/title>/is", 
	'{php}

switch($type){
  case "index":
    if ($page=="1"){
      $strtitle=$zbp->Config("Nobird_BeautyTitle")->s_index;
    }elseif ($page>"1"){
      $strtitle=$zbp->Config("Nobird_BeautyTitle")->s_list;
      $Arr_Title = explode(" ",$title);
      $strtitle = str_replace("%page%",$Arr_Title[0],$strtitle);
    }

		break;
	case "category":
    if ($page=="1"){
      $strtitle=$zbp->Config("Nobird_BeautyTitle")->s_category;
      $strtitle = str_replace("%catetagdate%",$category->Name,$strtitle);

//      $strtitle = str_replace("%catetagdate%",$title,$strtitle);
    }elseif ($page>"1"){
      $strtitle=$zbp->Config("Nobird_BeautyTitle")->s_category_list;
      $Arr_Title = explode(" ",$title);
      $strtitle = str_replace("%page%",$Arr_Title[1],$strtitle);
      $strtitle = str_replace("%catetagdate%",$Arr_Title[0],$strtitle);
    }
    	
    $strtitle = str_replace("%nbname%",$category->Metas->NBTitle,$strtitle);

		break;
	case "tag":
    if ($page=="1"){
      $strtitle=$zbp->Config("Nobird_BeautyTitle")->s_tag;
      $strtitle = str_replace("%catetagdate%",$tag->Name,$strtitle);

//      $strtitle = str_replace("%catetagdate%",$title,$strtitle);
    }elseif ($page>"1"){
      $strtitle=$zbp->Config("Nobird_BeautyTitle")->s_tag_list;
      $Arr_Title = explode(" ",$title);
      $strtitle = str_replace("%page%",$Arr_Title[1],$strtitle);
      $strtitle = str_replace("%catetagdate%",$tag->Name,$strtitle);
    }
    		
    $strtitle = str_replace("%nbname%",$tag->Metas->NBTitle,$strtitle);
		break;
	case "date":
    if ($page=="1"){
      $strtitle=$zbp->Config("Nobird_BeautyTitle")->s_date;
      $strtitle = str_replace("%catetagdate%",$title,$strtitle);
    }elseif ($page>"1"){
      $strtitle=$zbp->Config("Nobird_BeautyTitle")->s_date_list;
      $Arr_Title = explode(" ",$title);
      $strtitle = str_replace("%page%",$Arr_Title[1],$strtitle);
      $strtitle = str_replace("%catetagdate%",$Arr_Title[0],$strtitle);
    }
    		
    $strtitle = str_replace("%nbname%","",$strtitle);
		break;		
	case "author":
    if ($page=="1"){
      $strtitle=$zbp->Config("Nobird_BeautyTitle")->s_author;
      $strtitle = str_replace("%catetagdate%",$author->StaticName,$strtitle);
//      $strtitle = str_replace("%catetagdate%",$title,$strtitle);
    }elseif ($page>"1"){
      $strtitle=$zbp->Config("Nobird_BeautyTitle")->s_author_list;
      $Arr_Title = explode(" ",$title);
      $strtitle = str_replace("%page%",$Arr_Title[1],$strtitle);
      $strtitle = str_replace("%catetagdate%",$Arr_Title[0],$strtitle);
    }
    		
    $strtitle = str_replace("%nbname%","",$strtitle);
		break;		
	case "article":
    $strtitle=$zbp->Config("Nobird_BeautyTitle")->s_article;
    $strtitle = str_replace("%catename%",$article->Category->Name,$strtitle);
    $strtitle = str_replace("%postname%",$article->Title,$strtitle);
    if($zbp->Config("Nobird_BeautyTitle")->Use_DIY_article){
      $strtitle = str_replace("%nbname%",$article->Metas->Nobird_Seo_Tools_DIY_article,$strtitle);
    }
		break;
	case "page":
    $strtitle=$zbp->Config("Nobird_BeautyTitle")->s_page;
    $strtitle = str_replace("%postname%",$article->Title,$strtitle);
    if($zbp->Config("Nobird_BeautyTitle")->Use_DIY_article){
      $strtitle = str_replace("%nbname%",$article->Metas->Nobird_Seo_Tools_DIY_article,$strtitle);
    }
		break;
	case "nobird_photo":
	case "nobird_vote":
    $strtitle=$zbp->Config("Nobird_BeautyTitle")->s_page;
    $strtitle = str_replace("%postname%",$article->Title,$strtitle);
    if($zbp->Config("Nobird_BeautyTitle")->Use_DIY_article){
      $strtitle = str_replace("%nbname%",$article->Metas->Nobird_Seo_Tools_DIY_article,$strtitle);
    }
		break;
	default:
    $strtitle=$zbp->title.$zbp->Config("Nobird_BeautyTitle")->Title_Separator.$zbp->name;

		break;
}


$strtitle = str_replace("%name%",$zbp->name,$strtitle);
$strtitle = str_replace("%subname%",$zbp->subname,$strtitle);
echo "<title>".$strtitle."</title>";
{/php}
	
{if $type}{$Nobird_Seo_KeyAndDes}{/if}', $templates['header']); //article

}else{
	$templates['header'] = preg_replace("/<title>(.+)<\/title>/is",'<title>$1</title>
	{if $type}{$Nobird_Seo_KeyAndDes}{/if}', $templates['header']); //article

}





}




function Nobird_BeautyTitle_Install(){
	global $zbp;
	if(!$zbp->Config('Nobird_BeautyTitle')->HasKey('Version')) {
	$zbp->Config('Nobird_BeautyTitle')->Version = '1.0';
	if($zbp->host=='http://www.birdol.com/'){
    $zbp->Config('Nobird_BeautyTitle')->BeautyTitle_IsUse = 1;
	}
	$zbp->Config('Nobird_BeautyTitle')->Title_Separator= ' - ';	
	$zbp->Config('Nobird_BeautyTitle')->s_index = '%name%-%subname%';
	$zbp->Config('Nobird_BeautyTitle')->s_list = '%page%-%name%-%subname%';

	
	$zbp->Config('Nobird_BeautyTitle')->s_category = '%catetagdate%%nbname%-%name%';
	$zbp->Config('Nobird_BeautyTitle')->s_category_list = '%catetagdate%%nbname%-%name%-%page%';
	$zbp->Config('Nobird_BeautyTitle')->s_tag = '%catetagdate%%nbname%-%name%';
	$zbp->Config('Nobird_BeautyTitle')->s_tag_list = '%catetagdate%%nbname%-%name%-%page%';
	$zbp->Config('Nobird_BeautyTitle')->s_date = '%catetagdate%%nbname%-%name%';
	$zbp->Config('Nobird_BeautyTitle')->s_date_list = '%catetagdate%%nbname%-%name%-%page%';
	$zbp->Config('Nobird_BeautyTitle')->s_author = '%catetagdate%%nbname%-%name%';
	$zbp->Config('Nobird_BeautyTitle')->s_author_list = '%catetagdate%%nbname%-%name%-%page%';

	$zbp->Config('Nobird_BeautyTitle')->s_article = '%postname%-%catename%-%name%';
	$zbp->Config('Nobird_BeautyTitle')->s_page = '%postname%-%name%';
	$zbp->Config('Nobird_BeautyTitle')->check = 1;
	
	$zbp->SaveConfig('Nobird_BeautyTitle');
	}
	
}



function Nobird_BeautyTitle_Uninstall(){
	global $zbp;
	$zbp->DelConfig('Nobird_BeautyTitle');
}


?>