<?php

	require_once('header.php');

	$conn = mysqli_connect("localhost","root","","attendance");
	if(!$conn){
				echo "Did not Connect".mysql_error();
			}
	$msg="";
	if(isset($_POST["sbmt"])){

		$count=0;
		
		$sql="select * from user where email='".$_POST['email']."' and password='".$_POST['pwd']."'" ;
		
		
		if($result=mysqli_query($conn,$sql)){
		
			if (mysqli_num_rows($result) > 0) {
	    	
	    	
   			 	while($row = mysqli_fetch_assoc($result)) {
	   			 	
	   				setcookie("suser", $row["email"]);
		    		$msg="";
	    			header('Location:main.php');
	    			}
			}
			

			else {
	    		$msg="Invalid Username or Password ";
			}			
		}
}
?>

<div class="container-fluid page-bg">
	 <form action="index.php" method="POST" class="form-page">		
	 		<div class="row">
	 			<div class="col-12">
	 				<h2 class="form-heading">Login</h2>
	 			</div>
	 		</div>
	 	 <div class="form-group">
		    <label for="email">Email address:</label>
		    <input type="email" class="form-control" id="email" name="email">
		  </div>
		  <div class="form-group">
		    <label for="pwd">Password:</label>
		    <input type="password" class="form-control" id="pwd" name="pwd">
		  </div>
		  <div class="form-group form-check">
		   
		  </div>
		  <button type="submit" class="btn btn-primary" name="sbmt">Submit</button>
		  <?php
		  if($msg!=""){?>
		  	<div class="alert alert-warning">
				  <strong>Error! </strong><?php echo $msg; ?>
			</div>
		<?php
			}
		?>
		<div class="alert alert-primary mt-3">
				  Create Account ? <strong><a class="alert-link" href="register.php">Sign Up</a></strong>
		</div>
	</form> 
			
</div>

<?php
	
	require_once('footer.php');
?>