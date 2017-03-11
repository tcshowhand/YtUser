zbp.plugin.unbind("comment.reply", "system");
zbp.plugin.on("comment.reply", "mochu", function(i) {
    if ($("#inpRevID").val() != 0) return false;
    $("#inpRevID").val(i);
    $("#AjaxComment" + i).next().after("<dl id=\"reply\">" + $("#postcmt").html() + "</dl>");
    $("#postcmt").hide("slow").html("");
    $("#cancel-reply").show().bind("click", function() {
        $("#inpRevID").val(0);
        $(this).hide().prev().show();
        $("#postcmt").html($("#reply").html()).show("slow");
        $("#reply").remove();
        window.location.hash = "#comment";
        return false;
    }).prev().hide();
    $("#reply").show("slow");
    window.location.hash = "#reply";
});
zbp.plugin.on("comment.postsuccess", "mochu", function () {
	$("#cancel-reply").click();
});
//侧栏跟随
(function(){
   var oDiv=document.getElementById("float");
   var H=0,iE6;
   var Y=oDiv;
   while(Y){H+=Y.offsetTop;Y=Y.offsetParent};
   iE6=window.ActiveXObject&&!window.XMLHttpRequest;
   if(!iE6){
       window.onscroll=function()
       {
           var s=document.body.scrollTop||document.documentElement.scrollTop;
           if(s>H){oDiv.className="div1 div2";if(iE6){oDiv.style.top=(s-H)+"px";}}
           else{oDiv.className="div1";}
       };
   }
})();
//导航下拉二级
$("#nav li").hover(function(){$(this).find("ul").slideDown("slow");},function(){ $(this).find("ul").slideUp("fast");});
//移动导航  
$("#xiala").on("click", function(){$("#yidongnavs").slideToggle(500);$(".waphead-lf i").toggleClass("fa-times onhover");});
$("#guanbi").on("click", function(){$("#yidongnavs").slideToggle(500);});
//搜索
$("#sousuo").on("click", function(){$(".sousuo").slideToggle(500);$("#sousuo i").toggleClass("fa-times onhover");});
$("#sguanbi").on("click", function(){$(".sousuo").slideToggle(500);$(".waphead-lr i").toggleClass("fa-times onhover");$("#sousuo i").toggleClass("fa-times onhover");}); 
$("#ydsousuo").on("click", function(){$(".sousuo").slideToggle(500);$(".waphead-lr i").toggleClass("fa-times onhover");});
//自适应移动导航高亮 
    var surl = location.href;
	var surl2 = $(".place a:eq(1)").attr("href");
	$("#nav ul li a").each(function() {
	if ($(this).attr("href")==surl || $(this).attr("href")==surl2) $(this).addClass("onhover")
	});
	$("#yidongnavs ul li a").each(function() {
		if ($(this).attr("href")==surl || $(this).attr("href")==surl2) $(this).addClass("onhover")
	});
		$(".link-con-lf ul li a").each(function() {
		if ($(this).attr("href")==surl || $(this).attr("href")==surl2) $(this).addClass("link-con-a")
	});
	
//导航高亮获取当前地址比较
var s=document.location;  $("#nav a").each(function(){  if(this.href==s.toString().split("#")[0]){$(this).addClass("onhover");return false;}  });
//多彩云标签
var tags_a = $("#divTags li"); 
var tags_h = $("#htagcelan li"); 
var tags_r = $("#rtagcelan li"); 
var x = 8; 
var y = 0; 
tags_a.each(function(){ 
var rand = parseInt(Math.random() * (x - y + 1) + y); 
$(this).addClass("tags"+rand); 
});
tags_h.each(function(){ 
var rand = parseInt(Math.random() * (x - y + 1) + y); 
$(this).addClass("tags"+rand); 
}); 
tags_r.each(function(){ 
var rand = parseInt(Math.random() * (x - y + 1) + y); 
$(this).addClass("tags"+rand); 
}); 
//多个TAB切换
function setTab(name,cursel,n){
 for(i=1;i<=n;i++){
  var menu=document.getElementById(name+i);
  var con=document.getElementById("con_"+name+"_"+i);
  menu.className=i==cursel?"tabhover":"";
  con.style.display=i==cursel?"block":"none";
 };
};
//返回顶部与头部样式
	$(window).scroll(function(){
	var scrolly = $(document).scrollTop();
    if (scrolly > 10){ 
      $('#header').addClass('tophead');
     } 
      else {
      $('#header').removeClass('tophead');
     }
}) ;
	$("#gotop").click(function(){
        $('body,html').animate({scrollTop:0},1000);
    });
//内容文字大小	
function wennrsize(size){document.getElementById('wennr-wen').style.fontSize=size+'px'};
//guidang
$(".guidang ul:lt(1)").css("display","block");
$(".item h3").on("click", function(){
$(this).next().slideToggle();});
//列表样式
$('.archive-list').mouseover(function(){
    $(this).toggleClass("archive-on");
  });
$('.archive-list').mouseout(function(){
    $(this).removeClass("archive-on");
  });

//登录
$("#denglu").on("click", function(){$("#dengdiv").slideToggle(5);});
$("#yddenglu").on("click", function(){$("#dengdiv").slideToggle(5);});
$("#tcaguan").on("click", function(){$("#dengdiv").slideToggle(5);});
$("#btnPost").click(function(){
	var strUserName=$("#edtUserName").val();
	var strPassWord=$("#edtPassWord").val();
	var strSaveDate=$("#savedate").val()
	if((strUserName=="")||(strPassWord=="")){
		alert("用户名或密码不能为空！");
		return false;
	}
	$("#edtUserName").remove();
	$("#edtPassWord").remove();
	$("form").attr("action","/zb_system/cmd.php?act=verify");
	$("#username").val(strUserName);
	$("#password").val(MD5(strPassWord));
	$("#savedate").val(strSaveDate);
})
$("#chkRemember").click(function(){
	$("#savedate").attr("value",$("#chkRemember").attr("checked")=="checked"?30:0);
})
//打赏
$("#ondashang").on("click", function(){$("#dashang").slideToggle(5);});
$("#tca").on("click", function(){$("#dashang").slideToggle(5);});
$(".ds-payment-way").bind("click",function(){$(".qrcode-img").hide();$(".qrCode_"+$(".ds-payment-way").find("input[name=reward-way]:checked").val()).show();});