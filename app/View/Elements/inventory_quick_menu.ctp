<div class="row">
    <div class="span6 pull-right">
        <div class="shortcuts">
             <?php /*echo $this->Html->link('<i class="shortcut-icon icon-heart"></i>'
                     . '<span class="shortcut-label">Inventory List</span>', 
                    array('controller' => 'inventories', 'action' => 'index'), 
                        array('class' => 'shortcut', 'escape' => false));*/ ?>

            <?php echo $this->Html->link('<i class="shortcut-icon icon-arrow-down"></i>'
                     . '<span class="shortcut-label">Product Items</span>', 
                    array('controller' => 'inventories', 'action' => 'flow'),
                        array('class' => 'shortcut', 'escape' => false)); ?>

            <?php echo $this->Html->link('<i class="shortcut-icon icon-bar-chart"></i>'
                     . '<span class="shortcut-label">Records</span>', 
                    array('controller' => 'records', 'action' => 'index'), 
                        array('class' => 'shortcut', 'escape' => false)); ?>

             <?php echo $this->Html->link('<i class="shortcut-icon icon-shopping-cart"></i>'
                     . '<span class="shortcut-label">Product Types</span> ', 
                    array('controller' => 'inventories', 'action' => 'items'), 
                        array('class' => 'shortcut', 'escape' => false)); ?>

            <?php echo $this->Html->link('<i class="shortcut-icon icon-heart-empty"></i>'
                     . '<span class="shortcut-label">Product Attributes</span>', 
                    array('controller' => 'inventories', 'action' => 'attributes'), 
                        array('class' => 'shortcut', 'escape' => false)); ?>
        </div>
    </div>
    <div class="clearfix"></div>

</div>