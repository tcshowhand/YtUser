<?php  /* Template Name:顶部导航 */  ?>

<?php 
$adminid = '';
if ($zbp->Config('dmam')->admin_id){
	$adminid = $zbp->Config('dmam')->admin_id; 
}
 ?>
<header id="dm-topbar" class="am-topbar">
<div class="topbar">
        <div class="container">
          <div class="am-g">

            <div class="am-u-md-12">
              <div class="topbar-right am-text-right am-fr">
                
				<?php if ($adminid) { ?>
				<?php if ($zbp->members[$adminid]->Metas->user_xlwb) { ?><a <?php  echo dmam_isblank(true);  ?> href="<?php  echo $zbp->members[$adminid]->Metas->user_xlwb;  ?>"><i class="am-icon-weibo"></i></a><?php } ?>
				<?php if ($zbp->members[$adminid]->Metas->user_txwb) { ?><a <?php  echo dmam_isblank(true);  ?> href="<?php  echo $zbp->members[$adminid]->Metas->user_txwb;  ?>"><i class="am-icon-tencent-weibo"></i></a><?php } ?>
				<?php if ($zbp->members[$adminid]->Metas->user_renren) { ?><a <?php  echo dmam_isblank(true);  ?> href="<?php  echo $zbp->members[$adminid]->Metas->user_renren;  ?>"><i class="am-icon-renren"></i></a><?php } ?>
				<?php if ($zbp->Config('dmam')->pics_qq) { ?><a href="javascript:void(0)" class="qq_button" data-am-modal="{target: '#qq-modal', closeViaDimmer: true, width: 200}" data-pic="<?php  echo $zbp->Config('dmam')->pics_qq;  ?>"><i class="am-icon-qq"></i></a><?php } ?>
				<?php if ($zbp->Config('dmam')->pics_wx) { ?><a href="javascript:void(0)" class="wx_button" data-am-modal="{target: '#wx-modal', closeViaDimmer: true, width: 200}" data-pic="<?php  echo $zbp->Config('dmam')->pics_wx;  ?>"><i class="am-icon-wechat"></i></a><?php } ?>
				<?php } ?>
				
<!-- 			<i class="am-icon-facebook"></i>
                <i class="am-icon-twitter"></i>
                <i class="am-icon-google-plus"></i>
                <i class="am-icon-pinterest"></i>
                <i class="am-icon-instagram"></i>
                <i class="am-icon-linkedin"></i>
                <i class="am-icon-youtube-play"></i>
                <i class="am-icon-rss"></i> -->

<?php if ($user->ID>0) { ?>
<div class="top_user">
<a href="<?php  echo $host;  ?>zb_system/admin/?act=admin">【<?php  echo $user->StaticName;  ?>】</a>
 </div>
<?php }else{  ?>
<div class="top_user">
	<?php if ($zbp->Config('dmam')->top_login) { ?>
		<?php if ($zbp->CheckPlugin('YtUser')) { ?>
		<a href="<?php  echo $host;  ?>?Login">登录</a>
		<a href="<?php  echo $host;  ?>?Register">注册</a>
		<?php }else{  ?>
		<a href="<?php  echo $host;  ?>zb_system/cmd.php?act=login">登录</a>
		<?php if ($zbp->CheckPlugin('RegPage')) { ?><a href="<?php  echo $host;  ?>?reg">注册</a><?php } ?>
		<?php } ?>
	<?php } ?>
 </div>
<?php } ?>

                
              </div>
            </div>
          </div>
        </div>
      </div>
<div class="am-container">
<?php 
$dm_logo='';
$dm_logo = $zbp->Config('dmam')->pics_logo?$zbp->Config('dmam')->pics_logo:$zbp->host.'zb_users/theme/dmam/style/images/logo.png';
 ?>

	<?php if ($type == 'article') { ?>
	<div class="am-topbar-brand"><a title="<?php  echo $name;  ?>-<?php  echo $title;  ?>" href="<?php  echo $host;  ?>"><img alt="<?php  echo $name;  ?>-<?php  echo $title;  ?>" src="<?php  echo $dm_logo;  ?>"><?php  echo $name;  ?>-<?php  echo $title;  ?></a></div>
	<?php }else{  ?>
	<h1 class="am-topbar-brand"><a title="<?php  echo $name;  ?>-<?php  echo $subname;  ?>" href="<?php  echo $host;  ?>"><img alt="<?php  echo $name;  ?>-<?php  echo $subname;  ?>" src="<?php  echo $dm_logo;  ?>"><?php  echo $name;  ?></a></h1>
	<?php } ?>

 <ul id="dm-site-nav" class="am-nav am-topbar-nav">
<?php  echo $modules['navbar']->Content;  ?>
</ul>
 <ul class="topnav-right" >
<?php  echo $zbp->Config('dmam')->top_nav;  ?>
<li><a href="javascript:void(0)" data-search="<?php  echo $host;  ?>zb_system/cmd.php?act=search" data-am-modal="{target: '#search-modal', closeViaDimmer: true, width: 300}" class="top_serch"><i class="am-icon-search"></i> 搜索</a></li>
 </ul>

</div>
</header>



<section id="dm-box" class="am-container am-g">