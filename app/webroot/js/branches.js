/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var latlong = '';
        
function initializeloc() {
    var locmapOptions = {
        zoom: 5,
        center: new google.maps.LatLng(9.061478, 7.512906),
        zoomControl: true,
        scrollwheel: false
    };
    var locmap = new google.maps.Map(document.getElementById("loc_canvas"),
        locmapOptions);

    google.maps.event.addListener(locmap, 'click', function(event) {
        latlong = event.latLng.lat() + ', ' + event.latLng.lng();
        $('#geolocation').val(latlong);
        window.setTimeout(function() {
            locmap.panTo(event.latLng);
          }, 3000);

    });
}

google.maps.event.addDomListener(window, 'load', initializeloc);
  
$(document).ready(function(){
    
    $('#fac').dataTable({
        "paging":   true,
        "ordering": true,
        "info":     true
     });
     
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
    
    //$('#branches').dataTable();
            
});