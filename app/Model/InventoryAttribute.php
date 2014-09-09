<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP InventoryAttribute
 * @author RotelandO
 */
class InventoryAttribute extends AppModel {
    
    public $name = 'InventoryAttribute';
    public $displayField = 'name';

    public $validate = array(
        'name' => array(
            'Cannot be empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please fill in this field.'
            )
        ),

        'description' => array(
            'Cannot be empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please fill in this field.'
            )
        ),

        'inventory_item_id' => array(
            'Cannot be empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please fill in this field.'
            )
        ),

        'data_type_id' => array(
            'Cannot be empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please fill in this field.'
            )
        ),
    );
    
    public $belongsTo = array(
        'InventoryItem' => array(
            'className' => 'InventoryItem',
            'foreignKey' => 'inventory_item_id'
        ),
        'DataType' => array(
            'className' => 'DataType',
            'foreignKey' => 'data_type_id'
        )
    );

    public function getAllAttributes() {
        $this->recursive = 1;
        return $this->find('all', array(
                'order' => array('InventoryAttribute.inventory_item_id ASC', 'InventoryAttribute.name ASC')
            ));
    }

    public function getInventoryAttributeList() {
        return $this->find('list');
    }

}
