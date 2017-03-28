function add_z_hide_lv(){
	var htm="<p>[hide_lv]</p>在这里填写登陆可见的内容，需要注意防止自动摘要提取到隐藏内容。<p>[/hide_lv]</p>";	
editor_api.editor.content.obj=UE.getEditor('editor_content'); 
editor_api.editor.content.obj.execCommand("insertHTML",htm);
return true;
}
function add_z_hide_cv(){
	var htm="<p>[hide_cv]</p>在这里填写回复可见的内容，需要注意防止自动摘要提取到隐藏内容。<p>[/hide_cv]</p>";	
editor_api.editor.content.obj=UE.getEditor('editor_content'); 
editor_api.editor.content.obj.execCommand("insertHTML",htm);
return true;
}