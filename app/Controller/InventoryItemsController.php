<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP InventoryItems
 * @author RotelandO
 */
class InventoryItemsController extends AppController {

    public $name = 'InventoryItems';
    public $uses = array('InventoryItem', 'DataType', 'InventoryAttribute');
    
    public function beforeFilter() {
        parent::beforeFilter();
        
        $this->_setViewVariables('Inventory Items', 'inventory');
    }
    
    public function index() {
        $items = $this->InventoryItem->getAllInventoryItems();
        $this->set(array(
            'items' => $items
        ));
    }
    
    public function add($id = null) {
        $this->set('module_action', 'inventory');
        $this->set('data_type_list', $this->DataType->getDataTypeList());

        if ($this->request->is('post')) {
            $this->InventoryItem->create();
            $colour = $this->request->data['InventoryItem']['item_colour'];
            $item['InventoryItem']['item_colour'] = (strpos($colour, "#") === 0) ? $colour : "#".$colour;
            $item['InventoryItem']['name'] = $this->request->data['InventoryItem']['name'];
            $item['InventoryItem']['display_name'] = $this->request->data['InventoryItem']['display_name'];
            $item['InventoryItem']['description'] = $this->request->data['InventoryItem']['description'];

            //$item = $this->request->data;
            debug($item);
            //die('End here.');
            if ($this->InventoryItem->save($item)) {
                $lastInsertedId = $this->InventoryItem->getLastInsertID();

                $itemAttributeNames = $this->request->data['InventoryAttribute']['name'];
                $itemAttributeDescriptions = $this->request->data['InventoryAttribute']['description'];
                $itemAttributeDataTypes = $this->request->data['InventoryAttribute']['data_type_id'];
                $itemAttributeUnits = $this->request->data['InventoryAttribute']['unit'];

                for ($i=0; $i < count($itemAttributeNames); $i++) { 
                    $attr['InventoryAttribute']['name'] = $itemAttributeNames[$i];
                    $attr['InventoryAttribute']['description'] = $itemAttributeDescriptions[$i];
                    $attr['InventoryAttribute']['inventory_item_id'] = $lastInsertedId;
                    $attr['InventoryAttribute']['data_type_id'] = $itemAttributeDataTypes[$i];
                    $attr['InventoryAttribute']['unit'] = $itemAttributeUnits[$i];
                    $itemAttributes[] = $attr;
                }
                if ($this->InventoryAttribute->saveAll($itemAttributes)) {
                    $this->Session->setFlash($item['InventoryItem']['name'] . ' has been added', 'page_notification_info');
                    $this->redirect(array('controller' => 'inventories', 'action' => 'items'));
                } else {
                    $this->Session->setFlash($item['InventoryItem']['name'] . ' cannot be added. Please, try again', 'page_notification_error');
                }
            } else {
                $this->Session->setFlash($item['InventoryItem']['name'] . ' cannot be added. Please, try again', 'page_notification_error');
            }
        }
        
        /*if (empty($this->request->data) && $this->InventoryItem->exists($id)) {
            $this->request->data['InventoryItem']['medical_facility_id'] = $id;
//            $this->set('data', $this->request->data);
        } elseif($this->request->is('post') || $this->request->is('put')) {
                $item['InventoryItem']['name'] = $this->request->data['InventoryItem']['name'];
                $item['InventoryItem']['display_name'] = $this->request->data['InventoryItem']['display_name'];
                $item['InventoryItem']['description'] = $this->request->data['InventoryItem']['description'];
                
                $colour = $this->request->data['InventoryItem']['item_colour'];
                $item['InventoryItem']['item_colour'] = (strpos($colour, "#") === 0) ? $colour : "#".$colour;
                
                if($this->InventoryItem->save($item)) {
                    $this->Session->setFlash($item['InventoryItem']['name'] . ' has been added', 'page_notification_info');
                    $this->redirect(array('controller' => 'inventories', 'action' => 'items'));
                } else {
                    $this->Session->setFlash($item['InventoryItem']['name'] . ' cannot be added. Please, try again', 'page_notification_error');
                }
        }*/
    }
    
    public function edit($id = null) {
        $this->set('module_action', 'inventory');        
        
        $this->InventoryItem->id = $id;
        
        if (empty($this->request->data)) {
            $this->request->data = $this->InventoryItem->read();
//            $this->set('data', $this->request->data);
        } else {
            if (($this->request->is('post') || $this->request->is('put')) && $this->InventoryItem->exists()) {
                $item['InventoryItem']['name'] = $this->request->data['InventoryItem']['name'];
                $item['InventoryItem']['display_name'] = $this->request->data['InventoryItem']['display_name'];
                $item['InventoryItem']['description'] = $this->request->data['InventoryItem']['description'];
                
                $colour = $this->request->data['InventoryItem']['item_colour'];
                $item['InventoryItem']['item_colour'] = (strpos($colour, "#") === 0) ? $colour : "#".$colour;

                if($this->InventoryItem->save($item)) {
                    $this->Session->setFlash($item['InventoryItem']['name'] . ' has been updated', 'page_notification_info');
                    $this->redirect(array('controller' => 'inventories', 'action' => 'items'));
                } else {
                    $this->Session->setFlash($item['InventoryItem']['name'] . ' cannot be updated. Please, try again', 'page_notification_error');
                }
            }
        }
        
    }
    
    public function delete($id) {
        if (!$id) {
            $this->Session->setFlash('Invalid Inventory Item selected', 'page_notification_error');
            $this->redirect(array('controller' => 'inventories', 'action' => 'items'));
        }

        $this->InventoryItem->id = $id;

        if($this->InventoryItem->exists()) {
            if ($this->InventoryItem->saveField('deleted', "{$this->_createNowTimeStamp()}")) {
                $this->Session->setFlash('Inventory item has been deleted', 'page_notification_info');
                $this->redirect(array('controller' => 'inventories', 'action' => 'items'));
            } else {
                $this->Session->setFlash('Unable to delete item. Please, try again', 'page_notification_error');
            }
        }
    }
}
