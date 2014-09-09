<script type="text/javascript">
	var options = <?php echo json_encode($data_type_list); ?>
</script>

<div class="main">
  <div class="main-inner">
    <div class="container">
                        
        <?php echo $this->Form->Create('InventoryItem',
            array(
                'controller' => 'inventoryitems', 
                'action' => 'add', 'class' => 'form-horizontal')) ;?>
        
      <div class="row">
	      	
        <div class="span12">

            
            <div class="widget">

                <div class="widget-header">
                    <i class="icon-group"></i>
                    <h3>Inventory Management</h3>
                </div> <!-- /widget-header -->

            <div class="widget-content">
                
                <h2>Create New Product Type</h2>
                <hr />
                <a class="btn btn-primary btn-mini pull-left" id="insert_attr_btn_2"><i class="icon icon-plus"></i>Add Product Attributes</a>
                <br />
                <br />
                
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Session->flash('auth'); ?>

                <div class="span11">
                    <fieldset>
                        <div class="control-group">											
                            <label class="control-label" for="name">Name</label>
                            <div class="controls">
                                <?php echo $this->Form->input('name', array('type' => 'text', 'id' => 'name', 'class' => 'span3', 'label' => false));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="display_name">Display Name</label>
                            <div class="controls">
                                <?php echo $this->Form->input('display_name', array('type' => 'text', 'id' => 'display_name', 'class' => 'span3', 'label' => false));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="description">Description</label>
                            <div class="controls">
                                <?php echo $this->Form->input('description', array('type' => 'text', 'id' => 'description', 'class' => 'span3', 'label' => false));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="item_colour">Product Colour</label>
                            <div class="controls">
                                <?php echo $this->Form->input('item_colour', array('type' => 'text', 'id' => 'picker', 'class' => 'span1', 'label' => false));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div id = 'attr_hide' style='display:none' class='control-group'>
                          <label class="control-label" for="inventory_attributes">Product Attributes</label>
                          <div class="controls">
                            <table id="inv_attr_data" class="table table-striped table-bordered display">
                              <thead>
                                <tr>
                                  <th> Attribute Name </th>
                                  <th> Description </th>
                                  <th> Data Type </th>
                                  <th> Unit </th>
                                  <th class="td-actions" width="10%"> </th>
                                </tr>
                              </thead>
                              <tbody id = 'attr_add'>
                              </tbody>
                          	</table>
                          </div>
                        </div> <!-- /control-group -->

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button> 
                            <a class="btn btn-danger btn-primary" href = '/medifix/inventories/items/'>Cancel</a>
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