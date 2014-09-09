$(document).ready(function(){

	var check = 0;

	$('#insert_attr_btn_2').click(function(){
		//console.log(options);
		check+=1;

		$('#attr_hide').show();
		var tbody = $('#attr_add');
		var tr = $('<tr></tr>');
		tbody.append(tr);

		var td = $('<td></td>');
		tr.append(td);
		td.html('<input class="span2" type="text" name="data[InventoryAttribute][name][]" required>');

		var td = $('<td></td>');
		tr.append(td);
		td.html('<input class="span4" type="text" name="data[InventoryAttribute][description][]" required>');

		var td = $('<td></td>');
		tr.append(td);
		td.html(select());

		var td = $('<td></td>');
		tr.append(td);
		td.html('<input class="span1" type="text" name="data[InventoryAttribute][unit][]" required>');

		var td = $("<td></td>");
    tr.append(td);
    td.html("<a class='btn btn-primary btn-danger btn-mini' id='remove_attr_btn_2'><i class='icon icon-minus'></i></a>");
	});

	$("body").on("click","#remove_attr_btn_2", function(e){ //user click on remove text{
    $(this).parent().parent('tr').remove(); //remove text box
    check-=1;
    if (check == 0) {
    	$('#attr_hide').hide();
    };
  });

	function select() {
		//var temp = $('<div></div>');
		var select = $('<select></select>');
		select.append('<option value="">(choose a type)</option>');
		for (i in options) {
			var option = $('<option></option>');
			option.attr('value', i);
			select.append(option);
			option.html(options[i]);
		}
		select.attr('name', 'data[InventoryAttribute][data_type_id][]');
		select.attr('id', 'data_type');
		select.attr('class', 'span3');
		select.attr('required', 'required');
		return select;
	}
});