<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/include/db_connect.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPExcel_1.8/Classes/PHPExcel.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPExcel_1.8/Classes/PHPExcel/IOFactory.php';
	
	// 엑셀 다운로드 후, 에러 발생시 에러 로그 메시지를 출력하여 확인할 수 있도록 아래와 같이 셋팅 처리함 - 2017.11.29(수) (주)네오인터넷 함민석 대리
	//error_reporting(E_ALL);
	error_reporting(E_ALL ^E_NOTICE ^E_WARNING);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	ini_set('memory_limit', '-1');
	ini_set("max_executation_time", "0");

	// PHPExcel 기능 처리
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->setActiveSheetIndex(0);

	$sheet = $objPHPExcel->getActiveSheet();
	$sheet->getPageSetup()->setOrientation( PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT );
	$sheet->getPageSetup()->setFitToWidth(1);
	$sheet->getPageSetup()->setFitToHeight(0);
	$sheet->getDefaultStyle()->getAlignment()->setVertical( PHPExcel_Style_Alignment::VERTICAL_CENTER )->setHorizontal( PHPExcel_Style_Alignment::HORIZONTAL_CENTER );
	$sheet->getDefaultStyle()->getFont()->setSize( 10 )->setName( '맑은 고딕' );
	$sheet->getDefaultStyle()->getAlignment()->setWrapText( true );
	
	$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(19);
	
	$objPHPExcel->getActiveSheet() ->getColumnDimension('A')->setWidth(25);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('B')->setWidth(25);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('C')->setWidth(25);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('D')->setWidth(25);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('E')->setWidth(25);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('F')->setWidth(25);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('G')->setWidth(25);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('H')->setWidth(25);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('I')->setWidth(25);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('J')->setWidth(25);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('K')->setWidth(25);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('L')->setWidth(25);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('M')->setWidth(25);
	
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A4:M5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB("ecd8eb");
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:M1')->getFont()->setSize( 20 )->setName( '맑은 고딕' );
	$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);
	$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(20);
	$objPHPExcel->getActiveSheet()->getRowDimension(3)->setRowHeight(40);

	$objPHPExcel->getActiveSheet()->freezePaneByColumnAndRow(0, 6);
	
	$objPHPExcel->setActiveSheetIndex(0)  //시작하는셀지정
			->mergeCells("A1:AJ1")->setCellValue("A1", "행사/이벤트 목록")
			->mergeCells("A2:AJ2")->setCellValue("A2", "출력 날짜 : " . date("Y년 m월 d일 H시 i분 s초"))
			->mergeCells("A4:A5")->setCellValue("A4", "고유번호")
			->mergeCells("B4:B5")->setCellValue("B4", "카테고리".chr(10)."고유번호")
			->mergeCells("C4:C5")->setCellValue("C4", "카테고리명")
			->mergeCells("D4:D5")->setCellValue("D4", "시설 대분류" . chr(10) . "카테고리".chr(10)."고유번호")
			->mergeCells("E4:E5")->setCellValue("E4", "시설 소분류" . chr(10) . "카테고리".chr(10)."고유번호")
			->mergeCells("F4:F5")->setCellValue("F4", "시설·단체" . chr(10) . "고유번호")
			->mergeCells("G4:G5")->setCellValue("G4", "시설·단체명")
			->mergeCells("H4:H5")->setCellValue("H4", "행사제목")
			->mergeCells("I4:I5")->setCellValue("I4", "행사내용")
			->mergeCells("J4:J5")->setCellValue("J4", "행사장소")
			->mergeCells("K4:K5")->setCellValue("K4", "행사 시작일")
			->mergeCells("L4:L5")->setCellValue("L4", "행사 종료일")
			->mergeCells("M4:M5")->setCellValue("M4", "순서");
		
	// 에러 검증결과 엑셀출력시 -> 해당 REQUEST 변수들마다 Notice: Undefined variable: 에러 메시지가 출력되어 넘어오는 변수들을 아래와 같이 isset, !empty로 먼저 조건 처리함 - 2017.11.29(수) (주)네오인터넷 함민석 대리
	$searchSelectCategory = isset($_REQUEST['searchSelectCategory']) ? $_REQUEST['searchSelectCategory'] : '';
	$searchSelectCategory = !empty($_REQUEST['searchSelectCategory']) ? $_REQUEST['searchSelectCategory'] : '';
	$searchSelect = isset($_REQUEST['searchSelect']) ? $_REQUEST['searchSelect'] : '';
	$searchSelect = !empty($_REQUEST['searchSelect']) ? $_REQUEST['searchSelect'] : '';
	$searchKeyword = isset($_REQUEST['searchKeyword']) ? $_REQUEST['searchKeyword'] : '';
	$searchKeyword = !empty($_REQUEST['searchKeyword']) ? $_REQUEST['searchKeyword'] : '';
	$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
	$page = !empty($_REQUEST['page']) ? $_REQUEST['page'] : '';
		
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
	$select_result = mysql_query($select_query);

	$cnt = 6;

	while($select_row = mysql_fetch_array($select_result)) {
		$event_id = $select_row['event_id'];
		$event_title = $select_row['event_title'];
		$event_content = $select_row['event_content'];
		$event_place = $select_row['event_place'];
		$event_start_date = $select_row['event_start_date'];
		$event_end_date = $select_row['event_end_date'];
		$event_sort = $select_row['event_sort'];
		
		$req_category_id = $select_row['category_id'];
		$req_bcategory_id = $select_row['bcategory_id'];
		$req_scategory_id = $select_row['scategory_id'];

		$wr_id = $select_row['wr_id'];
		
		// 이벤트 카테고리 정보
		$req_select_category_query = "SELECT category_name FROM comm_info_event_category WHERE category_id = '".$req_category_id."'";
		$req_select_category_result = mysql_query($req_select_category_query);
		$req_select_category_row = mysql_fetch_assoc($req_select_category_result);
		
		// 시설 대분류 카테고리 정보
		$req_select_bcategory_query = "SELECT bcategory_name FROM comm_info_bcategory WHERE bcategory_id = '".$req_bcategory_id."'";
		$req_select_bcategory_result = mysql_query($req_select_bcategory_query);
		$req_select_bcategory_row = mysql_fetch_assoc($req_select_bcategory_result);

		// 시설 소분류 카테고리 정보
		$req_select_scategory_query = "SELECT scategory_name FROM comm_info_scategory WHERE scategory_id = '".$req_scategory_id."'";
		$req_select_scategory_result = mysql_query($req_select_scategory_query);
		$req_select_scategory_row = mysql_fetch_assoc($req_select_scategory_result);

		$req_select_comm_info_query = "SELECT wr_subject FROM comm_info WHERE wr_id = '".$wr_id."'";
		$req_select_comm_info_result = mysql_query($req_select_comm_info_query);
		$req_select_comm_info_row = mysql_fetch_assoc($req_select_comm_info_result);
		
		$objPHPExcel->getActiveSheet()->getRowDimension($cnt)->setRowHeight(60);

		$wr_subject_result = "";
		
		$wr_subject_result = "[" . $req_select_bcategory_row['bcategory_name'] . "";
		if($req_select_scategory_row['scategory_name'] != "") {
			$wr_subject_result .= "-" . $req_select_scategory_row['scategory_name'];
		}

		$wr_subject_result .= "]";
		$wr_subject_result .= " " . $req_select_comm_info_row['wr_subject'];
		
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue("A" . $cnt, iconv("EUC-KR", "UTF-8", $event_id))
			->setCellValue("B" . $cnt, iconv("EUC-KR", "UTF-8", $req_category_id))
			->setCellValue("C" . $cnt, iconv("EUC-KR", "UTF-8", $req_select_category_row['category_name']))
			->setCellValue("D" . $cnt, iconv("EUC-KR", "UTF-8", $req_bcategory_id))
			->setCellValue("E" . $cnt, iconv("EUC-KR", "UTF-8", $req_scategory_id))
			->setCellValue("F" . $cnt, iconv("EUC-KR", "UTF-8", $wr_id))
			->setCellValue("G" . $cnt, iconv("EUC-KR", "UTF-8", $wr_subject_result))
			->setCellValue("H" . $cnt, iconv("EUC-KR", "UTF-8", $event_title))
			->setCellValue("I" . $cnt, iconv("EUC-KR", "UTF-8", $event_content))
			->setCellValue("J" . $cnt, iconv("EUC-KR", "UTF-8", $event_place))
			->setCellValue("K" . $cnt, iconv("EUC-KR", "UTF-8", "'".$event_start_date))
			->setCellValue("L" . $cnt, iconv("EUC-KR", "UTF-8", "'".$event_end_date))
			->setCellValue("M" . $cnt, iconv("EUC-KR", "UTF-8", $event_sort));
		
		$cnt++;
	}
	
	$sheet->getStyle( 'A1:M3' )->getAlignment()->setHorizontal( PHPExcel_Style_Alignment::HORIZONTAL_LEFT );
	$objPHPExcel->getActiveSheet()->setTitle("행사 이벤트 목록 - " . date("YmdHis"));
	
	$sheet->getStyle( "A4:M" . ($cnt - 1) )->applyFromArray( array(
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN,
				'color' => array( 'rgb' => '000000' ) 
			)
		)
	) );
	
	$objPHPExcel->setActiveSheetIndex(0);
	$filename = iconv("UTF-8", "EUC-KR", "행사 이벤트 목록 - " . date("YmdHis"));
	
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename="'.$filename.'.xls"');
	header('Cache-Control: max-age=0');
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit;
?>