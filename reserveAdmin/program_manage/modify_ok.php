<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/db_conn.php");
	
	$manage_id = $_REQUEST['manage_id'];
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
		UPDATE 
			program_manage_admin 
		SET 
			manage_name = '".$manage_name."', 
			manage_sort = '".$manage_sort."', 
			modi_date = now() 
		WHERE 
			manage_id = '".$manage_id."'
	";
	
	mysqli_query($conn, $query);
?>

<script>
window.onload = function() {
	alert("수정되었습니다.");
	location.href = "list.php?searchSelectCategory=<?=$searchSelectCategory?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
}
</script>
