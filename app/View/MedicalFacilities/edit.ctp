<div class="main">
  <div class="main-inner">
    <div class="container">
                        
        <?php echo $this->Form->Create('MedicalFacility',
            array(
                'controller' => 'facilities', 
                'action' => 'edit', 'class' => 'form-horizontal')) ;?>
        
      <div class="row">
	      	
        <div class="span12">

            
            <div class="widget">

                <div class="widget-header">
                    <i class="icon-group"></i>
                    <h3>Medical Facilities</h3>
                </div> <!-- /widget-header -->

            <div class="widget-content">
                
                <h2>Edit Medical Facility</h2>
                <hr />
                
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Session->flash('auth'); ?>

                <div class="span6">
                    <fieldset>
                        
                        <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
                        
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
                    </fieldset>
                </div>
                <div class="clearfix"></div>
                
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