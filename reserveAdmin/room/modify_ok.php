<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/db_conn.php");
	
	$room_id = $_REQUEST['room_id'];
	$room_name = $_REQUEST['room_name'];
	$user_num = $_REQUEST['user_num'];
	$room_price = $_REQUEST['room_price'];
	$room_state = $_REQUEST['room_state'];
	
	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	$page = $_REQUEST['page'];

	if($page == "") {
		$page = "1";
	}

	$query = "
		UPDATE 
			roomadmin 
		SET 
			room_name = '".$room_name."', 
			user_num = '".$user_num."', 
			price = '".$room_price."', 
			state = '".$room_state."' 
			
		WHERE 
			room_id = '".$room_id."';
	";
	
	echo $query;
	mysqli_query($conn, $query);
?>
<script>
location.href = "/reserveAdmin/room/list.php";
</script>
<!--
<script>
window.onload = function() {
	alert("수정되었습니다.");
	location.href = "list.php?searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
}
</script>
-->