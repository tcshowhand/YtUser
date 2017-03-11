jQuery(document).ready(function($){ 
	$(document).delegate(".sf-praise-sdk[sfa='click']","click",function(event) {
		var postid=$(this).attr("data-postid");
		var value=$(this).attr("data-value");
		var okfunction=$(this).attr("data-ok");
		var checkfunction=$(this).attr("data-check");
		var errorfunction=$(this).attr("data-error");
		$.ajax({
			type:'post',
			async:true,
			url:bloghost + "zb_users/plugin/sf_praise_sdk/save.php?"+new Date(),
			data:{
				sf_praise_value:value,
				postid:postid
			},
			dataType:'html',
			success:function(data){
				if(data=="ok"){
					try{
						var ob=$(".sf-praise-sdk[data-postid='"+postid+"'][data-value='"+value+"'][sfa='num']");
						if(ob!=null){
							var sint=parseInt(ob.html(),10);
							sint++;
							ob.html(sint);
						}
					}catch(E){}
					if(okfunction!=null && okfunction!=""){
						try{
							eval(okfunction+"("+postid+","+value+")");
						}catch(E){};
					}
				}else if(data=="check"){
					if(checkfunction!=null && checkfunction!=""){
						try{
							eval(checkfunction+"("+postid+","+value+")");
						}catch(E){};
					}else{
						alert("你已经投过一次了，还想投么(￣口￣)！！！");
					}
				}else{
					if(errorfunction!=null && errorfunction!=""){
						try{
							eval(errorfunction+"("+postid+","+value+")");
						}catch(E){};
					}
				}
			}
		});
	});
});