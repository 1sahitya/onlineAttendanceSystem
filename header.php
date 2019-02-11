<?php
	require_once("topArea.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="css/bootstrap.min.css" ><!-- Bootstrap -->
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"> <!-- Font awesome icons-->
    
    <link rel="stylesheet" type="text/css" href="css/style.css">	<!-- custom style -->
    
    <link href="https://fonts.googleapis.com/css?family=Lora|Cookie" rel="stylesheet"> <!-- Google fonts --> 
	<link rel="stylesheet"  href="css/pretty-checkbox.min.css">        
    <title>Attendance System</title>
  </head>
  <body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-dark navbar-expand-sm header-nav fixed-top text-uppercase" id="navbar" role="navigation">
	  
	  	<a class="navbar-brand ml-5 text-capitalize" href="index.php"><i class="fas fa-edit"></i>Attendance System</a>
		
		<!-- Toggler/collapsibe Button -->
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"">
		    <span class="navbar-toggler-icon"></span>
		  </button>

	   <div class="collapse navbar-collapse" id="collapsibleNavbar">
	    <ul class="navbar-nav ml-auto  mr-5 font-weight-bold">
	      

	      <?php // If User Is Logged In

	      if (empty($_COOKIE["suser"])) { ?>

		      <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == "index.php" ? "active" : "");?>">
		        <a class="nav-link"  href="index.php">Login</a>
		      </li>
	      	
		      <li class="nav-item  <?php echo (basename($_SERVER['PHP_SELF']) == "register.php" ? "active" : "");?>" >
		        <a class="nav-link" href="register.php">Register</a>
		      </li>
		  	<?php }
		  		else{ ?>
		      <li class="nav-item  <?php echo (basename($_SERVER['PHP_SELF']) == "main.php" ? "active" : "");?> ">
		        <a class="nav-link" href="main.php">schedule</a>
		      </li>
		      <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == "logout.php" ? "active" : "");?>">
		        <a class="nav-link" href="logout.php">log out</a>
		      </li>
		  <?php } ?>
	    </ul>
	 </div>
	</nav>
