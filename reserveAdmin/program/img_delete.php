<?php
	include_once("../../include/db_connect.php");
	
	$wr_id = $_REQUEST['wr_id'];
	$profile_gb = $_REQUEST['profile_gb'];
	$bcate_id = $_REQUEST['bcate_id'];
	$scate_id = $_REQUEST['scate_id'];
	$sel_si_gb = $_REQUEST['sel_si_gb'];
	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	$page = $_REQUEST['page'];
	
	$object_url = "";
	
	if($profile_gb == "profile") {
		$query = "SELECT profile FROM comm_info WHERE wr_id = '".$wr_id."'";
		$result = mysql_query($query);
		$row = mysql_fetch_assoc($result);
		
		if($row) {
			$info_profile = $row['profile'];
			
			unlink("/home/hosting_users/jejubokji/www/map/resources/images/comm_info/" . $info_profile); // 이미지 파일 삭제 처리
			
			$update_query = "
				UPDATE 
					comm_info 
				SET 
					profile = ''
				WHERE 
					wr_id = '".$wr_id."'
			";
			
			mysql_query($update_query);
?>
			<script>
			window.onload = function() {
				alert("해당 대표자 사진이 정상적으로 삭제 처리되었습니다.");
				location.href = "/admin/kanzi/modify.php?wr_id=<?=$_REQUEST['wr_id']?>&bcate_id=<?=$bcate_id?>&scate_id=<?=$scate_id?>&sel_si_gb=<?=$sel_si_gb?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
				return;
			}
			</script>
<?
		}
	}

	if($profile_gb == "building_file") {
		$query = "SELECT building_profile FROM comm_info WHERE wr_id = '".$wr_id."'";
		$result = mysql_query($query);
		$row = mysql_fetch_assoc($result);
		
		if($row) {
			$info_building_profile = $row['building_profile'];
			
			unlink("/home/hosting_users/jejubokji/www/map/resources/images/comm_info/" . $info_building_profile); // 이미지 파일 삭제 처리
			
			$update_query = "
				UPDATE 
					comm_info 
				SET 
					building_profile = ''
				WHERE 
					wr_id = '".$wr_id."'
			";
			
			mysql_query($update_query);
?>
			<script>
			window.onload = function() {
				alert("해당 시설전경 사진이 정상적으로 삭제 처리되었습니다.");
				location.href = "/admin/kanzi/modify.php?wr_id=<?=$_REQUEST['wr_id']?>&bcate_id=<?=$bcate_id?>&scate_id=<?=$scate_id?>&sel_si_gb=<?=$sel_si_gb?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
				return;
			}
			</script>
<?
		}
	}

	if($profile_gb == "qr_file") {
		$query = "SELECT qr_file FROM comm_info WHERE wr_id = '".$wr_id."'";
		$result = mysql_query($query);
		$row = mysql_fetch_assoc($result);
		
		if($row) {
			$info_qr_file = $row['qr_file'];
			
			unlink("/home/hosting_users/jejubokji/www/map/resources/images/comm_info/" . $info_qr_file); // 이미지 파일 삭제 처리
			
			$update_query = "
				UPDATE 
					comm_info 
				SET 
					qr_file = ''
				WHERE 
					wr_id = '".$wr_id."'
			";
			
			mysql_query($update_query);
?>
			<script>
			window.onload = function() {
				alert("해당 QR코드 사진이 정상적으로 삭제 처리되었습니다.");
				location.href = "/admin/kanzi/modify.php?wr_id=<?=$_REQUEST['wr_id']?>&bcate_id=<?=$bcate_id?>&scate_id=<?=$scate_id?>&sel_si_gb=<?=$sel_si_gb?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
				return;
			}
			</script>
<?
		}
	}
?>