// Liam's ElFinder File Picker
var imagepicker = new Object();

$(function(){
// Create instance of elfinder
imagepicker.div = $("#images_finder");
imagepicker.elf = imagepicker.div.elfinder({
url : '<?php echo $this->Html->url(array('plugin'=>'el_finder','controller'=>'el_finder','action'=>'connector')) ?>',
height:300
}).elfinder('instance');

// Create a dialog for elfinder
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


// Get Files Method
imagepicker.getFiles = function(callback_function){
imagepicker.callback_function = callback_function;
imagepicker.dialog.dialog("open");
}
});

/* Example use of callback
$(function(){
// Bind select file button
$("#Images").on('click','.Image_select_file',function(){
imagepicker.row = $(this).parent();
imagepicker.getFiles(function(files){
  imagepicker.row.find('.url').val(files[0]);
  imagepicker.row.find('.image_preview').attr('src','<?php echo $this->Html->url('/') ?>' + files[0]);
});
});
*/
