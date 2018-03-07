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

		if(confirm("������ ���������� ���ε��Ͻðڽ��ϱ�?")) {
			modifyForm.action = "excel_upload_modify_process.php";
		} else {
			return false;
		}
	}
</script>

	<div id="contentArea">
		<div id="subTitle">���/�̺�Ʈ ���� [���� ���ε� - �ϰ�����]</div>
		<div id="subContent">
			<div style="padding:10px 10px 10px 10px;">
				<div style="padding-top:10px;">
					<input type="button" class="btn_insert" value="����-������ �ٿ�ε� Click" onclick="javascript:location.href = 'excel_noimage_download.php?searchSelectCategory=<?=$searchSelectCategory?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>';" />
				</div>
				
				<form name="modifyForm" id="modifyForm" method="post" onsubmit="return modifyFormSubmit();" enctype="multipart/form-data">
				<input type="hidden" name="searchSelectCategory" id="searchSelectCategory" value="<?=$searchSelectCategory?>" />
				<input type="hidden" name="searchSelect" id="searchSelect" value="<?=$searchSelect?>" />
				<input type="hidden" name="searchKeyword" id="searchKeyword" value="<?=$searchKeyword?>" />
				<input type="hidden" name="page" id="page" value="<?=$page?>" />
				
				<div style="padding-top:30px; font-size:15px;">
					<div style="font-weight:bold; padding-bottom:5px;">�� ���ǻ��� (�ʵ�)</div>
					<div style="font-size:13px; padding-left:10px; line-height:160%;">
						- <span style="color:red;">���� "�ϰ� ���ε�"�� "����-������ �ٿ�ε�Click" ��ư�� Ŭ���Ͽ� �ٿ�ε� ������ �������Ϸ� ���ε����ּ���.</span>
					</div>
					<div style="font-size:13px; padding-left:10px; line-height:160%;">
						- <span style="color:red;">��, �������� ���ε����ֽñ� ���� "<span style="font-weight:bold;">����-������ �ٿ�ε� Click</span>"�� Ŭ�� ��, �ٿ�ε� ������ ���������� ����ż� ��ü �����͸� Ȯ���غ��ð�, �������ֽ� "���/�̺�Ʈ ������ȣ"�鸸 �ٿ�ε� ������ ���� ���Ͽ� �����ֽð�, ������ "���/�̺�Ʈ ������ȣ"�� �ٿ�ε� ������ ���� ���Ͽ����� ������ �Ͻð�, �����Ͻ� ������ ���ε����ּ���.</span>
					</div>
					<div style="font-size:13px; padding-left:10px; line-height:160%;">
						- <a href="/admin/event/file/event_example.xls" target="_blank" style="font-weight:bold; color:blue;">[���ε� ���� ���� Click]</a>
					</div>
				</div>

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
					<input type="submit" class="btn_submit" value="�ϰ� ���ε�" />
					<input type="button" class="btn_submit" value="�ڷΰ���" onclick="location.href = '/admin/event/list.php?searchSelectCategory=<?=$searchSelectCategory?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>';" />
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
	include_once("../include/footer.php");
?>