//浏览器检测
(function (window) {
    /**  
    浏览器版本信息
    * @type {Object} 
    * @return {Boolean}  返回布尔值     
    */
    var browser = function () {
        var uA = navigator.userAgent.toLowerCase();
        return {
            txt: uA, // 浏览器版本信息
            version: (uA.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/) || [])[1], // 版本号       
            msie: /msie/.test(uA) && !/opera/.test(uA), // IE内核
            mozilla: /mozilla/.test(uA) && !/(compatible|webkit)/.test(uA), // 火狐浏览器
            safari: /safari/.test(uA) && !/chrome/.test(uA), //是否为safair
            chrome: /chrome/.test(uA), //是否为chrome
            opera: /opera/.test(uA), //是否为oprea
            presto: uA.indexOf('presto/') > -1, //opera内核
            webKit: uA.indexOf('applewebkit/') > -1, //苹果、谷歌内核
            gecko: uA.indexOf('gecko/') > -1 && uA.indexOf('khtml') == -1, //火狐内核
            //mobile: !!uA.match(/applewebkit.*mobile.*/), //是否为移动终端
            mobile: !!uA.match(/applewebkit.*mobile.*/) || uA.indexOf('ucbrowser/') != -1, //是否为移动终端含UC
            ios: !!uA.match(/\(i[^;]+;( uA;)? cpu.+mac os x/), //ios终端
            android: uA.indexOf('android') > -1, //android终端
            iPhone: uA.indexOf('iphone') > -1, //是否为iPhone
            iPad: uA.indexOf('ipad') > -1, //是否iPad
            webApp: !!uA.match(/applewebkit.*mobile.*/) && uA.indexOf('safari/') == -1, //是否web应该程序，没有头部与底部
            fixed: !!uA.match(/applewebkit.*mobile.*/) && (uA.match(/\(i[^;]+;( uA;)? cpu.+mac os x/) ? 5 > /\d/ig.exec(/os\s\d/ig.exec(uA) + "") ? !1 : !0 : 3 > parseFloat(/\d.\d/ig.exec(/android\s\d.\d/ig.exec(uA))) ? !1 : !0) //是否支持fixed
        };
    }()
    window.browser = browser;
})(window)


/* if(window.browser.mobile){
	var hrefValue = window.location.href;
} */
