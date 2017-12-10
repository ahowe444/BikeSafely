<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Places Searchbox</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 80%;
        margin: 0;
        padding: 0;
      }
      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }
      
       #pac-input-end {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }
      #pac-input-end:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      #target {
        width: 345px;
      }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <?php
      clearstatcache();
      ?>
    <script>
      $(document).ready(function()
      {
        $.get("../../../dbConection/genMarkers.php", function(data) {
        });
      });
    </script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?libraries=places&sensor=false"></script>
  </head>
  <body>
    
    <div id="point-display">
      <label id = 'points'>Points</label>
      <ul id='vertex'></ul>
    </div>
    
    
   <input id="pac-input" class="controls" type="text" placeholder="Starting Position">
   <input id='pac-input-end' class='controls' type = 'text' placeholder='Ending Position'>
  <!-- <input id="pac-input" class="controls" type="text" placeholder="End Destination"> -->
    <div id="map"></div>
      <div>
        <p>Total Distance: <span id="total"></span></p>
    </div>
    <script>
      // This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
      var startingPos;
      var endingPos;
      var bikeLayer = new google.maps.BicyclingLayer();
      var directionsDisplay = new google.maps.DirectionsRenderer({
        draggable: true,
        map: map
      });
      function setStartPos(startPos) {
        //alert(startPos);
        startingPos=startPos;
      }
      function setEndPos(endPos) {
        //alert(endPos);
        endingPos=endPos;
      }
      function initAutocomplete() {
        
        //var directionsDisplay = new google.maps.DirectionsRenderer({
        //  draggable: true,
      //    map: map,
        //});
        var directionsService = new google.maps.DirectionsService;
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -33.8688, lng: 151.2195},
          zoom: 13,
          mapTypeId: 'roadmap'
        });
        
        directionsDisplay.setMap(map);
        
      /*  
        
        calculateAndDisplayRoute(directionsService, directionsDisplay, map);
        //document.getElementById('mode').addEventListener('change', function() {
        //  calculateAndDisplayRoute(directionsService, directionsDisplay);
        //});
        directionsDisplay.addListener('directions_changed', function() {
          computeTotalDistance(directionsDisplay.getDirections());
          alert('test');
          document.getElementById('points').innerHTML = 'Hello World';
          directionsService.route(request, function(){
            var pointsArray = [];
            pointsArray = result.routes[0].overview_path;
            alert(pointsArray.length);
            alert('hell world');
            document.getElementById('saveRoute').innerHTML('Hello World');
          });
        });
        
      */  
      directionsDisplay.addListener('directions_changed', function(){
        computeTotalDistance(directionsDisplay.getDirections());
    /*    if(document.getElementById('saveRoute').innerHTML == 'changed')
        {
          document.getElementById('saveRoute').innerHTML = 'route changed';
        }
        else{
          document.getElementById('saveRoute').innerHTML = 'changed';
          
        }
    */
          alert('hello world');
        });
        bikeLayer = new google.maps.BicyclingLayer();
        bikeLayer.setMap(map);
        
        var trafficLayer = new google.maps.TrafficLayer();
        trafficLayer.setMap(map);
      
        // Create the search box and link it to the UI element.
        var startInput = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(startInput);
        //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        
        var endInput = document.getElementById('pac-input-end');
        var endSearchBox = new google.maps.places.SearchBox(endInput);

        
        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });
        
        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));
            
            setStartPos(place.geometry.location);
            //alert('Hello');
            
            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
          calculateAndDisplayRoute(directionsService, directionsDisplay, map);
        }); 
        
        endSearchBox.addListener('places_changed', function() {
          var places = endSearchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));
            
            setEndPos(place.geometry.location);
            //alert('Hello');
            
            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
          calculateAndDisplayRoute(directionsService, directionsDisplay, map);
        });
        
          //Now going to add markers from xml
        downloadUrl('../../../dbConection/markers.xml', function(data) {
            var xml = data.responseXML;
            var dbmarkers = xml.documentElement.getElementsByTagName('marker');
            var dbMarkersArr = [];
            var i = 0;
            Array.prototype.forEach.call(dbmarkers, function(markerElem) {
              //alert(dbMarkersArr.length);
              dbMarkersArr[i] = markerElem.getAttribute('tags');
              i++;
              //var name = markerElem.getAttribute('name');
              var dbaddress = markerElem.getAttribute('address');
              var dbtype = markerElem.getAttribute("type");
              var dbtags = markerElem.getAttribute('tags');
              var dbpoint = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var dbinfowincontent = document.createElement('div');
              var dbstrong = document.createElement('strong');
              dbstrong.textContent = dbtags;
              dbinfowincontent.appendChild(dbstrong);
              dbinfowincontent.appendChild(document.createElement('br'));

              var dbtext = document.createElement('text');
              dbtext.textContent = dbtags;
              dbinfowincontent.appendChild(dbtext);
              var customLabel = Array();
              var dbicon = customLabel[dbtype] || {};
               // Create a marker for each place.
            //markers.push(new google.maps.Marker({
              //map: map,
              //icon: icon,
              //title: place.name,
              //position: place.geometry.location
            //}));
              var contentString = dbtags;
              var infowindow = new google.maps.InfoWindow({
                content: contentString
              });
              
              var dbmarker = new google.maps.Marker({
                map: map,
                position: dbpoint,
                label: dbicon.label,
                title: "Marker"
              });
              
              dbmarker.addListener('click', function() {
                //infoWindow.setContent(dbinfowincontent);
                infowindow.open(map, dbmarker);
              });
            });
            //alert(dbMarkersArr);
          });

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
          };                                                                                                                                                                                                                                                                                                                                                                
          map.fitBounds(bounds);

      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }
      function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
          dbmarkers[i].setMap(map);
        }
      }
      function clearMarkers()
      {
        setMaponAll(null);
      }

      function doNothing() {}
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer({
          draggable: true,
          map: map,
          panel: document.getElementById('right-panel')
        });
        var bikeLayer = new google.maps.BicyclingLayer();
        bikeLayer.setMap(map);
        directionsDisplay.addListener('directions_changed', function() {
          computeTotalDistance(directionsDisplay.getDirections());
        });
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            displayRoute(pos, 'Albany, NY', directionsService,
            directionsDisplay);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }
      

      
      function setBikeLayer(map)
      {
        bikeLayer.setMap(map);
        alert("Bike Layer Set");
      }
      
      function calculateAndDisplayRoute(directionsService, directionsDisplay, map) {
        var selectedMode = 'BICYCLING';
        //var pointsArray = Array();
        if(startingPos==null)
        {
          directionsService.route({
            origin: {lat: 37.77, lng: -122.447},
            destination: {lat: 37.768, lng: -122.511},
            avoidHighways: true,
            travelMode: 'BICYCLING'
          }, function(response, status) {
            if(status == 'OK') {
              directionsDisplay.setDirections(response);
            } else{
              window.aler("Directions request failed due to " + status);
            }
          });
        }
        else if(endingPos==null)
        {
          directionsService.route({
            origin: {lat: startingPos.lat(), lng: startingPos.lng()},
            destination: {lat: 37.768, lng: -122.511},
            avoidHighways: true,
            travelMode:'BICYCLING'
          }, function(response, status) {
            if(status == 'OK') {
              directionsDisplay.setDirections(response);
            } else{
              window.aler("Directions request failed due to " + status);
            }
          });
        }
        else {
          directionsService.route({
            origin: {lat: startingPos.lat(), lng: startingPos.lng()},
            destination: {lat: endingPos.lat(), lng: endingPos.lng()},
            avoidHighways: true,
            avoidTolls: true,
            travelMode: 'BICYCLING'
          }, function(response, status, result) {
            if(status == 'OK') {
              directionsDisplay.setDirections(response);
              //google.maps.event.addListener(directionsDisplay, 'directions_changed', updateInfo);
              //updateInfo();
              //directionsService.route(request, function(){
              //var pointsArray = [];
              //pointsArray = result.routes[0].overview_path;
              //alert(pointsArray.length);
              //alert('hell world');
              
              //document.getElementById('saveRoute').innerHTML('Hello World');
          //});
            var pointsArray = [];
            pointsArray = response.routes[0].overview_path;
            //alert(pointsArray.length);
            document.getElementById('points').innerHTML = pointsArray[0];
            } else{
              window.aler("Directions request failed due to " + status);
            }
            
          });
          setBikeLayer(map);
          bikeLayer.setMap(map);
        }
        updateInfo();
        
      }
      function updateInfo()
      {
        alert('testing');
        var route = directionsDisplay.getDirections().routes[0];
      
        var pointsArray =[];
        document.getElementById('points').innerHTML = 'hello';
        var pointsArray = route.overview_path;
        alert(pointsArray[0]);
        var ul = document.getElementById("vertex");
        var elems = ul.getElementsByTagName("li");
        for (var i=0; i<elems.length; i++) {
          elems[i].parentNode.removeChild(elems[i]);
        }
        //for (var i = 0; i < points.length; i++) {
        //  var li = document.createElement('li');
        //  li.innerHTML = getLiText(points[i]);
        //  ul.appendChild(li);
        //  alert(getLiText(points[i]));
        //}
      }
      
      function computeTotalDistance(result) {
        var total = 0;
        var myroute = result.routes[0];
        for (var i = 0; i < myroute.legs.length; i++) {
          total += myroute.legs[i].distance.value;
        }
        total = total / 1000;
        document.getElementById('total').innerHTML = total + ' km';
      }
      function saveRoute()
      {
        alert('hello World');
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqgsCPqrBLXru1k8t5tXRcMZnkciOYmFI&libraries=places&callback=initAutocomplete"
         async defer></script>
    <div>
      <button class='btn' value='Save Route' id='saveRoute' onclick='saveRoute()'>Save Route</button>
    </div>
  </body>
</html>