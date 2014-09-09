<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP InventoriesController
 * @author RotelandO
 */
class InventoriesController extends AppController {

    public $name = 'Inventories';
    public $uses = array('Inventory', 'InventoryItem', 'InventoryAttribute', 'InventoryValue', 'Record');
    
    public function beforeFilter() {
        parent::beforeFilter();
        
        $this->_setViewVariables('Inventories', 'inventory');
    }
    
    public function index() {
        /*$items = $this->Inventory->InventoryItem->find('list');
        //debug($items);
        $inventories = $this->Inventory->getAllInventories();
        //debug($inventories);
        $items = array();
        foreach ($inventories as $inventory) {
            if (!(in_array($inventory['InventoryItem']['name'], $items))) {
                array_push($items, $inventory['InventoryItem']['name']);
            }
        }
        //debug($items);

        $this->set(array(
            'inventories' => $inventories,
            'items' => $items
        ));*/

        /*$inventories = $this->Inventory->getInventoryAttributes();
        debug($inventories);

        */

        /*$inventories = $this->Inventory->query(
            "SELECT `inventory_items`.`name`, `inventory_items`.`id`,
            SUM(`inventories`.`item_count`) as `Quantity`
            FROM `inventories`
            LEFT JOIN `inventory_items`
            ON `inventories`.`inventory_item_id`=`inventory_items`.`id`
            GROUP BY `inventory_items`.`name`;"
        );*/
        $current_user = $this->Auth->user();

        $branch = $current_user['Branch']['id'];

        $inventories = $this->Inventory->query(
            "SELECT inventories.id, inventory_items.name, inventory_items.id, sum(item_count) as Quantity, branches.id
            FROM inventories, accounts, branches, inventory_items
            WHERE branches.id = $branch and accounts.branch_id = $branch and inventories.account_id = accounts.id and inventories.inventory_item_id = inventory_items.id and inventories.deleted is NULL
            GROUP BY inventory_items.id;"
        );

        $this->set(compact('inventories'));
        //debug($inventories);

        /*if ($this->request->is('post')) {
            $this->Inventory->create();
            $inventory = $this->request->data;
            foreach ($inventories as $item) {
                if ($item['inventory_items']['id'] == $inventory['Inventory']['inventory_item_id']) {
                    $quantity = $item['0']['Quantity'];
                }
            }
            //debug($inventory);
            if ($inventory['Inventory']['item_count'] > 0 && $inventory['Inventory']['item_count'] <= $quantity) {

                $inventory['Inventory']['direction'] = 0;
                $inventory['Inventory']['account_id'] = $this->_getCurrentUserId();
                if (is_numeric($inventory['Inventory']['item_count'])) {
                    $inventory['Inventory']['item_count'] = -$inventory['Inventory']['item_count'];

                    if ($this->Inventory->save($inventory)) {
                        $this->Session->setFlash('Checkout Successful', 'page_notification_info');
                        $this->redirect(array('controller' => 'inventories', 'action' => 'flow'));
                    } else {
                        $this->Session->setFlash('Checkout Unsuccesful', 'page_notification_error');
                    }
                } else {
                    $inventory['Inventory']['item_count'] = 2;
                    $this->Session->setFlash('Enter an integer value', 'page_notification_error');
                }
            } else {
                $this->Session->setFlash('Checkout Unsuccesful. Please enter a whole number. Make sure the number is greater than zero and less than the total amount of item left in the inventory.', 'page_notification_error');
            }*/
            
            /*$inventory['Inventory']['manufactured_date'] = null;
            $inventory['Inventory']['expiry_date'] = null;*/
            
        //}

    }

