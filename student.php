<?php
		$sql_student="select * from student order by roll_no";
		if(isset($_GET['sbmt_search'])){
			$search=$_GET['search'];
			$sql_student="select * from student where roll_no like '%".$search."%' or name like '%".$search."%' or subject like '%".$search."%' or course like '%".$search."%'  order by roll_no limit 20";
	}
?>
