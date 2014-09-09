<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

class AccountType extends AppModel {
    
    public $name = 'AccountType';
    public $displayField = 'name';
    
    public $validate = array(
        'Cannot be empty' => array(
            'rule' => 'notEmpty',
            'message' => 'Please fill in your username'
        ),
        'Unique value' => array(
            'rule' => 'isUnique',
            'message' => 'Username already exist.'
        )
    );
    
    public $hasMany = array(
        'Account' => array(
            'className' => 'Account',
            'foreignKey' => 'account_type_id',
            'dependent' => true
        )
    );
   
}

