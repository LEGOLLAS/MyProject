<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/header.php");

	$searchSelectCategory = $_REQUEST['searchSelectCategory'];
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
		var manage_name = document.getElementById("manage_name");
		var manage_sort = document.getElementById("manage_sort");
		
		if(manage_name.value == "") {
			alert("운영일을 입력해주세요.");
			manage_name.focus();
			return false;
		}
		
		if(manage_sort.value == "") {
			alert("운영일 순서를 입력해주세요.");
			manage_sort.focus();
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
		<div id="subTitle">프로그램 운영일 등록</div>
		<div id="subContent">
			<div class="contentArea">
				<form name="insertForm" id="insertForm" method="post" onsubmit="return insertFormSubmit();">
				<input type="hidden" id="searchSelectCategory" name="searchSelectCategory" value="<?=$searchSelectCategory?>" />
				<input type="hidden" id="searchSelect" name="searchSelect" value="<?=$searchSelect?>" />
				<input type="hidden" id="searchKeyword" name="searchKeyword" value="<?=$searchKeyword?>" />
				<input type="hidden" id="page" name="page" value="<?=$page?>" />
				
				<div id="insertArea">
					<table width="100%" cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse; table-layout:fixed;">
					<tr height="40px" align="center">
						<th width="15%">운영일</th>
						<td align="left"><input type="text" name="manage_name" id="manage_name" style="width:98%; height:30px;" /></td>
					</tr>
					<tr height="40px" align="center">
						<th>순서</th>
						<td align="left"><input type="text" name="manage_sort" id="manage_sort" style="width:98%; height:30px;" onkeyup="javascript:isNum(event);" /></td>
					</tr>
					</table>
				</div>

				<div id="insertButtonArea">
					<input type="submit" class="btn_submit" value="등록" />
					<input type="button" class="btn_submit" value="뒤로가기" onclick="location.href = 'list.php?searchSelectCategory=<?=$_REQUEST['searchSelectCategory']?>&searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>&page=<?=$_REQUEST['page']?>';" />
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
	include_once("../include/footer.php");
?>