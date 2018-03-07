<?php
	session_start();

	unset($_SESSION['memberId']);
	unset($_SESSION['memberPw']);
	unset($_SESSION['memberLevel']);
	
	if($_SESSION['memberId'] == "") {
?>

<script>
window.onload = function() {
	location.href = "/reserveAdmin/login.php";
	return;
}
</script>

<?	} ?>