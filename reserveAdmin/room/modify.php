<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/header.php");
	
	$room_id = $_REQUEST['room_id'];
	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	$page = $_REQUEST['page'];
	
	if($page == "") {
		$page = "1";
	}

	$query = "SELECT * FROM roomadmin WHERE room_id = '".$room_id."'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
?>
	<div id="contentArea">
		<div id="subTitle">숙소 수정</div>
		<div id="subContent">
			<div style="padding:10px;">
		<!--		<form name="modifyForm" id="modifyForm" method="post" onsubmit="return modifyFormSubmit('<?=$room_id?>');"> -->

					<form name="insertForm" id="insertForm" method="post" action="/reserveAdmin/room/modify_ok.php ">
				
				<input type="hidden" id="room_id" name="room_id" value="<?=$room_id?>" />
				
				<input type="hidden" id="searchSelect" name="searchSelect" value="<?=$searchSelect?>" />
				<input type="hidden" id="searchKeyword" name="searchKeyword" value="<?=$searchKeyword?>" />
				<input type="hidden" id="page" name="page" value="<?=$page?>" />


				<div id="insertArea">
					<table  cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse; table-layout:fixed;">

					<tr height="40px" align="center">
						<th width="100px">숙소명</th>
						<td align="left"><input type="text" name="room_name" id="room_name" style="width:98%; height:30px;" value="<?=$row['room_name']?>" /></td>
					</tr>
					<tr height="40px" align="center">
						
						<th width="100px;">정원</th>
						<td align="left">
							<select  name="user_num" id="user_num">
								<? 
									for($num=0;$num<51;$num++){ 
										if($num == $row['user_num']) {
								?>
								<option value="<?=$num?>" selected><? echo $num ?></option>
								<?	} else {	?>
								<option value="<?=$num?>"><? echo $num ?></option>
								<?	} ?>
								<? } ?>
							</select>
						</td>

					</tr>
								
					<tr height="40px" align="center">
						<th>금액</th>
						<td align="left"><input type="text" name="room_price" id="room_price" style="width:98%; height:30px;" value="<?=$row['price']?>"  /></td>
					</tr>
					
					<tr height="40px" align="center">
						<th>객실상태</th>
						<td align="left">	<select  name="room_state" id="room_state">
								<option value="-">-</option>
								<option value="y"<? if($row['state'] == "y") { ?> selected<? } ?>>정상</option>
								<option value="r"<? if($row['state'] == "r") { ?> selected<? } ?>>정비</option>
								<option value="n"<? if($row['state'] == "n") { ?> selected<? } ?>>불량</option>							
						</select></td>
					</tr>
			
					
					</table>
				</div>
						


				
				<div id="insertButtonArea">
					<input type="submit" class="btn_submit" value="수정" />

					<input type="button" class="btn_submit" value="뒤로가기" onclick="location.href = 'list.php?searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>&page=<?=$_REQUEST['page']?>';" />
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php

	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/footer.php");
?>