    public function change($id = null) {

        $this->set(array(
            'module_action' => 'inventory',
            'inventory_item_list' => $this->InventoryItem->getInventoryItemList(),
            'inventory_attribute_list' => $this->InventoryAttribute->getInventoryAttributeList('list')
        ));

        //debug($this->InventoryItem->getInventoryItemList());

        $Inventory = $this->Inventory->getInventoryById($id);
        
        $InventoryValues = $this->InventoryValue->getAllAttributesValue($id);
        //debug($Inventory);
        //debug($InventoryValues);
        $this->set(array('inventory' => $Inventory, 'inventory_values' => $InventoryValues));

        if ($this->request->is('Post') || $this->request->is('Put')) {

            $checkin = $this->request->data;
            //debug($checkin);
            
            //die('Ends Here');
            $inventory['Inventory']['id'] = $this->request->data['Inventory']['id'];
            $inventory['Inventory']['unique_id'] = $this->request->data['Inventory']['unique_id'];
            $inventory['Inventory']['inventory_item_id'] = $this->request->data['Inventory']['inventory_item_id'];
            $inventory['Inventory']['manufactured_date'] = $this->request->data['Inventory']['manufactured_date'];
            $inventory['Inventory']['expiry_date'] = $this->request->data['Inventory']['expiry_date'];
            $inventory['Inventory']['item_count'] = $this->request->data['Inventory']['item_count'];
            $inventory['Inventory']['notes'] = $this->request->data['Inventory']['notes'];
            $inventory['Inventory']['account_id'] = $this->_getCurrentUserId();
            
            //debug($inventory);
            //die('End Here');

            if ($this->Inventory->save($inventory)) {

                $this->InventoryValue->deleteAll(array('InventoryValue.inventory_id' => $id));

                //$lastInsertedId = $this->Inventory->getLastInsertID();

                //$this->loadModel('Record');

/*                $record = array();

                $record['Record']['inventory_id'] = $id;
                $record['Record']['direction'] = 1;
                $record['Record']['item_count'] = $checkin['Inventory']['item_count'];
                $record['Record']['account_id'] = $this->_getCurrentUserId();
                $this->Record->save($record);*/

                $this->Record->updateAll(
                    array(
                        'Record.direction' => 1,
                        'Record.item_count' => $checkin['Inventory']['item_count'],
                        'Record.account_id' => $this->_getCurrentUserId()
                    ),
                    array(
                        'Record.inventory_id' => $id
                    )
                );
                
                $inventoryValue = array();

                if (!empty($this->request->data['Inventory']['inventory_attribute_id'])) {
                    $itemAttributes = $this->request->data['Inventory']['inventory_attribute_id'];
                    $itemValue = $this->request->data['Inventory']['inventory_value_id'];
                    debug($itemAttributes);
                    debug($itemValue);
                    for ($i = 0; $i < count($itemValue); $i++) {
                        $tempAttr['InventoryValue']['inventory_id'] = $id;
                        $tempAttr['InventoryValue']['inventory_attribute_id'] = $itemAttributes[$i];                
                        $tempAttr['InventoryValue']['inventory_item_id'] = $this->request->data['Inventory']['inventory_item_id'];
                        $tempAttr['InventoryValue']['value'] = $itemValue[$i];
                        $inventoryValue[] = $tempAttr;
                    }
                }

                debug($inventoryValue);
                //die('End Here');

                //if($this->InventoryValue->saveAll($inventoryValue)) {
                    //$this->Session->setFlash('Inventory' . ' has been added', 'page_notification_info');
                    //$this->redirect(array('controller' => 'inventories', 'action' => 'index'));
                //}

                if (!empty($this->request->data['Inventory']['new_attribute'])) {
                    $newAttribute = $this->request->data['Inventory']['new_attribute'];
                    $newValue = $this->request->data['Inventory']['new_value'];

                    for ($i = 0; $i < count($newAttribute); $i++) {
                        $this->InventoryAttribute->create();
                        $attribute['InventoryAttribute']['name'] = $newAttribute[$i];
                        $attribute['InventoryAttribute']['default_attribute'] = 0;
                        $attribute['InventoryAttribute']['inventory_item_id'] = $this->request->data['Inventory']['inventory_item_id'];
                        if ($this->InventoryAttribute->save($attribute)) {
                            $lastInsertedAttributeId = $this->InventoryAttribute->getLastInsertID();
                            $value['InventoryValue']['inventory_attribute_id'] = $lastInsertedAttributeId;
                            $value['InventoryValue']['value'] = $newValue[$i];
                            $value['InventoryValue']['inventory_id'] = $id;
                            $value['InventoryValue']['inventory_item_id'] = $this->request->data['Inventory']['inventory_item_id'];
                            $inventoryValue[] = $value;
                        } else {
                            $this->Session->setFlash('Inventory cannot be added. Please try again.', 'page_notification_error');
                        }
                    }
                }

                //debug($inventoryValue);
                //debug($attribute);
                //die('End Here');

                if($this->InventoryValue->saveAll($inventoryValue)) {
                    $this->Session->setFlash('Inventory' . ' has been added', 'page_notification_info');
                    $this->redirect(array('controller' => 'records', 'action' => 'index'));
                }

            } else {
                $this->Session->setFlash('Inventory' . ' cannot be added. Please, try again', 'page_notification_error');
            }
        }

        //$this->Inventory->id = $id;

        /*$inventory = $this->Inventory->query(
            "SELECT i.id, i.account_id, i.inventory_item_id, a.branch_id, i.direction, i.item_count, it.name, ia.name, ia.unit, iv.value
            FROM inventories i, inventory_items it, inventory_attributes ia, inventory_values iv, accounts a
            WHERE i.id = $id and ia.id = iv.inventory_attribute_id and it.id = ia.inventory_item_id and i.account_id = a.id and i.deleted is NULL and i.item_count > 0
            ORDER BY i.id, ia.name asc;"
            );*/
    }

