{* Template Name:投稿 *}
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
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">投稿</strong> / <small>Contribute Articles</small></div>
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
 <form cid="edit" name="edit" method="post" class="dm-admin-info am-form am-padding am-form-horizontal" action="#">
	<input id="edtID" name="ID" type="hidden" value="0">
	<input id="edtType" name="Type" type="hidden" value="0">
	<div class="am-form-group">
	<label for="Title" class="am-u-sm-3 am-form-label">标题 / Title</label>
	<div class="am-u-sm-9">
	<input type="text" id="Title" placeholder="标题 / Title">
	</div>
	</div>
	<div class="am-form-group">
	<label for="edui1_iframeholder" class="am-u-sm-3 am-form-label">内容 / Content</label>
	<div class="am-u-sm-9">
	{$article.UEditor}
	<small>可识别html代码哦。</small>
	</div>
	</div>
	<div class="am-form-group">
	  <div class="am-u-sm-9 am-u-sm-push-3">
	 {if $user.Level<5}
		<button type="button" onclick="return checkArticleInfo();" class="am-btn am-btn-primary">提交保存</button>
	{else}
		<button type="button" class="am-btn am-btn-primary am-disabled">权限不够</button>
	{/if}
	  </div>
	</div>
</form>
    </div>
	 </div>
  </div>
	</div>
{template:footer}