var Page = require("newsmedia:widget/mod_page/mod_page.js"), ulist = require("newsmedia:widget/ap_ulist/ap_ulist.js"), Header = require("newsmedia:widget/header/header.js"), cover = require("newsmedia:widget/cover/cover.js"), IScroll = require("newsmedia:widget/ui/iscroll/iscroll.js"), Velocity = require("newsmedia:widget/ui/velocity/velocity.js"), banner = {
    init: function () {
        var e = this;
        if (this.body = $("body"), this.header = $("#Header"), this.logo = this.header.find(".logo a"), this.cover = this.body.find("#Cover"), this.banners = this.body.find("#banners"), this.banners.on("mouseout", ".feed_tegao", $.proxy(this.outFeeditem, this)), this.banners.on("mouseover", ".feed_tegao", $.proxy(this.overFeeditem, this)), ulist.ulist.init(), Header.header.init(), serverData.hasMore ? this.renderPage() : '', cover.cover.init(), setTimeout(function () {
                window.scrollTo(0, 0), $(window).scroll($.proxy(e.fixedHeader, e))
        }, 400), "pc" !== serverData.device) {
            var s = new IScroll(".body", {
                scrollbars: !0,
                fadeScrollbars: !0,
                click: !0,
                shrinkScrollbars: "scale",
                deceleration: .005
            });
            window.bodyScroll = s
        } else $("html").height("auto");
        this.locateNewsByNid()
    }, overFeeditem: function (e) {
        $(e.currentTarget).addClass("hover")
    }, outFeeditem: function (e) {
        $(e.currentTarget).removeClass("hover")
    }, fixedHeader: function () {
        var e = this, s = document.body.scrollTop ? document.body.scrollTop : document.documentElement.scrollTop;
        s > 160 ? (this.logo.removeClass("nodis"), this.header.css("position", "fixed"), $("#Body").css("paddingTop", "90px"), setTimeout(function () {}, 0)) : (this.header.css("position", "relative"), $("#Body").css("paddingTop", "30px"))
    }, renderPage: function () {
        new Page.page({
            maxseg: serverData.maxseg,
            total: serverData.total,
            rn: serverData.rn,
            lastNid: serverData.lastNid,
            ajaxurl: "/ajax/subscribenewslist?subscribe=" + serverData.subscribename + "&channel=" + serverData.channelname,
            container: $("#banners"),
            renderData: $.proxy(this.renderList, this)
        })
    }, renderList: function (e, s, a) {
        1 == a && window.scrollTo(0, 161);
        for (var r = [], t = e.list, i = 0; i < t.length; i++)r.push(t[i].imageurls ? t[i].title.length > 18 ? '<div class="feed_tegao long" data-href="' + t[i].display_url + '">' : '<div class="feed_tegao" data-href="' + t[i].display_url + '">' : t[i].title.length > 26 ? '<div class="feed_tegao noimgandlong" data-href="' + t[i].display_url + '">' : '<div class="feed_tegao noimg" data-href="' + t[i].display_url + '">'), r.push('<h4><a href="' + t[i].display_url + '" target="_blank">' + t[i].title + "</a>"), "4" == t[i].n_type && r.push('<i class="iplay"></i>'), r.push("</h4>"), t[i].imageurls && r.push('<p class="picture"><a href="' + t[i].display_url + '" target="_blank"><img src="' + t[i].imageurls + '"/></a></p>'), r.push(t[i].imageurls ? t[i].title.length > 18 ? '<p class="summary">' + t[i].abs.substr(0, 20) + '...<a href="' + t[i].display_url + '" class="more">[详情]</a></p>' : '<p class="summary">' + t[i].abs.substr(0, 45) + '...<a href="' + t[i].display_url + '" class="more">[详情]</a></p>' : t[i].title.length > 26 ? '<p class="summary">' + t[i].abs.substr(0, 30) + '...<a href="' + t[i].display_url + '" class="more">[详情]</a></p>' : '<p class="summary">' + t[i].abs.substr(0, 65) + '...<a href="' + t[i].display_url + '" class="more">[详情]</a></p>'), r.push('<div class="infos">'), -1 != serverData.channelname.indexOf("/") && t[i].sub_category && t[i].sub_category_en ? r.push('<p class="type"><a href="/' + t[i].category_en + "/" + t[i].sub_category_en + '">' + t[i].sub_category + "</a></p>") : t[i].category && t[i].category_en && r.push('<p class="type"><a href="/' + t[i].category_en + '">' + t[i].category + "</a></p>"), t[i].newsman.length && (r.push('<span class="author">'), $.each(t[i].newsman, function (e, s) {
            r.push("<em>" + s.name + "</em>")
        }), r.push("</span>")), r.push('<span class="time">' + t[i].ts + "</span></div></div>");
        if (this.banners.append(r.join("")), "pc" !== serverData.device) {
            var o = window.bodyScroll;
            setTimeout(function () {
                o.refresh()
            }, 0)
        }
        "1" != s ? $(".focus").addClass("nodis") : $(".focus").removeClass("nodis")
    }, locateNewsByNid: function () {
        var e, s, a = window.location.href, r = /.*\/\?nid=(.+)/gi, t = this;
        /nid=/.test(a) && (e = r.exec(a)[1], s = this.banners.children(), $.each(s, function (s, a) {
            var r, i = $(a), o = i.attr("data-href");
            return o.search("nid=" + e) > -1 ? (i.addClass("hover glow"), i.velocity("scroll", {
                duration: 2e3,
                offset: -80
            }), t.isLtIe8() && (r = i[0].getBoundingClientRect().top - 80, setTimeout(function () {
                window.scrollTo(0, r)
            }, 1e3)), !1) : void 0
        }))
    }, isLtIe8: function () {
        var e, s = navigator.userAgent, a = /MSIE (\d+\.\d+);/, r = !1;
        return /MSIE/.test(s) && (e = a.exec(s)[1], 8 > e && (r = !0)), r
    }
};
$(function () {
    setTimeout(function () {
        banner.init()
    }, 0)
});