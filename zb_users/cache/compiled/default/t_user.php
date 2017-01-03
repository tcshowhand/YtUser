<?php  /* Template Name:文章页单页 */  ?>
<?php  include $this->GetTemplate('header');  ?>
<body class="single <?php  echo $type;  ?>">
<div id="divAll">
	<div id="divPage">
	<div id="divMiddle">
		<div id="divTop">
			<h1 id="BlogTitle"><a href="<?php  echo $host;  ?>"><?php  echo $name;  ?></a></h1>
			<h3 id="BlogSubTitle"><?php  echo $subname;  ?></h3>
		</div>
		<div id="divNavBar">
<ul>
<?php  echo $modules['navbar']->Content;  ?>
</ul>
		</div>
		<div id="divMain">


<div class="post page">
	<h2 class="post-title"><?php  echo $article->Title;  ?></h2>


        <form class="ytuseredit" id="edit" method="post" action="#">
        <input id="edtID" name="ID" type="hidden" value="<?php  echo $user->ID;  ?>" />
        <input id="edtGuid" name="Guid" type="hidden" value="<?php  echo $user->Guid;  ?>" />
        验证码图片：<img style="border:none;vertical-align:middle;width:'500px;height:600px;cursor:pointer;" src="<?php  echo $validcodeurl;  ?>?id=RegPage" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=RegPage&amp;tm=\'+Math.random();"/>
        <button onclick="return checkInfo();">确定</button>
        </form>



</div>


		</div>
		<div id="divSidebar">
<?php  include $this->GetTemplate('sidebar');  ?>
		</div>
<?php  include $this->GetTemplate('footer');  ?>