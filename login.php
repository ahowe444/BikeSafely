<?php
    require('./connFiles/LoginMaterials/dbcredentials.php');
    session_start();
    $conn = mysqli_connect($host, $username, $password, $database, $port);
    if (!$conn) {
        die('not connected : ' . mysql_error());
    }
    // If the values are posted, insert them into the database.
    if (isset($_POST['email']) && isset($_POST['password'])){
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $passquery = "SELECT password, name, id FROM cust_info WHERE email = '$email'";
        $passresult = mysqli_query($conn, $passquery);
        $bothfilled = true;
        
        //check to see if both fields are filled
        if(strcmp($pass, "")==0 || strcmp($email, "")==0)
        {
            echo "<script>alert(\"Please fill all fields\");</script>";
            $bothfilled = false;
        }
        //check to see if email exists
            if(mysqli_num_rows($passresult)==0 && $bothfilled)
                {
                    echo "Email does not exist";
                }
            else{
                while($row = $passresult->fetch_assoc())
                {
                    $userpass = $row['password'];
                    $name = $row['name'];
                    $id = $row['id'];
                    if (strcmp($userpass, $pass)== 0) {
                       //find a way to save the user's email address so it can be referenced
                       // on the "my past routes" page
                       $_SESSION['email'] = $email;
                       $_SESSION['id'] = $id;
                       if(strcmp($name, "NULL")!=0) {
                        $_SESSION['name'] = $name;
                       }
                       $_SESSION['logged'] = true;
                       header("Location: ./index.php");
                    }   
                    else{
                        if($bothfilled){
                            echo "Password is not correct";
                        }
                    }
                }
            }
        }
    mysqli_close($conn);
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
    <title>Login screen</title>
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
            <!-- Logo and responsive toggle -->
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
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
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
        <h1 id=login>Login</h1>
        <form action="" method="POST">
            <p><label id="email-text">E-Mail*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</label>
            <input id="email" name="email" type="email" placeholder='Email'>
            </p>
            <p><label>Password&nbsp;&nbsp; :</label>
            <input id="password" name="password" type="password" placeholder="Password">
            </p>
            <input type="submit" name="submit" value="Submit" class="btn register" >
            <a href = "./createuser.php" class="btn">Create Account</a>
        </form>
    </div>
    
    
</body>
</html>