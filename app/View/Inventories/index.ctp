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
                
                <h2>Inventory</h2><p>Click on an item you want to chech out</p>
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
                

                <?php if(isset($inventories) && !empty($inventories)): ?>
                    <table id="attributes" class="table table-striped table-bordered" style="width:50%">
                        <thead>
                          <tr>
                            <th width="5%"> S/N </th>
                            <th> Item </th>
                            <th width="20%"> Amount Left </th>
                            <!-- <th width="10%"> Check out </th>
                            <th class="td-actions" width="5%"></th> -->
                          </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i = 0;
                                foreach ($inventories as $item): ?>
                          <tr>
                            <td> <?php echo ++$i; ?> </td>
                            <td class="iob_item"> <?php echo $this->Html->link($item['inventory_items']['name'], array('action' => 'checkout', $item['inventory_items']['id']), array('style' => 'width:100%; display:inline-block'));?> </td>
                            <td> <?php echo $item['0']['Quantity'];?> </td>
                            <!-- <td> -->
                                <?php
                                    /*echo $this->Form->create('Inventory');
                                    echo $this->Form->input('inventory_item_id', array('type' => 'hidden', 'value' => $item['inventory_items']['id']));
                                    echo $this->Form->input('item_count', array('type' => 'text', 'class' => 'span1', 'label' => false));*/
                                ?>

                                <!-- <input type="text" id="mdate" name="data[Inventory][inventory_value_id][]" class="span1"> -->
                            <!-- </td>
                            <td class="td-actions">
                                <button type='submit' class='btn btn-small btn-danger'><i class="btn-icon-only icon-arrow-down"></i></button>
                            </td> -->

                                <?php //echo $this->Form->end(); ?>
                                 
                                <?php /*echo $this->Html->link('<i class="btn-icon-only icon-arrow-down"></i>',
                                    array('controller' => 'inventories', 'action' => 'edit', $inventory['Inventory']['id']),
                                    array('class' => 'btn btn-small btn-primary', 'escape' => false,
                                        'data-toggle' => 'tooltip', 'title' => 'Checkin'));*/?>  

                                <?php /*echo $this->Html->link('<i class="btn-icon-only icon-arrow-up"></i>',
                                        array('controller' => 'inventories', 'action' => 'edit', $inventory['Inventory']['id']),
                                        array('class' => 'btn btn-small btn-danger', 'escape' => false,
                                            'data-toggle' => 'tooltip', 'title' => 'Checkout'));*/?>

                                
                          </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    <!-- <div class="row">
                        <div class="span3 offset1">
                            <div class="io_item">
                                <p class="io_title">Blood</p>
                                <p class="io_left">[ 45 ]</p>
                                <p class="actions">
                                    <a class="btn btn-small btn-info"><i class="icon-arrow-down"> In</i></a>
                                    <a class="btn btn-small btn-danger"><i class="icon-arrow-up"> Out</i></a>
                                    <a class="btn btn-small btn-warning"><i class="icon-list"> Info</i></a>
                                </p>
                            </div>
                        </div>
                        <div class="span3">
                            <div class="io_item">
                                <p class="io_title">Liver</p>
                                <p class="io_left">[ 29 ]</p>
                                <p class="actions">
                                    <a class="btn btn-small btn-info"><i class="icon-arrow-down"> In</i></a>
                                    <a class="btn btn-small btn-danger"><i class="icon-arrow-up"> Out</i></a>
                                    <a class="btn btn-small btn-warning"><i class="icon-list"> Info</i></a>
                                </p>
                            </div>
                        </div>
                        <div class="span3">
                            <div class="io_item">
                                <p class="io_title">Kidney</p>
                                <p class="io_left">[ 34 ]</p>
                                <p class="actions">
                                    <a class="btn btn-small btn-info"><i class="icon-arrow-down"> In</i></a>
                                    <a class="btn btn-small btn-danger"><i class="icon-arrow-up"> Out</i></a>
                                    <a class="btn btn-small btn-warning"><i class="icon-list"> Info</i></a>
                                </p>
                            </div>
                        </div>
                    </div> -->
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