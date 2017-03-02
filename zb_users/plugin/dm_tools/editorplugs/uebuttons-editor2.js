$(document).ready(function(){
editor_api.editor.content.obj.ready(function(){
var str='<link rel="stylesheet" rev="stylesheet" href="'+bloghost+'zb_users/plugin/dmt/editorplugs/uebuttons-post.css" type="text/css" media="all"/>';
for(var i=0;i<window.frames.length;i++){
$(window.frames[i].document.head).append(str);
}
});
});

window.UEDITOR_CONFIG['toolbars'][0].push('带色文本框');
UE.registerUI('带色文本框',function(editor,uiName){
    //注册按钮执行时的command命令,用uiName作为command名字，使用命令默认就会带有回退操作
    editor.registerCommand(
	uiName,
	{
        execCommand:function(cmdName,value){
        var range = editor.selection.getRange();
		range.select();
		var txt = editor.selection.getText();
		if(txt==null || txt==""){
			txt="此处应有文本<br/>";
		}
		editor.execCommand('insertHtml', '<p class="'+value+'">'+txt+'</p>');
        }
    });

    //创建下拉菜单中的键值对
    var items = [];
	var color={lvse:'绿色文本框',hongse:'红色文本框', huangse:'黄色文本框', huise:'灰色文本框', lanse:'蓝色标题', putong:'普通标题'};
    for(key in color){
        items.push({
            label:color[key],
            value:key,
            renderLabelHtml:function () {
                return '<div class="edui-label %%-label" style="line-height:2;">' + (this.label || '') + '</div>';
            }
        });
    }
    //创建下来框
    var colorbox = new UE.ui.Combox({
        //需要指定当前的编辑器实例
        editor:editor,
        //添加条目
        items:items,
        //当选中时要做的事情
        onselect:function (t, index) {
            //拿到选中条目的值
            editor.execCommand(uiName, this.items[index].value);
        },
        //提示
        title:uiName,
        //当编辑器没有焦点时，combox默认显示的内容
        initValue:uiName
    });

    return colorbox;
});


window.UEDITOR_CONFIG['toolbars'][0].push('tanchu');
UE.registerUI('tanchu',function(editor,uiName){

    //创建dialog
    var ue_down = new UE.ui.Dialog({
        //指定弹出层中页面的路径，这里只能支持页面,因为跟addCustomizeDialog.js相同目录，所以无需加路径
       iframeUrl: bloghost+'zb_users/plugin/dmt/editorplugs/ue_down2.php',
        //需要指定当前的编辑器实例
        editor:editor,
        //指定dialog的名字
        name:uiName,
        //dialog的标题
        title:"弹出窗口",

        //指定dialog的外围样式
        cssRules:"width:600px;height:300px;",

        //如果给出了buttons就代表dialog有确定和取消
        buttons:[
            {
                className:'edui-okbutton',
                label:'确定',
                 onclick:function () {
                    ue_down.close(true);
                }
            },
            {
                className:'edui-cancelbutton',
                label:'取消',
                onclick:function () {
                    ue_down.close(false);
                }
            }
        ]});

    //参考addCustomizeButton.js
    var btn = new UE.ui.Button({
        name:'dialogbutton' + uiName,
        title:'dialogbutton' + uiName,
        //需要添加的额外样式，指定icon图标，这里默认使用一个重复的icon
        cssRules :"background: #ecf2d6 url('"+bloghost+"zb_users/plugin/dmt/editorplugs/images/wpgo_sc_tips_mini.png') -1px -1px no-repeat !important;",
        onclick:function () {
            //渲染dialog
            ue_down.render();
            ue_down.open();
        }
    });

    return btn;
});