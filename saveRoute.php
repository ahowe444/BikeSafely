<?php
    session_start();
    require('./connFiles/LoginMaterials/dbcredentials.php');
    $conn = mysqli_connect($host, $username, $password, $database, $port);
    $cust_id = 0;
    $route_id = '0';
    $route_name = $_POST['routeName'];
    $route_dist = $_POST['routeDist'];
    $route_waypoints = $_POST['routeWaypts'];
    //echo "<script>alert('" . $route_name . " Is the route Name')</script>";
    //echo "<script>alert('" . $route_waypoints . " are the waypoints')</script>";
    if (!$conn) {
        die('not connected : ' . mysql_error());
    }
    if(isset($_POST['saveSubmit']))
    {
        //echo "<script>alert('Route name: '" . $route_name . "')</script>";
        //echo "<script>alert('Submit pushed')</script>";
        if(isset($_POST['routeName']) && isset($_POST['routeDist']))
        {
            //echo "<script> alert('" . $_SESSION['email'] . " is the email ')</script>";
            //first get cust_id so it can be used to save route
            //echo "<script>alert('got route name and route dist')</script>";
            $cust_idQuery = "SELECT id from cust_info where email='". $_SESSION['email'] ."';";
            $cust_idResult = mysqli_query($conn, $cust_idQuery);
            if($cust_idResult){
                
                while($row = $cust_idResult->fetch_assoc())
                {
                    $cust_id = $row['id'];
                    //echo "<script>alert(".$cust_id.")</script>";
                }
                //Now check to see if route name has been used before
                //echo "<script>alert('Now checking route name')</script>";
                $route_nameQuery = "SELECT route_id from past_routes where route_name = '". $route_name ."' AND cust_id = '" . $cust_id ."';";
                $route_nameResult = mysqli_query($conn, $route_nameQuery);
                if(mysqli_num_rows($route_nameResult) >0)
                {
                    //echo '<script>alert("Sorry it looks like you\'ve already used this route name before")</script>';
                    exit;
                }
                else{
                    echo '<script>alert("Route Name Has not been used")</script>';
                    //Now insert route into past route table
                    $routeQuery = "INSERT INTO past_routes (cust_id, route_name, route_dist) VALUES ('" . $cust_id . "', '" . $route_name .  "', '" . $route_dist . "');";
                    $routeResult = mysqli_query($conn, $routeQuery);
                    if($routeResult)
                    {
                        //echo "<script>alert('successful in finding route')</script>";
                        
                        //Now get route id so it can be used to save waypoints
                        $route_idQuery = "SELECT route_id FROM past_routes where cust_id ='" . $cust_id . "' AND route_name = '". $route_name ."';";
                        $route_idResult = mysqli_query($conn, $route_idQuery);
                        if($route_idResult)
                        {
                            //echo "<script>alert('Successful in finding route id')</script>";
                            while ($row = $route_idResult->fetch_assoc())
                            {
                                $route_id = $row['route_id'];
                                //echo "<script>alert('Route ID is: '" . $route_id . "')</script>";
                            }
                            //echo "<script>alert('" . $route_id . " is the route id')</script>";
                            
                            $waypoints_arr = buildPointArray($route_waypoints, $route_id, $conn);
                            //echo $waypoints_arr[0];
                            //echo $points_arr;
                            //Now save waypoints
                        }
                        else 
                        {
                            //echo "<script>alert('Cannot find Route ID')</script>";
                        }
                
                    }
                    else{
                       // echo "<script>alert('failed to retrieve route')</script>";
                    }
                }
            }
            else {
                //echo "<script>alert('Result failed')</script>";
            }
        }
    }
    function buildPointArray($route_waypoints, $route_id, $conn)
    {
        //echo "<script>alert('function called')</script>";
        $build_str = '';
        $point_arr = array();
        $index = 0;
       // echo count($route_waypoints) . "is the route waypoint array length";
        for($i=1; $i<strlen($route_waypoints); $i++)
        {
            if(is_numeric($route_waypoints[$i]) || $route_waypoints[$i] =='.' || $route_waypoints[$i] =='-')
            {
                $build_str = $build_str . $route_waypoints[$i];
            }
            else if(strlen($build_str)>0)
            {
                $point_arr[$index] = $build_str;
                $index++;
                $build_str = '';
            }
        }
        //echo $point_arr[0];
        fillDB($point_arr, $route_id, $conn);
    }
    function fillDB($point_arr, $route_id, $conn)
    {
        //echo "<script>alert('Last function called')</script>";
        //echo "<script>alert('" . count($point_arr) . "')</script>";
        for($i=0; $i<count($point_arr)-4; $i+=4)
        {
            //echo $point_arr[$i] . ' *** ' . $point_arr[$i+1] . ' ';
            $pointQuery = "INSERT INTO waypoints (route_id, lat, lng) VALUES ('" .$route_id ."', '" . $point_arr[$i] . "', '" . $point_arr[$i+1] . "');";
            //echo $pointQuery;

            $pointResult = mysqli_query($conn, $pointQuery);
            if(!$pointResult)
            {
                //echo "<script>alert('Uh oh! Something went wrong, please try again later')</script>";
                exit;
            }
        }
        
        
    }
?>