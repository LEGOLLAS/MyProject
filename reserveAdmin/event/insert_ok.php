<?php
	include_once("../../include/db_connect.php");
	
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
		INSERT INTO comm_info_event 
		(
			category_id,
			bcategory_id,
			scategory_id,
			wr_id,
			event_place,
			event_title,
			event_content,
			event_start_date,
			event_end_date,
			event_ip,
			event_sort,
			reg_date,
			modi_date
		)
		VALUES
		(
			'".$category_id."',
			'".$bcategory_id."',
			'".$scategory_id."',
			'".$wr_id."',
			'".$event_place."',
			'".$event_title."',
			'".$event_content."',
			date_format('".$event_start_date."', '%Y-%m-%d'),
			date_format('".$event_end_date."', '%Y-%m-%d'),
			'".$event_ip."',
			'".$event_sort."',
			now(),
			now()
		)";
	
	mysql_query($query);
?>

<script>
window.onload = function() {
	alert("등록되었습니다.");
	location.href = "/admin/event/list.php";
	return;
}
</script>
