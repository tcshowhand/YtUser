//date-echo
if (d_m_ui.date_echo){
	echo.init({
	offset: 100,
	throttle: 250,
	unload: false,
/* 	callback: function (element, op) {
	console.log(element, 'has been', op + 'ed')
	},
	echo.render()//手动执行
*/
	});
}

//ias 滚动加载
if (Number(d_m_ui.iaspager)>1){
	$.ias({
		triggerPageThreshold: parseInt(Number(d_m_ui.iaspager)),
		history: false,
		container : '.dm-container',
		item: '.dm-multi',
		pagination: 'nav .am-pagination',
		next: '.next-page a',
		loader: '<div class="pagination-loading"><img src="'+d_m_ui.source+'/style/images/loading.gif"></div>',
		trigger: 'More',
		onRenderComplete: function() {
			if (d_m_ui.date_echo){echo.render();}
		}
	});	
}

//幻灯片
if  ($('.am-slider').length){$('.am-slider').flexslider();}

//侧栏tabs
if  ($('.side-tabs').length){$('.side-tabs').tabs();}

//导航高亮
var s = document.location;
if  ($('#dm-topbar .am-container').length){

$('#dm-topbar a').click(function(){
  if ($(".am-active").length){$(".am-active").removeClass("am-active");}
  if ($(".active").length){$(".active").removeClass("active");}
});
	
$("#dm-site-nav li a").each(function() {
	if (this.href == s.toString().split("#")[0]) {
		$(this).addClass("am-active");
		return false;
	}
});

$("#pageside .am-nav a").each(function() {
	if (this.href == s.toString().split("#")[0]) {
		$(this).parent().addClass("am-active");
		return false;
	}
});
}

//没有置顶的时候隐藏标题
if (!$('#istop_list li h3').length){
	$('#istop_title').hide();
	$('#istop_list').hide();
}

//弹出层
	
	if( $(".top_serch").length ){
		var search = $(".top_serch").data('search');
		$('body').append('\
	<div class="am-modal am-modal-alert" tabindex="-1" id="search-modal">\
	  <div class="am-modal-dialog">\
		<div class="am-modal-bd">\
	<div class="site-search">\
		<form method="post" class="am-input-group am-form-inline" action="'+search+'" >\
		   <label for="sitesearch" am-form-label">搜索</label>\
    <div class="am-u-sm-10">\
      <input type="text" id="sitesearch" name="q" placeholder="本站搜索" class="am-form-field">\
    </div>\
	<button class="am-btn am-u-sm-2 am-btn-default" type="submit"><span class="am-icon-search"></span> </button>\
		</form>\
	</div>\
		</div>\
	  </div>\
	</div>\
	');
	}
	if( $(".skm_button").length ){
		var pic = $(".skm_button").data('pic');
		$('body').append('\
	<div class="am-modal am-modal-alert" tabindex="-1" id="skm-modal">\
	  <div class="am-modal-dialog">\
		<div class="am-modal-bd">\
		  <div class="dm-modal-img"><img src="'+pic+'"/></div>\
		</div>\
	  </div>\
	</div>\
	');
	}
	if( $(".wx_button").length ){
		var pic = $(".wx_button").data('pic');
		$('body').append('\
	<div class="am-modal am-modal-alert" tabindex="-1" id="wx-modal">\
	  <div class="am-modal-dialog">\
		<div class="am-modal-bd">\
		  <div class="dm-modal-img"><img src="'+pic+'"/></div>\
		</div>\
	  </div>\
	</div>\
	');
	}
	if( $(".qq_button").length ){
		var pic = $(".qq_button").data('pic');
		$('body').append('\
	<div class="am-modal am-modal-alert" tabindex="-1" id="qq-modal">\
	  <div class="am-modal-dialog">\
		<div class="am-modal-bd">\
		  <div class="dm-modal-img"><img src="'+pic+'"/></div>\
		</div>\
	  </div>\
	</div>\
	');
	}
	
	if( $("#dm-site-nav").length){
		var nav = $("#dm-site-nav").html();
		$('body').append('\
	<!-- 链接触发器， href 属性为目标元素 ID -->\
<a href="#dm-mnav" class="mnavmenu" data-am-offcanvas> <i class="am-menu-toggle-icon am-icon-bars"></i></a>\
		<!-- 侧边栏内容 -->\
		<div id="dm-mnav" class="am-offcanvas">\
		  <div class="am-offcanvas-bar">\
			<div class="am-offcanvas-content">\
		<ul class="am-menu-nav sm-block-grid-1">'+nav+'</ul>\
			</div>\
		  </div>\
		</div>\
	');
	}	
	

