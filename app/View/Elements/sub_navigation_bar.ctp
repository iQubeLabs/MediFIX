<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li <?php if(isset($selected_menu) && $selected_menu == 'dashboard') echo 'class="active"'; ?>><a href="/medifix"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
        
        <li class="dropdown subnavbar-open-right <?php if(isset($selected_menu) && $selected_menu == 'inventory') echo 'active'; ?>" >
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> 
                <i class="icon-medkit"></i><span>Inventory</span> <b class="caret"></b>
            </a>
          <ul class="dropdown-menu">
            <li>
                <?php echo $this->Html->link('<i class="icon-medkit"></i> Inventory ',
                    array('controller'=>'inventories', 'action' => 'index'),
                    array('escape'=>false));?>
            </li>
            <li>
                <?php echo $this->Html->link('<i class="icon-medkit"></i> Product Items ',
                    array('controller'=>'inventories', 'action' => 'flow'),
                    array('escape'=>false));?>
            </li>
            <li>
                <?php echo $this->Html->link('<i class="icon-medkit"></i> Product Types ',
                    array('controller'=>'inventories', 'action' => 'items'),
                    array('escape'=>false));?>
            </li>
            <li>
                <?php echo $this->Html->link('<i class="icon-medkit"></i> Product Attributes ',
                    array('controller'=>'inventories', 'action' => 'attributes'),
                    array('escape'=>false));?>
            </li>
            <li>
                <?php echo $this->Html->link('<i class="icon-medkit"></i> Records ',
                    array('controller'=>'records', 'action' => 'index'),
                    array('escape'=>false));?>
            </li>
          </ul>
        </li>
        
        <?php if ($current_user['AccountType']['name'] == 'Super Admin'): ?>
        <li class="dropdown subnavbar-open-right <?php if(isset($selected_menu) && $selected_menu == 'facilities') echo "active"; ?>" >
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> 
                <i class="icon-building"></i><span>Facilities</span> <b class="caret"></b>
            </a>
          <ul class="dropdown-menu">
              <li>
                  <?php echo $this->Html->link('<i class="icon-building"></i><span> Medical Facilities </span>',
                    array('controller'=>'facilities', 'action'=>'index'),
                    array('escape'=>false));?>
              </li>
            <li>
                <?php echo $this->Html->link('<i class="icon-building"></i><span> Branches </span>',
                    array('controller'=>'facilities', 'action'=>'branches', 'list'),
                    array('escape'=>false));?>
            </li>
          </ul>
        </li>
        <?php endif; ?>
        
        <li <?php if(isset($selected_menu) && $selected_menu == 'account') echo 'class="active"'; ?>>
            <?php echo $this->Html->link('<i class="icon-group"></i><span> Accounts </span>',
                    array('controller'=>'accounts', 'action'=>'index'),
                    array('escape'=>false));?>
        </li>
        
        <li><a href="#"><i class="icon-cog"></i><span>Settings</span> </a> </li>
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
