<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP InventoryItem
 * @author RotelandO
 */
class InventoryItem extends AppModel {
    
    public $name = 'InventoryItem';
    public $displayField = 'name';

    public $validate = array(
        'name' => array(
            'Cannot be empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please fill in this field'
            ),
            'Unique item' => array(
                'rule' => 'isUnique',
                'message' => 'This product type is already available.'
            )
        ),
        'display_name' => array(
            'Cannot be empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please fill in this field'
            ),
            'Unique display name' => array(
                'rule' => 'isUnique',
                'message' => 'This display name already exists. Use a different display name.'
            )
        )
    );
    
    public $hasMany = array(
        'InventoryAttribute' => array(
            'className' => 'InventoryAttribute',
            'foreignKey' => 'inventory_item_id',
            'dependent' => true
        ),
        'Inventory' => array(
            'className' => 'Inventory',
            'foreignKey' => 'inventory_item_id'
        ),
        'InventoryValue' => array(
            'className' => 'InventoryValue',
            'foreignKey' => 'inventory_item_id'
        ),
    );
    
    public function getAllInventoryItems() {
        $options['recursive'] = 1;
        return $this->find('all', $options);
    }
    
    public function getInventoryItemList() {
        return $this->find('list');
    }

    /*public function getInventoryItems(){
        // debug($id);

        $this->query(
            "SELECT `inventory_items`.`name`,
            SUM(`inventories`.`item_count`)
            FROM `inventories`
            LEFT JOIN `inventory_items`
            ON `inventories`.`inventory_item_id`=`inventory_items`.`id`
            GROUP BY `inventory_items`.`name`;"
        );
    }*/
}
