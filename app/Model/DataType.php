<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP DataType
 * @author RotelandO
 */
class DataType extends AppModel {
    
    public $name = 'DataType';
    public $displayField = 'name';
    
    public $hasMany = array(
        'InventoryAttribute' => array(
            'className' => 'InventoryAttribute',
            'foreignKey' => 'data_type_id',
            'dependent' => true
        )
    );
    
    public function getDataTypeList() {
        return $this->find('list');
    }
}
