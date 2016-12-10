<div class="sidebar">
	<div class="logo">
		<a href="<?php  echo $host;  ?>"><img src="<?php  echo $host;  ?>zb_users/theme/Foam/include/logo.jpg" alt="" /></a>
		<h1><a href="<?php  echo $host;  ?>"><?php  echo $name;  ?></a></h1>
	</div>
	<div class="subtitle"><?php  echo $subname;  ?></div>
	<div class="menu">
		<ul>
			<?php  if(isset($modules['navbar'])){echo $modules['navbar']->Content;}  ?>
		</ul>
	</div>
	<div class="search">
		<form name="search" method="post" action="<?php  echo $host;  ?>zb_system/cmd.php?act=search">
		<input type="text" name="q" value="搜索" class="txt" />
		<input type="submit" value="" class="btn" />
		</form>
	</div>
	<div class="sidefoot">@ <a href="<?php  echo $host;  ?>"><?php  echo $name;  ?></a></div>
</div>