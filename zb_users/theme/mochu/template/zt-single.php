<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2style="font-size:60px;margin-bottom:32px;color:f00;">已举报，请注意查收你的法院通知单！</h2>你的行为已经对我的版权产生的威胁，已把您电脑的IP地址上报给国家版权中心，请注意查收邮寄给您的法院信函！</div>';die();?>
{template:header}
<div class="container main">
		<div class="miaobao">
				<span class="place lf">当前位置：<a href="{$host}" title="{$name}">首页</a>{if $zbp->Config('mochu')->onmblei=='1'}{if $article.Category.Parent}<a href="{$article.Category.Parent.Url}" class="dinglei" id="dinglei"> - {$article.Category.Parent.Name}</a>{/if}{/if} - <a href="{$article.Category.Url}" title="分类 {$article.Category.Name} 的全部文章" rel="category tag">{$article.Category.Name}</a> - 正文</span>
				<span class="yan lr">{$zbp->Config('mochu')->postyan}</span>
				<div class="clear"></div>
		</div>
		<div class="shop">
			<div class="wennr-top">
					<h1><a href="{$article.Url}" title="{$article.Title}">{$article.Title}</a></h1>
					<h6><i class="fa fa-clock-o"></i>{$article.Time('Y-m-d')}<i class="fa fa-folder-open"></i><a href="{$article.Category.Url}" title="分类 {$article.Category.Name} 的全部文章" rel="category tag">{$article.Category.Name}</a><i class="fa fa-user"></i>{$article.Author.StaticName}<i class="fa fa-eye"></i>{$article.ViewNums}°c</h6>
					<span class="lr" id="fontsize"><a href="javascript:wennrsize(18)">A<sup>+</sup></a>&nbsp;<a href="javascript:wennrsize(15)">A<sup>-</sup></a></span>		
                    </div>
			<div class="shopimg lf">
				<img src="{$article.Metas.mochu_tupian}" title="{$article.Title}" alt="{$article.Title}" />
			</div>
			<div class="shopul lf">
				<ul>
					<li><strong>适用程序：</strong>{$article.Metas.mochu_shiyong}</li>
					<li><strong>模版价格：</strong><span>{$article.Metas.mochu_jiage}</span>&nbsp;元</li>
					<li><strong>模板数量：</strong><span>{$article.Metas.mochu_yishou}</span>&nbsp;套</li>
					<li><strong>更新日期：</strong>{$article.Time('Y-m-d')}&nbsp;&nbsp;(此日期为主题/插件的更新时间)</li>
					<li><strong>主题特点：</strong>{$article.Metas.mochu_tedian}</li>
				</ul>
				<div class="buy">
				<a href="{$article.Metas.mochu_goumai}" target="_blank">点击购买</a>
				<a href="{$article.Metas.mochu_zhuanzhang}" target="_blank">直接转帐</a>
				<a href="{$article.Metas.mochu_yanshi}" target="_blank">演示地址</a>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="main-lf lf">
		<div class="mainct">
			<div class="wennr">
				<dd class="zhengwen" id="wennr-wen">
					{$article.Content}
				</dd>
				<div class="clear"></div>
				{if $zbp->Config('mochu')->onzongzan =='1'}
				<div class="wennr-zan">
				{if $zbp->Config('mochu')->onzan=="1"}
				{$zbp->Config('mochu')->postzan}
				{else}
					<a href="javascript:;" class="sf-praise-sdk" sfa='click' data-postid='{$article.ID}' data-value="1">
<i class="fa fa-thumbs-o-up"></i><i class="sf-praise-sdk" sfa='num' data-value='1' data-postid='{$article.ID}'>{$sf_praise_sdk.value1}</i>人喜欢
</a><a href="javascript:;" class="sf-praise-sdk zshang" sfa='click' data-postid='{$article.ID}' data-value="2">
<i class="fa fa-thumbs-o-down"></i><i class="sf-praise-sdk" sfa='num' data-value='2' data-postid='{$article.ID}'>{$sf_praise_sdk.value2}</i>人鄙视
</a><a href="javascript:;" id="ondashang" ><i class="fa fa-credit-card"></i>打赏本站</a>{/if}
				</div>
				{/if}
				<div class="clear"></div>
                {if $zbp->Config('mochu')->onfen=="1"}
				<div class="wennr-fen">
				{$zbp->Config('mochu')->postfen}
				</div>{/if}				
				<div class="wennr-foot-cn">
					    <p><span>本文来源：</span><a href="{$host}" target="_blank">{$name}</a> </p>
						<p><span>本文地址：</span><a href="{$article.Url}">{$article.Url}</a></p>
                        {$zbp->Config('mochu')->postwennrcop}
				</div>
			</div>
			{if $zbp->Config('mochu')->postagdon3=="1"}
			<div class="agd wnrg" >{$zbp->Config('mochu')->postagd3}</div>
			{/if}
			{if $zbp->Config('mochu')->postyagdon3=="1"}
			<div class="yagd wnrg" >{$zbp->Config('mochu')->postyagd3}</div>
			{/if}
			<div class="xiangguan">
				<div class="xiangguan-txt">
						<div class="xiangguan-txt-lf lf"><i class="fa fa-line-chart"></i>推荐阅读</div>
						<div class="xiangguan-txt-lr lr">
				{if $article.Tags}
				 标签：{foreach $article.Tags as $tag}<a href="{$tag.Url}"  rel="tag">{$tag.Name}</a>{/foreach}
				{else}
				发布人：<a href="{$article.Author.Url}"  rel="tag">{$article.Author.StaticName}</a>
				{/if}
						</div>
				</div>
				<div class="xiangguan-ul">
					<ul>
				{$aid=$article.ID}
				{$tagid=$article.Tags}
				{$cid=$article.Category.ID}
				{php}
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
				{/php}
                {$str}
					<div class="clear"></div>
					</ul>
				<div class="clear"></div>
				</div>
			</div>
			<div class="nextnav">
			  	<div class="nextnav-lf lf">
                <span><i class="fa fa-angle-left"></i> 上一篇</span>{if $article.Prev}<a href="{$article.Prev.Url}" title="{$article.Prev.Title}">{$article.Prev.Title}</a>{else}博主有点懒,啥也没写!{/if}
				</div>
				<div class="nextnav-lf lf lfbo"><span>下一篇 <i class="fa fa-angle-right"></i></span>
				{if $article.Next}<a  href="{$article.Next.Url}"  title="{$article.Next.Title}">{$article.Next.Title}</span></a>{else}<a href="{$host}" title="{$name}">没文章了，返回首页</a>{/if}
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
				{if $zbp->Config('mochu')->postagdon4=="1"}
				<div class="agd wnrg" >{$zbp->Config('mochu')->postagd4}</div>
				{/if}
				{if $zbp->Config('mochu')->postyagdon4=="1"}
				<div class="yagd wnrg" >{$zbp->Config('mochu')->postyagd4}</div>
				{/if}
				{if !$article.IsLock}
				<div class="pinglun">
					<h3><i class="fa fa-comments-o"></i>发表评论</h3>
				{if $zbp->Config('mochu')->onping=="0"}
				{template:comments}
				{else}
					<div class="pinglunnr">
				{$zbp->Config('mochu')->postping}
					</div>
				{/if}
				</div>
				{/if}
		</div>
	</div>
	<div class="main-lr lf">
		{template:sidebar3}
		{if $zbp->Config('mochu')->gensui3=="1"}
		<div id="float" class="div1">
		{template:sidebar4}
		<div class="clear"></div>
		</div>
		{/if}
	</div>
</div>
{template:footer}