$(function() {
  $("#msg").after('<a href="javascript:void(0)" onclick="$(\'#ZWSJ-box\').slideToggle();" title="隐藏文章"> [隐藏文章]</a>');
  $("#ZWSJ-box").draggable();
  $("#ZWSJ-box input").mouseenter(function(){this.select();})
});
/* function charu(){
  var ueObj=UE.getEditor('editor_content');
  var range = ueObj.selection.getRange();
  range.select();
  var txt = ueObj.selection.getText();
  var disp = document.getElementById('tab2').style.display;
  if(disp=="none"){
	var value = document.all.zwcr.value;
	var lx=parseInt(document.getElementById('fenlei').value);
		if (lx==0){
			var obj=document.getElementById('fangshi');
			var index=obj.selectedIndex; 
			var val ="<span><strong>"+obj.options[index].text+"：</strong></span>";
		}else if(lx==1){
			var val ="<span><strong>热门推荐：</strong></span>";  
			}
	var value="<blockquote>"+val+"<p>"+value+"</blockquote>";
  }else{
	var value = "<blockquote><p>"+document.getElementById("sosos").innerHTML+"</blockquote>";
  }
  ueObj.execCommand('insertHtml', value);
 //$('#ZWSJ-box').slideToggle();
}
var ZWSJ_Edit = [];
ZWSJ_Edit['插入文章'] = 'background: rgba(0, 0, 0, 0) url(\'' + bloghost + 'zb_users/plugin/zwA/btn.bmp\') no-repeat center / 16px 16px !important;';
UE.registerUI('插入文章', function (editor, uiname) {
  var btn = new UE.ui.Button({
    name: uiname,
    title: uiname,
    cssRules: ZWSJ_Edit[uiname],
    //点击时执行的命令
    onclick: function () {
      $('#ZWSJ-box').slideToggle();
      if($("#divContent").offset().top<$(window).scrollTop()){
        $('#ZWSJ-box').css({"top":$(window).scrollTop()+10});
      }else{
        $('#ZWSJ-box').css({"top":"288px"});
      }
    }
  });
  showUser(0);
  return btn;
}); */
window.UEDITOR_CONFIG['toolbars'][0].push('插入文章');