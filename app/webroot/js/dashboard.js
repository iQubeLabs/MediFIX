/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//console.log(data);
/*for (var i = 0; i < $data.length; i++) {
    var value[i][0] = $data[i]['name'];
    var value[i][1] = $data[i]['quantity'];
};

for (var i = 0; i < value.length; i++) {
  alert(value[i][0]+' '+value[i][1]+'.\n');
};*/
/*for (var i = 0; i < data.length; i++) {
      alert(data[i]['item']+' '+data[i]['quantity']+'.\n');
}*/

if (-1 in data) {
  var inventory_empty_message = '(Inventory is empty)';
} else {
  inventory_empty_message = '';
}

$(document).ready(function() {
        
        $('#inventory_dist_by_type').highcharts({


           chart: {
               plotBackgroundColor: null,
               plotBorderWidth: null,
               plotShadow: false
           },
           title: {
               text: 'Distribution by Product Type '+inventory_empty_message
           },
           tooltip: {
               pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
           },
           plotOptions: {
               pie: {
                   allowPointSelect: true,
                   cursor: 'pointer',
                   dataLabels: {
                       enabled: true,
                       color: '#000000',
                       connectorColor: '#000000',
                       format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                   }
               }
           },
           series: [{
               type: 'pie',
               name: 'Inventory Type',
               data: data/*[
                   {
                      'name': 'Heart',
                      'y': 1
                    },
                   ['Liver', 30],
                   {
                       name: 'Blood',
                       y: 96,
                       sliced: true,
                       selected: true
                   },
                   ['Kidney',    45],
                   ['Blood Vessels',     15],
                   ['Pancreas',   25]
               ]*/
           }]
       });

       $('#inventory_dist_by_location').highcharts({
           chart: {
               type: 'bar'
           },
           title: {
               text: 'Top 10 Demanding Locations'
           },
           xAxis: {
               categories: ['Lagos', 'Enugu', 'Abuja', 'Taraba', 'Ondo', 'Ekiti', 'Sokoto', 'Kaduna', 'Abia', 'Ebonyi']
           },
           yAxis: {
               title: {
                   text: 'Locations'
               }
           },
           series: [{
               name: 'Kidney',
               data: [7, 6, 15, 9, 3, 9, 3, 9, 3, 19]
           }, {
               name: 'Blood',
               data: [18, 25, 28, 11, 8, 9, 3, 9, 3, 23]
           }]
       });
 });

 function initialize() {
    var point = new google.maps.LatLng(9.06148, 8.512906);
    var mapOptions = {
      center: point,
      /* Alternatively
      center: {lat: 9.06148, lng: 7.512906}
      center: {lng: 7.512906, lat: 9.06148} */
      zoom: 6,
      scrollwheel: false
    };
    var map = new google.maps.Map(document.getElementById("inventory_map_canvas"),
        mapOptions);

    //point marker.
    var lagos = {lat: 6.5833, lng: 3.7500};
    var marker = new google.maps.Marker({
        position: lagos,
        title: 'Lagos'
    });
    marker.setMap(map);
  }

  google.maps.event.addDomListener(window, 'load', initialize);

 