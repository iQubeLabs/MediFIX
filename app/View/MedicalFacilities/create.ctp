<div class="main">
  <div class="main-inner">
    <div class="container">
                        
        <?php echo $this->Form->Create('MedicalFacility',
            array(
                'controller' => 'facilities', 
                'action' => 'create', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' )) ;?>
        
      <div class="row">
	      	
        <div class="span12">

            
            <div class="widget">

                <div class="widget-header">
                    <i class="icon-group"></i>
                    <h3>Medical Facilities</h3>
                </div> <!-- /widget-header -->

            <div class="widget-content">
                
                <h2>Create New Medical Facility</h2>
                <hr />
                
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Session->flash('auth'); ?>

                <div class="span6">
                    <fieldset>
                        <div class="control-group">											
                            <label class="control-label" for="name">Name</label>
                            <div class="controls">
                                <?php echo $this->Form->input('name', array('type' => 'text', 'id' => 'name', 'class' => 'span3', 'label' => false));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="brand_colour">Logo</label>
                            <div class="controls">
                                <?php echo $this->Form->input('logo', array('require'=>true, 'type' => 'file', 'label' => false)); ?>
                                <!-- <input type="file" name="data[MedicalFacility][hospital_logo]" id="BriefFilename" /> -->
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="brand_colour">Brand Colour</label>
                            <div class="controls">
                                <?php echo $this->Form->input('brand_colour', array('type' => 'text', 'id' => 'picker', 'class' => 'span1', 'label' => false));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="website_url">Website</label>
                            <div class="controls">
                                <?php echo $this->Form->input('website_url', array('type' => 'text', 'id' => 'website_url', 'class' => 'span3', 'label' => false));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="username">RC Number</label>
                            <div class="controls">
                                <?php echo $this->Form->input('rc_number', array('type' => 'text', 'id' => 'rc_number', 'class' => 'span3', 'label' => false));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                    </fieldset>
                </div>
                <div class="clearfix"></div>
                
                <h3>Branch Information</h3>
                <hr />
                        
                <div class="span6">
                    <fieldset>
                        <div class="control-group">											
                            <label class="control-label" for="tagname">Name</label>
                            <div class="controls">
                                <?php echo $this->Form->input('tagname', array('type' => 'text', 'id' => 'name', 'class' => 'span3', 'label' => false, 'required'));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="address">Address</label>
                            <div class="controls">
                                <?php echo $this->Form->input('address', array('type' => 'text', 'id' => 'address', 'class' => 'span3', 'label' => false, 'required'));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="city">City</label>
                            <div class="controls">
                                <?php echo $this->Form->input('city', array('type' => 'text', 'id' => 'city', 'class' => 'span3', 'label' => false, 'required'));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="state">State</label>
                            <div class="controls">
                                <?php echo $this->Form->select('state_id', $state_list, array('class' => 'span3', 'required'));
                            ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="email">Email Address</label>
                            <div class="controls">
                                <?php echo $this->Form->input('email', array('type' => 'text', 'id' => 'email', 'class' => 'span3', 'label' => false));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="primary_phone">Primary Phone</label>
                            <div class="controls">
                                <?php echo $this->Form->input('primary_phone', array('type' => 'text', 'id' => 'primary_phone', 'class' => 'span3', 'label' => false, 'required'));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="secondary_phone">Secondary Phone</label>
                            <div class="controls">
                                <?php echo $this->Form->input('secondary_phone', array('type' => 'text', 'id' => 'secondary_phone', 'class' => 'span3', 'label' => false));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="location">Location</label>
                            <div class="controls">
                                <?php echo $this->Form->input('geolocation', array('type' => 'text', 'id' => 'geolocation', 'class' => 'span3', 'label' => false, 'required'));?>
                                <p class="help-block" style="color: #0480be;">Latitude, Longitude</p>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                    </fieldset>
                </div>
                <div class="span5">
                    <h3>Click to select Location</h3><br />
                    <div id="loc_canvas" style="width:100%; height: 320px;"></div>
                </div>
                <div class="span11">
                    <fieldset>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button> 
                            <a class = 'btn btn-primary btn-danger' href="/medifix/facilities/">Cancel</a>
                        </div> <!-- /form-actions -->
                    </fieldset>
                </div>
            </div> <!-- /widget-content -->
            </div> <!-- /widget -->			
        </div> <!-- /spa12 -->
      </div> <!-- /row -->
                           
        <?php echo $this->Form->end() ;?>
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!--
<div id="loc_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">Select Location</h3>
    </div>
    <div class="modal-body">
        <div id="loc_canvas" style="width:500px; height: 320px;"></div>
        <h3>Location</h3>
        <p>Value: </p>
    </div>
    <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
      <button class="btn btn-primary" id="save_location">Use Location</button>
    </div>
</div>-->