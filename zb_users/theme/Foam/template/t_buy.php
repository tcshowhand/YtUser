{template:header}
<body class="single {$type}">
	<div class="wrapper">
		<div class="box">
			{template:navbar}
			<div class="main">
<div class="post">
	<div class="postblock">
		<h3 class="posttitle">{$article.Title}</h3>
		<div class="postintro">
<input type="hidden" name="LogID" id="LogID" value="{$article.BuyID}" />
<input type="hidden" name="LogUrl" id="LogUrl" value="{$article.BuyTUrl}" />
产品：{$article.BuyTitle}
价格：{$article.BuyPrice}
账户余额：{$user.Price}
{if $article.buynum}
已购买
{else}
(*)验证码：<input required="required" type="text" name="verifycode"  />{$article.verifycode}
<input type="submit" value="付款" onclick="return Ytbuypay()"/>
{/if}
		</div>
	</div>
</div>
			</div>
{template:footer}