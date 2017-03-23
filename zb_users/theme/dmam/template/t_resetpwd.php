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
	  <label for="verifycode" class="am-u-sm-3 am-form-label">{$article.verifycode}</label>
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
{template:footer}