<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

//$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>MediFIX - Dashboard</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel='icon' type='image/png' href="/medifix/img/favicon.png" />
        
        <?php echo $this->Html->css('bootstrap.min'); ?>
        <?php echo $this->Html->css('bootstrap-responsive.min'); ?>
        
        <?php echo $this->Html->css('http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600',
                array("fullBase" => true));?>
        
        <?php echo $this->Html->css('font-awesome.min'); ?>
        
        <?php echo $this->Html->css('style'); ?>
        
        <?php echo $this->Html->css('medifix'); ?>
        
        <?php echo $this->Html->css('pages/dashboard'); ?>
        
        <!--Creating Facility-->
        <?php echo $this->Html->css('/js/color-picker/css/colpick'); ?>
        
        <?php echo $this->Html->css('jquery.dataTables'); ?>
        
        <?php echo $this->Html->css('/js/bootstrap-datepicker/css/datepicker3'); ?>
        
        <!--<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">-->
        
<!--        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
                rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/pages/dashboard.css" rel="stylesheet">-->
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
              <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->
</head>
<!--<html>
<head>
	<?php // echo $this->Html->charset(); ?>
	<title>
		<?php // echo $cakeDescription ?>:
		<?php // echo $title_for_layout; ?>
	</title>
	<?php
//		echo $this->Html->meta('icon');
//
//		echo $this->Html->css('cake.generic');
//
//		echo $this->fetch('meta');
//		echo $this->fetch('css');
//		echo $this->fetch('script');
	?>
</head>-->


<body>
	
    <!--Top Navigation bar-->
    <?php echo $this->element('navigation_bar'); ?>
    
    <!--Sub Navigation Bar - Menu-->
    <?php echo $this->element('sub_navigation_bar'); ?>

    <!-- Search Field -->
    <?php echo $this->element('search_field'); ?>
    
    <?php echo $this->fetch('content'); ?>
    
    <?php // echo $this->element('footer_extra'); ?>
    
    <?php echo $this->element('footer'); ?>
    
    <?php echo $this->element('sql_dump'); ?>
    
    
    <!-- Placed at the end of the document so the pages load faster --> 
    <?php echo $this->Html->script('jquery-1.7.2.min');?>
    <!--<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>-->
    
<!--    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>-->
    
    <?php echo $this->Html->script('bootstrap');?>
    <?php echo $this->Html->script('excanvas.min');?>
    <?php echo $this->Html->script('chart.min');?>
    <?php echo $this->Html->script('search_field');?>
    
      
    
    <?php echo $this->Html->script('full-calendar/fullcalendar.min');?>
    
    <?php echo $this->Html->script('base');?>
    
    <?php echo $this->Html->script('jquery.dataTables');?>
    
    
    
    
    <?php echo $this->Html->script('/js/color-picker/js/colpick'); ?>
    
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSL0XtmKDGpC6aW2Khv64f7JD66ZMDbqI&sensor=false">
    </script>
    
    <?php echo $this->Html->script('init');?>

    <?php if(isset($module_action) && $module_action == 'branch_add_edit'): ?>
        
        <?php echo $this->Html->script('branches');?>
    
    <?php elseif(isset($module_action) && $module_action == 'dashboard'): ?>
    
        <?php echo $this->Html->script('highcharts_3.0.10/js/highcharts');?>
        <?php echo $this->Html->script('dashboard');?>
    
    <?php elseif(isset($module_action) && $module_action == 'inventory'): ?>
        
        <?php echo $this->Html->script('bootstrap-datepicker/js/bootstrap-datepicker');?>
        <?php echo $this->Html->script('inventories');?>
        <?php echo $this->Html->script('addfield'); ?>
        <?php echo $this->Html->script('attr_field'); ?>
    
    <?php elseif(isset($module_action) && $module_action == 'facility_create'): ?>
    
        <?php echo $this->Html->script('branches');?>
    
    <?php endif; ?>
    
</body>
</html>
