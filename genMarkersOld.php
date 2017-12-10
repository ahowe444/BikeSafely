<?php

    require("./connFiles/LoginMaterials/dbcredentials.php");
    unlink('markers' . $_SESSION['id'] . '.xml');
    header("Content-type: text/xml");
        
    //start Xml file, create parent node
    $dom = new DOMDocument("1.0", "utf-8");
    $node = $dom->createElement("markers", "This is the root element");
    $parnode =$dom->appendChild($node);

    //Connect to the database
    //$conn = mysqli_connect($host, $username, $password, $database, $port);
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
    $dom->save("./markers" . $_SESSION['id'] . ".xml");
    header('Location: loadingOldRoutes.php');
?>