<div class="sidebar">
	<div class="logo">
		<a href="{$host}"><img src="{$host}zb_users/theme/Foam/include/logo.jpg" alt="" /></a>
		<h1><a href="{$host}">{$name}</a></h1>
	</div>
	<div class="subtitle">{$subname}</div>
	<div class="menu">
		<ul>
			{module:navbar}
		</ul>
	</div>
	<div class="search">
		<form name="search" method="post" action="{$host}zb_system/cmd.php?act=search">
		<input type="text" name="q" value="搜索" class="txt" />
		<input type="submit" value="" class="btn" />
		</form>
	</div>
	<div class="sidefoot">@ <a href="{$host}">{$name}</a></div>
</div>