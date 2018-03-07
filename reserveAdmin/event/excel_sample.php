<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/include/db_connect.php';
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
	$objPHPExcel->getActiveSheet() ->getColumnDimension('C')->setWidth(30);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('D')->setWidth(30);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('E')->setWidth(30);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('F')->setWidth(30);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('G')->setWidth(30);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('H')->setWidth(30);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('I')->setWidth(30);
	
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A4:I4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB("ecd8eb");
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:I1')->getFont()->setSize( 20 )->setName( '맑은 고딕' );
	$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);
	$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(20);
	
	$objPHPExcel->setActiveSheetIndex(0)
			->mergeCells("A1:I1")->setCellValue("A1", "행사/이벤트 목록")
			->mergeCells("A2:I2")->setCellValue("A2", "출력 날짜 : " . date("Y년 m월 d일 H시 i분 s초"))
			->mergeCells("A3:I3")->setCellValue("A3", "※ 이벤트 카테고리명, 시설 대분류 카테고리명, 시설 소분류 카테고리명, 시설·단체명은 정확하게 입력해주셔야 합니다.")
			->setCellValue("A4", "이벤트 카테고리명")
			->setCellValue("B4", "시설 대분류 카테고리명")
			->setCellValue("C4", "시설 소분류 카테고리명")
			->setCellValue("D4", "시설·단체명")
			->setCellValue("E4", "제목")
			->setCellValue("F4", "행사 시작일")
			->setCellValue("G4", "행사 종료일")
			->setCellValue("H4", "내용")
			->setCellValue("I4", "순서");
	
	$cnt = 5;
	$cnt++;
	
	$sheet->getStyle( 'A2:I3' )->getAlignment()->setHorizontal( PHPExcel_Style_Alignment::HORIZONTAL_LEFT );
	
	$objPHPExcel->getActiveSheet()->setTitle("행사,이벤트 목록-" . date("YmdHis"));
	
	$sheet->getStyle( "A4:I" . ($cnt - 1) )->applyFromArray( array(
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN,
				'color' => array( 'rgb' => '000000' ) 
			)
		)
	) );
	
	$objPHPExcel->setActiveSheetIndex(0);
	
	$filename = iconv("UTF-8", "EUC-KR", "행사,이벤트(엑셀 샘플파일)-" . date("YmdHis"));
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
	header('Cache-Control: max-age=0');
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit;
?>