    public function search() {

        if ($this->request->is('post')) {
            //$this->render('result');
            $search_options = $this->request->data;

            /*$result = $this->Inventory->find('all', array(
                    'conditions' => array('Inventory.inventory_item_id' => $search_option['Inventory']['value'][0])
                )
            );*/

            

            $this->set(array(
                'search_options' => $search_options,
                'result' => $result
            ));
        }
    }

    public function checkout($id) {

        /* The attributes for the inventory item */
        $this->loadModel('InventoryAttribute');
        
        $options = array(
            'conditions' => array(
                'InventoryAttribute.inventory_item_id' => $id
            ),
            'order' => 'InventoryAttribute.name ASC'
        );
        
        $attributes = $this->InventoryAttribute->find('all', $options);
        //debug($attributes);
        //$i = 0;
        $attribute_types = array();
        foreach ($attributes as $attribute) {
            $attribute_types[] = $attribute['InventoryAttribute']['name'];
            //$i++;
        }
        //debug($attribute_types);
        $this->set(compact('attribute_types'));

        /* All inventories of the inventory item type */

        $inventories = $this->Inventory->query(
            "SELECT i.id, i.account_id, i.inventory_item_id, a.branch_id, i.direction, i.item_count, it.name, ia.name, ia.unit, iv.value
            FROM inventories i, inventory_items it, inventory_attributes ia, inventory_values iv, accounts a
            WHERE i.id = iv.inventory_id and ia.id = iv.inventory_attribute_id and it.id = ia.inventory_item_id and i.account_id = a.id and i.inventory_item_id = $id and i.deleted is NULL and i.item_count > 0
            ORDER BY i.id, ia.name asc;"
            );

        //debug($inventories);

        $this->set(compact('attributes', 'inventories'));

        /* Extracting data from query result */

        $inventoryId = $inventories[0]['i']['id'];
        $array = array();
        foreach ($inventories as $item) {
            if ($item['i']['id'] == $inventoryId) {
                $product[0]['id'] = $inventoryId;
                $array['attr']['InventoryAttribute']['name'] = $item['ia']['name'];
                $array['attr']['InventoryAttribute']['unit'] = $item['ia']['unit'];
                $array['attr']['InventoryValue']['value'] = $item['iv']['value'];
                //$products[0] = $array['inv'];
                $product[] = $array['attr'];
            } else {
                $products[] = $product;
                $product = array();
                $product[0]['id'] = $item['i']['id'];
                $product[0]['item_count'] = $item['i']['item_count'];
                $product[0]['branch_id'] = $item['a']['branch_id'];
                $inventoryId = $item['i']['id'];
                $array['attr']['InventoryAttribute']['name'] = $item['ia']['name'];
                $array['attr']['InventoryAttribute']['unit'] = $item['ia']['unit'];
                $array['attr']['InventoryValue']['value'] = $item['iv']['value'];
                //$products[0] = $array['inv'];
                $product[] = $array['attr'];
            }
                $product[0]['item_count'] = $item['i']['item_count'];
                $product[0]['branch_id'] = $item['a']['branch_id'];
        }
        $products[] = $product;

        /*foreach ($inventories as $item) {
            if ($item['i']['id'] == $inventoryId) {
                $array[$item['i']['id']][$item['ia']['name']] = $item['iv']['value'];
            } else {
                $array[$item['i']['id']]['item_count'] = $item['i']['item_count'];
                $array[$item['i']['id']]['branch_id'] = $item['a']['branch_id'];
                $array[$item['i']['id']]['inventory_id'] = $inventoryId;
                $inventoryId = $item['i']['id'];
                $array[$item['i']['id']][$item['ia']['name']] = $item['iv']['value'];
            }
                $array[$item['i']['id']]['item_count'] = $item['i']['item_count'];
                $array[$item['i']['id']]['branch_id'] = $item['a']['branch_id'];
                $array[$item['i']['id']]['inventory_id'] = $inventoryId;
        }*/

        //debug($array);
        debug($products);
        //die('End Here');
        $this->set(compact('products'));
    



        /*$this->loadModel('InventoryAttribute');
        
        $options = array(
            'conditions' => array(
                'InventoryAttribute.inventory_item_id' => $id
            ),
            'order' => 'InventoryAttribute.name ASC'
        );
        
        $attributes = $this->InventoryAttribute->find('all', $options);
        debug($attributes);
        $i = 0;
        $attribute_types = array();
        foreach ($attributes as $attribute) {
            $attribute_types[$i] = $attribute['InventoryAttribute']['name'];
            $i++;
        }
        debug($attribute_types);
        $this->set(compact('attribute_types'));

        $inventories = $this->Inventory->query(
            "SELECT i.id, i.inventory_item_id, i.direction, i.item_count, it.name, ia.name, iv.value
            FROM inventories i, inventory_items it, inventory_attributes ia, inventory_values iv
            WHERE i.id = iv.inventory_id and ia.id = iv.inventory_attribute_id and it.id = ia.inventory_item_id and i.inventory_item_id = $id
            ORDER BY i.id, ia.name asc;"
            );

        debug($inventories);

        $this->set(compact('attributes', 'inventories'));

        $inventoryId = $inventories[0]['i']['id'];
        $array = array();
        foreach ($inventories as $item) {
            if ($item['i']['id'] == $inventoryId) {
                $array[$item['i']['id']][$item['ia']['name']] = $item['iv']['value'];
            } else {
                $array[$item['i']['id']]['item_count'] = $item['i']['item_count'];
                $array[$item['i']['id']]['inventory_id'] = $inventoryId;
                $inventoryId = $item['i']['id'];
                $array[$item['i']['id']][$item['ia']['name']] = $item['iv']['value'];
            }
                $array[$item['i']['id']]['item_count'] = $item['i']['item_count'];
                $array[$item['i']['id']]['inventory_id'] = $inventoryId;
        }
        debug($array);
        $this->set(compact('array'));*/
    }
    
