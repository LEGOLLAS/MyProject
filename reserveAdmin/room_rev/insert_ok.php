<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/db_conn.php");
	
	$rev_reserve_id = $_REQUEST['rev_reserve_id'];
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

	$query =" 
			INSERT INTO rev_reserve
		(
			rev_reserve_id,
			mb_id,
			reserve_class_id,
			check_in_date,
			check_out_date,
			stay_cnt,
			stay_amount,
			program_amount
		)
		VALUES
		(
			'".$rev_reserve_id."','".$mb_id."','".$reserve_class_id."','".$check_in_date ."','".$check_out_date ."','".$stay_cnt  ."','".$stay_amount."','".$program_amount."')";
	
	//echo $query;
	mysqli_query($conn, $query);
?>
<script>
	location.href = "/reserveAdmin/room_rev/list.php";
</script>

<!--
<script>
window.onload = function() {
	alert("입력하신 숙소 정보가 등록되었습니다.");
	location.href = "list.php?searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
	return;
}
</script>
-->