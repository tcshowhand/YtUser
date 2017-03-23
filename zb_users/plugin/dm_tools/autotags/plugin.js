$(function() {
	$("#edtTag").after("<a href='javascript:void(0)' onclick='dmt_autotags_main();'> [提取标签]</a>");

});

function dmt_autotags_main(){
	if (document.forms["edit"].edtTag.value == "") {
	var title=document.forms["edit"].edtTitle.value;
	var content=editor_api.editor.content.get();
	var content=editor_api.editor.content.get();
	content = content.replace(/<\/?[^>]+>|\[\/?.+?\]|"/ig, "");
	content = content.replace(/\s{2,}/ig, ' ');
	content = content.replace(/#|&|\(|\)|\'|<|>/ig, '').substr(0, 200);

	$("#edtTag").attr("placeholder","分词中...");
    $.post(bloghost + "zb_users/plugin/dm_tools/autotags/do.php",{
		title:title,
        content:content},function(data){
			document.forms["edit"].edtTag.value = data.result;
			$("#edtTag").attr("placeholder","");
        }, "json");
	};
}