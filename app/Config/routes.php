<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'accounts', 'action' => 'landing'));
    
    Router::connect('/facilities', array('controller' => 'medical_facilities', 'action' => 'index'));
    
    Router::connect('/facilities/branches/add', array('controller' => 'branches', 'action' => 'add'));
    Router::connect('/facilities/branches/add/:id', 
                array('controller' => 'branches', 'action' => 'add'),
                array(
                    // order matters since this will simply map ":id" to
                    // $articleId in your action
                    'pass' => array('id'),
                    'id' => '[0-9]+'
                )
            );
    
    Router::connect('/facilities/branches/list', array('controller' => 'branches', 'action' => 'index'));
    
    Router::connect('/facilities/branches/edit/:id', 
                array('controller' => 'branches', 'action' => 'edit'),
                array(
                    // order matters since this will simply map ":id" to
                    // $articleId in your action
                    'pass' => array('id'),
                    'id' => '[0-9]+'
                )
            );

    /*Router::connect('/:controller/:id',
                array('action' => 'edit'),
                array('id' => '[0-9]+')
            );*/
    
    Router::connect('/facilities/branches/delete/:id', 
                array('controller' => 'branches', 'action' => 'delete'),
                array(
                    // order matters since this will simply map ":id" to
                    // $articleId in your action
                    'pass' => array('id'),
                    'id' => '[0-9]+'
                )
            );
    
    Router::connect('/facilities/:action/*', array('controller' => 'medical_facilities'));
    
    //Inventory Items Routing
    Router::connect('/inventories/items', array('controller' => 'inventory_items', 'action' => 'index'));
    Router::connect('/inventories/items/edit/:id', 
                array('controller' => 'inventory_items', 'action' => 'edit'),
                array(
                    // order matters since this will simply map ":id" to
                    // $articleId in your action
                    'pass' => array('id'),
                    'id' => '[0-9]+'
                )
            );
    Router::connect('/inventories/items/delete/:id', 
                array('controller' => 'inventory_items', 'action' => 'delete'),
                array(
                    // order matters since this will simply map ":id" to
                    // $articleId in your action
                    'pass' => array('id'),
                    'id' => '[0-9]+'
                )
            );
    Router::connect('/inventories/items/add/:id', 
                array('controller' => 'inventory_items', 'action' => 'add'),
                array(
                    // order matters since this will simply map ":id" to
                    // $articleId in your action
                    'pass' => array('id'),
                    'id' => '[0-9]+'
                )
            );
    
    Router::connect('/inventories/items/:action/*', array('controller' => 'inventory_items'));
    
    Router::connect('/inventories/attributes', array('controller' => 'inventory_attributes', 'action' => 'index'));
    Router::connect('/inventories/attributes/:action/*', array('controller' => 'inventory_attributes'));
    
    
//    Router::connect('/facilities/branches/', array('controller' => 'medicalfacilities', 'action' => 'branches'));
    
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
//	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
