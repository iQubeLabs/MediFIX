<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP DashboardController
 * @author RotelandO
 */
class DashboardController extends AppController {

    public $name = 'Dashboard';
    
    public function beforeFilter() {
        parent::beforeFilter();
        
        $this->_setViewVariables('Dashboard', 'dashboard');
    }
    
    public function index() {
        
    }

}
