<?php  /* Template Name:404错误页面 */  ?>

<?php  include $this->GetTemplate('header');  ?>
<body class="ce3 <?php  echo $type;  ?>">
<?php  include $this->GetTemplate('b_nav_top');  ?>
<section class="dm-container am-container am-g">
	<div class="am-u-lg-12">
        <div class="am-u-sm-12">
          <h2 class="am-text-center am-text-xxxl am-margin-top-lg">404. Not Found</h2>
          <p class="am-text-center">没有找到你要的页面</p>
        <pre class="page-404">
          .----.
       _.'__    `.
   .--($)($$)---/#\
 .' @          /###\
 :         ,   #####
  `-..__.-' _.-\###/
        `;_:    `"'
      .'"""""`.
     /,  ya ,\\
    //  404!  \\
    `-._______.-'
    ___`. | .'___
   (______|______)
        </pre>
        </div>
	</div>
	  <?php  include $this->GetTemplate('footer');  ?>
</section>
<?php  echo $footer;  ?>
</body>
</html>
