$("#edtTitle").blur(function(){


    $.post(bloghost + "zb_users/plugin/Nobird_Seo_Tools/BeautyTitle/titlecheck.php",
        { title:$("#edtTitle").val(),
        id:$("#edtID").val()},
         function(data){
            switch(data.uid){
                case '-1':
                  $('<div class="hint"><p class="hint hint_bad">检测到重复的文章标题，请修改！</p></div>').prependTo('section.main');
                  break;
              default:

            }
            setTimeout('$("div.hint").slideUp()',10000);
        }, "json");
        




});

$("#edtAlias").blur(function(){


    $.post(bloghost + "zb_users/plugin/Nobird_Seo_Tools/BeautyTitle/titlecheck.php",
        {alias: $("#edtAlias").val(),
        id:$("#edtID").val() },
         function(data){
            switch(data.uid){
                case '-2':
                  $('<div class="hint"><p class="hint hint_bad">检测到重复的文章别名，请修改！</p></div>').prependTo('section.main');
                  break;
              default:

            }
                        setTimeout('$("div.hint").slideUp()',10000);

        }, "json");
        




});

