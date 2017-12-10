<?php 
    session_start();
    if(isset($_POST['radio']))
    {
        $_SESSION['routeID'] = $_POST['radio'];
        echo '<script>alert("'. $_SESSION['routeID'] .'")</script>';
        $_SESSION['route_selected'] = true;
        Header('Location: ./loadingOldRoutes.php');
    }
    else {
        Header('Location: ./loadingOldRoutes.php');
    }
?>