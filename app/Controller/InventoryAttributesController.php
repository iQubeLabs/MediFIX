<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP InventoryAttributesController
 * @author RotelandO
 */
class InventoryAttributesController extends AppController {

    public $name = 'InventoryAttributes';
    public $uses = array('InventoryAttribute', 'InventoryItem', 'DataType');
    
    public function beforeFilter() {
        parent::beforeFilter();
        
        $this->_setViewVariables('Inventory Attribute', 'inventory');
    }
    
    public function index() {

        $attributes = $this->InventoryAttribute->getAllAttributes();
        $this->set(array(
            'attributes' => $attributes
        ));
    }

    public function add($id = null) {
        
        $this->set(array(
          'module_action' => 'inventory',
          'data_type_list' => $this->DataType->getDataTypeList(),
          'inventory_item_list' => $this->InventoryItem->getInventoryItemList()
        ));
        
        if (empty($this->request->data) && !$this->InventoryAttribute->exists($id)) {
//            $this->set('data', $this->request->data);
        } elseif($this->request->is('post') || $this->request->is('put')) {
            $attribute['InventoryAttribute']['name'] = $this->request->data['InventoryAttribute']['name'];
            $attribute['InventoryAttribute']['description'] = $this->request->data['InventoryAttribute']['description'];
            $attribute['InventoryAttribute']['inventory_item_id'] = $this->request->data['InventoryAttribute']['inventory_item_id'];                
            $attribute['InventoryAttribute']['data_type_id'] = $this->request->data['InventoryAttribute']['data_type_id'];                
                
            if($this->InventoryAttribute->save($attribute)) {
              $this->Session->setFlash($attribute['InventoryAttribute']['name'] . ' has been added', 'page_notification_info');
              $this->redirect(array('controller' => 'inventories', 'action' => 'attributes'));
            } else {
            	$this->Session->setFlash($attribute['InventoryAttribute']['name'] . ' cannot be added. Please, try again', 'page_notification_error');
            }
        }
        
    }
    
    public function edit($id = null) {
        
        $this->set(array(
            'module_action' => 'inventory',
            'data_type_list' => $this->DataType->getDataTypeList(),
            'inventory_item_list' => $this->InventoryItem->getInventoryItemList()
        ));        
        
        $this->InventoryAttribute->id = $id;
        
        if (empty($this->request->data)) {
            $this->request->data = $this->InventoryAttribute->read();
//            $this->set('data', $this->request->data);
        } else {
            if (($this->request->is('post') || $this->request->is('put')) && $this->InventoryAttribute->exists()) {
                
                $attribute['InventoryAttribute']['name'] = $this->request->data['InventoryAttribute']['name'];
                $attribute['InventoryAttribute']['description'] = $this->request->data['InventoryAttribute']['description'];
                $attribute['InventoryAttribute']['inventory_item_id'] = $this->request->data['InventoryAttribute']['inventory_item_id'];                
                $attribute['InventoryAttribute']['data_type_id'] = $this->request->data['InventoryAttribute']['data_type_id'];                

                if($this->InventoryAttribute->save($attribute)) {
                    $this->Session->setFlash($attribute['InventoryAttribute']['name'] . ' has been updated', 'page_notification_info');
                    $this->redirect(array('controller' => 'inventories', 'action' => 'attributes'));
                } else {
                    $this->Session->setFlash($attribute['InventoryAttribute']['name'] . ' cannot be updated. Please, try again', 'page_notification_error');
                }
            }
        }
    }
    
    public function delete($id) {
        if (!$id) {

            $this->Session->setFlash('Invalid Inventory attribute selected', 'page_notification_error');
            $this->redirect(array('controller' => 'inventories', 'action' => 'attributes'));
        }

        $this->InventoryAttribute->id = $id;

        if($this->InventoryAttribute->exists()) {
            if ($this->InventoryAttribute->saveField('deleted', "{$this->_createNowTimeStamp()}")) {
                
                $this->Session->setFlash('Inventory attribute has been deleted', 'page_notification_info');
                $this->redirect(array('controller' => 'inventories', 'action' => 'attributes'));
            } else {
                $this->Session->setFlash('Unable to delete attribute. Please, try again', 'page_notification_error');
            }
        }
    }
    
}
