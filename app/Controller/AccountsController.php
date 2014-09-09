<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP Accounts
 * @author RotelandO
 */
class AccountsController extends AppController {

    public $name = 'Accounts';
    public $uses = array('Account', 'AccountType', 'MedicalFacility', 'Branch');
    
    public function beforeFilter() {
        parent::beforeFilter();
        
        $this->_setViewVariables('Account Management', 'account');
//        $this->Auth->allow('logout', 'create', 'index', 'delete');
//        $this->Auth->allow('logout');
    }
    
    //Authentication module
    public function login() {
        
        if($this->Auth->loggedIn()) {
            $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
        }
            
        $this->layout = 'auth';

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if ($this->Auth->user('active') == 0) {
                    $this->Session->setFlash('Sorry, your account has been deactivated. Please contact your facility manager.', 'page_notification_error', array('is_error' => true));
                    $this->redirect($this->Auth->logout());
                } else {
                    $this->redirect($this->Auth->redirect());
                }
            } else {
                $this->set(array('is_error' => true));
                $this->Session->setFlash('Your username and/or password in incorrect', 'page_notification_error', array('is_error' => true));
            }
            $this->request->data['Account']['password'] = '';
        }
    }
    
    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function landing() {
        if($this->Auth->loggedIn()) {
            $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
        }
        
        $this->layout = 'auth';
    }
    
    //The index page: /accouts/index
    public function index() {
        $accounts = $this->Account->findAllAccount();
        debug($accounts);
        $this->set('accounts', $accounts);
    }
    
    //Create new account page: /accouts/create
    public function create() {
        
        $this->_setViewVariables('Create new account', 'accounts');
        $this->_getAccountTypeList();
        $this->_getMedicalFacilityList();
        $this->branchlist();

        if ($this->request->is('Post') || $this->request->is('Put')) {
            
            $account = $this->_setPostDataAccount($this->request->data);
            
            if ($this->Account->save($account)) {
                $this->Session->setFlash($account['Account']['username'] . ' has been saved', 'page_notification_info');
                $this->redirect(array('controller' => 'accounts', 'action' => 'index'));
            } else {
                $this->Session->setFlash($account['Account']['username'] . ' cannot be added. Please, try again', 'page_notification_error');
            }
        }
    }
    
    //Edit an account: /accounts/edit/id
    public function edit($id = null) {
        
        $this->_setViewVariables('Create new account', 'accounts');
        $this->_getAccountTypeList();
        $this->_getMedicalFacilityList();
        $this->branchlist();
        
        $this->Account->id = $id;

        
        if (empty($this->request->data)) {
            $this->request->data = $this->Account->read();
            $this->set(array('active' => $this->request->data['Account']['active']));
        } else {
            if (($this->request->is('post') || $this->request->is('put')) && $this->Account->exists()) {

                
                $account = $this->_setPostDataAccount($this->request->data);
                //debug($account);
                //die('End Here!');
                
                if ($this->Account->save($account)) {
                    $this->Session->setFlash($account['Account']['username'] . ' has been updated', 'page_notification_info');
                    $this->redirect(array('controller' => 'accounts', 'action' => 'index'));
                } else {
                    $this->Session->setFlash($account['Account']['username'] . ' already exists. Please, try again', 'page_notification_error');
                }
            }
        }
    }
    
    //Delete an account: /accounts/delete/id
    public function delete($id = null) {
        if (!$id) {

            $this->Session->setFlash('Invalid Account selected', 'page_notification_error');
            $this->redirect(array('controller' => 'accounts', 'action' => 'index'));
        }

        $this->Account->id = $id;
        
        if ($this->Account->delete()) {
            $this->Session->setFlash('Account has been deleted', 'page_notification_info');
            $this->redirect(array('controller' => 'accounts', 'action' => 'index'));
        } else {
            $this->Session->setFlash('Account cannot be deleted. Please, try again', 'page_notification_error');
        }
    }
    
    //Deactivate an account: /accounts/deactivate/id
    public function deactivate($id = null) {
        
        $this->view = 'index';
        
        if (($this->request->is('get') && $this->Account->exists($id))) {
            $account = array();
            $account['Account']['id'] = intval($id);        
            $account['Account']['active'] = 0;        
            $account['Account']['updated'] = $this->_createNowTimeStamp();
            if ($this->Account->save($account, false)) {
                $this->Session->setFlash('User has been deactivated', 'page_notification_info');
                $this->redirect(array('controller' => 'accounts', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Account cannot be deactivated. Please, try again', 'page_notification_error');
            }
        } else {
            $this->Session->setFlash('Account cannot be found. Please, try again', 'page_notification_error');
        }
    }
    
    //Activate an account: /accounts/activate/id
    public function activate($id) {
        
        $this->view = 'index';

        if (($this->request->is('get') && $this->Account->exists($id))) {
            $account = array();
            $account['Account']['id'] = intval($id);        
            $account['Account']['active'] = 1;        
            $account['Account']['updated'] = $this->_createNowTimeStamp();
            if ($this->Account->save($account, false)) {
                $this->Session->setFlash('Account has been activated', 'page_notification_info');
                $this->redirect(array('controller' => 'accounts', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Account cannot be deactivated. Please, try again', 'page_notification_error');
            }
        } else {
            $this->Session->setFlash('Account cannot be found. Please, try again', 'page_notification_error');
        }
    }
    public function changepassword($id = null) {
        
    }
    
    private function _getAccountTypeList() {

        $accTypeList = $this->AccountType->find('list');
        $accTypeListBranch = $this->AccountType->find('list', array(
            'conditions' => array('AccountType.name !=' => 'Super Admin')
            ));
        //debug($accTypeListBranch);
        $this->set(array(
            'account_type_list' => $accTypeList,
            'account_type_list_branch' => $accTypeListBranch
            ));
        
    }
    
    private function _getMedicalFacilityList() {
        
        $medical_facility_list = $this->MedicalFacility->find('list');
        $this->set(array('medical_facility_list' => $medical_facility_list));
    }
    
    public function branchlist($id = null) {
        
        $branches_list = $this->Branch->find('list');
        $this->set(array('branches_list' => $branches_list));
    }

    //set post data to savable account data
    private function _setPostDataAccount($post) {
        $account['Account']['branch_id'] = $post['Account']['branch_id'];
            $account['Account']['username'] = $post['Account']['username'];
            $account['Account']['password'] = $post['Account']['password'];
            $account['Account']['confirm_password'] = $post['Account']['confirm_password'];
            if(isset($post['Account']['active']))
                $account['Account']['active'] = 1;
            else
                $account['Account']['active'] = 0;
            
            $account['Account']['account_type_id'] = $post['Account']['account_type_id'];
            $account['Account']['created'] = $this->_createNowTimeStamp();
            $account['Account']['updated'] = $this->_createNowTimeStamp();
            return $account;
    }
    
    public function _setCurrentViewVariables() {
        
    }
}