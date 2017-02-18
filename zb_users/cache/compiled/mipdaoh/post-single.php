<div class="mianbao">当前位置：&nbsp;<a href='<?php  echo $host;  ?>' target="_blank">首页</a><?php 
$html='';
function navcate($id){
global $html;
$cate = new Category;
$cate->LoadInfoByID($id);
$html ='>> <a href="' .$cate->Url.'" target="_blank" title="查看' .$cate->Name. '中
的全部文章">' .$cate->Name. '</a> '.$html;
if(($cate->ParentID)>0){navcate($cate->ParentID);}
}
navcate($article->Category->ID);
global $html;
echo $html;
 ?>>><?php  echo $article->Title;  ?></div>
<div class="page_content">
<div class="page_left">
<div>网站名称：<?php  echo $article->Title;  ?></div>	
<div>网站网址：<a href="http://<?php  echo $article->Metas->itbulu_url;  ?>" target="_blank"><?php  echo $article->Metas->itbulu_url;  ?></a></div>
<div>网站作者：<?php  echo $article->Metas->itbulu_qq;  ?></div>
<div>网站介绍：<?php  echo $article->Content;  ?></div>	
</div>
<div class="page_right">
<mip-img src="<?php  echo $article->Metas->itbulu_thumb;  ?>" height="150" width="150" alt="<?php  echo $article->Title;  ?>"></mip-img></div>
</div>
<?php if (!$article->IsLock) { ?>
<?php  include $this->GetTemplate('comments');  ?>
<?php } ?>