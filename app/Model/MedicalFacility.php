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

    public $validate = array(
        'name' => array(
            'Cannot be empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please fill in the facility name.'
            )
        ),
        'brand_colour' => array(
            'Cannot be empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please choose a colour.'
            )
        ),
        'rc_number' => array(
            'Cannot be empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please fill in your RC number.'
            )
        ),
        'logo' => array(
            'Cannot be empty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please choose a picture.'
            )
        ),
    );
    
    public $hasMany = array(
        'Branch' => array(
            'className' => 'Branch',
            'foreignKey' => 'medical_facility_id',
            'dependent' => true
        )
    );
    
    public function findAllFacilities() {

        return $this->query(
            "SELECT MedicalFacility.id, name, logo, brand_colour, website_url, rc_number, COUNT(MedicalFacility.id) as branch_count
            FROM medical_facilities as MedicalFacility, branches as Branch
            WHERE MedicalFacility.id = Branch.medical_facility_id and Branch.deleted is NULL
            GROUP BY MedicalFacility.id;"
            );

        /*$option['fields'] = array(
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
                    'MedicalFacility.id = Branch.medical_facility_id',
                    'Branch.deleted is NULL'
                )
            )
        );
        $option['group'] = array('MedicalFacility.id');
        return $this->find('all', $option);*/
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
