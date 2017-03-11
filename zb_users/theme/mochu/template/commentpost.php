<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2style="font-size:60px;margin-bottom:32px;color:f00;">已举报，请注意查收你的法院通知单！</h2>你的行为已经对我的版权产生的威胁，已把您电脑的IP地址上报给国家版权中心，请注意查收邮寄给您的法院信函！</div>';die();?>
<div class="pinglunpost" id="postcmt"><p class="posttop"><a name="comment">{if $user.ID>0}当前用户：{$user.StaticName}{/if}</a><a rel="nofollow" id="cancel-reply" href="#divCommentPost" style="display:none;"><small>取消回复</small></a></p>
<form id="frmSumbit" target="_self" method="post" action="{$article.CommentPostUrl}" >
<input type="hidden" name="inpId" id="inpId" value="{$article.ID}" />
<input type="hidden" name="inpRevID" id="inpRevID" value="0" />{if $user.ID>0}
<input type="hidden" name="inpName" id="inpName" value="{$user.Name}" />
<input type="hidden" name="inpEmail" id="inpEmail" value="{$user.Email}" />
<input type="hidden" name="inpHomePage" id="inpHomePage" value="{$user.HomePage}" />
{else}<p><label for="inpName">名称</label><input type="text" name="inpName" id="inpName" class="text" value="" size="28" tabindex="1" /> 必填</p><p><label for="inpEmail">邮箱</label><input type="text" name="inpEmail" id="inpEmail" class="text" value="" size="28" tabindex="2" /> 选填</p><p><label for="inpHomePage">网址</label><input type="text" name="inpHomePage" id="inpHomePage" class="text" value="" size="28" tabindex="3" /> 选填</p>
{if $option['ZC_COMMENT_VERIFY_ENABLE']}
<p><label for="inpVerify">验证码</label><input type="text" name="inpVerify" id="inpVerify" class="text" value="" size="28" tabindex="4" /> 
<img style="width:{$option['ZC_VERIFYCODE_WIDTH']}px;height:{$option['ZC_VERIFYCODE_HEIGHT']}px;cursor:pointer;" src="{$article.ValidCodeUrl}" alt="" title="" onclick="javascript:this.src='{$article.ValidCodeUrl}&amp;tm='+Math.random();"/></p>{/if}{/if}
<p><textarea name="txaArticle" id="txaArticle" class="text" cols="50" rows="4" tabindex="5" ></textarea></p>
<p>◎欢迎参与讨论，请在这里发表您的看法、交流您的观点。<input name="sumbit" type="submit" tabindex="6" value="提交" onclick="return zbp.comment.post()" class="button" /></p></form></div>