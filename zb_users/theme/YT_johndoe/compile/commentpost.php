        <div class="row text-center"> <!-- contact form outer row with centered text-->
            <div class="col-md-10 col-md-offset-1"> <!-- col 10 with offset 1 to centered -->
                <form id="contact-form" class="form" name="sentMessage" action="<?php  echo $aboutme->CommentPostUrl;  ?>"  method="post"  novalidate> <!-- form wrapper -->
                <input type="hidden" name="inpId" id="inpId" value="<?php  echo $aboutme->ID;  ?>" />
                <input type="hidden" name="inpRevID" id="inpRevID" value="0" />

                    <div class="row"> <!-- nested inner row -->
                        <!-- Input your name -->
                        <div class="col-md-4">
                            <div class="form-group"> <!-- Your name input -->
                                <input type="text" autocomplete="off" class="form-control" placeholder="你的姓名 *" name="inpName" id="inpName" required data-validation-required-message="Please enter your name.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <!-- Input your email -->
                        <div class="col-md-4">
                            <div class="form-group"> <!-- Your email input -->
                                <input type="email" autocomplete="off" class="form-control" placeholder="你的邮箱 *" name="inpEmail" id="inpEmail" required data-validation-required-message="Please enter your email address.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <!-- Input your Phone no. -->
                        <div class="col-md-4">
                            <div class="form-group"> <!-- Your email input -->
                                <input type="text" autocomplete="off" class="form-control" placeholder="你的网站. *"  name="inpHomePage" id="inpHomePage" required data-validation-required-message="Please enter your phone no.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                    </div><!-- end nested inner row -->
                    <!-- Message Text area -->
                    <div class="form-group"> <!-- Your email input -->
                        <textarea class="form-control" rows="7" placeholder="Tell Us Something..." id="txaArticle" name="txaArticle" required data-validation-required-message="Please enter a message."></textarea>
                        <p class="help-block text-danger"></p>
                        <div id="success"></div>
                    </div>
                    <input type="submit" value="提交" class="btn btn-primary btn color" onclick="return VerifyMessage()" >
                <?php if ($option['ZC_COMMENT_VERIFY_ENABLE'] && !$user->ID) { ?><p><input type="text" name="inpVerify" id="inpVerify" class="text" value="" size="28" tabindex="4" /> <label for="inpVerify">验证码(*)</label><img style="width:<?php  echo $option['ZC_VERIFYCODE_WIDTH'];  ?>px;height:<?php  echo $option['ZC_VERIFYCODE_HEIGHT'];  ?>px;cursor:pointer;" src="<?php  echo $article->ValidCodeUrl;  ?>" alt="" title="" onclick="javascript:this.src='<?php  echo $article->ValidCodeUrl;  ?>&amp;tm='+Math.random();"/></p><?php } ?></form><!-- end form wrapper -->
            </div><!-- end col 10 with offset 1 to centered -->
        </div> <!-- end contact form outer row with centered text-->