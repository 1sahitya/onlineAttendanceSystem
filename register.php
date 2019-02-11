<?php
	
	require_once('header.php');
	
	$server="localhost";
	$user="root";
	$pass="";
	$db="attendance";
	$conn = mysqli_connect($server,$user,$pass,$db);
	
	if(!$conn){
	die("Connection failed:");
	}

	if(isset($_POST["sbmt"])){

		$sql="insert into user(name,email,password,s_ques,s_ans) values ('".$_POST["name"]."','".$_POST["email"]."','".$_POST["pwd"]."','".$_POST["s_ques"]."','".$_POST["s_ans"]."')";

		if(mysqli_query($conn,$sql)){
		echo "Registeration Succesfull";
		}
	else{
	echo "Error:".mysqli_error($conn);
		}
	
	}
	

?>
	<div class="container-fluid page-bg register">
		 <form action="register.php" method="POST" class="form-page">		
		 		
		 		<div class="row">
		 			<div class="col-12">
		 				<h2 class="form-heading">Sign Up</h2>
		 			</div>
		 		</div>
	 		
	 			<div class="form-group">
				    <label for="name">Full Name:</label>
				    <input type="text" class="form-control" name="name" id="name" required>
		  		</div>
			 
			  <div class="form-group">
			    <label for="email">Email address:</label>
			    <input type="email" class="form-control" name="email" id="email" required>
			  </div>
			 
			  <div class="form-group">
			    <label for="pwd">Password:</label>
			    <input type="password" class="form-control" name="pwd" id="pwd" required>
			  </div>
			 
			  <div class="form-group">
				    <label for="s_ques">Security Question:</label>
				    <select class="form-control custom-select" name="s_ques" id="s_ques" required>
			    		<option selected>Security Question</option>
			    			<option value="Your Pet Name">Your Pet Name </option>
			    			<option value="First Movie Watched">First Movie Watched </option>
			    			<option value="Your Favourite Place">Your Favourite Place</option>
			    	</select>
		  		</div>
		  		<div class="form-group">
				    <label for="s_ans">Security Answer:</label>
				    <input type="text" class="form-control" name="s_ans" id="s_ans" required>
		  		</div>
			  <button type="submit" class="btn btn-primary" name="sbmt">Submit</button>

			  	<div class="alert alert-primary mt-3">
				   Already Have an Account ? <a class="alert-link " href="login.php">Log In</a>
				</div>
			</form> 
				
	</div>
<?php
	
	require_once('footer.php');
?>
