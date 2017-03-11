{* Template Name:购买状态 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">打开这个网页的是傻逼</h2>吼吼!</div>';die();?>
{template:header}
{template:b_nav_top}
<aside id="pageside" class="dm-sider am-u-lg-2"> 
{if $zbp->CheckPlugin('YtUser')}{template:t_user_side}{/if}
	{if $zbp->Config('dmam')->page_navi}
		<dl>
		<dd>
		<ul class="am-nav">
		{$zbp->Config('dmam')->page_navi}
		</ul>
		</dd>
		</dl>
	{/if}
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
          <p>{$zbp->Config('dmam')->user_notice?$zbp->Config('dmam')->user_notice:'暂无公告'}</p>
        </div>
          </div>
		  
          <div class="am-panel am-panel-default">
            <div class="am-panel-bd">
				<ul class="dm-admin-avg3 am-avg-sm-1 am-avg-md-3 am-padding am-text-center admin-content-list ">
        <li><a href="{$host}?Upgrade" class="am-text-success"><span class="am-icon-btn am-icon-user-md"></span><br>当前级别<br>{$lang['user_level_name'][$user.Level]}</a></li>
        <li><a href="{$host}?Upgrade" class="am-text-warning"><span class="am-icon-btn am-icon-clock-o"></span><br>到期时间<br>{$user.Vipendtime}</a></li>
        <li><a href="{$zbp->host}?Integral" class="am-text-danger"><span class="am-icon-btn am-icon-star"></span><br>当前积分<br>{$user.Price}</a></li>
      </ul>
            </div>
          </div>
        </div>
	  
	<div class="am-u-sm-12 am-u-md-8 am-padding-top-0 am-u-md-pull-4">
 
          <form id="edit" method="post" action="#" class="dm-admin-info am-form am-padding am-form-horizontal">
<input type="hidden" name="LogID" id="LogID" value="{$article.BuyID}" />
<input type="hidden" name="LogUrl" id="LogUrl" value="{$article.BuyTUrl}" />
            <div class="am-form-group">
              <label for="edtAlias" class="am-u-sm-3 am-form-label">名称 / Title</label>
              <div class="am-u-sm-9">
                <p>{$article.BuyTitle}</p>
              </div>
            </div>
            <div class="am-form-group">
              <label for="edtAlias" class="am-u-sm-3 am-form-label">价格 / Price</label>
              <div class="am-u-sm-9">
                <p>{$article.BuyPrice}</p>
              </div>
            </div>
            <div class="am-form-group">
              <label for="edtAlias" class="am-u-sm-3 am-form-label">余额 / Remaining balance</label>
              <div class="am-u-sm-9">
                <p>{$user.Price}</p>
              </div>
            </div>
			
{if $article.buynum}
            <div class="am-form-group">
              <label for="edtAlias" class="am-u-sm-3 am-form-label">状态 / Remaining balance</label>
              <div class="am-u-sm-9">
                <p class="am-text-success">已购买</p>
              </div>
            </div>
{else}
             <div class="am-form-group">
              <label for="verifycode" class="am-u-sm-3 am-form-label">{$article.verifycode}</label>
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
{/if}
			</form>
    </div>
	 </div>
  </div>
	</div>
{template:footer}