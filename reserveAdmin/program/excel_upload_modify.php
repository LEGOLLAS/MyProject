<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/header.php");
	
	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	$page = $_REQUEST['page'];

	if($page == "") $page = "1";

	$bcategory_query = "SELECT * FROM comm_info_bcategory WHERE 1=1 ORDER BY bcategory_sort ASC";
	$bcategory_result = mysqli_query($conn, $bcategory_query);

	$scategory_query = "SELECT * FROM comm_info_scategory WHERE 1=1 AND scategory_YN = 'Y' ORDER BY scategory_sort ASC";
	$scategory_result = mysqli_query($conn, $scategory_query);
?>

<script>
	function modifyFormSubmit() {
		var modifyForm = document.getElementById("modifyForm");
		var KANZI_MODIFY_EXCEL_FILE = document.getElementById("KANZI_MODIFY_EXCEL_FILE");
		
		if(KANZI_MODIFY_EXCEL_FILE.value == "") {
			alert("업로드할 엑셀파일을 선택해주세요.");
			KANZI_MODIFY_EXCEL_FILE.focus();
			return false;
		} else {
			if((KANZI_MODIFY_EXCEL_FILE.value.indexOf(".xlsx")) > -1 || (KANZI_MODIFY_EXCEL_FILE.value.indexOf(".xls")) == -1) {
				alert(".xls 확장자를 가진 엑셀파일만 업로드 가능합니다.");
				KANZI_MODIFY_EXCEL_FILE.focus();
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
		<div id="subTitle">프로그램 관리 [엑셀 업로드 - 일괄수정]</div>
		<div id="subContent">
			<div class="contentArea">
				<div style="padding-top:10px;">
					<input type="button" class="btn_insert" value="엑셀-데이터 다운로드 Click" onclick="javascript:location.href = 'excel_noimage_download.php?searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>';" />
				</div>
				
				<form name="modifyForm" id="modifyForm" method="post" onsubmit="return modifyFormSubmit();" enctype="multipart/form-data">
				<input type="hidden" name="searchSelect" id="searchSelect" value="<?=$searchSelect?>" />
				<input type="hidden" name="searchKeyword" id="searchKeyword" value="<?=$searchKeyword?>" />
				<input type="hidden" name="page" id="page" value="<?=$page?>" />

				<div style="padding-top:30px; font-size:15px;">
					<div style="font-weight:bold; padding-bottom:5px;">※ 주의사항 (필독)</div>
					<div style="font-size:13px; padding-left:10px; line-height:160%;">
						- <span style="color:red;">엑셀 "일괄 업로드"시 "<span style="font-weight:bold;">엑셀-데이터 다운로드Click</span>" 버튼을 클릭하여 다운로드 받으신 엑셀파일로 업로드해주세요.</span>
					</div>
					<div style="font-size:13px; padding-left:10px; line-height:160%;">
						- <span style="color:red;">단, 엑셀파일 업로드해주시기 전에 "<span style="font-weight:bold;">엑셀-데이터 다운로드 Click</span>"를 클릭 후, 다운로드 받으신 엑셀파일을 열어보셔서 전체 데이터를 확인해보시고, 수정해주실 고유번호들만 다운로드 받으신 엑셀 파일에 남겨주시고, 나머지 고유번호는 다운로드 받으신 엑셀 파일에서만 삭제를 하시고, 저장하신 다음에 업로드해주세요.</span>
					</div>
					<div style="font-size:13px; padding-left:10px; line-height:160%;">
						- <span style="color:red;">대분류 카테고리 아이디, 소분류 카테고리 아이디는 바로 확인이 필요하실 경우에는 "<span style="font-weight:bold;">대분류 카테고리-엑셀 다운로드(최신 데이터)</span>", "<span style="font-weight:bold;">소분류 카테고리-엑셀 다운로드(최신 데이터)</span>"를 클릭해보셔서 다운로드 받으시고, 확인하시면서 알맞는 숫자로만 입력해주셔야 합니다. (최소 1부터 시작해야 합니다.)</span>
					</div>
					<div style="font-size:13px; padding-left:10px; line-height:160%;">
						- <span style="color:red;">단, 소분류 카테고리 아이디를 엑셀파일에 입력시 해당 대분류 카테고리 아이디와 매칭하여, 정확하게 입력하시고 업로드를 해주셔야만 정확하게 수정 반영됩니다.</span>
					</div>
					<div style="font-size:13px; padding-left:10px; line-height:160%;">
						<div>- <span style="color:red;">대표자 사진, QR 코드 사진, 시설전경 사진은 용량(웹트래픽 초과 등) 서버 접속 문제가 발생할 위험이 있으므로, 업로드 추가 반영이 안됩니다.<div>※ 대표자 사진, QR 코드 사진, 시설전경 사진을 제외한 나머지 항목들은 엑셀 업로드시 모두 수정 반영됩니다.</div></span></div>
					</div>
					<div style="font-size:13px; padding-left:10px; line-height:160%;">
						<div>- <span style="color:red;">시 구분에서 제주시의 경우 숫자 1로 입력해주시고, 서귀포시의 경우 숫자 2로 입력해주세요.</div></span></div>
					</div>
					<div style="font-size:13px; padding-left:10px; line-height:160%;">
						- <a href="file/kanzi_example.xls" target="_blank" style="font-weight:bold; color:blue;">[업로드 예시 파일 Click]</a>
					</div>
				</div>
				
				<div id="insertArea">
					<table width="100%" cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse; table-layout:fixed;">		
					<tr height="40px" align="center">
						<th width="20%">엑셀파일 선택</th>
						<td align="left">
							<div><input type="file" name="KANZI_MODIFY_EXCEL_FILE" id="KANZI_MODIFY_EXCEL_FILE" size="70" style="height:30px;" /></div>
							<div>※ .xls 확장자를 가진 엑셀파일만 업로드 가능합니다.</div>
						</td>
					</tr>
					</table>
				</div>
				
				<div id="insertButtonArea">
					<input type="submit" class="btn_submit" value="일괄 업로드" />
					<input type="button" class="btn_submit" value="뒤로가기" onclick="location.href = 'list.php?searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>&page=<?=$page?>';" />
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/footer.php");
?>