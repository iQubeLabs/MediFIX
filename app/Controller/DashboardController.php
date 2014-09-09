<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP DashboardController
 * @author RotelandO
 */
class DashboardController extends AppController {

    public $name = 'Dashboard';
    
    public function beforeFilter() {
        parent::beforeFilter();
        
        $this->_setViewVariables('Dashboard', 'dashboard');
    }
    
    public function index() {
        
        $this->set('module_action', 'dashboard');

        $this->loadModel('Inventory');
        $this->loadModel('Record');

        $current_user = $this->Auth->user();
        $branch = $current_user['Branch']['id'];

        $inventories = $this->Inventory->query(
            "SELECT inventories.id, inventory_items.name, inventory_items.id, sum(item_count) as Quantity, branches.id
            FROM inventories, accounts, branches, inventory_items
            WHERE branches.id = $branch and accounts.branch_id = $branch and inventories.account_id = accounts.id and inventories.inventory_item_id = inventory_items.id
            GROUP BY inventory_items.id;"
        );

        //debug($inventories);
        $data = array();
        $i = 0;

        foreach ($inventories as $inventory) {
        	$data[$i]['name'] = $inventory['inventory_items']['name'];
        	$data[$i]['y'] = intval($inventory['0']['Quantity']);
            $i++;
        }
        $i--;
        $data[$i]['sliced'] = true;
        $data[$i]['selected'] = true;
        //debug($data);

        $in = $this->Record->query(
        	"SELECT SUM(item_count) AS Sum
        	FROM records, accounts, branches
        	WHERE yearweek(records.created) = yearweek(curdate()) and branches.id = $branch and accounts.branch_id = $branch and records.account_id = accounts.id and records.direction = 1;"
        );

        $out = $this->Record->query(
        	"SELECT SUM(item_count) AS Sum
        	FROM records, accounts, branches
        	WHERE yearweek(records.created) = yearweek(curdate()) and branches.id = $branch and accounts.branch_id = $branch and records.account_id = accounts.id and records.direction = 0;"
        );

        $records = $this->Record->getAllInventoryRecords();
        //$this->set('inventories', $records);

        $item_total = $this->Inventory->query(
            "SELECT inventories.id, inventory_items.name, inventory_items.id, sum(item_count) as Quantity, branches.id
            FROM inventories, accounts, branches, inventory_items
            WHERE branches.id = $branch and accounts.branch_id = $branch and inventories.account_id = accounts.id and inventories.inventory_item_id = inventory_items.id and inventories.deleted is NULL
            GROUP BY inventory_items.id;"
        );

        $this->set(
        	array(
        		'in' => $in,
        		'out' => $out,
        		'inventories' => $inventories,
        		'data' => $data,
                'records' => $records,
                'item_total' => $item_total
        	));

        //debug($in);
        //$this->set(compact('in'));
        
    }

}
