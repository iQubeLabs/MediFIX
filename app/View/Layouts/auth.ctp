<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>MediFIX - Login</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"> 
    
    <?php echo $this->Html->css('bootstrap.min');?>
    <?php echo $this->Html->css('bootstrap-responsive.min');?>
    <?php echo $this->Html->css('font-awesome');?>
    <?php echo $this->Html->css('http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600',
            array("fullBase" => true));?>
    
    <?php echo $this->Html->css('style');?>
    <?php echo $this->Html->css('pages/signin');?>
    
    <?php echo $this->Html->css('medifix.css');?>
    
</head>

<body>
	
	
    

    <div class="account-login-header">
        <?php echo $this->Html->image('medifix_login.png'); ?> 
        
        <!--Session flash messages-->
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->Session->flash('auth'); ?>
    </div>
    
    <?php echo $this->fetch('content'); ?>
    

    <!--Javascript includes-->
    <?php echo $this->Html->script('jquery-1.7.2.min');?>
    <?php echo $this->Html->script('bootstrap');?>
    <?php echo $this->Html->script('signin');?>

</body>

</html>
