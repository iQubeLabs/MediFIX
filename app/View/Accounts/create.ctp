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
                <?php if ($current_user['AccountType']['name'] == 'Super Admin'): ?>
                <h2>Create New Account</h2>
              	<?php else: ?>
              	<h2>Create Facility Staff Account</h2>
              	<?php endif; ?>
                <hr />
                
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Session->flash('auth'); ?>
                
                <?php echo $this->Form->Create('Account',
                array(
                    'controller' => 'accounts', 
                    'action' => 'create', 'class' => 'form-horizontal')) ;?>
                <!--<form id="edit-profile" class="form-horizontal">-->
                    
                    <fieldset>
<!--                        <div class="control-group">											
                            <label class="control-label" for="username">Username</label>
                            <div class="controls">
                                <input type="text" class="span6 disabled" id="username" value="Example" disabled="">
                                <p class="help-block">Your username is for logging in and cannot be changed.</p>
                            </div>  /controls 				
                        </div>  /control-group -->
                        <div class="control-group">											
                            <?php if ($current_user['AccountType']['name'] == 'Super Admin'): ?>
                            <label class="control-label" for="email">Facility</label>
                            <div class="controls">
                            <?php	echo $this->Form->select('medical_facility_id', $medical_facility_list, array('class' => 'span3')); ?>
                            </div> <!-- /controls -->				
                            <?php else:
                            	echo $this->Form->input('medical_facility_id', array('value' => $current_user['Branch']['medical_facility_id'], 'type' => 'hidden', 'label' => false));
                            endif;
                            ?>
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">		
                        	<?php if ($current_user['AccountType']['name'] == 'Super Admin'): ?>
                            <label class="control-label" for="email">Branches</label>
                            <div class="controls">
                            <?php	echo $this->Form->select('branch_id', $branches_list, array('class' => 'span3')); ?>
                            </div> <!-- /controls -->
                            <?php else:
                            	echo $this->Form->input('branch_id', array('value' => $current_user['Branch']['id'], 'type' => 'hidden', 'label' => false));
                            endif;
                            ?>
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="username">Username</label>
                            <div class="controls">
                                <?php echo $this->Form->input('username', array('type' => 'text', 'id' => 'username', 'class' => 'span3', 'label' => false));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="password">Password</label>
                            <div class="controls">
                                <?php echo $this->Form->input('password', array('type' => 'password', 'id' => 'password', 'class' => 'span3', 'label' => false));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="confirm_password">Confirm Password</label>
                            <div class="controls">
                                <?php echo $this->Form->input('confirm_password', array('type' => 'password', 'id' => 'password', 'class' => 'span3', 'label' => false));?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">
                            <label class="control-label" for="email">Account Type</label>
                            <div class="controls">
                       		<?php if ($current_user['AccountType']['name'] == 'Super Admin'): ?>
                            <?php echo $this->Form->select('account_type_id', $account_type_list, array('class' => 'span3')); ?>
                            <?php else:
                                echo $this->Form->select('account_type_id', $account_type_list_branch, array('class' => 'span3'));
                            endif;
                            ?>      
                            </div> <!-- /controls -->
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label">Activate Account</label>

                            <div class="controls">
                            <label class="checkbox inline">
                              <input type="checkbox" name="data[Account][active]" checked="true" value="checked">
                              User will be activated automatically when account is created
                            </label>
                          </div>		<!-- /controls -->		
                        </div> <!-- /control-group -->
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button> 
                            <a class="btn btn-primary btn-danger" href = '/medifix/accounts/'>Cancel</a>
                        </div> <!-- /form-actions -->
                    </fieldset>
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

<script type="text/javascript">
    
    
</script>