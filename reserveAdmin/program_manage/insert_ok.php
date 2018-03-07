<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/db_conn.php");
	
	$manage_name = $_REQUEST['manage_name'];
	$manage_sort = $_REQUEST['manage_sort'];

	$searchSelectCategory = $_REQUEST['searchSelectCategory'];
	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	$page = $_REQUEST['page'];
	
	if($page == "") {
		$page = "1";
	}

	$query = "
		INSERT INTO program_manage_admin 
		(
			manage_name,
			manage_sort,
			reg_date,
			modi_date
		)
		VALUES
		(
			'".$manage_name."',
			'".$manage_sort."',
			now(),
			now()
		)";
	
	mysqli_query($conn, $query);
?>

<script>
window.onload = function() {
	alert("등록되었습니다.");
	location.href = "list.php?searchSelectCategory=<?=$searchSelectCategory?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
	return;
}
</script>
