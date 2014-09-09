<script type="text/javascript" src="/medifix/js/jquery-1.7.2.min.js">
</script>


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
                
                <h2>Product Checkout</h2>
                <h1><?php echo $inventories['0']['it']['name']; ?></h1>
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
                <div class = 'row'>
                <?php foreach ($products as $product): ?>
                <?php if ($current_user['Branch']['id'] == $product[0]['branch_id']): ?>
                <div class='span4'>
                    <table id="attributes" class="table table-striped table-bordered" style="margin-bottom:0px">
                        <thead>
                            <th> Attribute </th>
                            <th> Value </th>
                        </thead>
                        <tbody>
                        <?php for ($i = 1; $i < count($product); $i++): ?>
                            <tr>
                                <td> <?php echo $product[$i]['InventoryAttribute']['name']; ?></td>
                                <td> <?php echo $product[$i]['InventoryValue']['value'].$product[$i]['InventoryAttribute']['unit'];; ?></td>
                            </tr>
                        <?php endfor; ?> 
                        </tbody>
                    </table>
                    <div class='pull-right'>
                        <h3> Quantity: <?php echo $product[0]['item_count']; ?> </h3>
                        <div class = 'pull-right' style='margin-bottom:5%'><?php echo $this->Html->link('Check Out', array('controller' => 'inventories', 'action' => 'edit', $product[0]['id']), array('class' => 'btn btn-danger')); ?></div>
                    </div>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>
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

<script type="text/javascript">
    div = $('.span4');
    var len = div.size();
    console.log(len);

    var heightest = 0;

    for (var i=0; i < len; i++) {
        height = $(div[i]).height();
        if (height > heightest) {
            heightest = height;
        }
    };
    div.height(heightest+20);
</script>