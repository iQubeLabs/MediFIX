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
            
                
                <h2><?php echo $facility['MedicalFacility']['name'];?></h2>
                <?php echo $this->Html->link('<i class="icon icon-plus"></i> Facility', 
                    array('controller' => 'facilities', 'action' => 'create'), 
                        array('class' => 'btn btn-primary pull-right', 'escape' => false)); ?>
                <?php echo $this->Html->link('<i class="icon icon-plus"></i> Branch', 
                    array('controller' => 'facilities', 'action' => 'branches', 'add', $facility['MedicalFacility']['id']), 
                    array('class' => 'btn pull-right', 'escape' => false, 'style' => 'margin-right: 10px;')); ?>
                <div class="clearfix"></div>
                <hr />
                
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Session->flash('auth'); ?>
                
                <div class="span6" id="facility-info">
                    <?php echo $this->Html->image($facility['MedicalFacility']['logo'], array('class' => 'pull-left thumbnail facility-image', 'alt' => 'facility_logo')); ?>
                    <!-- <img class="pull-left thumbnail facility-image" src="http://placehold.it/150x150" /> -->
                    <ul class="pull-left">
                        <li>
                            <span>RC Number</span>
                            <?php echo $facility['MedicalFacility']['rc_number'];?>
                        </li>
                        <li>
                            <span>Website</span>
                            <a href="http://<?php echo $facility['MedicalFacility']['website_url'];?>"><?php echo $facility['MedicalFacility']['website_url'];?></a>
                        </li>
                        <li>
                            <span>Brand</span>
                            <div style="background-color: <?php echo $facility['MedicalFacility']['brand_colour']; ?>; width: 20px; height: 20px; display: inline-table;"></div>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                    
                    <div id="branches">
                        <?php 
                            $location_url = 'http://maps.googleapis.com/maps/api/staticmap?center=Nigeria&zoom=6&size=500x350&maptype=roadmap'; 
                            $marker_initials = '&markers=color:red%7Clabel:C%7C';
                        ?>

                        <?php foreach ($branches as $branch): ?>
                            <div class="well branch">
                                <h3 class="text-center text-info"><?php echo $branch['Branch']['tagname'];?></h3>
                                <h4>Address:</h4>
                                <p><?php echo $branch['Branch']['address'];?></p>
                                <h4>City:</h4>
                                <p><?php echo $branch['Branch']['city'];?></p>
                                <h4>State:</h4>
                                <p><?php echo $branch['State']['name'];?></p>
                                <h4>Primary Phone:</h4>
                                <p><?php echo $branch['Branch']['primary_phone'];?></p>
                                <h4>Secondary Phone:</h4>
                                <p><?php echo $branch['Branch']['secondary_phone']; ?></p>
                                <?php $location_url .= $marker_initials . $branch['Branch']['geolocation'];?>
                            </div>
                        <?php endforeach;?>
                    </div>
                </div>
                
                <div class="span5">
                    <div id="facility-canvas">
                    <img src="<?php echo $location_url . '&sensor=false'; ?>" />
                    </div>
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