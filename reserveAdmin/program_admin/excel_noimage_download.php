<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/reserveAdmin/include/db_conn.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPExcel_1.8/Classes/PHPExcel.php';
	
	// PHPExcel 기능 처리
	$objPHPExcel = new PHPExcel();
	$sheet = $objPHPExcel->getActiveSheet();
	$sheet->getPageSetup()->setOrientation( PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT );
	$sheet->getPageSetup()->setFitToWidth(1);
	$sheet->getPageSetup()->setFitToHeight(0);
	$sheet->getDefaultStyle()->getAlignment()->setVertical( PHPExcel_Style_Alignment::VERTICAL_CENTER )->setHorizontal( PHPExcel_Style_Alignment::HORIZONTAL_CENTER );
	$sheet->getDefaultStyle()->getFont()->setSize( 10 )->setName( '맑은 고딕' );
	$sheet->getDefaultStyle()->getAlignment()->setWrapText( true );
	
	$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(19);
	
	$objPHPExcel->getActiveSheet() ->getColumnDimension('A')->setWidth(50);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('B')->setWidth(50);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('C')->setWidth(50);
	
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A4:C4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB("ecd8eb");
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:C1')->getFont()->setSize( 20 )->setName( '맑은 고딕' );
	$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);
	$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(20);
	$objPHPExcel->getActiveSheet()->getRowDimension(3)->setRowHeight(30);
	$objPHPExcel->getActiveSheet()->getRowDimension(4)->setRowHeight(30);

	$objPHPExcel->getActiveSheet()->freezePaneByColumnAndRow(0, 5);
	
	$objPHPExcel->setActiveSheetIndex(0)  //시작하는셀지정
			->mergeCells("A1:C1")->setCellValue("A1", "프로그램 카테고리 목록")
			->mergeCells("A2:C2")->setCellValue("A2", "출력 날짜 : " . date("Y년 m월 d일 H시 i분 s초"))
			->mergeCells("A3:C3")->setCellValue("A3", "※ 프로그램 카테고리 고유번호, 프로그램 카테고리명, 프로그램 카테고리 출력 순서는 모두 입력해주셔야 수정 처리가 됩니다.".chr(10)."(카테고리 고유번호와 순서는 숫자로만 입력해주세요.)")
			->setCellValue("A4", "카테고리 고유번호")
			->setCellValue("B4", "카테고리명")
			->setCellValue("C4", "순서");

	$searchSelectCategory = isset($_REQUEST['searchSelectCategory']) ? $_REQUEST['searchSelectCategory'] : '';
	$searchSelectCategory = !empty($_REQUEST['searchSelectCategory']) ? $_REQUEST['searchSelectCategory'] : '';
	$searchSelect = isset($_REQUEST['searchSelect']) ? $_REQUEST['searchSelect'] : '';
	$searchSelect = !empty($_REQUEST['searchSelect']) ? $_REQUEST['searchSelect'] : '';
	$searchKeyword = isset($_REQUEST['searchKeyword']) ? $_REQUEST['searchKeyword'] : '';
	$searchKeyword = !empty($_REQUEST['searchKeyword']) ? $_REQUEST['searchKeyword'] : '';
	
	$cnt = 5;
	
	$select_query = "SELECT * FROM program_category WHERE 1=1";
	
	if($searchSelect == "categoryName") {
		$select_query .= " AND category_name LIKE '%".$searchKeyword."%'";
	}

	if($searchSelect == "categorySort") {
		$select_query .= " AND category_sort = '".$searchKeyword."'";
	}

	if($searchSelect == "") {
		$select_query .= " AND (category_name LIKE '%".$searchKeyword."%' OR category_sort LIKE '%".$searchKeyword."%')";
	}

	$select_query .= " ORDER BY category_sort ASC";
	$select_result = mysqli_query($conn, $select_query);

	$cnt = 5;

	while($select_row = mysqli_fetch_array($select_result)) {
		$category_id = $select_row['category_id'];
		$category_name = $select_row['category_name'];
		$category_sort = $select_row['category_sort'];
		
		$objPHPExcel->getActiveSheet()->getRowDimension($cnt)->setRowHeight(30);
		
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue("A" . $cnt, $category_id)
			->setCellValue("B" . $cnt, $category_name)
			->setCellValue("C" . $cnt, $category_sort);
		
		$cnt++;
	}

	$sheet->getStyle( 'A1:C3' )->getAlignment()->setHorizontal( PHPExcel_Style_Alignment::HORIZONTAL_LEFT );
	$objPHPExcel->getActiveSheet()->setTitle("프로그램 카테고리 목록-" . date("YmdHis"));
	
	$sheet->getStyle( "A4:C" . ($cnt - 1) )->applyFromArray( array(
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN,
				'color' => array( 'rgb' => '000000' ) 
			)
		)
	) );
	
	$objPHPExcel->setActiveSheetIndex(0);
	$filename = iconv("UTF-8", "EUC-KR", "프로그램 카테고리 목록 - " . date("YmdHis"));
	
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename="'.$filename.'.xls"');
	header('Cache-Control: max-age=0');
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit;
?>