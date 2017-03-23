
<div id="Footer">
    <div class="top-nav">
        <span style="color: #000">友情链接：</span><ul><?php  if(isset($modules['link'])){echo $modules['link']->Content;}  ?></ul>
    </div>
    <p class="site-info">
        <i></i>
        <span><?php  echo $copyright;  ?> Powered By <?php  echo $zblogphpabbrhtml;  ?> Theme By <a href="http://www.songhaifeng.com/" title="提供基于Z-BlogPHP程序的主题定制、仿站、修改等业务">小锋博客</a></span>
    </p>
</div>
</div>
<div class="mod-sidebar"><ul class="menu"><?php  if(isset($modules['navbar'])){echo $modules['navbar']->Content;}  ?></ul></div>
<script type="text/javascript" src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/js/mod.js"></script>
<script type="text/javascript" src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/js/mod_page.js"></script>
<script type="text/javascript" src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/js/ap_ulist.js"></script>
<script type="text/javascript" src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/js/header.js"></script>
<script type="text/javascript" src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/js/cover.js"></script>
<script type="text/javascript" src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/js/iscroll.js"></script>
<script type="text/javascript" src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/js/velocity.js"></script>
<script type="text/javascript" src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/js/lessimgindex.js"></script>
<script type="text/javascript" src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/js/mod_sidebar.js"></script>
<?php  echo $footer;  ?></body>
</html>