<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/db_conn.php");
	
	$category_name = $_REQUEST['category_name'];
	$category_sort = $_REQUEST['category_sort'];

	$searchSelectCategory = $_REQUEST['searchSelectCategory'];
	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	$page = $_REQUEST['page'];
	
	if($page == "") {
		$page = "1";
	}

	$query = "
		INSERT INTO program_category 
		(
			category_name,
			category_sort,
			reg_date,
			modi_date
		)
		VALUES
		(
			'".$category_name."',
			'".$category_sort."',
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
