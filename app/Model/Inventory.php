<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Inventory
 * @author RotelandO
 */
class Inventory extends AppModel {
    
    public $name = 'Inventory';
    public $displayField = 'name';

    public $validate = array(
        'item_count' => array(
            'rule' => 'numeric',
            'message' => 'Please enter a valid number'
        )
    );
    
    public $hasMany = array(
        'InventoryValue' => array(
            'className' => 'InventoryValue',
            'foreignKey' => 'inventory_id',
            'dependent' => true
        ),
        'Record' => array(
            'className' => 'Record',
            'foreignKey' => 'inventory_id',
            'dependent' => true
        )
    );
    
    public $belongsTo = array(
        'Account' => array(
            'className' => 'Account',
            'foreignKey' => 'account_id'
        ),
        'InventoryItem' => array(
            'className' => 'InventoryItem',
            'foreignKey' => 'inventory_item_id'
        )
    );

    public function getAllInventories($condition = null) {
        $options['recursive'] = -1;
        $option['conditions'] = array('Inventory.item_count !=' => $condition);
        $option['order'] = 'Inventory.created DESC';
        $option['fields'] = array(
            'Inventory.id',
            'Inventory.direction',
            'Inventory.manufactured_date', 
            'Inventory.expiry_date',
            'Inventory.item_count',
            'Inventory.created',
            'Account.username',
            'InventoryItem.name',
            'Branch.id',
            'Branch.tagname',
            'MedicalFacility.name',
        );
        $option['joins'] = array(
             array(
                'table' => 'inventory_items',
                'alias' => 'InventoryItem',
                'type' => 'LEFT',
                'conditions' => array(
                    'Inventory.inventory_item_id = InventoryItem.id'
                )
            ),
            array(
                'table' => 'accounts',
                'alias' => 'Account',
                'type' => 'LEFT',
                'conditions' => array(
                    'Inventory.account_id = Account.id'
                )
            ),
            array(
                'table' => 'branches',
                'alias' => 'Branch',
                'type' => 'LEFT',
                'conditions' => array(
                    'Account.branch_id = Branch.id'
                ),
            ),
            array(
                'table' => 'medical_facilities',
                'alias' => 'MedicalFacility',
                'type' => 'LEFT',
                'conditions' => array(
                    'Branch.medical_facility_id = MedicalFacility.id'
                )
            )
        );
        
        return $this->find('all', $option);
    }

    public function getInventoryById($id){
        // debug($id);
        $options['recursive'] = -1;
        $option['fields'] = array(
            'Inventory.id',
            'Inventory.direction',
            'Inventory.manufactured_date', 
            'Inventory.unique_id',
            'Inventory.expiry_date',
            'Inventory.item_count',
            'Inventory.notes',
            'Inventory.created',
            'Account.username',
            'InventoryItem.id',
            'InventoryItem.name',
            'Branch.tagname',
            'MedicalFacility.name',
        );
        $option['joins'] = array(
            array(
                'table' => 'accounts',
                'alias' => 'Account',
                'type' => 'LEFT',
                'conditions' => array(
                    'Inventory.account_id = Account.id'
                )
            ),
             array(
                'table' => 'inventory_items',
                'alias' => 'InventoryItem',
                'type' => 'LEFT',
                'conditions' => array(
                    'Inventory.inventory_item_id = InventoryItem.id'
                )
            ),
            array(
                'table' => 'branches',
                'alias' => 'Branch',
                'type' => 'LEFT',
                'conditions' => array(
                    'Account.branch_id = Branch.id'
                )
            ),
            array(
                'table' => 'medical_facilities',
                'alias' => 'MedicalFacility',
                'type' => 'LEFT',
                'conditions' => array(
                    'Branch.medical_facility_id = MedicalFacility.id'
                )
            )
        );
        $option['conditions']['Inventory.id'] = $id;
        return $this->find('first', $option);
    }

    public function getInventoryAttributes(){
        // debug($id);

        /*$this->query(
            "SELECT `inventory_items`.`name`,
            SUM(`inventories`.`item_count`)
            FROM `inventories`
            LEFT JOIN `inventory_items`
            ON `inventories`.`inventory_item_id`=`inventory_items`.`id`
            GROUP BY `inventory_items`.`name`;"
        );*/

        $options['recursive'] = -1;
        $option['order'] = 'Inventory.id ASC';
        $option['fields'] = array(
            'Inventory.id',
            'Inventory.inventory_item_id',
            'Inventory.direction',
            'Inventory.manufactured_date',
            'Inventory.expiry_date',
            'Inventory.item_count',
            'Inventory.created',
            'Account.username',
            'InventoryItem.name',
            'InventoryValue.value',
            'InventoryAttribute.name',
            'Branch.tagname',
            'MedicalFacility.name',
        );
        $option['joins'] = array(
            array(
                'table' => 'accounts',
                'alias' => 'Account',
                'type' => 'LEFT',
                'conditions' => array(
                    'Inventory.account_id = Account.id'
                )
            ),
             array(
                'table' => 'inventory_items',
                'alias' => 'InventoryItem',
                'type' => 'INNER',
                'conditions' => array(
                    'Inventory.inventory_item_id = InventoryItem.id'
                )
            ),
            array(
                'table' => 'branches',
                'alias' => 'Branch',
                'type' => 'LEFT',
                'conditions' => array(
                    'Account.branch_id = Branch.id'
                )
            ),
            array(
                'table' => 'medical_facilities',
                'alias' => 'MedicalFacility',
                'type' => 'LEFT',
                'conditions' => array(
                    'Branch.medical_facility_id = MedicalFacility.id'
                )
            ),
            array(
                'table' => 'inventory_values',
                'alias' => 'InventoryValue',
                'type' => 'INNER',
                'conditions' => array(
                    'InventoryValue.inventory_id = Inventory.id'
                )
            ),
            array(
                'table' => 'inventory_attributes',
                'alias' => 'InventoryAttribute',
                'type' => 'INNER',
                'conditions' => array(
                    'InventoryAttribute.inventory_item_id = InventoryItem.id'
                )
            ),
        );
        $option['conditions']['Inventory.inventory_item_id'] = 1;
        return $this->find('all', $option);
    }

}
