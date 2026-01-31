{* Template Name: 邀请记录*}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
{template:t_header}
<div class="col-19 col-m-24">
    <div class="tx-box bg-white mb15">
        {if $zbp->Config('YtUser')->inv_on}
        <h2 class="tx-title">邀请链接</h2>
        <div class="pd15">
            <ul class="tx-form-li row">
                <li class="col-24 col-m-24"><p><input id="edtTitle" name="Title" type="text" class="tx-input" placeholder="邀请好友" value="{$zbp->user->Regurl}"> </p></li>
                <li class="col-24 col-m-24"><p class="tx-input-full"><button data-init-second-left="10" class="js-get-text-code tx-btn tx-btn-big bg-black urlbtn">复制邀请链接</button></p></li>
            </ul>
        </div>
        <hr>
        {/if}
        <h2 class="tx-title">邀请记录</h2>
        <div class="pd15">
            <table class="tx-table">
                <tr class="bgh" style="text-align: left">
                    <th style="width:10%;">ID</th>
                    <th style="width:60%;text-align: left">昵称</th>
                    <th style="width:30%;">注册时间</th>
                </tr>
                {if count($articles)>0}
                {foreach $articles as $key=>$article}
                <tr>
                    <td>{$key+1}</td>
                    <td style="text-align: left">{$article.username}</td>
                    <td>{$article.usertime}</td>
                </tr>
                {/foreach}
                {else}
                <tr>
                    <td colspan="5" class="ta-c pd20">您暂时没有消费</td>
                </tr>
                {/if}
            </table>
        </div>
    </div> 
    <div class="pagebar mb15">
        {template:t_pagebar}
    </div> 
</div>
{template:t_footer}