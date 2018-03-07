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

	<div id="contentArea">
		<div id="subTitle">회원자녀등록</div>
		<div id="subContent">
			<div style="padding:10px;">
					
				<form name="insertForm" id="insertForm" method="post" action="/reserveAdmin/member_children/insert_ok.php ">
				
				<input type="hidden" id="searchSelect" name="searchSelect" value="록?=$searchSelect?>" />
				<input type="hidden" id="searchKeyword" name="searchKeyword" value="<?=$searchKeyword?>" />
				<input type="hidden" id="page" name="page" value="<?=$page?>" />
				

				<div id="insertArea">
					<table width="100%" cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse; table-layout:fixed;">

							
					<tr height="40px" align="center">
						<th width="15%">회원ID</th>
						<td align="left"><input type="text" name="mb_id" id="mb_id" style="width:98%; height:30px;" /></td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">이름</th>
						<td align="left"><input type="text" name="children_name" id="children_name" style="width:98%; height:30px;"  /></td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">생년월일</th>
						<td align="left">
						<input type="text" name="children_birth" style="border:1px solid #ff0000; " maxlength="8"/ >(예:20150202 생년월일 8자리)
						
						</td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">성별</th>
						<td align="left">
							<select name="children_sex">
							<option value="M">남자</option>
							<option value="F">여자</option>
							</select>
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