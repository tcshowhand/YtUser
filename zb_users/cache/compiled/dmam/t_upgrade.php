<?php  /* Template Name:文章和页面 */  ?>

<?php  include $this->GetTemplate('header');  ?>
<?php  include $this->GetTemplate('b_nav_top');  ?>
<aside id="pageside" class="dm-sider am-u-lg-2"> 
<?php if ($zbp->CheckPlugin('YtUser')) { ?><?php  include $this->GetTemplate('t_user_side');  ?><?php } ?>
	<?php if ($zbp->Config('dmam')->page_navi) { ?>
		<dl>
		<dd>
		<ul class="am-nav">
		<?php  echo $zbp->Config('dmam')->page_navi;  ?>
		</ul>
		</dd>
		</dl>
	<?php } ?>
	</aside>
	<div class="dm-container am-u-lg-10">
<div class="admin-content">
    <div class="admin-content-body">
      <div class="am-cf am-padding am-padding-bottom-0">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">VIP月卡充值</strong> / <small>Intergral VIP</small></div>
      </div>
      <hr/>
	  
        <div class="am-u-sm-12 am-u-md-4 am-u-md-push-8">

		  
          <div class="am-panel am-panel-default">
            <div class="am-panel-bd">
				<ul class="dm-admin-avg3 am-avg-sm-1 am-avg-md-3 am-padding am-text-center admin-content-list ">
        <li><a href="<?php  echo $host;  ?>?Upgrade" class="am-text-success"><span class="am-icon-btn am-icon-user-md"></span><br>当前级别<br><?php  echo $lang['user_level_name'][$user->Level];  ?></a></li>
        <li><a href="<?php  echo $host;  ?>?Upgrade" class="am-text-warning"><span class="am-icon-btn am-icon-clock-o"></span><br>到期时间<br><?php  echo $user->Vipendtime;  ?></a></li>
        <li><a href="<?php  echo $zbp->host;  ?>?Integral" class="am-text-danger"><span class="am-icon-btn am-icon-star"></span><br>当前积分<br><?php  echo $user->Price;  ?></a></li>
      </ul>
            </div>
          </div>

		          <div class="am-panel am-panel-default">
 
			<div class="am-panel-bd">
          <p><span class="am-icon-bookmark"></span> 公告</p>
          <p><?php  echo $zbp->Config('dmam')->user_notice?$zbp->Config('dmam')->user_notice:'暂无公告';  ?></p>
        </div>
          </div>

        </div>
	  
	<div class="am-u-sm-12 am-u-md-8 am-padding-top-0 am-u-md-pull-4">
	
 <form cid="edit" name="edit" method="post" class="dm-admin-info am-form am-padding am-form-horizontal" action="#">
	<input id="edtID" name="ID" type="hidden" value="0">
	<input id="edtType" name="Type" type="hidden" value="0">
	<div class="am-form-group">
	<label for="invitecode" class="am-u-sm-3 am-form-label">VIP充值卡</label>
	<div class="am-u-sm-9">
	<input required="required" type="text" type="text" name="invitecode" id="invitecode" placeholder="卡密">
		<small><?php  echo $zbp->Config('YtUser')->readme_text;  ?></small>
	</div>
	</div>
	<div class="am-form-group">
	<label for="verifycode" class="am-u-sm-3 am-form-label"><?php  echo $article->verifycode;  ?></label>
	<div class="am-u-sm-9">
	<input type="text" id="verifycode" required="required" name="verifycode" placeholder="验证码">
	</div>
	</div>
	<div class="am-form-group">
	  <div class="am-u-sm-9 am-u-sm-push-3">
		<button type="button" onclick="return RegPage();" class="am-btn am-btn-primary">充值</button>
	  </div>
	</div>
</form>
    </div>
	 </div>
  </div>
	</div>
<?php  include $this->GetTemplate('footer');  ?>