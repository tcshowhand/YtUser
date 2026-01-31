$(function () {
    //密码控件禁止复制/剪切/粘贴
    $("input:password").bind("copy cut paste", function (e) {
        return false;
    });
});
//60秒发送限制
var countdown = 60;
function settime(val) {
    if (countdown == 0) {
        val.removeAttribute("disabled");
        val.value = "免费获取验证码";
        countdown = 60;
    } else {
        val.setAttribute("disabled", true);
        val.value = "重新发送(" + countdown + ")";
        countdown--;
    }
    setTimeout(function () {
        settime(val)
    }, 1000)
}
; (function () {
    //全局ajax处理
    $.ajaxSetup({
        complete: function (jqXHR) {
        },
        data: {},
        error: function (jqXHR, textStatus, errorThrown) {
            //请求失败处理
        }
    });

    if ($.browser && $.browser.msie) {
        //ie 都不缓存
        $.ajaxSetup({
            cache: false
        });
    }

    //不支持placeholder浏览器下对placeholder进行处理
    if (document.createElement('input').placeholder !== '') {
        $('[placeholder]').focus(function () {
            var input = $(this);
            if (input.val() == input.attr('placeholder')) {
                input.val('');
                input.removeClass('placeholder');
            }
        }).blur(function () {
            var input = $(this);
            if (input.val() == '' || input.val() == input.attr('placeholder')) {
                input.addClass('placeholder');
                input.val(input.attr('placeholder'));
            }
        }).blur().parents('form').submit(function () {
            $(this).find('[placeholder]').each(function () {
                var input = $(this);
                if (input.val() == input.attr('placeholder')) {
                    input.val('');
                }
            });
        });
    }


    //所有加了dialog类名的a链接，自动弹出它的href
    if ($('a.js-dialog').length) {
        Wind.use('artDialog', 'iframeTools', function () {
            $('.js-dialog').on('click', function (e) {
                e.preventDefault();
                var $_this = this,
                    _this = $($_this);
                art.dialog.open($(this).prop('href'), {
                    close: function () {
                        $_this.focus(); //关闭时让触发弹窗的元素获取焦点
                        return true;
                    },
                    title: _this.prop('title')
                });
            }).attr('role', 'button');

        });
    }

    //所有的ajax form提交,由于大多业务逻辑都是一样的，故统一处理
    var ajaxForm_list = $('form.js-ajax-form');
    if (ajaxForm_list.length) {
        Wind.use('ajaxForm', 'noty', 'validate', function () {

            //var form = btn.parents('form.js-ajax-form');
            var $btn;

            $('.js-ajax-submit').on('click', function (e) {
                //e.preventDefault();
                /*var btn = $(this).find('button.js-ajax-submit'),
                 form = $(this);*/
                var btn = $(this), form = btn.parents('form.js-ajax-form');
                $btn = btn;

                form.find("input,textarea").each(function () {
                    if ($(this).data('required') == 'on' && $(this).val() === '') {
                        let p = $(this).attr('placeholder');
                        let this_tips = (p === undefined || p === null || p === "") ? '此项' : String(p);
                        $btn.data("loading", true);
                        noty({ text: '请填写' + this_tips, layout: 'center', type: 'warning' });
                        $(this).focus();
                        return false;
                    } else {
                        $btn.data("loading", false);
                    }
                });

                if (btn.data("loading")) {
                    return false;
                }
                //批量操作 判断选项
                if (btn.data('subcheck')) {
                    btn.parent().find('span').remove();
                    if (form.find('input.js-check:checked').length) {
                        var msg = btn.data('msg');
                        if (msg) {
                            noty({
                                text: String(msg),
                                type: 'confirm',
                                layout: "center",
                                timeout: false,
                                modal: true,
                                buttons: [
                                    {
                                        addClass: 'btn btn-primary',
                                        text: '确定',
                                        onClick: function ($noty) {
                                            $noty.close();
                                            btn.data('subcheck', false);
                                            btn.click();
                                        }
                                    },
                                    {
                                        addClass: 'btn btn-danger',
                                        text: '取消',
                                        onClick: function ($noty) {
                                            $noty.close();
                                        }
                                    }
                                ]
                            });
                        } else {
                            btn.data('subcheck', false);
                            btn.click();
                        }

                    } else {
                        noty({
                            text: "请至少选择一项",
                            type: 'error',
                            layout: 'center'
                        });
                    }
                    return false;
                }

                //ie处理placeholder提交问题
                if ($.browser && $.browser.msie) {
                    form.find('[placeholder]').each(function () {
                        var input = $(this);
                        if (input.val() == input.attr('placeholder')) {
                            input.val('');
                        }
                    });
                }

            });

            ajaxForm_list.each(function () {
                $(this).validate({
                    //是否在获取焦点时验证
                    //onfocusout : false,
                    //是否在敲击键盘时验证
                    //onkeyup : false,
                    //当鼠标点击时验证
                    //onclick : false,
                    //给未通过验证的元素加效果,闪烁等
                    highlight: function (element, errorClass, validClass) {
                        if (element.type === "radio") {
                            this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                        } else {
                            var $element = $(element);
                            $element.addClass(errorClass).removeClass(validClass);
                            $element.parent().addClass("has-error");//bootstrap3表单
                            $element.parents('.control-group').addClass("error");//bootstrap2表单

                        }
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        if (element.type === "radio") {
                            this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                        } else {
                            var $element = $(element);
                            $element.removeClass(errorClass).addClass(validClass);
                            $element.parent().removeClass("has-error");//bootstrap3表单
                            $element.parents('.control-group').removeClass("error");//bootstrap2表单
                        }
                    },
                    showErrors: function (errorMap, errorArr) {
                        var i, elements, error;
                        for (i = 0; this.errorList[i]; i++) {
                            error = this.errorList[i];
                            if (this.settings.highlight) {
                                this.settings.highlight.call(this, error.element, this.settings.errorClass, this.settings.validClass);
                            }
                            //this.showLabel( error.element, error.message );
                        }
                        if (this.errorList.length) {
                            //this.toShow = this.toShow.add( this.containers );
                        }
                        if (this.settings.success) {
                            for (i = 0; this.successList[i]; i++) {
                                //this.showLabel( this.successList[ i ] );
                            }
                        }
                        if (this.settings.unhighlight) {
                            for (i = 0, elements = this.validElements(); elements[i]; i++) {
                                this.settings.unhighlight.call(this, elements[i], this.settings.errorClass, this.settings.validClass);
                            }
                        }
                        this.toHide = this.toHide.not(this.toShow);
                        this.hideErrors();
                        this.addWrapper(this.toShow).show();
                    },
                    submitHandler: function (form) {
                        var $form = $(form);
                        if (!$btn) {
                            $btn = $form.find('button.js-ajax-submit');
                        }
                        $form.ajaxSubmit({
                            url: String($btn && $btn.data('action') ? $btn.data('action') : $form.attr('action')),
                            dataType: 'json',
                            beforeSubmit: function (arr, $form, options) {
                                if ($btn) {
                                    $btn.data("loading", true);
                                    var text = $btn.html();
                                    //按钮文案、状态修改
                                    $btn.html(text);
                                }
                            },
                            success: function (data, statusText, xhr, $form) {
                                function _refresh() {
                                    if (data.url) {
                                        if (window.parent.art) {
                                            //iframe弹出页
                                            window.parent.location.href = data.url;
                                        } else {
                                            window.location.href = data.url;
                                        }
                                    } else {
                                        if (data.code == 1) {
                                            var wait = $btn.data("wait");
                                            if (window.parent.art) {
                                                reloadPage(window.parent);
                                            } else {
                                                //刷新当前页
                                                reloadPage(window);
                                            }
                                        }
                                    }
                                }

                                var text = $btn.html();
                                //按钮文案、状态修改
                                $btn.removeClass('disabled').prop('disabled', false).html(text);
                                if (data.code == 1) {
                                    if ($btn.data('success')) {
                                        var successCallback = $btn.data('success');
                                        window[successCallback](data, statusText, xhr, $form);
                                        return;
                                    }
                                    noty({
                                        text: String(data.msg),
                                        type: 'success',
                                        layout: 'center',
                                        modal: true,
                                        callback: {
                                            afterClose: function () {
                                                _refresh();
                                            }
                                        }
                                    });
                                } else if (data.code == 0) {
                                    if ($btn.data('error')) {
                                        var errorCallback = $btn.data('error');
                                        window[errorCallback](data, statusText, xhr, $form);
                                        return;
                                    }

                                    var $verify_img = $form.find(".verify_img");
                                    if ($verify_img.length) {
                                        $verify_img.attr("src", $verify_img.attr("src") + "&refresh=" + Math.random());
                                    }

                                    var $verify_input = $form.find("[name='verify']");
                                    $verify_input.val("");

                                    noty({
                                        text: String(data.msg),
                                        type: 'error',
                                        layout: 'center',
                                        callback: {
                                            afterClose: function () {
                                                _refresh();
                                            }
                                        }
                                    });
                                }


                            },
                            error: function (xhr, e, statusText) {
                                noty({
                                    text: statusText,
                                    type: 'error',
                                    layout: 'center',
                                    callback: {
                                        // afterClose: function () {
                                        //     if (window.parent.art) {
                                        //         reloadPage(window.parent);
                                        //     } else {
                                        //         //刷新当前页
                                        //         reloadPage(window);
                                        //     }
                                        // }
                                    }
                                });
                            },
                            complete: function () {
                                $btn.data("loading", false);
                            }
                        });
                    }
                });
            });

        });
    }

    //dialog弹窗内的关闭方法
    $('#js-dialog-close').on('click', function (e) {
        e.preventDefault();
        try {
            art.dialog.close();
        } catch (err) {
            Wind.use('artDialog', 'iframeTools', function () {
                art.dialog.close();
            });
        }
        ;
    });

    //所有的删除操作，删除数据后刷新页面
    if ($('a.js-ajax-delete').length) {
        Wind.use('noty', function () {
            $('.js-ajax-delete').on('click', function (e) {
                e.preventDefault();
                var $_this = this,
                    $this = $($_this),
                    href = $this.data('href'),
                    refresh = $this.data('refresh'),
                    msg = $this.data('msg');
                okBtnText = $this.data('ok-btn');
                cancelBtnText = $this.data('cancel-btn');
                href = href ? href : $this.attr('href');
                noty({
                    text: msg ? msg : '确定要删除吗？',
                    type: 'confirm',
                    layout: "center",
                    timeout: false,
                    modal: true,
                    buttons: [
                        {
                            addClass: 'btn btn-primary',
                            text: okBtnText ? okBtnText : '确定',
                            onClick: function ($noty) {
                                $noty.close();
                                $.getJSON(href).done(function (data) {
                                    if (data.code == 1) {
                                        if (data.url) {
                                            location.href = data.url;
                                        } else if (refresh || refresh == undefined) {
                                            reloadPage(window);
                                        }
                                    } else if (data.code == 0) {
                                        noty({
                                            text: data.msg,
                                            type: 'error',
                                            layout: 'center',
                                            callback: {
                                                afterClose: function () {
                                                    if (data.url) {
                                                        location.href = data.url;
                                                    }
                                                }
                                            }
                                        });
                                    }
                                });
                            }
                        },
                        {
                            addClass: 'btn btn-danger',
                            text: cancelBtnText ? cancelBtnText : '取消',
                            onClick: function ($noty) {
                                $noty.close();
                            }
                        }
                    ]
                });

            });

        });
    }


    if ($('a.js-ajax-dialog-btn').length) {
        Wind.use('noty', function () {
            $('.js-ajax-dialog-btn').on('click', function (e) {
                e.preventDefault();
                var $_this = this,
                    $this = $($_this),
                    href = $this.data('href'),
                    refresh = $this.data('refresh'),
                    msg = $this.data('msg');
                href = href ? href : $this.attr('href');
                noty({
                    text: msg,
                    type: 'confirm',
                    layout: "center",
                    timeout: false,
                    modal: true,
                    buttons: [
                        {
                            addClass: 'btn btn-primary',
                            text: '确定',
                            onClick: function ($noty) {
                                $noty.close();
                                $.getJSON(href).done(function (data) {
                                    if (data.code == 1) {
                                        if (data.url) {
                                            location.href = data.url;
                                        } else if (refresh || refresh == undefined) {
                                            reloadPage(window);
                                        }
                                    } else if (data.code == 0) {
                                        noty({
                                            text: data.msg,
                                            type: 'error',
                                            layout: 'center',
                                            callback: {
                                                afterClose: function () {
                                                    if (data.url) {
                                                        location.href = data.url;
                                                    }
                                                }
                                            }
                                        });
                                    }
                                });
                            }
                        },
                        {
                            addClass: 'btn btn-danger',
                            text: '取消',
                            onClick: function ($noty) {
                                $noty.close();
                            }
                        }
                    ]
                });

            });

        });
    }

    if ($('a.js-ajax-btn').length) {
        Wind.use('noty', function () {
            $('.js-ajax-btn').on('click', function (e) {
                e.preventDefault();
                var $_this = this,
                    $this = $($_this),
                    href = $this.data('href'),
                    msg = $this.data('msg');
                refresh = $this.data('refresh');
                href = href ? href : $this.attr('href');
                refresh = refresh == undefined ? 1 : refresh;


                $.getJSON(href).done(function (data) {
                    if (data.code == 1) {
                        noty({
                            text: data.msg,
                            type: 'success',
                            layout: 'center',
                            callback: {
                                afterClose: function () {
                                    if (data.url) {
                                        location.href = data.url;
                                        return;
                                    }

                                    if (refresh || refresh == undefined) {
                                        reloadPage(window);
                                    }
                                }
                            }
                        });
                    } else if (data.code == 0) {
                        noty({
                            text: data.msg,
                            type: 'error',
                            layout: 'center',
                            callback: {
                                afterClose: function () {
                                    if (data.url) {
                                        location.href = data.url;
                                    }
                                }
                            }
                        });
                    }
                });

            });

        });
    }

    //所有的请求刷新操作
    var ajax_refresh = $('a.js-ajax-refresh'),
        refresh_lock = false;
    if (ajax_refresh.length) {
        ajax_refresh.on('click', function (e) {
            e.preventDefault();
            if (refresh_lock) {
                return false;
            }
            refresh_lock = true;

            $.post(this.href, function (data) {
                refresh_lock = false;

                if (data.code == 1) {
                    if (data.url) {
                        location.href = data.url;
                    } else {
                        reloadPage(window);
                    }
                } else if (data.code == 0) {
                    Wind.art.dialog.alert(data.msg);
                }
            }, 'json');
        });
    }

    //提示
    var $js_get_text_code = $('.js-get-text-code');
    if ($js_get_text_code.length > 0) {
        Wind.use('noty', function () {
            $js_get_text_code.on('click', function () {
                var $this = $(this);
                if ($this.data('sending')) return;
                $this.data('sending', true);
                var init_secode_left = parseInt($this.data('init-second-left'));
                init_secode_left = init_secode_left > 0 ? init_secode_left : 60;
                var init_text = $this.text();
                $this.data('second-left', init_secode_left);
                var mtimer = setInterval(function () {
                    if (init_secode_left > 0) {
                        init_secode_left--;
                        $this.text('已复制(' + init_secode_left + ")");
                    } else {
                        clearInterval(mtimer);
                        $this.text(init_text);
                        $this.data('sending', false);
                    }
                }, 1000);
            });
        });
    }

    //短信验证码
    var $js_get_mobile_code = $('.js-get-mobile-code');
    if ($js_get_mobile_code.length > 0) {
        Wind.use('noty', function () {
            $js_get_mobile_code.on('click', function () {
                var $this = $(this);
                if ($this.data('loading')) return;
                if ($this.data('sending')) return;
                var $mobile_input = $($this.data('mobile-input'));
                var mobile = $mobile_input.val();
                if (mobile == '') {
                    $mobile_input.focus();
                    return;
                }
                var $form = $this.parents('form');
                var $captchaInput = $("input[name='captcha']", $form);
                var $captchaIdInput = $("input[name='_captcha_id']", $form);
                var captcha = $captchaInput.val();
                var captchaId = $captchaIdInput.val();
                if (!captcha) {
                    $captchaInput.focus();
                    return;
                }
                $this.data('loading', true);
                $this.data('sending', true);

                var url = $this.data('url');

                var init_secode_left = parseInt($this.data('init-second-left'));
                init_secode_left = init_secode_left > 0 ? init_secode_left : 60;
                var init_text = $this.text();
                $this.data('second-left', init_secode_left);
                var wait_msg = $this.data('wait-msg');
                var codeType = $this.data('type');

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: { mobile: mobile, captcha: captcha, captcha_id: captchaId, type: codeType },
                    success: function (data) {
                        if (data.code == 1) {
                            noty({
                                text: data.msg,
                                type: 'success',
                                layout: 'center'
                            });

                            $this.text(String(wait_msg).replace('[second]', init_secode_left));

                            var mtimer = setInterval(function () {
                                if (init_secode_left > 0) {
                                    init_secode_left--;
                                    $this.text(String(wait_msg).replace('[second]', init_secode_left));
                                } else {
                                    clearInterval(mtimer);
                                    $this.text(init_text);
                                    $this.data('sending', false);
                                }

                            }, 1000);
                        } else {
                            $captchaInput.val('');
                            var $verify_img = $form.find(".verify_img");
                            if ($verify_img.length) {
                                $verify_img.attr("src", $verify_img.attr("src") + "&refresh=" + Math.random());
                            }
                            noty({
                                text: data.msg,
                                type: 'error',
                                layout: 'center'
                            });
                            $this.data('sending', false);
                        }
                    },
                    error: function () {
                        $this.data('sending', false);
                    },
                    complete: function () {
                        $this.data('loading', false);
                    }
                });
            });

        });
    }

    //邮件验证码
    var $js_get_email_code = $('.js-get-email-code');
    if ($js_get_email_code.length > 0) {
        Wind.use('noty', function () {

            $js_get_email_code.on('click', function () {
                var $this = $(this);
                if ($this.data('loading')) return;
                if ($this.data('sending')) return;
                var $email_input = $($this.data('email-input'));
                var email = $email_input.val();
                if (email == '') {
                    $email_input.focus();
                    return;
                }

                var $form = $this.parents('form');
                var $captchaInput = $("input[name='captcha']", $form);
                var $captchaIdInput = $("input[name='_captcha_id']", $form);
                var captcha = $captchaInput.val();
                var captchaId = $captchaIdInput.val();

                if (!captcha) {
                    $captchaInput.focus();
                    return;
                }

                $this.data('loading', true);
                $this.data('sending', true);

                var url = $this.data('url');

                var init_secode_left = parseInt($this.data('init-second-left'));
                init_secode_left = init_secode_left > 0 ? init_secode_left : 60;
                var init_text = $this.text();
                $this.data('second-left', init_secode_left);
                var wait_msg = $this.data('wait-msg');
                var codeType = $this.data('type');
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: { username: email, captcha: captcha, captcha_id: captchaId, type: codeType },
                    success: function (data) {
                        if (data.code == 1) {
                            noty({
                                text: data.msg,
                                type: 'success',
                                layout: 'center'
                            });

                            $this.text(String(wait_msg).replace('[second]', init_secode_left));

                            var mtimer = setInterval(function () {
                                if (init_secode_left > 0) {
                                    init_secode_left--;
                                    $this.text(String(wait_msg).replace('[second]', init_secode_left));
                                } else {
                                    clearInterval(mtimer);
                                    $this.text(init_text);
                                    $this.data('sending', false);
                                }

                            }, 1000);
                        } else {
                            $captchaInput.val('');
                            var $verify_img = $form.find(".verify_img");
                            if ($verify_img.length) {
                                $verify_img.attr("src", $verify_img.attr("src") + "&refresh=" + Math.random());
                            }

                            noty({
                                text: data.msg,
                                type: 'error',
                                layout: 'center'
                            });
                            $this.data('sending', false);
                        }
                    },
                    error: function () {
                        $this.data('sending', false);
                    },
                    complete: function () {
                        $this.data('loading', false);
                    }
                });
            });

        });
    }

    /*复选框全选(支持多个，纵横双控全选)。
     *实例：版块编辑-权限相关（双控），验证机制-验证策略（单控）
     *说明：
     *	"js-check"的"data-xid"对应其左侧"js-check-all"的"data-checklist"；
     *	"js-check"的"data-yid"对应其上方"js-check-all"的"data-checklist"；
     *	全选框的"data-direction"代表其控制的全选方向(x或y)；
     *	"js-check-wrap"同一块全选操作区域的父标签class，多个调用考虑
     */

    if ($('.js-check-wrap').length) {
        var total_check_all = $('input.js-check-all');

        //遍历所有全选框
        $.each(total_check_all, function () {
            var check_all = $(this),
                check_items;

            //分组各纵横项
            var check_all_direction = check_all.data('direction');
            check_items = $('input.js-check[data-' + check_all_direction + 'id="' + check_all.data('checklist') + '"]').not(":disabled");

            //点击全选框
            check_all.change(function (e) {
                var check_wrap = check_all.parents('.js-check-wrap'); //当前操作区域所有复选框的父标签（重用考虑）

                if ($(this).prop('checked')) {
                    //全选状态
                    check_items.prop('checked', true);

                    //所有项都被选中
                    if (check_wrap.find('input.js-check').length === check_wrap.find('input.js-check:checked').length) {
                        check_wrap.find(total_check_all).prop('checked', true);
                    }

                } else {
                    //非全选状态
                    check_items.removeProp('checked');

                    check_wrap.find(total_check_all).removeProp('checked');

                    //另一方向的全选框取消全选状态
                    var direction_invert = check_all_direction === 'x' ? 'y' : 'x';
                    check_wrap.find($('input.js-check-all[data-direction="' + direction_invert + '"]')).removeProp('checked');
                }

            });

            //点击非全选时判断是否全部勾选
            check_items.change(function () {

                if ($(this).prop('checked')) {

                    if (check_items.filter(':checked').length === check_items.length) {
                        //已选择和未选择的复选框数相等
                        check_all.prop('checked', true);
                    }

                } else {
                    check_all.removeProp('checked');
                }

            });


        });

    }

    //日期选择器
    var dateInput = $("input.js-date");
    if (dateInput.length) {
        Wind.use('datePicker', function () {
            dateInput.datePicker();
        });
    }

    //日期+时间选择器
    var dateTimeInput = $("input.js-datetime");
    if (dateTimeInput.length) {
        Wind.use('datePicker', function () {
            dateTimeInput.datePicker({
                time: true
            });
        });
    }

    // bootstrap年选择器
    var bootstrapYearInput = $("input.js-bootstrap-year")
    if (bootstrapYearInput.length) {
        Wind.css('bootstrapDatetimePicker');
        Wind.use('bootstrapDatetimePicker', function () {
            bootstrapYearInput.datetimepicker({
                language: 'zh-CN',
                format: 'yyyy',
                minView: 'decade',
                startView: 'decade',
                todayBtn: 1,
                autoclose: true
            });
        });
    }

    // bootstrap年月份选择器
    var bootstrapYearMonthInput = $("input.js-bootstrap-year-month");
    if (bootstrapYearMonthInput.length) {
        Wind.css('bootstrapDatetimePicker');
        Wind.use('bootstrapDatetimePicker', function () {
            bootstrapYearMonthInput.datetimepicker({
                language: 'zh-CN',
                format: 'yyyy-mm',
                minView: 'year',
                startView: 'decade',
                todayBtn: 1,
                autoclose: true
            });
        });
    }

    // bootstrap日期选择器
    var bootstrapDateInput = $("input.js-bootstrap-date")
    if (bootstrapDateInput.length) {
        Wind.css('bootstrapDatetimePicker');
        Wind.use('bootstrapDatetimePicker', function () {
            bootstrapDateInput.datetimepicker({
                language: 'zh-CN',
                format: 'yyyy-mm-dd',
                minView: 'month',
                todayBtn: 1,
                autoclose: true
            });
        });
    }

    // bootstrap日期选择器日期+时间选择器
    var bootstrapDateTimeInput = $("input.js-bootstrap-datetime");
    if (bootstrapDateTimeInput.length) {
        Wind.css('bootstrapDatetimePicker');
        Wind.use('bootstrapDatetimePicker', function () {
            bootstrapDateTimeInput.datetimepicker({
                language: 'zh-CN',
                format: 'yyyy-mm-dd hh:ii',
                todayBtn: 1,
                autoclose: true
            });
        });
    }

    //赞，拍等，有数量操作的按钮
    var $js_count_btn = $('a.js-count-btn');
    if ($js_count_btn.length) {
        Wind.use('noty', function () {
            $js_count_btn.on('click', function (e) {
                e.preventDefault();
                var $this = $(this),
                    href = $this.prop('href');

                $.post(href, {}, function (data) {

                    if (data.code == 1) {

                        var $count = $this.find(".count");
                        var count = parseInt($count.text());
                        $count.text(count + 1);
                        if (data.msg) {
                            noty({
                                text: data.msg,
                                type: 'success',
                                layout: 'center',
                                callback: {
                                    afterClose: function () {
                                        if (data.url) {
                                            location.href = data.url;
                                        }
                                    }
                                }
                            });
                        }


                    } else if (data.code == 0) {
                        noty({
                            text: data.msg,
                            type: 'error',
                            layout: 'center',
                            callback: {
                                afterClose: function () {
                                    if (data.url) {
                                        location.href = data.url;
                                    }
                                }
                            }
                        });
                    }


                }, "json");

            });

        });
    }



    //
    var $js_action_btn = $('a.js-action-btn');
    if ($js_action_btn.length) {
        Wind.use('noty', function () {
            $js_action_btn.on('click', function (e) {
                e.preventDefault();
                var $this = $(this),
                    href = $this.prop('href');

                $.post(href, {}, function (data) {

                    if (data.code == '1') {

                        if (data.msg) {
                            noty({
                                text: data.msg,
                                type: 'success',
                                layout: 'center',
                                callback: {
                                    afterClose: function () {
                                        if (data.url) {
                                            location.href = data.url;
                                        }
                                    }
                                }
                            });
                        }


                    } else if (data.code == 0) {
                        noty({
                            text: data.msg,
                            type: 'error',
                            layout: 'center',
                            callback: {
                                afterClose: function () {
                                    if (data.url) {
                                        location.href = data.url;
                                    }
                                }
                            }
                        });
                    }
                }, "json");

            });

        });
    }

    var $js_favorite_btn = $('a.js-favorite-btn');
    if ($js_favorite_btn.length) {
        Wind.use('noty', function () {
            $js_favorite_btn.on('click', function (e) {
                e.preventDefault();
                var $this = $(this),
                    href = $this.prop('href'),
                    url = $this.data("url"),
                    id = $this.data("id"),
                    table = $this.data('table'),
                    title = $this.data("title"),
                    description = $this.data("description");


                $.post(href, {
                    id: id,
                    table: table,
                    url: url,
                    title: title,
                    description: description
                }, function (data) {

                    if (data.code == 1) {

                        if (data.msg) {
                            noty({
                                text: data.msg,
                                type: 'success',
                                layout: 'center',
                                callback: {
                                    afterClose: function () {
                                        if (data.url) {
                                            location.href = data.url;
                                        }
                                    }
                                }
                            });
                        }


                    } else if (data.code == 0) {
                        noty({
                            text: data.msg,
                            type: 'error',
                            layout: 'center',
                            callback: {
                                afterClose: function () {
                                    if (data.url) {
                                        location.href = data.url;
                                    }
                                }
                            }
                        });
                    }


                }, "json");

            });

        });
    }

})();

