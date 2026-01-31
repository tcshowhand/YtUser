{* Template Name: 实名验证*}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">打开这个网页的是傻逼</h2>吼吼!</div>';die();?>
{template:t_header}
<div class="col-19 col-m-24">
    <div class="tx-box bg-white mb15">
        <h2 class="tx-title">实名验证</h2>
        <div class="pd15">
            <ul class="tx-form-li row">
                {if $isidcard == 1}
                <li class="col-24 col-m-24"><i class="iconfont icon-tishi"></i> 待审核</li>
                {elseif $isidcard == 2}
                <li class="col-24 col-m-24"><i class="iconfont icon-tishi"></i> 已验证</li>
                {else}
                {if $isidcard == 3}
                <li class="col-24 col-m-24"><i class="iconfont icon-tishi"></i> 未通过</li>
                {/if}
                <form class="js-ajax-form" action="{$zbp->Config('YtUser')->api_certifi}" method="post" novalidate="novalidate">
                <li class="col-24 col-m-24"><p>
                {php}
                $array=array();
                $array['0']="个人认证";
                $array['1']="企业认证";
                echo zbpform::radio('type', $array, 0);
                {/php}
                </p></li>
                <li class="col-24 col-m-24"><p><input required="required" type="text" id="edtname" name="name" class="tx-input"/><i>姓名或企业名</i></p></li>
                <li class="col-24 col-m-24"><p><input required="required" type="text" id="edtidcard" name="idcard" class="tx-input"/><i>证号号码</i></p></li>
                <li class="col-24 col-m-24"><p class="input-ma"><input required="required" type="text" name="verifycode" class="tx-input"  placeholder="验证码">{$article.verifycode}</p></li>
                <li class="col-24 col-m-24"><p class="tx-input-full"><button type="submit" class="js-ajax-submit tx-btn tx-btn-big bg-black">提交</button></p></li>
                </form>
                {/if}
            </ul>
        </div>
    </div>
</div>
{template:t_footer}

