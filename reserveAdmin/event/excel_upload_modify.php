<?php
	include_once("../include/header.php");
	
	include_once("../../include/db_connect.php");

	$searchSelectCategory = $_REQUEST['searchSelectCategory'];
	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	$page = $_REQUEST['page'];

	if($page == "") $page = "1";
?>

<script>
	function modifyFormSubmit() {
		var modifyForm = document.getElementById("modifyForm");
		var EVENT_EXCEL_FILE = document.getElementById("EVENT_EXCEL_FILE");
		
		if(EVENT_EXCEL_FILE.value == "") {
			alert("업로드할 엑셀파일을 선택해주세요.");
			EVENT_EXCEL_FILE.focus();
			return false;
		} else {
			if((EVENT_EXCEL_FILE.value.indexOf(".xlsx")) > -1 || (EVENT_EXCEL_FILE.value.indexOf(".xls")) == -1) {
				alert(".xls 확장자를 가진 엑셀파일만 업로드 가능합니다.");
				EVENT_EXCEL_FILE.focus();
				return false;
			}
		}

		if(confirm("정말로 엑셀파일을 업로드하시겠습니까?")) {
			modifyForm.action = "excel_upload_modify_process.php";
		} else {
			return false;
		}
	}
</script>

	<div id="contentArea">
		<div id="subTitle">행사/이벤트 관리 [엑셀 업로드 - 일괄수정]</div>
		<div id="subContent">
			<div style="padding:10px 10px 10px 10px;">
				<div style="padding-top:10px;">
					<input type="button" class="btn_insert" value="엑셀-데이터 다운로드 Click" onclick="javascript:location.href = 'excel_noimage_download.php?searchSelectCategory=<?=$searchSelectCategory?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>';" />
				</div>
				
				<form name="modifyForm" id="modifyForm" method="post" onsubmit="return modifyFormSubmit();" enctype="multipart/form-data">
				<input type="hidden" name="searchSelectCategory" id="searchSelectCategory" value="<?=$searchSelectCategory?>" />
				<input type="hidden" name="searchSelect" id="searchSelect" value="<?=$searchSelect?>" />
				<input type="hidden" name="searchKeyword" id="searchKeyword" value="<?=$searchKeyword?>" />
				<input type="hidden" name="page" id="page" value="<?=$page?>" />
				
				<div style="padding-top:30px; font-size:15px;">
					<div style="font-weight:bold; padding-bottom:5px;">※ 주의사항 (필독)</div>
					<div style="font-size:13px; padding-left:10px; line-height:160%;">
						- <span style="color:red;">엑셀 "일괄 업로드"시 "엑셀-데이터 다운로드Click" 버튼을 클릭하여 다운로드 받으신 엑셀파일로 업로드해주세요.</span>
					</div>
					<div style="font-size:13px; padding-left:10px; line-height:160%;">
						- <span style="color:red;">단, 엑셀파일 업로드해주시기 전에 "<span style="font-weight:bold;">엑셀-데이터 다운로드 Click</span>"를 클릭 후, 다운로드 받으신 엑셀파일을 열어보셔서 전체 데이터를 확인해보시고, 삭제해주실 "행사/이벤트 고유번호"들만 다운로드 받으신 엑셀 파일에 남겨주시고, 나머지 "행사/이벤트 고유번호"는 다운로드 받으신 엑셀 파일에서만 삭제를 하시고, 저장하신 다음에 업로드해주세요.</span>
					</div>
					<div style="font-size:13px; padding-left:10px; line-height:160%;">
						- <a href="/admin/event/file/event_example.xls" target="_blank" style="font-weight:bold; color:blue;">[업로드 예시 파일 Click]</a>
					</div>
				</div>

				<div id="insertArea">
					<table width="100%" cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse; table-layout:fixed;">		
					<tr height="40px" align="center">
						<th width="20%">엑셀파일 선택</th>
						<td align="left">
							<div><input type="file" name="EVENT_EXCEL_FILE" id="EVENT_EXCEL_FILE" size="70" style="height:30px;" /></div>
							<div>※ .xls 확장자를 가진 엑셀파일만 업로드 가능합니다.</div>
						</td>
					</tr>
					</table>
				</div>
				
				<div id="insertButtonArea">
					<input type="submit" class="btn_submit" value="일괄 업로드" />
					<input type="button" class="btn_submit" value="뒤로가기" onclick="location.href = '/admin/event/list.php?searchSelectCategory=<?=$searchSelectCategory?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>';" />
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
	include_once("../include/footer.php");
?>