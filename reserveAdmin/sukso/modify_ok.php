<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/db_conn.php");
	
	$sukso_id = $_REQUEST['sukso_id'];
	$sukso_name = $_REQUEST['sukso_name'];
	$people_cnt = $_REQUEST['people_cnt'];
	$program_id = $_REQUEST['program_id'];
	$sukso_sort = $_REQUEST['sukso_sort'];
	
	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	$page = $_REQUEST['page'];

	if($page == "") {
		$page = "1";
	}

	$query = "
		UPDATE 
			sukso 
		SET 
			sukso_name = '".$sukso_name."', 
			people_cnt = '".$people_cnt."', 
			program_id = '".$program_id."', 
			sukso_sort = '".$sukso_sort."', 
			modi_date = now() 
		WHERE 
			sukso_id = '".$sukso_id."'
	";
	
	mysqli_query($conn, $query);
?>

<script>
window.onload = function() {
	alert("수정되었습니다.");
	location.href = "list.php?searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
}
</script>
