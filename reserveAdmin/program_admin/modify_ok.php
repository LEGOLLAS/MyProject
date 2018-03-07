<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/db_conn.php");
	
	$admin_id = $_REQUEST['admin_id'];
	$wr_id = $_REQUEST['wr_id'];
	$program_name = $_REQUEST['program_name'];
	$people_cnt = $_REQUEST['people_cnt'];
	$admin_start_date = $_REQUEST['admin_start_date'];
	$admin_end_date = $_REQUEST['admin_end_date'];	
	$program_price = $_REQUEST['program_price'];
	$admin_status = $_REQUEST['admin_status'];
	

	//-19840214
	//-01234567
	//$temp = array(substr($temp_data,0,4),substr($temp_data,4,2),substr($temp_data,6,2));
//	$children_birth = $temp[0]."-".$temp[1]."-".$temp[2];


	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	$page = $_REQUEST['page'];



	if($page == "") {
		$page = "1";
	}

	$query = "
		UPDATE 
			rev_program_admin  
		SET 
			wr_id = '".$wr_id."', 
			program_name = '".$program_name."', 
			people_cnt = '".$people_cnt."',
			admin_start_date = '".$admin_start_date."',
			admin_end_date = '".$admin_end_date."',
			program_price = '".$program_price."',
			admin_status = '".$admin_status."'
					
		WHERE 
			admin_id = '".$admin_id."';
	";
	
	mysqli_query($conn, $query);
?>
<script>
location.href = "/reserveAdmin/program_admin/list.php";
</script>
<!--
<script>
window.onload = function() {
	alert("수정되었습니다.");
	location.href = "list.php?searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
}
</script>
-->