<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/db_conn.php");
	
	$wr_id = $_REQUEST['wr_id'];
	$program_name = $_REQUEST['program_name'];
	$people_cnt = $_REQUEST['people_cnt'];
	$admin_start_date = $_REQUEST['admin_start_date'];
	$admin_end_date = $_REQUEST['admin_end_date'];	
	$program_price = $_REQUEST['program_price'];
	$admin_status = $_REQUEST['admin_status'];
	
	echo $program_name;

	//-19840214
	//-01234567
	//$temp = array(substr($temp_data,0,4),substr($temp_data,4,2),substr($temp_data,6,2));
	//	$children_birth = $temp[0]."-".$temp[1]."-".$temp[2];
	
//	$sukso_sort = $_REQUEST['sukso_sort'];
	

	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	$page = $_REQUEST['page'];
	
	if($page == "") {
		$page = "1";
	}

/*
		wr_id,
			program_name,
			people_cnt,
			admin_start_date,
			admin_end_date,
			program_price,
			admin_status,

*/

	$query =" 
			INSERT INTO rev_program_admin 
		(
			wr_id,
			program_name,
			people_cnt,
			admin_start_date,
			admin_end_date,
			program_price,
			admin_status
		)
		VALUES
		(
			'".$wr_id."','".$program_name."','".$people_cnt."','".$admin_start_date ."','".$admin_end_date ."','".$program_price  ."','".$admin_status."')";
	
	mysqli_query($conn, $query);
?>
<script>
	location.href = "/reserveAdmin/program_admin/list.php";
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