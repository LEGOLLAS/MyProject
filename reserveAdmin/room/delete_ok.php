<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/db_conn.php");
	
	$room_id = $_REQUEST['room_id'];
	
	if($room_id != "") {
		$query = "
			DELETE 
			FROM 
				roomAdmin 
			WHERE 
				room_id = '".$room_id."'
		";
		
		mysqli_query($conn, $query);
?>
<script>
	location.href = "/reserveAdmin/room/list.php";
</script>
<!--
	<script>
	window.onload = function() {
		alert("삭제되었습니다.");
		location.href = "list.php?searchSelectCategory=<?=$_REQUEST['searchSelectCategory']?>&searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>&page=<?=$_REQUEST['page']?>";
		return;
	}
	</script>
<?


	} else {
?>
	<script>
	window.onload = function() {
		alert("해당 프로그램 운영일 고유번호를 찾을 수 없습니다.");
		location.href = "list.php?searchSelectCategory=<?=$_REQUEST['searchSelectCategory']?>&searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>&page=<?=$_REQUEST['page']?>";
		return;
	}
	</script>
<?
	}	
?>
-->