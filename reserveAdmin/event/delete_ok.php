<?php
	include_once("../../include/db_connect.php");
	
	$event_id = $_REQUEST['event_id'];
	
	$query = "
		DELETE 
		FROM 
			comm_info_event 
		WHERE 
			event_id = '".$event_id."'
	";
	
	mysql_query($query);
?>

<script>
window.onload = function() {
	alert("�ش� ���/�̺�Ʈ ������ �����Ǿ����ϴ�.");
	location.href = "/admin/event/list.php";
	return;
}
</script>
