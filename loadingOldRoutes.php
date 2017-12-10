<?php
  require('./connFiles/LoginMaterials/dbcredentials.php');
    session_start();
    $conn = mysqli_connect($host, $username, $password, $database, $port);
    if (!$conn) {
        die('not connected : ' . mysql_error());
    }
        $tags = "";
    $tagNameArray = array(
        "bathroom", "gradualHill", "infrequentTraffic", 
        "largeShoulder", "longStraightRoad", "peaceful",
        "scenic", "separateBikeLane", "shady",
        "waterFood", "windingRoad", "deadEnd",
        "noAlternativeRoutes", "steep", "blindTurn",
        "crackedSurface", "dangerousIntersection", "fallingRockZone",
        "flatTireHazard", "gravelOrCobblestone", "heavyCrossTraffic",
        "highSpeedLimit", "insects", "noShoulder",
        "potholes", "railroadCrossing", "recklessDrivers",
        "roadConstruction", "sandyMuddy", "slippery", "truckTraffic");
    $textTagArray = array(
        "Bathroom", "Gradual Hill", "Infrequent Traffic", 
        "Large Shoulder", "Long Straight Road", "Peaceful",
        "Scenic", "Separate Bike Lane", "Shady",
        "Water/Food", "Winding Road", "Dead End",
        "No Alternative Routes", "Steep", "Blind Turn",
        "Cracked Surface", "Dangerous Intersection", "Falling Rock Zone",
        "Flat Tire Hazard", "Gravel or Cobblestone", "Heavy Cross Traffic",
        "High Speed Limit", "Insects", "No Shoulder",
        "Potholes", "Railroad Crossing", "Reckless Drivers",
        "Road Construction", "Sandy/Muddy", "Slippery", "Truck Traffic");
    
    $route_query = "select route_id, route_name FROM past_routes, cust_info WHERE past_routes.cust_id=cust_info.id and email='" . $_SESSION['email'] . "'";
    $result = mysqli_query($conn, $route_query);
    if(!$result) {
      die('invalid query: ' . mysql_error());
    }
    $numRoutes = 0;
    $route_names = array();
    $route_ids = array();
    while($row = $result->fetch_assoc()) {
      $route_names[$numRoutes] = $row['route_name'];
      $route_ids[$numRoutes] = $row['route_id'];
      $numRoutes++;
    }
    
    if(isset($_POST['submit']))
    {
        for($i = 0; $i<count($tagNameArray); $i++)
        {
            if(isset($_POST[$tagNameArray[$i]]))
            {
                $tags.= " " . $textTagArray[$i];
            }
        }
        $lat = $_POST['markerLat'];
        $lng = $_POST['markerLng'];
        $email = $_SESSION['email'];
        $query = "INSERT INTO 'markers' (lat, lng, tags, email) VALUES ('$lat', '$lng', '$tags', '$email')";
        $result = mysqli_query($conn, $query);
        if(!$result)
        {
            die("Invalid query: " . mysql_error());
        }
    }
    $test = 'test';
  //Loading waypoints
    $lat_array = array();
    $lng_array = array();
    if(isset($_SESSION['routeID']))
    {
      $routeID = $_SESSION['routeID'];
      //echo "<script>alert('Route ID = " . $_SESSION['routeID'] . "')</script>";
      $routeID = trim($routeID);
      $wayptQuery = "SELECT lat, lng from waypoints, past_routes WHERE waypoints.route_id = past_routes.route_id and past_routes.route_id ='" . $routeID . "';";
      $wayptResult = mysqli_query($conn, $wayptQuery);
      if(!$wayptResult)
      {
        die('invalid Query: ' . mysql_error());
      }
      $lat_array = array();
      $lng_array = array();
      $index = 0;
      while($row = $wayptResult->fetch_assoc())
      {
        $lat_array[$index] = $row['lat'];
        $lng_array[$index] = $row['lng'];
        $index++;
      }
    }
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
    <script>
      $(document).ready(function()
      {
        $.get("./v2_genMarkers.php", function(data) {
        });
        
      });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
      $.ajax({
        url: 'https://bikesafe-final-peteherman.c9users.io/HTML/Home%20Page/business-2/loadingOldRoutes.php',
        success: function(data) {
          if (data == "refresh"){
            window.location.reload(); 
          }
        }
      });
    </script>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      .btn-calc {
        background-color:yellowgreen;
        color: white;
      }
      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }
      #routeTableLabel {
        text-align:center;
        color:white;
        font-size:20px;
        margin-left:39%;
        width:20%;
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
      #routeTable{
        background-color: yellowgreen;
        color: white;
        width: 70%;
        margin-left:15%;
        margin-right:auto;
      }
      .btnregister {
        float: center;
       
            }
            .btninfoWin {
              float : right;
              margin-left: 15%;
              padding: 10px 10px;
              color:white;
              background-color: yellowgreen;
              border-radius: 300px;
              text-transform: uppercase;
            }
            .btn {
              float : center;
              margin-left: 45%;
              padding: 20px 20px;
              padding-bottom: 20px;
              color:yellowgreen;
              background-color: white;
              border-radius: 300px;
              text-transform: uppercase;
            }
    </style>
