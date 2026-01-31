var container = document.createElement('script');
$(container).attr('type','text/plain').attr('id','img_editor');
$("body").append(container);
_editor = UE.getEditor('img_editor');
_editor.ready(function () {
	_editor.hide();
    $(".upimg-btn").click(function(){		
        object = $(this).prev("input");
        object1 = $(this).parent().find('.upimg-img img');
		_editor.getDialog("insertimage").open();
		_editor.addListener('beforeInsertImage', function (t, arg) {
			object.attr("value", arg[0].src);
            object1.attr("src", arg[0].src);
		});
	});
});