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
class Attribute extends AppModel {
    
    public $name = 'Attribute';

    public $validate = array(
        'name' => array(
            'Cannot be empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please fill in the attribute name.'
            )
        ),
        'data_type_id' => array(
            'Cannot be empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please select a data type for the value of the attribute.'
            )
        ),
        'inventory_item_id' => array(
            'Cannot be empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please an inventory item'
            )
        ),
    );
    
    public $belongsTo = array(
        'Inventory' => array(
            'className' => 'Inventory',
            'foreignKey' => 'inventory_id'
        ),
        'InventoryAttribute' => array(
            'className' => 'InventoryAttribute',
            'foreignKey' => 'inventory_attribute_id'
        )
    );
}
