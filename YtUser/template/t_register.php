<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>注册 - {$name}</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="{$host}zb_users/plugin/YtUser/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="{$host}zb_users/plugin/YtUser/layuiadmin/style/admin.css" media="all">
  <link rel="stylesheet" href="{$host}zb_users/plugin/YtUser/layuiadmin/style/login.css" media="all">
</head>
<body style="background: url(https://qq.ytecn.com/upload/admin/20180331/66cf88ccf7e6bd5d848b9d1890d619c9.jpg) center ;background-size: cover;-webkit-background-size: cover;-moz-background-size: cover;  -o-background-size: cover;">
  <div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;">
    <div class="layadmin-user-login-main">
      <div class="layadmin-user-login-box layadmin-user-login-header">
        <h2>{$name}</h2>
        <p>注册会员</p>
      </div>
      <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
        <div class="layui-form-item">
          <label class="layadmin-user-login-icon layui-icon layui-icon-cellphone" for="LAY-user-login-cellphone"></label>
          <input type="text" name="name" id="LAY-user-login-cellphone" lay-verify="phone" placeholder="手机" class="layui-input">
        </div>

        <div class="layui-form-item">
          <div class="layui-row">
            <div class="layui-col-xs7">
              <label class="layadmin-user-login-icon layui-icon layui-icon-vercode" for="LAY-user-login-vercode"></label>
              <input type="text" name="verifycode" id="LAY-user-login-vercode" lay-verify="required" placeholder="验证码" class="layui-input">
            </div>
            <div class="layui-col-xs5">
              <div style="margin-left: 10px;">
                {$article.verifycode}
              </div>
            </div>
          </div>
        </div>

        <div class="layui-form-item">
          <div class="layui-row">
            <div class="layui-col-xs7">
              <label class="layadmin-user-login-icon layui-icon layui-icon-vercode" for="LAY-user-login-mobilecode"></label>
              <input type="text" name="mobilecode" id="LAY-user-login-mobilecode" lay-verify="required" placeholder="手机验证码" class="layui-input">
            </div>
            <div class="layui-col-xs5">
              <div style="margin-left: 10px;">
                <button type="button" class="layui-btn layui-btn-primary layui-btn-fluid" id="LAY-user-getsmscode">获取验证码</button>
              </div>
            </div>
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layadmin-user-login-icon layui-icon layui-icon-password" for="LAY-user-login-password"></label>
          <input type="password" name="password" id="LAY-user-login-password" lay-verify="pass" placeholder="密码" class="layui-input">
        </div>
        <div class="layui-form-item">
          <label class="layadmin-user-login-icon layui-icon layui-icon-password" for="LAY-user-login-repass"></label>
          <input type="password" name="repassword" id="LAY-user-login-repass" lay-verify="required" placeholder="确认密码" class="layui-input">
        </div>
        {if $zbp->Config('YtUser')->inv_on==1}
        <input type="hidden" name="rootid" id="rootid" value="{$article.u}" />
        {/if}

        <div class="layui-form-item">
          <input type="checkbox" name="agreement" lay-skin="primary" title="同意用户协议" checked>
        </div>
        <div class="layui-form-item">
          <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="LAY-user-reg-submit">注 册</button>
        </div>
        <div class="layui-trans layui-form-item layadmin-user-login-other">
          {if $zbp->Config('YtUser')->appkey !=""}
          <label>社交账号登入</label>
          <a href="{$host}zb_users/plugin/YtUser/login.php"><i class="layui-icon layui-icon-login-qq"></i></a>
          {/if}
          <a href="{$host}{$zbp->Config('YtUser')->YtUser_Login}" class="layadmin-user-jump-change layadmin-link layui-hide-xs">用已有帐号登入</a>
          <a href="{$host}{$zbp->Config('YtUser')->YtUser_Login}" class="layadmin-user-jump-change layadmin-link layui-hide-sm layui-show-xs-inline-block">登入</a>
        </div>
      </div>
    </div>
    
    <div class="layui-trans layadmin-user-login-footer">
      <p>© 2018 <a href="https://www.ytecn.com/" target="_blank">豫唐网络</a></p>
    </div>

  </div>

  <script src="{$host}zb_users/plugin/YtUser/layuiadmin/layui/layui.js"></script>  
  <script>
    var  basehost= '{$host}'
    var  zbloghost= '{$host}zb_users/plugin/YtUser/'
  layui.config({
    base: '{$host}zb_users/plugin/YtUser/layuiadmin/'
  }).extend({
    index: 'lib/index' //主入口模块
  }).use(['index', 'user'], function(){
    var $ = layui.$
    ,setter = layui.setter
    ,admin = layui.admin
    ,form = layui.form
    ,router = layui.router();
    form.render();
    form.on('submit(LAY-user-reg-submit)', function(obj){
      var field = obj.field;
      if(field.password !== field.repassword){
        return layer.msg('两次密码输入不一致！');
      }
      
      if(!field.agreement){
        return layer.msg('你必须同意用户协议才能注册');
      }
      
      admin.req({
        url: zbloghost + 'register.php'
        ,type:'post'
        ,data: {
          "mobile":$("input[name='name']").val(),
          "mobilecode":$("input[name='mobilecode']").val(),
          "password":$("input[name='password']").val(),
          "repassword":$("input[name='repassword']").val(),
          "rootid":$("input[name='rootid']").val(),
        }
        ,done: function(res){
          layer.msg('注册成功', {
            offset: '15px'
            ,icon: 1
            ,time: 1000
          }, function(){
            location.href = '{$host}{$zbp->Config('YtUser')->YtUser_User}';
          });
        },
        error:function(res){
            layer.msg($(res.responseText).find('member value string').text());
        }
      });
      
      return false;
    });
  });
  </script>
</body>
</html>