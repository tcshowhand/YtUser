<div class="login-on user-menu-wrap" id="user-menu-trigger">
    <img src="{$zbp->user->Avatar}" alt="{$zbp->user->StaticName}">

    <!-- Dropdown Menu -->
    <div class="user-menu-dropdown" id="user-header-menu">
        <div class="menu-header">
            <div class="menu-user-info">
                <div class="menu-avatar-wrap">
                    <a href="{$host}{$zbp->Config('YtUser')->YtUser_User}">
                        <img src="{$zbp->user->Avatar}" class="menu-avatar">
                    </a>
                    <div class="menu-details">
                        <a class="menu-name"
                            href="{$host}{$zbp->Config('YtUser')->YtUser_User}">{$zbp->user->StaticName}</a>
                        <span class="menu-bio">{if $zbp->user->Intro}{$zbp->user->Intro}{else}这家伙很懒什么都没说。{/if}</span>
                    </div>
                </div>
                <a class="menu-logout tooltipstered" href="{BuildSafeCmdURL('act=logout')}"><i
                        class="iconfont icon-tuichu"></i></a>
            </div>
            <div class="menu-stats">
                <div class="menu-stat-item">
                    <span class="menu-stat-label">金币</span>
                    <span class="menu-stat-value">{$zbp->user->Price}</span>
                </div>
            </div>
            <div class="menu-actions">
                {if $zbp->user->sign==0}
                <a class="js-ajax-dialog-btn menu-btn" href="{$zbp->Config('YtUser')->api_sign}"
                    data-msg="开启美好第一天吧!!"><i class="iconfont icon-zuobiao"></i> 领金币</a>
                {else}
                <div class="menu-checkin">已签到</div>
                {/if}
            </div>
        </div>
        <div class="menu-list">
            <a class="menu-link" href="{$host}{$zbp->Config('YtUser')->YtUser_Articleedt}" target="_blank">
                <i class="iconfont icon-write"></i>发布文章
            </a>
            <a class="menu-link" href="{$host}{$zbp->Config('YtUser')->YtUser_User}">
                <i class="iconfont icon-yonghu"></i>个人中心
            </a>
            <a class="menu-link" href="{$host}{$zbp->Config('YtUser')->YtUser_Favorite}">
                <i class="iconfont icon-xihuan"></i>我的收藏
            </a>
            <a class="menu-link" href="{$host}{$zbp->Config('YtUser')->YtUser_Paylist}">
                <i class="iconfont icon-gouwuche"></i>我的订单
            </a>
        </div>
    </div>
</div>