<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/db_conn.php");
	
	$rev_reserve_id = $_REQUEST['rev_reserve_id'];
	
	if($rev_reserve_id != "") {
		$query = "
			DELETE 
			FROM 
				rev_reserve 
			WHERE 
				rev_reserve_id = '".$rev_reserve_id."'
		";
		
	
		mysqli_query($conn, $query);
?>
<script>
location.href = "/reserveAdmin/room_rev/list.php";
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