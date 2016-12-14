<div class="header">
     <div class="top">
          <div class="topmain">
               <div class="leftnav">
                    <ul>
                         <?php if ($user->ID) { ?><span>欢迎 <?php  echo $user->StaticName;  ?></span><?php }else{  ?><li>登录：</li><li><div class="ds-login"></div></li><?php } ?>
                    </ul>
               </div>
               <div class="rightnav">
                    <ul>
                         <?php  echo $zbp->Config('mizhe')->PostRIGHTNAV;  ?>
                    </ul>
               </div>
          </div>
     </div>
     <div class="sign">
          <div class="topmain">
               <div class="logo"><a href="<?php  echo $host;  ?>" title="<?php  echo $name;  ?>-<?php  echo $subname;  ?>"><img src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/include/logo.png" alt="" /></a></div>
               <div class="search">
                    <form method="post" name="search" action="<?php  echo $host;  ?>zb_system/cmd.php?act=search">
                    <div class="searchtxt"><input type="text" name="q" speech x-webkit-speech placeholder="输入品牌或商品进行搜索..." /></div>
                    <div class="searchbtn"><input type="submit" name="submit" value="" /></div>
                    </form>
               </div>
               <div class="weibo"><?php  echo $zbp->Config('mizhe')->PostBLOG;  ?></div>
          </div>
     </div>
     <div class="menu floatbox">
          <div class="topmain">
               <ul>
                    <?php  if(isset($modules['navbar'])){echo $modules['navbar']->Content;}  ?>
               </ul>
          </div>
     </div>
</div>