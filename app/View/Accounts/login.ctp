<div class="account-container">
	
	<div class="content clearfix">
		
        <?php echo $this->Form->Create('Account',
                array(
                    'controller' => 'accounts', 
                    'action' => 'login',
                    'inputDefaults' => array('label' => false, 'div' => false))) ;?>
		<!--<form action="#" method="post">-->
		
			<h1>Member Login</h1>		
			
			<div class="login-fields">
				
				<p>Please provide your details</p>
				
				<div class="field">
					<label for="username">Username</label>
					<?php echo $this->Form->input('username', array('type' => 'text', 'placeholder' => 'Username', 'class' => 'login username-field', 'id' => 'username', 'value' => ''));?>
                    <!--<input type="text" id="username" name="data[Account][username]" value="" placeholder="Username" class="login username-field" />-->
				</div> <!-- /field -->
				
				<div class="field">
					<label for="password">Password</label>
                    <?php echo $this->Form->input('password', array('type' => 'password', 'placeholder' => 'Password', 'class' => 'login password-field', 'id' => 'password', 'value' => ''));?>
					<!--<input type="password" id="password" name="data[Account][password]" value="" placeholder="Password" class="login password-field"/>-->
				</div> <!-- /password -->
				
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<span class="login-checkbox">
					<input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
					<label class="choice" for="Field">Keep me signed in</label>
				</span>
				
				<input type="submit" id="login-btn" class="button btn btn-success btn-large" value="Sign In" />
                <!--<button class="button btn btn-success btn-large">Sign In</button>-->
				
			</div> <!-- .actions -->
			
			
		<?php echo $this->Form->end();?>
		<!--</form>-->
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->