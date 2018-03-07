<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/header.php");
	
	$searchSelect = isset($_REQUEST['searchSelect']) ? $_REQUEST['searchSelect'] : '';
	$searchSelect = !empty($_REQUEST['searchSelect']) ? $_REQUEST['searchSelect'] : '';
	$searchKeyword = isset($_REQUEST['searchKeyword']) ? $_REQUEST['searchKeyword'] : '';
	$searchKeyword = !empty($_REQUEST['searchKeyword']) ? $_REQUEST['searchKeyword'] : '';
	$searchSelectCategory = isset($_REQUEST['searchSelectCategory']) ? $_REQUEST['searchSelectCategory'] : '';
	$searchSelectCategory = !empty($_REQUEST['searchSelectCategory']) ? $_REQUEST['searchSelectCategory'] : '';
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

<?
	$count_query = "SELECT * FROM sukso WHERE 1=1";
	
	if($searchSelect == "suksoName") {
		$count_query .= " AND sukso_name LIKE '%".$searchKeyword."%'";
	}
	
	if($searchSelect == "suksoSort") {
		$count_query .= " AND sukso_sort LIKE '%".$searchKeyword."%'";
	}

	if($searchSelect == "") {
		$count_query .= " AND (sukso_name LIKE '%".$searchKeyword."%' OR sukso_sort LIKE '%".$searchKeyword."%')";
	}

	$count_result = mysqli_query($conn, $count_query);
	$row_num = mysqli_num_rows($count_result);//게시판의 총 레코드 갯수
	
	$cnt = $row_num;
	$results_per_pages = 15; //한페이지에 보여줄 글의 수 
	$num_pages = ceil($cnt / $results_per_pages); //총페이지수 
	$page_scale = 10; //페이징 할 수 
	$cur_page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1; 
	
	$page_links = ''; 
	$temp = floor(($cur_page-1) / $page_scale) * $page_scale + 1; 
	$limit_idx = ($cur_page -1) * $results_per_pages;

	$select_query = "SELECT * FROM sukso WHERE 1=1";
	
	if($searchSelect == "suksoName") {
		$select_query .= " AND sukso_name LIKE '%".$searchKeyword."%'";
	}
	
	if($searchSelect == "suksoSort") {
		$select_query .= " AND sukso_sort LIKE '%".$searchKeyword."%'";
	}

	if($searchSelect == "") {
		$select_query .= " AND (sukso_name LIKE '%".$searchKeyword."%' OR sukso_sort LIKE '%".$searchKeyword."%')";
	}

	$select_query .= " ORDER BY sukso_sort ASC";
	$select_query .= " limit " . ($limit_idx) . ", " . ($results_per_pages) . " ";
	
	$select_result = mysqli_query($conn, $select_query);

	if($temp >= 1) {
		if($cur_page >=1 && $cur_page <= 10) {
			
		} else {
			$page_links .= '<a href="'.$_SERVER['PHP_SELF'].'?page=1&searchSelect='.$searchSelect.'&searchKeyword='.$searchKeyword.'" style="color:black; text-decoration:none;  border:0px;">◀◀</a>&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?page='.($temp - 1).'&searchSelect='.$searchSelect.'&searchKeyword='.$searchKeyword.'" style="color:black; text-decoration:none;">◀</a>&nbsp;'; 		
		}
	}
	for($i = 0; $i < $page_scale; $i++) {
		if(($temp + $i) > $num_pages) {
			break;
		}
		if($cur_page == $temp + $i) {
			$page_links .= '<a href="'.$_SERVER['PHP_SELF'].'?page='.($temp + $i).'&searchSelect='.$searchSelect.'&searchKeyword='.$searchKeyword.'" style="text-decoration:none; border:0px; color:red; font-weight:bold;">'.($temp + $i).''.'</a>&nbsp;';
		} else {
			$page_links .= '<a href="'.$_SERVER['PHP_SELF'].'?page='.($temp + $i).'&searchSelectCategory='.$_REQUEST['searchSelectCategory'].'&searchSelect='.$searchSelect.'&searchKeyword='.$searchKeyword.'" style="text-decoration:none; border:0px; color:black; font-weight:bold;">'.($temp+$i).'</a>&nbsp;';
		}
	}
	
	if($temp + $page_scale <= $num_pages) { 
		$page_links .= '<a href="'.$_SERVER['PHP_SELF'].'?page='.($temp+$page_scale).'&searchSelect='.$searchSelect.'&searchKeyword='.$searchKeyword.'" style="color:black; text-decoration:none;  border:0px;">▶</a>&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?page='.$num_pages.'&searchSelect='.$searchSelect.'&searchKeyword='.$searchKeyword.'" style="color:black; text-decoration:none;  border:0px;">▶▶</a>'; 
	}
?>

	<div id="contentArea">
		<div id="subTitle">숙소 관리</div>
		<div id="subContent">
			<div style="padding:10px;">
				<div id="searchArea">
					<form name="searchForm" id="searchForm" method="get">
					<select name="searchSelect">
					<option value="">-키워드 전체-</option>
					<option value="suksoName"<?php if($searchSelect == "suksoName") { ?> selected<?php }?>>숙소명</option>
					<option value="suksoSort"<?php if($searchSelect == "suksoSort") { ?> selected<?php }?>>순서</option>
					</select>

					<input type="text" name="searchKeyword" value="<?=$searchKeyword?>" />
					<input type="submit" class="btn_submit" value="검색" />
					
					</form>
				</div>

				<div id="insertArea">
					<div style="float:left;">
						Total <?=number_format($cnt)?>개
					</div>
					<div style="float:right; padding-bottom:5px;">
						<input type="button" class="btn_insert" value="등록" onclick="javascript:location.href = 'insert.php?searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$cur_page?>';" />
					</div>
					<div style="clear:both; display:none;"></div>
				</div>

				<div id="listArea">
					<table width="100%" border="1" cellpadding="5" cellspacing="0" style="border-collapse:collapse;">
					<tr height="40px">
						<th>No</th>
						<th>고유번호</th>
						<th>숙소명</th>
						<th>순서</th>
						<th>관리</th>
					</tr>
	<?
		while($select_row = mysqli_fetch_array($select_result)) {
			$sukso_id = $select_row['sukso_id'];
			$sukso_name = $select_row['sukso_name'];
			$sukso_sort = $select_row['sukso_sort'];
	?>
					<tr height="30px" align="center">
						<td><?=$cnt - ($cur_page-1) * 15?></td>
						<td><?=$sukso_id?></td>
						<td><?=$sukso_name?></td>
						<td><?=$sukso_sort?></td>
						<td>
							<input type="button" class="btn_submit" value="수정" onclick="location.href = 'modify.php?sukso_id=<?=$sukso_id?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$cur_page?>';" />
							<input type="button" class="btn_submit" value="삭제" onclick="javascript:eventCategoryDelete('<?=$sukso_id?>');" //>
						</td>
					</tr>
	<?
			$cnt--;
		}
		
		if($row_num == 0) {
	?>
					<tr height="40px" align="center">
						<td colspan="5">
							해당 숙소 정보가 존재하지 않습니다.
						</td>
					</tr>
	<? } ?>
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

<script>
<!--

function eventCategoryDelete(sukso_id) {
	if(manage_id != "") {
		if(confirm("정말로 삭제하시겠습니까?")) {
			location.href = "delete_ok.php?sukso_id=" + sukso_id + "&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$cur_page?>";
			return;
		}
	}
}

//-->
</script>

<?php
	include_once("../include/footer.php");
?>