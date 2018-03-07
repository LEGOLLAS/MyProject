<?php
	include_once("../../include/db_connect.php");
	
	$event_id = $_REQUEST['event_id'];
	$category_id = $_REQUEST['category_id'];
	$bcategory_id = $_REQUEST['bcategory_id'];
	$scategory_id = $_REQUEST['scategory_id'];
	$wr_id = $_REQUEST['wr_id'];
	
	$event_place = $_REQUEST['event_place'];
	$event_title = $_REQUEST['event_title'];
	$event_content = $_REQUEST['event_content'];
	$event_start_date = $_REQUEST['event_start_date'];
	$event_end_date = $_REQUEST['event_end_date'];
	$event_ip = $_SERVER['REMOTE_ADDR'];
	$event_sort = $_REQUEST['event_sort'];

	$query = "
		UPDATE 
			comm_info_event 
		SET 
			category_id = '".$category_id."', 
			bcategory_id = '".$bcategory_id."', 
			scategory_id = '".$scategory_id."', 
			wr_id = '".$wr_id."', 
			event_place = '".$event_place."', 
			event_title = '".$event_title."', 
			event_content = '".$event_content."', 
			event_start_date = '".$event_start_date."', 
			event_end_date = '".$event_end_date."', 
			event_sort = '".$event_sort."', 
			modi_date = now() 
		WHERE 
			event_id = '".$event_id."'
	";

	mysql_query($query);
?>

<script>
window.onload = function() {
	alert("수정되었습니다.");
	location.href = "/admin/event/list.php";
}
</script>
