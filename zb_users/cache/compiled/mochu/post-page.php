
<div class="main-lf lf">
  <div class="mainct">
    <div class="miaobao">
      <span class="place lf">当前位置：<a href="<?php  echo $host;  ?>" title="<?php  echo $name;  ?>">首页</a> - <a href="#">其他</a> - 正文</span>
      <span class="yan lr"><?php  echo $zbp->Config('mochu')->postyan;  ?></span>
      <div class="clear"></div>
    </div>
 <article class="wennr">
				<header class="wennr-top">
					<h1><a href="<?php  echo $article->Url;  ?>" title="<?php  echo $article->Title;  ?>"><?php  echo $article->Title;  ?></a></h1>
					<h6><i class="fa fa-clock-o"></i><?php  echo $article->Time('Y-m-d');  ?><i class="fa fa-folder-open"></i><a href="<?php  echo $article->Category->Url;  ?>" title="分类 <?php  echo $article->Category->Name;  ?> 的全部文章" rel="category tag"><?php  echo $article->Category->Name;  ?></a><i class="fa fa-user"></i><?php  echo $article->Author->StaticName;  ?><i class="fa fa-eye"></i><?php  echo $article->ViewNums;  ?>°c</h6>
					<span class="lr" id="fontsize"><a href="javascript:wennrsize(18)">A<sup>+</sup></a>&nbsp;<a href="javascript:wennrsize(15)">A<sup>-</sup></a></span>
				</header>

     <?php  $sf_praise_sdk=SF_praise_sdk::findPostCount($uid);;  ?>
				<div class="zhengwen" id="wennr-wen">
                    <?php  echo $uid;  ?>
					<?php  echo $article->Content;  ?>
				</div>
				<div class="clear"></div>
				<?php if ($zbp->Config('mochu')->onzongzan =='1') { ?>
				<div class="wennr-zan">
				<?php if ($zbp->Config('mochu')->onzan=="1") { ?>
				<?php  echo $zbp->Config('mochu')->postzan;  ?>
				<?php }else{  ?>
					<a href="javascript:;" class="sf-praise-sdk" sfa='click' data-postid='<?php  echo $article->ID;  ?>' data-value="1">
<i class="fa fa-thumbs-o-up"></i><i class="sf-praise-sdk" sfa='num' data-value='1' data-postid='<?php  echo $article->ID;  ?>'><?php  echo $sf_praise_sdk->value1;  ?></i>人喜欢
</a><a href="javascript:;" class="sf-praise-sdk zshang" sfa='click' data-postid='<?php  echo $article->ID;  ?>' data-value="2">
<i class="fa fa-thumbs-o-down"></i><i class="sf-praise-sdk" sfa='num' data-value='2' data-postid='<?php  echo $article->ID;  ?>'><?php  echo $sf_praise_sdk->value2;  ?></i>人鄙视
</a><a href="javascript:;" id="ondashang" ><i class="fa fa-credit-card"></i>打赏本站</a><?php } ?>
				</div>
				<?php } ?>
				<div class="clear"></div>
                <?php if ($zbp->Config('mochu')->onfen=="1") { ?>
				<div class="wennr-fen">
				<?php  echo $zbp->Config('mochu')->postfen;  ?>
				</div><?php } ?>								
				<footer class="wennr-foot-cn">
					    <p><span>本文来源：</span><a href="<?php  echo $host;  ?>" target="_blank"><?php  echo $name;  ?></a> </p>
						<p><span>本文地址：</span><a href="<?php  echo $article->Url;  ?>"><?php  echo $article->Url;  ?></a></p>
                        <?php  echo $zbp->Config('mochu')->postwennrcop;  ?>
				</footer>			
			</article>
    <div class="clear"></div>
    <?php if ($zbp->Config('mochu')->postagdon3=="1") { ?>
    <div class="agd wnrg" ><?php  echo $zbp->Config('mochu')->postagd3;  ?></div>
    <?php } ?>
    <?php if ($zbp->Config('mochu')->postyagdon3=="1") { ?>
    <div class="yagd wnrg" ><?php  echo $zbp->Config('mochu')->postyagd3;  ?></div>
    <?php } ?>
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
