{* Template Name:购买状态 *}
{template:t_header}
购买状态

名称：<input type="text" id="edtinvitecode" placeholder="{$article.BuyTitle}" disabled>
价格：<input type="text" id="edtinvitecode" name="invitecode" placeholder="{$article.BuyPrice}" disabled>
账户余额：<input type="text" id="edtinvitecode" name="invitecode" placeholder="{$user.Price}" disabled>

{if $article.buynum}
    已购买
{else}
    <input type="hidden" name="LogID" id="LogID" value="{$article.BuyID}" />
    <input type="hidden" name="LogUrl" id="LogUrl" value="{$article.BuyTUrl}" />
    {if $zbp->Config('YtUser')->payment !== '1'}
        <input type="text" class="form-control user_input" id="edtverifycode" name="verifycode" placeholder="验证码">{$article.verifycode}
    {/if}	
    {if !$zbp->Config('YtUser')->payment}
        <button type="button" class="btn btn-block" onclick="return Ytbuypay();">提交</button>
    {else}
        {if $zbp->Config('YtUser')->payment=='2'}
			<button type="button" class="btn btn-block" onclick="return Ytbuypay();">积分支付</button>
        {/if}
        <button type="button" class="btn btn-block" onclick="return VipRegPage();">支付宝</button>
        <script type="text/javascript">function VipRegPage(){document.getElementById("edit").action="{$host}zb_users/plugin/YtUser/cmd.php?act=UploadPst&token={$zbp->GetToken()}";}</script>
		{/if}
      </div>
{/if}

{template:t_footer}