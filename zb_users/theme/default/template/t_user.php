{* Template Name:文章页单页 *}
{template:header}
<body class="single {$type}">
<div id="divAll">
	<div id="divPage">
	<div id="divMiddle">
		<div id="divTop">
			<h1 id="BlogTitle"><a href="{$host}">{$name}</a></h1>
			<h3 id="BlogSubTitle">{$subname}</h3>
		</div>
		<div id="divNavBar">
<ul>
{$modules['navbar'].Content}
</ul>
		</div>
		<div id="divMain">


<div class="post page">
	<h2 class="post-title">{$article.Title}</h2>


        <form class="ytuseredit" id="edit" method="post" action="#">
        <input id="edtID" name="ID" type="hidden" value="{$user.ID}" />
        <input id="edtGuid" name="Guid" type="hidden" value="{$user.Guid}" />
        验证码图片：<img style="border:none;vertical-align:middle;width:'500px;height:600px;cursor:pointer;" src="{$validcodeurl}?id=RegPage" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=RegPage&amp;tm=\'+Math.random();"/>
        <button onclick="return checkInfo();">确定</button>
        </form>



</div>


		</div>
		<div id="divSidebar">
{template:sidebar}
		</div>
{template:footer}