//ajax注销登录
if ($('.dm-logout').length){
	$('.dm-logout').click(function(){
		$.ajax({
		url:bloghost + "zb_system/cmd.php?act=logout",
		success:function(){
		window.location.reload()
		}
		});
	})
}


//利用JQ RESIZEEND插件搞事情
var _wid = $(window).width();
resizetodo()
$(window).resizeend(function(event) {
	var _wid = $(window).width();
	resizetodo();
});
function resizetodo(){
	//导航定位
/* 	if  ($('#dm-topbar .am-topbar-brand').length && _wid>640){
		var logowidth = $('header .am-topbar-brand').width();
		$('header .am-container').css({"padding-left":logowidth+50});
	} */
	//根据页面宽度设置是否移动端访问cookie
	if (_wid<640) {
		zbp.cookie.set('view_m', 1,1);
	}else{
		zbp.cookie.set('view_m', 0,1);
	}
	//文章内的视频 iframe embed 标签自适应
	var cw = $('.D_M .am-article .am-article-bd').width();
	$('.D_M .am-article .am-article-bd embed, .D_M .am-article .am-article-bd video,.D_M .am-article .am-article-bd iframe').each(function(){
		if ($(this).length){
			var w = $(this).attr('width')||0,
				h = $(this).attr('height')||0
			if( cw && w && h ){
				$(this).css('width', cw<w?cw:w)
				$(this).css('height', $(this).width()/(w/h))
			}
		}
	})

}

	
//点赞处理
function dmam_prise(post_id,user_id){
	if( $(".prised").length ){
		$('body').append('\
	<div class="am-modal am-modal-alert" tabindex="-1" id="prised-alert">\
	  <div class="am-modal-dialog">\
		<div class="am-modal-bd">\
		  您已经点过赞了！\
		</div>\
		<div class="am-modal-footer">\
		  <span class="am-modal-btn">确定</span>\
		</div>\
	  </div>\
	</div>\
	');
	}
	var $prise=$("#dmam_prise_id-"+post_id);
	if($prise.hasClass('prised')){
		$prise.addClass('am-animation-scale-down');
		$('#prised-alert').modal();
		return
		}
	if(post_id){
		$prise.addClass('am-animation-scale-down');
		var ajax_data={post_id:post_id,user_id:user_id};
		jQuery.post(
			ajaxurl+"dmam_prise",
			ajax_data,
			function(result){
				if(result.status==200){
					var $count=$prise.find('span');
					$prise.addClass('prised').removeClass('am-animation-scale-down');
					$count.text(result.count);
					}else{
						$('#prised-alert').modal();
						}
			},
			'json'
		)
	}
}

//取消回复
function CancelReply(id) {
	if (id){
		var comment_i = $("#cmt-"+id+" .am-comment-hd");
		comment_i.removeClass("haspostform");
	}
	var tietlebar = $('#dm-comment-titlebar'),postform = $('#comment-post');
		$("#inpRevID").val(0);
		if (!tietlebar.length || !postform.length) return;
		tietlebar.after(postform);
}

//回复评论
zbp.plugin.unbind("comment.reply", "system");
zbp.plugin.on("comment.reply", "dmam", function(id) {
	$("#inpRevID").val(id);
	var postform = $('#comment-post'),
		comment_i = $("#cmt-"+id+" .am-comment-hd"),
		tietlebar = $('#dm-comment-titlebar');
		$('#cmt-label-' + id).before(postform);
		comment_i.addClass("haspostform");
		try {
			$('#txaArticle').focus();
		} catch (e) {}
		return false;
})
//评论分页事件
zbp.plugin.on("comment.get", "dmam", function (logid, page) {
	$('span.commentspage').html("Waiting...");
	$.get(bloghost + "zb_system/cmd.php?act=getcmt&postid=" + logid + "&page=" + page, function(data) {
		$('#AjaxCommentBegin').nextUntil('#AjaxCommentEnd').remove();
		$('#AjaxCommentEnd').before(data);
		if (d_m_ui.date_echo){echo.render();}
	});
});
//评论成功后输出
zbp.plugin.on("comment.postsuccess", "default", function () {
	if (d_m_ui.date_echo){echo.render();}
	CancelReply();
})
//滚动条定位

function go_to(name, speed) {
	if (!speed) speed = 300
	if (!name || name == 'top') {
		$(window).smoothScroll({position: 0}, speed);
	}else if (name == 'bottom') {
		$(window).smoothScroll({position: $(document).height()}, speed);
	} else {
		if ($(name).length > 0) {
		$(window).smoothScroll({position: $(name).offset().top}, speed);
		}
	}
}