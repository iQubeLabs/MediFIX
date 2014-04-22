<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    
    public $uses = array('Account', 'AccountType');
    
    var $components = array(
        'Session',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Account'
//                    'fields' => array(
//                        'username' => 'custom_username_field',
//                        'password' => 'custom_password_field'
//                    )
                )
            ),
            'loginRedirect' => array('controller' => 'dashboard', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'accounts', 'action' => 'login'),
            'authError' => "You can't access that page",
            'authorize' => array('Controller')
        )
    );
    
    public function beforeFilter(){
        
        parent::beforeFilter();
        
        Security::setHash('sha512');
        
        //Set Login action to accounts => login
        $this->Auth->loginAction = array('controller'=>'accounts', 'action'=>'login');
        //set what non-loggedin facility account has access to
        
        
        //Initialize all possible variables needed by all controllers
        $this->_InitializeVariables();
        
    }
    
    public function isAuthorized($user = null) {
        // Any registered user can access public functions
//        if (empty($this->request->params['admin'])) {
//            return true;
//        }
//
//        // Only admins can access admin functions
//        if (isset($this->request->params['admin'])) {
//            return (bool)($user['role'] === 'admin');
//        }

        // Default deny
//        return false;
        return true;
    }
    
    private function _InitializeVariables() {
        
        $this->set( 
            array(
                'logged_in' => $this->Auth->loggedIn(),
                'current_user' => $this->_getCurrentUser()
            )
        );
    }

    protected function _getCurrentUser() {
        return $this->Auth->user();
    }
    
    protected function _getCurrentUserId() {
        return $this->Auth->user('id');
    }
    
    protected function _createNowTimeStamp() {
        return date('Y-m-d H:i:s');
    }
    
    public function _setViewVariables($pagetitle, $selected_menu) {
        $this->set(array(
            'page_title' => $pagetitle,
            'selected_menu' => $selected_menu
        ));
    }
    
}
