<?php
	include_once($_SERVER['DOCUMENT_ROOT'] ."/reserveAdmin/include/header.php");
	
	$searchSelect = isset($_REQUEST['searchSelect']) ? $_REQUEST['searchSelect'] : '';
	$searchSelect = !empty($_REQUEST['searchSelect']) ? $_REQUEST['searchSelect'] : '';
	$searchKeyword = isset($_REQUEST['searchKeyword']) ? $_REQUEST['searchKeyword'] : '';
	$searchKeyword = !empty($_REQUEST['searchKeyword']) ? $_REQUEST['searchKeyword'] : '';
?>

<style type="text/css">
#paging a {
    vertical-align: middle;
    display: inline-block;
    border-radius: 3px;
    padding: 0 5px;
    line-height: 25px;
    background: #F9F9F9;
}
</style>

<script>
<!--
function kanziExcelDownload() {
	location.href = "excel_download.php?searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>";
	return;
}


function kanziDelete(wr_id, searchSelect, searchKeyword, page) {
	if(wr_id != "") {
		if(confirm("정말로 삭제하시겠습니까?")) {
			location.href = "delete_ok.php?wr_id=" + wr_id + "&searchSelect=" + searchSelect + "&searchKeyword=" + searchKeyword + "&page=" + page;
			return;
		}
	}
}

function kanziPrint(wr_id) {
	if(wr_id) {
		window.open("print.php?wr_id=" + wr_id, "kanzi_" + wr_id, "width=860, height=900");
	}
}
//-->
</script>

<?php
	$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
	$page = !empty($_REQUEST['page']) ? $_REQUEST['page'] : '';

	if(!$page) $page = 1; //현재 페이지번호가 없다면 1로 초기화 
	$end_row = 15;//페이지에서 출력할 게시물의 갯수 
	$start_row = ($page-1)*$end_row; //게시물 시작번호 
	$sql = " SELECT * FROM program WHERE 1=1 ";
	
	if($searchSelect == "wrSubject") {
		$sql .= " AND wr_subject LIKE '%".$searchKeyword."%'";
	} else {
		$sql .= " AND wr_subject LIKE '%".$searchKeyword."%'";
	}

	$result = mysqli_query($conn, $sql); 
	$row_num = mysqli_num_rows($result);//게시판의 총 레코드 갯수
	
	$cnt = $row_num;
	$results_per_pages = 15; //한페이지에 보여줄 글의 수 
	$num_pages = ceil($cnt / $results_per_pages); //총페이지수 
	$page_scale = 10; //페이징 할 수 
	$cur_page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1; 
	
	$page_links = ''; 
	$temp = floor(($cur_page-1) / $page_scale) * $page_scale + 1; 
	$limit_idx = ($cur_page -1) * $results_per_pages;
	
	$sql_sel = " SELECT * FROM program WHERE 1=1 ";
	
	if($searchSelect == "wrSubject") {
		$sql_sel .= " AND wr_subject LIKE '%".$searchKeyword."%'";
	} else {
		$sql_sel .= " AND wr_subject LIKE '%".$searchKeyword."%'";
	}

	$sql_sel .= " ORDER BY program_category_id ASC, program_sort ASC ";
	$sql_sel .= " limit " . ($limit_idx) . ", " . ($results_per_pages) . " ";
	
	$result = mysqli_query($conn, $sql_sel);
	
	if($temp >= 1) {
		if($cur_page >=1 && $cur_page <= 10) {
			
		} else {
			$page_links .= '<a href="'.$_SERVER['PHP_SELF'].'?page=1&searchSelect='.$searchSelect.'&searchKeyword='.$searchKeyword.'" style="color:black; text-decoration:none;  border:0px;">◀◀</a>&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?page='.($temp - 1).'searchSelect='.$searchSelect.'&searchKeyword='.$searchKeyword.'" style="color:black; text-decoration:none;">◀</a>&nbsp;'; 		
		}
	}
	for($i = 0; $i < $page_scale; $i++) {
		if(($temp + $i) > $num_pages) {
			break;
		}
		if($cur_page == $temp + $i) {
			$page_links .= '<a href="'.$_SERVER['PHP_SELF'].'?page='.($temp + $i).'&searchSelect='.$searchSelect.'&searchKeyword='.$searchKeyword.'" style="text-decoration:none; border:0px; color:red; font-weight:bold;">'.($temp + $i).''.'</a>&nbsp;';
		} else {
			$page_links .= '<a href="'.$_SERVER['PHP_SELF'].'?page='.($temp + $i).'&searchSelect='.$searchSelect.'&searchKeyword='.$searchKeyword.'" style="text-decoration:none; border:0px; color:black; font-weight:bold;">'.($temp+$i).'</a>&nbsp;';
		}
	}
	
	if($temp + $page_scale <= $num_pages) { 
		$page_links .= '<a href="'.$_SERVER['PHP_SELF'].'?page='.($temp+$page_scale).'&searchSelect='.$searchSelect.'&searchKeyword='.$searchKeyword.'" style="color:black; text-decoration:none;  border:0px;">▶</a>&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?page='.$num_pages.'&searchSelect='.$searchSelect.'&searchKeyword='.$searchKeyword.'" style="color:black; text-decoration:none;  border:0px;">▶▶</a>'; 
	}
