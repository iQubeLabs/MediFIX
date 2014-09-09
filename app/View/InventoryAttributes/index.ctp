<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
	      	
        <div class="span12">

            
            <div class="widget">

                <div class="widget-header">
                    <i class="icon-pushpin"></i>
                    <h3>Inventory Management</h3>
                </div> <!-- /widget-header -->

                
            <div class="widget-content">
            
                <?php echo $this->element('inventory_quick_menu');?>
                
                <h2>Product Attributes</h2>
                <?php
                	if ($current_user['AccountType']['name'] != 'Staff') {
                		echo $this->Html->link('<i class="icon icon-plus"></i> Create Product Attribute', 
                    	array('controller' => 'inventories', 'action' => 'attributes', 'add'), 
                      array('class' => 'btn btn-primary pull-right', 'escape' => false));
                	}
                ?>
                <div class="clearfix"></div>
                <hr />
                
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Session->flash('auth'); ?>
                
                <?php if(isset($attributes) && !empty($attributes)): ?>
              <table id="attributes" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> S/N </th>
                    <th> Name </th>
                    <th> Description </th>
                    <th> Product Type </th>
                    <th> Data Type </th>
                    <th> Unit </th>
                    <?php if ($current_user['AccountType']['name'] != 'Staff'): ?>
                    	<th class="td-actions" width="15%"> </th>
                    <?php endif; ?>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 0;
                        foreach ($attributes as $attribute): ?>
                  <tr>
                    <td> <?php echo ++$i; ?> </td>
                    <td> <?php echo $attribute['InventoryAttribute']['name'];?> </td>
                    <td> <?php echo $attribute['InventoryAttribute']['description'];?> </td>
                    <td> <?php echo $attribute['InventoryItem']['name'];?> </td>
                    <td> <?php echo $attribute['DataType']['name'];?> </td>
                    <td> <?php echo $attribute['InventoryAttribute']['unit'];?> </td>
                    <?php if ($current_user['AccountType']['name'] != 'Staff'): ?>
                    <td class="td-actions"> 
                        <?php echo $this->Html->link('<i class="btn-icon-only icon-edit"></i>',
                                array('controller' => 'inventories', 'action' => 'attributes', 'edit', $attribute['InventoryAttribute']['id']),
                                array('class' => 'btn btn-small btn-success', 'escape' => false,
                                    'data-toggle' => 'tooltip', 'title' => 'Edit'));?> 
                        <?php echo $this->Html->link('<i class="btn-icon-only icon-trash"></i>',
                                array('controller' => 'inventories', 'action' => 'attributes', 'delete', $attribute['InventoryAttribute']['id']),
                                array('class' => 'btn btn-danger btn-small', 'escape' => false,
                                    'data-toggle' => 'tooltip', 'title' => 'Delete'));?>
                    </td>
                  	<?php endif; ?>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
                <?php else: ?>
                    <p>No Product Attribute recorded</p>
                <?php endif; ?>
                </div> <!-- /widget-content -->
            </div> <!-- /widget -->			
        </div> <!-- /spa12 -->
      </div> <!-- /row -->
           
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>