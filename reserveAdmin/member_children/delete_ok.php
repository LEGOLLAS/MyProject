<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/db_conn.php");
	
	$children_id = $_REQUEST['children_id'];
	
	if($children_id != "") {
		$query = "
			DELETE 
			FROM 
				rev_member_children 
			WHERE 
				children_id = '".$children_id."'
		";
		
		mysqli_query($conn, $query);
?>
<script>
location.href = "/reserveAdmin/member_children/list.php";
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