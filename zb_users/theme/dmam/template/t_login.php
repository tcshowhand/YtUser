{* Template Name:登录 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">打开这个网页的是傻逼</h2>吼吼!</div>';die();?>
{template:header}
{template:b_nav_top}
<aside id="pageside" class="dm-sider am-u-lg-2"> 
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
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">登录</strong> / <small>Login</small></div>
      </div>

      <hr>
      <div class="am-g am-padding am-padding-top-0">
  <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
    <div class="am-btn-group">
<div class="ds-login"></div>
   
    </div>
    <br> <br>



      <div class="am-form">




      <label for="edtUserName">用户名:</label>
      <input type="text" id="edtUserName" name="edtUserName" placeholder="Username">
      <br>
      <label for="edtPassWord">密码:</label>
      <input type="password" id="edtPassWord" name="edtPassWord" placeholder="Password">
      <br>
      <label for="chkRemember">
        <input type="checkbox" id="chkRemember" name="chkRemember" >
        记住密码
      </label>
      <br />
      <div class="am-cf">
        <input type="submit" id="loginbtnPost" name="loginbtnPost" onclick="return Ytuser_Login()" class="am-btn am-btn-primary am-btn-sm am-fl">
       <small class="am-fr"><a href="{$host}zb_users/theme/dmam/login.php">管理员？</a> / <a href="{$host}?Resetpwd">忘记密码？</a></small>
      </div>
      </div>

  </div>

      </div>
    </div>
  </div>
	</div>
{template:footer}