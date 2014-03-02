<?php
App::uses('CakeEventListener','Event');

class ElFinderEventHandler implements CakeEventListener {
	public function implementedEvents() {
		return array(
			'Croogo.setupAdminData' => array(
				'callable' => 'onSetupAdminData',
			),
		);
	}

	public function onSetupAdminData($event){
		CroogoNav::add('media.children.attachments', array(
			'title' => __d('croogo', 'Files'),
			'url' => array(
				'admin' => true,
				'plugin' => 'el_finder',
				'controller' => 'el_finder',
				'action' => 'index',
			),
		));
	}
}
