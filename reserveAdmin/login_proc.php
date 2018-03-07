<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/db_conn.php");
	
	$count_result_query = "SELECT count(*) cnt FROM reserve_member WHERE mb_id = '".$_REQUEST['member_id']."' AND mb_password = password('".$_REQUEST['member_password']."') AND mb_level = '10'";	
	$count_result_set = mysqli_query($conn, $count_result_query);
	$count_result_row = mysqli_fetch_assoc($count_result_set);
	
	if($count_result_row['cnt'] > 0) {
		
		session_start();
		
		$_SESSION['memberId'] = $_REQUEST['member_id'];
		$_SESSION['memberPw'] = $_REQUEST['member_password'];
		$_SESSION['memberLevel'] = "10";
?>
	<script>
	window.onload = function() {
		alert("로그인 성공!");
		location.href = "/reserveAdmin/";
		return;
	}
	</script>
<?
	} else {
?>
	<script>
	window.onload = function() {
		alert("로그인 실패!");
		location.href = "/reserveAdmin/login.php";
		return;
	}
	</script>
<?
	}
?>