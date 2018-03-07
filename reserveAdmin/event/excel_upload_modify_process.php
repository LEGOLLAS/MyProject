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
			
			$event_id = $rowData[0]; // 이벤트 카테고리명
			$event_category_id = $rowData[1]; // 이벤트 카테고리 고유번호
			$bcategory_id = $rowData[3]; // 시설 대분류 카테고리 고유번호
			$scategory_id = $rowData[4]; // 시설 소분류 카테고리 고유번호
			$wr_id = $rowData[5]; // 시설·단체 고유번호
			$event_title = $rowData[7]; // 행사/이벤트 제목
			$event_content = $rowData[8]; // 행사/이벤트 내용
			$event_place = $rowData[9]; // 행사장소
			$event_start_date = $rowData[10]; // 행사/이벤트 시작일
			$event_end_date = $rowData[11]; // 행사/이벤트 종료일
			$event_sort = $rowData[12]; // 행사/이벤트 종료일
			
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
			alert("엑셀 일괄 업데이트 처리가 완료되었습니다.\r\n - 총 입력 건수 : <?=$totalCnt?>건\r\n - 업데이트 완료 : <?=$totCnt?>건\r\n - 업데이트 미완료 : <?=$notTotCnt?>건");
			location.href = "/admin/event/list.php?searchSelectCategory=<?=$searchSelectCategory?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
			return;
		}
		</script>
<?
			unlink($upload_file); // 엑셀 파일 업로드 완료 후, 서버에 용량이 초과되지 않도록 하기 위해서 업로드 처리된 엑셀 파일을 해당 경로에서 삭제 조치함
		} else {
?>
		<script>
		window.onload = function() {
			alert("엑셀 일괄 업데이트시 데이터를 빠짐없이 정확하게 입력해주세요.");
			location.href = "/admin/event/excel_upload_modify.php?searchSelectCategory=<?=$searchSelectCategory?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
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
			alert("엑셀 업로드 입력 처리중 오류가 발생하였습니다.\r\n(<?=$errMsg?>)");
			location.href = "/admin/event/excel_upload_modify.php?searchSelectCategory=<?=$searchSelectCategory?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
			return;
		}
		</script>
<?
	}
?>