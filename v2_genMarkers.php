<?php 
    require("./connFiles/LoginMaterials/dbcredentials.php");
    $doc = new DOMDocument();
    $doc->Load('markers.xml');
    $to_remove = array();
    
    foreach($doc->getElementsByTagName('markers') as $tagmarkers)
    {
        foreach($tagmarkers -> getElementsByTagName('marker') as $tagmarker)
        {
            $to_remove[] = $tagmarker;
        }
    }
    
    foreach($to_remove as $rm_node)
    {
        $rm_node->parentNode->removeChild($rm_node);
    }
    
    //$node = $doc->createElement("markers", "This is the root element");
    //$markers_nodes = $doc->getElementsByTagName('markers');
    
    $node = $doc->getElementsByTagName('markers')->item(0);
    $parnode =$doc->appendChild($node);

    //Connect to the database
    $conn = mysqli_connect($host, $username, $password, $database, $port);
    if (!$conn) {
       die('not connected : ' . mysql_error());
        $node = $doc->createElement("errorNode", "unsuccessful connection");
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
      $node = $doc->createElement("errorNode", "unsucessful query");
      $parnode->appendChild($node);
    }
        
        //Iterate through the rows, adding XML nodes for each 
    while($row = $result->fetch_assoc()){
        $node = $doc->createElement("marker");
        $newnode = $parnode->appendChild($node);
        $newnode->setAttribute("lat", $row['lat']);
        $newnode->setAttribute("lng", $row['lng']);
        $newnode->setAttribute("tags", $row['tags']);
    }
    //clearstatcache();
    
    $doc->save("./markers.xml");
?>
