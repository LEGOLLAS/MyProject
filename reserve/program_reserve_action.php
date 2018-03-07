<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/include/db_conn.php");
	
	$reserve_class_id = $_REQUEST['reserve_class_id'];

	if($reserve_class_id == "") {
		$reserve_class_id = "0";
	}
	
	$query = "
		INSERT 
		INTO 
			rev_reserve 
		(
			mb_id,
			program_id,
			reserve_class_id,
			check_in_date,
			check_out_date,
			apply_cnt,
			stay_cnt,
			stay_amount,
			program_amount,
			total_amount
		)
		VALUES 
		(
			'".$_REQUEST['mb_id']."',
			'".$_REQUEST['program_id']."',
			'".$reserve_class_id."',
			'".$_REQUEST['check_in_date']."',
			'".$_REQUEST['check_out_date']."',
			'".$_REQUEST['apply_cnt']."',
			'".$_REQUEST['stay_cnt']."',
			'".$_REQUEST['stay_amount']."',
			'".$_REQUEST['program_amount']."',
			'".$_REQUEST['total_amount']."'
		)
	";
	
	mysqli_query($conn, $query);
	
	$reserve_id = mysqli_insert_id($conn);

	$children_apply_insert_query = "
		INSERT 
		INTO 
			rev_apply_children 
		(
			reserve_id, 
			mb_id
		)
		VALUES 
		(
			'".$reserve_id."',
			'".$_REQUEST['mb_id']."'
		)
	";
	
	mysqli_query($conn, $children_apply_insert_query);
	
	$children_insert_query = "";
	$mb_children_name = $_REQUEST['mb_children_name'];
	$mb_children_name_count = count($mb_children_name);

	for($i=0; $i<$mb_children_name_count; $i++) {
		$mb_children_name_str = $_REQUEST['mb_children_name'][$i];
		$mb_children_birth_str = $_REQUEST['mb_children_birth'][$i];
		$mb_children_sex_str = $_REQUEST['mb_children_sex'][$i];

		$children_insert_query = "
			INSERT 
			INTO 
				rev_member_children
			(
				mb_id, 
				children_name, 
				children_birth, 
				children_sex
			)
			VALUES 
			(
				'".$_REQUEST['mb_id']."', 
				'".$mb_children_name_str."', 
				'".$mb_children_birth_str."', 
				'".$mb_children_sex_str."'
			)
		";

		mysqli_query($conn, $children_insert_query);
	}
?>


<script>
window.onload = function() {
	alert("예약 접수가 완료되었습니다.");
	location.href = "/reserve/program_list.php";
	return;
}

</script>
