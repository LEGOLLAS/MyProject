<?php
	include_once("../include/header.php");
	
	include_once("../../include/db_connect.php");
?>

<script>
	function insertFormSubmit() {
		var insertForm = document.getElementById("insertForm");
		var title = document.getElementById("title");
		var contents = document.getElementById("contents");
		
		if(title.value == "") {
			alert("제목을 입력해주세요.");
			title.focus();
			return false;
		}
		
		if(contents.value == "") {
			alert("내용을 입력해주세요.");
			contents.focus();
			return false;
		}
		
		insertForm.action = "insert_ok.php";
	}

	function isNum(ev){ 
		var evt_code = (window.netscape) ? ev.which : event.keyCode;
		var event_sort = document.getElementById("event_sort");
		
		if(!(evt_code == 8 || evt_code == 9 || evt_code == 13 || evt_code == 46 || evt_code == 144 || (evt_code >= 48 && evt_code <= 57) || evt_code == 110 || evt_code == 190)){ 
			alert("숫자만 입력 가능합니다.");
			event.returnValue = false;
			event_sort.value = "";
		}
	}
</script>

	<div id="contentArea">
		<div id="subTitle">사용 가이드 등록</div>
		<div id="subContent">
			<div style="padding:10px 50px 10px 10px;">
				
				<form name="insertForm" id="insertForm" method="post" onsubmit="return insertFormSubmit();" enctype="multipart/form-data">
				<div id="insertArea">
					<table width="100%" cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse; table-layout:fixed;">		
					<tr height="40px" align="center">
						<th width="20%">제목</th>
						<td align="left"><input type="text" name="title" id="title" size="70" style="height:30px;" /></td>
					</tr>
					<tr height="40px" align="center">
						<th width="25%">작성자</th>
						<td align="left"><input type="text" name="writer" id="writer" size="70" style="height:30px;" /></td>
					</tr>
					<tr height="40px" align="center">
						<th width="25%">내용</th>
						<td align="left">
							<textarea id="contents" name="contents" style="width:98%; height:150px;"></textarea>
						</td>
					</tr>
					</table>
				</div>

				<div id="insertButtonArea">
					<input type="submit" class="btn_submit" value="등록" />
					<input type="button" class="btn_submit" value="뒤로가기" onclick="location.href = '/admin/guide/list.php';" />
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
	include_once("../include/footer.php");
?>