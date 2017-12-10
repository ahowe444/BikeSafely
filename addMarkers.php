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
    $email = $_SESSION['useremail'];
    //echo "<script>alert('" . $tags . "," .  "');</script>";
    //$markerQuery = "INSERT INTO 'markers' (lat, lng, tags, email) VALUES (" . "'" .  $lat ."', " . "'" . $lng ."', " . "'" . $tags . "', " .  "'" .$_SESSION['useremail']."');";
    $query = "INSERT INTO markers (lat, lng, tags, email) VALUES ('$lat', '$lng', '$tags', '$email')";
    //echo "<script>alert('" . $query . "');</script>";
    //echo $query;
    //echo $conn;
    mysqli_query($conn, $query);
    
    //require('./genMarkers.php');
    //header('Location: ./loadingOldRoutes.php');
   
   
   
   unlink('markers.xml');
    header("Content-type: text/xml");
        
    //start Xml file, create parent node
    clearstatcache();
    $dom = new DOMDocument("1.0", "utf-8");
    $node = $dom->createElement("markers", "This is the root element");
    $parnode =$dom->appendChild($node);

    //Connect to the database
    $conn = mysqli_connect($host, $username, $password, $database, $port);
    if (!$conn) {
        die('not connected : ' . mysql_error());
        $node = $dom->createElement("errorNode", "unsuccessful connection");
        $parnode->appendChild($node);
    }
        
    //Set the active MySQL database
    $db_selected = mysqli_select_db($conn, $database);      
      if(!$db_selected)
        die('Can\'t use db: ' . mysql_error);
        
    // Search the rows in the markers table
    $query = "SELECT lat, lng, tags FROM markers";
    $result = mysqli_query($conn, $query);

    $result = mysqli_query($conn, $query);
    if (!$result) {
      die("Invalid query: " . mysql_error());
      $node = $dom->createElement("errorNode", "unsucessful query");
      $parnode->appendChild($node);
    }
        
        //Iterate through the rows, adding XML nodes for each 
    while($row = $result->fetch_assoc()){
        $node = $dom->createElement("marker");
        $newnode = $parnode->appendChild($node);
        $newnode->setAttribute("lat", $row['lat']);
        $newnode->setAttribute("lng", $row['lng']);
        $newnode->setAttribute("tags", $row['tags']);
    }
    clearstatcache();
    $dom->save("./markers.xml");
   header("Location: ./loadingOldRoutes.php");
  }
