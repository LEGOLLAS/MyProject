<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/include/db_connect.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPExcel_1.8/Classes/PHPExcel.php';
	
	$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/admin/excel_uploads/';
	$upload_file = $upload_dir . basename($_FILES['EVENT_EXCEL_FILE']['name']);

	$page = $_REQUEST['page'];
	$searchSelectCategory = $_REQUEST['searchSelectCategory'];
	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	
	try {
		move_uploaded_file($_FILES['EVENT_EXCEL_FILE']['tmp_name'], $upload_file);
		
		$inputFileType = PHPExcel_IOFactory::identify( $upload_file );
		$objReader     = PHPExcel_IOFactory::createReader( $inputFileType );

		$objPHPExcel = $objReader->load( $upload_file );
		
		/**
		 * @var $sheet PHPExcel_Worksheet
		 */
		$sheet = $objPHPExcel->getSheet( 0 );
		
		$highestRow    = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();
		
		for ( $row = 5; $row <= $highestRow; $row ++ ) {
			$rowData = $sheet->rangeToArray( 'A' . $row . ':' . $highestColumn . $row, null, true, false );
			$rowData = $rowData[0];
			
			$category_name = $rowData[0]; // �̺�Ʈ ī�װ���
			$bcategory_name = $rowData[1]; // �ü� ��з� ī�װ���
			$scategory_name = $rowData[2]; // �ü� �Һз� ī�װ���
			$wr_subject = $rowData[3]; // �ü�����ü��
			$event_title = $rowData[4]; // ��� ����
			$event_start_date = $rowData[5]; // ��� ������
			$event_end_date = $rowData[6]; // ��� ������
			$event_content = $rowData[7]; // ��� ����
			$event_sort = $rowData[8]; // ��� ����
			$event_ip = $_SERVER['REMOTE_ADDR'];

			$category_name = iconv("UTF-8", "EUC-KR", $category_name);
			$bcategory_name = iconv("UTF-8", "EUC-KR", $bcategory_name);
			$scategory_name = iconv("UTF-8", "EUC-KR", $scategory_name);
			$wr_subject = iconv("UTF-8", "EUC-KR", $wr_subject);
			$event_title = iconv("UTF-8", "EUC-KR", $event_title);
			$event_start_date = iconv("UTF-8", "EUC-KR", $event_start_date);
			$event_end_date = iconv("UTF-8", "EUC-KR", $event_end_date);
			$event_content = iconv("UTF-8", "EUC-KR", $event_content);
			$event_sort = iconv("UTF-8", "EUC-KR", $event_sort);
			$event_ip = iconv("UTF-8", "EUC-KR", $event_ip);
			
			$comm_info_event_category_query = "SELECT category_id FROM comm_info_event_category WHERE category_name = '".$category_name."'";
			$comm_info_event_category_query_result = mysql_query($comm_info_event_category_query);
			$comm_info_event_category_query_row = mysql_fetch_assoc($comm_info_event_category_query_result);

			$bcategory_query = "SELECT bcategory_id FROM comm_info_bcategory WHERE bcategory_name = '".$bcategory_name."'";
			$bcategory_query_result = mysql_query($bcategory_query);
			$bcategory_query_row = mysql_fetch_assoc($bcategory_query_result);
			
			$scategory_query = "SELECT scategory_id FROM comm_info_scategory WHERE scategory_name = '".$scategory_name."' AND bcategory_id = '".$bcategory_query_row['bcategory_id']."'";
			$scategory_query_result = mysql_query($scategory_query);
			$scategory_query_row = mysql_fetch_assoc($scategory_query_result);
			
			$wr_query = "SELECT wr_id FROM comm_info WHERE wr_subject = '".$wr_subject."'";
			
			if($bcategory_query_row['bcategory_id'] != "") {
				$wr_query .= " AND bcategory_id = '".$bcategory_query_row['bcategory_id']."'";
			}
			
			if($scategory_query_row['scategory_id'] != "") {
				$wr_query .= " AND scategory_id = '".$scategory_query_row['scategory_id']."'";
			}

			$wr_query_result = mysql_query($wr_query);
			$wr_query_row = mysql_fetch_assoc($wr_query_result);
			
			$event_start_date = str_replace("'", "", $event_start_date);
			$event_end_date = str_replace("'", "", $event_end_date);

			$query = "
				INSERT INTO comm_info_event 
				(
					category_id,
					bcategory_id,
					scategory_id,
					wr_id,
					event_title,
					event_content,
					event_start_date,
					event_end_date,
					event_ip,
					event_sort,
					reg_date,
					modi_date
				)
				VALUES
				(
					'".$comm_info_event_category_query_row['category_id']."',
					'".$bcategory_query_row['bcategory_id']."',
					'".$scategory_query_row['scategory_id']."',
					'".$wr_query_row['wr_id']."',
					'".$event_title."',
					'".$event_content."',
					date_format('".$event_start_date."', '%Y-%m-%d'),
					date_format('".$event_end_date."', '%Y-%m-%d'),
					'".$event_ip."',
					'".$event_sort."',
					now(),
					now()
				)";
			
			mysql_query($query);
		}
?>
		<script>
		window.onload = function() {
			alert("���� ���ε� �Է� ó���� �Ϸ�Ǿ����ϴ�.");
			location.href = "/admin/event/list.php?searchSelectCategory=<?=$searchSelectCategory?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
			return;
		}
		</script>
<?
		unlink($upload_file); // ���� ���� ���ε� �Ϸ� ��, ������ �뷮�� �ʰ����� �ʵ��� �ϱ� ���ؼ� ���ε� ó���� ���� ������ �ش� ��ο��� ���� ��ġ��
	} catch ( Exception $e ) {
		$errMsg = $e->getMessage();
?>
		<script>
		window.onload = function() {
			alert("���� ���ε� �Է� ó���� ������ �߻��Ͽ����ϴ�.\r\n(<?=$errMsg?>)");
			location.href = "/admin/event/excel_upload.php?searchSelectCategory=<?=$searchSelectCategory?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
			return;
		}
		</script>
<?
	}
?>