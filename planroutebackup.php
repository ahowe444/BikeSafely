<?php
  //header("Location: ../../../dbConection/genMarkers.php");
  //header("Location: ./PlanaRoute.php");
  //echo "<script type = 'text/javascript'>alert('Hello World');</script>";
?>
<!DOCTYPE html>
<!-- Template by Quackit.com -->
<!-- Images by various sources under the Creative Commons CC0 license and/or the Creative Commons Zero license. 
Although you can use them, for a more unique website, replace these images with your own. -->
<html lang="en">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>BikeSafe</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet"> 

    <!-- Custom CSS: You can use this stylesheet to override any Bootstrap styles and/or apply your own styles -->
    <link href="css/custom.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom Fonts from Google -->
    <link href="https://fonts.googleapis.com/css?family=Lobster|Montserrat|Raleway" rel='stylesheet' type='text/css'>
    <!-- Load XML Markers -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <?php
      clearstatcache();
      ?>
    <!-- <script>
       $(document).ready(function(){
        $.get( "../../../dbConection/genMarkers.php", function( data ) {
        });
      });
      
    </script> -->
    <script>
      $(document).ready(function()
      {
        $.get("./genMarkers.php", function(data) {
        });
      });
    </script>
    <script src="http
    s://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
      $.ajax({
        url: 'PlanaRoute.php',
        success: function(data) {
          if (data == "refresh"){
            window.location.reload(); // This is not jQuery but simple plain ol' JS
          }
        }
      });
    </script>
    <style>
      #map {
        height: 10
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
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

      #pac-input:focus {
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
      body {
        margin-right:5%;
      }
      #submit{
        background-color:yellowgreen;
        color:white;
        border-radius:25px;
      } 
      #saveForm{
        position:relative;
        left:40%;
        
      } 
      #textbar{
        position:relative;
        right:5%; 
        border-radius:25px; 
        margin-bottom:.5%;
        margin-top:.5%;
      }
      .w3-justify, #id-sub1, #id-sub2, #id-sub3{
        font-family:Montserrat, sans-serif;
      }
      
    
      
    </style>
    </style>
</head>
<body>
  
  
  
   <!-- Navigation -->
    <nav id="siteNav" class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Logo and responsive toggle -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="logo">
                    <a class="navbar-brand" href="index.php">
                        <span class="logo">BikeSafe</span>

                    </a>
                </div>
            </div>
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="PlanaRoute.php">Plan A Route</a>
                    </li>
                    <li>
                        <a href="PastRoutes.php">Past Routes</a>
                    </li>
                    <li>
                        <a href="./connFiles/LoginMaterials/logout.php">Logout</a>
                    </li>
      

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
  

    <div class="mySlides w3-display-container w3-center">
        <img src="/images/addmarkers.jpg" style="width:80%">
        <div class="w3-display-bottommiddle w3-container w3-text-black w3-padding-32 w3-hide-small">
            <h3>Cycling Safety</h3>
            <p><b>Become a safer cyclist!</b></p>
        </div>
    </div>
    <div class="mySlides w3-display-container w3-center">
        <img src="/images/squad.jpg" style="width:80%">
        <div class="w3-display-bottommiddle w3-container w3-text-black w3-padding-32 w3-hide-small">
            <h3>More enjoyable bike rides</h3>
            <p><b>User input is available to improve bike enjoyment factor.</b></p>
        </div>
    </div>
    <div class="mySlides w3-display-container w3-center">
        <img src="/images/path.jpg" style="width:80%">
        <div class="w3-display-bottommiddle w3-container w3-text-black w3-padding-32 w3-hide-small">
            <h3>Easy route planning.</h3>
            <p><b>Maps and past routes are accessible.</b></p>
        </div>
    </div>

    <!-- The Map Section -->
    <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
        <br>
        <br>
        <h2 id = 'past_route_title' class="w3-wide">Let's Build A Great, Safe Route</h2>
        <p class="w3-opacity"><i>We love bike safety!</i></p>
        <p class="w3-justify">We have created a website to provide a service to cyclists with the ultimate goal of making rides safer. Through the use of user inputted tags, we will generate routes that have been determined to be safe by cyclists themselves.</p>
        <div class="w3-row w3-padding-32">
        </div>
    </div>


        


    <!-- End Page Content -->
    <!-- Add Google Maps -->
  <div>
     <input id="pac-input" class="controls" type="text" placeholder="Starting Position">
     <button class='btn' id='currentLocation'>Starting at Current Location?</button>
  </div>
  <div>
     <input id='pac-input-end' class='controls' type = 'text' placeholder='Ending Position'>
     <label id='points'></label>
     <button class='btn'  id='saveRoute'>Save Route</button>
  </div>
  <iframe name='testframe' style='display:none'></iframe>
  <div id='saveFormDiv' class='modal'>
    <div class='modal-content'>
      <span class='close'>&times;</span>
      <form id='saveForm' action='saveRoute.php' method = 'post' target='testframe'>
        Route Name: <br>
          <input type = 'text' name = 'routeName' placeholder ='Route Name'></input> <br>
          <input type ='submit' name='saveSubmit' value='Submit'></input>
          <input id= 'routeDistForm' type ='hidden' name='routeDist' value=''></input>
          <input id='routeWaypts' type='input' name='routeWaypts' value=''></input>
      </form>
    </div>
  </div>
  <style>
    .btn{ 
      background:yellowgreen;
      color:white;
        }
        .btntwo{ 
      background:yellowgreen;
      color:white;
      margin-top: 2.5%;
      margin-left: 5%;
      border-radius:20%;
      border-radius: 300px;
    text-transform: uppercase;

        }
    
    #pac-input, #pac-input-end{
      border-radius:25px; 
    } 
    
    #pac-input-end, #saveRoute{ 
      position:relative;
      left:3%;
      margin-bottom:1%;
    }
    #pac-input, #currentLocation{
      position:relative;
      left:2%;
      margin-bottom:.5%;
      
    }
    #pac-input-end{ 
      width:28%;
      margin-top:1%;
      padding-left:1%;
    } 
    
    #printdir{
      position:relative;
      left:3%;
      margin-top:1%;
    }

    
  </style>
  </style>
  <!-- <input id="pac-input" class="controls" type="text" placeholder="End Destination"> -->
    <div id="map" style="height:600px; margin-left: 50px; margin-right: 50px"></div>
