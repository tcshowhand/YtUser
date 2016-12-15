<div class="header">
     <div class="top">
          <div class="topmain">
               <div class="leftnav">
                    <ul>
                         {if $user.ID}<span>欢迎 {$user.StaticName} <a href="{$host}?User">会员中心</a> <a href="{$host}zb_system/cmd.php?act=logout">退出</a></span>{else}<li>登录：</li><li><div class="ds-login"></div></li>{/if}
                    </ul>
               </div>
               <div class="rightnav">
                    <ul>
                         {$zbp->Config('mizhe')->PostRIGHTNAV}
                    </ul>
               </div>
          </div>
     </div>
     <div class="sign">
          <div class="topmain">
               <div class="logo"><a href="{$host}" title="{$name}-{$subname}"><img src="{$host}zb_users/theme/{$theme}/include/logo.png" alt="" /></a></div>
               <div class="search">
                    <form method="post" name="search" action="{$host}zb_system/cmd.php?act=search">
                    <div class="searchtxt"><input type="text" name="q" speech x-webkit-speech placeholder="输入品牌或商品进行搜索..." /></div>
                    <div class="searchbtn"><input type="submit" name="submit" value="" /></div>
                    </form>
               </div>
               <div class="weibo">{$zbp->Config('mizhe')->PostBLOG}</div>
          </div>
     </div>
     <div class="menu floatbox">
          <div class="topmain">
               <ul>
                    {module:navbar}
               </ul>
          </div>
     </div>
</div>