{* Template Name:页尾 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">打开这个网页的是傻逼</h2>吼吼!</div>';die();?>
</section>
<footer class="dm-footer am-footer">
	<div class="am-container am-g">
		<p>{$copyright}</p>
		<p>{php}dmam_theme_copy(){/php}</p>
	</div>
</footer>
<div class="side_wi">
<a class="side_wi-up" href="javascript:go_to('top',300);"><i class="am-icon-arrow-up"></i></a>
{if $type == 'article'&&!$article.IsLock}
<a class="side_wi-cmt" href="javascript:go_to('#dm-comment-titlebar',300);"><i class="am-icon-comments"></i></a>
{/if}
<a class="side_wi-down" href="javascript:go_to('bottom',300);"><i class="am-icon-arrow-down"></i></a>
</div>
 </body>
{dmam_load_source('footer',$type,null)}
{if $zbp->Config('dmam')->footmate}{$zbp->Config('dmam')->footmate}{/if}
{$footer}


</html>