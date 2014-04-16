<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li class="active"><a href="/"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
        <li class="dropdown subnavbar-open-right">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> 
                <i class="icon-truck"></i><span>Med. Item Banks</span> <b class="caret"></b>
            </a>
          <ul class="dropdown-menu">
              <li><a href="#"><i class="icon-list-alt"></i> Blood Banks </a></li>
            <li><a href="#"><i class="icon-list-alt"></i> Organ Banks</a></li>
          </ul>
        </li>
        <li class="dropdown subnavbar-open-right">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> 
                <i class="icon-th"></i><span>Inventory</span> <b class="caret"></b>
            </a>
          <ul class="dropdown-menu">
            <li><a href="#"><i class="icon-th"></i> Manage </a></li>
            <li><a href="#"><i class="icon-reorder"></i> Inventory Types </a></li>
          </ul>
        </li>
        
        <li>
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