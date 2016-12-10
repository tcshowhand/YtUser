{template:header}
<body class="{$type}">
	<div class="wrapper">
		{template:navbar}
		{if $type=='index'&&$page=='1'}
		<div id="tslide">
			<ul>
				{module:slide}
			</ul>
		</div>
		<script type="text/javascript">
		$(function(){
			var tslide = new HtmlSlidePlayer("#tslide",{autosize:1,fontsize:12,time:3000});
			var slidenum = $(".slidebtn a").length;
			if(slidenum<2){
				$(".slidebtn").hide();
			}
			var $slidewidth = $(".slidebtn").width();
			$(".slidebtn").css("margin-left",-$slidewidth/2);
			var slidelinum = $("#tslide ul li").length;
			if(slidelinum==0){
				$("#tslide,.slide_btm").hide();
			}
		});
		</script>
		{/if}
		<div class="box">
			<div class="banner">{$zbp->Config('mizhe')->PostINDEXADS}</div>
			<div class="default">
				<ul class="fourlist" id="container">
					{foreach $articles as $article}

					{if $article.IsTop}
					{template:post-istop}
					{else}
					{template:post-multi}
					{/if}

					{/foreach}
				</ul>
			</div>
			<script>
$(function(){
	$(".tsale").children(".i_p").css("color", "blue");
});
			</script>
			<div class="pagebar">{template:pagebar}<span class="pagebar-tip">下一页更多惊喜</span></div>
		</div>
{template:footer}