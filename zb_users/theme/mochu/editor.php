<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('mochu')) {$zbp->ShowError(48);die();}


$act = "";
if ($_GET['act']){
$act = $_GET['act'] == " " ? 'jiben' : $_GET['act'];
}
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
?>
<script src="source/colorse/jscolor.js" type="text/javascript"></script>
<div id="divMain">
	<div class="divHeader">墨初主题高级版配置&nbsp;&nbsp;&nbsp;V3.2版本</div>
	<div class="SubMenu"><?php mochu_SubMenu($act);?><a target="_blank" href="http://feiniaomy.com/mochuvip.html" style="float: right;"><span class="m-right " style="color:#FF0000">反馈/帮助</span></a><a target="_blank" href="http://feiniaomy.com/post/17.html" style="float: right;"><span class="m-right " style="color:#FF0000">发布/更新</span></a></div>
	<div id="divMain2">	
<!--前台样式-->
<?php if ($act == 'yangshi'){	
if(isset($_POST['onbgimg']))
	{   $zbp->Config('mochu')->ondingbg = $_POST['ondingbg'];
		$zbp->Config('mochu')->onbgimg = $_POST['onbgimg'];
		$zbp->Config('mochu')->onbgcolor = $_POST['onbgcolor'];
		$zbp->Config('mochu')->onlju = $_POST['onlju'];
		$zbp->Config('mochu')->onrju = $_POST['onrju'];
		$zbp->Config('mochu')->onacolor = $_POST['onacolor'];
		$zbp->Config('mochu')->onzhicolor = $_POST['onzhicolor'];
		$zbp->Config('mochu')->onnavcolor = $_POST['onnavcolor'];
		$zbp->Config('mochu')->tagcelan = $_POST['tagcelan'];
		  $zbp->Config('mochu')->zikuanon = $_POST['zikuanon'];	
		$zbp->SaveConfig('mochu');
		$zbp->ShowHint('good');
		mochu_yangshi();
	}
	?>
<table width="100%" border="1">
<tr><td colspan="3" height="35"  style="font-size:16px;">前台样式设置</td></tr>
<tr><td colspan="" width="300"><form enctype="multipart/form-data" method="post" action="save.php?type=bgimg"><p align="center"><input name="bgimg.png" type="file" style=" width:70px;"/><input name="" type="Submit" class="button" value="上传背影图片"/></p></form></td>
<form id="yangshi" method="post">
<td width="300">背景图片开关：<input type="text"  name="onbgimg" class="checkbox" value="<?php echo $zbp->Config('mochu')->onbgimg;?>"/></td>
<td>主体背景颜色：<input type="text" class="color" name="onbgcolor" value="<?php echo $zbp->Config('mochu')->onbgcolor;?>" /></td>
</tr>
<tr >
<td>背景图设置</td>
<td><p align="left">固定图片：<input type="text"  name="ondingbg" class="checkbox" value="<?php echo $zbp->Config('mochu')->ondingbg;?>"/></p><br /><p align="left">左边距：<input type="text" name="onlju" style="width:50px;" value="<?php echo $zbp->Config('mochu')->onlju;?>"/>&nbsp;&nbsp;&nbsp;上边距：<input type="text" name="onrju" style="width:50px;" value="<?php echo $zbp->Config('mochu')->onrju;?>"/></p></td>
<td>启用背景图片后此选项才会生效。<br />默认的图片背景为平铺,固定图片开关开启后，平铺失效。</td>
</tr>
<tr>
<td>颜色设置</td>
<td><p align="left">鼠标经过：<input type="text" class="color" name="onacolor" value="#<?php echo $zbp->Config('mochu')->onacolor;?>" /></p><br /><p align="left">推荐颜色：<input type="text" class="color" value="<?php echo $zbp->Config('mochu')->onzhicolor;?>" name="onzhicolor" /></p><br /><p align="left">主体颜色：<input type="text" class="color" value="<?php echo $zbp->Config('mochu')->onnavcolor;?>" name="onnavcolor" /></p></td>
<td>鼠标经过：鼠标经过A标签时的颜色<br />推荐颜色：置顶文章前面的“推荐”两个字颜色<br />主体颜色：导航高亮,侧栏多个tab选项,文章内容H标签,分页条等</td>
</tr>
<tr height="35">
<td>彩色云标签</td>
<td><p align="center"><input type="text"  name="tagcelan" class="checkbox" value="<?php echo $zbp->Config('mochu')->tagcelan;?>"/></p></td>
<td>开关开启后，随机标签，热门标签，标签模块会以彩色云标签的形式展现</td>
</tr>
      <tr height="35"> 
    <td>宽屏开关</td>
    <td><p align="center"> <input type="text" id="zikuanon" name="zikuanon" class="checkbox" value="<?php echo $zbp->Config('mochu')->zikuanon;?>"/>
	</p></td>
    <td>屏幕宽度超过1600px会自适应宽屏版，如果不想大屏幕下显示宽屏请关闭开关</td>
  </tr> 
</table>
<br />
<table>
<tr>
<td style="height:40px;  padding:5px 20px;"><a href="save.php?type=duzhe">缓存读者墙(点击)</a></td>
<td style="height:40px;  padding:5px 20px;"><a href="save.php?type=guidang">缓存文章归档（点击）</a></td>
</tr>
</table>
<br/>
<input name="" type="Submit" class="button" value="保存配置"/>
</form>
<?php }?>
<!--网站公告-->
<?php if ($act == 'gonggao'){	
if(isset($_POST['postgao']))
	{  $zbp->Config('mochu')->postgao = $_POST['postgao'];
	   $zbp->Config('mochu')->ongaocolor = $_POST['ongaocolor'];
        $zbp->SaveConfig('mochu');
		$zbp->ShowHint('good');
		mochu_yangshi();
	}
?>
<form id="gonggao" method="post" >
<table width="100%">
   <tr height="40">
    <td scope="col" width="150"><p align="center">名称</p></td>
    <td scope="col"><p align="center">内容</p></td>
	<td scope="col" width="50"><p align="center">字体颜色</p></td>
    <td scope="col" width="300"><p align="center">备注</p></td>
  </tr>
  <tr>
    <td>首页公告</td>
    <td><textarea name="postgao" id="postgao" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->postgao;?></textarea></td>
    <td><p align="center"><input type="text" id="ongaocolor" name="ongaocolor" class="color" value="<?php echo $zbp->Config('mochu')->ongaocolor;?>"/></p></td>
	<td>首页公告,可以插入A标签</td>
  </tr>
</table>
<br />
<input name="" type="Submit" class="button" value="保存配置"/></form>
<br />
<?php }?>
<!--网站基本设置-->
<?php if ($act == 'jiben'){	
if(isset($_POST['postnav']))
	{  $zbp->Config('mochu')->onimg = $_POST['onimg'];
	   $zbp->Config('mochu')->onlink = $_POST['onlink'];   
       $zbp->Config('mochu')->onzhiimg = $_POST['onzhiimg'];
	   $zbp->Config('mochu')->postshop = $_POST['postshop'];  
	   $zbp->Config('mochu')->onslimg = $_POST['onslimg']; 
	   $zbp->Config('mochu')->ontnav = $_POST['ontnav'];
	   $zbp->Config('mochu')->onydnav = $_POST['onydnav'];
	   $zbp->Config('mochu')->onmblei = $_POST['onmblei']; 
	   $zbp->Config('mochu')->onzan = $_POST['onzan']; 
	   $zbp->Config('mochu')->onzongzan = $_POST['onzongzan']; 
	   $zbp->Config('mochu')->postping = $_POST['postping']; 
	   $zbp->Config('mochu')->onping = $_POST['onping']; 	 
	   $zbp->Config('mochu')->gensui = $_POST['gensui']; 
	   $zbp->Config('mochu')->gensui2 = $_POST['gensui2']; 
	   $zbp->Config('mochu')->gensui3 = $_POST['gensui3']; 
	   $zbp->Config('mochu')->postnav = $_POST['postnav'];
	   $zbp->Config('mochu')->postydnav = $_POST['postydnav'];
	   $zbp->Config('mochu')->postyan = $_POST['postyan'];
       $zbp->Config('mochu')->postlian = $_POST['postlian'];
	   $zbp->Config('mochu')->postpage = $_POST['postpage'];   
	   $zbp->Config('mochu')->postzan = $_POST['postzan'];	   
	   $zbp->Config('mochu')->peizhishuju = $_POST['peizhishuju'];
	   $zbp->Config('mochu')->postguon = $_POST['postguon'];
	   $zbp->Config('mochu')->postguping = $_POST['postguping'];	   
	   $zbp->Config('mochu')->postguqq = $_POST['postguqq'];
	   $zbp->Config('mochu')->keywords = $_POST['keywords'];	   
	   $zbp->Config('mochu')->description = $_POST['description'];	
	   $zbp->Config('mochu')->postbaidu = $_POST['postbaidu'];
	   $zbp->Config('mochu')->postwennrcop = $_POST['postwennrcop'];
	   $zbp->Config('mochu')->baisouon = $_POST['baisouon'];
	   $zbp->Config('mochu')->headlink = $_POST['headlink'];		   	      	   
	   $zbp->SaveConfig('mochu');
	   $zbp->ShowHint('good');
		mochu_yangshi();
	}
?>
<table width="100%" border="1">
<tr height="35"><td colspan="2"><p align="left" style="color:#FF0000;">主题客服QQ：540344537 备注：VIP主题 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;使用主题前请查看右上角的帮助与反馈！</p></td></tr>
<tr>
<td width="49%"> <form enctype="multipart/form-data" method="post" action="save.php?type=logo">
<p align="center">网站logo：240*48  <input name="logo.png" type="file"/><input name="" type="Submit" class="button" value="上传"/></p>
</form></td>
<td>说明：PC版的LOGO与移动版的LOGO二合一，共用一个LOGO文件，请按要求制作</td>
</tr>
<tr>
<td width="49%"><form enctype="multipart/form-data" method="post" action="save.php?type=erweio">
    <p align="center"> 底部右则二维码图：110*110 <input name="erweio.png" type="file"/><input name="" type="Submit" class="button" value="上传"/></p>
</form></td>
<td width="49%"> <form enctype="multipart/form-data" method="post" action="save.php?type=zanwei">
<p align="center">微信打赏二维码：200*200  <input name="zanwei.png" type="file"/><input name="" type="Submit" class="button" value="上传"/></p></form></td>
</tr>
<tr>
<td width="49%"> <form enctype="multipart/form-data" method="post" action="save.php?type=qq">
<p align="center">QQ打赏二维码：200*200  <input name="qq.png" type="file"/><input name="" type="Submit" class="button" value="上传"/></p></form></td>
<td width="49%"><form enctype="multipart/form-data" method="post" action="save.php?type=zanzhi">
<p align="center">支付宝打赏二维码：200*200  <input name="zanzhi.png" type="file"/><input name="" type="Submit" class="button" value="上传"/></p></form></td>
</tr>
<tr height="35"><td colspan="2"><p align="center" style="color:#FF0000;">上面所有上传的图片皆为PNG格式</p></td></tr>
<tr><td colspan="2"><form enctype="multipart/form-data" method="post" action="save.php?type=ico">
<p align="center">favicon图标：16*16 (ico格式)  <input name="favicon.ico" type="file"/><input name="" type="Submit" class="button" value="上传"/></p></form></td></tr>
</table>
<form id="jiben" method="post">	
<table width="100%" border="1">
  <tr height="35"> 
    <td><p align="left" style=" color:#F00">主题配置数据库</p></td>
    <td><p align="center"><input type="text" id="peizhishuju" name="peizhishuju" class="checkbox" value="<?php echo $zbp->Config('mochu')->peizhishuju;?>"/></p></td>
    <td>切换主题时是否删除主题配置数据与侧栏模块,默认关闭</td>
  </tr>
  <tr height="35"> 
    <td><p align="left" style=" color:#F00">商品模块开关</p></td>
    <td><p align="center"><input type="text" id="postshop" name="postshop" class="checkbox" value="<?php echo $zbp->Config('mochu')->postshop;?>"/></p></td>
    <td>如果你不需要发布带有商品信息的文章,请关闭此顶,默认开启</td>
  </tr>  
   <tr height="35"> 
    <td>侧栏跟随模块</td>
    <td><p align="center">首页:<input type="text" id="gensui" name="gensui" class="checkbox" value="<?php echo $zbp->Config('mochu')->gensui;?>"/>
	&nbsp;&nbsp;&nbsp;分类页:<input type="text" id="gensui2" name="gensui2" class="checkbox" value="<?php echo $zbp->Config('mochu')->gensui2;?>"/>
	&nbsp;&nbsp;&nbsp;内容页:<input type="text" id="gensui3" name="gensui3" class="checkbox" value="<?php echo $zbp->Config('mochu')->gensui3;?>"/>
	</p></td>
    <td>跟随内容请在模块中，添加到侧栏4</td>
  </tr>
  <tr height="35"> 
    <td>非置顶文章列表缩略图</td>
    <td><p align="center"><input type="text" id="onimg" name="onimg" class="checkbox" value="<?php echo $zbp->Config('mochu')->onimg;?>"/></p></td>
    <td>关闭后首页，文章列表页，标签页非置顶文章列表不再显示缩略图</td>
  </tr>
  <tr height="35"> 
    <td>置顶文章列表缩略图</td>
    <td><p align="center"><input type="text" id="onzhiimg" name="onzhiimg" class="checkbox" value="<?php echo $zbp->Config('mochu')->onzhiimg;?>"/></p></td>
    <td>关闭后首页，文章列表页，标签页置顶文章列表不再显示缩略图</td>
  </tr>  
  <tr height="35"> 
    <td>无图时随机替换缩略图</td>
    <td><p align="center"><input type="text" id="onslimg" name="onslimg" class="checkbox" value="<?php echo $zbp->Config('mochu')->onslimg;?>"/></p></td>
    <td>关闭后首页，文章列表页，标签页列表无缩略图时显示随机替换缩略图，缩略天关关闭时无效</td>
  </tr> 
 <tr height="35"> 
    <td>面包屑导航顶级分类</td>
    <td><p align="center"><input type="text" id="onmblei" name="onmblei" class="checkbox" value="<?php echo $zbp->Config('mochu')->onmblei;?>"/></p></td>
    <td>关闭顶级分类无法显示,屏幕的分辨率宽度小于480px时，会自动隐藏，此开关失效</td>
  </tr>   
 <tr height="35"> 
    <td>文章内容页点赞总开关</td>
    <td><p align="center"><input type="text" id="onzongzan" name="onzongzan" class="checkbox" value="<?php echo $zbp->Config('mochu')->onzongzan;?>"/></p></td>
    <td>使用应用中心点赞插件时,请关闭此项。关闭此顶后，主题自带的点赞插件与第三方点赞插件失效</td>
  </tr>
  <tr height="35"> 
    <td>全站友情链接开关</td>
    <td><p align="center"> <input type="text" id="onlink" name="onlink" class="checkbox" value="<?php echo $zbp->Config('mochu')->onlink;?>"/>
	</p></td>
    <td>开关开启后，在所有页面显示友情链接;关闭后，只在首页显示友情链接;</td>
  </tr> 
</table>
<br />
<table width="100%" border="1">
  <tr height="40">
    <td scope="col" width="150"><p align="center">名称</p></td>
    <td scope="col"><p align="center">内容</p></td>
	<td scope="col" width="50"><p align="center">开关</p></td>
    <td scope="col" width="300"><p align="center">备注</p></td>
  </tr>
       <tr>
    <td>头部右上角A标签</td>
    <td><textarea name="headlink" id="headlink" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->headlink;?></textarea>
	</td>
	<td></td>
    <td>头部右上角几个链接，分辨率低的情况下会隐藏</td>
  </tr>
     <tr>
    <td>博客首页描述</td>
    <td><textarea name="description" id="description" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->description;?></textarea>
	</td>
	<td></td>
    <td>主题首页的描述</td>
  </tr>
       <tr>
    <td>博客首页关键字</td>
    <td><textarea name="keywords" id="keywords" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->keywords;?></textarea>
	</td>
	<td></td>
    <td>主题首页的关键字，多个用英文逗号分割</td>
  </tr>
   <tr>
    <td>PC导航条</td>
    <td><textarea name="postnav" id="postnav" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->postnav;?></textarea>
	</td>
	<td><p align="center"><input type="text" id="ontnav" name="ontnav" class="checkbox" value="<?php echo $zbp->Config('mochu')->ontnav;?>"/></p></td>
    <td>开关开启后此项才会生效，否则会调用模块中的导航模块,二级菜单请用UL嵌套<br />三个ico图标，用span标签，id为：#new,#new2,#hot</td>
  </tr>
   <tr>
    <td>移动导航条</td>
    <td><textarea name="postydnav" id="postydnav" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->postydnav;?></textarea></td>
	<td><p align="center"><input type="text" id="onydnav" name="onydnav" class="checkbox" value="<?php echo $zbp->Config('mochu')->onydnav;?>"/></p></td>
    <td>同上,但二级菜单尽量不要使用</td>
  </tr>
   <tr>
    <td>第三方站内搜索</td>
    <td><textarea name="postbaidu" id="postbaidu" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->postbaidu;?></textarea></td>
	<td><p align="center"><input type="text" id="baisouon" name="baisouon" class="checkbox" value="<?php echo $zbp->Config('mochu')->baisouon;?>"/></p></td>
    <td>可添加百度,360等站内搜索，不懂查看主题帮助,不使用要关闭开关</td>
  </tr>  
  <tr>
    <td>公告右则</td>
    <td><textarea name="postyan" id="postyan" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->postyan;?></textarea></td>
	<td></td>
    <td>面包屑导航右则一句话，分辨率低的情况下会隐藏</td>
  </tr>
  <tr>
    <td>页底二维码右则二个A链接</td>
    <td><textarea name="postlian" id="postlian" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->postlian;?></textarea></td>
	<td></td>
    <td>直接使用A标签即可，限制数量为两个A标签</td>
  </tr>
  <tr>
    <td>页底本站相关内容</td>
    <td><textarea name="postpage" id="postpage" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->postpage;?></textarea></td>
	<td></td>
    <td>本站相关内容，使用LI标签，并内嵌带有文本“•”的span标签</td>
  </tr>
    <tr>
    <td>内容页正文下文章来源后几行</td>
    <td><textarea name="postwennrcop" id="postwennrcop" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->postwennrcop;?></textarea></td>
	<td></td>
    <td>使用P标签,请按格式书写</td>
  </tr>
     <tr>
    <td>文章内容底部第三方点赞代码</td>
    <td><textarea name="postzan" id="postzan" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->postzan;?></textarea></td>
	<td><p align="center"><input type="text" id="onzan" name="onzan" class="checkbox" value="<?php echo $zbp->Config('mochu')->onzan;?>"/></p></td>
    <td>直接加入代码即可,开关关闭后启用主题自带插件</td>
  </tr>
  <tr>
    <td>第三方评论代码</td>
    <td><textarea name="postping" id="postping" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->postping;?></textarea></td>
	<td><p align="center"><input type="text" id="onping" name="onping" class="checkbox" value="<?php echo $zbp->Config('mochu')->onping;?>"/></p></td>
    <td>开关开启后,此代码才会生效</td>
  </tr>    
    <tr>
    <td>右则返回顶部</td>
    <td><p align="left">QQ号：<input name="postguqq" value="<?php echo $zbp->Config('mochu')->postguqq;?>" id="postguqq" ></p><p align="left">留言页地址：<input style=" width:70%;" name="postguping" id="postguping" type="text" value="<?php echo $zbp->Config('mochu')->postguping;?>" ></p></td>
	<td><p align="center"><input style=" width:70%;" type="text" id="postguon" name="postguon" class="checkbox" value="<?php echo $zbp->Config('mochu')->postguon;?>"/></p></td>
    <td>开关开启后才会生效</td>
  </tr>    
 </table>
 <br />
<input name="" type="Submit" class="button" value="保存配置"/>
</form>
 <br />
<?php }?>
<!--幻灯片设置-->
<?php if ($act == 'huandeng'){	
if(isset($_POST['onhuandeng']))
	{  
	    $zbp->Config('mochu')->onhuandeng = $_POST['onhuandeng']; 
		$zbp->Config('mochu')->onoffdeng = $_POST['onoffdeng']; 
		$zbp->SaveConfig('mochu');
		$zbp->ShowHint('good');
		mochu_huandeng($Mochu_CMS_Table,$Mochu_CMS_DataInfo);
	}
?>
 <table width="100%" border="1">
                <tr>
                    <th scope="col" width="20" height="32" nowrap="nowrap">序号</th>
                    <th scope="col" width="80">标题</th>
                    <th scope="col" width="350">图片</th>
                    <th scope="col" width="230">链接</th>
                    <th scope="col" width="40">排序</th>
                    <th scope="col" width="40">显示</th>
                    <th scope="col" width="90">操作</th>
                </tr>
 <form action="save.php?type=flash" method="post"  enctype="multipart/form-data">     
	   <tr>
        <td align="center">0</td>
        <td><input type="text" class="sedit" name="title" value=""style="width:95%;"/ ></td>
       <td> 
	  <p align="center"> 地址：<input type="text"  name="img" value="" style="width:40%;"/>
	     <input type="file" id="fileElem"  name="img" id="img"  value="" style="width:40%;" />
	 </p>
	   </td>
        <td><input type="text" class="sedit" name="url" value="http://" style="width:95%;"/></td>
        <td><input type="text" name="order" value="10" style="width:40px"></td>
        <td><input type="text" class="checkbox" name="IsUsed" value="1" /></td>
       <td><input type="hidden" name="editid" value="">
        <input name="add" type="submit" class="button" value="增加"/>        </tr>
      </form>
<?php
        $where = array(array('=','sean_Type','0'));
        $order = array('sean_IsUsed'=>'DESC','sean_Order'=>'ASC');
        $sql= $zbp->db->sql->Select($Mochu_CMS_Table,'*',$where,$order,null,null);
        $array=$zbp->GetListCustom($Mochu_CMS_Table,$Mochu_CMS_DataInfo,$sql);
        $i =1; $str = "";
        foreach ($array as $key => $reg) {
            $str .= '<form action="save.php?type=flash" method="post" name="flash" enctype="multipart/form-data" >';
            $str .= '<tr>';
            $str .= '<td align="center">'.$i.'</td>';
            $str .= '<td><input type="text" name="title" value="'.$reg->Title.'" ></td>';
            $str .= '<td><input type="text"  name="img" value="'.$reg->Img.'" style="width:95%;"/ > <img src="'.$reg->Img.'"width="200"></td>';
            $str .= '<td><input type="text" name="url" value="'.$reg->Url.'"style="width:95%;" ></td>';
            $str .= '<td><input type="text" class="sedit" name="order" value="'.$reg->Order.'" style="width:40px"></td>';
            $str .= '<td><input type="text" class="checkbox" name="IsUsed" value="'.$reg->IsUsed.'" /></td>';
            $str .= '<td nowrap="nowrap">
                        <input type="hidden" name="editid" value="'.$reg->ID.'">
                        <input name="edit" type="submit" class="button" value="修改"/>
                        <input name="del" type="button" class="button" value="删除" onclick="if(confirm(\'您确定要进行删除操作吗？\')){location.href=\'save.php?type=flashdel&id='.$reg->ID.'\'}"/>
                    </td>';
            $str .= '</tr>';
            $str .= '</form>';
            $i++;
        }
echo $str;
?>
 </table>
<br />
<table width="100%" border="1" >
<tr>
<td colspan="4" bgcolor="#FFFF00";><p align="center">注意：幻灯片的排序为从小到大排列！每次修改幻灯片数据后，请重新在后台首页编译模版！</p></td>
</tr>
<tr>
<td>开关</td>
<td>
<form id="huandeng" method="post">	<p align="center"><input type="text" id="onhuandeng" name="onhuandeng" class="checkbox" value="<?php echo $zbp->Config('mochu')->onhuandeng;?>"/></p></td>
<td>开关关闭后主题首页不显示幻灯片<br />注意：上传的图片大小为900PX*300PX,最多为五条信息,已做自适应处理！<br />注意：开启幻灯片后必须重新编辑模版才会生效！</td>
<td></td>
</tr>
<tr>
<td>开关</td>
<td ><p align="center"><input type="text" id="onoffdeng" name="onoffdeng" class="checkbox" value="<?php echo $zbp->Config('mochu')->onoffdeng;?>"/></p></td>
<td>开启后切换主题时，会删除幻灯片数据库。</td>
<td></td>
 </tr>
</table>
<br />
<input name="" type="Submit" class="button" value="保存配置"/>
</form>
<br />
<?php }?>
<!--AD-->
<?php if ($act == 'agd'){	
if(isset($_POST['postagd']))
	{  $zbp->Config('mochu')->postagd = $_POST['postagd'];
		$zbp->Config('mochu')->postagdon = $_POST['postagdon'];
		$zbp->Config('mochu')->postyagd = $_POST['postyagd'];
		$zbp->Config('mochu')->postyagdon = $_POST['postyagdon'];
		$zbp->Config('mochu')->postagd2 = $_POST['postagd2'];
		$zbp->Config('mochu')->postagdon2 = $_POST['postagdon2'];
		$zbp->Config('mochu')->postyagd2 = $_POST['postyagd2'];
		$zbp->Config('mochu')->postyagdon2 = $_POST['postyagdon2'];
		$zbp->Config('mochu')->postagd3 = $_POST['postagd3'];
		$zbp->Config('mochu')->postagdon3 = $_POST['postagdon3'];
		$zbp->Config('mochu')->postyagd3 = $_POST['postyagd3'];
		$zbp->Config('mochu')->postyagdon3 = $_POST['postyagdon3'];
		$zbp->Config('mochu')->postagd4 = $_POST['postagd4'];
		$zbp->Config('mochu')->postagdon4 = $_POST['postagdon4'];
		$zbp->Config('mochu')->postyagd4 = $_POST['postyagd4'];
		$zbp->Config('mochu')->postyagdon4 = $_POST['postyagdon4'];	
		$zbp->Config('mochu')->postagd5 = $_POST['postagd5'];
		$zbp->Config('mochu')->postagdon5 = $_POST['postagdon5'];
		$zbp->Config('mochu')->postyagd5 = $_POST['postyagd5'];
		$zbp->Config('mochu')->postyagdon5 = $_POST['postyagdon5'];
		$zbp->Config('mochu')->postagd6 = $_POST['postagd6'];
		$zbp->Config('mochu')->postagdon6 = $_POST['postagdon6'];
		$zbp->Config('mochu')->postyagd6 = $_POST['postyagd6'];
		$zbp->Config('mochu')->postyagdon6 = $_POST['postyagdon6'];
		$zbp->Config('mochu')->postagd7 = $_POST['postagd7'];
		$zbp->Config('mochu')->postagdon7 = $_POST['postagdon7'];
		$zbp->Config('mochu')->postyagd7 = $_POST['postyagd7'];
		$zbp->Config('mochu')->postyagdon7 = $_POST['postyagdon7'];									
		$zbp->SaveConfig('mochu');
		$zbp->ShowHint('good');
	}
?>
<form id="agd" method="post">
<table width="100%" border="1">
  <tr>
    <td scope="col" width="150"><p align="center">名称</p></td>
    <td scope="col" width="600"><p align="center">内容</p></td>
    <td scope="col" width="60"><p align="center">开关</p></td>
    <td scope="col" ><p align="center">说明</p></td>
  </tr>
  <tr>
    <td>首页PC广告：</td>
    <td><textarea name="postagd" id="postagd" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->postagd;?></textarea></td>
    <td><p align="center"><input type="text" id="postagdon" name="postagdon" class="checkbox" value="<?php echo $zbp->Config('mochu')->postagdon;?>"/></p></td>
    <td>PC版广告位，分辨率低于640PX后自动隐藏。<br />900PX>广告宽度>750PX,高度不限.会自适应</td>
  </tr>
    <tr>
    <td>首页移动广告：</td>
    <td><textarea name="postyagd" id="postyagd" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->postyagd;?></textarea></td>
    <td><p align="center"><input type="text" id="postyagdon" name="postyagdon" class="checkbox" value="<?php echo $zbp->Config('mochu')->postyagdon;?>"/></p></td>
    <td>移动版广告位，分辨率高于640PX时隐藏，低于640PX后显示。<br />广告宽度:600PX,高度不限.会自适应</td>
  </tr>
  
  <tr>
    <td>分类页PC广告：</td>
    <td><textarea name="postagd2" id="postagd2" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->postagd2;?></textarea></td>
    <td><p align="center"><input type="text" id="postagdon2" name="postagdon2" class="checkbox" value="<?php echo $zbp->Config('mochu')->postagdon2;?>"/></p></td>
    <td>PC版广告位，分辨率低于640PX后自动隐藏。<br />900PX>广告宽度>750PX,高度不限.会自适应</td>
  </tr>
    <tr>
    <td>分类页移动广告：</td>
    <td><textarea name="postyagd2" id="postyagd2" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->postyagd2;?></textarea></td>
    <td><p align="center"><input type="text" id="postyagdon2" name="postyagdon2" class="checkbox" value="<?php echo $zbp->Config('mochu')->postyagdon2;?>"/></p></td>
    <td>移动版广告位，分辨率高于640PX时隐藏，低于640PX后显示。<br />广告宽度:600PX,高度不限.会自适应</td>
  </tr>  
  
  <tr>
    <td>内容页PC广告1：</td>
    <td><textarea name="postagd3" id="postagd3" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->postagd3;?></textarea></td>
    <td><p align="center"><input type="text" id="postagdon3" name="postagdon3" class="checkbox" value="<?php echo $zbp->Config('mochu')->postagdon3;?>"/></p></td>
    <td>PC版广告位，分辨率低于640PX后自动隐藏。<br />900PX>广告宽度>750PX,高度不限.会自适应</td>
  </tr>
    <tr>
    <td>内容页移动广告1：</td>
    <td><textarea name="postyagd3" id="postyagd3" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->postyagd3;?></textarea></td>
    <td><p align="center"><input type="text" id="postyagdon3" name="postyagdon3" class="checkbox" value="<?php echo $zbp->Config('mochu')->postyagdon3;?>"/></p></td>
    <td>移动版广告位，分辨率高于640PX时隐藏，低于640PX后显示。<br />广告宽度:600PX,高度不限.会自适应</td>
  </tr> 
  <tr>
    <td>内容页PC广告2：</td>
    <td><textarea name="postagd4" id="postagd4" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->postagd4;?></textarea></td>
    <td><p align="center"><input type="text" id="postagdon4" name="postagdon4" class="checkbox" value="<?php echo $zbp->Config('mochu')->postagdon4;?>"/></p></td>
    <td>PC版广告位，分辨率低于640PX后自动隐藏。<br />900PX>广告宽度>750PX,高度不限.会自适应</td>
  </tr>
    <tr>
    <td>内容页移动广告2：</td>
    <td><textarea name="postyagd4" id="postyagd4" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->postyagd4;?></textarea></td>
    <td><p align="center"><input type="text" id="postyagdon4" name="postyagdon4" class="checkbox" value="<?php echo $zbp->Config('mochu')->postyagdon4;?>"/></p></td>
    <td>移动版广告位，分辨率高于640PX时隐藏，低于640PX后显示。<br />广告宽度:600PX,高度不限.会自适应</td>
  </tr>
    <tr>
    <td>首页导航下方PC广告位：</td>
    <td><textarea name="postagd5" id="postagd5" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->postagd5;?></textarea></td>
    <td><p align="center"><input type="text" id="postagdon5" name="postagdon5" class="checkbox" value="<?php echo $zbp->Config('mochu')->postagdon5;?>"/></p></td>
    <td>PC版广告位，分辨率低于640PX后自动隐藏。<br />900PX>广告宽度>1200PX,高度不限.会自适应</td>
  </tr>
    <tr>
    <td>首页导航下方移动广告位：</td>
    <td><textarea name="postyagd5" id="postyagd5" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->postyagd5;?></textarea></td>
    <td><p align="center"><input type="text" id="postyagdon5" name="postyagdon5" class="checkbox" value="<?php echo $zbp->Config('mochu')->postyagdon5;?>"/></p></td>
    <td>移动版广告位，分辨率高于640PX时隐藏，低于640PX后显示。<br />广告宽度:600PX,高度不限.会自适应</td>
  </tr> 
     <tr>
    <td>分类页导航下方PC广告位：</td>
    <td><textarea name="postagd6" id="postagd6" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->postagd6;?></textarea></td>
    <td><p align="center"><input type="text" id="postagdon6" name="postagdon6" class="checkbox" value="<?php echo $zbp->Config('mochu')->postagdon6;?>"/></p></td>
    <td>PC版广告位，分辨率低于640PX后自动隐藏。<br />900PX>广告宽度>1200PX,高度不限.会自适应</td>
  </tr>
    <tr>
    <td>分类页导航下方移动广告位：</td>
    <td><textarea name="postyagd6" id="postyagd6" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->postyagd6;?></textarea></td>
    <td><p align="center"><input type="text" id="postyagdon6" name="postyagdon6" class="checkbox" value="<?php echo $zbp->Config('mochu')->postyagdon6;?>"/></p></td>
    <td>移动版广告位，分辨率高于640PX时隐藏，低于640PX后显示。<br />广告宽度:600PX,高度不限.会自适应</td>
  </tr> 
       <tr>
    <td>文章页导航下方PC广告位：</td>
    <td><textarea name="postagd7" id="postagd7" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->postagd7;?></textarea></td>
    <td><p align="center"><input type="text" id="postagdon7" name="postagdon7" class="checkbox" value="<?php echo $zbp->Config('mochu')->postagdon7;?>"/></p></td>
    <td>PC版广告位，分辨率低于640PX后自动隐藏。<br />900PX>广告宽度>1200PX,高度不限.会自适应</td>
  </tr>
    <tr>
    <td>文章页导航下方移动广告位：</td>
    <td><textarea name="postyagd7" id="postyagd7" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->postyagd7;?></textarea></td>
    <td><p align="center"><input type="text" id="postyagdon7" name="postyagdon7" class="checkbox" value="<?php echo $zbp->Config('mochu')->postyagdon7;?>"/></p></td>
    <td>移动版广告位，分辨率高于640PX时隐藏，低于640PX后显示。<br />广告宽度:600PX,高度不限.会自适应</td>
  </tr>          
</table>
 <br />
<input name="" type="Submit" class="button" value="保存配置"/>
</form>
 <br />
<?php }?>
<!--搜索优化-->
<?php if ($act == 'youhua'){	
if(isset($_POST['postfen']))
	{  $zbp->Config('mochu')->postfen = $_POST['postfen'];
	   $zbp->Config('mochu')->onfen = $_POST['onfen'];
       $zbp->Config('mochu')->ontuisong = $_POST['ontuisong'];
	   $zbp->Config('mochu')->posttuisong = $_POST['posttuisong'];		   	
		$zbp->SaveConfig('mochu');
		$zbp->ShowHint('good');
	}
?>
<form id="youhua" method="post">
<table width="100%" border="1">
  <tr>
    <td scope="col" width="150"><p align="center">名称</p></td>
    <td scope="col" width="600"><p align="center">内容</p></td>
    <td scope="col" width="60"><p align="center">开关</p></td>
    <td scope="col" ><p align="center">说明</p></td>
  </tr>
   <tr>
    <td>文章内容底部分享代码</td>
    <td><textarea name="postfen" id="postfen" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->postfen;?></textarea></td>
	<td><p align="center"><input type="text" id="onfen" name="onfen" class="checkbox" value="<?php echo $zbp->Config('mochu')->onfen;?>"/></p></td>
    <td>请修改成自己的分享代码，开关关闭后不显示</td>
  </tr>
     <tr>
    <td>搜索引擎推送代码</td>
        <td><textarea name="posttuisong" id="posttuisong" type="text" style="width:98%; height:80px;" ><?php echo $zbp->Config('mochu')->posttuisong;?></textarea></td>
	<td><p align="center"><input type="text" id="ontuisong" name="ontuisong" class="checkbox" value="<?php echo $zbp->Config('mochu')->ontuisong;?>"/></p></td>
    <td>请修改成自己的推送代码，开关关闭后代码无效</td>
  </tr>
</table>
 <br />
<input name="" type="Submit" class="button" value="保存配置"/>
</form>
 <br />
<?php }?>
</div></div>
<script type="text/javascript">ActiveTopMenu("topmenu_mochu");</script>
<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>