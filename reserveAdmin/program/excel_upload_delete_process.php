<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/reserveAdmin/include/db_conn.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPExcel_1.8/Classes/PHPExcel.php';
	
	$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/reserveAdmin/excel_uploads/';
	$upload_file = $upload_dir . basename($_FILES['KANZI_DELETE_EXCEL_FILE']['name']);
	
	$searchSelect = isset($_REQUEST['searchSelect']) ? $_REQUEST['searchSelect'] : '';
	$searchSelect = !empty($_REQUEST['searchSelect']) ? $_REQUEST['searchSelect'] : '';
	$searchKeyword = isset($_REQUEST['searchKeyword']) ? $_REQUEST['searchKeyword'] : '';
	$searchKeyword = !empty($_REQUEST['searchKeyword']) ? $_REQUEST['searchKeyword'] : '';
	$sel_si_gb = isset($_REQUEST['sel_si_gb']) ? $_REQUEST['sel_si_gb'] : '';
	$sel_si_gb = !empty($_REQUEST['sel_si_gb']) ? $_REQUEST['sel_si_gb'] : '';
	$bcate_id = isset($_REQUEST['bcate_id']) ? $_REQUEST['bcate_id'] : '';
	$bcate_id = !empty($_REQUEST['bcate_id']) ? $_REQUEST['bcate_id'] : '';
	$scate_id = isset($_REQUEST['scate_id']) ? $_REQUEST['scate_id'] : '';
	$scate_id = !empty($_REQUEST['scate_id']) ? $_REQUEST['scate_id'] : '';
	$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
	$page = !empty($_REQUEST['page']) ? $_REQUEST['page'] : '';
	
	try {
		move_uploaded_file($_FILES['KANZI_DELETE_EXCEL_FILE']['tmp_name'], $upload_file);
		
		$inputFileType = PHPExcel_IOFactory::identify( $upload_file );
		$objReader     = PHPExcel_IOFactory::createReader( $inputFileType );
		
		$objPHPExcel = $objReader->load( $upload_file );
		
		/**
		 * @var $sheet PHPExcel_Worksheet
		 */
		$sheet = $objPHPExcel->getSheet( 0 );
		
		$highestRow    = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();

		$totCnt = 0;
		
		for ( $row = 6; $row <= $highestRow; $row ++ ) {
			$rowData = $sheet->rangeToArray( 'A' . $row . ':' . $highestColumn . $row, null, true, false );
			$rowData = $rowData[0];
			
			$wr_id = $rowData[0];
			
			if(($wr_id != "") && (intval($wr_id) > 0)) {
				$totCnt++;
				
				$query = "
					DELETE 
					FROM
						comm_info 
					WHERE 
						wr_id = '".$wr_id."'
				";
				
				mysqli_query($conn, $query);
			}
		}

		if($totCnt > 0) {
?>
		<script>
		window.onload = function() {
			alert("엑셀 일괄삭제 처리가 완료되었습니다.");
			location.href = "list.php?bcate_id=<?=$bcate_id?>&scate_id=<?=$scate_id?>&sel_si_gb=<?=$sel_si_gb?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
			return;
		}
		</script>
<?
			unlink($upload_file); // 엑셀 파일 업로드 완료 후, 서버에 용량이 초과되지 않도록 하기 위해서 업로드 처리된 엑셀 파일을 해당 경로에서 삭제 조치함
		}
	} catch ( Exception $e ) {
		$errMsg = $e->getMessage();
?>
		<script>
		window.onload = function() {
			alert("엑셀 일괄삭제 처리중 오류가 발생하였습니다.\r\n(<?=$errMsg?>)");
			location.href = "excel_upload_delete.php?bcate_id=<?=$bcate_id?>&scate_id=<?=$scate_id?>&sel_si_gb=<?=$sel_si_gb?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
			return;
		}
		</script>
<?
	}
?>