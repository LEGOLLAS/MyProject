<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/db_conn.php");
	
	$room_name = $_REQUEST['room_name'];
	$user_num = $_REQUEST['user_num'];
	$room_price = $_REQUEST['room_price'];
//	$sukso_sort = $_REQUEST['sukso_sort'];
	

	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	$page = $_REQUEST['page'];
	
	if($page == "") {
		$page = "1";
	}

	$query =" 
			INSERT INTO roomadmin 
		(
			room_name,
			user_num,
			price	
		)
		VALUES
		(
			'".$room_name."','".$user_num."','".$room_price."')";
	//	echo $query;
	
			
	mysqli_query($conn, $query);
?>
<script>
	location.href = "/reserveAdmin/room/list.php";
</script>

<!--
<script>
window.onload = function() {
	alert("입력하신 숙소 정보가 등록되었습니다.");
	location.href = "list.php?searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
	return;
}
</script>
-->