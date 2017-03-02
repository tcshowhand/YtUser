{* Template Name:主题SEO套用 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">打开这个网页的是傻逼</h2>吼吼!</div>';die();?>
<!-- 主题自带SEO开启 -->
{if $type=='article'}
<title>{$title}{$zbp->Config('dmam')->fgf}{$article.Category.Name}{$zbp->Config('dmam')->fgf}{$name}</title>
{php}
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
{/php}
{if isset($keywords)&&strlen($keywords)>0&&strlen($description)>0}
<meta name="keywords" content="{$keywords}"/>
<meta name="description" content="{$description}"/>
{/if}
<meta name="author" content="{$article.Author.StaticName}">
{if $article.Prev}
<link rel="prev" title="{$article.Prev.Title}" href="{$article.Prev.Url}" />
{/if}
{if $article.Next}
<link rel="next" title="{$article.Next.Title}" href="{$article.Next.Url}" />
{/if}
<link rel="canonical" href="{$article.Url}" />
<link rel="shortlink" href="{$host}?id={$article.ID}" />
{elseif $type=='page'}
<title>{$title}{$zbp->Config('dmam')->fgf}{$name}{if $subname}{$zbp->Config('dmam')->fgf}{$subname}{/if}</title>
{php}
$description = trim(SubStrUTF8(TransferHTML($article->Content,'[nohtml]'),135));
{/php}
{if strlen($description)>0}
<meta name="keywords" content="{$title},{$name}"/>
<meta name="description" content="{$description}"/>
{/if}
<meta name="author" content="{$article.Author.StaticName}">
{elseif $type=='index'}
<title>{$name}{if $page>'1'}{$zbp->Config('dmam')->fgf}当前第{$pagebar.PageNow}页{/if}{if $subname}{$zbp->Config('dmam')->fgf}{$subname}{/if}</title>
{if $zbp->Config('dmam')->keywords && $zbp->Config('dmam')->description}
<meta name="Keywords" content="{$zbp->Config('dmam')->keywords}">
<meta name="description" content="{$zbp->Config('dmam')->description}">
{/if}
<meta name="author" content="{$name}">
{elseif $type=='category'}
<title>{$title}{$zbp->Config('dmam')->fgf}{$name}{if $subname}{$zbp->Config('dmam')->fgf}{$subname}{/if}</title>
{php}
if ($category->Metas->keywords){
	$keywords = $category->Metas->keywords;
}else{
	$keywords = $title.','.$name;
}	
{/php}
{if isset($keywords)&&strlen($keywords)>0&&$category.Intro}
<meta name="Keywords" content="{$keywords}">
<meta name="description" content="{$category.Intro}">
{/if}
<meta name="author" content="{$name}">
{else}
<title>{$title}{$zbp->Config('dmam')->fgf}{$name}{if $page>'1'}{$zbp->Config('dmam')->fgf}当前第{$pagebar.PageNow}页{/if}{if $subname}{$zbp->Config('dmam')->fgf}{$subname}{/if}</title>
<meta name="Keywords" content="{$title},{$name}">
<meta name="description" content="{$title}{$zbp->Config('dmam')->fgf}{$name}{if $page>'1'}{$zbp->Config('dmam')->fgf}当前第{$pagebar.PageNow}页{/if}">
<meta name="author" content="{$name}">
{/if}