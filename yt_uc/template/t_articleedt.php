{* Template Name: 发布投稿*}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
{template:t_header}
{if $user.Level < 5}
<input type="hidden" name="token" id="token" value="{$zbp->GetToken()}" />
标题:<input id="edtTitle" class="edit" name="Title" type="text">
分类:<select name="CateID" size="1" class="form-control user_input">{Yt_Categories(0)}</select>
内容:{$article.UEditor}
验证码:<input required="required" name="verifycode" type="text"> {$article.verifycode}
<button onclick="return checkArticleInfo();">提交</button>
{else}
权限不足提示代码。
{/if}