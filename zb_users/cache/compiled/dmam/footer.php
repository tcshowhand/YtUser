<?php  /* Template Name:页尾 */  ?>

</section>
<footer class="dm-footer am-footer">
	<div class="am-container am-g">
		<p><?php  echo $copyright;  ?></p>
		<p><?php dmam_theme_copy() ?></p>
	</div>
</footer>
<div class="side_wi">
<a class="side_wi-up" href="javascript:go_to('top',300);"><i class="am-icon-arrow-up"></i></a>
<?php if ($type == 'article'&&!$article->IsLock) { ?>
<a class="side_wi-cmt" href="javascript:go_to('#dm-comment-titlebar',300);"><i class="am-icon-comments"></i></a>
<?php } ?>
<a class="side_wi-down" href="javascript:go_to('bottom',300);"><i class="am-icon-arrow-down"></i></a>
</div>
 </body>
<?php  echo dmam_load_source('footer',$type,null);  ?>
<?php if ($zbp->Config('dmam')->footmate) { ?><?php  echo $zbp->Config('dmam')->footmate;  ?><?php } ?>
<?php  echo $footer;  ?>


</html>