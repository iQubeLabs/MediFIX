<?php
App::uses('AppController', 'Controller');

class RecordsController extends AppController {

	public $uses = array('Record');

	public function index() {
		$records = $this->Record->getAllInventoryRecords();
		$this->set('inventories', $records);
		debug($records);
	}
}

?>