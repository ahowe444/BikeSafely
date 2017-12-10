<?php
    session_start();
    ?>

<!DOCTYPE html>
<!-- Template by Quackit.com -->
<!-- Images by various sources under the Creative Commons CC0 license and/or the Creative Commons Zero license. 
Although you can use them, for a more unique website, replace these images with your own. -->
<html lang="en">

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

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
                <?php
                    if($_SESSION['logged']){
                        echo "Welcome " . $_SESSION['name'] . "!";
                    }
                ?>
				</div>
            </div>
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <?php
                    if($_SESSION['logged'])
                    {
                        echo "
                    <li>
                        <a href=\"backupplan2.php\">Plan A Route</a>
                    </li>";
                    }
                    else {
                        echo "
                         <li>
                            <a href=\"login.php\">Plan A Route</a>
                        </li>";
                        }
                    ?>
                    <?php
                    if($_SESSION['logged'])
                    {
                        echo "
                    <li>
                        <a href=\"loadingOldRoutes.php\">Past Routes</a> 
                    </li>
                    ";
                    }
                    else {
                        echo "
                         <li>
                            <a href=\"login.php\">Past Routes</a>
                        </li>";
                        }
                    ?>
			    <?php
			        if(!$_SESSION['logged']){
			            
			        echo " 
					<li> 
					
					    <a href = \"login.php\"> Login</a>
										</li>
					<li>
						<a href = \"createuser.php\">Create User</a>
						                </li>";
			        }
			    ?>
			    
				<?php
				    if($_SESSION['logged']){
				        
				    echo "<li><a href ='./connFiles/LoginMaterials/logout.php' id = \"logout\">Logout</a></li> ";
				    }
				?>
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

                </ul>
                
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav>

	<!-- Header -->
    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1>Plan Ahead</h1>
                <p>Safe and enjoyable routes can be hard to create. We're here to help.</p>
                <?php
                    if($_SESSION['logged'])
                    {
                        echo '<a href="backupplan2.php" class="btn btn-primary btn-lg">Start Mapping</a>';
                    }
                    else 
                    {
                        echo '<a href="login.php" class = "btn btn-primary btn-lg">Start Mapping</a>';  
                    }
                ?>
                
            </div>
        </div>
    </header>



	<!-- Content 1 -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <img class="img-responsive img-circle center-block" src="/images/TSF.jpg" alt="">
                </div>
                <div class="col-sm-6">
                	<h2 class="section-header">Look at your past routes to place tags and add comments for future users.</h2>
                	<p class="lead text-muted">User input will help us plan routes more safely.</p>
                	<?php
                	if($_SESSION['logged'])
                	{
                	    echo '<a href="loadingOldRoutes.php" class="btn btn-primary btn-lg">Look at Past Routes</a>';
                	}
                	else {
                	    echo '<a href="login.php" class = "btn btn-primary btn-lg">Look at Past Routes</a>';
    
                	}
                	?>
                </div>                
                
            </div>
        </div>
    </section>

	<footer>   <link href="css/footer.css" rel="stylesheet">

       		<div class="footer-column" id="footer-Col1" style="margin-left: 17.5%; margin-right: 0px" >
				<div>
				<img src="images\footerLogo.jpg" alt="" width="150" height="160" border="20" />
                </div>
        	</div>
			
			<div class="footer-column" id="footer-Col2">
                
                <address>
                    <h3>SSHS Engineering Design and Development</h3>
                    
                    1 Blue Streak Blvd <br />Saratoga Springs, NY 12866 <br />edd.classof2017@gmail.com                
                    
                </address>
                  
        	</div>
        		<div class="footer-column" id="footer-Col3" >
				<div>
				<img src="images\footerLogo.jpg" alt="" width="150" height="160" border="0" />
                </div>
        	</div>
	    </div>
    </footer>
   
	
    
	<!-- Footer -->
    

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