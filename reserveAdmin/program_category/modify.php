<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/header.php");
	
	$category_id = $_REQUEST['category_id'];
	
	$searchSelectCategory = $_REQUEST['searchSelectCategory'];
	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	$page = $_REQUEST['page'];
	
	if($page == "") {
		$page = "1";
	}

	$query = "SELECT * FROM program_category WHERE category_id = '".$category_id."'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
?>

<script>
	function modifyFormSubmit(category_id) {
		var modifyForm = document.getElementById("modifyForm");
		var category_name = document.getElementById("category_name");
		var category_sort = document.getElementById("category_sort");
		
		if(category_name.value == "") {
			alert("카테고리명을 입력해주세요.");
			category_name.focus();
			return false;
		}
		
		if(category_sort.value == "") {
			alert("카테고리 순서를 입력해주세요.");
			category_sort.focus();
			return false;
		}
		
		modifyForm.action = "modify_ok.php?category_id=" + category_id;
	}
</script>

	<div id="contentArea">
		<div id="subTitle">행사/이벤트 카테고리 수정</div>
		<div id="subContent">
			<div class="contentArea">
				<form name="modifyForm" id="modifyForm" method="post" onsubmit="return modifyFormSubmit('<?=$category_id?>');">
				<input type="hidden" id="searchSelectCategory" name="searchSelectCategory" value="<?=$searchSelectCategory?>" />
				<input type="hidden" id="searchSelect" name="searchSelect" value="<?=$searchSelect?>" />
				<input type="hidden" id="searchKeyword" name="searchKeyword" value="<?=$searchKeyword?>" />
				<input type="hidden" id="page" name="page" value="<?=$page?>" />
				
				<div id="insertArea">
					<table width="100%" cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse; table-layout:fixed;">
					<tr height="40px" align="center">
						<th width="15%">카테고리명</th>
						<td align="left"><input type="text" name="category_name" id="category_name" value="<?=$row['category_name']?>" style="width:98%; height:30px;" /></td>
					</tr>
					<tr height="40px" align="center">
						<th>순서</th>
						<td align="left"><input type="text" name="category_sort" id="category_sort" value="<?=$row['category_sort']?>" style="width:98%; height:30px;" /></td>
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