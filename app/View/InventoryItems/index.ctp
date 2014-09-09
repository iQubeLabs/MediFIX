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
                
                <h2>Product Types</h2>
                <?php
                	if ($current_user['AccountType']['name'] != 'Staff') {
	                	echo $this->Html->link('<i class="icon icon-plus"></i> Create Product Type', 
	                  array('controller' => 'inventories', 'action' => 'items', 'add'), 
	                  array('class' => 'btn btn-primary pull-right', 'escape' => false));
                	}
                 ?>
                <div class="clearfix"></div>
                <hr />
                
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Session->flash('auth'); ?>
                
                <?php if(isset($items) && !empty($items)): ?>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> S/N </th>
                    <th> Name </th>
                    <th> Display Name </th>
                    <th> Description </th>
                    <th> Prouct Colour </th>
                    <?php if ($current_user['AccountType']['name'] != 'Staff'): ?>
                    	<th class="td-actions" width="15%"> </th>
                  	<?php endif ?>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 0;
                        foreach ($items as $item): ?>
                  <tr>
                    <td> <?php echo ++$i; ?> </td>
                    <td> <?php echo $item['InventoryItem']['name'];?> </td>
                    <td> <?php echo $item['InventoryItem']['display_name'];?> </td>
                    <td> <?php echo $item['InventoryItem']['description'];?> </td>
                    <td style="text-align: left;">
                        <div style="background-color: <?php echo $item['InventoryItem']['item_colour']; ?>; width: 20px; height: 20px; display: inline-table; border: 1px solid black;">
                        </div> <?php echo $item['InventoryItem']['item_colour']; ?> 
                    </td>
                    <?php if ($current_user['AccountType']['name'] != 'Staff'): ?>
                    <td class="td-actions">
                        <?php // echo $this->Html->link('<i class="btn-icon-only icon-eye-open"></i>',
//                                array('controller' => 'inventories', 'action' => 'items', 'view', $item['InventoryItem']['id']),
//                                array('class' => 'btn btn-small', 'escape' => false,
//                                    'data-toggle' => 'tooltip', 'title' => 'Details'));?> 
                        <?php echo $this->Html->link('<i class="btn-icon-only icon-edit"></i>',
                                array('controller' => 'inventories', 'action' => 'items', 'edit', $item['InventoryItem']['id']),
                                array('class' => 'btn btn-small btn-success', 'escape' => false,
                                    'data-toggle' => 'tooltip', 'title' => 'Edit'));?> 
                        <?php echo $this->Html->link('<i class="btn-icon-only icon-trash"></i>',
                                array('controller' => 'inventories', 'action' => 'items', 'delete', $item['InventoryItem']['id']),
                                array('class' => 'btn btn-danger btn-small', 'escape' => false,
                                    'data-toggle' => 'tooltip', 'title' => 'Delete'));?>
                    </td>
                  	<?php endif; ?>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
                <?php else: ?>
                    <p>No Product Type recorded</p>
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