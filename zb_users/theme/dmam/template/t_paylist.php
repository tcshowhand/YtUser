{* Template Name:购买列表 *}
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
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">购买列表</strong> / <small>My Goods</small></div>
      </div>

      <hr>
      <div class="am-g am-padding am-padding-top-0">
        <div class="am-u-sm-12">
          <form class="am-form">
            <table class="am-table am-table-striped am-table-hover table-main">
              <thead>
              <tr>
				<th width="5%">序号</th>
				<th width="25%">订单号</th>
				<th width="40%">名称</th>
				<th width="20%" class="table-date am-hide-sm-only">下单时间</th>
				<th width="10%">状态</th>
              </tr>
              </thead>
              <tbody>
             {foreach $articles as $key=>$article}
				 {$i = $key+1}
			 <tr>
                <td>{$i}</td>
				<td>{$article.OrderID}</td>
                <td><a href="{$article.Url}">{$article.Title}</a></td>
                <td class="am-hide-sm-only">{$article.PostTime}</td>
				{if $article.State}
				<td class="am-text-success">已支付</td>
				{else}
				<td><a class="am-text-danger" href="{$host}?buy&uid={$article.LogID}">未支付</a></td>
				{/if}
              </tr>
			  {/foreach}
              </tbody>
            </table>
            <div class="am-cf">
              <!-- 共 15 条记录 -->
              <div class="am-fr">
                <ul class="am-pagination">
                  {template:pagebar}
                </ul>
              </div>
            </div>
<!--             <hr>
            <p>注：.....</p> -->
          </form>
        </div>

      </div>
    </div>
  </div>
	</div>
{template:footer}