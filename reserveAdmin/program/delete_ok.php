<?php
	include_once($_SERVER['DOCUMENT_ROOT'] ."/reserveAdmin/include/db_conn.php");
	
	$wr_id = $_REQUEST['wr_id'];
	$bcate_id = $_REQUEST['bcate_id'];
	$scate_id = $_REQUEST['scate_id'];
	$sel_si_gb = $_REQUEST['sel_si_gb'];
	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	$page = $_REQUEST['page'];

	$select_query = "SELECT * FROM program WHERE wr_id = '".$wr_id."'";

	$select_result = mysqli_query($conn, $select_query);
	$select_row = mysqli_fetch_assoc($select_result);
	
	if($select_row) {		
		$query = "
				DELETE 
				FROM 
					program 
				WHERE 
					wr_id = '".$wr_id."'
			";
			
			mysqli_query($conn, $query);
?>

		<script>
		window.onload = function() {
			alert("해당 프로그램이 삭제되었습니다.");
			location.href = "/reserveAdmin/program/list.php";
			return;
		}
		</script>
<?php
	}
?>