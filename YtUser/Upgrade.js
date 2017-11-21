function YtFavorite_custom(yt_type,yt_mms,yt_obj,yt_isok) {
	if (yt_isok == 'success'){
		alert(yt_mms);
		if (yt_type == 'add'){
			$(yt_obj).removeClass('am-icon-star-o');
			$(yt_obj).addClass('am-icon-star');
			$(yt_obj).text('已收藏');
			$(yt_obj).removeAttr('onclick');
		}else if (yt_type == 'del'){
			$(yt_obj).closest('tr').remove();
		}else{
			alert('no zuo no die');
		}
	}else if (yt_isok == 'failed'){
		alert(yt_mms.match("<string>.+?</string>")[0].replace("<string>","").replace("</string>",""));
	}else{
		alert('no zuo no die');
	}
}

function YtFavorite(fvtype, pid, obj){
	if (fvtype == 'add'){
		var posturl=bloghost+'zb_users/plugin/YtUser/favorite/add.php';
	}else if (fvtype == 'del'){
		var posturl=bloghost+'zb_users/plugin/YtUser/favorite/del.php';
	}else{
		alert('no zuo no die');
	}
	if (fvtype == 'add' || fvtype == 'del'){
	$.post(posturl,
		{
		"LogID":pid,
		},
		function(data){
			var s = data;
			if((s.search("faultCode")>0)&&(s.search("faultString")>0)){
				YtFavorite_custom(fvtype,s,obj,'failed');
			}else{
				YtFavorite_custom(fvtype,s,obj,'success');
			}
		}
	);
	}
}

function YtSbuy(){
	$.post(bloghost+'zb_users/plugin/YtUser/YtSbuy.php',
		{
		"LogID":$("input[name='LogID']").val(),
		"verifycode":$("input[name='verifycode']").val(),
		},
		function(data){
			var s =data;
			if((s.search("faultCode")>0)&&(s.search("faultString")>0))
			{
				alert(s.match("<string>.+?</string>")[0].replace("<string>","").replace("</string>",""))
			}
			else{
				var s =data;
				alert(s);
				window.location.reload();
			}
		}
	);
}

function Ytbuy(){
	$.post(bloghost+'zb_users/plugin/YtUser/Ytbuy.php',
		{
		"LogID":$("input[name='LogID']").val(),
		"verifycode":$("input[name='verifycode']").val(),
		},
		function(data){
			var s =data;
			if((s.search("faultCode")>0)&&(s.search("faultString")>0))
			{
				alert(s.match("<string>.+?</string>")[0].replace("<string>","").replace("</string>",""))
			}
			else{
				var s =data;
				alert(s);
				window.location=bloghost+'?buy&uid='+$("input[name='LogID']").val();
			}
		}
	);
}

function RegPage(){
	$.post(bloghost+'zb_users/plugin/YtUser/Upgrade.php',
		{
		"invitecode":$("input[name='invitecode']").val(),
		"verifycode":$("input[name='verifycode']").val(),
		},
		function(data){
			var s =data;
			if((s.search("faultCode")>0)&&(s.search("faultString")>0))
			{
				alert(s.match("<string>.+?</string>")[0].replace("<string>","").replace("</string>",""));
				$("#reg_verfiycode").attr("src",bloghost+"zb_system/script/c_validcode.php?id=RegPage&amp;tm="+Math.random());
			}
			else{
				var s =data;
				alert(s);
				window.location=bloghost+'?User';
			}
		}
	);

}


function Ytbuypay(){
	$.post(bloghost+'zb_users/plugin/YtUser/Ytbuypay.php',
		{
		"LogID":$("input[name='LogID']").val(),
		},
		function(data){
			var s =data;
			if((s.search("faultCode")>0)&&(s.search("faultString")>0))
			{
                var yt=s.match("<string>.+?</string>")[0].replace("<string>","").replace("</string>","");
				alert(yt);
                if(yt =="积分不够，请充值."){
                    window.location=bloghost+'?Integral';
                }
			}
			else{
				var s =data;
				alert(s);
				window.location=$("input[name='LogUrl']").val();
			}
		}
	);

}

function Integral(){
	$.post(bloghost+'zb_users/plugin/YtUser/Integral.php',
		{
		"invitecode":$("input[name='invitecode']").val(),
		"verifycode":$("input[name='verifycode']").val(),
		},
		function(data){
			var s =data;
			if((s.search("faultCode")>0)&&(s.search("faultString")>0))
			{
				alert(s.match("<string>.+?</string>")[0].replace("<string>","").replace("</string>",""));
				$("#reg_verfiycode").attr("src",bloghost+"zb_system/script/c_validcode.php?id=Integral&amp;tm="+Math.random());
			}
			else{
				var s =data;
				alert(s);
				window.location=bloghost+'?Integral';
			}
		}
	);

}



function register(){
	$.post(bloghost+'zb_users/plugin/YtUser/register.php',
		{
		"name":$("input[name='name']").val(),
		"password":$("input[name='password']").val(),
		"repassword":$("input[name='repassword']").val(),
		"email":$("input[name='email']").val(),
		"homepage":$("input[name='homepage']").val(),
		"verifycode":$("input[name='verifycode']").val(),
		},
		function(data){
			var s =data;
			if((s.search("faultCode")>0)&&(s.search("faultString")>0))
			{
				alert(s.match("<string>.+?</string>")[0].replace("<string>","").replace("</string>",""));
				$("#reg_verfiycode").attr("src",bloghost+"zb_system/script/c_validcode.php?id=register&amp;tm="+Math.random());
			}
			else{
				var s =data;
				alert(s);
				window.location=bloghost+'?User';
			}
		}
	);
}


