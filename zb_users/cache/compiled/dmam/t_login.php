<?php  /* Template Name:登录 */  ?>

<?php  include $this->GetTemplate('header');  ?>
<?php  include $this->GetTemplate('b_nav_top');  ?>
<aside id="pageside" class="dm-sider am-u-lg-2"> 
	<?php if ($zbp->Config('dmam')->page_navi) { ?>
		<dl>
		<dd>
		<ul class="am-nav">
		<?php  echo $zbp->Config('dmam')->page_navi;  ?>
		</ul>
		</dd>
		</dl>
	<?php } ?>
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
       <small class="am-fr"><a href="<?php  echo $host;  ?>zb_users/theme/dmam/login.php">管理员？</a> / <a href="<?php  echo $host;  ?>?Resetpwd">忘记密码？</a></small>
      </div>
      </div>

  </div>

      </div>
    </div>
  </div>
	</div>
<?php  include $this->GetTemplate('footer');  ?>