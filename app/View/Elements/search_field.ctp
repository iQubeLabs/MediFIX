<script type="text/javascript">
	var productType = <?php echo json_encode($product_type) ?>;
	var productAttribute = <?php echo json_encode($product_attribute) ?>;
</script>

<div id='search' class = 'container' style='width:56%; display:none'>
	<?php echo $this->Form->Create('Inventory',
            array(
            	'controller' => 'inventories',
            	'action' => 'search',
            	'class' => 'form-horizontal')) ;?>
	<!-- <a class='btn btn-primary btn-mini' style='display:none' id='insert_search_btn'><i class='icon icon-plus'></i>Add More Search Options</a> -->
	<div id='search_add' class='table table-striped'>
		<!-- <p>
		<select class="search_option" name="data[Inventory][search_option][]"><option value="">(choose a search option)</option><option value="1">Product Type</option><option value="2">Product Attribute</option><option value="3">Month</option></select>
		<span><input type="text" name="data[Inventory][value][]"></span>
		<a class="btn btn-primary btn-danger btn-mini" id="remove_search_btn"><i class="icon icon-minus"></i></a>
		</p>

		<p>
		<select class="search_option" name="data[Inventory][search_option][]"><option value="">(choose a search option)</option><option value="1">Product Type</option><option value="2">Product Attribute</option><option value="3">Month</option></select> 
		<span><input type="text" name="data[Inventory][value][]"></span>
		<a class="btn btn-primary btn-danger btn-mini" id="remove_search_btn"><i class="icon icon-minus"></i></a>
		</p> -->
	</div>
	<button type="submit" class="btn btn-primary">Search</button> 
	<?php echo $this->Form->end(); ?>
</div>