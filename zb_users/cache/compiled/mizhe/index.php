<?php  include $this->GetTemplate('header');  ?>
<body class="<?php  echo $type;  ?>">
	<div class="wrapper">
		<?php  include $this->GetTemplate('navbar');  ?>
		<?php if ($type=='index'&&$page=='1') { ?>
		<div id="tslide">
			<ul>
				<?php  if(isset($modules['slide'])){echo $modules['slide']->Content;}  ?>
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
		<?php } ?>
		<div class="box">
			<div class="banner"><?php  echo $zbp->Config('mizhe')->PostINDEXADS;  ?></div>
			<div class="default">
				<ul class="fourlist" id="container">
					<?php  foreach ( $articles as $article) { ?>

					<?php if ($article->IsTop) { ?>
					<?php  include $this->GetTemplate('post-istop');  ?>
					<?php }else{  ?>
					<?php  include $this->GetTemplate('post-multi');  ?>
					<?php } ?>

					<?php }   ?>
				</ul>
			</div>
			<script>
$(function(){
	$(".tsale").children(".i_p").css("color", "blue");
});
			</script>
			<div class="pagebar"><?php  include $this->GetTemplate('pagebar');  ?><span class="pagebar-tip">下一页更多惊喜</span></div>
		</div>
<?php  include $this->GetTemplate('footer');  ?>