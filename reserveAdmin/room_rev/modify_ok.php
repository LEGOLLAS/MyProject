<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/db_conn.php");
	
	$mb_id = $_REQUEST['mb_id'];
	$reserve_class_id = $_REQUEST['reserve_class_id'];
	$check_in_date = $_REQUEST['check_in_date'];
	$check_out_date = $_REQUEST['check_out_date'];
	$stay_cnt = $_REQUEST['stay_cnt'];
	$stay_amount = $_REQUEST['stay_amount'];
	$program_amount = $_REQUEST['program_amount'];

	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	$page = $_REQUEST['page'];

	if($page == "") {
		$page = "1";
	}

	$query = " 
		UPDATE 
			rev_reserve 
		SET 
			mb_id = '".$mb_id."',
			reserve_class_id = '".$reserve_class_id."',
			check_in_date = '".$check_in_date."',
			check_out_date = '".$check_out_date."',
			stay_cnt = '".$stay_cnt."',
			stay_amount = '".$stay_amount."',
			program_amount = '".$program_amount."'
		WHERE rev_reserve_id = '".$_REQUEST['rev_reserve_id']."'";
	
	mysqli_query($conn, $query);
?>
<script>
	location.href = "/reserveAdmin/room_rev/list.php";
</script>