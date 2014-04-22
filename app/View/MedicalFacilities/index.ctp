<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
	      	
        <div class="span12">

            
            <div class="widget">

                <div class="widget-header">
                    <i class="icon-pushpin"></i>
                    <h3>Medical Facilities</h3>
                </div> <!-- /widget-header -->

            <div class="widget-content">
            
                
                <h2>All Medical Facilities</h2>
                <?php echo $this->Html->link('<i class="icon icon-plus"></i> Facility', 
                    array('controller' => 'facilities', 'action' => 'create'), 
                        array('class' => 'btn btn-primary pull-right', 'escape' => false)); ?>
                <?php echo $this->Html->link('<i class="icon icon-plus"></i> Branch', 
                    array('controller' => 'facilities', 'action' => 'create'), 
                    array('class' => 'btn pull-right', 'escape' => false, 'style' => 'margin-right: 10px;')); ?>
                <div class="clearfix"></div>
                <hr />
                
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Session->flash('auth'); ?>
                
                <?php if(isset($facilities) && !empty($facilities)): ?>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> S/N </th>
                    <th> Name </th>
                    <th> Brand Colour </th>
                    <th> Website </th>
                    <th> RC Number </th>
                    <th> Branch Count </th>
                    <th class="td-actions" width="15%"> </th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 0;
                        foreach ($facilities as $facility): ?>
                  <tr>
                    <td> <?php echo ++$i; ?> </td>
                    <td> <?php echo $facility['MedicalFacility']['name'];?> </td>
                    <td style="text-align: left;">
                        <div style="background-color: <?php echo $facility['MedicalFacility']['brand_colour']; ?>; width: 20px; height: 20px; display: inline-table;">
                        </div> <?php echo $facility['MedicalFacility']['brand_colour']; ?> 
                    </td>
                    <td> <?php echo $facility['MedicalFacility']['website_url'];?> </td>
                    <td> <?php echo $facility['MedicalFacility']['rc_number'];?> </td>
                    <td> <?php echo $facility[0]['branch_count'];?> </td>
                    <td class="td-actions">
                        <?php echo $this->Html->link('<i class="btn-icon-only icon-eye-open"></i>',
                                array('controller' => 'facilities', 'action' => 'view', $facility['MedicalFacility']['id']),
                                array('class' => 'btn btn-small', 'escape' => false,
                                    'data-toggle' => 'tooltip', 'title' => 'Details'));?> 
                        <?php echo $this->Html->link('<i class="btn-icon-only icon-edit"></i>',
                                array('controller' => 'facilities', 'action' => 'edit', $facility['MedicalFacility']['id']),
                                array('class' => 'btn btn-small btn-success', 'escape' => false,
                                    'data-toggle' => 'tooltip', 'title' => 'Edit'));?> 
                        <?php echo $this->Html->link('<i class="btn-icon-only icon-trash"></i>',
                                array('controller' => 'facilities', 'action' => 'delete', $facility['MedicalFacility']['id']),
                                array('class' => 'btn btn-danger btn-small', 'escape' => false,
                                    'data-toggle' => 'tooltip', 'title' => 'Delete'));?>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
                <?php else: ?>
                    <p>No Facility recorded</p>
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