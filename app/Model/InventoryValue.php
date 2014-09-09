<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP InventoryValue
 * @author RotelandO
 */
class InventoryValue extends AppModel {
    
    public $name = 'InventoryValue';
    public $displayField = 'name';
    
    public $belongsTo = array(
        'Inventory' => array(
            'className' => 'Inventory',
            'foreignKey' => 'inventory_id'
        ),
        'InventoryAttribute' => array(
            'className' => 'InventoryAttribute',
            'foreignKey' => 'inventory_attribute_id'
        ),
        'InventoryItem' => array(
            'className' => 'InventoryItem',
            'foreignKey' => 'inventory_item_id'
        )
    );

    public function getAllAttributesValue($inventory_id) {
        // debug($inventory_id);
        $options['recursive'] = -1;
        $option['fields'] = array(
            'InventoryAttribute.name',
            'InventoryAttribute.id',
            'InventoryAttribute.unit',
            'InventoryValue.value',
            'InventoryValue.id'
        );
        $option['joins'] = array(
             array(
                'table' => 'inventory_attributes',
                'alias' => 'InventoryAttribute',
                'type' => 'LEFT',
                'conditions' => array(
                    'InventoryValue.inventory_attribute_id = InventoryAttribute.id'
                )
            )
        );
        $option['conditions']['InventoryValue.inventory_id'] = $inventory_id;
        return $this->find('all', $option);
    }
}
