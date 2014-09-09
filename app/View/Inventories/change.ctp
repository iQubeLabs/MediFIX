<script type="text/javascript">
    //var inv = <?php echo json_encode($attributes); ?>;
</script>

<div class="main">
  <div class="main-inner">
    <div class="container">
                        
        <?php echo $this->Form->Create('Inventory',
            array('class' => 'form-horizontal')) ;?>
        
      <div class="row">
	      	
        <div class="span12">

            
            <div class="widget">

                <div class="widget-header">
                    <i class="icon-group"></i>
                    <h3>Inventory Management</h3>
                </div> <!-- /widget-header -->

            <div class="widget-content">
                
                <h2>Edit Product Item</h2>
                <hr />
                
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Session->flash('auth'); ?>
                <?php //echo json_encode($attributes); ?>

                <div class="span6">
                    <p id = 'select'>Select an item to display its attributes.</p>
                    <fieldset>
                        <?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $inventory['Inventory']['id'])); ?>
                        <div class="control-group">                                         
                            <label class="control-label" for="inventory_item">Product Unique ID</label>
                            <div class="controls">
                                <?php echo $this->Form->input('unique_id', array('type' => 'text', 'class' => 'span2', 'value' => $inventory['Inventory']['unique_id'], 'label' => false));?>
                            </div> <!-- /controls -->               
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="inventory_item">Product Type</label>
                            <div class="controls">
                                <?php echo $this->Form->select('inventory_item_id', $inventory_item_list, array('default' => $inventory['InventoryItem']['id']), array('selected' => $inventory['InventoryItem']['id'], 'class' => 'span3', 'empty' => '(Select Inventory Item)'));?>
                                <p>Product type not found? Click <a href="/medifix/inventories/items/add/" title = 'Add Inventory Item'>here</a> to create a new product type.</p>
                            </div> <!-- /controls -->               
                        </div> <!-- /control-group -->

<!-- Start -->
                        <!-- <div id = 'addit'>
                        </div> -->

                    <div class='control-group span5' id = 'attr'>
                        <p class="pull-left">Product Attributes and Values</p>
                        <a class="btn btn-primary btn-mini pull-left" id="insert_attr_btn" style='margin-left:25%'><i class="icon icon-plus"></i>Add More Attributes</a>                        
                        <div class="clearfix"></div>
                        <br />
                        <table id="inv_attr_data" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th width="55%"> Attribute </th>
                                <th> Attribute Value </th>
                                <th class="td-actions" width="10%"> </th>
                              </tr>
                            </thead>
                            <tbody id = 'attr_body'>
                                <?php foreach ($inventory_values as $value): ?>
                                <tr>
                                    <td><?php echo $value['InventoryAttribute']['name'] ?> <input type="hidden" id="attr_value" name="data[Inventory][inventory_attribute_id][]" value=<?php echo $value['InventoryAttribute']['id'] ?>></td>
                                    <td><input type="text" id="attr_value" value = <?php echo $value['InventoryValue']['value'] ?> name="data[Inventory][inventory_value_id][]" class="span1"></td>
                                    <td><a class="btn btn-primary btn-mini btn-danger" id="remove_attr_btn"><i class="icon icon-minus"></i></a></td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div> <!-- /control-group -->

<!-- END -->
                        <div class="control-group">
                            <label class="control-label" for="mdate">Manufacture Date</label>
                            <div class="controls" id="manufactured_date">
                                <div class="input-append date">
                                    <input type="text" value = <?php echo $inventory['Inventory']['manufactured_date'] ?> id="mdate" name="data[Inventory][manufactured_date]" class="span2"><span class="add-on"><i class="icon-th"></i></span>
                                </div>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">
                            <label class="control-label" for="edate">Expiry Date</label>
                            <div class="controls" id="expiry_date">
                                <div class="input-append date">
                                    <input type="text" value = <?php echo $inventory['Inventory']['expiry_date'] ?> id="edate" name="data[Inventory][expiry_date]" class="span2"><span class="add-on"><i class="icon-th"></i></span>
                                </div>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">
                            <label class="control-label" for="item_count">Item Count</label>
                            <div class="controls">
                                <?php echo $this->Form->input('item_count', array('type' => 'text', 'value' => $inventory['Inventory']['item_count'], 'id' => 'item_count', 'class' => 'span1', 'label' => false));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">
                            <label class="control-label" for="notes">Note</label>
                            <div class="controls">
                                <?php echo $this->Form->textarea('notes', array('value' => $inventory['Inventory']['notes'], 'type' => 'text', 'rows' => '6', 'id' => 'notes', 'class' => 'span3', 'label' => false));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
<!--                        <div class="control-group">											
                            <label class="control-label" for="notes">Note</label>
                            <div class="controls">
                                <?php 
//                                $options = array(
//                                    'Group 1' => array(
//                                       'Value 1' => 'Label 1',
//                                       'Value 2' => 'Label 2'
//                                    ),
//                                    'Group 2' => array(
//                                       'Value 3' => 'Label 3'
//                                    )
//                                 );
//                                 echo $this->Form->select('field', $options);
                                ?>
                            </div>				
                        </div>
                        <div style="height: 50px;"></div>-->
                        
                    </fieldset>
                </div>
                
                <div class="clearfix"></div>
                        
                <div class="span11">
                    <fieldset>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button> 
                            <a class="btn btn-primary btn-danger" href = '/medifix/inventories/'>Cancel</a>
                        </div> <!-- /form-actions -->
                    </fieldset>
                </div>
            </div> <!-- /widget-content -->
            </div> <!-- /widget -->			
        </div> <!-- /spa12 -->
      </div> <!-- /row -->
                           
        <?php echo $this->Form->end() ;?>
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!--
<div id="loc_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">Select Location</h3>
    </div>
    <div class="modal-body">
        <div id="loc_canvas" style="width:500px; height: 320px;"></div>
        <h3>Location</h3>
        <p>Value: </p>
    </div>
    <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
      <button class="btn btn-primary" id="save_location">Use Location</button>
    </div>
</div>-->