//重新刷新页面，使用location.reload()有可能导致重新提交
function reloadPage(win) {
    if (win) {

    } else {
        win = window;
    }
    var location = win.location;
    location.href = location.pathname + location.search;
}

//页面跳转
function redirect(url) {
    location.href = url;
}

/**
 * 读取cookie
 * @param name
 * @returns
 */
function getCookie(name) {
    var cookieValue = null;
    if (document.cookie && document.cookie != '') {
        var cookies = document.cookie.split(';');
        for (var i = 0; i < cookies.length; i++) {
            var cookie = jQuery.trim(cookies[i]);
            // Does this cookie string begin with the name we want?
            if (cookie.substring(0, name.length + 1) == (name + '=')) {
                cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                break;
            }
        }
    }
    return cookieValue;
}

/**
 * 设置cookie
 */
function setCookie(name, value, options) {
    options = options || {};
    if (value === null) {
        value = '';
        options.expires = -1;
    }
    var expires = '';
    if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
        var date;
        if (typeof options.expires == 'number') {
            date = new Date();
            date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
        } else {
            date = options.expires;
        }
        expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
    }
    var path = options.path ? '; path=' + options.path : '';
    var domain = options.domain ? '; domain=' + options.domain : '';
    var secure = options.secure ? '; secure' : '';
    document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
}

