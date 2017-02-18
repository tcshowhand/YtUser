<div class="mianbao">当前位置：&nbsp;<a href='{$host}' target="_blank">首页</a>{php}
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
{/php}>>{$article.Title}</div>
<div class="page_content">
<div class="page_left">
<div>网站名称：{$article.Title}</div>	
<div>网站网址：<a href="http://{$article.Metas.itbulu_url}" target="_blank">{$article.Metas.itbulu_url}</a></div>
<div>网站作者：{$article.Metas.itbulu_qq}</div>
<div>网站介绍：{$article.Content}</div>	
</div>
<div class="page_right">
<mip-img src="{$article.Metas.itbulu_thumb}" height="150" width="150" alt="{$article.Title}"></mip-img></div>
</div>
{if !$article.IsLock}
{template:comments}
{/if}