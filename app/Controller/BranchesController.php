<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP BranchesController
 * @author RotelandO
 */
class BranchesController extends AppController {

    public $name = 'Branches';
    public $uses = array('Branch', 'MedicalFacility', 'State');
    
    public function beforeFilter() {
        parent::beforeFilter();
        
        $this->_setViewVariables('Branches', 'facilities');
    }
    
    public function index() {
        $branches = $this->Branch->getAllBranches();
        $this->set(array(
            'branches' => $branches
        ));
    }
    
    public function add($id = null) {
        
        $this->set('module_action', 'branch_add_edit');
        
        $this->_populateSelectBoxes();
        
        if (empty($this->request->data) && $this->MedicalFacility->exists($id)) {
            $this->request->data['Branch']['medical_facility_id'] = $id;
//            $this->set('data', $this->request->data);
        } elseif($this->request->is('post') || $this->request->is('put')) {
                $branch['Branch']['tagname'] = $this->request->data['Branch']['tagname'];
                $branch['Branch']['address'] = $this->request->data['Branch']['address'];
                $branch['Branch']['city'] = $this->request->data['Branch']['city'];
                $branch['Branch']['state_id'] = $this->request->data['Branch']['state_id'];
                $branch['Branch']['primary_phone'] = $this->request->data['Branch']['primary_phone'];
                $branch['Branch']['secondary_phone'] = $this->request->data['Branch']['secondary_phone'];
                $branch['Branch']['email'] = $this->request->data['Branch']['email'];
                $branch['Branch']['geolocation'] = $this->request->data['Branch']['geolocation'];
                $branch['Branch']['medical_facility_id'] = $this->request->data['Branch']['medical_facility_id'];
                $branch['Branch']['created'] = $this->_createNowTimeStamp();
                if($this->Branch->save($branch)) {
                    $this->Session->setFlash($branch['Branch']['tagname'] . ' has been created', 'page_notification_info');
                    $this->redirect(array('controller' => 'facilities', 'action' => 'branches', 'list'));
                } else {
                    $this->Session->setFlash($branch['Branch']['tagname'] . ' cannot be created. Please, try again', 'page_notification_error');
                }
        }
    }
    
    public function edit($id = null) {
        
        $this->set('module_action', 'branch_add_edit');        
        
        $this->_populateSelectBoxes();
         
        $this->Branch->id = $id;
        
        if (empty($this->request->data)) {
            $this->request->data = $this->Branch->read();
//            $this->set('data', $this->request->data);
        } else {
            if (($this->request->is('post') || $this->request->is('put')) && $this->Branch->exists()) {
                $branch['Branch']['tagname'] = $this->request->data['Branch']['tagname'];
                $branch['Branch']['address'] = $this->request->data['Branch']['address'];
                $branch['Branch']['city'] = $this->request->data['Branch']['city'];
                $branch['Branch']['state_id'] = $this->request->data['Branch']['state_id'];
                $branch['Branch']['primary_phone'] = $this->request->data['Branch']['primary_phone'];
                $branch['Branch']['secondary_phone'] = $this->request->data['Branch']['secondary_phone'];
                $branch['Branch']['email'] = $this->request->data['Branch']['email'];
                $branch['Branch']['geolocation'] = $this->request->data['Branch']['geolocation'];
                $branch['Branch']['medical_facility_id'] = $this->request->data['Branch']['medical_facility_id'];
                $branch['Branch']['updated'] = $this->_createNowTimeStamp();
                if($this->Branch->save($branch)) {
                    $this->Session->setFlash($branch['Branch']['tagname'] . ' has been updated', 'page_notification_info');
                    $this->redirect(array('controller' => 'facilities', 'action' => 'branches', 'list'));
                } else {
                    $this->Session->setFlash($branch['Branch']['tagname'] . ' cannot be updadted. Please, try again', 'page_notification_error');
                }
            }
        }
    }
    
    public function delete($id) {
        
        if (!$id) {

            $this->Session->setFlash('Invalid Branches selected', 'page_notification_error');
            $this->redirect(array('controller' => 'facilities', 'action' => 'branches', 'list'));
        }

        $this->Branch->id = $id;

        if($this->Branch->exists()) {
             if ($this->Branch->saveField('deleted', "{$this->_createNowTimeStamp()}")) {
                
                $this->Session->setFlash('Branch has been deleted', 'page_notification_info');
                $this->redirect(array('controller' => 'facilities', 'action' => 'branches', 'list'));
            } else {
                $this->Session->setFlash('Unable to delete Branch. Please, try again', 'page_notification_error');
            }
        }
    }
    
    private function _populateSelectBoxes() {
        $facility_list = $this->MedicalFacility->find('list');
        $state_list = $this->State->find('list');
        $this->set( array(
                'facility_list' => $facility_list,
                'state_list' => $state_list
            )
        );
    }
}