function openIframeDialog(url, title, options) {
    var params = {
        title: title,
        lock: true,
        opacity: 0,
        width: "95%"
    };
    params = options ? $.extend(params, options) : params;
    Wind.use('artDialog', 'iframeTools', function () {
        art.dialog.open(url, params);
    });
}

/**
 * 打开地图对话框
 *
 * @param url
 * @param title
 * @param options
 * @param callback
 */
function openMapDialog(url, title, options, callback) {
    Wind.css('artDialog');
    var params = {
        title: title,
        lock: true,
        opacity: 0,
        width: "95%",
        height: 400,
        ok: function () {
            if (callback) {
                var d = this.iframe.contentWindow;
                var lng = $("#lng_input", d.document).val();
                var lat = $("#lat_input", d.document).val();
                var address = {};
                address.address = $("#address_input", d.document).val();
                address.province = $("#province_input", d.document).val();
                address.city = $("#city_input", d.document).val();
                address.district = $("#district_input", d.document).val();
                callback.apply(this, [lng, lat, address]);
            }
        }
    };
    params = options ? $.extend(params, options) : params;
    Wind.use('artDialog', 'iframeTools', function () {
        art.dialog.open(url, params);
    });
}

function openIframeLayer(url, title, options) {

    var params = {
        type: 2,
        title: title,
        shadeClose: true,
        // skin: 'layui-layer-nobg',
        shade: [0.001, '#000000'],
        shadeClose: true,
        area: ['95%', '90%'],
        move: false,
        content: url,
        yes: function (index, layero) {
            //do something
            layer.close(index); //如果设定了yes回调，需进行手工关闭
        }
    };
    params = options ? $.extend(params, options) : params;

    Wind.css('layer');

    Wind.use("layer", function () {
        layer.open(params);
    });

}

jQuery(document).ready(function ($) {
    $(document).on('click', '#user-menu-trigger', function (e) {
        e.stopPropagation();
        $('#user-header-menu').toggleClass('active');
    });
    $(document).on('click', function () {
        $('#user-header-menu').removeClass('active');
    });
    $(document).on('click', '#user-header-menu', function (e) {
        e.stopPropagation();
    });
});