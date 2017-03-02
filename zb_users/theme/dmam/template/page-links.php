{* Template Name:连接页面 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">打开这个网页的是傻逼</h2>吼吼!</div>';die();?>
{$link_name = $modules['link'].Name}
{$link_content = $modules['link'].Content}
{$misc_name = $modules['misc'].Name}
{$misc_content = $modules['misc'].Content}
{php}
$pagefix = '<ul class="plinksa">
	<li id="linkcat-1" class="linkcat"><h2>'.$link_name.'</h2>
		<ul>
		'.$link_content.'
		</ul>
	</li>
	<li id="linkcat-2" class="linkcat"><h2>'.$misc_name.'</h2>
		<ul>
		'.$misc_content.'
		</ul>
	</li>
</ul>';
{/php}
{template:single}