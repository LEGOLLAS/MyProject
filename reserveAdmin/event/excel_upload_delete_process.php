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
			
			$event_id = $rowData[0]; // ���/�̺�Ʈ ������ȣ
			$event_id = iconv("UTF-8", "EUC-KR", $event_id);
			
			if($event_id != "" && intval($event_id) > 0) {
				$totCnt++;
				$query = "
					DELETE 
					FROM 
						comm_info_event 
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
			alert("���� �ϰ����� ó���� �Ϸ�Ǿ����ϴ�.\r\n - �� �Է� �Ǽ� : <?=$totalCnt?>��\r\n - ���� �Ϸ� : <?=$totCnt?>��\r\n - ���� �̿Ϸ� : <?=$notTotCnt?>��");
			location.href = "/admin/event/list.php?searchSelectCategory=<?=$searchSelectCategory?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
			return;
		}
		</script>
<?
			unlink($upload_file); // ���� ���� ���ε� �Ϸ� ��, ������ �뷮�� �ʰ����� �ʵ��� �ϱ� ���ؼ� ���ε� ó���� ���� ������ �ش� ��ο��� ���� ��ġ��
		} else {
?>
		<script type="text/javascript">
		window.onload = function() {
			alert("���� �ϰ������� �����͸� �������� ��Ȯ�ϰ� �Է����ּ���.");
			location.href = "/admin/event/excel_upload_delete.php?searchSelectCategory=<?=$searchSelectCategory?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
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
			alert("���� �ϰ����� ó���� ������ �߻��Ͽ����ϴ�.\r\n(<?=$errMsg?>)");
			location.href = "/admin/event/excel_upload_delete.php?searchSelectCategory=<?=$searchSelectCategory?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
			return;
		}
		</script>
<?
	}
?>