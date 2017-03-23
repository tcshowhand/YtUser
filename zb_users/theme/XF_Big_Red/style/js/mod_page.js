define("newsmedia:widget/mod_page/mod_page.js", function (s, a) {
    var i = function (s) {
        this.pn = s.pn || 1, this.seg = s.seg || 1, this.maxseg = s.maxseg || 1, this.total = s.total, this.rn = s.rn, this.maxpn = Math.ceil(s.total / s.rn), this.container = s.container, this.ajaxurl = s.ajaxurl, this.fn = s.renderData, this.lastNid = s.lastNid, this.device = serverData.device, this.init()
    };
    i.prototype = {
        init: function () {
            this.flag = !0, this.page = $(".pages"), this.loading = $(".loading"), this.maxseg == this.seg ? this.loading.addClass("nodis") : this.page.addClass("nodis"), this.renderPageHtml(), $(window).scroll($.proxy(this.renderFeed, this)), this.listenBodyIScroll(this.renderFeed), this.page.on("mouseover", ".page", $.proxy(this.showPageDown, this)), this.page.on("mouseout", ".page", $.proxy(this.hidePageDown, this)), this.page.on("click", ".btnP", $.proxy(this.toPage, this)), this.page.on("click", ".btnN", $.proxy(this.toPage, this)), this.page.on("click", ".pageDown a", $.proxy(this.toPage, this)), this.device && this.page.on("click", ".page", $.proxy(this.showOrHideGotoMenu, this))
        }, showPageDown: function (s) {
            var a = $(s.currentTarget);
            this.meTimeout && clearInterval(this.meTimeout), a.parent().find(".pageDown").removeClass("nodis")
        }, hidePageDown: function (s) {
            var a = $(s.currentTarget);
            this.meTimeout = setTimeout(function () {
                a.parent().find(".pageDown").addClass("nodis")
            }, 500)
        }, showOrHideGotoMenu: function (s) {
            var a = this.page.data("switch");
            switch (a = void 0 === a ? "off" : a) {
                case"off":
                    this.page.data("switch", "on"), this.showPageDown(s);
                    break;
                case"on":
                    this.page.data("switch", "off"), this.hidePageDown(s)
            }
        }, renderFeed: function () {
            var s, a = document.documentElement.clientHeight, i = this.loading[0].getBoundingClientRect().top, t = this.loading.height();
            this.loading.hasClass("nodis") || a > i - t && this.flag && (this.seg++, s = this.ajaxurl + "&pn=" + this.pn + "&seg=" + this.seg, this.loadData(s))
        }, toPage: function (s) {
            {
                var a, i, t = $(s.currentTarget);
                window.bodyScroll
            }
            t.hasClass("p") && !t.hasClass("pgdis") ? (a = t.data("pn"), this.pn + 1 != a && (this.lastNid = "")) : t.hasClass("btnP") && !t.hasClass("nodis") ? (a = --this.pn, this.lastNid = "") : t.hasClass("btnN") && !t.hasClass("nodis") && (a = ++this.pn), a && (this.pn = a, this.seg = 1, this.renderPageHtml(this.pn), i = this.ajaxurl + "&pn=" + a + "&seg=" + this.seg, this.loadData(i, "toPage"))
        }, renderPageHtml: function () {

        }, listenBodyIScroll: function (s) {
            var a, i, t = this;
            i = setInterval(function () {
                a = window.bodyScroll, a && (a.on("scrollEnd", $.proxy(s, t)), clearInterval(i))
            }, 100)
        }, loadData: function (s, a) {
            var i = this;
            this.flag && (this.flag = !1, a && "toPage" === a && this.hidePageBtn(), 1 == this.seg && this.container.html(""), $.ajax({
                url: s + "&lastnid=" + i.lastNid,
                type: "GET",
                dataType: "json",
                success: function (s) {
                    if ("0" == s.errno) {
                        var t = s.data, e = s.data.more;
                        i.lastNid = s.data.lastnid, i.fn && i.fn(t, i.pn, i.seg), a && "toPage" === a && i.showPageBtn(), e ? i.seg == i.maxseg ? (i.loading.addClass("nodis"), i.page.removeClass("nodis")) : (i.loading.removeClass("nodis"), i.page.addClass("nodis")) : 1 == i.pn ? (i.loading.addClass("nodis"), i.page.addClass("nodis")) : (i.loading.addClass("nodis"), i.page.removeClass("nodis")), 1 != i.pn ? i.page.find(".btnP").removeClass("nodis") : i.page.find(".btnP").addClass("nodis"), i.pn != i.maxpn ? i.page.find(".btnN").removeClass("nodis") : i.page.find(".btnN").addClass("nodis"), i.flag = !0
                    } else console.log(s), i.loading.addClass("nodis"), i.page.addClass("nodis")
                },
                error: function (s, a, i) {
                    console.log(s, a, i)
                }
            }))
        }, showPageBtn: function () {
            if ($("#Body .pages").show(), $("#Body").scrollTop(0), "pc" !== this.device) {
                var s = window.bodyScroll;
                $(".wp-footer").css("cssText", "display:block!important"), s.refresh(), s.scrollTo(0, 0)
            }
        }, hidePageBtn: function () {
            $("#Body .pages").hide(), "pc" !== this.device && $(".wp-footer").css("cssText", "display:none!important")
        }
    }, a.page = i
});