</head>
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
                        <a href="backupplan2.php">Plan A Route</a>
                    </li>
                    <li>
                        <a href="loadingOldRoutes.php">Past Routes</a>
                    </li>
                    <li>
                        <a href="./connFiles/LoginMaterials/logout.php"> Logout</a>
                    </li>
                    <!-- <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services <span class="caret"></span></a>
						<!-- <ul class="dropdown-menu" aria-labelledby="about-us">
							<li><a href="#">Engage</a></li>
							<li><a href="#">Pontificate</a></li>
							<li><a href="#">Synergize</a></li> 
						</ul> 
					</li> -->
                    <!--<li>
                        <a href="#">Contact</a>
                    </li>
                    
                </ul>-->

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
    <iframe name='testFrame' style="display:none;"></iframe>
    <div id='routeTable'>
       <label id = 'routeTableLabel'>Past Routes:</label>
        
        
    </div>
    <script type = 'text/javascript'>
            

        function buildRouteNameArray()
        {

            var routeName_str = '<?php foreach($route_names as &$i) { echo $i . ", "; }?>';
            var routeNames = [];
            var index = 0;
            var build_name = '';
            for(var i = 0; i<routeName_str.length; i++)
            {
                if(routeName_str[i]!= ",")
                {
                    build_name += routeName_str[i];
                  }
                else
                {
                    routeNames[index] = build_name;
                    build_name = '';
                    index++;
                 }
            }
            return routeNames;
        }
        function buildRouteIDArray()
        {
            var routeID_str = '<?php foreach($route_ids as &$i) { echo $i . ", "; }?>';
            var routeIDs = [];
            var index = 0;
            var build_name = '';
            for(var i = 0; i<routeID_str.length; i++)
            {
                if(routeID_str[i]!= ",")
                {
                    build_name += routeID_str[i];
                  }
                else
                {
                    routeIDs[index] = build_name;
                    build_name = '';
                    index++;
                 }
            }
            return routeIDs;
        }
        var formElm = "<form method = 'post' onsubmit='runTest()' action = '' id= 'formElm'>";
        var endForm = "<input class='btn' type = 'submit' name = 'Submit' value='Submit'></form>";
        var routeNames = buildRouteNameArray();
        var routeIDs = buildRouteIDArray();
        var routeTable = document.getElementById('routeTable');
        //routeTable.innerHTML = startTable;
        for(var i = 0; i< '<?php echo $numRoutes?>'; i++)
        {
            formElm  = formElm + "<input type='radio' name='radio' value='" + routeIDs[i] + "'>" +  routeNames[i] + "<br>";
        }
        routeTable.innerHTML = routeTable.innerHTML + formElm + endForm;
        for(var i = 0; i<routeIDs.length; i++)
        {
            document.getElementById(routeIDs[i]).addEventListener('click', function() {
            });
        }
    </script>
    <?php
    if(isset($_POST['Submit']))
    {
      if(isset($_POST['radio']))
      {
        $_SESSION['routeID'] = $_POST['radio'];
        $lat_array = array();
        $lng_array = array();
        if(isset($_SESSION['routeID']))
        {
          $routeID = $_SESSION['routeID'];
          $routeID = trim($routeID);
          $wayptQuery = "SELECT lat, lng from waypoints, past_routes WHERE waypoints.route_id = past_routes.route_id and past_routes.route_id ='" . $routeID . "';";
          $wayptResult = mysqli_query($conn, $wayptQuery);
          if(!$wayptResult)
          {
            die('invalid Query: ' . mysql_error());
          }
          $lat_array = array();
          $lng_array = array();
          $index = 0;
          while($row = $wayptResult->fetch_assoc())
          {
            $lat_array[$index] = $row['lat'];
            $lng_array[$index] = $row['lng'];
            $index++;
          }
        }
      }
    }
    ?>

    <!-- End Page Content -->
    <!-- Add Google Maps -->
    <div id="map" style="height:600px; margin-left: 50px; margin-right: 50px"></div>
      <div>
        <p>Total Distance: <span id="total"></span></p>
    </div>
    <div id = 'directionsPanel'>
      
    </div>
    <script>
      // This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      
      var startingPos;
      var endingPos;
      var bikeLayer = new google.maps.BicyclingLayer();
      var clicked = false;
      var directionsDisplay = new google.maps.DirectionsRenderer({
        draggable: true,
        panel: document.getElementById('directionsPanel'),
        map: map
      });
      var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 43.073481, lng: -73.799124},
          zoom: 13,
          mapTypeId: 'roadmap'
        });
      function buildWayptLatArray()
        {
            var wayptLat_str = '<?php if(isset($_SESSION["routeID"])){ foreach($lat_array as $i) { echo $i . ", ";}}?>';
            var wayptLats = [];
            var index = 0;
            var build_wayptLat = '';
            for(var i = 0; i<wayptLat_str.length; i++)
            {
                if(wayptLat_str[i]!= ",")
                {
                    build_wayptLat += wayptLat_str[i];
                  }
                else
                {
                    wayptLats[index] = build_wayptLat;
                    build_wayptLat = '';
                    index++;
                 }
            }
            return wayptLats;
            
        }
        
        /* function deleteMarker() {
            var tempMarker = markers.pop();
            alert("Method run!");
            tempMarker = null;
            tempMarker.setMap(null);
            }
            */
        
      function buildWayptLngArray()
        {
          
            var wayptLng_str = '<?php if(isset($_SESSION["routeID"])){ foreach($lng_array as $i) { echo $i . ", ";}}?>';
            var wayptLngs = [];
            var index = 0;
            var build_wayptLng = '';
            for(var i = 0; i<wayptLng_str.length; i++)
            {
                if(wayptLng_str[i]!= ",")
                {
                    build_wayptLng += wayptLng_str[i];
                  }
                else
                {
                    wayptLngs[index] = build_wayptLng;
                    build_wayptLng = '';
                    index++;
                 }
            }
            return wayptLngs;
            
        }
      function setStartPos(startPos) {
        startingPos=startPos;
      }
      function setEndPos(endPos) {
        endingPos=endPos;
      }
      function initAutocomplete() {
      
        directionsDisplay = new google.maps.DirectionsRenderer({
          panel: document.getElementById('directionsPanel'),
          draggable: true,
          map: map,   });
          
        var directionsService = new google.maps.DirectionsService;
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 43.073481, lng: -73.799124},
          zoom: 13,
          mapTypeId: 'roadmap'
        });
        
        directionsDisplay.setMap(map);
        
        if(clicked)
        {
          calculateAndDisplayRoute(directionsService, directionsDisplay, map);
        }
      
      directionsDisplay.addListener('directions_changed', function(){
        computeTotalDistance(directionsDisplay.getDirections());
        updateInfo(directionsDisplay.getDirections());
        });
        bikeLayer = new google.maps.BicyclingLayer();
        bikeLayer.setMap(map);
        
        var trafficLayer = new google.maps.TrafficLayer();
        trafficLayer.setMap(map);
      
      
        map.addListener('click', function(e) {
                placeMarker(e.latLng, map);
            });
      function placeMarker(position, map) {
            var markerLat = position.lat();
            var markerLng = position.lng();
            window.dog = "Bark";
            myLatLng = position;
            var marker1 = new google.maps.Marker({
                position: position,
                map: map,
                // icon: 'green-marker-black-border-hi.jpg'
            });
            markers.push(marker1);
            marker1.setMap(map);
            
                     var infowindow1 = new google.maps.InfoWindow({
                  content: '<form id = "markerForm" action = "addMarkers.php" method="post">' +
                    '<h3>Tags</h3>' +
                    '<p>Which of the following apply?</p>' +
                    '<a href = "tagsSeparatePage.php">Click here for a separate page</a>' + '<br>' + '<br>' +
                    '<div style = "float : left;">' + '<h><u><font size = "4">Features</font></u></h>' + '<br>' + '<br>' +
                    '<input type="checkbox" name="bathroom" value="potholes">' + 'Bathroom' + '<br>' +
                    '<input type="checkbox" name="gradualHill" value="route">' + 'Gradual Hill' + '<br>' +
                    '<input type="checkbox" name="infrequentTraffic" value="shoulder">' + 'Infrequent Traffic' + '<br>' +
                    '<input type="checkbox" name="largeShoulder" value="bike lane">' + 'Large Shoulder' + '<br>' +
                    '<input type="checkbox" name="longStraightRoad" value="blind turn">' + 'Long Straight Road' + '<br>' +
                    '<input type="checkbox" name="peaceful" value="traffic">' + 'Peaceful' + '<br>' +
                    '<input type="checkbox" name="scenic" value="surface">' + 'Scenic' + '<br>' +
                    '<input type="checkbox" name="separateBikeLane" value="surface">' + 'Separate Bike Lane' + '<br>' +
                    '<input type="checkbox" name="shady" value="surface">' + 'Shady' + '<br>' +
                    '<input type="checkbox" name="waterFood" value="surface">' + 'Water/Food' + '<br>' +
                    '<input type="checkbox" name="windingRoad" value="route">' + 'Winding Road' + '<br>' +
                    '<input type="checkbox" name="deadEnd" value="surface">' + 'Dead End' + '<br>' +
                    '<input type="checkbox" name="noAlternativeRoutes" value="route">' + 'No Alternative Routes' + '<br>' +
                    '<input type="checkbox" name="steep" value="route">' + 'Steep' + '<br>' +
                    '</div>' +
                    '<div style = "float : left;">' + '<h><u><font size = "4">Hazards</font></u></h>' + '<br>' + '<br>' +
                    '<input type="checkbox" name="blindTurn" value="route">' + 'Blind Turn' + '<br>' +
                    '<input type="checkbox" name="crackedSurface" value="shoulder">' + 'Cracked Surface' + '<br>' +
                    '<input type="checkbox" name="dangerousIntersection" value="gradient">' + 'Dangerous Intersection' + '<br>' +
                    '<input type="checkbox" name="fallingRockZone" value="route">' + 'Falling Rock Zone' + '<br>' +
                    '<input type="checkbox" name="flatTireHazard" value="noise">' + 'Flat Tire Hazard' + '<br>' +
                    '<input type="checkbox" name="gravelOrCobblestone" value="traffic">' + 'Gravel or Cobblestone' + '<br>' +
                    '<input type="checkbox" name="heavyCrossTraffic" value="traffic">' + 'Heavy Cross Traffic' + '<br>' +
                    '<input type="checkbox" name="highSpeedLimit" value="route">' + 'High Speed Limit' + '<br>' +
                    '<input type="checkbox" name="insects" value="route">' + 'Insects' + '<br>' +
                    '<input type="checkbox" name="noShoulder" value="route">' + 'No Shoulder' + '<br>' +
                    '<input type="checkbox" name="potholes" value="route">' + 'Potholes' + '<br>' +
                    '<input type="checkbox" name="railroadCrossing" value="route">' + 'Railroad Crossing' + '<br>' +
                    '<input type="checkbox" name="recklessDrivers" value="route">' + 'Reckless Drivers' + '<br>' +
                    '<input type="checkbox" name="roadConstruction" value="route">' + 'Road Construction' + '<br>' +
                    '<input type="checkbox" name="sandyMuddy" value="route">' + 'Sandy/Muddy' + '<br>' +
                    '<input type="checkbox" name="slippery" value="route">' + 'Slippery' + '<br>' +
                    '<input type="checkbox" name="truckTraffic" value="route">' + 'Truck Traffic' + '<br>' +
                    '</div>' + '<br>' +
                    '<input onclick= "deleteMarker()" type="button" value="Delete Marker" class="btninfoWin">' +
                    '<p><input type="submit" name="submit" value="Submit" class="btninfoWin" ></p>' +
                    '<input type = "hidden" name = "markerLat" id = "markerLat" value="' + markerLat + '">' + 
                    '<input type = "hidden" name = "markerLng" id = "markerLng" value="' + markerLng + '">' +
                    '</form>' +
                    '<form>' +
                    'Comments:' + '<br>' +
                    '<input type="text" name="comments">' + '<br>' +
                    '</form>'
            });

            marker1.addListener('click', function() {
                infowindow1.open(map, marker1);
            });
        }
        
       /* function deleteMarker() {
            var tempMarker = markers.pop();
            alert("Method run!");
            tempMarker = null;
            tempMarker.setMap(null);
            }
        */
            
        if('<?php echo isset($_SESSION["routeID"]);?>'=='1' && !clicked)
        {
          calcThisRoute();
        }
        else{
          //alert('failed');
        }
        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
      
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
      function buildWaypts(lat_arry, lng_arr, inc)
      {
        var waypt_arr = [];
        var pt;
        //alert(lat_arry.length);
        if(lat_arry.length>23)
        {
          
          for(var i = 1; i<lat_arry.length-inc; i+=inc)
          {
            waypt_arr.push({
              location: new google.maps.LatLng(lat_arry[i], lng_arr[i]),
              stopover: true
            });
          }
          return waypt_arr;
        }
        else{
          //alert('waypoint created laskj');
          for(var i = 1; i<lat_arry.length-1; i+=2)
          {
            waypt_arr.push({
              location: new google.maps.LatLng(lat_arry[i], lng_arr[i]),
              stopover: true
            });
          }
          return waypt_arr;
        }
      }
      function determineIncrement(wayptLat_arr)
      {
        var inc = 2;
        while(inc<wayptLat_arr.length)
        {
          if((wayptLat_arr.length/inc)<23)
          {
            //alert(' the inc is ' + inc);
            return inc;
          }
          else
          {
            //alert('being incremented');
            inc++;
          }
        }
      }
      function calculateAndDisplayRoute(directionsService, directionsDisplay, map) {
        var selectedMode = 'BICYCLING';
        var wayptLat_arr = buildWayptLatArray();
        var wayptLng_arr = buildWayptLngArray();
        var waypt_arr = [];
        var inc = determineIncrement(wayptLat_arr);
        waypt_arr = buildWaypts(wayptLat_arr, wayptLng_arr, inc);
        //alert('Increment is ' + inc);
        if(wayptLat_arr.length>0 && wayptLng_arr.length>0)
        {
          if(waypt_arr.length>23)
          {
            //alert("array too long: " + waypt_arr.length);
          }
          //waypt_arr = buildWaypts(wayptLat_arr, wayptLng_arr);
          //alert(waypt_arr.length + ' is the length of the wapt_arr');
          if(waypt_arr.length<23)
          {
            //alert('array is ok: ' + waypt_arr.length);
            for(var j = 0; j<waypt_arr.length; j++)
            {
              //alert('Lat: ' + waypt_arr[j].location.lat() + ' Lng: ' + waypt_arr[j].location.lng());
            }
            //alert('starting point: ' + waypt_arr[0].location.lat() + ', ' + waypt_arr[0].location.lng());
            //alert('ending pos: ' + waypt_arr[waypt_arr.length-1].location.lat() + ', ' + waypt_arr[waypt_arr.length-1].location.lng());
          }
          //alert(wayptLat_arr[wayptLat_arr.length-1]+', ' + wayptLng_arr[wayptLng_arr.length-1]);
          directionsService.route({
            origin: new google.maps.LatLng(waypt_arr[0].location.lat(), waypt_arr[0].location.lng()),
            destination: new google.maps.LatLng(waypt_arr[waypt_arr.length-1].location.lat(), waypt_arr[waypt_arr.length-1].location.lng()),
            waypoints: waypt_arr,
            avoidHighways: true,
            travelMode: 'BICYCLING'
          }, function(response, status) {
            if(status == 'OK') {
              directionsDisplay.setDirections(response);
              //alert(status);
            } else{
              //alert('Directions failed due to ' + status);
              window.aler("Directions request failed due to " + status);
              //alert(status);
            }
          });
        }
        else
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
      }
      function updateInfo(result)
      {
        var route = result.routes[0];
        var pointsArray =[];
        //document.getElementById('points').innerHTML = 'hello';
        var pointsArray = route.overview_path;
        for(var i = 0; i<pointsArray.length; i++)
        {
          document.getElementById('points').innerHTML = document.getElementById('points').innerHTML + " *** " + pointsArray[i];
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
      }
      
      
      function calcThisRoute()
      {
        clicked = true;
        initAutocomplete();
      }
      
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
 <!-- <button class='btn-calc' onclick = 'calcThisRoute()' value='Calc Route'>Calc Route</button> -->





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