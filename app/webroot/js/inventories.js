/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    
    $('#picker').colpick({
            layout:'hex',
            submit:0,
            onChange:function(hsb,hex,rgb,el,bySetColor) {
                $(el).css('border-color','#'+hex);
                // Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
                if(!bySetColor) $(el).val(hex);
            }
        }).keyup(function(){
            $(this).colpickSetColor(this.value);
    });
    
    $('#attributes').dataTable();

    $('#manufactured_date .input-append.date').datepicker({
        weekStart: 1,
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd'
    });
    $('#expiry_date .input-append.date').datepicker({
        weekStart: 1,
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd'
    });

     removeAttributeRow();

    function insertNewAttributeRow(responseData) {
        var lastTr = $('#inv_attr_data tbody tr:last');
        var sn = $(lastTr).find('td:first');
        var next_sn = parseInt(sn.html()) + 1;
        

        var html = '<tr>';
        html += '<td>' + next_sn + '</td>';

        html += '<td>';
        html += '<select name="data[Inventory][inventory_attribute_id][]" class="span3" id="InventoryInventoryItemId">';

        html += '<option value="-1">(Choose one)</option>';

        for (var i = 0; i < responseData.length; i++) {
            html += '<option value="' + responseData[i].id + '">' + responseData[i].value + '</option>';
        };

        html += '</select>';
        html += '</td>';
        
        html += '<td>';
        html += '<input type="text" id="mdate" name="data[Inventory][inventory_value_id][]" class="span1">';
        html += '</td>';
        
        html += '<td>';
        html += '<a class="btn btn-danger btn-mini remove_attr" data-toggle="tooltip" title="Delete">'
        html += '<i class="btn-icon-only icon-trash"></i>';
        html += '</a>'
        html += '</td>';
        html += '</tr>';

        $('#inv_attr_data tbody').append(html);

        //remove attribute when clicked.
        removeAttributeRow();

        console.log(next_sn);
        // console.log(value);
    }

    function removeAttributeRow() {

        $('.remove_attr').on('click', function(){
            $(this).parent().parent().remove();
        });
    }

    $('#insert_attr_btn').on('click', function(){

        var url = config.URL + 'inventories/list_attributes';
        $.ajax({
            url: url,
            // data: param,
            dataType: 'JSON',
            success: function(data) {
                console.log('successully loaded attributes');
                insertNewAttributeRow(data);
            }
        });
    });
});