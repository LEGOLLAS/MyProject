<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/db_conn.php");
	
	$mb_id = $_REQUEST['mb_id'];
	$children_id = $_REQUEST['children_id'];
	$children_name = $_REQUEST['children_name'];
	$temp_data = $_REQUEST['children_birth'];
	$children_sex = $_REQUEST['children_sex'];

	$temp_data = str_replace("-", "", $temp_data);
	
	//-19840214
	//-01234567
	$temp = array(substr($temp_data,0,4),substr($temp_data,4,2),substr($temp_data,6,2));
	$children_birth = $temp[0]."-".$temp[1]."-".$temp[2];


	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	$page = $_REQUEST['page'];

	if($page == "") {
		$page = "1";
	}

	$query = "
		UPDATE 
			rev_member_children  
		SET 
			mb_id = '".$mb_id."', 
			children_name = '".$children_name."', 
			children_birth = '".$children_birth."',
			children_sex = '".$children_sex."'
		WHERE 
			children_id = '".$children_id."';
	";
	
	mysqli_query($conn, $query);
?>
<script>
location.href = "/reserveAdmin/member_children/list.php";
</script>
<!--
<script>
window.onload = function() {
	alert("수정되었습니다.");
	location.href = "list.php?searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
}
</script>
-->