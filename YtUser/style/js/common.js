$(function(){
	//密码控件禁止复制/剪切/粘贴
	$("input:password").bind("copy cut paste",function(e){
		return false;
	});
});

//60秒发送限制
var countdown=60; 
function settime(val){
    if(countdown == 0){
        val.removeAttribute("disabled");
        val.value="免费获取验证码";
        countdown = 60;
    }else{
        val.setAttribute("disabled", true);
        val.value="重新发送(" + countdown + ")";
        countdown--;
    }
    setTimeout(function(){
        settime(val)
    },1000)
}