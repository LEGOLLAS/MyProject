<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/reserveAdmin/include/db_connect.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPExcel_1.8/Classes/PHPExcel.php';
	
	$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/reserveAdmin/excel_uploads/';
	$upload_file = $upload_dir . basename($_FILES['PROGRAM_CATEGORY_DELETE_EXCEL_FILE']['name']);

	$searchSelect = isset($_REQUEST['searchSelect']) ? $_REQUEST['searchSelect'] : '';
	$searchSelect = !empty($_REQUEST['searchSelect']) ? $_REQUEST['searchSelect'] : '';
	$searchKeyword = isset($_REQUEST['searchKeyword']) ? $_REQUEST['searchKeyword'] : '';
	$searchKeyword = !empty($_REQUEST['searchKeyword']) ? $_REQUEST['searchKeyword'] : '';
	$searchSelectCategory = isset($_REQUEST['searchSelectCategory']) ? $_REQUEST['searchSelectCategory'] : '';
	$searchSelectCategory = !empty($_REQUEST['searchSelectCategory']) ? $_REQUEST['searchSelectCategory'] : '';
	$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
	$page = !empty($_REQUEST['page']) ? $_REQUEST['page'] : '';
	
	try {
		move_uploaded_file($_FILES['PROGRAM_CATEGORY_DELETE_EXCEL_FILE']['tmp_name'], $upload_file);
		
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
		
		for ( $row = 5; $row <= $highestRow; $row ++ ) {
			$totalCnt++;
			$rowData = $sheet->rangeToArray( 'A' . $row . ':' . $highestColumn . $row, null, true, false );
			$rowData = $rowData[0];
			
			$category_id = $rowData[0]; // 카테고리 아이디
			
			if(($category_id != "") && (intval($category_id) > 0)) {
				$totCnt++;
				
				$query = "
					DELETE 
					FROM
						program_category 
					WHERE 
						category_id = '".$category_id."'
				";

				mysqli_query($conn, $query);
			} else {
				$notTotCnt++;
			}
		}

		if($totCnt > 0) {
?>
		<script>
		window.onload = function() {
			alert("엑셀 일괄삭제 처리가 완료되었습니다.\r\n - 총 입력 건수 : <?=$totalCnt?>건\r\n - 삭제 완료 : <?=$totCnt?>건\r\n - 삭제 미완료 : <?=$notTotCnt?>건");
			location.href = "list.php?searchSelectCategory=<?=$searchSelectCategory?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
			return;
		}
		</script>
<?
			unlink($upload_file); // 엑셀 파일 업로드 완료 후, 서버에 용량이 초과되지 않도록 하기 위해서 업로드 처리된 엑셀 파일을 해당 경로에서 삭제 조치함
		}  else {
?>
		<script type="text/javascript">
		window.onload = function() {
			alert("엑셀 일괄삭제시 데이터를 빠짐없이 정확하게 입력해주세요.");
			location.href = "excel_upload_delete.php?searchSelectCategory=<?=$searchSelectCategory?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
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
			location.href = "excel_upload_delete.php?searchSelectCategory=<?=$searchSelectCategory?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
			return;
		}
		</script>
<?
	}
?>