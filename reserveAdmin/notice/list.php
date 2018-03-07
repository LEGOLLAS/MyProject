<?php
	include_once("../include/header.php");
	
	include_once("../../include/db_connect.php");

	$searchSelectCategory = $_REQUEST['searchSelectCategory'];
	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
?>

<script>
<!--

function noticeDelete(board_no) {
	if(board_no != "") {
		if(confirm("정말로 삭제하시겠습니까?")) {
			location.href = "/admin/notice/delete_ok.php?board_no=" + board_no;
			return;
		}
	}
}

//-->
</script>

	<div id="contentArea">
		<div id="subTitle">공지사항</div>
		<div id="subContent">
			<div style="padding:10px 20px 10px 20px;">
				<div id="searchArea">
					<form name="searchForm" id="searchForm" method="get">
					<input type="text" name="searchKeyword" value="<?=$_REQUEST['searchKeyword']?>" />
					<input type="submit" class="btn_submit" value="검색" />
					</form>
				</div>

				<div id="insertArea">
					<input type="button" class="btn_insert" value="등록" onclick="javascript:location.href = '/admin/notice/insert.php';" />
				</div>

				<div id="listArea">
					<table width="100%" border="1" cellpadding="5" cellspacing="0" style="border-collapse:collapse;">
					<colgroup>
					<col width="10%" />
					<col width="*" />
					<col width="15%" />
					<col width="15%" />
					<col width="15%" />
					<col width="15%" />
					</colgroup>
					<tr height="40px">
						<th>No</th>
						<th>제목</th>
						<th>작성자</th>
						<th>등록일</th>
						<th>조회수</th>
						<th>관리</th>
					</tr>
	<?php
		$count_query = "SELECT count(*) cnt FROM notice WHERE 1=1";
		
		if($searchKeyword != "") {
			$count_query .= " AND (title LIKE '%".$searchKeyword."%' OR writer LIKE '%".$searchKeyword."%' OR contents LIKE '%".$searchKeyword."%')";
		}
		
		$count_result = mysql_query($count_query);
		$count_row = mysql_fetch_assoc($count_result);
		
		$select_query = "SELECT * FROM notice WHERE 1=1";
		
		if($searchKeyword != "") {
			$select_query .= " AND (title LIKE '%".$searchKeyword."%' OR writer LIKE '%".$searchKeyword."%' OR contents LIKE '%".$searchKeyword."%')";
		}
		
		$select_query .= " ORDER BY reg_date desc";
		$select_result = mysql_query($select_query);
		
		$cnt = 0;
		
		while($select_row = mysql_fetch_array($select_result)) {

			$board_no = $select_row['board_no'];
			$title = $select_row['title'];
			$writer = $select_row['writer'];
			$reg_date = $select_row['reg_date'];
			$hit_cnt = $select_row['hit_cnt'];
			$cnt++;
	?>
					<tr height="30px" align="center">
						<td><?=$cnt?></td>
						<td align="left"><a href="/admin/notice/modify.php?board_no=<?=$board_no?>"><?=$title?></a></td>
						<td><?=$writer?></td>
						<td><?=$reg_date?></td>
						<td><?=$hit_cnt?></td>
						<td>
							<input type="button" class="btn_submit" value="수정" onclick="location.href = '/admin/notice/modify.php?board_no=<?=$board_no?>';" />
							<input type="button" class="btn_submit" value="삭제" onclick="javascript:noticeDelete('<?=$board_no?>');" //>
						</td>
					</tr>
	<?
		}
		
		if($count_row['cnt'] == 0) {
	?>
					<tr height="40px" align="center">
						<td colspan="6">
							해당 공지사항 데이터가 존재하지 않습니다.
						</td>
					</tr>
	<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	include_once("../include/footer.php");
?>