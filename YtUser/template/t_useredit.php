{* Template Name: 个人资料 *}
<?php echo '<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">打开这个网页的是傻逼</h2>吼吼!</div>';
die(); ?>

{template:t_header}
<div class="col-19 col-m-24">

    <div class="row">

        <div class="col-24 col-m-24 mb15">
            <div class="tx-box bg-white">
                <h2 class="tx-title">个人信息</h2>
                <div class="tx-form-li pd15">
                    <ul class="row">

                        <form class="js-ajax-form" action="{$zbp->Config('YtUser')->api_userinfo}" method="post"
                            novalidate="novalidate" enctype="multipart/form-data">
                            <input id="edtID" name="ID" type="hidden" value="{$user.ID}">
                            <input id="edtGuid" name="Guid" type="hidden" value="{$user.Guid}">
                            <input type="hidden" name="token" id="token" value="{$zbp->GetToken()}" />

                            <li class="col-24 col-m-24">
                                <p class="user-avatar">
                                    <img id="avatar_preview" src="{$user.Avatar}">
                                    <input type="file" name="imgFile" id="user-imgFile" class="tx-input">
                                    <i>头像</i>
                                </p>
                            </li>
                            <script>
                                document.getElementById('user-imgFile').addEventListener('change', function (e) {
                                    if (this.files && this.files[0]) {
                                        var reader = new FileReader();
                                        reader.onload = function (e) {
                                            document.getElementById('avatar_preview').src = e.target.result;
                                        }
                                        reader.readAsDataURL(this.files[0]);
                                    }
                                });
                            </script>
                            <li class="col-12 col-m-24">
                                <p><input type="text" id="edtAlias" name="Alias" value="{$user.StaticName}"
                                        class="tx-input"><i>昵称(*)</i></p>
                            </li>
                            <li class="col-12 col-m-24">
                                <p><input type="text" id="edtEmail" name="Email" value="{$user.Email}"
                                        class="tx-input"><i>邮箱(*)</i></p>
                            </li>
                            <li class="col-12 col-m-24">
                                <p><input type="text" id="edtHomePage" name="HomePage" value="{$user.HomePage}"
                                        class="tx-input"><i>网站</i></p>
                            </li>
                            <li class="col-12 col-m-24">
                                <p><input type="text" id="meta_Tel" name="meta_Tel" value="{$user.Metas.Tel}"
                                        class="tx-input"><i>电话</i></p>
                            </li>
                            <li class="col-12 col-m-24">
                                <p><input type="text" id="meta_Add" name="meta_Add" value="{$user.Metas.Add}"
                                        class="tx-input"><i>地址</i></p>
                            </li>
                            <li class="input-ma col-12 col-m-24">
                                <p><input type="text" name="verifycode" class="tx-input"
                                        placeholder="验证码">{$article.verifycode}</p>
                            </li>
                            <li class="col-24 col-m-24">
                                <p><textarea id="edtIntro" name="Intro" class="tx-textarea" placeholder="个人简介"
                                        style="height:74px;">{$user.Intro}</textarea></p>
                            </li>
                            <li class="col-24 col-m-24">
                                <p class="tx-input-full"><button type="submit"
                                        class="js-ajax-submit tx-btn tx-btn-big bg-black">确定修改</button></p>
                            </li>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
{template:t_footer}这个框