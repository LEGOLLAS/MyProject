<?php
	include_once("../include/header.php");
	
	include_once("../../include/db_connect.php");

	$event_id = $_REQUEST['event_id'];	
	$query = "
		SELECT 
			event_id, 
			wr_id, 
			category_id, 
			bcategory_id, 
			scategory_id, 
			date_format(event_start_date, '%Y-%m-%d') event_start_date, 
			date_format(event_end_date, '%Y-%m-%d') event_end_date, 
			event_place, 
			event_title, 
			event_content, 
			event_ip, 
			event_sort, 
			reg_date, 
			modi_date 
		FROM 
			comm_info_event 
		WHERE 
			event_id = '".$event_id."'";
	$result = mysql_query($query);
	$row = mysql_fetch_assoc($result);
?>

<script>
	$(document).ready(function(){
		$("#event_start_date, #event_end_date").datepicker({
			dateFormat:'yy-mm-dd',
				prevText: '���� ��',
				nextText: '���� ��',
				monthNames: ['1��','2��','3��','4��','5��','6��','7��','8��','9��','10��','11��','12��'],
				monthNamesShort: ['1��','2��','3��','4��','5��','6��','7��','8��','9��','10��','11��','12��'],
				dayNames: ['��','��','ȭ','��','��','��','��'],
				dayNamesShort: ['��','��','ȭ','��','��','��','��'],
				dayNamesMin: ['��','��','ȭ','��','��','��','��'],
				showMonthAfterYear: true,
				yearSuffix: '��'
		});
	});

	function insertFormSubmit() {
		var insertForm = document.getElementById("insertForm");
		var category_id = document.getElementById("category_id");
		var event_title = document.getElementById("event_title");
		var event_sort = document.getElementById("event_sort");
		
		if(category_id.value == "") {
			alert("ī�װ��� �������ּ���.");
			category_id.focus();
			return false;
		}
		
		if(event_title.value == "") {
			alert("���/�̺�Ʈ ������ �Է����ּ���.");
			event_title.focus();
			return false;
		}
		
		if(event_sort.value == "") {
			alert("���/�̺�Ʈ ������ �Է����ּ���.");
			event_sort.focus();
			return false;
		}

		insertForm.action = "modify_ok.php";
	}

	function isNum(ev){ 
		var evt_code = (window.netscape) ? ev.which : event.keyCode;
		var event_sort = document.getElementById("event_sort");
		
		if(!(evt_code == 8 || evt_code == 9 || evt_code == 13 || evt_code == 46 || evt_code == 144 || (evt_code >= 48 && evt_code <= 57) || evt_code == 110 || evt_code == 190)){ 
			alert("���ڸ� �Է� �����մϴ�.");
			event.returnValue = false;
			event_sort.value = "";
		}
	}
	
	// �ü� ��з� ���ý� ajax �̺�Ʈ ó��
	function bcategoryChange() {
		$.ajax({
			'type': 'post',
			'url': '/admin/kanzi/scategory_ajax.php?bcategory_id=' + $("#bcategory_id").val(),
			'contentType': 'text/plain; charset=utf-8',
			'data': { "" : "" },
			'dataType': 'json',
			'error': function (request, status, error) {
				bcategoryChangeFailCallback(request, status, error); //���� �ݹ��Լ� ȣ��
			},
			'success': function (data) {
				bcategoryChangeSuccessCallback(data); //���� �ݹ��Լ� ȣ��
			}
		});
	}

	function bcategoryChangeFailCallback(request, status, error) {
		alert("ó�� �� ������ �߻��Ͽ����ϴ�.\n status : " + status + ", error : " + error);
		return;
	}
	
	function bcategoryChangeSuccessCallback(data) {
		var scategory_list = data.scategory_list;
		var strHtml = "";
		var strWrHtml = "";
		
		if(scategory_list.length > 0) {
			strHtml += "<option>- �ü� �Һз� ���� -</option>";
			strWrHtml += "<option>- ��ȸ������� �ü�����ü�� ���� -</option>";
			
			for(var i=0; i<scategory_list.length; i++) {
				strHtml += "<option value=\""+scategory_list[i].scategory_id+"\">"+scategory_list[i].scategory_name+"</option>";

				var comm_info_kanzi_list = data.scategory_list[i].comm_info_kanzi_list;
				
				if(comm_info_kanzi_list.length > 0) {
					for(var j=0; j<comm_info_kanzi_list.length; j++) {
						strWrHtml += "<option value=\""+comm_info_kanzi_list[j].wr_id+"\">"+comm_info_kanzi_list[j].wr_subject+"</option>";
					}
				}
			}
		} else {
			strHtml += "<option>- �ü� �Һз� ���� -</option>";
		}
		
		$("#scategory_id").html(strHtml);
		$("#wr_id").html(strWrHtml);
	}
	// **** �ü� ��з� ���ý� ajax �̺�Ʈ ó�� *** /////

	// �ü� �Һз� ���ý� ajax �̺�Ʈ ó��
	function scategoryChange() {
		$.ajax({
			'type': 'post',
			'url': '/admin/kanzi/scategory_ajax.php?bcategory_id=' + $("#bcategory_id").val() + '&scategory_id=' + $("#scategory_id").val(),
			'contentType': 'text/plain; charset=utf-8',
			'data': { "" : "" },
			'dataType': 'json',
			'error': function (request, status, error) {
				scategoryChangeFailCallback(request, status, error); //���� �ݹ��Լ� ȣ��
			},
			'success': function (data) {
				scategoryChangeSuccessCallback(data); //���� �ݹ��Լ� ȣ��
			}
		});
	}
	
	function scategoryChangeFailCallback(request, status, error) {
		alert("ó�� �� ������ �߻��Ͽ����ϴ�.\n status : " + status + ", error : " + error);
		return;
	}

	function scategoryChangeSuccessCallback(data) {
		var scategory_list = data.scategory_list;
		var strHtml = "";
		var strWrHtml = "";
		
		if(scategory_list.length > 0) {
			strWrHtml = "";
			strHtml += "<option>- �ü� �Һз� ���� -</option>";
			strWrHtml += "<option>- ��ȸ������� �ü�����ü�� ���� -</option>";
			
			for(var i=0; i<scategory_list.length; i++) {
				strHtml += "<option value=\""+scategory_list[i].scategory_id+"\" "+(($("#scategory_id").val() == scategory_list[i].scategory_id) ? " selected" : "")+">"+scategory_list[i].scategory_name+"</option>";

				var comm_info_kanzi_list = data.scategory_list[i].comm_info_kanzi_list;
				
				if(comm_info_kanzi_list.length > 0) {
					for(var j=0; j<comm_info_kanzi_list.length; j++) {
						strWrHtml += "<option value=\""+comm_info_kanzi_list[j].wr_id+"\">"+comm_info_kanzi_list[j].wr_subject+"</option>";
					}
				} else {
					strWrHtml = "";
					strWrHtml += "<option>- ��ȸ������� �ü�����ü�� ���� -</option>";
				}
			}
		} else {
			strHtml += "<option>- �ü� �Һз� ���� -</option>";
		}
		
		$("#scategory_id").html(strHtml);
		$("#wr_id").html(strWrHtml);
	}

	// **** �ü� �Һз� ���ý� ajax �̺�Ʈ ó�� *** /////
