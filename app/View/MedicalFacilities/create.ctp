<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
	      	
        <div class="span12">

            
            <div class="widget">

                <div class="widget-header">
                    <i class="icon-group"></i>
                    <h3>Account</h3>
                </div> <!-- /widget-header -->

            <div class="widget-content">
                
                <h2>Create New Medical Facility</h2>
                <hr />
                
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Session->flash('auth'); ?>
                
                <?php echo $this->Form->Create('MedicalFacility',
                array(
                    'controller' => 'facilities', 
                    'action' => 'create', 'class' => 'form-horizontal')) ;?>
                <!--<form id="edit-profile" class="form-horizontal">-->
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
                                <?php // echo $this->Form->file('MedicalFacility.logo', array('require'=>true, 'class' => 'btn')); ?>
                                <input type="file" name="data[MedicalFacility][logo]" id="BriefFilename" />
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

                        <h3>Branch Information</h3>
                        <hr />
                        
                        <div class="control-group">											
                            <label class="control-label" for="tagname">Name</label>
                            <div class="controls">
                                <?php echo $this->Form->input('tagname', array('type' => 'text', 'id' => 'name', 'class' => 'span3', 'label' => false));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="address">Address</label>
                            <div class="controls">
                                <?php echo $this->Form->input('address', array('type' => 'text', 'id' => 'address', 'class' => 'span3', 'label' => false));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="city">City</label>
                            <div class="controls">
                                <?php echo $this->Form->input('city', array('type' => 'text', 'id' => 'city', 'class' => 'span3', 'label' => false));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="state">State</label>
                            <div class="controls">
                                <?php echo $this->Form->select('state_id', $state_list, array('class' => 'span3'));
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
                                <?php echo $this->Form->input('primary_phone', array('type' => 'text', 'id' => 'primary_phone', 'class' => 'span3', 'label' => false));?>
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
                                <a href="#loc_modal" role="button" class="btn-link pull-right" data-toggle="modal"><i class="icon-globe"></i> Select from map</a>
                                <?php echo $this->Form->input('geolocation', array('type' => 'text', 'id' => 'location', 'class' => 'span3', 'editable' => false, 'label' => false));?>
                                
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button> 
                            <button type="clear" class="btn">Cancel</button>
                        </div> <!-- /form-actions -->
                    </fieldset>
                    </div>
<!--                    <div class="span6">
                        <div id="loc_canvas" style="width:450px; height: 320px;"></div>
                        <h3>Location</h3>
                        <p>Value </p>
                    </div>-->
                </form>

            </div> <!-- /widget-content -->
            </div> <!-- /widget -->			
        </div> <!-- /spa12 -->
      </div> <!-- /row -->
           
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>

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
</div>