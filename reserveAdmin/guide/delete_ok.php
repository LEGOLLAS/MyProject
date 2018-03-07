<?php
	include_once("../../include/db_connect.php");
	
	$board_no = $_REQUEST['board_no'];
	
	$query = "
		DELETE 
		FROM 
			guide 
		WHERE 
			board_no = '".$board_no."'
	";
	
	mysqli_query($conn, $query);
?>

<script>
window.onload = function() {
	alert("삭제되었습니다.");
	location.href = "/admin/guide/list.php";
	return;
}
</script>
