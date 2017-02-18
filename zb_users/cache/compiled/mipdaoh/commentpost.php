<div class="commentpost" id="comment">
    <h4><span><?php if ($user->ID>0) { ?><?php  echo $user->Name#;  ?><?php } ?><a rel="nofollow" id="cancel-reply" href="#comment" style="display:none;"><small>取消回复</small></a></span>发表评论</h4>
	<form id="frmSumbit" target="_self" method="post" action="<?php  echo $article->CommentPostUrl;  ?>" >
	<input type="hidden" name="inpId" id="inpId" value="<?php  echo $article->ID;  ?>" />
	<input type="hidden" name="inpRevID" id="inpRevID" value="0" />
<?php if ($user->ID>0) { ?>
	<input type="hidden" name="inpName" id="inpName" value="<?php  echo $user->Name;  ?>" />
	<input type="hidden" name="inpEmail" id="inpEmail" value="<?php  echo $user->Email;  ?>" />
	<input type="hidden" name="inpHomePage" id="inpHomePage" value="<?php  echo $user->HomePage;  ?>" />	
<?php }else{  ?>
	<p><label for="name">名 称</label><input type="text" name="inpName" id="inpName" class="text" value="<?php  echo $user->Name;  ?>" size="28" tabindex="1" /><font color="#ff6f3d">必填</font></p>
	<p><label for="email">邮 箱</label><input type="text" name="inpEmail" id="inpEmail" class="text" value="<?php  echo $user->Email;  ?>" size="28" tabindex="2" />选填</p>
	<p><label for="homepage">网 址</label><input type="text" name="inpHomePage" id="inpHomePage" class="text" value="<?php  echo $user->HomePage;  ?>" size="28" tabindex="3" />选填</p>
<?php if ($option['ZC_COMMENT_VERIFY_ENABLE']) { ?>
	<p><label for="inpVerify">验证码</label><input type="text" name="inpVerify" id="inpVerify" value="" size="28" tabindex="5" /><img src="<?php  echo $article->ValidCodeUrl;  ?>" class="verifyimg" onclick="javascript:this.src='<?php  echo $article->ValidCodeUrl;  ?>&amp;tm='+Math.random();" /> <font color="#ff6f3d">必填</font></p>
<?php } ?>

<?php } ?>
	<!--verify-->
	<p><textarea name="txaArticle" id="txaArticle" class="text" cols="50" rows="4" tabindex="5" ></textarea></p>
	<p><input name="sumbit" type="submit" tabindex="6" value="提交" onclick="return VerifyMessage()" class="button" />◎欢迎参与讨论，请在这里发表您的看法、交流您的观点。</p>
	</form>
</div>