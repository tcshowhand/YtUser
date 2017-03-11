<div class="clear"></div>
<footer class="footer">
	<div class="foot container">
<?php if ($type=='index' || $zbp->Config('mochu')->onlink=='1') { ?>	
		<div class="footlink">
			<ul>
				<li><strong>友情链接：</strong></li>
				<?php  if(isset($modules['link'])){echo $modules['link']->Content;}  ?>
			</ul>
			<div class="clear"></div>
		</div>
<?php } ?>		
		<div class="footcont">
			<div class="footcont-lf lf">
				<p>博客相关：</p>
				<ul>
					<?php  echo $zbp->Config('mochu')->postpage;  ?>
					<div class="clear"></div>
				</ul>				
				<span>Powered By <?php  echo $zblogphpabbrhtml;  ?> | <?php  echo $copyright;  ?></span>
			</div>
			<div class="footcont-lr lr">
				<p>欢迎您关注我：</p>
				<div class="footcont-lr-cont">
					<div class="footcont-lr-cont-img lf">
        <img src="<?php  echo $host;  ?>zb_users/cache/mochuimg/erweio.png" alt="关注我的微信二维码" title="关注我的微信二维码" />
					</div>
					<div class="footcont-lr-cont-a lf">
					<?php  echo $zbp->Config('mochu')->postlian;  ?>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</footer>
<?php if ($zbp->Config('mochu')->postguon=="1") { ?><div id="tbox">
 <a id="pinglun" title="QQ联系我" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php  echo $zbp->Config('mochu')->postguqq;  ?>&amp;site=qq&amp;menu=yes" target="_blank" rel="nofollow"><i class="fa fa-qq"></i></a> 
 <a id="xiangguan" title="给我留言" href="<?php  echo $zbp->Config('mochu')->postguping;  ?>" target="_blank"><i class="fa fa-comments"></i></a> 
 <a id="gotop" title="返回顶部" href="javascript:void(0)" style="display: inline-block;"><i class="fa fa-arrow-up"></i></a> </div><?php } ?> 
<div id="dengdiv"><div id="t-bei" ></div>
<div id="t-opo"><a href="javascript:void(0)" id="tcaguan" ><i class="fa fa-times"></i></a><div id="t-opo-title"><i class="fa fa-user"></i>  登录</div><div id="t-opo-content">
		<div class="cp-hello">
 <form method="post" action="#" id="dengform">
      		<h6 class="username"><i class="fa fa-user"></i><input type="text" id="edtUserName" name="edtUserName" size="20" value="" tabindex="1" placeholder="用户名"  />		
			</h6>
     		 <h6 class="password"><i class="fa fa-lock"></i><input type="password" id="edtPassWord" name="edtPassWord" size="20" tabindex="2" placeholder="密码"  />
			 </h6>
   			<div class="btnpost">
      <input type="checkbox"  name="chkRemember" id="chkRemember"  tabindex="98" /><label for="chkRemember">保持登录</label>
      <input id="btnPost" name="btnPost" class="lr"  type="submit" value="登录" class="button" tabindex="99"/>
    		</div>
	<input type="hidden" name="username" id="username" value="" />
	<input type="hidden" name="password" id="password" value="" />
	<input type="hidden" name="savedate" id="savedate" value="0" />
    </form>
	</div>
<span class="cp-login"><a href="<?php  echo $host;  ?>zb_system/cmd.php?act=login"></a></span>&nbsp;&nbsp;<span class="cp-vrs"><a href="<?php  echo $host;  ?>zb_system/cmd.php?act=misc&amp;type=vrs"></a></span></div></div></div>
<div id="dashang"><div id="t-bei" ></div><div id="t-opo"><a href="javascript:void(0)" id="tca" ><i class="fa fa-times"></i></a><div id="t-opo-title"><i class="fa fa-credit-card"></i>  选择打赏方式</div><div id="t-opo-content"><div class="ds-payment-way"><label for="wechat"><input type="radio" id="wechat" class="reward-radio" value="0" checked="checked" name="reward-way" />微信</label><label for="qqqb"><input type="radio" id="qqqb" class="reward-radio" value="1" name="reward-way" />QQ钱包</label><label for="alipay"><input type="radio" id="alipay" class="reward-radio" value="2" name="reward-way" />支付宝</label></div><div class="ds-payment-img"> <div class="qrcode-img qrCode_0" id="qrCode_0"><div class="qrcode-border box-size" style="border: 9.02px solid rgb(60, 175, 54"><img  class="qrcode-img qrCode_0" id="qrCode_0" src="/zb_users/cache/mochuimg/zanwei.png" /></div><p class="qrcode-tip">打赏</p></div><div class="qrcode-img qrCode_1" id="qrCode_1"><div class="qrcode-border box-size" style="border: 9.02px solid rgb(102, 153, 204"><img  class="qrcode-img qrCode_1" id="qrCode_1" src="/zb_users/cache/mochuimg/qq.png" /></div><p class="qrcode-tip">打赏</p> </div> <div class="qrcode-img qrCode_2" id="qrCode_2"><div class="qrcode-border box-size" style="border: 9.02px solid rgb(235, 95, 1"><img  class="qrcode-img qrCode_2" id="qrCode_2" src="/zb_users/cache/mochuimg/zanzhi.png" /></div><p class="qrcode-tip">打赏</p></div></div></div></div></div>
<script src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/script/mochu_feiniaomy.js" type="text/javascript"></script>
<?php if ($zbp->Config('mochu')->onhuandeng=="1" ) { ?>
<script src="<?php  echo $host;  ?>zb_users/theme/mochu/script/slides.js" type="text/javascript"></script>
<?php } ?>
<?php  echo $footer;  ?>
<?php if ($zbp->Config('mochu')->ontuisong=="1") { ?><?php  echo $zbp->Config('mochu')->posttuisong;  ?><?php } ?>
</body>
</html>