<?php
	include_once("../include/header.php");
	
	include_once("../../include/db_connect.php");
	
	$page = $_REQUEST['page'];
	$searchSelectCategory = $_REQUEST['searchSelectCategory'];
	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
?>

<script>
	function insertFormSubmit() {
		var insertForm = document.getElementById("insertForm");
		var EVENT_EXCEL_FILE = document.getElementById("EVENT_EXCEL_FILE");
		
		if(EVENT_EXCEL_FILE.value == "") {
			alert("���ε��� ���������� �������ּ���.");
			EVENT_EXCEL_FILE.focus();
			return false;
		} else {
			if((EVENT_EXCEL_FILE.value.indexOf(".xlsx")) > -1 || (EVENT_EXCEL_FILE.value.indexOf(".xls")) == -1) {
				alert(".xls Ȯ���ڸ� ���� �������ϸ� ���ε� �����մϴ�.");
				EVENT_EXCEL_FILE.focus();
				return false;
			}
		}
		
		insertForm.action = "excel_upload_process.php";
	}
</script>

	<div id="contentArea">
		<div id="subTitle">���/�̺�Ʈ ���� [���� ���ε�]</div>
		<div id="subContent">
			<div style="padding:10px 50px 10px 10px;">
				<input type="button" class="btn_insert" value="����-�������� �ٿ�ε� Click" onclick="javascript:location.href = '/admin/event/excel_sample.php';" />
				
				<form name="insertForm" id="insertForm" method="post" onsubmit="return insertFormSubmit();" enctype="multipart/form-data">
				<input type="hidden" name="page" id="page" value="<?=$page?>" />
				<input type="hidden" name="searchSelectCategory" id="searchSelectCategory" value="<?=$searchSelectCategory?>" />
				<input type="hidden" name="searchSelect" id="searchSelect" value="<?=$searchSelect?>" />
				<input type="hidden" name="searchKeyword" id="searchKeyword" value="<?=$searchKeyword?>" />
				
				<div id="insertArea">
					<table width="100%" cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse; table-layout:fixed;">		
					<tr height="40px" align="center">
						<th width="20%">�������� ����</th>
						<td align="left">
							<div><input type="file" name="EVENT_EXCEL_FILE" id="EVENT_EXCEL_FILE" size="70" style="height:30px;" /></div>
							<div>�� .xls Ȯ���ڸ� ���� �������ϸ� ���ε� �����մϴ�.</div>
						</td>
					</tr>
					</table>
				</div>
				
				<div id="insertButtonArea">
					<input type="submit" class="btn_submit" value="���ε�" />
					<input type="button" class="btn_submit" value="�ڷΰ���" onclick="location.href = '/admin/event/list.php?searchSelectCategory=<?=$_REQUEST['searchSelectCategory']?>&searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>&page=<?=$_REQUEST['page']?>';" />
				</div>

				</form>
			</div>
		</div>
	</div>
</div>

<?php
	include_once("../include/footer.php");
?>