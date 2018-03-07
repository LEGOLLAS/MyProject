<?php
	include_once("../include/header.php");
	
	include_once("../../include/db_connect.php");

	$searchSelectCategory = $_REQUEST['searchSelectCategory'];
	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
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

function eventDelete(event_id) {
	if(event_id != "") {
		if(confirm("해당 행사/이벤트 정보를 정말로 삭제하시겠습니까?\n한번 삭제하시면 복구가 불가능합니다.")) {
			location.href = "/admin/event/delete_ok.php?event_id=" + event_id;
			return;
		}
	}
}

//-->
</script>

<?php
	$page = $_REQUEST['page'];
	if(!$page) $page = 1; //현재 페이지번호가 없다면 1로 초기화 
	$end_row = 15;//페이지에서 출력할 게시물의 갯수 
	$start_row = ($page-1)*$end_row; //게시물 시작번호 
	
	$count_query = "SELECT * FROM comm_info_event WHERE 1=1";
	
	if($searchSelectCategory != "") {
		$count_query .= " AND category_id = '".$searchSelectCategory."'";
	}

	if($searchSelect == "eventTitle") {
		$count_query .= " AND event_title LIKE '%".$searchKeyword."%'";
	}
	
	if($searchSelect == "eventContent") {
		$count_query .= " AND event_content LIKE '%".$searchKeyword."%'";
	}
	
	if($searchSelect == "eventSort") {
		$count_query .= " AND event_sort = '".$searchKeyword."'";
	}

	if($searchSelect == "") {
		$count_query .= " AND (event_title LIKE '%".$searchKeyword."%' OR event_content LIKE '%".$searchKeyword."%')";
	}
	
	$count_result = mysql_query($count_query);
	$row_num = mysql_num_rows($count_result);//게시판의 총 레코드 갯수 
	$max_page = ceil($row_num/$end_row); //게시판의 총 레코드 갯수 나누기 한페이지의 레코드 갯수 = 소숫점올림(페이지가 있어야할 갯수) $max_page 
	
	$select_query = "SELECT * FROM comm_info_event WHERE 1=1";
	
	if($searchSelectCategory != "") {
		$select_query .= " AND category_id = '".$searchSelectCategory."'";
	}
	
	if($searchSelect == "eventTitle") {
		$select_query .= " AND event_title LIKE '%".$searchKeyword."%'";
	}
	
	if($searchSelect == "eventContent") {
		$select_query .= " AND event_content LIKE '%".$searchKeyword."%'";
	}
	
	if($searchSelect == "eventSort") {
		$select_query .= " AND event_sort = '".$searchKeyword."'";
	}
	
	if($searchSelect == "") {
		$select_query .= " AND (event_title LIKE '%".$searchKeyword."%' OR event_content LIKE '%".$searchKeyword."%')";
	}
	
	$select_query .= " ORDER BY category_id ASC, event_sort ASC";
	$select_query .= " limit $start_row, $end_row ";
	$select_result = mysql_query($select_query);
	
	$cnt = 0;
?>

	<div id="contentArea">
		<div id="subTitle">행사/이벤트 관리</div>
		<div id="subContent">
			<div style="padding:10px 50px 10px 10px;">
				<div id="searchArea">
					<form name="searchForm" id="searchForm" method="get">
					
					<select name="searchSelectCategory" onchange="this.form.submit();">
					<option value="">-카테고리 전체-</option>
	<?php
		$category_select_query = "SELECT * FROM comm_info_event_category WHERE 1=1 ORDER BY category_sort ASC";
		$category_select_result = mysql_query($category_select_query);

		while($category_select_row = mysql_fetch_array($category_select_result)) {
			$category_id = $category_select_row['category_id'];
			$category_name = $category_select_row['category_name'];

			if($searchSelectCategory == $category_id) {
	?>
				<option value="<?=$category_id?>" selected><?=$category_name?></option>
	<?php
			} else {
	?>
				<option value="<?=$category_id?>"><?=$category_name?></option>
	<?php
			}	
		}
	?>
					</select>

					<select name="searchSelect">
					<option value="">-키워드 전체-</option>
					<option value="eventTitle"<?php if($searchSelect == "eventTitle") { ?> selected<?php }?>>제목</option>
					<option value="eventContent"<?php if($searchSelect == "eventContent") { ?> selected<?php }?>>내용</option>
					<option value="eventSort"<?php if($searchSelect == "eventSort") { ?> selected<?php }?>>순서</option>
					</select>

					<input type="text" name="searchKeyword" value="<?=$_REQUEST['searchKeyword']?>" />
					<input type="submit" class="btn_submit" value="검색" />
					
					</form>
				</div>

				<div id="insertArea">
					<div style="float:left;">
						Total <?=number_format($row_num)?>개
					</div>
					<div style="float:right; padding-bottom:5px;">
						<input type="button" class="btn_insert" value="엑셀 업로드(일괄수정)" onclick="javascript:location.href = '/admin/event/excel_upload_modify.php?page=<?=$page?>&searchSelectCategory=<?=$_REQUEST['searchSelectCategory']?>&searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>';" />
						<input type="button" class="btn_insert" value="엑셀 업로드(일괄삭제)" onclick="javascript:location.href = '/admin/event/excel_upload_delete.php?page=<?=$page?>&searchSelectCategory=<?=$_REQUEST['searchSelectCategory']?>&searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>';" />
						<input type="button" class="btn_insert" value="엑셀 업로드(일괄추가)" onclick="javascript:location.href = '/admin/event/excel_upload.php?page=<?=$page?>&searchSelectCategory=<?=$_REQUEST['searchSelectCategory']?>&searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>';" />
						<input type="button" class="btn_insert" value="등록" onclick="javascript:location.href = '/admin/event/insert.php?page=<?=$page?>&searchSelectCategory=<?=$_REQUEST['searchSelectCategory']?>&searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>';" />
					</div>
					<div style="clear:both; display:none;"></div>
				</div>

				<div id="listArea">
					<table width="100%" border="1" cellpadding="5" cellspacing="0" style="border-collapse:collapse;">
					<tr height="40px">
						<th style="width:8%"><nobr>No</nobr></th>
						<th style="width:10%"><nobr>카테고리명</nobr></th>
						<th style="width:20%"><nobr>시설·단체명</nobr></th>
						<th style="width:*"><nobr>행사제목</nobr></th>
						<th style="width:12%"><nobr>행사장소</nobr></th>
						<th style="width:10%"><nobr>순서</nobr></th>
						<th style="width:16%"><nobr>관리</nobr></th>
					</tr>

