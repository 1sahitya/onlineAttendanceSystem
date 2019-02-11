<?php
	require 'topArea.php';
	require 'header.php';
	
	$server="localhost";
	$user="root";
	$pass="";
	$db="attendance";
	$conn = mysqli_connect($server,$user,$pass,$db);
	if(!$conn){
	die("Connection failed:");
	}

	if (isset($_SESSION['single_student_id'])) {
		$sql				=	"select * from student where id=".$_SESSION['single_student_id'];
	
		$result_single		=	mysqli_query($conn,$sql);

		if(mysqli_num_rows($result_single) > 0){
			while ($row 	=	mysqli_fetch_assoc($result_single)) {
				$roll_no	=	$row["roll_no"];
				$name		=	$row["name"];
				$course		=	$row["course"];
				$sem		=	$row["sem"];
				$sub		=	$row["subject"];
				$pic		=	$row["pic"];
			}
				
		}
	}

	else{
		header('location:main.php');
	}
	

	if (isset($_POST['update_student'])) {
		if ($_FILES["fileToUpload"]["name"]	==	"") {
			$target_file	=	$pic;
		}
	}

	require_once 'update.php';




?>

<div class="contianer-fluid main-page">

	<div class="container main-section">
		
		<h2 class="text-uppercase my-4 text-center font-weight-bold">
			update student data 
		</h2>
		<form method="post" id="update_student" action="single_student.php"  enctype="multipart/form-data">
   		 	<div class="input-group mb-3">
			    <div class="input-group-prepend">
			      	<span class="input-group-text">Roll No</span>
			    </div>
			    <input type="number" min="1" class="form-control" name="roll_no" value="<?php echo $roll_no ?>" required>
		  	</div>

		  	<div class="input-group mb-3">
			    <div class="input-group-prepend">
			      	<span class="input-group-text">Name</span>
			    </div>
			    <input type="text" class="form-control" name="name" value="<?php echo $name ?>" required>
		  	</div>


		  	<div class="input-group mb-3">
			    <div class="input-group-prepend">
			      	<span class="input-group-text">Course</span>
			    </div>
			    <select  class="custom-select form-control" name="course" required>
			    	<option selected><?php echo $course ?></option>
			    	<?php foreach($courses as $course){ ?>
						<option value="<?php echo $course ?>"><?php echo $course ?></option>
					<?php } ?>
				</select>
		  	</div>

		  	<div class="input-group mb-3">
			    <div class="input-group-prepend">
			      	<span class="input-group-text">Semester</span>
			    </div>
			    <select  class="custom-select form-control" name="sem" required>
			    	<option selected><?php echo $sem ?></option>
			    	<?php for($sem=1;$sem<=10;$sem++){ ?>
						<option value="<?php echo "Sem ".$sem ?>"><?php echo "Sem ".$sem ?></option>
					<?php } ?>
				</select>
		  	</div>
		  	<input type="hidden" name="sub" id="hidden-sub" required>
		  	<div class="values" id="sub-values-list">
		  			<ul></ul>
		  		</div>
		  	<div class="input-group mb-3">
		  		
			    <div class="input-group-prepend">
			      	<span class="input-group-text">Subjects</span>
			    </div>
			    <input type="text" class="form-control" id="sub-selector" name="sub-selector" list="languages" value="<?php echo $sub ?>" placeholder="Seprate by commas" >
		    	  	<datalist id="languages">
					    <?php foreach ($subjects as $subject) {?>
		    	  			
						    <option value="<?php echo $subject; ?>">
					
					    <?php } ?>
				  	</datalist>
							
		  	</div>

		  	<div class="input-group mb-3">
			    <div class="input-group-prepend">
			      	<span class="input-group-text">Picture</span>
			    </div>
			    <div class="custom-file">
			    	<input type="file" class="form-control custom-file-input" id="customFile" value="<?php echo $pic ?>" name="fileToUpload">
			    	 <label class="custom-file-label" for="customFile">Choose Picture to Update</label>
				</div>
		  	</div>
		  	<div class="row">
		  		<div class="col-sm-2">
				  	<button type="submit" class="btn btn-primary" name="update_student" >Update</button>
				  	<button class="btn btn-danger" name="delete_student">Delete</button>
				</div>
				<?php 
					$attendance	=	mysqli_query($conn,"select attended from attendance where student_id=".$_SESSION['single_student_id']);
					$absent		=	0;
					$present	=	0;
					while ($row =	mysqli_fetch_assoc($attendance) )   {
						if($row["attended"]==1)
						{
							$present	=	$present + 1 ;
						}
						else{
							$absent		=	$absent	+ 1 ;
						}
					}
					$total	=	$present + $absent;
					if ($total != 0) {
						
					$present_percentage	=	round($present * 100 / $total,2);
					$absent_percentage	=	round(100 - $present_percentage,2);
				?> 
				<div class="col-sm-10">
					 <div class="progress" style="height: 100%;">
					  <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width:<?php echo $present_percentage;?>%">
					    <h5><?php echo $present_percentage;?>% Present</h5>
					  </div>
					  <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" style="width:<?php echo $absent_percentage;?>%">
					    <h5><?php echo $absent_percentage;?>% Absent</h5>
					  </div>
					</div>
				</div>
			<?php } ?>
			</div>  	
		</form>

	</div>

</div>

<?php 
require_once 'footer.php';
?>