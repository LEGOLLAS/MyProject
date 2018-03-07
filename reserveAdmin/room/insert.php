<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/header.php");
	
	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	$page = $_REQUEST['page'];

	if($page == "") {
		$page = "1";
	}
?>
<!--
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
-->
	<div id="contentArea">
		<div id="subTitle">숙소 등록</div>
		<div id="subContent">
			<div style="padding:10px;">
			<!--	<form name="insertForm" id="insertForm" method="post" onsubmit="return insertFormSubmit();"> -->
			
				<form name="insertForm" id="insertForm" method="post" action="/reserveAdmin/room/insert_ok.php ">
				
				<input type="hidden" id="searchSelect" name="searchSelect" value="<?=$searchSelect?>" />
				<input type="hidden" id="searchKeyword" name="searchKeyword" value="<?=$searchKeyword?>" />
				<input type="hidden" id="page" name="page" value="<?=$page?>" />
				



				<div id="insertArea">
					<table width="100%" cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse; table-layout:fixed;">
							
					<tr height="40px" align="center">
						<th width="15%">숙소명</th>
						<td align="left"><input type="text" name="room_name" id="room_name" style="width:98%; height:30px;" /></td>
					</tr>


					<tr height="40px" align="left">
						
						<th width="15%">정원</th>
						<td>
							<select  name="user_num" id="user_num">
								<? for($num=0;$num<51;$num++){ ?>
								<option value="<?=$num?>"><? echo $num ?></option>
								<? } ?>
							</select>
						</td>

					</tr>
						<!--
						<td align="left"><input type="text" name="people_cnt" id="people_cnt" style="width:98%; height:30px;" onkeyup="javascript:isNum(event);" /></td>
					</tr>
					-->
					
					<tr height="40px" align="center">
						<th>금액</th>
						<td align="left"><input type="text" name="room_price" id="room_price" style="width:98%; height:30px;"  /></td>
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