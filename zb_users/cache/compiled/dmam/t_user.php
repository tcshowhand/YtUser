<?php  /* Template Name:文章和页面 */  ?>

<?php  include $this->GetTemplate('header');  ?>
<?php  include $this->GetTemplate('b_nav_top');  ?>
<aside id="pageside" class="dm-sider am-u-lg-2"> 
<?php if ($zbp->CheckPlugin('YtUser')) { ?><?php  include $this->GetTemplate('t_user_side');  ?><?php } ?>
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
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">个人资料</strong> / <small>Personal information</small></div>
      </div>
      <hr/>
	  
        <div class="am-u-sm-12 am-u-md-4 am-u-md-push-8">
		          <div class="am-panel am-panel-default">
 
			<div class="am-panel-bd">
          <p><span class="am-icon-bookmark"></span> 公告</p>
          <p><?php  echo $zbp->Config('dmam')->user_notice?$zbp->Config('dmam')->user_notice:'暂无公告';  ?></p>
        </div>
          </div>
		  
          <div class="am-panel am-panel-default">
            <div class="am-panel-bd">
				<ul class="dm-admin-avg3 am-avg-sm-1 am-avg-md-3 am-padding am-text-center admin-content-list ">
        <li><a href="<?php  echo $host;  ?>?Upgrade" class="am-text-success"><span class="am-icon-btn am-icon-user-md"></span><br>当前级别<br><?php  echo $lang['user_level_name'][$user->Level];  ?></a></li>
        <li><a href="<?php  echo $host;  ?>?Upgrade" class="am-text-warning"><span class="am-icon-btn am-icon-clock-o"></span><br>到期时间<br><?php  echo $user->Vipendtime;  ?></a></li>
        <li><a href="<?php  echo $zbp->host;  ?>?Integral" class="am-text-danger"><span class="am-icon-btn am-icon-star"></span><br>当前积分<br><?php  echo $user->Price;  ?></a></li>
      </ul>
            </div>
          </div>



        </div>
	  
	<div class="am-u-sm-12 am-u-md-8 am-padding-top-0 am-u-md-pull-4">
 
          <form id="edit" method="post" action="#" class="dm-admin-info am-form am-padding am-form-horizontal">
		      <input id="edtID" name="ID" type="hidden" value="<?php  echo $user->ID;  ?>" />
    <input id="edtGuid" name="Guid" type="hidden" value="<?php  echo $user->Guid;  ?>" />
            <div class="am-form-group">
              <label for="edtAlias" class="am-u-sm-3 am-form-label">姓名 / Name</label>
              <div class="am-u-sm-9">
                <input type="text" placeholder="姓名 / Name" id="edtAlias" name="Alias" value="<?php  echo $user->StaticName;  ?>">
                <small>输入你的名字，让我们记住你。</small>
              </div>
            </div>

            <div class="am-form-group">
              <label for="edtEmail" class="am-u-sm-3 am-form-label">电子邮件 / Email</label>
              <div class="am-u-sm-9">
                <input type="email" id="edtEmail" name="Email" value="<?php  echo $user->Email;  ?>" placeholder="输入你的电子邮件 / Email">
                <small>邮箱你懂得...</small>
              </div>
            </div>

            <div class="am-form-group">
              <label for="meta_Tel" class="am-u-sm-3 am-form-label">电话 / Telephone</label>
              <div class="am-u-sm-9">
                <input type="tel" id="meta_Tel" name="meta_Tel" value="<?php  echo $user->Metas->Tel;  ?>" placeholder="输入你的电话号码 / Telephone">
              </div>
            </div>

            <div class="am-form-group">
              <label for="meta_qq" class="am-u-sm-3 am-form-label">QQ</label>
              <div class="am-u-sm-9">
                <input type="number" pattern="[0-9]*" id="meta_qq" name="meta_qq" value="<?php  echo $user->Metas->qq;  ?>" placeholder="输入你的QQ号码">
              </div>
            </div>
            <div class="am-form-group">
              <label for="meta_txwb" class="am-u-sm-3 am-form-label">腾讯微博</label>
              <div class="am-u-sm-9">
                <input type="text" id="meta_txwb" name="meta_txwb" value="<?php  echo $user->Metas->txwb;  ?>" placeholder="输入你的腾讯微博网址">
              </div>
            </div>
            <div class="am-form-group">
              <label for="meta_xlwb" class="am-u-sm-3 am-form-label">新浪微博 / Weibo</label>
              <div class="am-u-sm-9">
                <input type="text" id="meta_xlwb" name="meta_xlwb" value="<?php  echo $user->Metas->xlwb;  ?>" placeholder="输入你的微博网址 / Weibo">
              </div>
            </div>
            <div class="am-form-group">
              <label for="meta_renren" class="am-u-sm-3 am-form-label">人人网</label>
              <div class="am-u-sm-9">
                <input type="text" id="meta_renren" name="meta_renren" value="<?php  echo $user->Metas->renren;  ?>" placeholder="输入你的人人网网址">
              </div>
            </div>
            <div class="am-form-group">
              <label for="edtIntro" class="am-u-sm-3 am-form-label">简介 / Intro</label>
              <div class="am-u-sm-9">
                <textarea class="" rows="5" id="edtIntro" name="Intro" placeholder="输入个人简介"><?php  echo $user->Intro;  ?></textarea>
                <small>250字以内写出你的一生...</small>
              </div>
            </div>
            <div class="am-form-group">
              <label for="verifycode" class="am-u-sm-3 am-form-label"><?php  echo $article->verifycode;  ?></label>
              <div class="am-u-sm-9">
                <input required="required" id="verifycode" type="text" name="verifycode">
                <small>验证码啊..呵呵。</small>
              </div>
            </div>
            <div class="am-form-group">
              <div class="am-u-sm-9 am-u-sm-push-3">
                <button type="button" id="btnPost" class="am-btn am-btn-primary" onclick="return checkInfo();">保存修改</button>
              </div>
            </div>
          </form>
<script type="text/javascript">function checkInfo(){
    $.post(bloghost+'zb_users/plugin/YtUser/cmd.php?act=MemberPst&token=<?php  echo $zbp->GetToken();  ?>',
        {
        "ID":$("input[name='ID']").val(),
        "Guid":$("input[name='Guid']").val(),
        "Alias":$("input[name='Alias']").val(),
        "meta_Tel":$("input[name='meta_Tel']").val(),
        "meta_qq":$("input[name='meta_Add']").val(),
		"meta_txwb":$("input[name='meta_Add']").val(),
		"meta_xlwb":$("input[name='meta_Add']").val(),
		"meta_renren":$("input[name='meta_Add']").val(),
        "Email":$("input[name='Email']").val(),
        "HomePage":$("input[name='HomePage']").val(),
        "Intro":$("textarea[name='Intro']").val(),
        "verifycode":$("input[name='verifycode']").val(),
        },
        function(data){
            var s =data;
            if((s.search("faultCode")>0)&&(s.search("faultString")>0))
            {
            alert(s.match("<string>.+?</string>")[0].replace("<string>","").replace("</string>",""));
            $("#reg_verfiycode").attr("src",bloghost+"zb_system/script/c_validcode.php?id=User&amp;tm="+Math.random());
            }
            else{
                var s =data;
                alert(s);
                window.location=bloghost+'?User';
            }
        }
    );
}
</script>
    </div>
	 </div>
  </div>
	</div>
<?php  include $this->GetTemplate('footer');  ?>
