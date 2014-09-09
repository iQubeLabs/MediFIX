<div class="main">
  <div class="main-inner">
    <div class="container">
                        
        <?php echo $this->Form->Create('InventoryAttribute',
            array(
                'controller' => 'inventoryattributes', 
                'action' => 'edit', 'class' => 'form-horizontal')) ;?>
        
      <div class="row">
	      	
        <div class="span12">

            
            <div class="widget">

                <div class="widget-header">
                    <i class="icon-group"></i>
                    <h3>Inventory Management</h3>
                </div> <!-- /widget-header -->

            <div class="widget-content">
                
                <h2>Edit Product Attribute</h2>
                <hr />
                
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Session->flash('auth'); ?>

                <div class="span11">
                    <fieldset>
                        
                        <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
                        
                        <div class="control-group">											
                            <label class="control-label" for="name">Name</label>
                            <div class="controls">
                                <?php echo $this->Form->input('name', array('type' => 'text', 'id' => 'name', 'class' => 'span3', 'label' => false));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="description">Description</label>
                            <div class="controls">
                                <?php echo $this->Form->input('description', array('type' => 'text', 'id' => 'description', 'class' => 'span3', 'label' => false));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="inventory_item">Product Item</label>
                            <div class="controls">
                                <?php echo $this->Form->select('inventory_item_id', $inventory_item_list, array('class' => 'span3', 'id' => 'inventory_item'));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="data_type">Data Type</label>
                            <div class="controls">
                                <?php echo $this->Form->select('data_type_id', $data_type_list, array('class' => 'span3', 'id' => 'data_type'));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="unit">Unit</label>
                            <div class="controls">
                                <?php echo $this->Form->input('unit', array('type' => 'text', 'id' => 'unit', 'class' => 'span3', 'label' => false));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                    
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button> 
                            <a class="btn btn-danger btn-primary" href = '/medifix/inventories/attributes/'>Cancel</a>
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