<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>用户中心 {$name}</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="{$host}zb_users/plugin/YtUser/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="{$host}zb_users/plugin/YtUser/layuiadmin/style/admin.css" media="all">
</head>
<body class="layui-layout-body">
  <div id="LAY_app">
    <div class="layui-layout layui-layout-admin">
      <div class="layui-header">
        <!-- 头部区域 -->
        <ul class="layui-nav layui-layout-left">
          <li class="layui-nav-item layadmin-flexible" lay-unselect>
            <a href="javascript:;" layadmin-event="flexible" title="侧边伸缩">
              <i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
            </a>
          </li>
          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="{$host}" target="_blank" title="前台">
              <i class="layui-icon layui-icon-website"></i>
            </a>
          </li>
          <li class="layui-nav-item" lay-unselect>
            <a href="javascript:;" layadmin-event="refresh" title="刷新">
              <i class="layui-icon layui-icon-refresh-3"></i>
            </a>
          </li>
          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <input type="text" placeholder="搜索..." autocomplete="off" class="layui-input layui-input-search" layadmin-event="serach" lay-action="{$host}search.php?q="> 
          </li>
        </ul>
        <ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">
          
          <li class="layui-nav-item" lay-unselect>
            <a lay-href="app/message/index.html" layadmin-event="message" lay-text="消息中心">
              <i class="layui-icon layui-icon-notice"></i>  

              <span class="layui-badge-dot"></span>
            </a>
          </li>
          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="javascript:;" layadmin-event="theme">
              <i class="layui-icon layui-icon-theme"></i>
            </a>
          </li>
          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="javascript:;" layadmin-event="note">
              <i class="layui-icon layui-icon-note"></i>
            </a>
          </li>
          
          <li class="layui-nav-item" lay-unselect>
            <a href="javascript:;">
              <cite>{$user.StaticName}</cite>
            </a>
            <dl class="layui-nav-child">
              <dd><a lay-href="{$host}{$zbp->Config('YtUser')->YtUser_User}">基本资料</a></dd>
              <dd><a lay-href="{$host}{$zbp->Config('YtUser')->YtUser_Changepassword}">修改密码</a></dd>
              <hr>
              <dd style="text-align: center;"><a href="{BuildSafeCmdURL('act=logout')}">退出</a></dd>
            </dl>
          </li>
          
          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="javascript:;" layadmin-event="fullscreen">
              <i class="layui-icon layui-icon-screen-full"></i>
            </a>
          </li>
        </ul>
      </div>
      
      <!-- 侧边菜单 -->
      <div class="layui-side layui-side-menu">
        <div class="layui-side-scroll">
          <div class="layui-logo" lay-href="{$host}{$zbp->Config('YtUser')->YtUser_User}">
            <span>{$name}</span>
          </div>
          
          <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu">
            <li data-name="home" class="layui-nav-item layui-nav-itemed">
              <a href="javascript:;" lay-tips="主页" lay-direction="2">
                <i class="layui-icon layui-icon-home"></i>
                <cite>主页</cite>
              </a>
              <dl class="layui-nav-child">
                <dd data-name="console" class="layui-this">
                  <a lay-href="{$host}{$zbp->Config('YtUser')->YtUser_User}">用户中心</a>
                </dd>
                <dd data-name="console">
                  <a lay-href="{$host}{$zbp->Config('YtUser')->YtUser_Articleedt}">发布投稿</a>
                </dd>
                <dd data-name="console">
                  <a lay-href="{$host}{$zbp->Config('YtUser')->YtUser_Articlelist}">投稿列表</a>
                </dd>
                <dd data-name="console">
                  <a lay-href="{$host}{$zbp->Config('YtUser')->YtUser_Integral}">积分充值</a>
                </dd>
                <dd data-name="console">
                  <a lay-href="{$host}{$zbp->Config('YtUser')->YtUser_Upgrade}">VIP卡充值</a>
                </dd>
                <dd data-name="console">
                  <a lay-href="{$host}{$zbp->Config('YtUser')->YtUser_Paylist}">购买列表</a>
                </dd>
                <dd data-name="console">
                  <a lay-href="{$host}{$zbp->Config('YtUser')->YtUser_Commentlist}">评论列表</a>
                </dd>
                <dd data-name="console">
                  <a lay-href="{$host}{$zbp->Config('YtUser')->YtUser_Changepassword}">修改密码</a>
                </dd>
                <dd data-name="console">
                  <a lay-href="{$host}{$zbp->Config('YtUser')->YtUser_Favorite}">收藏文章</a>
                </dd>
                <dd data-name="console">
                  <a lay-href="{$host}{$zbp->Config('YtUser')->YtUser_Binding}">绑定QQ</a>
                </dd>
                <dd data-name="console">
                  <a lay-href="{$host}{$zbp->Config('YtUser')->YtUser_Consume}">消费记录</a>
                </dd>
                <dd data-name="console">
                  <a lay-href="{$host}{$zbp->Config('YtUser')->YtUser_Certifi}">实名认证</a>
                </dd>
              </dl>
            </li>
            
          </ul>
        </div>
      </div>

      <!-- 页面标签 -->
      <div class="layadmin-pagetabs" id="LAY_app_tabs">
        <div class="layui-icon layadmin-tabs-control layui-icon-prev" layadmin-event="leftPage"></div>
        <div class="layui-icon layadmin-tabs-control layui-icon-next" layadmin-event="rightPage"></div>
        <div class="layui-icon layadmin-tabs-control layui-icon-down">
          <ul class="layui-nav layadmin-tabs-select" lay-filter="layadmin-pagetabs-nav">
            <li class="layui-nav-item" lay-unselect>
              <a href="javascript:;"></a>
              <dl class="layui-nav-child layui-anim-fadein">
                <dd layadmin-event="closeThisTabs"><a href="javascript:;">关闭当前标签页</a></dd>
                <dd layadmin-event="closeOtherTabs"><a href="javascript:;">关闭其它标签页</a></dd>
                <dd layadmin-event="closeAllTabs"><a href="javascript:;">关闭全部标签页</a></dd>
              </dl>
            </li>
          </ul>
        </div>
        <div class="layui-tab" lay-unauto lay-allowClose="true" lay-filter="layadmin-layout-tabs">
          <ul class="layui-tab-title" id="LAY_app_tabsheader">
            <li lay-id="{$host}{$zbp->Config('YtUser')->YtUser_User}" lay-attr="{$host}{$zbp->Config('YtUser')->YtUser_User}" class="layui-this"><i class="layui-icon layui-icon-home"></i></li>
          </ul>
        </div>
      </div>
      
      
      <!-- 主体内容 -->
      <div class="layui-body" id="LAY_app_body">
        <div class="layadmin-tabsbody-item layui-show">
          <iframe src="{$host}{$zbp->Config('YtUser')->YtUser_User}" frameborder="0" class="layadmin-iframe"></iframe>
        </div>
      </div>
      
      <!-- 辅助元素，一般用于移动设备下遮罩 -->
      <div class="layadmin-body-shade" layadmin-event="shade"></div>
    </div>
  </div>

  <script src="{$host}zb_users/plugin/YtUser/layuiadmin/layui/layui.js"></script>
  <script>
  layui.config({
    base: '{$host}zb_users/plugin/YtUser/layuiadmin/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use('index');
  </script>
</body>
</html>