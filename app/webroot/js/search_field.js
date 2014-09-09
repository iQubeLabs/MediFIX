var chk;
productType;
productAttribute;
var month = [1,2,3,4,5,6,7,8,9,10,11,12];
var selected = 1;

$(document).ready(function(){

	$('body').on('change', '.search_option', function(e) {
		//alert('am here');
		var s = $(this).val();
		var position = $(this).parent().index();

		console.log(s);
		console.log(position);

		var select = $('<select name="data[Inventory][type][]"></select>');
		if (s == 1) {
			select.append('<option value="">select product type</option>');
			for (value in productType) {
				var option = $('<option></option>');
				option.attr('value', value);
				select.append(option);
				option.html(productType[value]);
			}
			$($('.search_option')[position]).siblings('input').remove();
		}

		else if (s == 2) {
			select = $('<select name="data[Inventory][attribute][]"></select>');
			select.append('<option value="">select product attribute</option>');
			for (value in productAttribute) {
				var option = $('<option></option>');
				option.attr('value', value);
				select.append(option);
				option.html(productAttribute[value]);
			}
			//$($('.search_option')[position]).siblings('input').remove();
			$($('.search_option')[position]).next().after('\n' + '<input type="text" class="span1" name="data[Inventory][value][]" />');
		}

		else if (s == 3) {
			select = $('<select name="data[Inventory][month][]"></select>');
			select.append('<option value="">select month</option>');
			for (i = 0; i < month.length; i++) {
				var option = $('<option></option>');
				option.attr('value', i+1);
				select.append(option);
				option.html(month[i]);
			}
			$($('.search_option')[position]).siblings('input').remove();
		} else {
			select.html('<option></option>');
			$($('.search_option')[position]).siblings('input').remove();
		}

		$($('.search_option')[position]).next().html(select);
	});

	chk = 0;

	$('#search_field_btn').click(function(){
		chk++;
		$('#search').show();
		$('#search_field_btn').html('<i class="shortcut-icon icon-plus"> Add more search options</i>');
		//$('#search_table').show();
		//$('#insert_search_btn').show();
		var div = $('#search_add');
		var p = $('<p></p>');
		div.append(p);
		p.append('<select class="search_option"><option value="">(choose a search option)</option><option value=1 >Product Type</option><option value=2>Product Attribute</option><option value=3>Month</option></select>');
		p.append('\n' + '<span><input type = "text" name="data[Inventory][value][]"></span>');
    	p.append('\n' + "<a class='btn btn-primary btn-danger btn-mini' id='remove_search_btn'><i class='icon icon-minus'></i></a>");
	});

	$("body").on("click","#remove_search_btn",function(e){ //user click on remove text{
    $(this).parent().remove(); //remove text box
    chk--;
	    if (chk == 0) {
	    	$('#search_field_btn').html('<i class="shortcut-icon icon-search"> Search</i>');
	    	//$('#search_add').hide();
	    	$('#search').hide();
	    }
	});
});

	/*$('#insert_search_btn').click(function(){
		var tbody = $('#search_add');
		var trw = $('<tr></tr>');
		tbody.append(tr);
		trw.append('<td style="text-align:center"><select></select></td>');
		trw.append('<td style="text-align:center"><select></select></td>');
	    trw.append("<td><a class='btn btn-primary btn-danger btn-mini' id='remove_search_btn'><i class='icon icon-minus'></i></a></td>");
	});*/