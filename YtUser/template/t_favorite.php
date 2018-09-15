{* Template Name: 我的收藏*}
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>我的收藏</title>
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
          <div class="layui-card-header">我的收藏</div>
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
                  <th>文章标题</th>
                  <th>分类</th>
                  <th>收藏日期</th>
                  <th>操作</th>
                </tr> 
              </thead>
              <tbody>
              {foreach $articles as $article}
                <tr>
                  <td>{$article.Pid}</td>
                  <td><a target="_blank" href="{$article.Url}">{$article.Title}</a></td>
                  <td><a target="_blank" href="{$article.Category.Url}">{$article.Category.Name}</a></td>
                  <td>{$article.Time('Y年m月d日')}</td>
                  <td><a type="button" onclick="return window.confirm('单击“确定”继续。单击“取消”停止。');" href="javascript:YtFavorite('del',{$article.Pid},$('#myfav-{$article.Pid}'));">删除</a></td>
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