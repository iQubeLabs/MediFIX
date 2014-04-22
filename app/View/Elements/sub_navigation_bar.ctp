<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li <?php if(isset($selected_menu) && $selected_menu == 'dashboard') echo 'class="active"'; ?>><a href="/"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
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
                    array('controller'=>'facilities', 'action'=>'branches'),
                    array('escape'=>false));?>
            </li>
          </ul>
        </li>
        <li class="dropdown subnavbar-open-right <?php if(isset($selected_menu) && $selected_menu == 'inventory') echo 'active'; ?>" >
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> 
                <i class="icon-medkit"></i><span>Inventory</span> <b class="caret"></b>
            </a>
          <ul class="dropdown-menu">
            <li><a href="#"><i class="icon-medkit"></i> Manage </a></li>
            <li><a href="#"><i class="icon-medkit"></i> Inventory Types </a></li>
          </ul>
        </li>
        
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