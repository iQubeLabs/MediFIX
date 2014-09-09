<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP MedicalFacilities
 * @author RotelandO
 */
class MedicalFacilitiesController extends AppController {

    public $name = 'MedicalFacilities';
    public $uses = array('MedicalFacility', 'Branch', 'State');
    
    public function beforeFilter() {
        parent::beforeFilter();
        
        $this->_setViewVariables('Medical Facilities', 'facilities');
        
        $this->set('module_action', 'facility_create');
    }
    
    public function index() {
        $facilities = $this->MedicalFacility->findAllFacilities();
        $this->set('facilities', $facilities);
        
        debug($facilities);
    }

    public function view($id = null) {
        
//        $this->set('module_action', 'facility_create');
        
        $this->MedicalFacility->id = $id;

        if (!$this->MedicalFacility->exists() || !$id) {
            $this->Session->setFlash('Invalid facility', 'page_notification_error');
            $this->redirect(array('controller' => 'facilities', 'action' => 'index'));
        }

//        $this->MedicalFacility->recursive = 1;
        $facility = $this->MedicalFacility->findById($id);
        $branches = $this->Branch->findBranchesByFacilityId($id);
        $this->set(array('facility' => $facility, 'branches' => $branches));
//        debug($facility);
//        debug($branches);
    }
    
    public function create() {
        
//        $this->set('module_action', 'facility_create');
        
        $state_list = $this->State->find('list');
        $this->set('state_list', $state_list);
        $medicalFacility = $this->request->data;
        
        if ($this->request->is('Post') || $this->request->is('Put')) {
            
            //code for logo upload...
            if ($file = $this->request->data['MedicalFacility']['logo']) {
                $name = $file['name'];
                $ext = strtolower(substr(strrchr($name, '.'), 1));
                $ext_allowed = array('jpg', 'jpeg', 'png', 'gif');
                if (in_array($ext, $ext_allowed)) {
                    move_uploaded_file($file['tmp_name'], WWW_ROOT.'/img/'.$name);
                    $medicalFacility['MedicalFacility']['logo'] = '/img/'.$name;
                }
            } else {
                $medicalFacility['MedicalFacility']['logo'] = null;
            }

            //debug($medicalFacility);

            //die('End Here');
            
//           debug($this->request->data);
            //$medicalFacility['MedicalFacility']['name'] = $this->request->data['MedicalFacility']['name'];
//            $medicalFacility['MedicalFacility']['logo'] = $this->request->data['MedicalFacility']['logo'];
            $medicalFacility['MedicalFacility']['brand_colour'] = '#' . $this->request->data['MedicalFacility']['brand_colour'];
            //$medicalFacility['MedicalFacility']['website_url'] = $this->request->data['MedicalFacility']['website_url'];
            //$medicalFacility['MedicalFacility']['rc_number'] = $this->request->data['MedicalFacility']['rc_number'];
            //$medicalFacility['MedicalFacility']['created'] = $this->_createNowTimeStamp();
            if($this->MedicalFacility->save($medicalFacility)) {
                
                $lastId = $this->MedicalFacility->getLastInsertID();
                $branch['Branch']['tagname'] = $this->request->data['MedicalFacility']['tagname'];
                $branch['Branch']['address'] = $this->request->data['MedicalFacility']['address'];
                $branch['Branch']['city'] = $this->request->data['MedicalFacility']['city'];
                $branch['Branch']['state_id'] = $this->request->data['MedicalFacility']['state_id'];
                $branch['Branch']['primary_phone'] = $this->request->data['MedicalFacility']['primary_phone'];
                $branch['Branch']['secondary_phone'] = $this->request->data['MedicalFacility']['secondary_phone'];
                $branch['Branch']['email'] = $this->request->data['MedicalFacility']['email'];
                $branch['Branch']['geolocation'] = $this->request->data['MedicalFacility']['geolocation'];
                $branch['Branch']['medical_facility_id'] = $lastId;
                $branch['Branch']['created'] = $this->_createNowTimeStamp();
                
                if($this->Branch->save($branch)) {
                    $this->Session->setFlash($medicalFacility['MedicalFacility']['name'] . ' has been created', 'page_notification_info');
                    $this->redirect(array('controller' => 'facilities', 'action' => 'index'));
                } else {
                    $this->MedicalFacility->delete($lastId);
                    $this->Session->setFlash($medicalFacility['MedicalFacility']['name'] . ' cannot be crated. Please, try again', 'page_notification_error');
                }
            } else {
                $this->Session->setFlash($medicalFacility['MedicalFacility']['name'] . ' cannot be created. Please, make sure you fill the branch information correctly', 'page_notification_error');
            }
        }        
    }
    
    public function delete($id) {
        if (!$id) {

            $this->Session->setFlash('Invalid Facility selected', 'page_notification_error');
            $this->redirect(array('controller' => 'facilities', 'action' => 'index'));
        }

        $this->MedicalFacility->id = $id;

        if($this->MedicalFacility->exists()) {
            if($this->Branch->updateAll(
                array('Branch.deleted' => "'{$this->_createNowTimeStamp()}'", 'MedicalFacility.deleted' => "'{$this->_createNowTimeStamp()}'"),
                array('Branch.medical_facility_id' => $id))) {
                
//                        $this->MedicalFacility->saveField('deleted', "{$this->_createNowTimeStamp()}");
                        $this->Session->setFlash('Medical facility has been deleted', 'page_notification_info');
                        $this->redirect(array('controller' => 'facilities', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to delete facility. Please, try again', 'page_notification_error');
            }
        }
    }
    
    public function edit($id = null) {
        
//        $this->set('module_action', 'facility_create');
        
        $this->MedicalFacility->id = $id;
        
        if (empty($this->request->data)) {
            $this->request->data = $this->MedicalFacility->read();
            $this->request->data['MedicalFacility']['brand_colour'] = str_replace('#', '', $this->request->data['MedicalFacility']['brand_colour']);
        } else {
            if (($this->request->is('post') || $this->request->is('put')) && $this->MedicalFacility->exists()) {
                $medicalFacility['MedicalFacility']['name'] = $this->request->data['MedicalFacility']['name'];
//                $medicalFacility['MedicalFacility']['logo'] = $this->request->data['MedicalFacility']['logo'];
                $medicalFacility['MedicalFacility']['brand_colour'] = '#' . $this->request->data['MedicalFacility']['brand_colour'];
                $medicalFacility['MedicalFacility']['website_url'] = $this->request->data['MedicalFacility']['website_url'];
                $medicalFacility['MedicalFacility']['rc_number'] = $this->request->data['MedicalFacility']['rc_number'];
                $medicalFacility['MedicalFacility']['updated'] = $this->_createNowTimeStamp();
                if($this->MedicalFacility->save($medicalFacility)) {
                    $this->Session->setFlash($medicalFacility['MedicalFacility']['name'] . ' has been updated', 'page_notification_info');
                    $this->redirect(array('controller' => 'facilities', 'action' => 'index'));
                } else {
                    $this->Session->setFlash($medicalFacility['MedicalFacility']['name'] . ' cannot be created. Please make sure you fill all fields correctly.', 'page_notification_error');
                }
            }
        }
    }
}
