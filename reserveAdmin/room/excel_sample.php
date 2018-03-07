<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/reserveAdmin/include/db_connect.php';
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
	
	$objPHPExcel->getActiveSheet() ->getColumnDimension('A')->setWidth(30);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('B')->setWidth(30);
	
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A4:B4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB("ecd8eb");
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:B1')->getFont()->setSize( 20 )->setName( '맑은 고딕' );
	$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);
	$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(20);
	
	$objPHPExcel->setActiveSheetIndex(0)
			->mergeCells("A1:B1")->setCellValue("A1", "프로그램 카테고리 목록")
			->mergeCells("A2:B2")->setCellValue("A2", "출력 날짜 : " . date("Y년 m월 d일 H시 i분 s초"))
			->setCellValue("A4", "카테고리명")
			->setCellValue("B4", "순서");
	
	$cnt = 5;
	$cnt++;
	
	$sheet->getStyle( 'A2:B2' )->getAlignment()->setHorizontal( PHPExcel_Style_Alignment::HORIZONTAL_LEFT );
	
	$objPHPExcel->getActiveSheet()->setTitle("프로그램 카테고리 목록-" . date("YmdHis"));
	
	$sheet->getStyle( "A4:B" . $cnt )->applyFromArray( array(
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN,
				'color' => array( 'rgb' => '000000' ) 
			)
		)
	) );
	
	$objPHPExcel->setActiveSheetIndex(0);
	
	$filename = iconv("UTF-8", "EUC-KR", "프로그램 카테고리(엑셀 샘플파일)-" . date("YmdHis"));
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
	header('Cache-Control: max-age=0');
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit;
?>