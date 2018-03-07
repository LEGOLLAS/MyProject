<?php
	include_once("../../include/db_connect.php");
	
	$board_no = $_REQUEST['board_no'];
	$title = $_REQUEST['title'];
	$writer = $_REQUEST['writer'];
	$contents = $_REQUEST['contents'];
		
	$query = "
		UPDATE 
			guide 
		SET 
			title = '".$title."', 
			writer = '".$writer."', 
			contents = '".$contents."', 
			modi_date = now() 
		WHERE 
			board_no = '".$board_no."'
	";
	
	mysqli_query($conn, $query);
	
	mysqli_close($conn);
?>

<script>
window.onload = function() {
	alert("입력하신 사용 가이드 정보가 수정되었습니다.");
	location.href = "/admin/guide/list.php";
}
</script>
