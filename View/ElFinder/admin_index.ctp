<?php
$this->set('showActions', false);
$this->extend('/Common/admin_index');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb('File Manager', array('controller' => 'el_finder', 'action' => 'index'));
?>

<script type="text/javascript" charset="utf-8">
	$().ready(function() {
		var elf = $('#elfinder').elfinder({
			url : '/admin/el_finder/el_finder/connector'  // connector URL (REQUIRED)
		}).elfinder('instance');		
	});
</script>

<div class="alert">Only use this file manager to store <strong>PUBLIC</strong> files. <small>All of these files can be accessed by a public URL.</small></div>
<!-- Element where elFinder will be created (REQUIRED) -->
<div id="elfinder"></div>
