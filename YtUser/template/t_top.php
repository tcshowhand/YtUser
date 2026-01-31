{* Template Name: 菜单*}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
<style>
@media screen and (max-width: 978px){
    .t_op{display: block !important;margin-bottom: 15px;}
    .mobile-menu-content {
        position: fixed;
        left: -260px;
        top: 0;
        bottom: 0;
        width: 260px;
        z-index: 10000;
        background: #fff;
        transition: all 0.3s ease;
        overflow-y: auto;
        box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        padding-top: 0; /* Reset padding */
    }
    .mobile-menu-content.active {
        left: 0;
    }
    
    /* Header Section */
    .mobile-menu-header {
        background: #1E9FFF; /* Use theme color or fixed blue */
        padding: 20px;
        color: #fff;
        position: relative;
    }
    .mobile-menu-header .avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 2px solid rgba(255,255,255,0.8);
        vertical-align: middle;
        margin-right: 10px;
    }
    .mobile-menu-header .username {
        font-size: 16px;
        font-weight: bold;
    }
    .mobile-menu-close {
        position: absolute;
        top: 15px;
        right: 15px;
        font-size: 20px;
        color: rgba(255,255,255,0.8);
        cursor: pointer;
        z-index: 10001;
    }
    
    /* Reset and Style List */
    .mobile-menu-content .side-menu-box {
        margin-bottom: 0;
        background: transparent;
        box-shadow: none;
        border-radius: 0;
    }
    .mobile-menu-content .side-menu-box dd ul {
        border: none;
        background: transparent;
    }
    .mobile-menu-content .side-menu-box li {
        margin-bottom: 0;
        border-bottom: 1px solid #f5f5f5;
        background: transparent !important;
    }
    .mobile-menu-content .side-menu-box li a {
        display: block;
        padding: 0 20px;
        line-height: 50px;
        height: 50px;
        color: #333 !important;
        background: transparent !important;
        font-size: 15px;
        border-radius: 0 !important;
        border: none !important; /* Remove inherited borders */
        box-shadow: none !important;
    }
    .mobile-menu-content .side-menu-box li a:after {
        display: none; /* Remove legacy border effect */
    }
    .mobile-menu-content .side-menu-box li a:hover {
        background: #f9f9f9 !important;
        color: #1E9FFF !important;
    }
    .mobile-menu-content .side-menu-box li a i {
        margin-right: 10px;
        font-size: 18px;
        color: #999;
    }
    .mobile-menu-content .side-menu-box li a:hover i {
        color: #1E9FFF;
    }
}
@media screen and (min-width: 979px){
    .mobile-menu-content { display: block !important; }
    .mobile-menu-close, .mobile-menu-header { display: none; }
}
</style>

<div class="mobile-menu-content">
    <div class="mobile-menu-header">
        <div class="mobile-menu-close"><i class="iconfont icon-guanbi1"></i></div>
        <img src="{$zbp->user->Avatar}" class="avatar" alt="{$zbp->user->StaticName}">
        <span class="username">{$user.StaticName}</span>
    </div>

    <dl class="side-menu-box">
        <dd>
            <ul>
                {if $zbp->user->Level == 1} 
                <li><a href="{$host}zb_system/admin/index.php?act=admin"><i class="iconfont icon-shouye"></i> 网站后台</a></li>
                {/if}
                <li><a href="{$host}"><i class="iconfont icon-shouye"></i> 网站首页</a></li>
                <li><a href="{$host}{$zbp->Config('YtUser')->YtUser_User}"><i class="iconfont icon-shouye"></i> 用户首页</a></li>
                <li><a href="{$host}{$zbp->Config('YtUser')->YtUser_UserEdit}"><i class="iconfont icon-shezhi"></i> 修改资料</a></li>
                {if $zbp->user->Level <= $zbp->Config('YtUser')->contribute_level} 
                <li><a href="{$host}{$zbp->Config('YtUser')->YtUser_Articlelist}"><i class="iconfont icon-text"></i> 文章管理</a></li>
                <li><a href="{$host}{$zbp->Config('YtUser')->YtUser_Articleedt}"><i class="iconfont icon-write"></i> 发布文章</a></li>
                {/if}
                <li><a href="{$host}{$zbp->Config('YtUser')->YtUser_Commentlist}"><i class="iconfont icon-liuyan"></i> 评论管理</a></li>
                {if (int)$zbp->Config('YtUser')->onfavorite} 
                <li><a href="{$host}{$zbp->Config('YtUser')->YtUser_Favorite}"><i class="iconfont icon-xihuan"></i> 我的收藏</a></li>
                {/if}
            </ul>
        </dd>
    </dl>

    <dl class="side-menu-box">
        <dd>
            <ul>
                {if $zbp->Config('YtUser')->inv_on}
                <li><a href="{$host}{$zbp->Config('YtUser')->YtUser_Invite}"><i class="iconfont icon-refund"></i> 邀请好友</a></li>
                {/if}
                <li><a href="{$host}{$zbp->Config('YtUser')->YtUser_Integral}"><i class="iconfont icon-refund"></i> 积分充值</a></li>
                <li><a href="{$host}{$zbp->Config('YtUser')->YtUser_Upgrade}"><i class="iconfont icon-vip"></i> VIP充值</a></li>
                <li><a href="{$host}{$zbp->Config('YtUser')->YtUser_Paylist}"><i class="iconfont icon-calendar"></i> 购买列表</a></li>
                <li><a href="{$host}{$zbp->Config('YtUser')->YtUser_Consume}"><i class="iconfont icon-calendar"></i> 消费记录</a></li>
            </ul>
        </dd>
    </dl>

    <dl class="side-menu-box">
        <dd>
            <ul>
                <li><a href="{$host}{$zbp->Config('YtUser')->YtUser_Changepassword}"><i class="iconfont icon-lock"></i> 修改密码</a></li>
                {if $zbp->Config('YtUser')->appid}
                <li><a href="{$host}{$zbp->Config('YtUser')->YtUser_Binding}"><i class="iconfont icon-qq2"></i> 账号绑定</a></li>
                {/if}
                {if $zbp->Config('YtUser')->Oncertif=='1'}
                <li><a href="{$host}{$zbp->Config('YtUser')->YtUser_Certifi}"><i class="iconfont icon-pengyou"></i> 实名认证</a></li>
                {/if}
                <li><a href="{BuildSafeCmdURL('act=logout')}"><i class="iconfont icon-tuichu"></i> 退出账号</a></li>
            </ul>
        </dd>
    </dl>
</div>