<?php
	include_once("../../include/db_connect.php");
	
	$board_no = $_REQUEST['board_no'];
	
	$query = "
		DELETE 
		FROM 
			notice 
		WHERE 
			board_no = '".$board_no."'
	";
	
	mysql_query($query);
?>

<script>
window.onload = function() {
	alert("삭제되었습니다.");
	location.href = "/admin/notice/list.php";
	return;
}
</script>
