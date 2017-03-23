
<div class="hclc">
	<article>
		<h1><?php  echo $article->Title;  ?></h1>
		<div class="contInfo">
			<div class="floatL">
				<span id="pubtime_baidu"><?php  echo $article->Time('Y/m/d');  ?></span>
			</div>
			<div class="floatR">
				<style type="text/css">.bshare-custom{font-size:12px!important;}.bshare-custom a{margin:0 3px!important;line-height:16px;}#bsLogoList li{padding-left:0;background:none;}.b-drag{border-radius:0!important;}.b-drag-arrow{left:0!important;}</style>
				<div class="bshare-custom">
					<div class="bsPromo bsPromo2"></div>
					<span>TAG：</span> <?php if ($article->Tags) { ?><?php  foreach ( $article->Tags as $tag) { ?><a href="<?php  echo $tag->Url;  ?>" title="<?php  echo $tag->Name;  ?>" class="label bg-primary"><?php  echo $tag->Name;  ?></a><?php }   ?><?php }else{  ?>本文暂时没有添加标签<?php } ?>
				</div>
			</div>
		</div>
		<div class="content"><?php  echo $article->Content;  ?></div>
		<div class="copyright">
			<p>本文标题：<?php  echo $article->Title;  ?></p>
			<p class="url">本文链接：<?php  echo $article->Url;  ?></p>
			<p>本文声明：除注明转载/出处外，均为本站原创或翻译，转载请务必注明出处。</p>
		</div>
	</article>
	<?php if (!$article->IsLock) { ?>
		<?php  include $this->GetTemplate('comments');  ?>
	<?php } ?>
</div>