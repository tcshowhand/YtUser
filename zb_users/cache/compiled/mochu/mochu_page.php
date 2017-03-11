
<?php  include $this->GetTemplate('header');  ?>
<div class="container main">
    <div class="miaobao">
      <h4 class="place lf">当前位置：<a href="<?php  echo $host;  ?>" title="<?php  echo $name;  ?>">首页</a> - <a href="#">其他</a> - 正文</h4>
      <h4 class="yan lr"><?php  echo $zbp->Config('mochu')->postyan;  ?></h4>
      <div class="clear"></div>
    </div>
<div class="main-lf link-con-bg lf">
<div class="link-con-lf">
	<ul>
<?php  echo $mochu_page_li;  ?>
	</ul>
</div>	
  <div class="link-con">
    <article class="link-h">
      <header class="link-top">
        <h2><a href="<?php  echo $article->Url;  ?>" title="<?php  echo $article->Title;  ?>"><?php  echo $article->Title;  ?></a></h2>
        <h6><i class="fa fa-user"></I> <?php  echo $article->Author->StaticName;  ?>&nbsp;&nbsp;&nbsp;<i class="fa fa-clock-o"></i> <?php  echo $article->Time('Y-m-d');  ?></h6>
      </header>
      <dd class="zhengwen"> <?php  echo $article->Content;  ?> </dd>
     <?php if ($article->Alias=="archive") { ?>
	  <?php  echo $mochu_cms_Archive;  ?>
	 <?php }elseif($article->Alias=="duzhe") {  ?>
	 <?php  echo $mochu_Readers;  ?>
	 <?php } ?>
      <div class="clear"></div>
      <?php if ($zbp->Config('mochu')->onzongzan =='1') { ?>
      <div class="wennr-zan"> <?php if ($zbp->Config('mochu')->onzan=="1") { ?>
        <?php  echo $zbp->Config('mochu')->postzan;  ?>
        <?php }else{  ?> <a href="javascript:;" class="sf-praise-sdk" sfa='click' data-postid='<?php  echo $article->ID;  ?>' data-value="1">
<i class="fa fa-thumbs-o-up"></i><i class="sf-praise-sdk" sfa='num' data-value='1' data-postid='<?php  echo $article->ID;  ?>'><?php  echo $sf_praise_sdk->value1;  ?></i>人喜欢
</a><a href="javascript:;" class="sf-praise-sdk zshang" sfa='click' data-postid='<?php  echo $article->ID;  ?>' data-value="2">
<i class="fa fa-thumbs-o-down"></i><i class="sf-praise-sdk" sfa='num' data-value='2' data-postid='<?php  echo $article->ID;  ?>'><?php  echo $sf_praise_sdk->value2;  ?></i>人鄙视
</a><a href="javascript:;" id="ondashang"><i class="fa fa-credit-card"></i>打赏本站</a><?php } ?> </div>
      <?php } ?>
      <div class="clear"></div>
      <div class="wennr-fen"> <?php  echo $zbp->Config('mochu')->postfen;  ?> </div>
      <div class="wennr-foot">
        <div class="wennr-foot-cn">
          <p><strong>本文来源：</strong><a href="<?php  echo $host;  ?>" target="_blank"><?php  echo $name;  ?></a> </p>
          <p><strong>本文地址：</strong><a href="<?php  echo $article->Url;  ?>"><?php  echo $article->Url;  ?></a></p>
          <?php  echo $zbp->Config('mochu')->postwennrcop;  ?> </div>
      </div>
    </article>
    <div class="clear"></div>
    <?php if (!$article->IsLock) { ?>
    <div class="pinglun">
      <h3><i class="fa fa-comments-o"></i>发表评论</h3>
      <?php if ($zbp->Config('mochu')->onping=="0") { ?>
      <?php  include $this->GetTemplate('comments');  ?>
      <?php }else{  ?>
      <div class="pinglunnr"> <?php  echo $zbp->Config('mochu')->postping;  ?> </div>
      <?php } ?> </div>
    <?php } ?> </div>
</div>
</div>
<?php  include $this->GetTemplate('footer');  ?>
