<div class="post">
	<div class="postname"><h3>{if $user.ID>0}{$user.Name}{/if}发布评论</h3><a rel="nofollow" id="cancel-reply" href="#divCommentPost" style="display:none;"><small>取消回复</small></a></div>
	<div class="postcon">
	<div id="comments">
	<form id="frmSumbit" target="_self" method="post" action="{$article.CommentPostUrl}" >
	<input type="hidden" name="inpId" id="inpId" value="{$article.ID}" />
	<input type="hidden" name="inpRevID" id="inpRevID" value="0" />
{if $user.ID>0}
	<input type="hidden" name="inpName" id="inpName" value="{$user.Name}" />
	<input type="hidden" name="inpEmail" id="inpEmail" value="{$user.Email}" />
	<input type="hidden" name="inpHomePage" id="inpHomePage" value="{$user.HomePage}" />	
{else}
	<div class="comment_text">
	<p><input type="text" name="inpName" id="inpName" class="text" size="28" tabindex="1" /><label for="inpName">名称(*)</label></p>
	<p><input type="text" name="inpEmail" id="inpEmail" class="text" size="28" tabindex="2" /><label for="inpEmail">邮箱</label></p>
	<p><input type="text" name="inpHomePage" id="inpHomePage" class="text" size="28" tabindex="3" /><label for="inpHomePage">网址</label></p>
{if $option['ZC_COMMENT_VERIFY_ENABLE']}
	<p><input type="text" name="inpVerify" id="inpVerify" class="text" value="" size="28" tabindex="4" /><img style="width:{$option['ZC_VERIFYCODE_WIDTH']}px;height:{$option['ZC_VERIFYCODE_HEIGHT']}px;cursor:pointer;" src="{$article.ValidCodeUrl}" alt="" title="" onclick="javascript:this.src='{$article.ValidCodeUrl}&amp;tm='+Math.random();" class="verifyimg" /><label for="inpVerify">验证码(*)</label></p>
{/if}
	</div>
{/if}
	<div class="comment_textarea">
	<p><label for="txaArticle">正文(*)(留言最长字数:1000)</label></p>
	<textarea style="width:518px;" name="txaArticle" id="txaArticle" placeholder="欢迎参与讨论，请在这里发表您的看法、交流您的观点。" cols="50" rows="4" tabindex="5"></textarea></div>
	<div class="comment_btn"><input name="sumbit" type="submit" tabindex="6" value="提交" onclick="return VerifyMessage()" class="button" /></div>
	</form>
	</div> 
    </div>
</div>