    public function add() {

        $this->set(array(
            'module_action' => 'inventory',
            'inventory_item_list' => $this->InventoryItem->getInventoryItemList(),
            'inventory_attribute_list' => $this->InventoryAttribute->getInventoryAttributeList('list')
        ));
        $this->InventoryItem->getInventoryItemList();
        $attributes = $this->InventoryAttribute->find('list', array(
                    'fields' => array('InventoryAttribute.id', 'InventoryAttribute.name', 'InventoryAttribute.inventory_item_id')
                ));
        $this->set('attributes', $attributes);
        
        //debug($this->request->data);


        if ($this->request->is('Post') || $this->request->is('Put')) {

            debug($checkin = $this->request->data);
            
            //die('Ends Here');

            $inventory['Inventory']['unique_id'] = $this->request->data['Inventory']['unique_id'];
            $inventory['Inventory']['inventory_item_id'] = $this->request->data['Inventory']['inventory_item_id'];
            $inventory['Inventory']['manufactured_date'] = $this->request->data['Inventory']['manufactured_date'];
            $inventory['Inventory']['expiry_date'] = $this->request->data['Inventory']['expiry_date'];
            $inventory['Inventory']['item_count'] = $this->request->data['Inventory']['item_count'];
            $inventory['Inventory']['notes'] = $this->request->data['Inventory']['notes'];
            $inventory['Inventory']['account_id'] = $this->_getCurrentUserId();
            
            debug($inventory);
            //die('End Here');

            if ($this->Inventory->save($inventory)) {

                $lastInsertedId = $this->Inventory->getLastInsertID();

                //$this->loadModel('Record');

                $record = array();

                $record['Record']['inventory_id'] = $lastInsertedId;
                $record['Record']['direction'] = 1;
                $record['Record']['item_count'] = $checkin['Inventory']['item_count'];
                $record['Record']['account_id'] = $this->_getCurrentUserId();
                $this->Record->save($record);
                
                $inventoryValue = array();

                if (!empty($this->request->data['Inventory']['inventory_attribute_id'])) {
                    $itemAttributes = $this->request->data['Inventory']['inventory_attribute_id'];
                    $itemValue = $this->request->data['Inventory']['inventory_value_id'];
                    debug($itemAttributes);
                    debug($itemValue);
                    for ($i = 0; $i < count($itemValue); $i++) {
                        $tempAttr['InventoryValue']['inventory_id'] = $lastInsertedId;
                        $tempAttr['InventoryValue']['inventory_attribute_id'] = $itemAttributes[$i];
                        $tempAttr['InventoryValue']['inventory_item_id'] = $this->request->data['Inventory']['inventory_item_id'];
                        $tempAttr['InventoryValue']['value'] = $itemValue[$i];
                        $inventoryValue[] = $tempAttr;
                    }
                }

                //debug($inventoryValue);
                //die('End Here');

                //if($this->InventoryValue->saveAll($inventoryValue)) {
                    //$this->Session->setFlash('Inventory' . ' has been added', 'page_notification_info');
                    //$this->redirect(array('controller' => 'inventories', 'action' => 'index'));
                //}


                if (!empty($this->request->data['Inventory']['new_attribute'])) {
                    $newAttribute = $this->request->data['Inventory']['new_attribute'];
                    $newValue = $this->request->data['Inventory']['new_value'];
                    for ($i = 0; $i < count($newAttribute); $i++) {
                        $this->InventoryAttribute->create();
                        $attribute['InventoryAttribute']['name'] = $newAttribute[$i];
                        $attribute['InventoryAttribute']['default_attribute'] = 0;
                        $attribute['InventoryAttribute']['inventory_item_id'] = $this->request->data['Inventory']['inventory_item_id'];
                        if ($this->InventoryAttribute->save($attribute)) {
                            $lastInsertedAttributeId = $this->InventoryAttribute->getLastInsertID();
                            $value['InventoryValue']['inventory_attribute_id'] = $lastInsertedAttributeId;
                            $value['InventoryValue']['inventory_item_id'] = $this->request->data['Inventory']['inventory_item_id'];
                            $value['InventoryValue']['value'] = $newValue[$i];
                            $value['InventoryValue']['inventory_id'] = $lastInsertedId;
                            $inventoryValue[] = $value;
                        } else {
                            $this->Session->setFlash('Inventory cannot be added. Please try again.', 'page_notification_error');
                        }
                    }
                }

                debug($inventoryValue);
                //debug($attribute);
                //die('End Here');

                if($this->InventoryValue->saveAll($inventoryValue)) {
                    $this->Session->setFlash('Inventory' . ' has been added', 'page_notification_info');
                    $this->redirect(array('controller' => 'records', 'action' => 'index'));
                }

            } else {
                $this->Session->setFlash('Inventory' . ' cannot be added. Please, try again', 'page_notification_error');
            }
        }
    }