function Ytuser_Login(){
	$.post(bloghost+'zb_users/plugin/YtUser/cmd.php?act=verify',
		{
		"verifycode":$("input[name='verifycode']").val(),
		"username":$("input[name='edtUserName']").val(),
		"edtPassWord":MD5($("input[name='edtPassWord']").val()),
		"strSaveDate":$("input[name='chkRemember']").val(),
		},
		function(data){
			var s =data;
			if((s.search("faultCode")>0)&&(s.search("faultString")>0))
			{
				alert(s.match("<string>.+?</string>")[0].replace("<string>","").replace("</string>",""))
			}
			else{
				var s =data;
				alert(s);
				window.location=bloghost+'?User';
			}
		}
	);
}

function Ytuser_allLogin(){
	$.post(bloghost+'zb_users/plugin/YtUser/cmd.php?act=verify',
		{
		"username":$("input[name='allUserName']").val(),
		"edtPassWord":MD5($("input[name='allPassWord']").val()),
		"strSaveDate":$("input[name='allRemember']").val(),
		},
		function(data){
			var s =data;
			if((s.search("faultCode")>0)&&(s.search("faultString")>0))
			{
				alert(s.match("<string>.+?</string>")[0].replace("<string>","").replace("</string>",""))
			}
			else{
				var s =data;
				alert(s);
				window.location.reload();
			}
		}
	);
}

function resetpwd(){
	$.post(bloghost+'zb_users/plugin/YtUser/mailto.php',
		{
		"name":$("input[name='name']").val(),
		"email":$("input[name='email']").val(),
		"verifycode":$("input[name='verifycode']").val(),
		},
		function(data){
			var s =data;
			if((s.search("faultCode")>0)&&(s.search("faultString")>0))
			{
				alert(s.match("<string>.+?</string>")[0].replace("<string>","").replace("</string>",""));
				$("#reg_verfiycode").attr("src",bloghost+"zb_system/script/c_validcode.php?id=resetpwd&amp;tm="+Math.random());
			}
			else{
				var s =data;
				alert(s);
				window.location=bloghost;
			}
		}
	);
}

function Resetpassword(){
	$.post(bloghost+'zb_users/plugin/YtUser/resetpassword.php',
		{
		"username":$("input[name='username']").val(),
        "hash":$("input[name='hash']").val(),
        "password":$("input[name='password']").val(),
		"verifycode":$("input[name='verifycode']").val(),
		},
		function(data){
			var s =data;
			if((s.search("faultCode")>0)&&(s.search("faultString")>0))
			{
				alert(s.match("<string>.+?</string>")[0].replace("<string>","").replace("</string>",""));
				$("#reg_verfiycode").attr("src",bloghost+"zb_system/script/c_validcode.php?id=Resetpassword&amp;tm="+Math.random());
			}
			else{
				var s =data;
				alert(s);
				window.location=bloghost+'?Login';
			}
		}
	);
}


function Nameedit(){
	$.post(bloghost+'zb_users/plugin/YtUser/nameedit.php',
		{
		"name":$("input[name='name']").val(),
		"rename":$("input[name='rename']").val(),
		"token":$("input[name='token']").val(),
		"verifycode":$("input[name='verifycode']").val(),
		},
		function(data){
			var s =data;
			if((s.search("faultCode")>0)&&(s.search("faultString")>0))
			{
				alert(s.match("<string>.+?</string>")[0].replace("<string>","").replace("</string>",""));
				$("#reg_verfiycode").attr("src",bloghost+"zb_system/script/c_validcode.php?id=Nameedit&amp;tm="+Math.random());
			}
			else{
				var s =data;
				alert(s);
				window.location=bloghost+'?User';
			}
		}
	);
}

function checkArticleInfo(){
	$.post(bloghost+'zb_users/plugin/YtUser/articleInfo.php',
		{
		"Title":$("input[name='Title']").val(),
		"Alias":$("input[name='Alias']").val(),
		"Tag":$("input[name='Tag']").val(),
		"CateID":$("*[name='CateID']").val(),
		"Content":editor.getContent(),
		"token":$("input[name='token']").val(),
		"verifycode":$("input[name='verifycode']").val(),
		},
		function(data){
			var s =data;
			if((s.search("faultCode")>0)&&(s.search("faultString")>0))
			{
				alert(s.match("<string>.+?</string>")[0].replace("<string>","").replace("</string>",""));
				$("#reg_verfiycode").attr("src",bloghost+"zb_system/script/c_validcode.php?id=Articleedt&amp;tm="+Math.random());
			}
			else{
				var s =data;
				alert(s);
				window.location=bloghost+'?Articlelist';
			}
		}
	);
}

function Changepassword(){
	$.post(bloghost+'zb_users/plugin/YtUser/changepassword.php',
		{
        "password":$("input[name='password']").val(),
        "newpassword":$("input[name='newpassword']").val(),
        "repassword":$("input[name='repassword']").val(),
		"token":$("input[name='token']").val(),
		"verifycode":$("input[name='verifycode']").val(),
		},
		function(data){
			var s =data;
			if((s.search("faultCode")>0)&&(s.search("faultString")>0))
			{
				alert(s.match("<string>.+?</string>")[0].replace("<string>","").replace("</string>",""));
				$("#reg_verfiycode").attr("src",bloghost+"zb_system/script/c_validcode.php?id=Changepassword&amp;tm="+Math.random());
			}
			else{
				var s =data;
				alert(s);
				window.location=bloghost+'?Login';
			}
		}
	);
}


