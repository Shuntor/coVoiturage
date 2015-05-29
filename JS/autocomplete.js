$(function(){     
      var input = document.getElementById('ville');
      var input2 = document.getElementById('ville2');         
      var autocomplete = new google.maps.places.Autocomplete(input, {
          types: ["(cities)"]
      });                   
      var autocomplete2 = new google.maps.places.Autocomplete(input2, {
          types: ["(cities)"]
      });          
      
      var infowindow = new google.maps.InfoWindow(); 
      
      $("input").focusin(function () {
          $(document).keypress(function (e) {
              if (e.which == 13) {
                  infowindow.close();
                  var firstResult = $(".pac-container .pac-item:first").text();
                  
                  var geocoder = new google.maps.Geocoder();
                  geocoder.geocode({"address":firstResult }, function(results, status) {
                      if (status == google.maps.GeocoderStatus.OK) {
                          $("input").val(firstResult);
                      }
                  });
              }
          });
      });
      
      $("input2").focusin(function () {
          $(document).keypress(function (e) {
              if (e.which == 13) {
                  infowindow.close();
                  var firstResult = $(".pac-container .pac-item:first").text();
                  
                  var geocoder = new google.maps.Geocoder();
                  geocoder.geocode({"address":firstResult }, function(results, status) {
                      if (status == google.maps.GeocoderStatus.OK) {
                          $("input2").val(firstResult);
                      }
                  });
              }
          });
      });
  });