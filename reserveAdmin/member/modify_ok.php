<?php
	include_once("../../include/db_connect.php");
	
	$board_no = $_REQUEST['board_no'];
	$title = $_REQUEST['title'];
	$writer = $_REQUEST['writer'];
	$contents = $_REQUEST['contents'];
		
	$query = "
		UPDATE 
			notice 
		SET 
			title = '".$title."', 
			writer = '".$writer."', 
			contents = '".$contents."', 
			modi_date = now() 
		WHERE 
			board_no = '".$board_no."'
	";
	
	mysql_query($query);
?>

<script>
window.onload = function() {
	alert("입력하신 공지사항 정보가 수정되었습니다.");
	location.href = "/admin/notice/list.php";
}
</script>
