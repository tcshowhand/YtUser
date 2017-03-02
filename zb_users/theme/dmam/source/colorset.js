
$(document).ready(function() {
	
	// Events demo
	$('#cp1').colorpicker({color:'#8db3e2',
		initialHistory: ['#ff0000','#000000','red']
})
		.on('change.color', function(evt, color){
			$('#cpb').css('background-color',color);
		})
		.on('mouseover.color', function(evt, color){
            if(color){
                $('#cpb').css('background-color',color);
            }
		});
	
	$('#getVal').on('click', function(){
		alert('Selected color = "' + $('#cp1').colorpicker("val") + '"');
	});
	$('#setVal').on('click', function(){
		$('#cp1').colorpicker("val",'#31859b');
	});
	$('#enable').on('click', function(){
		$('#cp1').colorpicker("enable");
	});
	$('#disable').on('click', function(){
		$('#cp1').colorpicker("disable");
	});
	$('#clear').on('click', function(){
		var v=$('#cp1').colorpicker("clear") ;
	});
	$('#destroy1').on('click', function(){
		var v=$('#cp1').colorpicker("destroy") ;
	});
	
	// Instanciate colorpickers
    $('#cpBoth').colorpicker();
    $('#cpDiv').colorpicker({color:'#31859b'});
    $('#cpDiv2').colorpicker({color:'#31859b', defaultPalette:'web'});
    $('#cpFocus').colorpicker({showOn:'focus'});
    $('#cpButton').colorpicker({showOn:'button'});
    $('#cpOther').colorpicker({showOn:'none'});
	$('#show').on('click', function(evt){
		evt.stopImmediatePropagation();
		$('#cpOther').colorpicker("showPalette");
	});
	
	// With transparent color
	$('#transColor').colorpicker({
		transparentColor: true
	});

	// With hidden button
	$('#hideButton').colorpicker({
		hideButton: true
	});

	// No color indicator
	$('#noIndColor').colorpicker({
		displayIndicator: false
	});

	// French colorpicker
	$('#frenchColor').colorpicker({
		strings: "Couleurs de themes,Couleurs de base,Plus de couleurs,Moins de couleurs,Palette,Historique,Pas encore d'historique."
	});

	// Inline colorpicker
	$('#getVal2').on('click', function(){
		alert('Selected color = "' + $('#cpDiv').colorpicker("val") + '"');
	});
	$('#setVal2').on('click', function(){
		$('#cpDiv').colorpicker("val",'#31859b');
	});
	$('#enable2').on('click', function(){
		$('#cpDiv').colorpicker("enable");
	});
	$('#disable2').on('click', function(){
		$('#cpDiv').colorpicker("disable");
	});
	$('#destroy2').on('click', function(){
		$('#cpDiv').colorpicker("destroy");
	});

	// Fix links
	$('a[href="#"]').attr('href', 'javascript:void(0)');



	if ('UE' in window) {
		var myEditorImage;
		var d, e;
		myEditorImage = UE.getEditor('ueimg');
		myEditorImage.ready(function() { 
			myEditorImage.hide(); 
		});

		function upImage() {
			d = myEditorImage.getDialog("insertimage");
			d.render();
			d.open();
		}
		$("#updatapic1,#updatapic2,#updatapic3,#updatapic4,#updatapic5,#updatapic6,#updatapic7,#updatapic8,#updatapic9,#updatapic10").click(function() {
			upImage();
			e = $(this).attr("id");
			myEditorImage.addListener('beforeInsertImage', function(t, arg) {
				$("#url_" + e).val(arg[0].src);
				$("#pic_" + e).attr("src", arg[0].src + "?" + Math.random());
			})
		});
	}


});