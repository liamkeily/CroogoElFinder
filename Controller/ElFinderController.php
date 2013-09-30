<?php

App::uses('ElFinderAppController', 'ElFinder.Controller');
App::uses('elFinderConnector','ElFinder.Lib');
App::uses('elFinder','ElFinder.Lib');
App::uses('elFinderVolumeDriver','ElFinder.Lib');
App::uses('elFinderVolumeLocalFileSystem','ElFinder.Lib');

/**
 * ElFinder Controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  Croogo
 * @version  1.0
 * @author   Paul Gardner <phpmagpie@webbedit.co.uk>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class ElFinderController extends ElFinderAppController {

/**
 * Controller name
 *
 * @var string
 * @access public
 */
	public $name = 'ElFinder';
	
/**
 * Models used by the Controller
 *
 * @var array
 * @access public
 */
	public $uses = array();

/**
 * Path can be defined and will be appended to the default path.
 * Can be used to give each user their root folder
 *
 * @var string
 * @access public
 */
	public $path = '';

/**
 * admin_index
 *
 * @return void
 */


	public function beforeFilter(){

		$this->Security->unlockedActions[] = 'admin_connector';

		parent::beforeFilter();
	}

	public function admin_index() {
		$this->set('title_for_layout', 'ElFinder Attachments');
	}

	public function admin_connector(){
		Configure::write('debug',0);
		
		if(!file_exists(APP.'webroot/uploads/'.$this->path)){
			mkdir(APP.'webroot/uploads/'.$this->path);
			chmod(APP.'webroot/uploads/'.$this->path,0777);
		}

		$opts = array(
			'roots' => array(
				array(
					'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
					'path'          => APP.'webroot/uploads/'.$this->path,         // path to files (REQUIRED)
					'URL'           => 'http://'.$_SERVER['SERVER_NAME'] . '/uploads/'.$this->path, // URL to files (REQUIRED)
					'accessControl' => array($this,'access')            // disable and hide dot starting files (OPTIONAL)
				)
			)
		);

		$this->connector = new elFinderConnector(new elFinder($opts));
		$this->connector->run();
	}

	function access($attr, $path, $data, $volume) {
	return strpos(basename($path), '.') === 0       // if file/folder begins with '.' (dot)
		? !($attr == 'read' || $attr == 'write')    // set read+write to false, other (locked+hidden) set to true
		:  null;                                    // else elFinder decide it itself
	}

}
