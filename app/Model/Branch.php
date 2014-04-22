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
}
