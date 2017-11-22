{* Template Name: 实名验证*}
{template:t_header}

<legend>实名验证</legend>
      
{if $isidcard == 1}
    待审核
{elseif $isidcard == 2}
    已验证
{else}
    {if $isidcard == 3}
        未通过
    {/if}

姓名:<input type="text" id="edtname" name="name" placeholder="姓名">
身份证号<input type="text" id="edtidcard" name="idcard" placeholder="身份证号">
验证码:<input type="text" id="edtverifycode" name="verifycode" placeholder="验证码">{$article.verifycode}
<button type="button" onclick="return Certifi();">提交</button>
{/if}

{template:t_footer}
