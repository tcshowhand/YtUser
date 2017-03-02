<?php  /* Template Name:主题SEO套用 */  ?>

<!-- 主题自带SEO开启 -->
<?php if ($type=='article') { ?>
<title><?php  echo $title;  ?><?php  echo $zbp->Config('dmam')->fgf;  ?><?php  echo $article->Category->Name;  ?><?php  echo $zbp->Config('dmam')->fgf;  ?><?php  echo $name;  ?></title>
<?php 
$aryTags = array();
foreach($article->Tags as $key){
$aryTags[] = $key->Name;
}
if ($article->Metas->keywords){
	$keywords = $article->Metas->keywords;
}else{
	if(count($aryTags)>0) $keywords = implode(',',$aryTags);
}
if ($article->Metas->description){
	$description = $article->Metas->description;
}else{
	$description = trim(SubStrUTF8(TransferHTML($article->Content,'[nohtml]'),135));
}	
 ?>
<?php if (isset($keywords)&&strlen($keywords)>0&&strlen($description)>0) { ?>
<meta name="keywords" content="<?php  echo $keywords;  ?>"/>
<meta name="description" content="<?php  echo $description;  ?>"/>
<?php } ?>
<meta name="author" content="<?php  echo $article->Author->StaticName;  ?>">
<?php if ($article->Prev) { ?>
<link rel="prev" title="<?php  echo $article->Prev->Title;  ?>" href="<?php  echo $article->Prev->Url;  ?>" />
<?php } ?>
<?php if ($article->Next) { ?>
<link rel="next" title="<?php  echo $article->Next->Title;  ?>" href="<?php  echo $article->Next->Url;  ?>" />
<?php } ?>
<link rel="canonical" href="<?php  echo $article->Url;  ?>" />
<link rel="shortlink" href="<?php  echo $host;  ?>?id=<?php  echo $article->ID;  ?>" />
<?php }elseif($type=='page') {  ?>
<title><?php  echo $title;  ?><?php  echo $zbp->Config('dmam')->fgf;  ?><?php  echo $name;  ?><?php if ($subname) { ?><?php  echo $zbp->Config('dmam')->fgf;  ?><?php  echo $subname;  ?><?php } ?></title>
<?php 
$description = trim(SubStrUTF8(TransferHTML($article->Content,'[nohtml]'),135));
 ?>
<?php if (strlen($description)>0) { ?>
<meta name="keywords" content="<?php  echo $title;  ?>,<?php  echo $name;  ?>"/>
<meta name="description" content="<?php  echo $description;  ?>"/>
<?php } ?>
<meta name="author" content="<?php  echo $article->Author->StaticName;  ?>">
<?php }elseif($type=='index') {  ?>
<title><?php  echo $name;  ?><?php if ($page>'1') { ?><?php  echo $zbp->Config('dmam')->fgf;  ?>当前第<?php  echo $pagebar->PageNow;  ?>页<?php } ?><?php if ($subname) { ?><?php  echo $zbp->Config('dmam')->fgf;  ?><?php  echo $subname;  ?><?php } ?></title>
<?php if ($zbp->Config('dmam')->keywords && $zbp->Config('dmam')->description) { ?>
<meta name="Keywords" content="<?php  echo $zbp->Config('dmam')->keywords;  ?>">
<meta name="description" content="<?php  echo $zbp->Config('dmam')->description;  ?>">
<?php } ?>
<meta name="author" content="<?php  echo $name;  ?>">
<?php }elseif($type=='category') {  ?>
<title><?php  echo $title;  ?><?php  echo $zbp->Config('dmam')->fgf;  ?><?php  echo $name;  ?><?php if ($subname) { ?><?php  echo $zbp->Config('dmam')->fgf;  ?><?php  echo $subname;  ?><?php } ?></title>
<?php 
if ($category->Metas->keywords){
	$keywords = $category->Metas->keywords;
}else{
	$keywords = $title.','.$name;
}	
 ?>
<?php if (isset($keywords)&&strlen($keywords)>0&&$category->Intro) { ?>
<meta name="Keywords" content="<?php  echo $keywords;  ?>">
<meta name="description" content="<?php  echo $category->Intro;  ?>">
<?php } ?>
<meta name="author" content="<?php  echo $name;  ?>">
<?php }else{  ?>
<title><?php  echo $title;  ?><?php  echo $zbp->Config('dmam')->fgf;  ?><?php  echo $name;  ?><?php if ($page>'1') { ?><?php  echo $zbp->Config('dmam')->fgf;  ?>当前第<?php  echo $pagebar->PageNow;  ?>页<?php } ?><?php if ($subname) { ?><?php  echo $zbp->Config('dmam')->fgf;  ?><?php  echo $subname;  ?><?php } ?></title>
<meta name="Keywords" content="<?php  echo $title;  ?>,<?php  echo $name;  ?>">
<meta name="description" content="<?php  echo $title;  ?><?php  echo $zbp->Config('dmam')->fgf;  ?><?php  echo $name;  ?><?php if ($page>'1') { ?><?php  echo $zbp->Config('dmam')->fgf;  ?>当前第<?php  echo $pagebar->PageNow;  ?>页<?php } ?>">
<meta name="author" content="<?php  echo $name;  ?>">
<?php } ?>