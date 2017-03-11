<article class="archive-list">
{if $zbp->Config('mochu')->onzhiimg=="1"}{php}$src = fasimg($article){/php}{$src}{/if}
<header>
<h2><span class="zhiding">【推荐】</span><a target="_blank" href="{$article.Url}" title="{$article.Title}" rel="bookmark">{$article.Title}</a></h2> 
<span class="archive-list-header"> 
<span class="archive-list-lei"><i class="fa fa-folder-open-o"></i><a href="{$article.Category.Url}" title="查看{$article.Category.Name}的全部文章">{$article.Category.Name}</a> </span> 
<span class="archive-list-time" ><i class="fa fa-clock-o"></i>{$article.Time('Y-m-d')}</span> 
</span> 
</header>
<div class="archive-list-content">
<a target="_blank" href="{$article.Url}" rel="bookmark">{php}if($zbp->Config('mochu')->onimg=="0"){$mochuinfosize = "180";}
elseif($zbp->Config('mochu')->onslimg=="0" && empty($matchContent[1][0])){$mochuinfosize = "180";}else{$mochuinfosize = "100";}
if ($article->Intro){$mochuinfo= preg_replace("/<(.*?)>/","",$article->Intro); $mochuinfo=str_replace("&nbsp;"," ",$mochuinfo); $mochuinfo=trim(SubStrUTF8($mochuinfo,$mochuinfosize)).'...';}else{$mochuinfo= preg_replace("/<(.*?)>/","",$article->Content); $mochuinfo=str_replace("&nbsp;"," ",$mochuinfo);$mochuinfo=trim(SubStrUTF8($mochuinfo,$mochuinfosize)).'...';}echo $mochuinfo;{/php}....</a>
</div> 
<footer class="archive-list-footer">
<span><i class="fa fa-eye"></i>{$article.ViewNums} views</span>
<span><i class="fa fa-tags"></i>{if $article.Tags}{foreach $article.Tags as $tag}<a href="{$tag.Url}">{$tag.Name}</a>{/foreach}{else}未定义标签{/if}</span>
<span><i class="fa fa-comment"></i>{$article.CommNums} 评论</span>
</footer> 
<div class="clear"></div> 
</article>     