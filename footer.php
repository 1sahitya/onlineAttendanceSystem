	<footer class="site-footer">
		<div class="container">
			<div class="row">
				<div class="col-5">
					<i class="fas fa-shoe-prints"></i>
				</div>
				<div class="col-7 footer-nav">
					<ul>
				    <?php // If User Is Logged In

				      	if (empty($_COOKIE["suser"])) { ?>

					      	<li>
						        <a  href="index.php">Login</a>
					      	</li>
					      	
					      	<li>
						        <a href="register.php">Register</a>
					      	</li>
					  	<?php }
			  			else{ ?>
					      	<li>
						        <a href="main.php">schedule</a>
					      	</li>
					      	<li>
						        <a href="logout.php">log out</a>
					      	</li>
				      	<?php } ?>
					</ul>
				</div>
			</div>
			<div class="row copy">
				<div class="col-5">
					<p>&copy; All Rights Reserved</p>
				</div>
				<div class="col-7 text-right">
					<p>Created By Prince</p>
				</div>
			</div>
		</div>
	</footer>
    <script src="js/jquery.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/jquery.js"></script>
		
  </body>
</html>