<?php		
		while($select_row = mysql_fetch_array($select_result)) {

			$event_id = $select_row['event_id'];
			$event_title = $select_row['event_title'];
			$event_place = $select_row['event_place'];
			$event_sort = $select_row['event_sort'];
			
			$req_category_id = $select_row['category_id'];
			$req_bcategory_id = $select_row['bcategory_id'];
			$req_scategory_id = $select_row['scategory_id'];
			
			// 이벤트 카테고리 정보
			$req_select_category_query = "SELECT category_name FROM comm_info_event_category WHERE category_id = '".$req_category_id."'";
			$req_select_category_result = mysql_query($req_select_category_query);
			$req_select_category_row = mysql_fetch_assoc($req_select_category_result);
			
			// 시설 대분류 카테고리 정보
			$req_select_bcategory_query = "SELECT bcategory_name FROM comm_info_bcategory WHERE bcategory_id = '".$req_bcategory_id."'";
			$req_select_bcategory_result = mysql_query($req_select_bcategory_query);
			$req_select_bcategory_row = mysql_fetch_assoc($req_select_bcategory_result);

			// 시설 소분류 카테고리 정보
			$req_select_scategory_query = "SELECT scategory_name FROM comm_info_scategory WHERE scategory_id = '".$req_scategory_id."'";
			$req_select_scategory_result = mysql_query($req_select_scategory_query);
			$req_select_scategory_row = mysql_fetch_assoc($req_select_scategory_result);

			$cnt++;
	?>
					<tr height="30px" align="center">
						<td><?=$cnt?></td>
						<td><?=$req_select_category_row['category_name']?></td>
						<td align="left">[<?=$req_select_bcategory_row['bcategory_name']?><?php if($req_select_scategory_row['scategory_name'] != "") {?> - <?php echo $req_select_scategory_row['scategory_name']; } ?>]</td>
						<td align="left"><?=$event_title?></td>
						<td align="left"><?=$event_place?></td>
						<td><?=$event_sort?></td>
						<td>
							<input type="button" class="btn_submit" value="수정" onclick="location.href = '/admin/event/modify.php?event_id=<?=$event_id?>&searchSelectCategory=<?=$_REQUEST['searchSelectCategory']?>&searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>&page=<?=$page?>';" />
							<input type="button" class="btn_submit" value="삭제" onclick="javascript:eventDelete('<?=$event_id?>');" //>
						</td>
					</tr>
	<?
		}
		
		if($cnt == 0) {
	?>
					<tr height="40px" align="center">
						<td colspan="7">
							해당 행사/이벤트가 존재하지 않습니다.
						</td>
					</tr>
	<?php } ?>
					</table>

					<div id="paging" style="text-align:center; font-size:15px; padding-top:10px; padding-bottom:10px;">
						<? 
							if(($page-1)!=0 && ($page-1)<$max_page) {
						?>
						   <a href="?page=<?=$page-1?>&searchSelectCategory=<?=$_REQUEST['searchSelectCategory']?>&searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>" style="text-decoration:none; border:0px; color:#3B9FBE; font-weight:bold;">◀</a>&nbsp;
						<?
							}
							for($i=1;$i<=$max_page;$i++) {
						?><a href="?page=<?=$i?>&searchSelectCategory=<?=$_REQUEST['searchSelectCategory']?>&searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>" <? if($page == $i) { ?>style="color:red; font-weight:bold; margin-right:2px;"<? } ?>><?=$i?></a>&nbsp;<?
							} 
							if(($page+1)<=$max_page) {
						?>
						   <a href="?page=<?=$page+1?>&searchSelectCategory=<?=$_REQUEST['searchSelectCategory']?>&searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>">▶</a> 
						<?
							}
						?>
						<?mysql_close();?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	include_once("../include/footer.php");
?>