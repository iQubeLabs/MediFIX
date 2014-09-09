<script type="text/javascript">
    var data = <?php echo json_encode($data) ?>;
    /*alert(data[0]['item']);
    var nameList = '';
    var name = [[1, 2],[3,4],[5,6]];
    for (var i = 0; i < name.length; i++) {
        nameList += name[i]+'\n';
    }
    alert(nameList);
    alert(name.length);

    var value = new Array();

    for (var i = 0; i < data.length; i++) {
        value[i] = data[i]['item'];
        //value[i][1] = data[i]['quantity'];
    }
    alert(value[0]);*/
    
</script>

<div class="main">
  <div class="main-inner">
    <div class="container">

      <div class="row">

        <!-- <div class="span6">
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
            	<h3> This Week at a glance</h3>
               	</div> -->
                  <!-- /widget-header -->
                  <!-- <div class="widget-content">
                    <div class="widget big-stats-container">
                      <div class="widget-content"> -->
                        <!--<h6 class="bigstats">A fully responsive premium quality admin template built on Twitter Bootstrap by <a href="http://www.egrappler.com" target="_blank">EGrappler.com</a>.  These are some dummy lines to fill the area.</h6>-->
                	      <!-- <div id="big_stats" class="cf">
                          <div class="stat"> 
                            <i class="icon-arrow-down"> In </i>
                            <span class="value">
                              <?php foreach ($in as $sum) {
                                if ($sum['0']['Sum'] == null) {
                                  echo 0;
                                } else {
                                  	echo $sum['0']['Sum'];
                                }
                              }?>
                            </span> 
                          </div> -->
                        	<!-- .stat -->
                        	
                        	<!-- <div class="stat"> 
                          	<i class="icon-arrow-up"> Out </i>
                            <span class="value">
                              <?php foreach ($out as $sum) {
                                if ($sum['0']['Sum'] == null) {
                                  echo 0;
                                } else {
                                  echo $sum['0']['Sum'];
                                }
                              }?>
                            </span>
                          </div> -->
                          <!-- .stat -->
                          
                          <!-- <div class="stat"> 
                          	<i class="icon-twitter-sign"></i> <span class="value">922</span> 
                          </div> -->
                          <!-- .stat -->
													
													<!-- <div class="stat"> 
                            <i class="icon-bullhorn"></i> <span class="value">25%</span> 
                          </div> -->
                          <!-- .stat --> 
                        <!-- </div>
                      </div> -->
                      <!-- /widget-content --> 
                    <!-- </div>
                  </div>
                </div>
              </div> -->
                <!-- /span6 -->
                
                
                <div class="span6">
                    <div class="widget">
                        <div class="widget-header"> <i class="icon-bookmark"></i>
                            <h3>Important Shortcuts</h3>
                        </div>
                        <!-- /widget-header -->
                        <div class="widget-content">
                            <div class="shortcuts"> 
                                <!-- <a href="/medifix/inventories/items/add" class="shortcut">
                                    <i class="shortcut-icon icon-list-alt"></i>
                                    <span class="shortcut-label">New Item</span> 
                                </a>
                                <a href="/medifix/accounts/create" class="shortcut">
                                    <i class="shortcut-icon icon-group"></i>
                                    <span class="shortcut-label">Create Account</span> 
                                </a>                                
                                <a href="medifix/facilities/create" class="shortcut"> 
                                    <i class="shortcut-icon icon-building"></i>
                                    <span class="shortcut-label">New facility</span> 
                                </a>
                                <a href="/medifix/records/" class="shortcut">
                                    <i class="shortcut-icon icon-bar-chart"></i> 
                                    <span class="shortcut-label">Reports</span> 
                                </a> -->
                                <?php if ($current_user['AccountType']['name'] != 'Staff'): ?>
                                <?php
                                    echo $this->Html->link('<i class="shortcut-icon icon-arrow-down"></i><span class="shortcut-label">Add Product Item</span>', array('controller' => 'inventories', 'action' => 'add'), array('class' => 'shortcut', 'escape' => false));
                                ?>
                                <?php
                                    echo $this->Html->link('<i class="shortcut-icon icon-group"></i><span class="shortcut-label">Create Account</span>', array('controller' => 'accounts', 'action' => 'create'), array('class' => 'shortcut', 'escape' => false));
                                ?>
                                <?php if ($current_user['AccountType']['name'] == 'Super Admin'): ?>
                                <?php
                                    echo $this->Html->link('<i class="shortcut-icon icon-building"></i><span class="shortcut-label">Create Facility</span>', array('controller' => 'facilities', 'action' => 'create'), array('class' => 'shortcut', 'escape' => false));
                                ?>
                              	<?php endif; endif ?>
                                <?php
                                    echo $this->Html->link('<i class="shortcut-icon icon-bar-chart"></i><span class="shortcut-label">Records</span>', array('controller' => 'records', 'action' => 'index'), array('class' => 'shortcut', 'escape' => false));
                                ?>
                            </div>
                            <!-- /shortcuts --> 
                        </div>
                        <!-- /widget-content --> 
                    </div>
                    <!-- /widget -->
                </div>
                <!-- /span6 --> 
            </div>

            <div class = 'row'>
							<?php if(isset($records) && !empty($records)): ?>
              <div class="span12">
                    
                    <!-- /widget -->
                    <div class="widget widget-table action-table">
                        <div class="widget-header"> <i class="icon-th-list"></i>
                            <h3>
                                Inventory Records
                            </h3>
                        </div>
                        <!-- /widget-header -->
                        <div class="widget-content">

              <table id="attributes" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> S/N </th>
                    <th> Status </th>
                    <th> Item </th>
                    <!-- <th> Manufacturing Date </th> -->
                    <!-- <th> Expiry Date </th> -->
                    <th> Item Count </th>
                    <th> Recorded By </th>
                    <?php if ($current_user['AccountType']['name'] == 'Super Admin'): ?>
                    <th> Branch </th>
                    <?php endif; ?>
                    <th> Date </th>
                    <!-- <th class="td-actions" width="12%"> </th> -->
                  </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 0;
                        foreach ($records as $inventory):
                        if (($current_user['Branch']['id'] == $inventory['Branch']['id'] or $current_user['AccountType']['name'] == 'Super Admin') and $i < 10): ?>
                  <tr>
                    <td> <?php echo ++$i; ?> </td>
                    <td> 
                        <?php 
                            $dir = $inventory['Record']['direction'];
                            if($dir == 1) {
                                echo '<span class="label label-info">checked in</span>';
                            } else {
                                echo '<span class="label label-important">checked out<success/span>';
                            }
                        ?> 
                    </td>
                    <td> <?php echo $inventory['InventoryItem']['name'];?> </td>
                    <!-- <td> 
                        <?php //if ($dir == 1) {
                              //      echo $inventory['Inventory']['manufactured_date'];
                              //  } else {
                              //      echo 'NIL';
                              //  }
                        ?>
                    </td> -->
                    <!-- <td>
                        <?php //if ($dir == 1) {
                              //      echo $inventory['Inventory']['expiry_date'];
                              //  } else {
                              //      echo 'NIL';
                              //  }
                        ?>
                    </td> -->
                    <td> <?php echo abs($inventory['Record']['item_count']);?> </td>
                    <td> <?php echo strtoupper($inventory['Account']['username']);?> </td>
                    <?php if ($current_user['AccountType']['name'] == 'Super Admin'): ?>
                    <td> <?php echo $inventory['Branch']['tagname']; ?> </td>
                    <?php endif; ?>
                    <td> <?php echo $inventory['Record']['created'];?> </td>
                    <td class="td-actions" style = 'display:none'>
                        <?php echo $this->Html->link('<i class="btn-icon-only icon-eye-open"></i>',
                                array('controller' => 'inventories', 'action' => 'view', $inventory['Record']['id']),
                                array('class' => 'btn btn-small', 'escape' => false,
                                    'data-toggle' => 'tooltip', 'title' => 'Details'));?> 
                        <?php echo $this->Html->link('<i class="btn-icon-only icon-edit"></i>',
                                array('controller' => 'inventories', 'action' => 'edit', $inventory['Record']['id']),
                                array('class' => 'btn btn-small btn-success', 'escape' => false,
                                    'data-toggle' => 'tooltip', 'title' => 'Edit'));?> 
                    </td>
                  </tr>
                  <?php endif; ?>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <?php echo $this->Html->link('More...', array('controller' => 'records', 'action' => 'index'), array('class' => 'btn btn-info pull-right', 'style' => 'margin: 10px 10px;')) ?>
                            
                        </div>
                        <!-- /widget-content --> 
                    </div>
                    <!-- /widget -->
                    
                </div>
                <?php //else: ?>
                    <!-- <p> Inventory Empty</p> -->
                <?php endif; ?>

            </div>



            <div class="row">
                                
                <?php if(isset($item_total) && !empty($item_total)): ?>
                <div class="span6">
                <!-- /widget -->
                    <div class="widget widget-table action-table">
                        <div class="widget-header"> <i class="icon-th-list"></i>
                            <h3>Item Count <span style = 'font-weight: 100'>(click on an item you want to check out.)</span></h3>
                        </div>
                        <!-- /widget-header -->
                        <div class="widget-content">
                          <table class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th width="5%"> S/N </th>
                                <th> Item </th>
                                <th width="20%"> Amount Left </th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                                $i = 0;
                                foreach ($item_total as $item): ?>
                                <tr>
                                  <td> <?php echo ++$i; ?> </td>
                                  <td class="iob_item"> <?php echo $this->Html->link($item['inventory_items']['name'], array('controller' => 'inventories', 'action' => 'checkout', $item['inventory_items']['id']), array('style' => 'width:100%; display:inline-block'));?> </td>
                                  <td> <?php echo $item['0']['Quantity'];?> </td>
                                </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                            
                          <!-- <a href="javascript:;" class="btn btn-info pull-right" style="margin: 10px 10px;">More...</a> -->
                        </div>
                        <!-- /widget-content --> 
                    </div>
                    <!-- /widget -->
                    
                </div>
                      <?php //else: ?>
                        <!-- <p> Inventory Empty</p> -->
                      <?php endif; ?>
            </div>
            
            <div class="row">

                <div class="span12">

                    <div class="widget">

                        <div class="widget-header">
                            <i class="icon-pushpin"></i>
                            <h3>Inventory Distributions</h3>
                        </div> <!-- /widget-header -->

                        <div class="widget-content">

                            <div class="span6">
                                <div id="inventory_dist_by_type" style="width: 100%; height: 400px;"></div>
                            </div>

                            <div class="span5">
                                <div id="inventory_dist_by_location" style="width: 100%; height: 400px;"></div>
                            </div>

                        </div> <!-- /widget-content -->
                    </div> <!-- /widget -->			
                </div> <!-- /spa12 -->

            </div> <!-- /row -->
            
            <!--Inventories Demand by location-->
            <div class="row">

                        <div class="span12">

                            <div class="widget">

                                <div class="widget-header">
                                    <i class="icon-pushpin"></i>
                                    <h3>Inventories Demand by Location</h3>
                                </div> <!-- /widget-header -->

                                <div class="widget-content" style="padding: 0px;">
                                    
                                    <div id="inventory_map_canvas" style="height: 450px; width: 100%;"></div>
                                    
                                </div> <!-- /widget-content -->
                            </div> <!-- /widget -->			
                        </div> <!-- /spa12 -->
            </div><!-- /row --> 
            
        </div>
        <!-- /container --> 
    </div>
    <!-- /main-inner --> 
</div>