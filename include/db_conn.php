<?php
	$mysql_db_host = "localhost";
	$mysql_db_user = "jejuatopycenter";
	$mysql_db_password = "jeju7828963**";
	$mysql_db_name = "jejuatopycenter";
	$mysql_db_server = "localhost";
	
	$conn = mysqli_connect($mysql_db_host, $mysql_db_user, $mysql_db_password, $mysql_db_name);
	mysqli_query($conn, "set names utf8");

	if (!$conn) {
		die('Connect Error!');
	}
?>