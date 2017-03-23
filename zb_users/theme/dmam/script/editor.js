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
			txt="<br/>请输入"+hiddes[value]+"的内容<br/>";
		}
		editor.execCommand('insertHtml', '['+value+']'+txt+'[/'+value+']');
        }
    });

    //创建下拉菜单中的键值对
    var items = [];
	var hiddes={BuyView:'付费可见', LoginView5:'LEVEL5可见', LoginView4:'LEVEL4可见', LoginView3:'LEVEL3可见', LoginView2:'LEVEL2可见', LoginView1:'LEVEL1可见'/* ,ComView:'回复可见', ShareView:'分享可见' */};
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