<?php
	include_once("../include/db_conn.php");
	include_once("./_common.php");

	$g5['title'] = "예약신청";
	
	require_once(G5_THEME_PATH.'/head.php');

	$sql_program_sel = " SELECT * FROM rev_program_admin WHERE 1=1 and wr_id = '".$_REQUEST['program_id']."'";
	$sql_program_result = mysqli_query($conn, $sql_program_sel);
	$sql_program_row = mysqli_fetch_assoc($sql_program_result);
?>

<style>
#childrenArea {
	font-size:13px;
}

#childrenArea tr {
	height:30px;
}

#childrenArea td {
	text-align:center;
	background:#ffffff;
}
</style>

<link rel="stylesheet" type="text/css" href="/resource/js/jquery-ui-1.11.0/jquery-ui.min.css">
<script language="javascript" src="/resource/js/jquery-1.11.1.min.js"></script>
<script language="javascript" src="/resource/js/jquery-ui-1.11.0/jquery-ui.min.js"></script>
<script language="javascript" src="/resource/js/jquery.highlight-4.js"></script>

<div style="padding-top:30px;">
	<form name="reserveActionForm" id="reserveActionForm" method="post" action="/reserve/program_reserve_action.php">
	<div style="height:40px; border:1px solid #ebebeb; padding-top:20px; text-align:center; font-size:15px;"><?=$sql_program_row['program_name']?></div>
	<div>&nbsp;</div>
	<div style="height:30px;">■ 자녀정보</div>
	
	<?php
		$sql_count_sel = " SELECT count(*) cnt FROM g5_member_children WHERE 1=1 and mb_id = '".$member['mb_id']."'";
		$count_result = mysqli_query($conn, $sql_count_sel);
		
		$count_row = mysqli_fetch_assoc($count_result);
		
		$sql_sel = " SELECT * FROM g5_member_children WHERE 1=1 and mb_id = '".$member['mb_id']."'";
		$result = mysqli_query($conn, $sql_sel);
		
		$children_count = 0;
		
		if($count_row['cnt'] > 0) {
	?>
	<table width="100%" cellspacing="1" bgcolor="#ebebeb" id="childrenArea">
	<tr>
		<td style="width:25%;"></td>
		<td style="width:25%;">이름</td>
		<td style="width:25%;">생년월일</td>
		<td style="width:25%;">성별</td>
	</tr>
	<?php
			$mb_children_name = $_REQUEST['mb_children_name'];
			$mb_children_name_count = count($mb_children_name);

			for($i=0; $i<$mb_children_name_count; $i++) {
	?>
	<tr>
		<td>자녀 <?=($i+1)?></td>
		<td><input type="hidden" name="mb_children_name[]" value="<?=$_REQUEST['mb_children_name'][$i]?>" /><?=$_REQUEST['mb_children_name'][$i]?></td>
		<td><input type="hidden" name="mb_children_birth[]" value="<?=$_REQUEST['mb_children_birth'][$i]?>" /><?=$_REQUEST['mb_children_birth'][$i]?></td>
		<td><input type="hidden" name="mb_children_sex[]" value="<?=$_REQUEST['mb_children_sex'][$i]?>" /><?=($_REQUEST['mb_children_sex'][$i] == "M" ? "남자" : "여자")?></td>
	</tr>
	<?php
			}
	?>
	</table>
	<?php
		}
	?>

	<?php
		if($_REQUEST['room_id'] != "") {
	?>
	<div>&nbsp;</div>
	<div style="height:30px;">■ 선택 숙소정보</div>
	<div style="height:30px; padding-top:10px; padding-left:30px; border:1px solid #ebebeb;">
		<?php
			$roomadmin_sel = " SELECT * FROM roomadmin WHERE state = 'y' and room_id = '".$_REQUEST['room_id']."'";
			$roomadmin_result = mysqli_query($conn, $roomadmin_sel);
			$roomadmin_row = mysqli_fetch_assoc($roomadmin_result);
		?>
		<?=$roomadmin_row['room_name']?> (사용인원 : <?=$roomadmin_row['user_num']?>명)
	</div>
	<?php
		}
	?>

	<div>&nbsp;</div>
	<div style="height:30px;">■ 예약정보</div>

	<div>
		<table width="100%" style="background:#ebebeb;" cellspacing="1">
		<tr height="35px">
			<td align="left" style="background:#ffffff; padding-left:10px; text-align:center;" width="30%">
				체크인
			</td>
			<td style="background:#ffffff; padding-left:10px; text-align:center;"><?=$_REQUEST['check_in_date']?></td>
		</tr>
		<tr height="35px">
			<td align="left" style="background:#ffffff; padding-left:10px; text-align:center;" width="30%">
				체크아웃
			</td>
			<td style="background:#ffffff; padding-left:10px; text-align:center;"><?=$_REQUEST['check_out_date']?></td>
		</tr>
		<tr height="35px">
			<td align="left" style="background:#ffffff; padding-left:10px; text-align:center;" width="30%">
				참여인원
			</td>
			<td style="background:#ffffff; padding-left:10px; text-align:center;">
				<?=$mb_children_name_count?>명
			</td>
		</tr>
		<tr height="35px">
			<td align="left" style="background:#ffffff; padding-left:10px; text-align:center;" width="30%">
				프로그램 금액
			</td>
			<td style="background:#ffffff; padding-left:10px; text-align:center;">
				<?php 
					$program_amount = (intval($sql_program_row['program_price']) * intval($mb_children_name_count)) * intval(_setDate($_REQUEST['check_in_date'], $_REQUEST['check_out_date']));
					echo number_format($program_amount) . "원";
				?>
			</td>
		</tr>
		<tr height="35px">
			<td align="left" style="background:#ffffff; padding-left:10px; text-align:center;" width="30%">
				숙박 금액
			</td>
			<td style="background:#ffffff; padding-left:10px; text-align:center;">
				<?php
					$stay_amount = intval($roomadmin_row['price']) * intval(_setDate($_REQUEST['check_in_date'], $_REQUEST['check_out_date'])); 
					echo number_format($stay_amount) . "원";
				?>
			</td>
		</tr>
		<tr height="35px">
			<td align="left" style="background:#ffffff; padding-left:10px; text-align:center;" width="30%">
				총 금액
			</td>
			<td style="background:#ffffff; padding-left:10px; text-align:center;">
				<?
					$total_amount = intval($program_amount) + intval($stay_amount);
					echo number_format($total_amount) . "원";
				?>
			</td>
		</tr>
		</table>
		
		<input type="hidden" name="mb_id" id="mb_id" value="<?=$member['mb_id']?>" />
		<input type="hidden" name="check_in_date" id="check_in_date" value="<?=$_REQUEST['check_in_date']?>" />
		<input type="hidden" name="check_out_date" id="check_out_date" value="<?=$_REQUEST['check_out_date']?>" />
		<input type="hidden" name="apply_cnt" id="apply_cnt" value="<?=$mb_children_name_count?>" />
		<input type="hidden" name="stay_cnt" id="stay_cnt" value="<?=$mb_children_name_count?>" />
		<input type="hidden" name="stay_amount" id="stay_amount" value="<?=$stay_amount?>" />
		<input type="hidden" name="program_amount" id="program_amount" value="<?=$program_amount?>" />
		<input type="hidden" name="total_amount" id="total_amount" value="<?=$total_amount?>" />
		<input type="hidden" name="program_id" id="program_id" value="<?=$_REQUEST['program_id']?>" />
		<input type="hidden" name="reserve_class_id" id="reserve_class_id" value="<?=$roomadmin_row['room_id']?>" />
	</div>

	<div style="text-align:center; padding-top:30px;">
		<input class="btn_submit get_content" type="button" value="예약하기" style="height:30px; width:100px; letter-spacing:0px;" onclick="javascript:reserveGo();" />
		<input class="btn_submit get_content" type="button" value="취 소" style="height:30px; width:100px; letter-spacing:0px;" onclick="location.href = '/reserve/program_reserve01.php?program_id=<?=$_REQUEST['program_id']?>';" />
	</div>
	
	</form>
</div>

<script type="text/javascript">
function reserveGo() {
	var reserveActionForm = document.getElementById("reserveActionForm");

	var check_in_date = document.getElementById("check_in_date");
	var check_out_date = document.getElementById("check_out_date");
	
	/*
	if(check_in_date.value == "") {
		alert("체크인 날짜를 입력해주세요.");
		check_in_date.focus();
		return;
	}

	if(check_out_date.value == "") {
		alert("체크아웃 날짜를 입력해주세요.");
		check_out_date.focus();
		return;
	}
	*/
	
	if(confirm("이 프로그램을 예약하시겠습니까?")) {
		reserveActionForm.submit();
	}
}
</script>
<?php
	function _setDate($sDate,$eDate) {
		$returnDate = "";
		$date[0] = strtotime($sDate);
		$date[1] = strtotime($eDate);
		if($date[0] >= $date[1]) {
			$returnDate  = '-';
			return $returnDate;
		}
		$date[2] = strtotime(date('Y-m-d  H:i:s',$date[1] - $date[0]));
		$d   = date('j',$date[2])-1;
		if($d)  $returnDate  .= $d;
		
		return $returnDate;
	}
?>

<?php
	include_once(G5_THEME_PATH.'/tail.php');
?>