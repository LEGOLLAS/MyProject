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
	
	$objPHPExcel->getActiveSheet() ->getColumnDimension('A')->setWidth(18);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('B')->setWidth(18);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('C')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('D')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('E')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('F')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('G')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('H')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('I')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('J')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('K')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('L')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('M')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('N')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('O')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('P')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('Q')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('R')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('S')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('T')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('U')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('V')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('W')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('X')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('Y')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('Z')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('AA')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('AB')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('AC')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('AD')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('AE')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('AF')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('AG')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('AH')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('AI')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('AJ')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('AK')->setWidth(15);
	
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A4:AK5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB("ecd8eb");
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:AK1')->getFont()->setSize( 20 )->setName( '맑은 고딕' );
	$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);
	$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(20);
	$objPHPExcel->getActiveSheet()->getRowDimension(3)->setRowHeight(40);
	
	$objPHPExcel->setActiveSheetIndex(0)  //시작하는셀지정
			->mergeCells("A1:AJ1")->setCellValue("A1", "사회복지편람 정보 목록")
			->mergeCells("A2:AJ2")->setCellValue("A2", "출력 날짜 : " . date("Y년 m월 d일 H시 i분 s초"))
			->mergeCells("A3:AJ3")->setCellValue("A3", "※ 대분류 카테고리명, 소분류 카테고리명을 입력시".chr(10)."대분류 카테고리 관리에 등록되어 있는 대분류 카테고리명, 소분류 카테고리 관리에 등록되어 있는 소분류 카테고리명은 정확하게 입력해주셔야 합니다.")
			->mergeCells("A4:A5")->setCellValue("A4", "대분류 카테고리명")
			->mergeCells("B4:B5")->setCellValue("B4", "소분류 카테고리명")
			->mergeCells("C4:C5")->setCellValue("C4", "시설명")
			->mergeCells("D4:D5")->setCellValue("D4", "위도")
			->mergeCells("E4:E5")->setCellValue("E4", "경도")
			->mergeCells("F4:F5")->setCellValue("F4", "설립일")
			->mergeCells("G4:G5")->setCellValue("G4", "운영주체")
			->mergeCells("H4:H5")->setCellValue("H4", "대표자성함")
			->mergeCells("I4:I5")->setCellValue("I4", "주소")
			->mergeCells("J4:J5")->setCellValue("J4", "전화")
			->mergeCells("K4:K5")->setCellValue("K4", "팩스")
			->mergeCells("L4:L5")->setCellValue("L4", "e-mail")
			->mergeCells("M4:M5")->setCellValue("M4", "홈페이지")
			->mergeCells("N4:N5")->setCellValue("N4", "직원현황")
			->mergeCells("O4:O5")->setCellValue("O4", "사업대상")
			->mergeCells("P4:P5")->setCellValue("P4", "이용인원")
			->mergeCells("Q4:Q5")->setCellValue("Q4", "이용자격 및 절차")
			->mergeCells("R4:R5")->setCellValue("R4", "제공서비스(프로그램)")
			->mergeCells("S4:V4")->setCellValue("S4", "사회복지편람 실습여부")
			->setCellValue("S5", "방학중")
			->setCellValue("T5", "학기중")
			->setCellValue("U5", "수시")
			->setCellValue("V5", "기타")
			->mergeCells("W4:W5")->setCellValue("W4", "후원계좌(정기후원, 비정기후원)")
			->mergeCells("X4:X5")->setCellValue("X4", "후원물품")
			
			->mergeCells("Y4:AE4")->setCellValue("Y4", "봉사활동 모집")
			->setCellValue("Y5", "재능나눔")
			->setCellValue("Z5", "전문봉사")
			->setCellValue("AA5", "문화.예술")
			->setCellValue("AB5", "보건.의료")
			->setCellValue("AC5", "업무보조")
			->setCellValue("AD5", "노력봉사")
			->setCellValue("AE5", "기타")
			->mergeCells("AF4:AI4")->setCellValue("AF4", "실적인증시스템")->setCellValue("AF5", "VMS")->setCellValue("AG5", "1365")->setCellValue("AH5", "Dovol")->setCellValue("AI5", "기타")
			->mergeCells("AJ4:AK4")->setCellValue("AJ4", "관리자 승인여부")->setCellValue("AJ5", "승인")->setCellValue("AK5", "미승인")
			
			
			->setCellValue("Y6", "O")
			->setCellValue("Z6", "O")
			->setCellValue("AA6", "O")
			->setCellValue("AB6", "O")
			->setCellValue("AC6", "O")
			->setCellValue("AD6", "O")
			->setCellValue("AE6", "O")
			->setCellValue("AF6", "O")
			->setCellValue("AG6", "O")
			->setCellValue("AH6", "O")
			->setCellValue("AI6", "O")
			->setCellValue("AK6", "O");
	
	$cnt = 5;
	
	$cnt++;

	$sheet->getStyle( 'A1:AK3' )->getAlignment()->setHorizontal( PHPExcel_Style_Alignment::HORIZONTAL_LEFT );
	
	$objPHPExcel->getActiveSheet()->setTitle("사회복지편람 정보 목록-" . date("YmdHis"));
	
	$sheet->getStyle( "A4:AK" . $cnt )->applyFromArray( array(
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN,
				'color' => array( 'rgb' => '000000' ) 
			)
		)
	) );
	
	$objPHPExcel->setActiveSheetIndex(0);
	
	$filename = iconv("UTF-8", "EUC-KR", "사회복지편람 정보 목록(엑셀 샘플파일)-" . date("YmdHis"));
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
	header('Cache-Control: max-age=0');
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit;
?>