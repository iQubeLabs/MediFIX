<?php

App::uses('Model', 'AppModel');

class Record extends AppModel {

	public $name = 'Record';
//    public $displayField = 'name';

/*    public $validate = array(
        'item_count' => array(
            'rule' => 'numeric',
            'message' => 'Please enter a valid number'
        )
    );
*/    

/*		public $hasMany = array(
        'InventoryValue' => array(
            'className' => 'InventoryValue',
            'foreignKey' => 'inventory_id',
            'dependent' => true
        ),
    );
*/
    public $belongsTo = array(
        'Account' => array(
            'className' => 'Account',
            'foreignKey' => 'account_id'
        ),
        'Inventory' => array(
            'className' => 'Inventory',
            'foreignKey' => 'inventory_id'
        )
    );

    public function getAllInventoryRecords($limit = null) {
        $options['recursive'] = -1;
        $option['limit'] = $limit;
        $option['order'] = 'Record.created DESC';
        $option['fields'] = array(
            'Record.id',
            'Record.inventory_id',
            'Record.direction',
            'Record.item_count',
            'Record.created',
            'Account.username',
            'InventoryItem.name',
            'Branch.tagname',
            'Branch.id',
            'MedicalFacility.name',
        );
        $option['joins'] = array(
            array(
                'table' => 'inventories',
                'alias' => 'Inventory',
                'type' => 'LEFT',
                'conditions' => array(
                    'Inventory.id = Record.inventory_id' 
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
}

?>