</script>

	<div id="contentArea">
		<div id="subTitle">���/�̺�Ʈ ����</div>
		<div id="subContent">
			<div style="padding:10px 50px 10px 10px;">
				
				<form name="insertForm" id="insertForm" method="post" onsubmit="return insertFormSubmit();">
				<input type="hidden" name="event_id" id="event_id" value="<?=$event_id?>" />
				<div id="insertArea">
					<table width="100%" cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse; table-layout:fixed;">
					<tr height="40px" align="center">
						<th width="15%"><div>ī�װ�</div><div>(����)</div></th>
						<td align="left">
							<select name="category_id" id="category_id" style="height:25px;">
							<option value="">-ī�װ� ����-</option>
							<?
								$select_query = "SELECT * FROM comm_info_event_category WHERE 1=1 ORDER BY category_sort ASC";
								$select_result = mysql_query($select_query);
								
								$cnt = 0;
								
								while($select_row = mysql_fetch_array($select_result)) {
									$req_category_id = $select_row['category_id'];
									$category_name = $select_row['category_name'];
							?>
							<option value="<?=$req_category_id?>"<?php if($req_category_id == $row['category_id']) { ?> selected<? } ?>><?=$category_name?></option>						
							<?
								}
							?>
							</select>
						</td>
					</tr>				
					<tr height="40px" align="center">
						<th width="15%">����</th>
						<td align="left"><input type="text" name="event_title" id="event_title" value="<?=$row['event_title']?>" style="width:98%; height:30px;" /></td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">��� �Ⱓ</th>
						<td align="left">
							<input type="text" name="event_start_date" id="event_start_date" value="<?=$row['event_start_date']?>" style="width:40%; height:30px;" /> ~ 
							<input type="text" name="event_end_date" id="event_end_date" value="<?=$row['event_end_date']?>" style="width:40%; height:30px;" />
						</td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">�ü� ����</th>
						<td align="left">
							<select name="bcategory_id" id="bcategory_id" style="height:30px;" onchange="javascript:bcategoryChange();">
								<option value="">- �ü� ��з� ���� -</option>
								<?
									$select_query = "SELECT * FROM comm_info_bcategory WHERE 1=1 ORDER BY bcategory_sort ASC";
									$select_result = mysql_query($select_query);
									
									while($select_row = mysql_fetch_array($select_result)) {
										$req_bcategory_id = $select_row['bcategory_id'];
										$req_bcategory_name = $select_row['bcategory_name'];
								?>
								<option value="<?=$req_bcategory_id?>"<?php if($row['bcategory_id'] == $req_bcategory_id) { ?> selected<?php } ?>><?=$req_bcategory_name?></option>						
								<?
									}
								?>
							</select>

							<select name="scategory_id" id="scategory_id" style="height:30px;" onchange="javascript:scategoryChange();">
								<option value="">- �ü� �Һз� ���� -</option>
								<?
									$select_query = "SELECT * FROM comm_info_scategory WHERE 1=1 AND bcategory_id = '".$row['bcategory_id']."' AND scategory_YN = 'Y' ORDER BY bcategory_id ASC, scategory_sort ASC";
									$select_result = mysql_query($select_query);
									
									while($select_row = mysql_fetch_array($select_result)) {
										$req_scategory_id = $select_row['scategory_id'];
										$req_scategory_name = $select_row['scategory_name'];
								?>
								<option value="<?=$req_scategory_id?>"<?php if($row['scategory_id'] == $req_scategory_id) { ?> selected<?php } ?>><?=$req_scategory_name?></option>						
								<?
									}
								?>
							</select>

							<select name="wr_id" id="wr_id" style="height:30px;">
								<option value="">- ��ȸ������� �ü�����ü�� ���� -</option>
								<?
									$select_comm_info_query = "
										SELECT 
											wr_id, wr_num, wr_reply, 
											wr_parent, wr_is_comment, wr_comment, 
											wr_comment_reply, ca_name, 
											bcategory_id, scategory_id, 
											wr_option, wr_subject, wr_content, 
											wr_link1, wr_link2, wr_link1_hit, wr_link2_hit, 
											wr_trackback, wr_hit, wr_good, wr_nogood, 
											mb_id, wr_password, wr_name, wr_email, wr_homepage, 
											wr_datetime, wr_last, wr_ip, 
											wr_1, wr_2, wr_3, wr_4, wr_5, wr_6, wr_7, wr_8, wr_9, 
											wr_10, wr_11, wr_12, wr_13, wr_14, wr_15, wr_16, wr_17, 
											wr_18, wr_19, wr_20, wr_21, wr_22, wr_23, wr_24, wr_25, 
											wr_26, wr_27, wr_28, wr_29, wr_30, wr_31, wr_32, wr_33, 
											wr_34, wr_35, wr_36, wr_37, wr_38, wr_39, wr_40, wr_41, 
											wr_42, wr_43, wr_44, wr_45, wr_46, wr_47, wr_48, wr_49, 
											wr_50, lat_val, lon_val, profile, 
											building_profile, qr_file
										FROM 
											comm_info 
										WHERE 
											1=1
										AND bcategory_id = '".$row["bcategory_id"]."'
										AND wr_good = '1'
									";

									if($row["scategory_id"] != "") {
										$select_comm_info_query .= " AND scategory_id = '".$row["scategory_id"]."'";
									}

									$select_comm_info_query .= " ORDER BY wr_subject ASC ";
									$select_comm_info_query_row = mysql_query($select_comm_info_query);
									
									while($select_comm_info_row = mysql_fetch_array($select_comm_info_query_row)) {
										$comm_info_wr_id = $select_comm_info_row['wr_id'];
										$comm_info_wr_subject = $select_comm_info_row['wr_subject'];
								?>
								<option value="<?=$comm_info_wr_id?>"<?php if($row['wr_id'] == $comm_info_wr_id) { ?> selected<?php } ?>><?=$comm_info_wr_subject?></option>						
								<?
									}
								?>
							</select>
						</td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">��� ���</th>
						<td align="left"><input type="text" name="event_place" id="event_place" style="width:98%; height:30px;" value="<?=$row['event_place']?>" /></td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">����</th>
						<td align="left">
							<textarea name="event_content" style="width:99%; height:150px;"><?=$row['event_content']?></textarea>
						</td>
					</tr>
					<tr height="40px" align="center">
						<th>����</th>
						<td align="left"><input type="text" name="event_sort" id="event_sort" value="<?=$row['event_sort']?>" style="width:98%; height:30px;" onkeyup="javascript:isNum(event);" /></td>
					</tr>
					</table>
				</div>
				
				<div id="insertButtonArea">
					<input type="submit" class="btn_submit" value="����" />
					<input type="button" class="btn_submit" value="�ڷΰ���" onclick="location.href = '/admin/event/list.php?searchSelectCategory=<?=$_REQUEST['searchSelectCategory']?>&searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>&page=<?=$_REQUEST['page']?>';" />
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
	include_once("../include/footer.php");
?>