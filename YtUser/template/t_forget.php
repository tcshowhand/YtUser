{* Template Name: 个人资料 *}
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>修改资料</title>
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
          <div class="layui-card-header">修改资料</div>
          <div class="layui-card-body">
            <form id="signup-form" class="layui-form" action="" lay-filter="component-form-element">
            <input id="edtID" name="ID" type="hidden" value="{$user.ID}" />
            <input id="edtGuid" name="Guid" type="hidden" value="{$user.Guid}" />
              <div class="layui-row layui-col-space10 layui-form-item">
                <div class="layui-col-lg6">
                  <label class="layui-form-label">用户名：</label>
                  <div class="layui-input-block">
                    <input type="text" name="Alias" value="{$user.StaticName}" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                  </div>
                </div>
                <div class="layui-col-lg6">
                  <label class="layui-form-label">会员地址：</label>
                  <div class="layui-input-block">
                    <input type="text" name="meta_Add" value="{$user.Metas.Add}" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                  </div>
                </div>
              </div>
              <div class="layui-row layui-col-space10 layui-form-item">
                <div class="layui-col-lg6">
                  <label class="layui-form-label">邮箱：</label>
                  <div class="layui-input-block">
                    <input type="text" name="Email" value="{$user.Email}" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                  </div>
                </div>
                <div class="layui-col-lg6">
                  <label class="layui-form-label">网站：</label>
                  <div class="layui-input-block">
                    <input type="text" name="HomePage" value="{$user.HomePage}" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                  </div>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">摘要：</label>
                <div class="layui-input-block">
                  <textarea name="Intro" placeholder="" class="layui-textarea">{$user.Intro}</textarea>
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
        url: zbloghost + 'cmd.php?act=MemberPst&token={$zbp->GetToken()}'
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
            $("#reg_verfiycode").attr("src",basehost+"zb_system/script/c_validcode.php?id=User&amp;tm="+Math.random());
        }
      });
      return false;

    });
  });
  </script>
</body>
</html>