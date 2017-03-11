
<?php  include $this->GetTemplate('header');  ?>
<div class="container main">
		<div class="miaobao">
				<span class="place lf">当前位置：<a href="<?php  echo $host;  ?>" title="<?php  echo $name;  ?>">首页</a><?php if ($zbp->Config('mochu')->onmblei=='1') { ?><?php if ($article->Category->Parent) { ?><a href="<?php  echo $article->Category->Parent->Url;  ?>" class="dinglei" id="dinglei"> - <?php  echo $article->Category->Parent->Name;  ?></a><?php } ?><?php } ?> - <a href="<?php  echo $article->Category->Url;  ?>" title="分类 <?php  echo $article->Category->Name;  ?> 的全部文章" rel="category tag"><?php  echo $article->Category->Name;  ?></a> - 正文</span>
				<span class="yan lr"><?php  echo $zbp->Config('mochu')->postyan;  ?></span>
				<div class="clear"></div>
		</div>
		<div class="shop">
			<div class="wennr-top">
					<h1><a href="<?php  echo $article->Url;  ?>" title="<?php  echo $article->Title;  ?>"><?php  echo $article->Title;  ?></a></h1>
					<h6><i class="fa fa-clock-o"></i><?php  echo $article->Time('Y-m-d');  ?><i class="fa fa-folder-open"></i><a href="<?php  echo $article->Category->Url;  ?>" title="分类 <?php  echo $article->Category->Name;  ?> 的全部文章" rel="category tag"><?php  echo $article->Category->Name;  ?></a><i class="fa fa-user"></i><?php  echo $article->Author->StaticName;  ?><i class="fa fa-eye"></i><?php  echo $article->ViewNums;  ?>°c</h6>
					<span class="lr" id="fontsize"><a href="javascript:wennrsize(18)">A<sup>+</sup></a>&nbsp;<a href="javascript:wennrsize(15)">A<sup>-</sup></a></span>		
                    </div>
			<div class="shopimg lf">
				<img src="<?php  echo $article->Metas->mochu_tupian;  ?>" title="<?php  echo $article->Title;  ?>" alt="<?php  echo $article->Title;  ?>" />
			</div>
			<div class="shopul lf">
				<ul>
					<li><strong>适用程序：</strong><?php  echo $article->Metas->mochu_shiyong;  ?></li>
					<li><strong>模版价格：</strong><span><?php  echo $article->Metas->mochu_jiage;  ?></span>&nbsp;元</li>
					<li><strong>模板数量：</strong><span><?php  echo $article->Metas->mochu_yishou;  ?></span>&nbsp;套</li>
					<li><strong>更新日期：</strong><?php  echo $article->Time('Y-m-d');  ?>&nbsp;&nbsp;(此日期为主题/插件的更新时间)</li>
					<li><strong>主题特点：</strong><?php  echo $article->Metas->mochu_tedian;  ?></li>
				</ul>
				<div class="buy">
				<a href="<?php  echo $article->Metas->mochu_goumai;  ?>" target="_blank">点击购买</a>
				<a href="<?php  echo $article->Metas->mochu_zhuanzhang;  ?>" target="_blank">直接转帐</a>
				<a href="<?php  echo $article->Metas->mochu_yanshi;  ?>" target="_blank">演示地址</a>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="main-lf lf">
		<div class="mainct">
			<div class="wennr">
				<dd class="zhengwen" id="wennr-wen">
					<?php  echo $article->Content;  ?>
				</dd>
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
				<div class="wennr-foot-cn">
					    <p><span>本文来源：</span><a href="<?php  echo $host;  ?>" target="_blank"><?php  echo $name;  ?></a> </p>
						<p><span>本文地址：</span><a href="<?php  echo $article->Url;  ?>"><?php  echo $article->Url;  ?></a></p>
                        <?php  echo $zbp->Config('mochu')->postwennrcop;  ?>
				</div>
			</div>
			<?php if ($zbp->Config('mochu')->postagdon3=="1") { ?>
			<div class="agd wnrg" ><?php  echo $zbp->Config('mochu')->postagd3;  ?></div>
			<?php } ?>
			<?php if ($zbp->Config('mochu')->postyagdon3=="1") { ?>
			<div class="yagd wnrg" ><?php  echo $zbp->Config('mochu')->postyagd3;  ?></div>
			<?php } ?>
			<div class="xiangguan">
				<div class="xiangguan-txt">
						<div class="xiangguan-txt-lf lf"><i class="fa fa-line-chart"></i>推荐阅读</div>
						<div class="xiangguan-txt-lr lr">
				<?php if ($article->Tags) { ?>
				 标签：<?php  foreach ( $article->Tags as $tag) { ?><a href="<?php  echo $tag->Url;  ?>"  rel="tag"><?php  echo $tag->Name;  ?></a><?php }   ?>
				<?php }else{  ?>
				发布人：<a href="<?php  echo $article->Author->Url;  ?>"  rel="tag"><?php  echo $article->Author->StaticName;  ?></a>
				<?php } ?>
						</div>
				</div>
				<div class="xiangguan-ul">
					<ul>
				<?php  $aid=$article->ID;  ?>
				<?php  $tagid=$article->Tags;  ?>
				<?php  $cid=$article->Category->ID;  ?>
				<?php 
    			$str = '';
                $tagrd = '';
                $tagi = '';                
                if(empty($tagid)){
                $where = array(array('=','log_Status','0'),array('=','log_CateID',$cid),array('<>','log_ID',$aid));
                $order = array('log_ViewNums'=>'DESC');
                }else{
                $tagrd=array_rand($tagid);
                $tagi='%{'.$tagrd.'}%';
        		$where = array(array('=','log_Status','0'),array('like','log_Tag',$tagi),array('<>','log_ID',$aid));
                $order = array('log_ViewNums'=>'DESC');
                }    			
    			$array = $zbp->GetArticleList(array('*'),$where,$order,array(10),'');
				foreach ($array as $related){
  					if(($related->ID)!=$aid){
    					$str .="<li><span>•</span><a href=\"{$related->Url}\" title=\"{$related->Title}\">{$related->Title}</a></li>";
  					}}			            
				 ?>
                <?php  echo $str;  ?>
					<div class="clear"></div>
					</ul>
				<div class="clear"></div>
				</div>
			</div>
			<div class="nextnav">
			  	<div class="nextnav-lf lf">
                <span><i class="fa fa-angle-left"></i> 上一篇</span><?php if ($article->Prev) { ?><a href="<?php  echo $article->Prev->Url;  ?>" title="<?php  echo $article->Prev->Title;  ?>"><?php  echo $article->Prev->Title;  ?></a><?php }else{  ?>博主有点懒,啥也没写!<?php } ?>
				</div>
				<div class="nextnav-lf lf lfbo"><span>下一篇 <i class="fa fa-angle-right"></i></span>
				<?php if ($article->Next) { ?><a  href="<?php  echo $article->Next->Url;  ?>"  title="<?php  echo $article->Next->Title;  ?>"><?php  echo $article->Next->Title;  ?></span></a><?php }else{  ?><a href="<?php  echo $host;  ?>" title="<?php  echo $name;  ?>">没文章了，返回首页</a><?php } ?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
				<?php if ($zbp->Config('mochu')->postagdon4=="1") { ?>
				<div class="agd wnrg" ><?php  echo $zbp->Config('mochu')->postagd4;  ?></div>
				<?php } ?>
				<?php if ($zbp->Config('mochu')->postyagdon4=="1") { ?>
				<div class="yagd wnrg" ><?php  echo $zbp->Config('mochu')->postyagd4;  ?></div>
				<?php } ?>
				<?php if (!$article->IsLock) { ?>
				<div class="pinglun">
					<h3><i class="fa fa-comments-o"></i>发表评论</h3>
				<?php if ($zbp->Config('mochu')->onping=="0") { ?>
				<?php  include $this->GetTemplate('comments');  ?>
				<?php }else{  ?>
					<div class="pinglunnr">
				<?php  echo $zbp->Config('mochu')->postping;  ?>
					</div>
				<?php } ?>
				</div>
				<?php } ?>
		</div>
	</div>
	<div class="main-lr lf">
		<?php  include $this->GetTemplate('sidebar3');  ?>
		<?php if ($zbp->Config('mochu')->gensui3=="1") { ?>
		<div id="float" class="div1">
		<?php  include $this->GetTemplate('sidebar4');  ?>
		<div class="clear"></div>
		</div>
		<?php } ?>
	</div>
</div>
<?php  include $this->GetTemplate('footer');  ?>