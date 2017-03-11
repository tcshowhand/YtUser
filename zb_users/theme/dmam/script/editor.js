window.UEDITOR_CONFIG.toolbars[0].push('文章隐藏');
UE.registerUI('文章隐藏',function(editor,uiName){
    //注册按钮执行时的command命令,用uiName作为command名字，使用命令默认就会带有回退操作
    editor.registerCommand(
	uiName,	{
        execCommand:function(cmdName,value){
        var range = editor.selection.getRange();
		range.select();
		var txt = editor.selection.getText();
		if(txt==null || txt==""){
			txt="请输入需要隐藏的内容<br/>";
		}
		editor.execCommand('insertHtml', '<div class="'+value+'">'+txt+'</div>');
        }
    });

    //创建下拉菜单中的键值对
    var items = [];
	var hiddes={ffkj:'付费可见'/* ,hfkj:'回复可见', fxkj:'分享可见' */};
    for(key in hiddes){
        items.push({
            label:hiddes[key],
            value:key,
            renderLabelHtml:function () {
                return '<div class="edui-label %%-label" style="line-height:2;">' + (this.label || '') + '</div>';
            }
        });
    }
    //创建下来框
    var hidde = new UE.ui.Combox({
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

    return hidde;
});