<!--     <input id="printdir" class = 'btn' type="button" onclick="printDiv('print-content')" value="Print Directions"/>
      <div id='print-content'>
        <form>
          <div id="directionsPanel"></div>
        </form>
    </div> -->
    <div id = 'directionsPanel'>
      
    </div>
    <script>
      var modal = document.getElementById('saveFormDiv');
      var saveBtn = document.getElementById('saveRoute');
      var span = document.getElementsByClassName('close')[0];
      
      saveBtn.onclick = function() {
        modal.style.display='block';
      };
      span.onclick = function() {
        modal.style.display='none';
      };
      
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
        
        directionsDisplay = new google.maps.DirectionsRenderer({
          draggable: true,
          map: map,   });
          
        var directionsService = new google.maps.DirectionsService;
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 43.073454, lng: -73.799095},
          zoom: 13,
          mapTypeId: 'roadmap'
        });
        
        directionsDisplay.setMap(map);
        
      directionsDisplay.addListener('directions_changed', function(){
        computeTotalDistance(directionsDisplay.getDirections());
        updateInfo(directionsDisplay.getDirections());

          //updateInfo();
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
        downloadUrl('./markers.xml', function(data) {
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
            } else{
              window.aler("Directions request failed due to " + status);
            }
            
          });
          setBikeLayer(map);
          bikeLayer.setMap(map);
        }
        //updateInfo();
        
      }
      function updateInfo(result)
      {
        var route = result.routes[0];
        var pointsArray =[];
        //document.getElementById('points').innerHTML = 'hello';
        pointsArray = route.overview_path;
        alert('points Array is ' + pointsArray.length + ' long');
        document.getElementById('routeWaypts').value = '';
        document.getElementById('points').innerHTML = '';
        for(var i = 0; i<pointsArray.length; i++)
        {
          document.getElementById('points').innerHTML = document.getElementById('points').innerHTML + " *** " + pointsArray[i];
          document.getElementById('routeWaypts').value = document.getElementById('routeWaypts').value + pointsArray[i];
        }
      }
      
      function computeTotalDistance(result) {
        var total = 0;
        var myroute = result.routes[0];
        for (var i = 0; i < myroute.legs.length; i++) {
          total += myroute.legs[i].distance.value;
        }
        total = total / 1000;
        total = total * .621371;
        document.getElementById('total').innerHTML = total + ' mi';
        document.getElementById('routeDistForm').value = total;
      }
      /*function printDiv(divName) {

        var printContents = document.getElementById(divName).innerHTML;
        w=window.open();
        w.document.write(printContents);
        w.print();
        w.close();
      } */
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqgsCPqrBLXru1k8t5tXRcMZnkciOYmFI&libraries=places&callback=initAutocomplete"
         async defer></script>
    <!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqgsCPqrBLXru1k8t5tXRcMZnkciOYmFI&callback=myMap"></script>
    <!--
To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->
    <script>
        // Automatic Slideshow - change image every 4 seconds
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) {
                myIndex = 1;
            }
            x[myIndex - 1].style.display = "block";
            setTimeout(carousel, 4000);
        }
        
        
        
    </script>






    <!-- jQuery -->
    <script src="js/jquery-1.11.3.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

    <!-- Custom Javascript -->
    <script src="js/custom.js"></script>

</body>

</html>