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
	
	$objPHPExcel->getActiveSheet() ->getColumnDimension('A')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('B')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('C')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('D')->setWidth(35);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('E')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('F')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('G')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('H')->setWidth(25);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('I')->setWidth(25);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('J')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('K')->setWidth(55);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('L')->setWidth(25);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('M')->setWidth(25);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('N')->setWidth(25);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('O')->setWidth(25);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('P')->setWidth(25);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('Q')->setWidth(25);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('R')->setWidth(25);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('S')->setWidth(25);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('T')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('U')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('V')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('W')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('X')->setWidth(25);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('Y')->setWidth(25);
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
	$objPHPExcel->getActiveSheet() ->getColumnDimension('AL')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('AM')->setWidth(15);
	$objPHPExcel->getActiveSheet() ->getColumnDimension('AN')->setWidth(15);
	
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A4:AN5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB("ecd8eb");
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:AN1')->getFont()->setSize( 20 )->setName( '맑은 고딕' );
	$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);
	$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(20);
	$objPHPExcel->getActiveSheet()->getRowDimension(3)->setRowHeight(40);

	$objPHPExcel->getActiveSheet()->freezePaneByColumnAndRow(0, 6);
	
	$objPHPExcel->setActiveSheetIndex(0)  //시작하는셀지정
			->mergeCells("A1:AJ1")->setCellValue("A1", "사회복지편람 정보 목록")
			->mergeCells("A2:AJ2")->setCellValue("A2", "출력 날짜 : " . date("Y년 m월 d일 H시 i분 s초"))
			->mergeCells("A4:A5")->setCellValue("A4", "고유번호")
			->mergeCells("B4:B5")->setCellValue("B4", "대분류 카테고리".chr(10)."아이디")
			->mergeCells("C4:C5")->setCellValue("C4", "소분류 카테고리".chr(10)."아이디")
			->mergeCells("D4:D5")->setCellValue("D4", "시설명")
			->mergeCells("E4:E5")->setCellValue("E4", "위도")
			->mergeCells("F4:F5")->setCellValue("F4", "경도")
			->mergeCells("G4:G5")->setCellValue("G4", "설립일")
			->mergeCells("H4:H5")->setCellValue("H4", "운영주체")
			->mergeCells("I4:I5")->setCellValue("I4", "대표자성함")
			->mergeCells("J4:J5")->setCellValue("J4", "우편번호")
			->mergeCells("K4:K5")->setCellValue("K4", "주소")
			
			->mergeCells("L4:L5")->setCellValue("L4", "전화")
			->mergeCells("M4:M5")->setCellValue("M4", "팩스")
			->mergeCells("N4:N5")->setCellValue("N4", "e-mail")
			->mergeCells("O4:O5")->setCellValue("O4", "홈페이지")
			->mergeCells("P4:P5")->setCellValue("P4", "직원현황")
			->mergeCells("Q4:Q5")->setCellValue("Q4", "사업대상")
			->mergeCells("R4:R5")->setCellValue("R4", "이용인원")
			->mergeCells("S4:S5")->setCellValue("S4", "이용자격 및 절차")
			->mergeCells("T4:T5")->setCellValue("T4", "제공서비스(프로그램)")
			->mergeCells("U4:X4")->setCellValue("U4", "사회복지편람 실습여부")
			->setCellValue("U5", "방학중")
			->setCellValue("V5", "학기중")
			->setCellValue("W5", "수시")
			->setCellValue("X5", "기타")
			->mergeCells("Y4:Y5")->setCellValue("Y4", "후원계좌".chr(10)."(정기후원, 비정기후원)")
			->mergeCells("Z4:Z5")->setCellValue("Z4", "후원물품")
			->mergeCells("AA4:AG4")->setCellValue("AA4", "봉사활동 모집")
			->setCellValue("AA5", "재능나눔")
			->setCellValue("AB5", "전문봉사")
			->setCellValue("AC5", "문화.예술")
			->setCellValue("AD5", "보건.의료")
			->setCellValue("AE5", "업무보조")
			->setCellValue("AF5", "노력봉사")
			->setCellValue("AG5", "기타")
			->mergeCells("AH4:AK4")->setCellValue("AH4", "실적인증시스템")->setCellValue("AH5", "VMS")->setCellValue("AI5", "1365")->setCellValue("AJ5", "Dovol")->setCellValue("AK5", "기타")
			->mergeCells("AL4:AM4")->setCellValue("AL4", "관리자 승인여부")->setCellValue("AL5", "승인")->setCellValue("AM5", "미승인")
			->mergeCells("AN4:AN5")->setCellValue("AN4", "시 구분");
		
	// 에러 검증결과 엑셀출력시 -> 해당 REQUEST 변수들마다 Notice: Undefined variable: 에러 메시지가 출력되어 넘어오는 변수들을 아래와 같이 isset, !empty로 먼저 조건 처리함 - 2017.11.29(수) (주)네오인터넷 함민석 대리
	$searchKeyword = isset($_REQUEST['searchKeyword']) ? $_REQUEST['searchKeyword'] : '';
	$searchKeyword = !empty($_REQUEST['searchKeyword']) ? $_REQUEST['searchKeyword'] : '';
	$searchSelect = isset($_REQUEST['searchSelect']) ? $_REQUEST['searchSelect'] : '';
	$searchSelect = !empty($_REQUEST['searchSelect']) ? $_REQUEST['searchSelect'] : '';
	$bcate_id = isset($_REQUEST['bcate_id']) ? $_REQUEST['bcate_id'] : '';
	$bcate_id = !empty($_REQUEST['bcate_id']) ? $_REQUEST['bcate_id'] : '';
	$scate_id = isset($_REQUEST['scate_id']) ? $_REQUEST['scate_id'] : '';
	$scate_id = !empty($_REQUEST['scate_id']) ? $_REQUEST['scate_id'] : '';
	
	$sql_sel = " SELECT * FROM comm_info WHERE 1=1 ";
	
	if($bcate_id != "") {
		$sql_sel .= " AND bcategory_id = '".$bcate_id."'";
	}

	if($scate_id != "") {
		$sql_sel .= " AND scategory_id = '".$scate_id."'";
	}
	
	if($searchSelect == "wrSubject") {
		$sql_sel .= " AND wr_subject LIKE '%".$searchKeyword."%'";
	} else {
		$sql_sel .= " AND wr_subject LIKE '%".$searchKeyword."%'";
	}
	
	$sql_sel .= " order by wr_subject asc ";
	$select_result = mysql_query($sql_sel);

	$cnt = 6;

	while($select_row = mysql_fetch_array($select_result)) {
		$bcategory_id = $select_row['bcategory_id'];
		$scategory_id = $select_row['scategory_id'];
		$wr_id = $select_row['wr_id'];
		$wr_subject = $select_row['wr_subject']; // 시설명
		$lat_val = $select_row['lat_val']; // 위도
		$lon_val = $select_row['lon_val']; // 경도
		$wr_2 = $select_row['wr_2']; // 설립일
		$wr_3 = $select_row['wr_3']; // 운영주체
		$wr_16 = $select_row['wr_16']; // 대표자성함
		
		$wr_26 = $select_row['wr_26']; // 주소(우편번호)
		$wr_22 = $select_row['wr_22']; // 주소(상세 주소를 입력해야 함)
		$wr_6 = $select_row['wr_6']; // 전화
		$wr_8 = $select_row['wr_8']; // 팩스
		$wr_7 = $select_row['wr_7']; // e-mail
		$wr_4 = $select_row['wr_4']; // 홈페이지
		$wr_9 = $select_row['wr_9']; // 직원현황
		$wr_19 = $select_row['wr_19']; // 사업대상
		$wr_20 = $select_row['wr_20']; // 이용인원
		$wr_28 = $select_row['wr_28']; // 이용자격 및 절차
		$wr_21 = $select_row['wr_21']; // 제공서비스(프로그램)
		
		$wr_29 = $select_row['wr_29']; // 사회복지 현장 -> 방학중
		$wr_30 = $select_row['wr_30']; // 사회복지 현장 -> 학기중
		$wr_31 = $select_row['wr_31']; // 사회복지 현장 -> 수시
		$wr_32 = $select_row['wr_32']; // 사회복지 현장 -> 기타

		if(($wr_29 != "")) { $wr_29 = "O"; } else { $wr_29 = ""; }
		if(($wr_30 != "")) { $wr_30 = "O"; } else { $wr_30 = ""; }
		if(($wr_31 != "")) { $wr_31 = "O"; } else { $wr_31 = ""; }
		if(($wr_32 != "")) { $wr_32 = "O"; } else { $wr_32 = ""; }
		
		$wr_44 = $select_row['wr_44']; // 후원계좌(정기후원, 비정기후원)
		$wr_24 = $select_row['wr_24']; // 후원물품
		
		$wr_33 = $select_row['wr_33']; // 봉사활동 모집 -> 후원계좌 -> 재능나눔
		$wr_34 = $select_row['wr_34']; // 봉사활동 모집 -> 후원계좌 -> 전문봉사
		$wr_35 = $select_row['wr_35']; // 봉사활동 모집 -> 후원계좌 -> 문화.예술
		$wr_36 = $select_row['wr_36']; // 봉사활동 모집 -> 후원계좌 -> 보건.의료
		$wr_37 = $select_row['wr_37']; // 봉사활동 모집 -> 후원계좌 -> 업무보조
		$wr_38 = $select_row['wr_38']; // 봉사활동 모집 -> 후원계좌 -> 노력봉사
		$wr_39 = $select_row['wr_39']; // 봉사활동 모집 -> 후원계좌 -> 기타

		if(($wr_33 != "")) { $wr_33 = "O"; } else { $wr_33 = ""; }
		if(($wr_34 != "")) { $wr_34 = "O"; } else { $wr_34 = ""; }
		if(($wr_35 != "")) { $wr_35 = "O"; } else { $wr_35 = ""; }
		if(($wr_36 != "")) { $wr_36 = "O"; } else { $wr_36 = ""; }
		if(($wr_37 != "")) { $wr_37 = "O"; } else { $wr_37 = ""; }
		if(($wr_38 != "")) { $wr_38 = "O"; } else { $wr_38 = ""; }
		if(($wr_39 != "")) { $wr_39 = "O"; } else { $wr_39 = ""; }
		
		$wr_40 = $select_row['wr_40']; // 실적인증시스템 -> VMS
		$wr_41 = $select_row['wr_41']; // 실적인증시스템 -> 1365
		$wr_42 = $select_row['wr_42']; // 실적인증시스템 -> Dovol
		$wr_43 = $select_row['wr_43']; // 실적인증시스템 -> 기타

		if(($wr_40 != "")) { $wr_40 = "O"; } else { $wr_40 = ""; }
		if(($wr_41 != "")) { $wr_41 = "O"; } else { $wr_41 = ""; }
		if(($wr_42 != "")) { $wr_42 = "O"; } else { $wr_42 = ""; }
		if(($wr_43 != "")) { $wr_43 = "O"; } else { $wr_43 = ""; }
		
		$wr_good = $select_row['wr_good']; // 관리자 승인여부 -> 승인/미승인 (승인 : 1 / 미승인 : 9)
		$wr_good_ok = "";
		$wr_good_not = "";
		
		if($wr_good == "1") { $wr_good_ok = "O"; }
		if($wr_good == "9") { $wr_good_not = "O"; }

		$si_gb = $select_row['si_gb'];

		$qr_file = $select_row['qr_file']; // QR코드 - 이미지 파일명
		$profile = $select_row['profile']; // 대표자사진 - 이미지 파일명
		$building_profile = $select_row['building_profile']; // 시설전경 사진 파일명
		
		$bcategory_query = "SELECT bcategory_name FROM comm_info_bcategory WHERE 1=1 AND bcategory_id = '".$bcategory_id."'";
		$bcategory_result = mysql_query($bcategory_query);
		$bcategory_row = mysql_fetch_assoc($bcategory_result);
		
		$scategory_query = "SELECT scategory_name FROM comm_info_scategory WHERE 1=1 AND scategory_id = '".$scategory_id."' AND bcategory_id = '".$bcategory_id."'";
		$scategory_result = mysql_query($scategory_query);
		$scategory_row = mysql_fetch_assoc($scategory_result);
		
		$objPHPExcel->getActiveSheet()->getRowDimension($cnt)->setRowHeight(60);
		
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue("A" . $cnt, iconv("EUC-KR", "UTF-8", $wr_id))
			->setCellValue("B" . $cnt, iconv("EUC-KR", "UTF-8", $bcategory_id))
			->setCellValue("C" . $cnt, iconv("EUC-KR", "UTF-8", $scategory_id))
			->setCellValue("D" . $cnt, iconv("EUC-KR", "UTF-8", $wr_subject))
			->setCellValue("E" . $cnt, iconv("EUC-KR", "UTF-8", $lat_val))
			->setCellValue("F" . $cnt, iconv("EUC-KR", "UTF-8", $lon_val))
			->setCellValue("G" . $cnt, iconv("EUC-KR", "UTF-8", $wr_2))
			->setCellValue("H" . $cnt, iconv("EUC-KR", "UTF-8", $wr_3))
			->setCellValue("I" . $cnt, iconv("EUC-KR", "UTF-8", $wr_16))
			->setCellValue("J" . $cnt, iconv("EUC-KR", "UTF-8", $wr_26))
			->setCellValue("K" . $cnt, iconv("EUC-KR", "UTF-8", $wr_22))
			->setCellValue("L" . $cnt, iconv("EUC-KR", "UTF-8", $wr_6))
			->setCellValue("M" . $cnt, iconv("EUC-KR", "UTF-8", $wr_8))
			->setCellValue("N" . $cnt, iconv("EUC-KR", "UTF-8", $wr_7))
			->setCellValue("O" . $cnt, iconv("EUC-KR", "UTF-8", $wr_4))
			->setCellValue("P" . $cnt, iconv("EUC-KR", "UTF-8", $wr_9))
			->setCellValue("Q" . $cnt, iconv("EUC-KR", "UTF-8", $wr_19))
			->setCellValue("R" . $cnt, iconv("EUC-KR", "UTF-8", $wr_20))
			->setCellValue("S" . $cnt, iconv("EUC-KR", "UTF-8", $wr_28))
			->setCellValue("T" . $cnt, iconv("EUC-KR", "UTF-8", $wr_21))
			->setCellValue("U" . $cnt, iconv("EUC-KR", "UTF-8", $wr_29))
			->setCellValue("V" . $cnt, iconv("EUC-KR", "UTF-8", $wr_30))
			->setCellValue("W" . $cnt, iconv("EUC-KR", "UTF-8", $wr_31))
			->setCellValue("X" . $cnt, iconv("EUC-KR", "UTF-8", $wr_32))
			->setCellValue("Y" . $cnt, iconv("EUC-KR", "UTF-8", $wr_44))
			->setCellValue("Z" . $cnt, iconv("EUC-KR", "UTF-8", $wr_24))
			->setCellValue("AA" . $cnt, iconv("EUC-KR", "UTF-8", $wr_33))
			->setCellValue("AB" . $cnt, iconv("EUC-KR", "UTF-8", $wr_34))
			->setCellValue("AC" . $cnt, iconv("EUC-KR", "UTF-8", $wr_35))
			->setCellValue("AD" . $cnt, iconv("EUC-KR", "UTF-8", $wr_36))
			->setCellValue("AE" . $cnt, iconv("EUC-KR", "UTF-8", $wr_37))
			->setCellValue("AF" . $cnt, iconv("EUC-KR", "UTF-8", $wr_38))
			->setCellValue("AG" . $cnt, iconv("EUC-KR", "UTF-8", $wr_39))
			->setCellValue("AH" . $cnt, iconv("EUC-KR", "UTF-8", $wr_40))
			->setCellValue("AI" . $cnt, iconv("EUC-KR", "UTF-8", $wr_41))
			->setCellValue("AJ" . $cnt, iconv("EUC-KR", "UTF-8", $wr_42))
			->setCellValue("AK" . $cnt, iconv("EUC-KR", "UTF-8", $wr_43))
			->setCellValue("AL" . $cnt, iconv("EUC-KR", "UTF-8", $wr_good_ok))
			->setCellValue("AM" . $cnt, iconv("EUC-KR", "UTF-8", $wr_good_not))
			->setCellValue("AN" . $cnt, iconv("EUC-KR", "UTF-8", $si_gb));
		
		$cnt++;
	}
	
	$objPHPExcel->setActiveSheetIndex(0)->getStyle('A6:C' . ($cnt - 1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB("ebebeb");

	$sheet->getStyle( 'A1:AN3' )->getAlignment()->setHorizontal( PHPExcel_Style_Alignment::HORIZONTAL_LEFT );
	$objPHPExcel->getActiveSheet()->setTitle("사회복지편람 정보 목록-" . date("YmdHis"));
	
	$sheet->getStyle( "A4:AN" . ($cnt - 1) )->applyFromArray( array(
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN,
				'color' => array( 'rgb' => '000000' ) 
			)
		)
	) );
	
	$objPHPExcel->setActiveSheetIndex(0);
	$filename = iconv("UTF-8", "EUC-KR", "사회복지편람 정보 목록 - " . date("YmdHis"));
	
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename="'.$filename.'.xls"');
	header('Cache-Control: max-age=0');
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit;
?>