?>

	<div id="contentArea">
		<div id="subTitle">프로그램 관리</div>
		<div id="subContent">
			<div class="contentArea">
				<div id="searchArea">
					<form name="searchForm" id="searchForm" method="get">					
					<div style="padding-bottom:10px;">
						<select name="searchSelect">
						<option value="">-키워드 전체-</option>
						<option value="wrSubject"<?php if($searchSelect == "wrSubject") { ?> selected<?php }?>>시설명·단체명</option>
						</select>

						<input type="text" name="searchKeyword" value="<?=$searchKeyword?>" />
						<input type="submit" class="btn_submit" value="검색" />
					</div>
					</form>
				</div>

				<div id="insertArea">
					<div style="float:left;">
						Total <?=number_format($cnt)?>개
					</div>


					<div style="float:right; padding-bottom:5px;">
						<input type="button" class="btn_insert" value="등록" onclick="javascript:location.href = 'insert.php?searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>';" />
					</div>
					<div style="clear:both; display:none;"></div>
				</div>

				<div id="listArea">
					<table width="100%" border="1" cellpadding="5" cellspacing="0" style="border-collapse:collapse;">
					<tr height="40px">
						<th>순번</th>
						<th><div>프로그램</div><div>카테고리명</div></th>
						<th>프로그램명</th>
						<th><div>운영일</div></th>
						<th><div>출력</div><div>순서</div></th>
						<th>관리</th>
					</tr>
<?php
	while($select_row = mysqli_fetch_array($result)) {
		$wr_id = $select_row['wr_id'];
		$wr_subject = $select_row['wr_subject'];
		$program_sort = $select_row['program_sort'];
		
		$program_category_query = "SELECT * FROM program_category WHERE category_id = '".$select_row['program_category_id']."'";
		$program_category_result = mysqli_query($conn, $program_category_query);
		$program_category_row = mysqli_fetch_assoc($program_category_result);
		
		$program_manage_admin_query = "SELECT manage_name FROM program_manage_admin WHERE manage_id = '".$select_row['program_manage_id']."'";
		$program_manage_admin_result = mysqli_query($conn, $program_manage_admin_query);
		$program_manage_admin_row = mysqli_fetch_assoc($program_manage_admin_result);
?>
					<tr height="30px" align="center">
						<td><?=$cnt - ($cur_page-1)*15?></td>
						<td><?=$program_category_row['category_name']?></td>
						<td align="left"><?=$wr_subject?></td>
						<td><?=$program_manage_admin_row['manage_name']?></td>
						<td><?=$program_sort?></td>
						<td>
							<input type="button" class="btn_submit" value="수정" onclick="location.href = 'modify.php?wr_id=<?=$wr_id?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>';" />
							<input type="button" class="btn_submit" value="삭제" onclick="javascript:kanziDelete('<?=$wr_id?>', '<?=$searchSelect?>', '<?=$searchKeyword?>', '<?=$page?>');" //>
						</td>
					</tr>
<?
		$cnt--;
	}

	if($row_num == 0) {
?>
					<tr height="35px" align="center">
						<td colspan="8">
							검색하신 해당 데이터가 존재하지 않습니다.
						</td>
					</tr>
<?
	}	
?>
					</table>

					<div id="paging" style="text-align:center; font-size:15px; padding-top:10px; padding-bottom:10px;">
						<?php
							echo $page_links;
						?>
						<?mysqli_close($conn);?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/footer.php");
?>