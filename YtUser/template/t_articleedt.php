{* Template Name: 发布投稿*}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
{template:t_header}

<div class="col-19 col-m-24">
    <div class="tx-box bg-white mb15">
        <h2 class="tx-title">发布文章</h2>

        <div class="pd15">
            {if $user.Level <= $zbp->Config('YtUser')->contribute_level}
            <ul class="tx-form-li row">
            <form class="js-ajax-form" action="{$zbp->Config('YtUser')->api_articleinfo}" method="post" novalidate="novalidate">
                <input type="hidden" name="token" id="token" value="{$zbp->GetToken()}">
                <li class="col-24 col-m-24"><p>{$zbp->Config('YtUser')->contribute_text}</p></li>
                <li class="col-24 col-m-24"><p><input id="edtTitle" name="Title" type="text" class="tx-input" placeholder="文章标题"></p></li>
                {if !empty($zbp->Config('YtUser')->limit_dirz1)}
                {php}$list = json_decode($zbp->Config('YtUser')->limit_dirz1,true);$list2 = json_decode($zbp->Config('YtUser')->limit_dirz2,true);{/php}
                {foreach $list as $key=>$add}
                    <li class="col-12 col-m-24"><p><input type="text" name="meta_{$list2[$key]}" value="" class="tx-input"><i>{$add}</i></p></li>
                {/foreach}
                {/if}
                <li class="col-24 col-m-24"><p>{$article.UEditor}</p></li>
                {if $zbp->Config('YtUser')->tverifycode_on}
                <li class="col-24 col-m-24"><p><select name="CateID" size="1" class="form-control user_input tx-select">{Yt_Categories(0)}</select></p></li>
                {else}
                <li class="col-12 col-m-24"><p><select name="CateID" size="1" class="form-control user_input tx-select">{Yt_Categories(0)}</select></p></li>
                <li class="col-12 col-m-24"><p class="input-ma"><input required="required" type="text" name="verifycode" class="tx-input"  placeholder="验证码">{$article.verifycode}</p></li>
                {/if}
                <li class="col-24 col-m-24"><p class="tx-input-full"><button class="js-ajax-submit tx-btn tx-btn-big bg-black">提交</button></p></li>
            </form>
            </ul>
            {else}
            <p class="tx-red f-22 ta-c">你的权限不足！！！请联系站长。</p>
            {/if} 
        </div>
    </div> 
</div>
{template:t_footer}



