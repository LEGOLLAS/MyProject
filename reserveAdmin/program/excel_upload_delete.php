<?php
	include_once("../include/header.php");
	
	include_once("../../include/db_connect.php");

	$bcate_id = $_REQUEST['bcate_id'];
	$scate_id = $_REQUEST['scate_id'];
	$sel_si_gb = $_REQUEST['sel_si_gb'];
	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	$page = $_REQUEST['page'];

	if($page == "") $page = "1";

	$bcategory_query = "SELECT * FROM comm_info_bcategory WHERE 1=1 ORDER BY bcategory_sort ASC";
	$bcategory_result = mysql_query($bcategory_query);

	$scategory_query = "SELECT * FROM comm_info_scategory WHERE 1=1 AND scategory_YN = 'Y' ORDER BY scategory_sort ASC";
	$scategory_result = mysql_query($scategory_query);
?>

<script>
	function deleteFormSubmit() {
		var deleteForm = document.getElementById("deleteForm");
		var KANZI_DELETE_EXCEL_FILE = document.getElementById("KANZI_DELETE_EXCEL_FILE");
		
		if(KANZI_DELETE_EXCEL_FILE.value == "") {
			alert("업로드할 엑셀파일을 선택해주세요.");
			KANZI_DELETE_EXCEL_FILE.focus();
			return false;
		} else {
			if((KANZI_DELETE_EXCEL_FILE.value.indexOf(".xlsx")) > -1 || (KANZI_DELETE_EXCEL_FILE.value.indexOf(".xls")) == -1) {
				alert(".xls 확장자를 가진 엑셀파일만 업로드 가능합니다.");
				KANZI_DELETE_EXCEL_FILE.focus();
				return false;
			}
		}

		if(confirm("정말로 엑셀파일을 업로드하시겠습니까?")) {
			deleteForm.action = "excel_upload_delete_process.php";
		} else {
			return false;
		}
	}
</script>

	<div id="contentArea">
		<div id="subTitle">사회복지편람 정보 관리 [엑셀 업로드 - 일괄삭제]</div>
		<div id="subContent">
			<div class="contentArea">
				<div style="padding-top:10px;">
					<input type="button" class="btn_insert" value="대분류 카테고리 - 엑셀 다운로드(최신 데이터) Click" onclick="javascript:location.href = '/admin/kanzi/excel_bcategory_download.php';" />
					<input type="button" class="btn_insert" value="소분류 카테고리 - 엑셀 다운로드(최신 데이터) Click" onclick="javascript:location.href = '/admin/kanzi/excel_scategory_download.php';" />
				</div>

				<div style="padding-top:10px;">
					<input type="button" class="btn_insert" value="엑셀-데이터 다운로드 Click" onclick="javascript:location.href = '/admin/kanzi/excel_noimage_download.php?bcate_id=<?=$bcate_id?>&scate_id=<?=$scate_id?>&sel_si_gb=<?=$sel_si_gb?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>';" />
				</div>
				
				<form name="deleteForm" id="deleteForm" method="post" onsubmit="return deleteFormSubmit();" enctype="multipart/form-data">
				<input type="hidden" name="bcate_id" id="bcate_id" value="<?=$bcate_id?>" />
				<input type="hidden" name="scate_id" id="scate_id" value="<?=$scate_id?>" />
				<input type="hidden" name="sel_si_gb" id="sel_si_gb" value="<?=$sel_si_gb?>" />
				<input type="hidden" name="searchSelect" id="searchSelect" value="<?=$searchSelect?>" />
				<input type="hidden" name="searchKeyword" id="searchKeyword" value="<?=$searchKeyword?>" />
				<input type="hidden" name="page" id="page" value="<?=$page?>" />
				
				<div style="padding-top:30px; font-size:15px;">
					<div style="font-weight:bold; padding-bottom:5px;">※ 주의사항 (필독)</div>
					<div style="font-size:13px; padding-left:10px; line-height:160%;">
						- <span style="color:red;">엑셀 "일괄 업로드"시 "엑셀-데이터 다운로드Click" 버튼을 클릭하여 다운로드 받으신 엑셀파일로 업로드해주세요.</span>
					</div>
					<div style="font-size:13px; padding-left:10px; line-height:160%;">
						- <span style="color:red;">단, 엑셀파일 업로드해주시기 전에 "엑셀-데이터 다운로드 Click"를 클릭 후, 다운로드 받으신 엑셀파일을 열어보셔서 전체 데이터를 확인해보시고, 삭제해주실 고유번호들만 다운로드 받으신 엑셀 파일에 남겨주시고, 나머지 고유번호는 다운로드 받으신 엑셀 파일에서만 삭제를 하시고, 저장하신 다음에 업로드해주세요.</span>
					</div>
					<div style="font-size:13px; padding-left:10px; line-height:160%;">
						- <span style="color:red;">엑셀 파일 업로드시 업로드한 엑셀 파일에 입력해주신 각 해당 고유번호에 대한 <span style="color:black; font-weight:bold;">대표자(사진), QR 코드(사진), 시설전경(사진)</span>도 서버에서 일괄 삭제 처리됩니다.</span>
					</div>
					<!--
					<div style="font-size:13px; padding-left:10px; line-height:160%;">
						- <span style="color:red;">대분류 카테고리 아이디, 소분류 카테고리 아이디는 바로 확인이 필요하실 경우에는 "대분류 카테고리-엑셀 다운로드(최신 데이터)", "소분류 카테고리-엑셀 다운로드(최신 데이터)"를 클릭해보셔서 다운로드 받으시고, 확인하시면서 알맞는 숫자로 입력해주셔야 합니다.</span>
					</div>
					-->
					<div style="font-size:13px; padding-left:10px; line-height:160%;">
						- <a href="/admin/kanzi/file/kanzi_example.xls" target="_blank" style="font-weight:bold; color:blue;">[업로드 예시 파일 Click]</a>
					</div>
				</div>

				<div id="insertArea">
					<table width="100%" cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse; table-layout:fixed;">		
					<tr height="40px" align="center">
						<th width="20%">엑셀파일 선택</th>
						<td align="left">
							<div><input type="file" name="KANZI_DELETE_EXCEL_FILE" id="KANZI_DELETE_EXCEL_FILE" size="70" style="height:30px;" /></div>
							<div>※ .xls 확장자를 가진 엑셀파일만 업로드 가능합니다.</div>
						</td>
					</tr>
					</table>
				</div>
				
				<div id="insertButtonArea">
					<input type="submit" class="btn_submit" value="일괄 업로드" />
					<input type="button" class="btn_submit" value="뒤로가기" onclick="location.href = '/admin/kanzi/list.php?bcate_id=<?=$_REQUEST['bcate_id']?>&scate_id=<?=$_REQUEST['scate_id']?>&sel_si_gb=<?=$_REQUEST['sel_si_gb']?>&searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>&page=<?=$page?>';" />
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
	include_once("../include/footer.php");
?>