<?php
	include_once("../../include/db_connect.php");
	
	$title = $_REQUEST['title'];
	$contents = $_REQUEST['contents'];
	$writer = $_REQUEST['writer'];
	
	$query = "
		INSERT INTO notice 
		(
			board_no,
			title,
			contents,
			writer,
			hit_cnt,
			reg_date,
			modi_date
		)
		VALUES
		(
			(select max(board_no) + 1 from notice),
			'".$title."',
			'".$contents."',
			'".$writer."',
			'1',
			now(),
			now()
		)";
	//echo $query;
	//exit;
	mysql_query($query);
?>
	<script>
	window.onload = function() {
		alert("�Է��Ͻ� �������� ������ ��ϵǾ����ϴ�.");
		location.href = "/admin/notice/list.php";
		return;
	}
	</script>
