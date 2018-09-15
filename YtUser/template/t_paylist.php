{* Template Name: 购买列表*}
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>购买列表</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="{$host}zb_users/plugin/YtUser/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="{$host}zb_users/plugin/YtUser/layuiadmin/style/admin.css" media="all">
</head>
<body>
  
  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-header">购买列表</div>
          <div class="layui-card-body">
            <table class="layui-table">
              <colgroup>
                <col width="150">
                <col>
                <col width="200">
                <col width="150">
              </colgroup>
              <thead>
                <tr>
                  <th>ID</th>
                  <th>交易类型</th>
                  <th>订单编号</th>
                  <th>标题</th>
                  <th>交易日期</th>
                  <th>状态</th>
                </tr> 
              </thead>
              <tbody>
              {foreach $articles as $article}
                <tr>
                  <td>{$article.ID}</td>
                  <td>{if $article.isphysical}实物商品{else}虚拟物品{/if}</td>
                  <td>{$article.OrderID}</td>
                  <td><a target="_blank" href="{$article.Url}">{$article.Title}</a></td>
                  <td>{$article.PostTime}</td>
                  <td>{if $article.State}已支付
    {if $article.isphysical}
        {if $article.Express}
            已发货<a target="_blank" href="https://www.kuaidi100.com/chaxun?nu={$article.Express}">{$article.Express}</a>
        {else}
            未发货
        {/if}
    {else}
        虚拟商品
    {/if}
{else}
    <a href="{$host}{$zbp->Config('YtUser')->YtUser_buy}/{$article.LogID}">待支付</a>
{/if}
                </td>
                </tr>
                {/foreach}
              </tbody>
            </table>
            <div class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-2">{template:t_pagebar}</div>
          </div>
        </div>
      </div>

    </div>
  </div>
  
  <script src="{$host}zb_users/plugin/YtUser/layuiadmin/layui/layui.js"></script>  
  <script>
  layui.config({
    base: '{$host}zb_users/plugin/YtUser/layuiadmin/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use(['index']);
  </script>
</body>
</html>