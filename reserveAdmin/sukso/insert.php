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
	function insertFormSubmit() {
		var insertForm = document.getElementById("insertForm");
		var sukso_name = document.getElementById("sukso_name");
		var sukso_sort = document.getElementById("sukso_sort");
		
		if(sukso_name.value == "") {
			alert("숙소명을 입력해주세요.");
			sukso_name.focus();
			return false;
		}
		
		if(sukso_sort.value == "") {
			alert("숙소 출력순서를 입력해주세요.");
			sukso_sort.focus();
			return false;
		}

		insertForm.action = "insert_ok.php";
	}
	
	function isNum(ev){ 
		var evt_code = (window.netscape) ? ev.which : event.keyCode;
		var manage_sort = document.getElementById("manage_sort");
		
		if(!(evt_code == 8 || evt_code == 9 || evt_code == 13 || evt_code == 46 || evt_code == 144 || (evt_code >= 48 && evt_code <= 57) || evt_code == 110 || evt_code == 190)){ 
			alert("숫자만 입력 가능합니다.");
			event.returnValue = false;
			manage_sort.value = "";
		}
	}
</script>

	<div id="contentArea">
		<div id="subTitle">숙소 등록</div>
		<div id="subContent">
			<div style="padding:10px;">
				<form name="insertForm" id="insertForm" method="post" onsubmit="return insertFormSubmit();">
				<input type="hidden" id="searchSelect" name="searchSelect" value="<?=$searchSelect?>" />
				<input type="hidden" id="searchKeyword" name="searchKeyword" value="<?=$searchKeyword?>" />
				<input type="hidden" id="page" name="page" value="<?=$page?>" />
				
				<div id="insertArea">
					<table width="100%" cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse; table-layout:fixed;">
					<tr height="40px" align="center">
						<th width="15%">프로그램</th>
						<td align="left">
							<select name="program_id" id="program_id" style="height:30px;">
							<option value=""> - 선택하세요 - </option>
							<?php
								$program_sql = " SELECT wr_id, wr_subject FROM program WHERE 1=1 AND use_yn = 'Y' ORDER BY program_category_id ASC, program_sort ASC ";
								$program_result = mysqli_query($conn, $program_sql);

								while($program_row = mysqli_fetch_array($program_result)) {
							?>
							<option value="<?=$program_row['wr_id']?>"><?=$program_row['wr_subject']?></option>
							<?php
								}
							?>
							</select>
						</td>
					</tr>					
					<tr height="40px" align="center">
						<th width="15%">숙소명</th>
						<td align="left"><input type="text" name="sukso_name" id="sukso_name" style="width:98%; height:30px;" /></td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">정원</th>
						<td align="left"><input type="text" name="people_cnt" id="people_cnt" style="width:98%; height:30px;" onkeyup="javascript:isNum(event);" /></td>
					</tr>
					<tr height="40px" align="center">
						<th>순서</th>
						<td align="left"><input type="text" name="sukso_sort" id="sukso_sort" style="width:98%; height:30px;" onkeyup="javascript:isNum(event);" /></td>
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