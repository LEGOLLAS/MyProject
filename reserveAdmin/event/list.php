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
		if(confirm("�ش� ���/�̺�Ʈ ������ ������ �����Ͻðڽ��ϱ�?\n�ѹ� �����Ͻø� ������ �Ұ����մϴ�.")) {
			location.href = "/admin/event/delete_ok.php?event_id=" + event_id;
			return;
		}
	}
}

//-->
</script>

<?php
	$page = $_REQUEST['page'];
	if(!$page) $page = 1; //���� ��������ȣ�� ���ٸ� 1�� �ʱ�ȭ 
	$end_row = 15;//���������� ����� �Խù��� ���� 
	$start_row = ($page-1)*$end_row; //�Խù� ���۹�ȣ 
	
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
	$row_num = mysql_num_rows($count_result);//�Խ����� �� ���ڵ� ���� 
	$max_page = ceil($row_num/$end_row); //�Խ����� �� ���ڵ� ���� ������ ���������� ���ڵ� ���� = �Ҽ����ø�(�������� �־���� ����) $max_page 
	
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
		<div id="subTitle">���/�̺�Ʈ ����</div>
		<div id="subContent">
			<div style="padding:10px 50px 10px 10px;">
				<div id="searchArea">
					<form name="searchForm" id="searchForm" method="get">
					
					<select name="searchSelectCategory" onchange="this.form.submit();">
					<option value="">-ī�װ� ��ü-</option>
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
					<option value="">-Ű���� ��ü-</option>
					<option value="eventTitle"<?php if($searchSelect == "eventTitle") { ?> selected<?php }?>>����</option>
					<option value="eventContent"<?php if($searchSelect == "eventContent") { ?> selected<?php }?>>����</option>
					<option value="eventSort"<?php if($searchSelect == "eventSort") { ?> selected<?php }?>>����</option>
					</select>

					<input type="text" name="searchKeyword" value="<?=$_REQUEST['searchKeyword']?>" />
					<input type="submit" class="btn_submit" value="�˻�" />
					
					</form>
				</div>

				<div id="insertArea">
					<div style="float:left;">
						Total <?=number_format($row_num)?>��
					</div>
					<div style="float:right; padding-bottom:5px;">
						<input type="button" class="btn_insert" value="���� ���ε�(�ϰ�����)" onclick="javascript:location.href = '/admin/event/excel_upload_modify.php?page=<?=$page?>&searchSelectCategory=<?=$_REQUEST['searchSelectCategory']?>&searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>';" />
						<input type="button" class="btn_insert" value="���� ���ε�(�ϰ�����)" onclick="javascript:location.href = '/admin/event/excel_upload_delete.php?page=<?=$page?>&searchSelectCategory=<?=$_REQUEST['searchSelectCategory']?>&searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>';" />
						<input type="button" class="btn_insert" value="���� ���ε�(�ϰ��߰�)" onclick="javascript:location.href = '/admin/event/excel_upload.php?page=<?=$page?>&searchSelectCategory=<?=$_REQUEST['searchSelectCategory']?>&searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>';" />
						<input type="button" class="btn_insert" value="���" onclick="javascript:location.href = '/admin/event/insert.php?page=<?=$page?>&searchSelectCategory=<?=$_REQUEST['searchSelectCategory']?>&searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>';" />
					</div>
					<div style="clear:both; display:none;"></div>
				</div>

				<div id="listArea">
					<table width="100%" border="1" cellpadding="5" cellspacing="0" style="border-collapse:collapse;">
					<tr height="40px">
						<th style="width:8%"><nobr>No</nobr></th>
						<th style="width:10%"><nobr>ī�װ���</nobr></th>
						<th style="width:20%"><nobr>�ü�����ü��</nobr></th>
						<th style="width:*"><nobr>�������</nobr></th>
						<th style="width:12%"><nobr>������</nobr></th>
						<th style="width:10%"><nobr>����</nobr></th>
						<th style="width:16%"><nobr>����</nobr></th>
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
			
			// �̺�Ʈ ī�װ� ����
			$req_select_category_query = "SELECT category_name FROM comm_info_event_category WHERE category_id = '".$req_category_id."'";
			$req_select_category_result = mysql_query($req_select_category_query);
			$req_select_category_row = mysql_fetch_assoc($req_select_category_result);
			
			// �ü� ��з� ī�װ� ����
			$req_select_bcategory_query = "SELECT bcategory_name FROM comm_info_bcategory WHERE bcategory_id = '".$req_bcategory_id."'";
			$req_select_bcategory_result = mysql_query($req_select_bcategory_query);
			$req_select_bcategory_row = mysql_fetch_assoc($req_select_bcategory_result);

			// �ü� �Һз� ī�װ� ����
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
							<input type="button" class="btn_submit" value="����" onclick="location.href = '/admin/event/modify.php?event_id=<?=$event_id?>&searchSelectCategory=<?=$_REQUEST['searchSelectCategory']?>&searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>&page=<?=$page?>';" />
							<input type="button" class="btn_submit" value="����" onclick="javascript:eventDelete('<?=$event_id?>');" //>
						</td>
					</tr>
	<?
		}
		
		if($cnt == 0) {
	?>
					<tr height="40px" align="center">
						<td colspan="7">
							�ش� ���/�̺�Ʈ�� �������� �ʽ��ϴ�.
						</td>
					</tr>
	<?php } ?>
					</table>

					<div id="paging" style="text-align:center; font-size:15px; padding-top:10px; padding-bottom:10px;">
						<? 
							if(($page-1)!=0 && ($page-1)<$max_page) {
						?>
						   <a href="?page=<?=$page-1?>&searchSelectCategory=<?=$_REQUEST['searchSelectCategory']?>&searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>" style="text-decoration:none; border:0px; color:#3B9FBE; font-weight:bold;">��</a>&nbsp;
						<?
							}
							for($i=1;$i<=$max_page;$i++) {
						?><a href="?page=<?=$i?>&searchSelectCategory=<?=$_REQUEST['searchSelectCategory']?>&searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>" <? if($page == $i) { ?>style="color:red; font-weight:bold; margin-right:2px;"<? } ?>><?=$i?></a>&nbsp;<?
							} 
							if(($page+1)<=$max_page) {
						?>
						   <a href="?page=<?=$page+1?>&searchSelectCategory=<?=$_REQUEST['searchSelectCategory']?>&searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>">��</a> 
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