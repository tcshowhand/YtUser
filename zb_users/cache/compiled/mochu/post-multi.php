<article class="archive-list">
<?php if ($zbp->Config('mochu')->onzhiimg=="1") { ?><?php $src = fasimg($article) ?><?php  echo $src;  ?><?php } ?>
<header>
<h2><a target="_blank" href="<?php  echo $article->Url;  ?>" title="<?php  echo $article->Title;  ?>" rel="bookmark"><?php  echo $article->Title;  ?></a></h2> 
<span class="archive-list-header"> 
<span class="archive-list-lei"><i class="fa fa-user"></i><?php  echo $article->Author->StaticName;  ?></span> 
<span class="archive-list-time" ><i class="fa fa-clock-o"></i><?php  echo $article->Time('Y-m-d');  ?></span> 
</span> 
</header>
<div class="archive-list-content">
<a target="_blank" href="<?php  echo $article->Url;  ?>" rel="bookmark"><?php if($zbp->Config('mochu')->onimg=="0"){$mochuinfosize = "180";}
elseif($zbp->Config('mochu')->onslimg=="0" && empty($matchContent[1][0])){$mochuinfosize = "180";}else{$mochuinfosize = "100";}
if ($article->Intro){$mochuinfo= preg_replace("/<(.*?)>/","",$article->Intro); $mochuinfo=str_replace("&nbsp;"," ",$mochuinfo); $mochuinfo=trim(SubStrUTF8($mochuinfo,$mochuinfosize)).'...';}else{$mochuinfo= preg_replace("/<(.*?)>/","",$article->Content); $mochuinfo=str_replace("&nbsp;"," ",$mochuinfo);$mochuinfo=trim(SubStrUTF8($mochuinfo,$mochuinfosize)).'...';}echo $mochuinfo; ?>....</a>
</div> 
<footer class="archive-list-footer">
<span><i class="fa fa-eye"></i><?php  echo $article->ViewNums;  ?> views</span>
<span><i class="fa fa-tags"></i><?php if ($article->Tags) { ?><?php  foreach ( $article->Tags as $tag) { ?><a href="<?php  echo $tag->Url;  ?>"><?php  echo $tag->Name;  ?></a><?php }   ?><?php }else{  ?>未定义标签<?php } ?></span>
<span><i class="fa fa-comment"></i><?php  echo $article->CommNums;  ?> 评论</span>
</footer> 
<div class="clear"></div> 
</article>        