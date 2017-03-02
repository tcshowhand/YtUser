<?php  /* Template Name:列表标题 */  ?>

<?php if ($type == 'index') { ?>
<div class="am-titlebar am-titlebar-multi">
  <div class="am-titlebar-title am-icon-clock-o"> 最近更新</div>
  <nav class="am-titlebar-nav">
  <?php  echo $zbp->Config('dmam')->index_titlebar_nav;  ?>
  </nav>
</div>
<?php }elseif($type=='category') {  ?>
<div class="am-titlebar am-titlebar-multi">
  <div class="am-titlebar-title am-icon-folder-open-o"> <?php  echo $category->Name;  ?></div>
	<?php if (isset($pagebar->PageAll)||isset($pagebar->PageNow)) { ?>
	  <nav class="am-titlebar-nav">共<?php  echo $pagebar->PageAll;  ?>页，当前第<?php  echo $pagebar->PageNow;  ?>页</nav>
	<?php }else{  ?>
	  <nav class="am-titlebar-nav">没有内容</nav>
	<?php } ?>
</div>
<?php }elseif($type=='search') {  ?>
<div class="am-titlebar am-titlebar-multi">
  <div class="am-titlebar-title am-icon-search"> "<?php if (isset($searchq)) { ?><?php  echo $searchq;  ?><?php } ?>" 的搜索结果</div>
	<?php if (isset($pagebar->PageAll)||isset($pagebar->PageNow)) { ?>
	  <nav class="am-titlebar-nav">共<?php  echo $pagebar->PageAll;  ?>页，当前第<?php  echo $pagebar->PageNow;  ?>页</nav>
	<?php }else{  ?>
	  <nav class="am-titlebar-nav">没有内容</nav>
	<?php } ?>
</div>
<?php }elseif($type=='tag') {  ?>
<div class="am-titlebar am-titlebar-multi">
  <div class="am-titlebar-title am-icon-tag"> Tag "<?php  echo $tag->Name;  ?>" 相关内容</div>
	<?php if (isset($pagebar->PageAll)||isset($pagebar->PageNow)) { ?>
	  <nav class="am-titlebar-nav">共<?php  echo $pagebar->PageAll;  ?>页，当前第<?php  echo $pagebar->PageNow;  ?>页</nav>
	<?php }else{  ?>
	  <nav class="am-titlebar-nav">没有内容</nav>
	<?php } ?>
</div>
<?php }elseif($type=='date') {  ?>
<div class="am-titlebar am-titlebar-multi">
  <div class="am-titlebar-title am-icon-calendar"> Date-<?php  echo $title;  ?></div>
	<?php if (isset($pagebar->PageAll)||isset($pagebar->PageNow)) { ?>
	  <nav class="am-titlebar-nav">共<?php  echo $pagebar->PageAll;  ?>页，当前第<?php  echo $pagebar->PageNow;  ?>页</nav>
	<?php }else{  ?>
	  <nav class="am-titlebar-nav">没有内容</nav>
	<?php } ?>
</div>
<?php }else{  ?>
<div class="am-titlebar am-titlebar-multi">
  <div class="am-titlebar-title am-icon-square-o"> <?php  echo $type;  ?></div>
	<?php if (isset($pagebar->PageAll)||isset($pagebar->PageNow)) { ?>
	  <nav class="am-titlebar-nav">共<?php  echo $pagebar->PageAll;  ?>页，当前第<?php  echo $pagebar->PageNow;  ?>页</nav>
	<?php }else{  ?>
	  <nav class="am-titlebar-nav">没有内容</nav>
	<?php } ?>
</div>
<?php } ?>