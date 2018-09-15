{* Template Name: VIP卡充值 *}
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>VIP卡充值</title>
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
          <div class="layui-card-header">VIP卡充值</div>
          <div class="layui-card-body">
          <div class="layui-col-md12">
            <div class="layui-card">
              <div class="layui-card-body">
              用户级别：{$lang['user_level_name'][$user.Level]}<br>
              {if $user.Level < 5}
              到期时间:{$user.Vipendtime}<br>
              {/if}
              页面介绍：{$zbp.Config('YtUser').readme_text}<br>
              </div>
            </div>
          </div>

            <form id="signup-form" class="layui-form" action="" lay-filter="component-form-element">
              <div class="layui-row layui-col-space10 layui-form-item">
                <div class="layui-col-lg12">
                  <label class="layui-form-label">充值卡：</label>
                  <div class="layui-input-block">
                    <input type="text" name="name" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                  </div>
                </div>
              </div>

            <div class="layui-form-item">
                <label class="layui-form-label">验证码：</label>
                <div class="layui-input-inline">
                    <input type="text" name="verifycode" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">{$article.verifycode}</div>
            </div>
              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit lay-filter="component-form-element">立即提交</button>
                  <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
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
  }).use(['index', 'form'], function(){
    var $ = layui.$
    ,admin = layui.admin
    ,element = layui.element
    ,form = layui.form;
    form.render(null, 'component-form-element');
    element.render('breadcrumb', 'breadcrumb');
    form.on('submit(component-form-element)', function(data){
        admin.req({
        url: zbloghost + 'Upgrade.php'
        ,type:'post'
        ,data:  $("#signup-form").serialize()
        ,done: function(res){
          layer.msg('修改成功', {
            offset: '15px'
            ,icon: 1
            ,time: 1000
          }, function(){
            location.href = '{$host}{$zbp->Config('YtUser')->YtUser_User}';
          });
        },
        error:function(res){
            layer.msg($(res.responseText).find('member value string').text());
            $("#reg_verfiycode").attr("src",basehost+"zb_system/script/c_validcode.php?id=RegPage&amp;tm="+Math.random());
        }
      });
      return false;
    });
  });
  </script>
</body>
</html>