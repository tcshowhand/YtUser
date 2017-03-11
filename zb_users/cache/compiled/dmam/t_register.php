<?php  /* Template Name:注册 */  ?>

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
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">注册</strong> / <small>Register</small></div>
      </div>

      <hr>
      <div class="am-g am-padding am-padding-top-0">
  <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
    <div class="am-btn-group">
<div class="ds-login"></div>
    
    </div>
    <br><br>
    <div class="am-form">
      <label for="name">用户名:</label>
      <input required="required" id="name" type="text" name="name">
      <br>
      <label for="password">密码:</label>
      <input required="required" id="password" type="password" name="password">
      <br>
      <label for="repassword">确认密码:</label>
      <input required="required" id="repassword" type="password" name="repassword">
      <br>
      <label for="email">邮箱:</label>
      <input required="required" id="email" type="text" name="email">
      <br>
        <label for="verifycode"><?php  echo $article->verifycode;  ?></label>
              <input required="required" id="verifycode" type="text" name="verifycode">
              <br />
        <div class="am-cf">
            <input type="submit" id="loginbtnPost" name="loginbtnPost" onclick="return register()" class="am-btn am-btn-primary am-btn-sm am-fl">
        </div>
    </div>
  </div>

      </div>
    </div>
  </div>
	</div>
<?php  include $this->GetTemplate('footer');  ?>