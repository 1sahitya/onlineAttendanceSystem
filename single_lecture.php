<?php
require 'topArea.php';
require 'header.php';

$server	=	"localhost";
$user	=	"root";
$pass	=	"";
$db		=	"attendance";
$conn 	=	mysqli_connect($server,$user,$pass,$db);
if(!$conn){
	die("Connection failed:");
}


if(isset($_SESSION['single_schedule_id'])) {
	$sql				=	"select * from schedule where lecture_id=".$_SESSION['single_schedule_id'];

	$result_lecture		=	mysqli_query($conn,$sql);

	if(mysqli_num_rows($result_lecture) > 0){

		while ($row 	=	mysqli_fetch_assoc($result_lecture)) {
			$lecture_id	=	$row["lecture_id"];
			$sub		=	$row["subject"];
			$course		=	$row["course"];
			$sem		=	$row["sem"];
		}
			
	}

	$courses			=	explode(",", $course);
	$course 			=	"'".implode("','", $courses)."'";
	$sql				=	"select * from student where course IN (".$course.") and sem='".$sem."' and subject LIKE '%".$sub."%' order by roll_no";

	$result_lecture_students	=	mysqli_query($conn,$sql);


//for grabbing student ids 
	$student_id_holder	=	array();

?>
<div class="container-fluid main-page">

	<div class="main-section container">
		<h2 class="text-uppercase my-4 text-center font-weight-bold">
			Register Attendance 
		</h2>
		
		<form method="post" action="single_lecture.php">
			<div class="main-table">
			
				<table class="table table-hover">
					    <thead class="thead-dark">
					      <tr>
					      	<th>Mark</th>
				      		<th>Roll No.</th>
					        <th>Name</th>
					        <th>Course</th>
					        <th>Sem</th>
					        <th>Picture</th>
					      </tr>
					    </thead>
					    <tbody>
					    

					    	<?php 
			
								if (mysqli_num_rows($result_lecture_students) > 0) {
						    		
									$counter	=	0;


							    	while($row = mysqli_fetch_assoc($result_lecture_students)) {
						    			
						    			array_push($student_id_holder,$row['id']);
						    			?>
							     		
							      <tr>
							      	 <td> <div class="pretty p-icon p-round p-jelly p-pulse">
							      	 		<input type="hidden" name="<?php echo 'check_'.$counter; ?>" value="0" />
									        <input type="checkbox" class="check" name="<?php echo 'check_'.$counter; ?>" value="1" />
									        <div class="state p-success">
									            <i class="icon fas fa-check text-white"></i>
									            <label></label>
									        </div>
									    </div>
									</td>
							      	 <td><?php echo $row["roll_no"]; ?></td>
							         <td><?php echo $row["name"]; ?></td>
							         <td><?php echo $row["course"]; ?></td>
							         <td><?php echo $row["sem"]; ?></td>
							         <td><img src="<?php echo $row["pic"]; ?>" height="100px" width="100px"/></a></td>
							      </tr>

					      	<?php
					      	$counter 	=	$counter + 1;
					      	 }}else{
						      		echo "NO Content Found";
					      	} ?>
					      
						
					    </tbody>
			  	</table>
		  	
	  		</div>

		  	<div class="row">
	  			<div class="col-sm-2 text-capitalize d-flex align-items-center justify-content-end">
	  				<h5>check all</h5>
	  			</div>
		  		<div class="col-sm-1">
			        <div onclick="check_all();"class="check-container bg-success">
			        	<div class="check-text">
				            <i class="fas fa-check text-white"></i>
			            </div>
				    </div>
			    </div>
			    <div class="col-sm-2 text-capitalize d-flex align-items-center justify-content-end">
	  				<h5>uncheck all</h5>
	  			</div>
			    <div class="col-sm-1">
				    <div onclick="uncheck_all();" class="check-container bg-danger">
			            <div class="check-text">
				            <i class="fas fa-times text-white"></i>
			            </div>
			    	</div>
			    </div>
	  			<div class="col-sm-2">
	  				<input type="date" name="attendance_date" class="form-control" required="">
	  			</div>
		  		<div class="col-sm-4 d-flex align-items-center justify-content-between">
		  			<button class="btn btn-primary" type="submit" name="submit_attendance">
		  				Submit Attendance
		  			</button>
	  			
		  			<button class="btn btn-danger" name="delete_schedule">
		  				Delete Schedule
		  			</button>
	  			</div>

	    	</div>
    	</form>
  	<?php
		//submit attendance

		if (isset($_POST['submit_attendance'])) {
				
				$sql_attendance="";
				$no_of_insertions	=	count($student_id_holder);
				for ($i=0; $i < $no_of_insertions; $i++) { 

					$sql_attendance.="insert into attendance (student_id,lecture_id,date,attended) values (".$student_id_holder[$i].",".$lecture_id.",'".$_POST['attendance_date']."',".$_POST['check_'.$i].");";
				
				}

				$sql_attendance = 	trim($sql_attendance,";");
				
				if (mysqli_multi_query($conn,$sql_attendance)) {
					$submit_attendance_msg	=	"Attendance Submitted Successfully";
				}
				
				else{
					$submit_attendance_msg	=	"Attendance is Not Submitted";
				}
		}


		//Delete Schedule

		if (isset($_POST['delete_schedule'])) {
			mysqli_multi_query($conn,"delete from schedule where lecture_id=".$lecture_id);
			header('location:main.php');
		}
		//Success or Error msgs on query 
			if (!empty($submit_attendance_msg)) {
	  
	  	 ?>
		  	<div class="alert alert-success my-1">
			  <strong><?php echo $submit_attendance_msg  ?></strong>
			</div>
		<?php } ?>
  	</div>
</div>

<?php


	}

else{
	header('location:main.php');
}

	require 'footer.php';
?>