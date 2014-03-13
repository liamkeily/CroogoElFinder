# ElFinder

Plugin for integrating [elFinder](http://elfinder.org/) into [Croogo](http://croogo.org).

Tested with 2.0 but should work with 1.5+

## Installation

Clone repository to your plugin directory (Plugin/ElFinder), and activate the plugin from your admin panel.

## Usage

From Media > Files you will be able to manage your files using ElFinder

## External Plugin Usage

Other plugins can use the image picker built into this plugin to select files.

Step 1. Include the script

> $this->Html->script('ElFinder.image_picker',array('inline'=>false));

Step 2. Add an event handler to a button.

`
$(function(){
$("#select_image").click(function(){
imagepicker.getFiles(function(files){
	console.log(files);
	for(i in files){
		var file = files[i];
	}
});
});
});
`

