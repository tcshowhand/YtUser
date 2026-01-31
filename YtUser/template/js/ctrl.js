$('#addminiimgbtn').click(function(event) {
	var url =$('#hosturls').val();
	$('body').append('<div class="cutimgs" id="cutimgs"><h3>添加缩略图<b id="cutimgclose">X</b></h3></div>');
	$('#cutimgs').append('<iframe frameborder="no" border="0" id="cutimgframe" width="690" height="470" src="'+url+'zb_users/plugin/lentonImgCut/crop/index.php"></iframe>');
	$('#cutimgs').append('<div></div>');

	$('#cutimgclose').click(function(event) {
		$('#cutimgs').remove();
	});
	$('#cutimgupload').click(function(event) {
		var strm = $('#cutfullimg');
	});
});

function closeCutimgBox(){
	document.getElementById('cutimgs').style.display="none";
}

function miniInsert() {
  var miniueObj = UE.getEditor('editor_content');
  var miniimgsrc= document.getElementById("lentonMinImg").value;
  var minivalue = "<img src=" + miniimgsrc + "\>";
  miniueObj.execCommand('insertHtml', minivalue);
}