<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/db_conn.php");
	
	$category_id = $_REQUEST['category_id'];
	
	if($category_id != "") {
		$query = "
			DELETE 
			FROM 
				program_category 
			WHERE 
				category_id = '".$category_id."'
		";
		
		mysqli_query($conn, $query);
?>
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
		alert("해당 프로그램 카테고리 고유번호를 찾을 수 없습니다.");
		location.href = "list.php?searchSelectCategory=<?=$_REQUEST['searchSelectCategory']?>&searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>&page=<?=$_REQUEST['page']?>";
		return;
	}
	</script>
<?
	}	
?>
