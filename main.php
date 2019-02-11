<?php
require_once('header.php');
require_once 'topArea.php';
if (isset($_COOKIE["suser"])) {
	$conn = mysqli_connect("localhost","root","","attendance");
	if(!$conn){
				echo "Did not Connect".mysql_error();
			}

	if (isset($_GET['id'])) {

			$_SESSION['single_student_id']	=	$_GET['id'];
			header('location:single_student.php');
	}
	elseif (isset($_GET['lecture_id'])) {
			
			$_SESSION['single_schedule_id']	=	$_GET['lecture_id'];
			header('location:single_lecture.php');

	}
?>
		<div class="container-fluid main-page">

			<div class="main-section container-fluid">		
			<ul class="nav nav-tabs nav-justified font-weight-bold text-uppercase">
			    <li class="nav-item">
			      <a class="nav-link active" data-toggle="tab" href="#schedule">Schedule</a>
			    </li>
			    <li class="nav-item">
			      <a class="nav-link" data-toggle="tab" href="#student">Students</a>
			    </li>
			    <li class="nav-item">
			      <a class="nav-link" data-toggle="tab" href="#update">Add Data</a>
			    </li>
		  	</ul>

		  	<div class="tab-content">
		  				  	

	  		<!-- Schedule -->
			  	<div class="tab-pane container-fluid p-3 active" id="schedule">

			  		<?php include('schedule.php') ?> <!-- PHP code for schedule tab -->
			  		
			  		<div class="tab-pane container-fluid p-3 active" id="schedule">
						<div class="main-table">
							<table class="table table-hover">
							    <thead class="thead-dark">
							      <tr>
							      	<th></th>
						      		<th>No.</th>
							        <th>Days</th>
							        <th>Lecture Time</th>
							        <th>Subject</th>
							        <th>Course</th>
							        <th>Sem</th>
							      </tr>
							    </thead>
							    <tbody>

							    	<?php 
							    	if($result_schedule=mysqli_query($conn,$sql_schedule)){
								
										if (mysqli_num_rows($result_schedule) > 0) {


									    	while($row = mysqli_fetch_assoc($result_schedule)) {
							    			?>
							      <tr class="table-links">
							      	<td><a href=""><i class="fas fa-pen-square"></i></a></td>
							        <td><a href="main.php?lecture_id=<?php echo $row['lecture_id']; ?>"><?php echo $row['lecture_no']; ?></a></td>
							        <td><a href="main.php?lecture_id=<?php echo $row['lecture_id']; ?>"><?php echo $row['days']; ?></a></td>
							        <td><a href="main.php?lecture_id=<?php echo $row['lecture_id']; ?>"><?php echo $row['ftime']." To ".$row['ttime']; ?></a></td>
							        <td><a href="main.php?lecture_id=<?php echo $row['lecture_id']; ?>"><?php echo $row['subject']; ?></a></td>
							        <td><a href="main.php?lecture_id=<?php echo $row['lecture_id']; ?>"><?php echo $row['course']; ?></a></td>
							        <td><a href="main.php?lecture_id=<?php echo $row['lecture_id']; ?>"><?php echo $row['sem']; ?></a></td>
							      </tr>
							      <?php } } }?>
							    </tbody>
							  </table>
							  
					  	</div>
					</div>
			  	</div>
		  	<!-- /Schedule -->



		  	<!-- Student -->
			  	<div class="tab-pane container-fluid p-3 fade" id="student">

			  		<?php include('student.php') ?> <!-- PHP code for student tab -->


					<form method="get" action="main.php">	
						<div class="input-group mb-3">
						  	<input type="text" class="form-control" name="search" placeholder="Search">
						  	<div class="input-group-append">
							    <button class="btn btn-primary" type="submit" name="sbmt_search">Search</button>
						  	</div>
						</div>
				  	</form>  		
			  		<div class="main-table">
						<table class="table table-hover">
							    <thead class="thead-dark">
							      <tr>
						      		<th>Roll No.</th>
							        <th>Name</th>
							        <th>Course</th>
							        <th>Sem</th>
							        <th>Subjects</th>
							        <th>Picture</th>
							      </tr>
							    </thead>
							    <tbody>
							    

							    	<?php 

							    	if($result_student=mysqli_query($conn,$sql_student)){
												
										if (mysqli_num_rows($result_student) > 0) {
								    		


									    	while($row = mysqli_fetch_assoc($result_student)) {
								    			?>
									     
									      <tr class="table-links">
									      	 <td><a href="main.php?id=<?php echo $row['id']; ?>"><?php echo $row["roll_no"]; ?></a></td>
									         <td><a href="main.php?id=<?php echo $row['id']; ?>"><?php echo $row["name"]; ?></a></td>
									         <td><a href="main.php?id=<?php echo $row['id']; ?>"><?php echo $row["course"]; ?></a></td>
									         <td><a href="main.php?id=<?php echo $row['id']; ?>"><?php echo $row["sem"]; ?></a></td>
									         <td><a href="main.php?id=<?php echo $row['id']; ?>"><?php echo $row["subject"]; ?></a></td>
									         <td><a href="main.php?id=<?php echo $row['id']; ?>"><img src="<?php echo $row["pic"]; ?>" height="100px" width="100px"/></a></td>
									      </tr>

							      	<?php }}}else{
							      		echo mysqli_error($conn);
							      	} ?>
							      
								
							    </tbody>
					  	</table>
					</div>
				</div>
		 	<!-- /Student -->



		 	<!-- Add New Data Tab -->
			  	<div class="tab-pane container-fluid p-3 fade" id="update">
			  		<?php include('update.php') ?>
			  		
			  		
			  		<?php //Success or Error msgs on query 
		  				if (!empty($msg_add_data_schedule)) {
					  
					  	 ?>
						  	<div class="alert alert-success my-1">
							  <strong><?php echo $msg_add_data_schedule  ?></strong>
							</div>
						<?php } ?>
					<?php if (!empty($msg_add_data_student)) {
					  
							  	 ?>
								  	<div class="alert alert-success my-1">
									  <strong><?php echo $msg_add_data_student  ?></strong>
									</div>
								<?php } 
						if (!empty($error_add_data_student)) {
				  
				  	 ?>
					  	<div class="alert alert-danger my-1">
						  <strong><?php echo $error_add_data_student  ?></strong>
						</div>
					<?php } ?>

			  		<!-- Add Student Form -->
			  		<div class="alert alert-primary add-data-heading" id="student_head">
					 	<h2 class="font-weight-bold">Add Student</h2>
					</div>
				 	<form method="post" id="add_student" action="main.php"  enctype="multipart/form-data">
			   		 	<div class="input-group mb-3">
						    <div class="input-group-prepend">
						      	<span class="input-group-text">Roll No</span>
						    </div>
						    <input type="number" min="1" class="form-control" name="roll_no" required>
					  	</div>

					  	<div class="input-group mb-3">
						    <div class="input-group-prepend">
						      	<span class="input-group-text">Name</span>
						    </div>
						    <input type="text" class="form-control" name="name" required>
					  	</div>


					  	<div class="input-group mb-3">
						    <div class="input-group-prepend">
						      	<span class="input-group-text">Course</span>
						    </div>
						    <select  class="custom-select form-control" name="course" required>
						    	<option selected>Select Course</option>
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
						    	<option selected>Select Semester</option>
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
						    <input type="text" class="form-control" id="sub-selector" list="languages" placeholder="Seprate by commas" >
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
						    	<input type="file" class="form-control custom-file-input" id="customFile" name="fileToUpload">
						    	 <label class="custom-file-label" for="customFile">Choose file</label>
							</div>
					  	</div>
					  	<button type="submit" class="btn btn-primary" name="sbmts">Add Student</button>
					  	
					</form>
					

					
					<!-- Schedule form -->
					<div class="alert alert-primary add-data-heading" id="schedule_head">
					 	<h2 class="font-weight-bold">Add Schedule</h2>
					</div>

				 	<form id="add_schedule" method="post" action="main.php" >

					  	<div class="input-group mb-3">
						    <div class="input-group-prepend">
						      	<span class="input-group-text">Lecture No</span>
						    </div>
						    <input type="number" class="form-control" name="lecture_no">
					  	</div>

					  	<div class="input-group mb-3">
						    <div class="input-group-prepend">
						      	<span class="input-group-text">From Time</span>
						    </div>
						    <input type="time" class="form-control" name="ftime">
					  	</div>


					  	<div class="input-group mb-3">
						    <div class="input-group-prepend">
						      	<span class="input-group-text">To Time</span>
						    </div>
						    <input type="time" class="form-control" name="ttime" />
					  	</div>

					  	<div class="input-group mb-3">
						    <div class="input-group-prepend">
						      	<span class="input-group-text">Subject</span>
						    </div>
						    <select class="form-control custom-select" name="subject" >
					    	  			<option selected="">Select Subject</option>
					    	  	<?php foreach ($subjects as $subject) {?>
					    	  			
									    <option value="<?php echo $subject; ?>"><?php echo $subject; ?></option>
								
								 <?php } ?>

						  	</select>
					  	</div>

					  	<input type="hidden" name="course" id="course-hidden" required>
					  	<div class="values" id="course-values-list">
					  			<ul></ul>
					  	</div>
					  	<div class="input-group mb-3">
					  		
						    <div class="input-group-prepend">
						      	<span class="input-group-text">Course</span>
						    </div>
						    <input type="text" class="form-control"  id="course-selector" list="course-list" placeholder="Seprate by commas" >
					    	  	<datalist id="course-list">
								    <?php foreach($courses as $course){ ?>
										<option value="<?php echo $course ?>">
									<?php } ?>
							  	</datalist>
										
					  	</div>

					  	<div class="input-group mb-3">
						    <div class="input-group-prepend">
						      	<span class="input-group-text">Semester</span>
						    </div>
						    <select  class="custom-select form-control" name="sem" required>
						    	<option selected>Select Semester</option>
						    	<?php for($sem=1;$sem<=10;$sem++){ ?>
									<option value="<?php echo "Sem ".$sem ?>"><?php echo "Sem ".$sem ?></option>
								<?php } ?>
							</select>
					  	</div>
					  	
					  	<div class="input-group mb-3">
						    <div class="input-group-prepend">
						      	<span class="input-group-text">Teacher</span>
						    </div>
					     	<select class="custom-select form-control" name="teacher">
							    <option selected>Select Teacher</option>
							    <?php if (mysqli_num_rows($res_select_teacher)>0) {
						    			while ($row = mysqli_fetch_assoc($res_select_teacher)) {
						    	?>
						    				<option value="<?php echo $row['email']; ?>"><?php echo $row['name'] ?></option>

						    	<?php }} ?>
							   
					 	 	</select>
						    
					  	</div>

					  	<div class="weekDays-selector">
						  	<input type="checkbox" id="weekday-mon" class="weekday" value="mon" name="day[]" />
						  	<label for="weekday-mon">Mon</label>
						  	<input type="checkbox" id="weekday-tue" class="weekday" value="tue" name="day[]" />
					  		<label for="weekday-tue">Tue</label>
						  	<input type="checkbox" id="weekday-wed" class="weekday" value="wed" name="day[]" />
					  		<label for="weekday-wed">Wed</label>
						  	<input type="checkbox" id="weekday-thu" class="weekday" value="thu" name="day[]" />
						  	<label for="weekday-thu">Thu</label>
					  		<input type="checkbox" id="weekday-fri" class="weekday" value="fri" name="day[]" />
						  	<label for="weekday-fri">Fri</label>
						  	<input type="checkbox" id="weekday-sat" class="weekday" value="sat" name="day[]" />
						  	<label for="weekday-sat">Sat</label>
						</div>
					  	<button type="submit" class="btn btn-primary" name="sbmtt">Add Schedule</button>
					  	
					</form>

			  	</div>
			</div>
		</div>
	</div>

		<!-- /Add New Data Tab -->
	<?php
}
else{
		header('Location:index.php');
	}

	require_once('footer.php');
?>
