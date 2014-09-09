<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
	      	
        <div class="span12">

            
            <div class="widget">

                <div class="widget-header">
                    <i class="icon-pushpin"></i>
                    <h3>Medical Facilities - Branches</h3>
                </div> <!-- /widget-header -->

            <div class="widget-content">
            
                
                <h2>All Branches</h2>
                <?php echo $this->Html->link('<i class="icon icon-plus"></i> Branch', 
                    array('controller' => 'facilities', 'action' => 'branches', 'add'), 
                    array('class' => 'btn pull-right', 'escape' => false, 'style' => 'margin-right: 10px;')); ?>
                <div class="clearfix"></div>
                <hr />
                
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Session->flash('auth'); ?>
                
                <?php if(isset($branches) && !empty($branches)): ?>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> S/N </th>
                    <th> Name </th>
                    <th> Address </th>
                    <th> State </th>
                    <th> E-mail </th>
                    <th> Phone Number </th>
                    <th> Medical Facility </th>
                    <th class="td-actions" width="15%"> </th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 0;
                        foreach ($branches as $branch): ?>
                  <tr>
                    <td> <?php echo ++$i; ?> </td>
                    <td> <?php echo $branch['Branch']['tagname'];?> </td>
                    <td> <?php echo $branch['Branch']['address'];?> </td>
                    <td> <?php echo $branch['State']['name'];?> </td>
                    <td> <?php echo $branch['Branch']['email'];?> </td>
                    <td> <?php echo $branch['Branch']['primary_phone'];?> </td>
                    <td> 
                        <?php echo $this->Html->link($branch['MedicalFacility']['name'],
                                array('controller' => 'facilities', 'action' => 'view', $branch['Branch']['medical_facility_id']),
                                array('class' => 'btn-link', 'data-toggle' => 'tooltip', 'title' => 'Details')); ?> 
                    
                    </td>
                    <td class="td-actions">
                        <?php // echo $this->Html->link('<i class="btn-icon-only icon-eye-open"></i>',
//                                array('controller' => 'facilities', 'action' => 'branches', 'view', $branch['Branch']['id']),
//                                array('class' => 'btn btn-small', 'escape' => false,
//                                    'data-toggle' => 'tooltip', 'title' => 'Details'));?> 
                        <?php echo $this->Html->link('<i class="btn-icon-only icon-edit"></i>',
                                array('controller' => 'facilities', 'action' => 'branches', 'edit', $branch['Branch']['id']),
                                array('class' => 'btn btn-small btn-success', 'escape' => false,
                                    'data-toggle' => 'tooltip', 'title' => 'Edit'));?> 
                        <?php echo $this->Html->link('<i class="btn-icon-only icon-trash"></i>',
                                array('controller' => 'facilities', 'action' => 'branches', 'delete', $branch['Branch']['id']),
                                array('class' => 'btn btn-danger btn-small', 'escape' => false,
                                    'data-toggle' => 'tooltip', 'title' => 'Delete'));?>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
                <?php else: ?>
                    <p>No Branches recorded</p>
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