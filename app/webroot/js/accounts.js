/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
   
    
    var id = 1;
    var url =  config.URL + 'accounts/branchlist/' + id;
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'JSON',
        success: function (data, textStatus, jqXHR) {
            
            
        }
    });
    
//    function get_outlet_distribution() {
//        return $.ajax({
//            url: url,
//            data: param,
//            dataType: 'JSON'
//        });
//    }
        
//    var outlet_distribution = get_outlet_distribution();
//    outlet_distribution.success(function(distribution_data) { 
//    });
});