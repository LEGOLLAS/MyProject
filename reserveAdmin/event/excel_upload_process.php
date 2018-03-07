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
			
			$category_name = $rowData[0]; // 이벤트 카테고리명
			$bcategory_name = $rowData[1]; // 시설 대분류 카테고리명
			$scategory_name = $rowData[2]; // 시설 소분류 카테고리명
			$wr_subject = $rowData[3]; // 시설·단체명
			$event_title = $rowData[4]; // 행사 제목
			$event_start_date = $rowData[5]; // 행사 시작일
			$event_end_date = $rowData[6]; // 행사 종료일
			$event_content = $rowData[7]; // 행사 내용
			$event_sort = $rowData[8]; // 행사 내용
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
			alert("엑셀 업로드 입력 처리가 완료되었습니다.");
			location.href = "/admin/event/list.php?searchSelectCategory=<?=$searchSelectCategory?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
			return;
		}
		</script>
<?
		unlink($upload_file); // 엑셀 파일 업로드 완료 후, 서버에 용량이 초과되지 않도록 하기 위해서 업로드 처리된 엑셀 파일을 해당 경로에서 삭제 조치함
	} catch ( Exception $e ) {
		$errMsg = $e->getMessage();
?>
		<script>
		window.onload = function() {
			alert("엑셀 업로드 입력 처리중 오류가 발생하였습니다.\r\n(<?=$errMsg?>)");
			location.href = "/admin/event/excel_upload.php?searchSelectCategory=<?=$searchSelectCategory?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
			return;
		}
		</script>
<?
	}
?>