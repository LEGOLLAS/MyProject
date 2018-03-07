<?php
	include_once("../include/header.php");
	
	include_once("../../include/db_connect.php");
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

		insertForm.action = "insert_ok.php";
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
</script>

	<div id="contentArea">
		<div id="subTitle">���/�̺�Ʈ ���</div>
		<div id="subContent">
			<div style="padding:10px 50px 10px 10px;">
				
				<form name="insertForm" id="insertForm" method="post" onsubmit="return insertFormSubmit();">
				<div id="insertArea">
					<table width="100%" cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse; table-layout:fixed;">
					<tr height="40px" align="center">
						<th width="15%"><div>ī�װ�</div><div>(����)</div></th>
						<td align="left">
							<select name="category_id" id="category_id" style="height:25px;">
							<option value="">- ī�װ� ���� -</option>
							<?
								$select_query = "SELECT * FROM comm_info_event_category WHERE 1=1 ORDER BY category_sort ASC";
								$select_result = mysql_query($select_query);
								
								$cnt = 0;
								
								while($select_row = mysql_fetch_array($select_result)) {
									$category_id = $select_row['category_id'];
									$category_name = $select_row['category_name'];
							?>
							<option value="<?=$category_id?>"><?=$category_name?></option>						
							<?
								}
							?>
							</select>
						</td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">����</th>
						<td align="left"><input type="text" name="event_title" id="event_title" style="width:98%; height:30px;" /></td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">��� �Ⱓ</th>
						<td align="left">
							<input type="text" name="event_start_date" id="event_start_date" style="width:40%; height:30px;" /> ~ 
							<input type="text" name="event_end_date" id="event_end_date" style="width:40%; height:30px;" />
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
							</select>

							<select name="wr_id" id="wr_id" style="height:30px;">
								<option value="">- ��ȸ������� �ü�����ü�� ���� -</option>
							</select>
						</td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">��� ���</th>
						<td align="left"><input type="text" name="event_place" id="event_place" style="width:98%; height:30px;" /></td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">����</th>
						<td align="left">
							<textarea name="event_content" style="width:99%; height:150px;"></textarea>
						</td>
					</tr>
					<tr height="40px" align="center">
						<th>����</th>
						<td align="left"><input type="text" name="event_sort" id="event_sort" style="width:98%; height:30px;" onkeyup="javascript:isNum(event);" /></td>
					</tr>
					</table>
				</div>

				<div id="insertButtonArea">
					<input type="submit" class="btn_submit" value="���" />
					<input type="button" class="btn_submit" value="�ڷΰ���" onclick="location.href = '/admin/event/list.php?page=<?=$_REQUEST['page']?>&searchSelectCategory=<?=$_REQUEST['searchSelectCategory']?>&searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>';" />
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
	include_once("../include/footer.php");
?>