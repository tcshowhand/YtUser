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


function Ytbuypay(){
	
	$.post(bloghost+'zb_users/plugin/YtUser/Ytbuypay.php',
		{
		"LogID":$("input[name='LogID']").val(),
        "verifycode":$("input[name='verifycode']").val(),
		},
		function(data){
			var s =data;
			if((s.search("faultCode")>0)&&(s.search("faultString")>0))
			{
				alert(s.match("<string>.+?</string>")[0].replace("<string>","").replace("</string>",""))
                window.location=bloghost+'?Integral';
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
				alert(s.match("<string>.+?</string>")[0].replace("<string>","").replace("</string>",""))
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