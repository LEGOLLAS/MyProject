<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/header.php");
	
	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	$page = $_REQUEST['page'];

	if($page == "") {
		$page = "1";
	}


	$info_query = "select * from rev_reserve as a, roomadmin as b, g5_member as c where a.reserve_class_id=b.room_id and c.mb_id=a.mb_id and 1=1 and a.rev_reserve_id = '".$_REQUEST['rev_reserve_id']."'";
	$info_result = mysqli_query($conn, $info_query);

	$info_row = mysqli_fetch_assoc($info_result);
?>

<script>
$(document).ready(function(){
	
	
	$("#program_name").change(function(){
			$("#programIDarea").html($("select[name=program_name] option:selected").attr("mid") + " <input type='hidden' name='wr_id' id='wr_id'  value='"+$("select[name=program_name] option:selected").attr("mid")+"' />");
	});

	
});

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
		<div id="subTitle">프로그램 예약수정</div>
		<div id="subContent">
			<div style="padding:10px;">
				<form name="insertForm" id="insertForm" method="post" action="/reserveAdmin/room_rev/modify_ok.php ">
				
				<input type="hidden" id="searchSelect" name="searchSelect" value="록?=$searchSelect?>" />
				<input type="hidden" id="searchKeyword" name="searchKeyword" value="<?=$searchKeyword?>" />
				<input type="hidden" id="page" name="page" value="<?=$page?>" />
				

				<div id="insertArea">
					<table width="100%" cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse; table-layout:fixed;">

							
					<tr height="40px" align="center">
						<th width="15%">예약번호</th>
						<td align="left"><input type="text" name="rev_reserve_id" id="rev_reserve_id" value="<?=$info_row['rev_reserve_id']?>" readonly /></td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">사용자ID</th>
						<td align="left"><input type="text" name="mb_id" id="mb_id" value="<?=$info_row['mb_id']?>" />
						</td>
					</tr>


					<tr height="40px" align="center">
						<th width="15%">객실ID</th>
						<td align="left"><input type="text" name="reserve_class_id" id="reserve_class_id" value="<?=$info_row['reserve_class_id']?>"  />
						</td>
					</tr>
		

					<tr height="40px" align="center">
						<th width="15%">운영시작일</th>
						<td align="left"><input type="text" class="DatePicker" name="check_in_date" value="<?=$info_row['check_in_date']?>" /></td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">운영종료일</th>
						<td align="left"><input type="text" class="DatePicker" name="check_out_date" value="<?=$info_row['check_out_date']?>" /></td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">인원수</th>
						<td align="left"><input type="text" name="stay_cnt" id="stay_cnt" style="width:98%; height:30px;"  value="<?=$info_row['stay_cnt']?>" /></td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">숙박금액</th>
						<td align="left"><input type="text" name="stay_amount" id="stay_amount" style="width:98%; height:30px;"  value="<?=$info_row['stay_amount']?>" /></td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">프로그램금액</th>
						<td align="left"><input type="text" name="program_amount" id="program_amount" style="width:98%; height:30px;"  value="<?=$info_row['program_amount']?>" /></td>
					</tr>
					</table>
				</div>

				<div id="insertButtonArea">
					<input type="submit" class="btn_submit" value="수정" />

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