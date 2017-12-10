<?php
    require('./connFiles/LoginMaterials/dbcredentials.php');
       $conn = mysqli_connect($host, $username, $password, $database, $port);
        if (!$conn) {
            die('not connected : ' . mysql_error());
        }
    if(isset($_POST['submit']))
    {
        // If the values are posted, insert them into the database.
        if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmpassword'])){
        $email = $_POST['email'];
        $name = $_POST['name'];
        $pass = $_POST['password'];
        $cpass = $_POST['confirmpassword'];
        $slquery = "SELECT 1 FROM cust_info WHERE email = '$email'";
        $selectresult = mysqli_query($conn, $slquery);
        $createquery = "INSERT INTO `cust_info` (email, password, name) VALUES ('$email', '$pass', '$name')";
    //check to see if phone number has already been added
        function addCust($myConn, $createcustQuery, $name){
            $result = mysqli_query($myConn, $createcustQuery);
            if($result){
                //echo  '<script>alert("User creation successful")</script>';
                $_SESSION['logged'] = true;
                //echo '<script>alert(' .$_SESSION["logged"] . ')</script>';
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                mysqli_close($myConn);
                relocate();
                //header('Location: index.php');
                //exit;
             }
             else{
                 echo "User Creation Failed";
             }
        }
        function relocate()
        {
            header('Location: index.php');
        }
        function verifyPass($givenPass, $givenCPass, $dbConn, $custQuery, $name)
        {
            if (strcmp($givenPass, $givenCPass)== 0) {
                if(strlen($givenPass)<8)
                {
                    echo "<script>alert('Error: Password Must be longer than 8 Characters')</script>";
                }
                else
                {
                 addCust($dbConn, $custQuery, $name);
                }
            }   
            else
            {
                echo  "Passwords Do Not Match";
            }
        }
        if(mysqli_num_rows($selectresult)!=0)
        {
            echo "<script>alert('Error: Email already exists')</script>";
        }
        else{
            verifyPass($pass, $cpass, $conn, $createquery, $name);
        }
    }
    else{
        echo'<script>alert("Please answer all fields")</script>';
    }
    }
?>
    
    
<!DOCTYPE html>
<html>
     <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link href="css/bootstrap.min.css" rel="stylesheet"> 
    <!-- Custom CSS: You can use this stylesheet to override any Bootstrap styles and/or apply your own styles -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Raleway" rel="stylesheet">
    <title>Register</title>
    <style type="text/css">
        .register-form{
        width: 500px;
        margin: 0 auto;
        text-align: center;
        padding: 10px;
        margin-top: 10%;
        background : yellowgreen;
        border-radius: 10px;
        -webkit-border-radius:10px;
        -moz-border-radius:10px;
        
    }
    .register-form form input{padding: 5px;}
    .register-form .btn{
        background: #726E6E;
        padding: 7px;
        border-radius: 5px;
        text-decoration: none;
        width: 150px;
        display: inline-block;
        color: #FFF;
    }
    .register-form .register{
        border: 0;
        width: 80px;
        padding: 8px;
    }
     h1{ 
        font-family:"lobster", cursive;
    }
    form{ 
        font-family:"raleway", sans-serif;
    }
    
    #login{ 
        Font-family:'lobster', cursive;
        
    }
    #body{
        background-image: url("/images/create user.jpg"); 
        background-repeat:no-repeat;
        background-position: center;
        background-size: cover;
        overflow-y:hidden;
        
    }
    #siteNav {
    background-color : white;
    color : white;
}
.container{
    color : white;
    background-color : white;
}
    
    </style>
</head>

<body id='body'; background="/images/create user.jpg" >
      
    
    
     <!-- Navigation -->
    <nav id="siteNav" class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="navbar">
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
            </div>
        </div>
    </nav>
    
    
 
    <div class="register-form">
    <?php
        if(isset($msg) & !empty($msg)){
        echo $msg;
    }
    ?>
    <?php
    if(isset($errormes))
    {
        echo $errormes;
    }
    ?>
        <h1>Register</h1>
        <form action="" method="POST">
            <p><label>E-Mail*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
            <input id="email" name="email" type="email" placeholder='Email'>
            </p>
            <p><label>Name (Optional): </label>
            <input id="name" name = "name" type = "text" placeholder="name">
            </p>
            
            <p><label>Password&nbsp;&nbsp; :</label>
            <input id="password" name="password" type="password" placeholder="Password">
            </p>
            <p><label>Confirm Password &nbsp;&nbsp; :</label>
            <input id="confirmpassword" name="confirmpassword" type="password" placeholder="Confirm Password">
            </p>
            <input type="submit" name="submit" value="Register" class="btn register" >
            <a class="btn" href="login.php">Login</a>
        </form>
    </div>
</body>
</html>