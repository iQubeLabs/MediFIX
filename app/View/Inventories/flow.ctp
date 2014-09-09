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
                
                <h2>Product Items</h2>
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
                
                <?php if (isset($inventories) && !empty($inventories)): ?>
                <?php foreach ($inventories as $inventory): ?>
                <?php if ($current_user['Branch']['id'] == $inventory['Branch']['id'] or $current_user['AccountType']['name'] == 'Super Admin'): ?>
              <table id="attributes" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> S/N </th>
                    <!-- <th> In/Out</th> -->
                    <th> Item </th>
                    <th> Manufacturing Date </th>
                    <th> Expiry Date </th>
                    <th> Item Count </th>
                    <th> Recorded By </th>
                    <?php if ($current_user['AccountType']['name'] == 'Super Admin'): ?>
                    <th> Branch </th>
                    <?php endif; ?>
                    <th> Recorded Date </th>
                    <th class="td-actions" width="12%"> </th>
                  </tr>
                </thead>
                <?php break; endif; endforeach; ?>
                <tbody>
                    <?php 
                        $i = 0;
                        foreach ($inventories as $inventory): ?>

                        <!-- Filter according to branch id -->
                        <?php if ($current_user['Branch']['id'] == $inventory['Branch']['id'] or $current_user['AccountType']['name'] == 'Super Admin'): ?>
                               
                  <tr>
                    <td> <?php echo ++$i; ?> </td>
                    <!-- <td> 
                        <?php 
                            /*$dir = $inventory['Inventory']['direction'];
                            if($dir == 1) {
                                echo '<span class="label label-info">incoming</span>';
                            } else {
                                echo '<span class="label label-important">outgoing<success/span>';
                            }*/
                        ?> 
                    </td> -->
                    <td> <?php echo $inventory['InventoryItem']['name'];?> </td>
                    <td> 
                        <?php //if ($dir == 1) {
                                    echo $inventory['Inventory']['manufactured_date'];
                                //} else {
                                //    echo 'NIL';
                                //}
                        ?>
                    </td>
                    <td>
                        <?php //if ($dir == 1) {
                                    echo $inventory['Inventory']['expiry_date'];
                                //} else {
                                //    echo 'NIL';
                                //}
                        ?>
                    </td>
                    <td> <?php echo abs($inventory['Inventory']['item_count']);?> </td>
                    <td> <?php echo strtoupper($inventory['Account']['username']);?> </td>
                    <?php if ($current_user['AccountType']['name'] == 'Super Admin'): ?>
                    <td> <?php echo $inventory['Branch']['tagname']; ?> </td>
                    <?php endif; ?>
                    <td> <?php echo $inventory['Inventory']['created'];?> </td>
                    <td class="td-actions">
                        <?php echo $this->Html->link('<i class="btn-icon-only icon-eye-open"></i>',
                                array('controller' => 'inventories', 'action' => 'view', $inventory['Inventory']['id']),
                                array('class' => 'btn btn-small', 'escape' => false,
                                    'data-toggle' => 'tooltip', 'title' => 'Details'));?>
                        <?php if ($current_user['AccountType']['name'] != 'Staff'): ?>
	                        <?php echo $this->Html->link('<i class="btn-icon-only icon-edit"></i>',
	                                array('controller' => 'inventories', 'action' => 'change', $inventory['Inventory']['id']),
	                                array('class' => 'btn btn-small btn-success', 'escape' => false,
	                                    'data-toggle' => 'tooltip', 'title' => 'Edit'));?>
	                        <?php echo $this->Html->link('<i class="btn-icon-only icon-trash"></i>',
	                                array('controller' => 'inventories', 'action' => 'delete', $inventory['Inventory']['id']),
	                                array('class' => 'btn btn-danger btn-small', 'escape' => false,
	                                'data-toggle' => 'tooltip', 'title' => 'Delete')); ?>
                        <?php endif; ?>
                    </td>
                  </tr>
                    <?php endif; ?><!-- end of filter -->
                  <?php endforeach; ?>
                </tbody>
              </table>
                <?php else: ?>
                    <p>Inventory Empty. No product item added.</p>
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