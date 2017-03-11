<?php  /* Template Name:用户中心左侧栏 */  ?>

	<?php if ($zbp->user->ID) { ?>
	<dl>
	<dd>
	<ul class="am-nav">
	<li><a class="am-icon-user" href="<?php  echo $host;  ?>?User"> 用户中心</a></li>
	<li><a class="am-icon-pencil-square-o" href="<?php  echo $host;  ?>?Articleedt"> 发布投稿</a></li>
	<li><a class="am-icon-list-alt" href="<?php  echo $host;  ?>?Articlelist"> 我的文章</a></li>
	<li><a class="am-icon-comments" href="<?php  echo $host;  ?>?Commentlist"> 我的评论</a></li>
	<li><a class="am-icon-shopping-bag" href="<?php  echo $host;  ?>?Paylist"> 我的订单</a></li>
	<li><a class="am-icon-angellist" href="<?php  echo $host;  ?>?Integral"> 积分充值</a></li>
	<li><a class="am-icon-diamond" href="<?php  echo $host;  ?>?Upgrade"> VIP月充</a></li>
	</ul>
	</dd>
	</dl>
	<?php } ?>