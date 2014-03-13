var imagepicker = new Object();
imagepicker.getFiles = function(callback_function){
	if(!imagepicker.div){
		imagepicker.div = $("<div></div>");
	}

	if(!imagepicker.dialog){
		imagepicker.dialog = imagepicker.div.dialog({
		autoOpen:false,
		width:750,
		buttons:{
		  "Insert":function(){
		    // get array of files
		    var files = imagepicker.div.find(".ui-selected").map( function() {
		      return imagepicker.elf.path( $(this).attr('id') );
		    }).get();
		    imagepicker.callback_function(files);
		    imagepicker.dialog.dialog('close');
		  }
		}
		});
	}

	if(!imagepicker.elf){
		imagepicker.elf = imagepicker.div.elfinder({
		url : '<?php echo ClassRegistry::init('HtmlHelper')->url(array('plugin'=>'el_finder','controller'=>'el_finder','action'=>'connector','admin'=>true)) ?>',
		height:300
		}).elfinder('instance');
	}

	imagepicker.callback_function = callback_function;
	imagepicker.dialog.dialog("open");
}
