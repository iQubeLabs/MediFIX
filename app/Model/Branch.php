<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Branches
 * @author RotelandO
 */
class Branch extends AppModel {
    
    public $name = 'Branch';
    public $displayField = 'tagname';

    public $validate = array(
        'tagname' => array(
            'Cannot be empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please fill in the name of the branch.'
            ),
        ),
        'address' => array(
            'Cannot be empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please fill in the branch address.'
            )
        ),
        'city' => array(
            'Cannot be empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please fill in the city.'
            )
        ),
        'state_id' => array(
            'Cannot be empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please select the state.'
            )
        ),
        'primary_phone' => array(
            'Cannot be empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please fill in branch primary phone.'
            )
        ),
        'geolocation' => array(
            'Cannot be empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please select a location on the map to your right.'
            )
        ),
        'medical_facility_id' => array(
            'Cannot be empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please select a medical facility.'
            )
        ),
    );
    
    public $belongsTo = array(
        'MedicalFacility' => array(
            'className' => 'MedicalFacility',
            'foreignKey' => 'medical_facility_id'
        ),
        'State' => array(
            'className' => 'State',
            'foreignKey' => 'state_id'
        )
    );
    
    public function findBranchesByFacilityId($id) {

       $options['recursive'] = 1;
       $options['conditions']['Branch.medical_facility_id'] = $id;
       return $this->find('all', $options);
    }
    
    public function getAllBranches() {
        $options['recursive'] = 1;
        return $this->find('all', $options);
    }
}
