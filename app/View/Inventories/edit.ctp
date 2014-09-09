<div class="main">
  <div class="main-inner">
    <div class="container">
        <?php echo $this->Form->create('Inventory', array('class' => 'form-horizontal')); ?>
      <div class="row">
            
        <div class="span12">

            
            <div class="widget">

                <div class="widget-header">
                    <i class="icon-pushpin"></i>
                    <h3>Inventory Management</h3>
                </div> <!-- /widget-header -->

                
            <div class="widget-content">
            
                <?php echo $this->element('inventory_quick_menu');?>
                
                <h2><?php echo $inventory['InventoryItem']['name']; ?>
                    <?php 
                        /*$dir = $inventory['Inventory']['direction'];
                        if($dir == 1) {
                            echo '<span class="label label-info">incoming</span>';
                        } else {
                            echo '<span class="label label-important">outgoing<success/span>';
                        }*/
                    ?> 
                </h2>
                <?php 
                	if ($current_user['AccountType']['name'] != 'Staff') {
               			echo $this->Html->link('<i class="icon icon-plus"></i> Add Product Item', 
                 		array('controller' => 'inventories', 'action' => 'add'), 
                    array('class' => 'btn btn-primary pull-right', 'escape' => false));
             			}
                ?>
                <div class="clearfix"></div>
                <hr />
                
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Session->flash('auth'); ?>
                

                <div class="row">
                    <div class="span6 inv_view">
                        <!-- <p><span class="inv_label">Medical Facility: </span><?php echo $inventory['MedicalFacility']['name']; ?></p>
                        <p><span class="inv_label">Location: </span><?php echo $inventory['Branch']['tagname']; ?></p>
                        <p><span class="inv_label">Added By: </span><?php echo $inventory['Account']['username']; ?></p> -->
                        <p><span class="inv_label">Added on: </span><?php echo $inventory['Inventory']['created']; ?></p>
                        <p><span class="inv_label">Count: </span><?php echo $inventory['Inventory']['item_count']; ?></p>
                        <div class="control-group">
                            <p><span class="inv_label" for="item_count">Check Out Quantity</span>
                            
                            <?php
                                echo $this->Form->input('id');
                                echo $this->Form->input('item_count', array('type' => 'text', 'class' => 'span1', 'label' => false, 'value' => '', 'div' => false));
                                //echo $this->Form->end(array('label' => 'Submit', 'div' => array('style' => 'display: inline')));
                            ?>
                            <button type='submit' title = 'Check Out' class='btn btn-small btn-danger'><i class="btn-icon-only icon-arrow-up"></i></button>
                            </p>
                        <p><span class="inv_label">Manufactured Date: </span><?php echo $inventory['Inventory']['manufactured_date']; ?></p>
                        <p><span class="inv_label">Expiry Date: </span><?php echo $inventory['Inventory']['expiry_date']; ?></p>
                             <!-- /controls -->               
                        </div> <!-- /control-group -->
                        
                    </div>
                    <div class="span3">
                        <h3>Item Attributes</h3>
                        <br />
                        <?php if(isset($inventory_values) && !empty($inventory_values)): ?>
                          <table id="attributes" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th> S/N </th>
                                <th> Attribute </th>
                                <th> Value </th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i = 0;
                                    foreach ($inventory_values as $inventory_value): ?>
                              <tr>
                                <td> <?php echo ++$i; ?> </td>
                                <td> <?php echo $inventory_value['InventoryAttribute']['name'];?> </td>
                                <td> <?php echo $inventory_value['InventoryValue']['value'] . ' ' . $inventory_value['InventoryAttribute']['unit']; ?> </td>
                              </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        <?php else: ?>
                            <p>No Inventory Attribute recorded</p>
                        <?php endif; ?>        
                    </div>
                </div>
                
            </div> <!-- /widget-content -->
            </div> <!-- /widget -->         
        </div> <!-- /spa12 -->
      </div> <!-- /row -->
           
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>