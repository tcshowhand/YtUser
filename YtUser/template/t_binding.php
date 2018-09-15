{* Template Name: 账号绑定 *}
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>账号绑定</title>
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
          <div class="layui-card-header">账号绑定</div>
          <div class="layui-card-body">
            <form id="signup-form" class="layui-form" action="" lay-filter="component-form-element">
              <div class="layui-form-item">
                {if $article.BindingQQ}
                    <blockquote class="layui-elem-quote">
                    此账户已绑定过QQ
                    </blockquote>
                {else}
                    <a target="_blank" href="{$host}zb_users/plugin/YtUser/login.php" class="layui-btn" >绑定QQ</a>
                {/if}
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script src="{$host}zb_users/plugin/YtUser/layuiadmin/layui/layui.js"></script>  

</body>
</html>