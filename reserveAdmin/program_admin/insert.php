<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/header.php");
	
	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	$page = $_REQUEST['page'];

	if($page == "") {
		$page = "1";
	}
?>

<script>
$(document).ready(function(){
	
	
	$("#program_name").change(function(){
			$("#programIDarea").html($("select[name=program_name] option:selected").attr("mid") + " <input type='hidden' name='wr_id' id='wr_id'  value='"+$("select[name=program_name] option:selected").attr("mid")+"' />");
	});

	
});

/*
function changeProgramID(val) {
	document.getElementById("programIDarea").innerHTML = "<input type='text' name='wr_id' id='wr_id'  value='"+val+"' />";
}
*/

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

	<div id="contentArea">
		<div id="subTitle">프로그램 운영 등록</div>
		<div id="subContent">
			<div style="padding:10px;">
					
				<form name="insertForm" id="insertForm" method="post" action="/reserveAdmin/program_admin/insert_ok.php ">
				
				<input type="hidden" id="searchSelect" name="searchSelect" value="록?=$searchSelect?>" />
				<input type="hidden" id="searchKeyword" name="searchKeyword" value="<?=$searchKeyword?>" />
				<input type="hidden" id="page" name="page" value="<?=$page?>" />
				

				<div id="insertArea">
					<table width="100%" cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse; table-layout:fixed;">

							
					<tr height="40px" align="center">
						<th width="15%">프로그램 명</th>
						<td align="left">
						<!--
							<select name="program_name" id="program_name" style="height:30px;" onchange="javascript:changeProgramID(this.value);">
						-->
							<select name="program_name" id="program_name" style="height:30px;">
							<option value=""  mid=""> - 선택하세요 - </option>
								<?php
									$program_sql = " SELECT wr_id, wr_subject FROM program ";
									$program_result = mysqli_query($conn, $program_sql);
									
									while($program_row = mysqli_fetch_array($program_result)) {
										if($program_row['wr_id'] == $row['wr_subject']) {
								?>
								<option value="<?=$program_row['wr_subject']?>" mid="<?=$program_row['wr_id']?>" selected><?=$program_row['wr_subject'] ?></option>
								<?php
										} else {
								?>
								<option value="<?=$program_row['wr_subject']?>" mid="<?=$program_row['wr_id']?>" ><?=$program_row['wr_subject']?></option>
								<?php
										}
									}
								?>
						</select>
						</td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">프로그램  ID</th>
							<td align="left"><span id="programIDarea"></span>
						</td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">운영시작일</th>
						<td align="left"><input type="text" class="DatePicker" name="admin_start_date"/></td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">운영종료일</th>
						<td align="left"><input type="text" class="DatePicker" name="admin_end_date"/></td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">신청자수</th>
						<td align="left"><input type="text" name="people_cnt" id="people_cnt" style="width:98%; height:30px;" /></td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">프로그램금액</th>
						<td align="left"><input type="text" name="program_price" id="program_price" style="width:98%; height:30px;" /></td>
					</tr>
					<tr>
						<th>객실사용(유/무)</th>
						<td>
							<fieldset>
								 <span>사용유</span><input type="radio" name="admin_status" value="y"/>
								 <span>사용무</span><input type="radio" name="admin_status" value="n" checked/>
							</fieldset>
						
						</td>							
					</tr>

					</table>
				</div>

				<div id="insertButtonArea">
					<input type="submit" class="btn_submit" value="등록" />

					<input type="button" class="btn_submit" value="뒤로가기" onclick="location.href = 'list.php?searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>&page=<?=$_REQUEST['page']?>';" />
				</div>








				</form>
			</div>
		</div>
	</div>
</div>

<?php
	include_once("../include/footer.php");
?>