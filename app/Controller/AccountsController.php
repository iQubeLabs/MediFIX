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

    public function index() {
        
    }
    
    public function login() {
        $this->layout = 'auth';
    }

}
