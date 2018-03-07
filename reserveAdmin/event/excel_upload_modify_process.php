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

		$totalCnt = 0;
		$totCnt = 0;
		$notTotCnt = 0;
		
		for ( $row = 6; $row <= $highestRow; $row ++ ) {
			$totalCnt++;
			$rowData = $sheet->rangeToArray( 'A' . $row . ':' . $highestColumn . $row, null, true, false );
			$rowData = $rowData[0];
			
			$event_id = $rowData[0]; // �̺�Ʈ ī�װ���
			$event_category_id = $rowData[1]; // �̺�Ʈ ī�װ� ������ȣ
			$bcategory_id = $rowData[3]; // �ü� ��з� ī�װ� ������ȣ
			$scategory_id = $rowData[4]; // �ü� �Һз� ī�װ� ������ȣ
			$wr_id = $rowData[5]; // �ü�����ü ������ȣ
			$event_title = $rowData[7]; // ���/�̺�Ʈ ����
			$event_content = $rowData[8]; // ���/�̺�Ʈ ����
			$event_place = $rowData[9]; // ������
			$event_start_date = $rowData[10]; // ���/�̺�Ʈ ������
			$event_end_date = $rowData[11]; // ���/�̺�Ʈ ������
			$event_sort = $rowData[12]; // ���/�̺�Ʈ ������
			
			$event_start_date = str_replace("'", "", $event_start_date);
			$event_end_date = str_replace("'", "", $event_end_date);
			
			$event_id = iconv("UTF-8", "EUC-KR", $event_id);
			$event_category_id = iconv("UTF-8", "EUC-KR", $event_category_id);
			$bcategory_id = iconv("UTF-8", "EUC-KR", $bcategory_id);
			$scategory_id = iconv("UTF-8", "EUC-KR", $scategory_id);
			$wr_id = iconv("UTF-8", "EUC-KR", $wr_id);
			$event_title = iconv("UTF-8", "EUC-KR", $event_title);
			$event_content = iconv("UTF-8", "EUC-KR", $event_content);
			$event_place = iconv("UTF-8", "EUC-KR", $event_place);
			$event_start_date = iconv("UTF-8", "EUC-KR", $event_start_date);
			$event_end_date = iconv("UTF-8", "EUC-KR", $event_end_date);
			
			if($event_id != "" && intval($event_id) > 0) {
				$totCnt++;
				$query = "
					UPDATE 
						comm_info_event 
					SET 
						category_id = '".$event_category_id."', 
						bcategory_id = '".$bcategory_id."', 
						scategory_id = '".$scategory_id."', 
						wr_id = '".$wr_id."', 
						event_title = '".$event_title."', 
						event_content = '".$event_content."', 
						event_place = '".$event_place."', 
						event_start_date = date_format('".$event_start_date."', '%Y-%m-%d'), 
						event_end_date = date_format('".$event_end_date."', '%Y-%m-%d'), 
						event_ip = '', 
						event_sort = '".$event_sort."', 
						modi_date = now() 
					WHERE 
						event_id = '".$event_id."'";
				
				mysql_query($query);
			} else {
				$notTotCnt++;
			}
		}

		if($totCnt > 0) {
?>
		<script>
		window.onload = function() {
			alert("���� �ϰ� ������Ʈ ó���� �Ϸ�Ǿ����ϴ�.\r\n - �� �Է� �Ǽ� : <?=$totalCnt?>��\r\n - ������Ʈ �Ϸ� : <?=$totCnt?>��\r\n - ������Ʈ �̿Ϸ� : <?=$notTotCnt?>��");
			location.href = "/admin/event/list.php?searchSelectCategory=<?=$searchSelectCategory?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
			return;
		}
		</script>
<?
			unlink($upload_file); // ���� ���� ���ε� �Ϸ� ��, ������ �뷮�� �ʰ����� �ʵ��� �ϱ� ���ؼ� ���ε� ó���� ���� ������ �ش� ��ο��� ���� ��ġ��
		} else {
?>
		<script>
		window.onload = function() {
			alert("���� �ϰ� ������Ʈ�� �����͸� �������� ��Ȯ�ϰ� �Է����ּ���.");
			location.href = "/admin/event/excel_upload_modify.php?searchSelectCategory=<?=$searchSelectCategory?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
			return;
		}
		</script>
<?
			unlink($upload_file); // ���� ���� ���ε� �Ϸ� ��, ������ �뷮�� �ʰ����� �ʵ��� �ϱ� ���ؼ� ���ε� ó���� ���� ������ �ش� ��ο��� ���� ��ġ��
		}
	} catch ( Exception $e ) {
		$errMsg = $e->getMessage();
?>
		<script>
		window.onload = function() {
			alert("���� ���ε� �Է� ó���� ������ �߻��Ͽ����ϴ�.\r\n(<?=$errMsg?>)");
			location.href = "/admin/event/excel_upload_modify.php?searchSelectCategory=<?=$searchSelectCategory?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
			return;
		}
		</script>
<?
	}
?>