<!DOCTYPE HTML>
<HTML>
 <HEAD>
  <TITLE> New Document </TITLE>
  <META charset="utf-8">
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>



<script>
function changeProgramID(val) {
	document.getElementById("programIDarea").innerHTML = val;
}
$(function(){
	$(".DatePicker").datepicker({
		dateFormat: 'yy-mm-dd',
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

 </HEAD>

 <BODY>
<? include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/header.php"); ?>
 <h1>프로그램 운영 입력</h1>
 <div>
	<form id="" method="post" action="">
		<select name="program_id" id="program_id" style="height:30px;" onchange="javascript:changeProgramID(this.value);">
					<option value=""> - 선택하세요 - </option>
							<?php
								$program_sql = " SELECT wr_id, wr_subject FROM program ";
								$program_result = mysqli_query($conn, $program_sql);

								while($program_row = mysqli_fetch_array($program_result)) {
									if($program_row['wr_id'] == $row['wr_subject']) {
							?>
							<option value="<?=$program_row['wr_id']?>" selected><?=$program_row['wr_subject']?></option>
							<?php
									} else {
							?>
							<option value="<?=$program_row['wr_id']?>"><?=$program_row['wr_subject']?></option>
							<?php
									}
								}
							?>
				</select>
		<div>
			<span>프로그램 ID:</span><span id="programIDarea"></span>
		</div>



		<div>
			<span>신청자수:</span><input type="text" name="user_num"/>
		</div>
		<div>
			<span>운영시작일:</span><input type="text" class="DatePicker" name="user_num"/>
		</div>
		<div>
			<span>운영종료일:</span><input type="text"  class="DatePicker" name="user_num" />
		</div>
		<div>
			<span>객실:</span> <span>유</span><input type="radio" name="room_state" value="y"/><span>무</span><input type="radio" name="room_state" value="n"/>
		</div>
		<div>
			<input type="submit" value="확인"/><input type="reset" value="취소"/>
		</div>
</form>
 </div>

 </BODY>
</HTML>



