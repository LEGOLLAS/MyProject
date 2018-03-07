<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/db_conn.php");
	
	$sukso_name = $_REQUEST['sukso_name'];
	$program_id = $_REQUEST['program_id'];
	$people_cnt = $_REQUEST['people_cnt'];
	$sukso_sort = $_REQUEST['sukso_sort'];
	
	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	$page = $_REQUEST['page'];
	
	if($page == "") {
		$page = "1";
	}

	$query = "
		INSERT INTO sukso 
		(
			sukso_name,
			program_id,
			people_cnt,
			sukso_sort,
			reg_date,
			modi_date
		)
		VALUES
		(
			'".$sukso_name."',
			'".$program_id."',
			'".$people_cnt."',
			'".$sukso_sort."',
			now(),
			now()
		)";
	
	mysqli_query($conn, $query);
?>

<script>
window.onload = function() {
	alert("입력하신 숙소 정보가 등록되었습니다.");
	location.href = "list.php?searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
	return;
}
</script>
