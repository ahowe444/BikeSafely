
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
    <!-- WARNING: Respond.js doesn t work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom Fonts from Google -->
    <link href="https://fonts.googleapis.com/css?family=Lobster|Montserrat|Raleway" rel= stylesheet  type= text/css >
    
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
                <a class="navbar-brand" href="#">
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
                        <a href="PlanaRoute.php">Plan A Route</a>
                    </li>
                    
                    					<li>
						<a href="loadingOldRoutes.php">Past Routes</a> 
						</li>
						
					<li> 
					
					    <a href = "login.php"> Login</a>
										</li>
					<li>
						<a href = "createuser.php">Create User</a>
						                </li>
                
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav>
    
    
     <div>
      <form action="http://www.html.am/html-codes/forms/html-form-tag-action.cfm" target="result2" method="get"> 
<h3>Tags</h3>   
<p>Which of the following apply?</p> 
 <br> <br>
<div style = "float : left;"> <h><u><font size = "4">Good</font></u></h   <br>     <br>   
 <input type="checkbox" name="tags" value="potholes">     Bathroom     <br>   
 <input type="checkbox" name="tags" value="route">     Gradual Hill     <br>    
 <input type="checkbox" name="tags" value="shoulder">     Infrequent Traffic     <br>    
 <input type="checkbox" name="tags" value="bike lane">     Large Shoulder     <br>    
 <input type="checkbox" name="tags" value="blind turn">     Long Straight Road     <br>    
 <input type="checkbox" name="tags" value="traffic">     Peaceful     <br>    
 <input type="checkbox" name="tags" value="surface">     Scenic     <br>    
 <input type="checkbox" name="tags" value="surface">     Separate Bike Lane     <br>    
 <input type="checkbox" name="tags" value="surface">     Shady     <br>    
 <input type="checkbox" name="tags" value="surface">     Water/Food     <br>    
 <input type="checkbox" name="tags" value="route">     Winding Road      <br>    
 </div>   
 <div style = "float : left;">     <h><u><font size = "4">Bad</font></u></h>     <br>     <br>     
 <input type="checkbox" name="tags" value="route">     Blind Turn      <br>    
 <input type="checkbox" name="tags" value="shoulder">     Cracked Surface     <br>    
 <input type="checkbox" name="tags" value="gradient">     Dangerous Intersection     <br>    
 <input type="checkbox" name="tags" value="surface">     Dead End     <br>    
 <input type="checkbox" name="tags" value="route">     Falling Rock Zone      <br>    
 <input type="checkbox" name="tags" value="noise">     Flat Tire Hazard     <br>    
 <input type="checkbox" name="tags" value="traffic">     Gravel or Cobblestone     <br>    
 <input type="checkbox" name="tags" value="traffic">     Heavy Cross Traffic     <br>    
 <input type="checkbox" name="tags" value="route">     High Speed Limit     <br>   
 <input type="checkbox" name="tags" value="route">     Insects     <br>    
 <input type="checkbox" name="tags" value="route">     No Alternative Routes     <br>    
 <input type="checkbox" name="tags" value="route">     No Shoulder     <br>    
 <input type="checkbox" name="tags" value="route">     Potholes     <br>    
 <input type="checkbox" name="tags" value="route">     Railroad Crossing     <br>    
 <input type="checkbox" name="tags" value="route">     Reckless Drivers     <br>    
 <input type="checkbox" name="tags" value="route">     No Alternative Routes     <br>    
 <input type="checkbox" name="tags" value="route">     No Shoulder     <br>    
 <input type="checkbox" name="tags" value="route">     Potholes     <br>    
 <input type="checkbox" name="tags" value="route">     Railroad Crossing     <br>    
 <input type="checkbox" name="tags" value="route">     Reckless Drivers     <br>    
 <input type="checkbox" name="tags" value="route">     Road Construction     <br>    
 <input type="checkbox" name="tags" value="route">     Sandy/Muddy     <br>    
 <input type="checkbox" name="tags" value="route">     Slippery     <br>    
 <input type="checkbox" name="tags" value="route">     Steep     <br>    
 <input type="checkbox" name="tags" value="route">     Truck Traffic     <br>    
 </div>     <br>    
 <p><input type="submit" value="Submit"></p>   
 </form>   
 <form>   
   Comments:     <br>    
   <input type="text" name="comments">     <br>   
   </form> 
    </div>
  


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




   
    