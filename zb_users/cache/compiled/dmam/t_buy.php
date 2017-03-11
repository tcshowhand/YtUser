<?php  /* Template Name:购买状态 */  ?>

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
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">购买状态</strong> / <small>Good state</small></div>
      </div>
      <hr/>
	  
        <div class="am-u-sm-12 am-u-md-4 am-u-md-push-8">
		          <div class="am-panel am-panel-default">
 
			<div class="am-panel-bd">
          <p><span class="am-icon-bookmark"></span> 公告</p>
          <p><?php  echo $zbp->Config('dmam')->user_notice?$zbp->Config('dmam')->user_notice:'暂无公告';  ?></p>
        </div>
          </div>
		  
          <div class="am-panel am-panel-default">
            <div class="am-panel-bd">
				<ul class="dm-admin-avg3 am-avg-sm-1 am-avg-md-3 am-padding am-text-center admin-content-list ">
        <li><a href="<?php  echo $host;  ?>?Upgrade" class="am-text-success"><span class="am-icon-btn am-icon-user-md"></span><br>当前级别<br><?php  echo $lang['user_level_name'][$user->Level];  ?></a></li>
        <li><a href="<?php  echo $host;  ?>?Upgrade" class="am-text-warning"><span class="am-icon-btn am-icon-clock-o"></span><br>到期时间<br><?php  echo $user->Vipendtime;  ?></a></li>
        <li><a href="<?php  echo $zbp->host;  ?>?Integral" class="am-text-danger"><span class="am-icon-btn am-icon-star"></span><br>当前积分<br><?php  echo $user->Price;  ?></a></li>
      </ul>
            </div>
          </div>
        </div>
	  
	<div class="am-u-sm-12 am-u-md-8 am-padding-top-0 am-u-md-pull-4">
 
          <form id="edit" method="post" action="#" class="dm-admin-info am-form am-padding am-form-horizontal">
<input type="hidden" name="LogID" id="LogID" value="<?php  echo $article->BuyID;  ?>" />
<input type="hidden" name="LogUrl" id="LogUrl" value="<?php  echo $article->BuyTUrl;  ?>" />
            <div class="am-form-group">
              <label for="edtAlias" class="am-u-sm-3 am-form-label">名称 / Title</label>
              <div class="am-u-sm-9">
                <p><?php  echo $article->BuyTitle;  ?></p>
              </div>
            </div>
            <div class="am-form-group">
              <label for="edtAlias" class="am-u-sm-3 am-form-label">价格 / Price</label>
              <div class="am-u-sm-9">
                <p><?php  echo $article->BuyPrice;  ?></p>
              </div>
            </div>
            <div class="am-form-group">
              <label for="edtAlias" class="am-u-sm-3 am-form-label">余额 / Remaining balance</label>
              <div class="am-u-sm-9">
                <p><?php  echo $user->Price;  ?></p>
              </div>
            </div>
			
<?php if ($article->buynum) { ?>
            <div class="am-form-group">
              <label for="edtAlias" class="am-u-sm-3 am-form-label">状态 / Remaining balance</label>
              <div class="am-u-sm-9">
                <p class="am-text-success">已购买</p>
              </div>
            </div>
<?php }else{  ?>
             <div class="am-form-group">
              <label for="verifycode" class="am-u-sm-3 am-form-label"><?php  echo $article->verifycode;  ?></label>
              <div class="am-u-sm-9">
                <input required="required" id="verifycode" type="text" name="verifycode">
                <small>验证码啊..呵呵。</small>
              </div>
            </div>
            <div class="am-form-group">
              <div class="am-u-sm-9 am-u-sm-push-3">
                <button type="button" id="btnPost" class="am-btn am-btn-primary am-text-danger" onclick="return Ytbuypay();">付款</button>
              </div>
            </div>
<?php } ?>
			</form>
    </div>
	 </div>
  </div>
	</div>
<?php  include $this->GetTemplate('footer');  ?>