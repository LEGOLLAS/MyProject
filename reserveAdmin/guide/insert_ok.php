<?php
	include_once("../../include/db_connect.php");
	
	$title = $_REQUEST['title'];
	$contents = $_REQUEST['contents'];
	$writer = $_REQUEST['writer'];
	
	$query = "
		INSERT INTO guide 
		(
			title,
			contents,
			writer,
			hit_cnt,
			reg_date,
			modi_date
		)
		VALUES
		(
			'".$title."',
			'".$contents."',
			'".$writer."',
			'1',
			now(),
			now()
		)";
	
	mysqli_query($conn, $query);
?>
	<script>
	window.onload = function() {
		alert("입력하신 사용 가이드 정보가 등록되었습니다.");
		location.href = "/admin/guide/list.php";
		return;
	}
	</script>
