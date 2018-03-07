<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/header.php");
	
	$wr_id = isset($_REQUEST['wr_id']) ? $_REQUEST['wr_id'] : '';
	$wr_id = !empty($_REQUEST['wr_id']) ? $_REQUEST['wr_id'] : '';
	$searchSelect = isset($_REQUEST['searchSelect']) ? $_REQUEST['searchSelect'] : '';
	$searchSelect = !empty($_REQUEST['searchSelect']) ? $_REQUEST['searchSelect'] : '';
	$searchKeyword = isset($_REQUEST['searchKeyword']) ? $_REQUEST['searchKeyword'] : '';
	$searchKeyword = !empty($_REQUEST['searchKeyword']) ? $_REQUEST['searchKeyword'] : '';
	$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
	$page = !empty($_REQUEST['page']) ? $_REQUEST['page'] : '';

	$page = $_REQUEST['page'];

	if($page == "") $page = "1";


	$query = "SELECT * FROM program WHERE wr_id = '".$wr_id."'";
	$result = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($result);
?>

<script>
	function modifyFormSubmit() {
		var modifyForm = document.getElementById("modifyForm");
		
		if(modifyForm.program_category_id.value == "") {
			alert("프로그램 분류를 선택해주세요.");
			modifyForm.program_category_id.focus();
			return false;
		}
		modifyForm.action = "modify_ok.php";
	}
</script>

	<div id="contentArea">
		<div id="subTitle">프로그램 등록</div>
		<div id="subContent">
			<div class="contentArea">
				
				<form name="modifyForm" id="modifyForm" method="post" onsubmit="return modifyFormSubmit();">
				<input type="hidden" name="searchSelect" id="searchSelect" value="<?=$_REQUEST['searchSelect']?>" />
				<input type="hidden" name="searchKeyword" id="searchKeyword" value="<?=$_REQUEST['searchKeyword']?>" />
				<input type="hidden" name="page" id="page" value="<?=$page?>" />
				<input type="hidden" name="wr_id" id="wr_id" value="<?=$wr_id?>" />

				<div id="insertArea">					
					<div>&nbsp;</div>
					<table width="100%" cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse; table-layout:fixed;">
					<tr height="40px" align="center">
						<th width="15%" bgcolor="#EFEFEF"><div>프로그램 분류</div><div>(카테고리)</div></th>
						<td align="left">
							<select name="program_category_id" id="program_category_id" style="height:30px;">
							<option value="">- 선택하세요. -</option>

							<?php
								$program_category_query = "SELECT * FROM program_category ORDER BY category_sort ASC";
								$program_category_query_result = mysqli_query($conn, $program_category_query);
								while($program_category_query_row = mysqli_fetch_array($program_category_query_result)) {
									if($program_category_query_row['category_id'] == $row['program_category_id']) {
							?>
							<option value="<?=$program_category_query_row['category_id']?>" selected><?=$program_category_query_row['category_name']?></option>
							<?
									} else {
							?>
							<option value="<?=$program_category_query_row['category_id']?>"><?=$program_category_query_row['category_name']?></option>
							<?
									}
								}
							?>
							</select>
						</td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%" bgcolor="#EFEFEF">프로그램명</th>
						<td align="left">
							<input type="text" name="wr_subject" id="wr_subject" value="<?=$row['wr_subject']?>" style="width:100%; height:30px;" />
						</td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%" bgcolor="#EFEFEF">대상</th>
						<td align="left">
							<input type="text" name="wr_1" id="wr_1" value="<?=$row['wr_1']?>" style="width:98%; height:30px;" />
						</td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%" bgcolor="#EFEFEF">정원</th>
						<td align="left">
							<input type="text" name="wr_6" id="wr_6" value="<?=$row['wr_6']?>" style="width:98%; height:30px;" />
						</td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%" bgcolor="#EFEFEF">운영일</th>
						<td align="left">
							<select name="program_manage_id" id="program_manage_id" style="height:30px;">
							<option value="">- 선택하세요. -</option>
							<?php
								$program_manage_query = "SELECT * FROM program_manage_admin ORDER BY manage_sort ASC";
								$program_manage_query_result = mysqli_query($conn, $program_manage_query);
								while($program_manage_query_row = mysqli_fetch_array($program_manage_query_result)) {
									if($program_manage_query_row['manage_id'] == $row['program_manage_id']) {
							?>
							<option value="<?=$program_manage_query_row['manage_id']?>" selected><?=$program_manage_query_row['manage_name']?></option>
							<?
									} else {
							?>
							<option value="<?=$program_manage_query_row['manage_id']?>"><?=$program_manage_query_row['manage_name']?></option>
							<?
									}
								}
							?>
							</select>
						</td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%" bgcolor="#EFEFEF">이용료</th>
						<td align="left">
							<input type="text" name="wr_4" id="wr_4" value="<?=$row['wr_4']?>" style="width:98%; height:30px;" />
						</td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%" bgcolor="#EFEFEF">내용</th>
						<td class="wr_content">
							<script src="/plugin/editor/smarteditor2/js/HuskyEZCreator.js"></script>
							<script>var g5_editor_url = "/plugin/editor/smarteditor2", oEditors = [], ed_nonce = "9152a143c9";</script>
							<script src="/plugin/editor/smarteditor2/config.js"></script>
							<script>
									$(function(){
										$(".btn_cke_sc").click(function(){
											if ($(this).next("div.cke_sc_def").length) {
												$(this).next("div.cke_sc_def").remove();
												$(this).text("단축키 일람");
											} else {
												$(this).after("<div class='cke_sc_def' />").next("div.cke_sc_def").load("/plugin/editor/smarteditor2/shortcut.html");
												$(this).text("단축키 일람 닫기");
											}
										});
										$(document).on("click", ".btn_cke_sc_close", function(){
											$(this).parent("div.cke_sc_def").remove();
										});
									});
							</script>
							<textarea id="wr_content" name="wr_content" class="smarteditor2" maxlength="65536" style="width:98%;height:300px"><?=$row['wr_content']?></textarea>
						</td>
					</tr>

					<tr height="40px" align="center">
						<th width="15%" bgcolor="#EFEFEF">비고</th>
						<td align="left">
							<textarea name="wr_5" id="wr_5" style="width:98%; height:150px;" /><?=$row['wr_5']?></textarea>
						</td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%" bgcolor="#EFEFEF">노출여부</th>
						<td align="left">
							<select name="use_yn" style="height:30px;">
							<option value="Y"<?php if($row['use_yn'] == "Y") {?> selected<?php } ?>>Y</option>
							<option value="N"<?php if($row['use_yn'] == "N") {?> selected<?php } ?>>N</option>
							</select>
						</td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%" bgcolor="#EFEFEF">출력순서</th>
						<td align="left">
							<input type="text" name="program_sort" id="program_sort" value="<?=$row['program_sort']?>" style="width:98%; height:30px;" />
						</td>
					</tr>
					</table>
				</div>

				<div id="insertButtonArea">
					<input type="submit" class="btn_submit" value="수정" />
					<input type="button" class="btn_submit" value="뒤로가기" onclick="location.href = 'list.php?searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>&page=<?=$page?>';" />
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
	include_once("../include/footer.php");
?>