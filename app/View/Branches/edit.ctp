<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
	      	
        <div class="span12">

            
            <div class="widget">

                <div class="widget-header">
                    <i class="icon-group"></i>
                    <h3>Branches</h3>
                </div> <!-- /widget-header -->

            <div class="widget-content">
                
                <h2>Edit New Branch</h2>
                <hr />
                
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Session->flash('auth'); ?>
                
                <?php echo $this->Form->Create('Branch',
                array(
                    'controller' => 'branches', 
                    'action' => 'edit', 'class' => 'form-horizontal')) ;?>

                <div class="span6">
                    <fieldset>
                        
                        <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
                        
                        <div class="control-group">											
                            <label class="control-label" for="medical_facility">Medical Facility</label>
                            <div class="controls">
                                <?php echo $this->Form->select('medical_facility_id', $facility_list, array('class' => 'span3', 'id' => 'medical_facility'));
                            ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
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
                                <?php echo $this->Form->input('geolocation', array('type' => 'text', 'id' => 'location', 'class' => 'span3', 'label' => false));?>
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
                            <a class = 'btn btn-primary btn-danger' href="/medifix/branches/">Cancel</a>
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