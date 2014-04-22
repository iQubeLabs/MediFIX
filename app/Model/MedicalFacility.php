<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model', 'Branch');

/**
 * CakePHP MedicalFacility
 * @author RotelandO
 */
class MedicalFacility extends AppModel {
    
    public $name = 'MedicalFacility';
    public $displayField = 'name';
    
    public $hasMany = array(
        'Branch' => array(
            'className' => 'Branch',
            'foreignKey' => 'medical_facility_id',
            'dependent' => true
        )
    );
    
    public function findAllFacilities() {
        $option['fields'] = array(
            'MedicalFacility.id', 
            'MedicalFacility.name', 
            'MedicalFacility.logo',
            'MedicalFacility.brand_colour',
            'MedicalFacility.website_url',
            'MedicalFacility.rc_number',
//            'Branch.tagname'
            'COUNT(MedicalFacility.id) as branch_count'
        );
        $option['joins'] = array(
             array(
                'table' => 'branches',
                'alias' => 'Branch',
                'type' => 'LEFT',
                'conditions' => array(
                    'Branch.medical_facility_id = MedicalFacility.id'
                )
            )
        );
        $option['group'] = array('MedicalFacility.id');
        return $this->find('all', $option);
    }
    
    public function findFacilityById($id) {
       
       $options['recursive'] = 2;
       $options['joins'] = (array(
             array(
                'table' => 'branches',
                'alias' => 'Branch',
                'type' => 'INNER',
                'conditions' => array(
                    'Branch.medical_facility_id = MedicalFacility.id'
                )
            ),
           array(
                'table' => 'states',
                'alias' => 'State',
                'type' => 'INNER',
                'conditions' => array(
                    'Branch.state_id = State.id'
                )
            )
        )    
       );
       $options['conditions']['MedicalFacility.id'] = $id;
       return $this->find('first', $options);
    }
}
