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

<script>
$(document).ready(function(){
	$("#check_in_date, #check_out_date, .birthDay").datepicker({
		dateFormat:'yy-mm-dd',
			prevText: '이전 달',
			nextText: '다음 달',
			monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			dayNames: ['일','월','화','수','목','금','토'],
			dayNamesShort: ['일','월','화','수','목','금','토'],
			dayNamesMin: ['일','월','화','수','목','금','토'],
			showMonthAfterYear: true,
			yearSuffix: '년'
	});
});
</script>

<?
	$sql_count_sel = " SELECT count(*) cnt FROM g5_member_children WHERE 1=1 and mb_id = '".$member['mb_id']."'";
	$count_result = mysqli_query($conn, $sql_count_sel);
	
	$count_row = mysqli_fetch_assoc($count_result);
?>

<div style="padding-top:30px;">
	<div style="height:40px; border:1px solid #ebebeb; padding-top:20px; text-align:center; font-size:15px;"><?=$sql_program_row['program_name']?></div>
	
	<div style="margin-top:10px;">
		<form name="reserveForm" id="reserveForm" method="post" action="/reserve/program_reserve02.php">
		<input type="hidden" name="program_id" value="<?=$_REQUEST['program_id']?>" />
		<div>■ 자녀정보</div>
		<div style="padding-top:10px; padding-bottom:10px;">
			자녀수 : <input type="text" name="children_cnt" id="children_cnt" onkeyup="javascript:childrenInputCnt();" size="10" style="text-align:center;" class="frm_input" value="<?=$count_row['cnt']?>" />명
		</div>
		<div id="childrenAreaOra">
			<?php
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
					while($select_row = mysqli_fetch_array($result)) {
						$children_count++;
			?>
			<tr>
				<td>자녀 <?=$children_count?></td>
				<td><input type="text" name="mb_children_name[]" value="<?=$select_row['mb_children_name']?>" style="text-align:center; width:99%;" class="frm_input" /></td>
				<td><input type="text" name="mb_children_birth[]" value="<?=$select_row['mb_children_birth']?>" style="text-align:center; width:99%;" class="frm_input" /></td>
				<td>
					<select name="mb_children_sex[]">
					<option value="M"<? if($select_row['mb_children_sex'] == "M") {?> selected<? } ?>>남자</option>
					<option value="F"<? if($select_row['mb_children_sex'] == "F") {?> selected<? } ?>>여자</option>
					</select>
				</td>
			</tr>
			<?php
					}
			?>
			</table>
			<?php
				}
			?>
		</div>
		
		<div style="height:50px; padding-top:30px;">
			<table width="100%" style="background:#ebebeb;" cellspacing="1">
			<tr height="50px">
				<td align="center" style="background:#ffffff; width:92px;">숙소 선택</td>
				<td align="center" style="background:#ffffff; text-align:left; padding-left:30px;">
					<select name="room_id" id="room_id">
					<option value="">- 선택해주세요. -</option>
					<option value="0">사용안함</option>
					<?php
						$roomadmin_sel = " SELECT * FROM roomadmin WHERE state = 'y'";
						$roomadmin_result = mysqli_query($conn, $roomadmin_sel);

						while($roomadmin_row = mysqli_fetch_array($roomadmin_result)) {
							$room_id = $roomadmin_row['room_id'];
							$room_name = $roomadmin_row['room_name'];	
							$user_num = $roomadmin_row['user_num'];	
							$price = $roomadmin_row['price'];	
					?>
					<option value="<?=$room_id?>"><?=$room_name?> (사용인원 : <?=$user_num?>명, 금액 : <?=$price?>원)</option>
					<?
						}
					?>
					</select>
				</td>
			</tr>
			</table>
		</div>
		
		<div style="height:50px; padding-top:30px;">
			<table width="100%" style="background:#ebebeb;" cellspacing="1">
			<tr height="50px">
				<td align="center" style="background:#ffffff;">일정 선택</td>
				<td align="center" style="background:#ffffff;">
					체크인 : <input type="text" id="check_in_date" name="check_in_date" class="frm_input" style="text-align:center;" /> 
					체크아웃 : <input type="text" id="check_out_date" name="check_out_date" class="frm_input" style="text-align:center;" />
				</td>
			</tr>
			</table>
		</div>

		<div style="text-align:center; padding-top:30px;">
			<input class="btn_submit get_content" type="button" value="다 음" style="height:30px; width:100px;" onclick="javascript:reserveGo();" />
			<input class="btn_submit get_content" type="button" value="취 소" style="height:30px; width:100px;" onclick="location.href = '/reserve/program_list.php';" />
		</div>
		</form>
	</div>
</div>

<script type="text/javascript">
function reserveGo() {
	var reserveForm = document.getElementById("reserveForm");

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
	
	reserveForm.submit();
}

function childrenInputCnt() {
	var children_cnt = $("#children_cnt").val();
	var childrenInputStr = "<table width=\"100%\" cellspacing=\"1\" bgcolor=\"#ebebeb\" id=\"childrenArea\">";
	childrenInputStr += "<tr>";
	childrenInputStr += "<td style=\"width:25%;\"></td>";
	childrenInputStr += "<td style=\"width:25%;\">이름</td>";
	childrenInputStr += "<td style=\"width:25%;\">생년월일</td>";
	childrenInputStr += "<td style=\"width:25%;\">성별</td>";
	childrenInputStr += "</tr>";
	
	if(!(children_cnt >= 0 && children_cnt <= 20)) {
		alert("자녀수는 최대 20명까지만 입력이 가능합니다.");
		childrenInputStr = "";
		$("#childrenAreaOra").html(childrenInputStr);
		$("#childrenAreaOra").hide();
		$("#children_cnt").focus();
		return;
	} else {		
		for(var i=1; i<=children_cnt; i++) {
			var mb_children_cntAt = children_cnt.charAt(i);
			
			if(!(mb_children_cntAt >= 0 && mb_children_cntAt <= 9)) {
				alert("자녀수는 숫자로만 입력할 수 있습니다.");
				$("#children_cnt").val("");
				$("#children_cnt").focus();
				childrenInputStr = "";
				return;
			} else {
				childrenInputStr += "<tr>";
				childrenInputStr += "<td>자녀 "+i+"</td>";
				childrenInputStr += "<td><input type=\"text\" name=\"mb_children_name[]\" style=\"text-align:center; width:99%;\" class=\"frm_input\" /></td>";
				childrenInputStr += "<td><input type=\"text\" name=\"mb_children_birth[]\" style=\"text-align:center; width:99%;\" class=\"frm_input\" /></td>";
				childrenInputStr += "<td><select name=\"mb_children_sex[]\"><option value=\"M\">남자</option><option value=\"F\">여자</option></select></td>";
				childrenInputStr += "</tr>";
			}
		}
		
		childrenInputStr += "</table>";

		$("#childrenAreaOra").show();
		$("#childrenAreaOra").html(childrenInputStr);
	}
}
</script>

<?php
	include_once(G5_THEME_PATH.'/tail.php');
?>