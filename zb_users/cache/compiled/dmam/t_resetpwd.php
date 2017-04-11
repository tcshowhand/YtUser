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
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">密码找回</strong> / <small>Password</small></div>
      </div>

      <hr>
      <div class="am-g am-padding am-padding-top-0">
  <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">

      <div class="am-form">

      <label for="edtUserName">用户名:</label>
      <input type="text" id="edtUserName" name="name" placeholder="Username">
      </br>
      <label for="edtEmail">邮箱:</label>
      <input type="Email" id="edtEmail" name="email" placeholder="Email">
      </br>
	  <label for="verifycode" class="am-u-sm-3 am-form-label"><?php  echo $article->verifycode;  ?></label>
	  <input required="required" id="verifycode" type="text" name="verifycode">
		</br>
	  
	  
      <div class="am-cf">
        <input type="submit" onclick="return resetpwd()" class="am-btn am-btn-primary am-btn-sm am-fl">
       <small class="am-fr am-text-danger">提交后记得去查看邮件</small>
      </div>
      </div>

  </div>

      </div>
    </div>
  </div>
	</div>
<?php  include $this->GetTemplate('footer');  ?>