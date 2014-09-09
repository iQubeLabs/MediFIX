<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model', 'Account', 'AccountType', 'MedicalFacility');

class Account extends AppModel {

    public $name = 'Account';
    public $displayField = 'username';
    
    public $validate = array(
      
        'username' => array(
            'Cannot be empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please fill your username.'
            ),
            'Greater than 6 character' => array(
                'rule' => array('minLength', 6),
                'message' => 'Minimum length of 6 characters'
            ),
            'Unique value' => array(
                'rule' => 'isUnique',
                'message' => 'Username already exists.'
            )
        ),
        'branch_id' => array(
            'Cannot be empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please select a branch name.'
            )
        ),
        'account_type_id' => array(
            'Cannot be empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please select an account type'
            )
        ),
        'password' => array(
            'Cannot be empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please fill in your password'
            ),
            'Match Passwords' => array(
                'rule' => 'matchPassword',
                'message' => false
            )
        ),
        'confirm_password' => array(
            'Cannot be empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Passwords do not match'
            )
        ),
    );
    
    public $belongsTo = array(
        'AccountType' => array(
            'className' => 'AccountType',
            'foreignKey' => 'account_type_id'
        ),
        'Branch' => array(
            'className' => 'Branch',
            'foreignKey' => 'branch_id'
        )
    );
    
    public $hasMany = array(
        'Inventory' => array(
            'className' => 'Inventory',
            'foreignKey' => 'account_id',
            'dependent' => true
        ),
        'Record' => array(
            'className' => 'Record',
            'foreignKey' => 'inventory_id',
            'dependent' => true
        )
    );
     
    public function matchPassword($data) {
        
        if ($data['password'] == $this->data['Account']['confirm_password']) {
            return true;
        }
        $this->invalidate('confirm_password', 'Password do not match');
        return false;
    }
    
    public function beforeSave($options = array()) {
        parent::beforeSave($options);

//        Check if the password from the form data is set or not empty
//        if (isset($this->data[$this->alias]['password'])) {
//            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
//        }
        
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = Security::hash($this->data[$this->alias]['password']);
        }

        return true;
    }
    
    public function findAllAccount() {
        $option['order'] = 'Account.root_user DESC';
        $option['fields'] = array(
            'Account.id', 
            'Account.username', 
            'Account.active',
            'Account.root_user',
            'Account.updated',
            'AccountType.name',
            'MedicalFacility.name',
            'Branch.id',
            'Branch.tagname'
        );
        $option['joins'] = array(
             array(
                'table' => 'account_types',
                'alias' => 'AccountType',
                'type' => 'LEFT',
                'conditions' => array(
                    'AccountType.id = Account.account_type_id'
                )
            ),
             array(
                'table' => 'branches',
                'alias' => 'Branch',
                'type' => 'LEFT',
                'conditions' => array(
                    'Branch.id = Account.branch_id'
                )
            ),
             array(
                'table' => 'medical_facilities',
                'alias' => 'MedicalFacility',
                'type' => 'LEFT',
                'conditions' => array(
                    'MedicalFacility.id = Branch.medical_facility_id'
                )
            )
        );
        return $this->find('all', $option);
    }
}

