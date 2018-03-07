<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/db_conn.php");
	
	$sukso_id = $_REQUEST['sukso_id'];
	
	if($manage_id != "") {
		$query = "
			DELETE 
			FROM 
				sukso 
			WHERE 
				sukso_id = '".$sukso_id."'
		";
		
		mysqli_query($conn, $query);
?>
	<script>
	window.onload = function() {
		alert("삭제되었습니다.");
		location.href = "list.php?searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>&page=<?=$_REQUEST['page']?>";
		return;
	}
	</script>
<?
	} else {
?>
	<script>
	window.onload = function() {
		alert("해당 숙소 고유번호를 찾을 수 없습니다.");
		location.href = "list.php?searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>&page=<?=$_REQUEST['page']?>";
		return;
	}
	</script>
<?
	}	
?>
