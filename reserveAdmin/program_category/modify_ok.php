<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/db_conn.php");
	
	$category_id = $_REQUEST['category_id'];
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
		UPDATE 
			program_category 
		SET 
			category_name = '".$category_name."', 
			category_sort = '".$category_sort."', 
			modi_date = now() 
		WHERE 
			category_id = '".$category_id."'
	";
	
	mysqli_query($conn, $query);
?>

<script>
window.onload = function() {
	alert("수정되었습니다.");
	location.href = "list.php?searchSelectCategory=<?=$searchSelectCategory?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
}
</script>