    public function edit($id) {
        
        if (!$this->Inventory->exists($id)) {
            throw new NotFoundException(__('Invalid Inventory'));
        }
        
        $Inventory = $this->Inventory->getInventoryById($id);
        $InventoryValues = $this->InventoryValue->getAllAttributesValue($id);
            //debug($Inventory);
            //debug($InventoryValues);
        $this->set(array('inventory' => $Inventory, 'inventory_values' => $InventoryValues));

        $inventory = $this->Inventory->find('first', array(
                            'conditions' => array(
                                'Inventory.id' => $id
                            )
                        )
                    );
        //debug($inventory);

        if ($this->request->is(array('post', 'put'))) {

            $checkout = $this->request->data;

            $this->loadModel('Record');

            $record = array();

            $record['Record']['inventory_id'] = $id;
            $record['Record']['direction'] = 0;
            $record['Record']['item_count'] = $checkout['Inventory']['item_count'];
            $record['Record']['account_id'] = $this->_getCurrentUserId();

            //debug($checkout);
            if ($checkout['Inventory']['item_count'] > 0 && $checkout['Inventory']['item_count'] <= $inventory['Inventory']['item_count']) {
                $checkout['Inventory']['item_count'] = $inventory['Inventory']['item_count'] - $checkout['Inventory']['item_count'];

                if ($this->Inventory->save($checkout)) {
                    $this->Record->save($record);
                    $this->Session->setFlash(__('Update successful.'));
                    return $this->redirect(array('controller' => 'inventories', 'action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                }
            } else {
                $this->Session->setFlash('Checkout Unsuccesful. Please enter a whole number. Make sure the number is greater than zero and not more than the total amount of item left in the inventory.', 'page_notification_error');
            }

            //debug($checkout);


        } else {
            $options = array('conditions' => array('Inventory.' . $this->Inventory->primaryKey => $id));
            $inventory = $this->Inventory->find('first', $options);
            $this->request->data = $inventory;
            //$this->set('title_for_layout', 'Edit Profile: '.$user['User']['first_name'].' '.$user['User']['last_name']);

        }
    }

    public function view($id) {

        $this->Inventory->id = $id;

        if (!$this->Inventory->exists() || !$id) {
            $this->Session->setFlash('Invalid inventory', 'page_notification_error');
            $this->redirect(array('controller' => 'inventories', 'action' => 'flow'));
        }

        $Inventory = $this->Inventory->getInventoryById($id);
        $InventoryValues = $this->InventoryValue->getAllAttributesValue($id);
         debug($Inventory);
         debug($InventoryValues);
        $this->set(array('inventory' => $Inventory, 'inventory_values' => $InventoryValues));

    }

    public function delete($id) {
        if (!$id) {
            $this->Session->setFlash('Invalid Inventory Item selected', 'page_notification_error');
            $this->redirect(array('controller' => 'inventories', 'action' => 'items'));
        }

        $this->Inventory->id = $id;

        if($this->Inventory->exists()) {
            if ($this->Inventory->saveField('deleted', "{$this->_createNowTimeStamp()}")) {
                $this->Session->setFlash('Inventory has been deleted', 'page_notification_info');
                $this->redirect(array('controller' => 'inventories', 'action' => 'flow'));
            } else {
                $this->Session->setFlash('Unable to delete inventory. Please, try again', 'page_notification_error');
            }
        }
    }

    function _setPostDataInventory($post) {

    }

    public function flow() {
        $inventories = $this->Inventory->getAllInventories(0);
        debug($inventories);
        $this->set(array(
            'inventories' => $inventories
        ));
    }

    public function manage() {
        $inventories = $this->Inventory->getAllInventories();
        $this->set(array(
            'inventories' => $inventories
        ));
    }

    public function incoming() {
        $inventories = $this->Inventory->getAllInventories();
        $this->set(array(
            'inventories' => $inventories
        ));
    }

    public function list_attributes() {
        $attributes = $this->InventoryAttribute->find('list', array(
                    'conditions' => array('InventoryAttribute.default_attribute' => 1),
                    'fields' => array('InventoryAttribute.id', 'InventoryAttribute.name', 'InventoryAttribute.inventory_item_id'
                        )
                ));
//        $this->InventoryAttribute->find('list');
        foreach ($attributes as $key => $value) {
            $kvAttributes[] = array('id' => $key, 'value' => $value);
        }
        //debug($attributes);
        //debug($kvAttributes);
        $response = json_encode($attributes);

//        $response = json_encode($kvAttributes);
        $this->layout = 'ajax';
        $this->view = 'ajax_response';
        $this->set('response', $response);
    }
}