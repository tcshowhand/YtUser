
<?php if ($pagebar) { ?>
	<?php  foreach ( $pagebar->buttons as $k=>$v) { ?>
		<?php if ($pagebar->PageNow==$k) { ?>
			<li><a href="javascript:;" class="on"><?php  echo $k;  ?></a></li>
		<?php }elseif($k=='‹‹' and $pagebar->PageNow!=$pagebar->PageFirst) {  ?>
			<li><a href="<?php  echo $pagebar->buttons['‹‹'];  ?>" class="c-nav ease" title="首页">首页</a></li>
		<?php }elseif($k=='‹‹' and $pagebar->PageNow==$pagebar->PageFirst) {  ?>
		<?php }elseif($k=='››' and $pagebar->PageNow==$pagebar->PageLast) {  ?>
		<?php }elseif($k=='››' and $pagebar->PageNow!=$pagebar->PageLast) {  ?>
			<li><a href="<?php  echo $pagebar->buttons['››'];  ?>" class="c-nav ease" title="末页">末页 </a></li>
		<?php }elseif($k=='‹') {  ?>
			<li><a href="<?php  echo $v;  ?>" title="<?php  echo $k;  ?>" class="prev ease">上一页</a></li>
		<?php }elseif($k=='›') {  ?>
			<li><a href="<?php  echo $v;  ?>" title="<?php  echo $k;  ?>" class="next ease">下一页</a></li>
		<?php }else{  ?>
			<li><a href="<?php  echo $v;  ?>" title="<?php  echo $k;  ?>" class="ease"><?php  echo $k;  ?></a></li>
		<?php } ?>
	<?php }   ?>
<?php } ?>