<?php

	$error_add_data_student="";
	
	///////////////////////////////////////////////////////////////
	//File Uploader///////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////
	if (isset($_FILES["fileToUpload"])) {

		if($_FILES["fileToUpload"]["name"]!=""){

				$target_file="";
				$target_file = "uploads/".$_POST["name"]."-".rand(1,10000000)."-".basename($_FILES["fileToUpload"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				// Check if image file is a actual image or fake image
				/*
				    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				    if($check !== false) {
				        $uploadOk = 1;
				    } else {
				        $error= "File is not an image.";
				        $uploadOk = 0;
				    }
				*/
				// Check if file already exists
				if (file_exists($target_file)) {
				    echo "Sorry, file already exists.";
				    $uploadOk = 0;
				}
				// Check file size
				if ($_FILES["fileToUpload"]["size"] > 2097152) {
				    $error="Sorry, your file is too large.";
				    $uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				    $error_add_data_student="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				    $uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
				    $error_add_data_student="Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else {
				    if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				        $error_add_data_student = "Sorry, there was an error uploading your file.";
				    } 
				}
		}	
	}
///////////////////////////////////////////////////////////////
//add student///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
if (isset($_POST['sbmts'])) {

		$sub=trim($_POST["sub"],",");

			$sql_add_data_student="insert into student (roll_no,name,course,sem,subject,pic) values('".$_POST['roll_no']."','".$_POST['name']."','".$_POST['course']."','".$_POST['sem']."','".$sub."','".$target_file."')";
		
			$res_add_data_student = mysqli_query($conn,$sql_add_data_student);

		if($res_add_data_student)
		{
			$msg_add_data_student="Record Added Successfully";
		}
		else{

		}
	}

///////////////////////////////////////////////////////////////
// Update Student///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
if (isset($_POST['update_student'])) {
	$sub=trim($_POST["sub"],",");

			if ($_POST["sub"]=="") {
				$sub=$_POST['sub-selector'];
			}
			$sql_update_data_student="update student SET roll_no='".$_POST['roll_no']."',name='".$_POST['name']."',course='".$_POST['course']."',sem='".$_POST['sem']."',subject='".$sub."',pic='".$target_file."' where id=".$_SESSION['single_student_id'];

			$res_update_data_student=mysqli_query($conn,$sql_update_data_student);

			if($res_update_data_student)
			{
				
				$msg_update_data_student="Record Updated Successfully";
				header('location:main.php');
			}
	}
///////////////////////////////////////////////////////////////
// Delete Student///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////

if (isset($_POST['delete_student'])) {
	$sql_delete_student	=	"delete from student where id=".$_SESSION['single_student_id'];
	mysqli_query($conn,$sql_delete_student);
	header('location:main.php');
}




///////////////////////////////////////////////////////////////
// query to add new schedule///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
	if (isset($_POST['sbmtt'])) {

		$lecture_days="";
		$count=0;

		if(!empty($_POST['day'])){

			foreach ($_POST['day'] as  $day) {
				if($day)
				{
					$lecture_days.=$day.", ";
					$count+=1;
				}
			}

			$lecture_days=trim($lecture_days,", ");
			if ($count==6) {
				$lecture_days="All Six Days";
			}
		}

			$course 	=	trim($_POST['course'],",");
		
		$sql_add_data_schedule="insert into schedule (lecture_no,days,ftime,ttime,subject,course,sem,teacher) values('".$_POST['lecture_no']."','".$lecture_days."','".$_POST['ftime']."','".$_POST['ttime']."','".$_POST['subject']."','".$course."','".$_POST['sem']."','".$_POST['teacher']."')";

		if (mysqli_query($conn,$sql_add_data_schedule)) {
			$msg_add_data_schedule="Data Added Successfully!";
		}

	}



	//add schedule teacher selector
	$sqlerror="";
		$sql_select_teacher="select name,email from user order by name";

		$res_select_teacher=mysqli_query($conn,$sql_select_teacher); 
	

	//list of subjects

	$subjects=array('C',
					'C++',
					'Data Structures',
					'Python',
					'Java',
					'Database Management System',
					'Communication Skills',
					'Punjabi',
					'Basic Mathematics',
					'Numerical Methods and Statics',
					'Fundamental of Computers',
					'Digital Electronics',
					'System and Design Analysis',
					'Operating System',
					'Computer Networks',
					'E Business',
					'Network Operating System',
					'Web Technologies'
					);
	sort($subjects);


	//list of courses
	$courses 	= 	array('Advance Diploma Course in French (Part Time)',
	'Advance Diploma Course in German (Part Time)',
	'B. A. (Women Empowerment)',
	'B. Com. LL. B. (FYC)',
	'B. Design (Multimedia)',
	'B. Vocational (Animation)',
	'B. Vocational (Automobile Technology)',
	'B. Vocational (Banking &amp; Financial Services)',
	'B. Vocational (Contemporary Forms of Dance)',
	'B. Vocational (E-Commerce &amp; Digital Marketing)',
	'B. Vocational (Entertainment Technology)',
	'B. Vocational (Fashion Styling &amp; Grooming)',
	'B. Vocational (Fashion Technology)',
	'B. Vocational (Financial Market &amp; Services)',
	'B. Vocational (Financial Market Management)',
	'B. Vocational (Journalism and Mass Communication)',
	'B. Vocational (Management &amp; Secretarial Practices)',
	'B. Vocational (Modern Office Practice)',
	'B. Vocational (Nutrition &amp; Dietetics)',
	'B. Vocational (Nutrition, Exercise &amp; Health)',
	'B. Vocational (Photography &amp; Journalism)',
	'B. Vocational (Printing Technology)',
	'B. Vocational (Refrigeration &amp; Air Conditioning)',
	'B. Vocational (Retail Management &amp; I.T.)',
	'B. Vocational (Retail Management)',
	'B. Vocational (Software Development)',
	'B. Vocational (Sound Technology)',
	'B. Vocational (Textile Design &amp; Apparel Technology)',
	'B. Vocational (Theatre &amp; Stage Craft)',
	'B. Vocational (Web Technology &amp; Multimedia)',
	'B.A.',
	'B.A. (HONOURS)',
	'B.A. Journalism &amp; Mass Communication',
	'B.Sc.',
	'B.SC. (Information Technology)',
	'B.Sc. in Internet &amp; Mobile Technologies',
	'BA LL.B  (FIVE YEARS INTEGRATED COURSE)',
	'BACHELOR IN INTERNET &amp; MOBILE TECHNOLOGIES',
	'Bachelor of Arts (Honours School) In English',
	'Bachelor of Business Administration',
	'Bachelor of Commerce',
	'Bachelor of Commerce (Hons.)',
	'Bachelor of Commerce (Professional)',
	'Bachelor of Computer Applications',
	'Bachelor of Design',
	'BACHELOR OF EDUCATION',
	'BACHELOR OF FINE ARTS',
	'Bachelor of Food Science &amp; Technology (Hons.)',
	'Bachelor of Laws',
	'Bachelor of Library &amp; Information Science',
	'Bachelor of Multimedia',
	'Bachelor of Science (Bio-Technology)',
	'Bachelor of Science (Fashion Designing)',
	'Bachelor of Science (Home Science)',
	'Bachelor of Tourism and Hotel Management',
	'Certificate Course in Arabic (Part Time)',
	'Certificate Course in French (Part Time)',
	'Certificate Course in German (Part Time)',
	'Certificate Course in Persian (Part Time)',
	'Certificate Course in Russian (Part Time)',
	'Certificate Course in Urdu (Part Time)',
	'Diploma Course in Arabic (Part Time)',
	'Diploma Course in Computer Applications (Full Time)',
	'Diploma Course in Computer Maintenance (Full Time)',
	'Diploma Course in French (Full Time)',
	'Diploma Course in French (Part Time)',
	'Diploma Course in German (Part Time)',
	'Diploma Course in Urdu (Part Time)',
	'Diploma in Cosmetology (Full Time)',
	'DIPLOMA IN COUNSELLING',
	'DIPLOMA IN FOOD PRODUCTION',
	'DIPLOMA IN FRONT OFFICE OPERATIONS',
	'Diploma in Library Science',
	'Diploma in Stitching &amp; Tailoring (Full Time)',
	'LL.B. (Three Years Course)',
	'M. DESIGN (MULTIMEDIA)',
	'M.A. DANCE',
	'M.A. ECONOMICS',
	'M.A. ENGLISH',
	'M.A. FINE ARTS',
	'M.A. FRENCH',
	'M.A. GEOGRAPHY',
	'M.A. HINDI',
	'M.A. HISTORY',
	'M.A. HISTORY OF ART',
	'M.A. Journalism &amp; Mass Communication',
	'M.A. MUSIC INSTRUMENTAL',
	'M.A. MUSIC VOCAL',
	'M.A. POLICE ADMINISTRATION',
	'M.A. POLITICAL SCIENCE',
	'M.A. PUBLIC ADMINISTRATION',
	'M.A. PUNJABI',
	'M.A. RELIGIOUS STUDIES',
	'M.A. SANSKRIT',
	'M.A. SOCIOLOGY',
	'M.A.BUSINESS ECONOMICS &amp; I.T.',
	'M.Sc. (Information and Networking Security)',
	'M.Sc. Bioinformatics',
	'M.Sc. Biotechnology',
	'M.Sc. Botany',
	'M.Sc. Chemistry',
	'M.Sc. Computer Science',
	'M.Sc. FASHION DESIGNING AND MERCHANDISING',
	'M.Sc. Information Technology',
	'M.Sc. INTERNET STUDIES',
	'M.Sc. Mathematics',
	'M.Sc. Physics',
	'M.Sc. Zoology',
	'MASTER IN FINE ARTS (APPLIED ART)',
	'Master of Commerce',
	'Master of Education',
	'MASTERS IN MULTIMEDIA',
	'MASTERS IN TOURISM MANAGEMENT',
	'P. G. Diploma in Computer Applications',
	'P. G. Diploma in Computer Applications (Teacher Education)',
	'P. G. Diploma in Financial Services (Banking &amp; Insruance)',
	'P. G. Diploma in Garment Construction &amp; Fashion Designing',
	'Post Graduate Diploma in Business Management',
	'Post Graduate Diploma in Cosmetology',
	'Post Graduate Diploma in Cosmetology &amp; Health Care',
	'Post Graduate Diploma in Fashion Makeover',
	'Post Graduate Diploma in Marketing Management',
	'Post Graduate Diploma in Nutrition &amp; Dietetics',
	'Post Graduate Diploma in Personnel Management &amp; Industrial Relations',
	'Post Graduate Diploma in Web Designing');

	sort($courses);

?>