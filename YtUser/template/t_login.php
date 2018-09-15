<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>登入 - {$name}</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="{$host}zb_users/plugin/YtUser/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="{$host}zb_users/plugin/YtUser/layuiadmin/style/admin.css" media="all">
  <link rel="stylesheet" href="{$host}zb_users/plugin/YtUser/layuiadmin/style/login.css" media="all">
  <script src="{$host}zb_system/script/md5.js" type="text/javascript"></script>
</head>
<body style="background: url(https://qq.ytecn.com/upload/admin/20180331/66cf88ccf7e6bd5d848b9d1890d619c9.jpg) center ;background-size: cover;-webkit-background-size: cover;-moz-background-size: cover;  -o-background-size: cover;">
  <div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;">
    <div class="layadmin-user-login-main">
      <div class="layadmin-user-login-box layadmin-user-login-header">
        <h2>{$name}</h2>
        <p>会员登录</p>
      </div>
      <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
        <div class="layui-form-item">
          <label class="layadmin-user-login-icon layui-icon layui-icon-username" for="LAY-user-login-username"></label>
          <input type="text" name="edtUserName" id="LAY-user-login-username" lay-verify="required" placeholder="用户名" class="layui-input">
        </div>
        <div class="layui-form-item">
          <label class="layadmin-user-login-icon layui-icon layui-icon-password" for="LAY-user-login-password"></label>
          <input type="password" name="edtPassWord" id="LAY-user-login-password" lay-verify="required" placeholder="密码" class="layui-input">
        </div>
        <div class="layui-form-item" style="margin-bottom: 20px;">
            <input type="checkbox" name="chkRemember" lay-skin="primary" title="记住密码">
          <a href="forget.html" class="layadmin-user-jump-change layadmin-link" style="margin-top: 7px;">忘记密码？</a>
        </div>
        <div class="layui-form-item">
          <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="LAY-user-login-submit">登 入</button>
        </div>
        <div class="layui-trans layui-form-item layadmin-user-login-other">
          {if $zbp->Config('YtUser')->appkey !=""}
          <label>社交账号登入</label>
          <a href="{$host}zb_users/plugin/YtUser/login.php"><i class="layui-icon layui-icon-login-qq"></i></a>
          {/if}
          <a href="{$host}{$zbp->Config('YtUser')->YtUser_Register}" class="layadmin-user-jump-change layadmin-link">注册帐号</a>
        </div>
      </div>
    </div>
    <div class="layui-trans layadmin-user-login-footer">
      <p>© 2018 <a href="https://www.ytecn.com/" target="_blank">豫唐网络</a></p>
    </div>
  </div>

  <script src="{$host}zb_users/plugin/YtUser/layuiadmin/layui/layui.js"></script>  
  <script>
  var  zbloghost= '{$host}zb_users/plugin/YtUser/'
  layui.config({
    base: '{$host}zb_users/plugin/YtUser/layuiadmin/'
  }).extend({
    index: 'lib/index'
  }).use(['index', 'user'], function(){
    var $ = layui.$
    ,setter = layui.setter
    ,admin = layui.admin
    ,form = layui.form
    ,router = layui.router()
    ,search = router.search;
    form.render();
    //提交
    form.on('submit(LAY-user-login-submit)', function(obj){
        admin.req({
        url: zbloghost + 'cmd.php?act=verify'
        ,type:'post'
        ,data: {
          "verifycode":$("input[name='verifycode']").val(),
          "username":$("input[name='edtUserName']").val(),
          "edtPassWord":MD5($("input[name='edtPassWord']").val()),
          "strSaveDate":$("input[name='chkRemember']").val(),
        }
        ,done: function(res){     
            layer.msg('登入成功', {
            offset: '15px'
            ,icon: 1
            ,time: 1000
            }, function(){
                location.href = "{$host}{$zbp->Config('YtUser')->YtUser_Index}";
            });
        },
        error:function(res){
            layer.msg($(res.responseText).find('member value string').text());
        }
      });

    });
    
  });
  </script>
</body>
</html>