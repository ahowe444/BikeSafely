<?php
    require('dbcredentials.php');
    $conn = mysqli_connect($host, $username, $password, $database, $port);
    if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
    }
    $query = 'SELECT * FROM cust_info';
    $result = mysqli_query($conn, $query);
    while ($row = $result->fetch_assoc()) {
        printf ($row['email']);
    }
?>