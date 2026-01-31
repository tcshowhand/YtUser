$(function () {
    var surl = location.href;
    $(".side-menu-box li a").each(function () {
        if ($(this).attr("href") == surl) $(this).parent().addClass("on");
    });

    $('.txuser-tab-hd li').click(function () {
        $(this).addClass('tx-on').siblings().removeClass('tx-on');
        $('.txuser-tab-bd>div').hide().eq($(this).index()).show();
    });

    $(".login-on").hover(function () {
        $(".login-on>ul").stop(true, true).slideDown();
        $(this).addClass("tx-login-on");
    }, function () {
        $(".login-on>ul").stop(true, true).slideUp();
        $(this).removeClass("tx-login-on");
    });
});

function AutoScroll(obj) {
    $(obj).find(".tx-notice:first").animate({
        marginTop: "-30px"
    }, 500, function () {
        $(this).css({ marginTop: "0px" }).find("li:first").appendTo(this);
    });
}
$(document).ready(function () {
    setInterval('AutoScroll("#tx-header-scroll")', 3000);
});

$(document).ready(function () {
    $(".mobile-menu-trigger").click(function () {
        $(".mobile-menu-content").addClass("active");
        $(".mobile-menu-mask").addClass("active");
    });
    $(".mobile-menu-mask, .mobile-menu-close").click(function () {
        $(".mobile-menu-content").removeClass("active");
        $(".mobile-menu-mask").removeClass("active");
    });
});