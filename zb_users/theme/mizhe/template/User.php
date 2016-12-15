{template:header}
<body class="{$type}">
	<div class="wrapper">
		{template:navbar}
		<div class="box">
			<div class="singlebox">
				<div class="single">
	                <div class="program">
		                <div class="proname"><h2>{$article.Title}</h2></div>
		                <div class="pagecon">
			              <div class="cmtinfo">



 

<table style="width:90%;border:none;font-size:1.1em;line-height:2.5em;">
<tr style=""><th style="border:none;" colspan="2" scope="col"><p>用户级别:'.$zbp->lang['user_level_name'][$zbp->user->Level].' <a href="'.$zbp->host.'?Upgrade" class="">购买升级会员</a></p></p></th></tr>
<tr style=""><th style="border:none;" colspan="2" scope="col"><p>用户积分:'.$Price.' <a href="'.$zbp->host.'?Integral" class="">购买积分</a></p></p></th></tr>
<tr><td style="text-align:right;border:none;">(*)用户名：</td><td  style="border:none;" ><input required="required" type="text" id="edtAlias" name="Alias" value="'.$zbp->user->StaticName.'" style="width:250px;font-size:1.2em;" /></td></tr>
<tr><td style="text-align:right;border:none;">(*)电话：</td><td  style="border:none;" ><input required="required" type="text" id="meta_Tel" name="meta_Tel" value="'.$zbp->user->Metas->Tel.'" style="width:250px;font-size:1.2em;" /></td></tr>
<tr><td style="text-align:right;border:none;">(*)会员地址：</td><td  style="border:none;" ><input required="required" type="text" id="meta_Add" name="meta_Add" value="'.$zbp->user->Metas->Add.'" style="width:250px;font-size:1.2em;" /></td></tr>
<tr><td style="text-align:right;border:none;">(*)邮箱：</td><td  style="border:none;" ><input type="text" id="edtEmail" name="Email" value="'.$zbp->user->Email.'" style="width:250px;font-size:1.2em;" /></td></tr>
<tr><td style="text-align:right;border:none;">网站：</td><td  style="border:none;" ><input type="text" id="edtHomePage" name="HomePage" value="'.$zbp->user->HomePage.'" style="width:250px;font-size:1.2em;" /></td></tr>
<tr><td style="text-align:right;border:none;">(*)摘要：</td><td  style="border:none;" ><textarea cols="3" rows="6" id="edtIntro" name="Intro" style="width:250px;font-size:1.2em;">'.$zbp->user->Intro.'</textarea>
</td></tr>
<tr><td style="text-align:right;border:none;">(*)</td><td  style="border:none;" ><input required="required" type="text" name="verifycode" style="width:150px;font-size:1.2em;" />&nbsp;&nbsp;<img style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=RegPage" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=RegPage&amp;tm=\'+Math.random();"/></td></tr>
<tr><td  style="border:none;" ></td><td  style="border:none;" ><button id="btnPost" onclick="return checkInfo();">确定</button></td></tr>';
</table>


                            <form class="ytuseredit" id="edit" method="post" action="#">
                            <input id="edtID" name="ID" type="hidden" value="{$user.ID}" />
                            <input id="edtGuid" name="Guid" type="hidden" value="{$user.Guid}" />
		                    <p><label for="inpName">名称(*)</label><input type="text" name="inpName" id="inpName" class="text" size="28" tabindex="1"></p>
	                        <p><label for="inpName">名称(*)</label><input type="text" name="inpEmail" id="inpEmail" class="text" size="28" tabindex="2"><label for="inpEmail">邮箱</label></p>
	                        <p><label for="inpName">名称(*)</label><input type="text" name="inpHomePage" id="inpHomePage" class="text" size="28" tabindex="3"><label for="inpHomePage">网址</label></p>
                            </form>
                            <script type="text/javascript">function checkInfo(){document.getElementById("edit").action="'.$zbp->host.'zb_users/plugin/YtUser/cmd.php?act=MemberPst&token='.$zbp->GetToken().'";}</script>
			              </div>
		                </div>
	                </div>
	                <div class="singlebanner">{$zbp->Config('mizhe')->PostSINGLEADS}</div>

	                {if !$article.IsLock}
	                {template:comments}
	                {/if}
                </div>
				<div class="sidebar">
					<div class="sidebox">
						<div class="sidetitle">
							<h3>大家正在买...</h3>
						</div>
						<div class="sidecon">
							<ul>
								{foreach GetList(5,$article.Category.ID) as $article}
								<li>
								{php}
								  $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
								  $content = $article->Content;
								  preg_match_all($pattern,$content,$matchContent);
								  if(isset($matchContent[1][0]))
								  $temp=$matchContent[1][0];
								  else
								  $temp="{$host}zb_users/theme/{$theme}/style/images/proimg.jpg";
								{/php}
									<div class="sideimg"><a href="{$article.Url}"><img src="{$temp}" alt="" /></a></div>
									<div class="sidename"><a href="{$article.Url}">{if $article.Metas.proprice}<em>￥{$article.Metas.proprice}</em> {else}暂无报价{/if}{$article.Title}</a></div>
									<div class="sidedetail"><span>{if $article.Metas.promarket}原价: <del>￥{$article.Metas.promarket}</del> {else}暂无报价 {/if}</span><a href="{$article.Url}">去抢购</a></div>
								</li>
								{/foreach}
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		
{template:sfooter}