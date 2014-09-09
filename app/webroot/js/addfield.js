$(document).ready(function(){

  $("#InventoryInventoryItemId").change(function() {
    $("table:hidden, a:hidden, #attr:hidden").show();
    var selected = $("#InventoryInventoryItemId").val();
    if (selected == '') {
      $("#select").html('Please select a product type.');
      $('table').hide();
      $('#insert_attr_btn').hide();
      $('#attr').hide();
    } else {
      $("#select").html('A product type has been selected.');
      //$('tbody').show();
    }
    //var options = document.getElementById('InventoryInventoryItemId');
    //var selected = options.options[options.selectedIndex].value;
    //console.log(selected);
    $.ajax({url: '/medifix/inventories/list_attributes', success: function(result){
      var inv = result;
      var temp = $('<div></div>');
      for (i in inv) {
        for (j in inv[i]) {
          if (i == selected) {
            //console.log(j + inv[i][j]);
            var tr = $('<tr></tr>');
            var td = $('<td></td>');
            td.html(inv[i][j] + '<input type="hidden" id="attr_value" name="data[Inventory][inventory_attribute_id][]" value = "'+j+'">');
            tr.append(td);
            var td = $('<td></td>');
            tr.append(td);
            td.html('<input type="text" required id="attr_value" name="data[Inventory][inventory_value_id][]" class="span1">');
            tr.append('<td><a class="btn btn-primary btn-mini btn-danger" id="remove_attr_btn"><i class="icon icon-minus"></i></a></td>');
            temp.append(tr);
          }
        }
      }
      $('tbody#attr_body').html(temp.html());
    }});
  });

  $("body").on("click","#remove_attr_btn", function(e){ //user click on remove text{
    $(this).parent().parent('tr').remove(); //remove text box
  });

  var m = 1;

  $('#insert_attr_btn').click(function() {
    var tbody = $('tbody');
    var tr = $('<tr></tr>');
    tbody.append(tr);

    var td = $('<td></td>');
    tr.append(td);
    td.html('<input type="text" name="data[Inventory][new_attribute][]" required>');

    //var select = $('#InventoryNotes').clone();
    /*select.attr('id', 'InventoryNotes'+i);
    td.html(select);*/
    
    /*var select = $('<select></select>');
    select.attr('class', 'Inventory');
    select.attr('name', 'data[Inventory][inventory_attribute_id][]');
    var options = $('#InventoryNotes').html();
    td.append(select);
    select.html(options);*/

    var td = $('<td></td>');
    //var input = $('#attr_value').clone();
    //input.attr('type', 'text');
    //input.attr('value', '');
    //input.attr('name', '');
    //input.attr('class', 'span1');
    /*input.attr('type', 'text');
    input.attr('name', 'data[Inventory][inventory_value_id][]');
    input.attr('id', 'mdate');*/
    tr.append(td);
    td.html('<input type="text" value="" required id="attr_value" name="data[Inventory][new_value][]" class="span1">');

    var td = $("<td></td>");
    tr.append(td);
    td.html("<a class='btn btn-primary btn-danger btn-mini' id='remove_attr_btn'><i class='icon icon-minus'></i></a>");
  });
});
//var inventory = {"1":{"1":"Blood Weight","2":"Genotype","3":"Blood Group"},"4":{"4":"Weight(Heart)","6":"Genotype(Heart)","7":"Blood Group(Heart)"},"3":{"5":"Weight(Kidney)","8":"Genotype(Kidney)","9":"Blood Group(Kidney)"},"6":{"10":"Weight(Pancreas)","11":"Genotype(Pancreas)","13":"Blood Group(Pancreas)"}};

//[{"id":1,"value":"Blood Weight"},{"id":2,"value":"Genotype"},{"id":3,"value":"Blood Group"},{"id":4,"value":"Weight(Heart)"},{"id":5,"value":"Weight(Kidney)"},{"id":6,"value":"Genotype(Heart)"},{"id":7,"value":"Blood Group(Heart)"},{"id":8,"value":"Genotype(Kidney)"},{"id":9,"value":"Blood Group(Kidney)"},{"id":10,"value":"Weight(Pancreas)"},{"id":11,"value":"Genotype(Pancreas)"},{"id":12,"value":"Blood Group(Pancreas)"}];

//Displays the inventory attribute form field when an item is selected.


//Adds more form fields for inventory attributes

/*var text = ("tholur is a gud girl n tholur has a way of doin tins");
var myName = ("tholur");
var hits=[];
for (var i=0; i<=text.length; i++) {
  if(text[i]==='t'){
    for (var j=i; j>myName.length;j--){
      hits.push(i);
    }
  }
}*/