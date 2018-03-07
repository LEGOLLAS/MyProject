<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/header.php");
	
	$manage_id = $_REQUEST['manage_id'];
	
	$searchSelectCategory = $_REQUEST['searchSelectCategory'];
	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	$page = $_REQUEST['page'];
	
	if($page == "") {
		$page = "1";
	}

	$query = "SELECT * FROM program_manage_admin WHERE manage_id = '".$manage_id."'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
?>

<script>
	function modifyFormSubmit(manage_id) {
		var modifyForm = document.getElementById("modifyForm");
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
		
		modifyForm.action = "modify_ok.php?manage_id=" + manage_id;
	}
</script>

	<div id="contentArea">
		<div id="subTitle">프로그램 운영일 수정</div>
		<div id="subContent">
			<div class="contentArea">
				<form name="modifyForm" id="modifyForm" method="post" onsubmit="return modifyFormSubmit('<?=$manage_id?>');">
				<input type="hidden" id="searchSelectCategory" name="searchSelectCategory" value="<?=$searchSelectCategory?>" />
				<input type="hidden" id="searchSelect" name="searchSelect" value="<?=$searchSelect?>" />
				<input type="hidden" id="searchKeyword" name="searchKeyword" value="<?=$searchKeyword?>" />
				<input type="hidden" id="page" name="page" value="<?=$page?>" />
				
				<div id="insertArea">
					<table width="100%" cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse; table-layout:fixed;">
					<tr height="40px" align="center">
						<th width="15%">운영일</th>
						<td align="left"><input type="text" name="manage_name" id="manage_name" value="<?=$row['manage_name']?>" style="width:98%; height:30px;" /></td>
					</tr>
					<tr height="40px" align="center">
						<th>순서</th>
						<td align="left"><input type="text" name="manage_sort" id="manage_sort" value="<?=$row['manage_sort']?>" style="width:98%; height:30px;" /></td>
					</tr>
					</table>
				</div>
				
				<div id="insertButtonArea">
					<input type="submit" class="btn_submit" value="수정" />
					<input type="button" class="btn_submit" value="뒤로가기" onclick="location.href = 'list.php?searchSelectCategory=<?=$_REQUEST['searchSelectCategory']?>&searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>&page=<?=$_REQUEST['page']?>';" />
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php

	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/footer.php");
?>