<?php
//if (!defined('_GNUBOARD_')) exit;

require_once(dirname(__FILE__) . '/PHPExcel.php');

class excel {
    private $excel;
    public $sheet;

    public function __construct() {
        $this->excel = new PHPExcel();
        $this->sheet = $this->excel->getActiveSheet();

        $this->sheet->getPageSetup()
            ->setFitToPage( true )
            ->setFitToWidth( 1 )
            ->setFitToPage( true )
            ->setPaperSize( PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4 );

        $this->sheet->getPageSetup()->setOrientation( PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT );
        $this->sheet->getPageSetup()->setFitToHeight(0);

        $this->sheet->getDefaultStyle()->getAlignment()->setVertical( PHPExcel_Style_Alignment::VERTICAL_CENTER )->setHorizontal( PHPExcel_Style_Alignment::HORIZONTAL_CENTER );
        $this->sheet->getDefaultStyle()->getFont()->setSize( 10 )->setName( '맑은 고딕' );
        $this->sheet->getDefaultStyle()->getAlignment()->setWrapText( true );
    }

    public function setTitle($title) {
        $this->sheet->setCellValue( 'A1', $title );
        $this->sheet->getStyle("A1:E1")->getFont()->setSize(12);
        $this->sheet->getRowDimension(1)->setRowHeight( 35 );
    }

    public function setHead($titles) {
        $start = 'A';
        foreach ($titles as $t) {
            $this->sheet->setCellValue( $start.'3', $t );
            $start = chr(ord($start) + 1);
        }
        $this->sheet->getRowDimension(3)->setRowHeight( 30 );

        $this->sheet->getStyle( "A3:".chr(ord($start) - 1)."3" )
            ->applyFromArray( 
                    array(
                        'borders' => array(
                            'allborders' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN,
                                //'color' => array( 'rgb' => PHPExcel_Style_Color::COLOR_BLACK )
                                )
                            ),
                        'fill' => array(
                            'type' => PHPExcel_Style_Fill::FILL_SOLID,   
                            'startcolor' => array(    
                                'argb' => 'FFE5E5E5',   
                                ),   
                            ), 
                        ) 
                    );

        $this->sheet->mergeCells( 'A1:'.chr(ord($start) - 1).'1' );
    }
    public function setBody($datas) {
        if(count($datas) > 0) {
            $row = 4;
            foreach ($datas as $data) {
                $col = 'A';
                foreach ($data as $t) {
                    $this->sheet->setCellValue( $col.$row, $t );
                    $col = chr(ord($col) + 1);
                }
                $this->sheet->getRowDimension($row)->setRowHeight( 20 );
                $row++;
            }
            $this->sheet->getStyle( "A4:".chr(ord($col) - 1).($row - 1) )
                ->applyFromArray( 
                        array(
                            'borders' => array(
                                'allborders' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                                    //'color' => array( 'rgb' => PHPExcel_Style_Color::COLOR_BLACK )
                                    )
                                )
                            ) 
                        );

        }
    }

    public function setWidth($widths) {
        $col = 'A';
        foreach ($widths as $w) {
            $this->sheet->getColumnDimension( $col )->setWidth( $w );
            $col = chr(ord($col) + 1);
        }
    }

    public function out($filename) {
        header( 'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' );
        header( 'Content-Disposition: attachment;filename="' . $filename . '"' );
        header( 'Cache-Control: max-age=0' );
        header( 'Cache-Control: max-age=1' );
        header( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' ); // Date in the past
        header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' ); // always modified
        header( 'Cache-Control: cache, must-revalidate' ); // HTTP/1.1
        header( 'Pragma: public' ); // HTTP/1.0

        //$objWriter = PHPExcel_IOFactory::createWriter( $this->excel, 'Excel2007' );
        $objWriter = PHPExcel_IOFactory::createWriter( $this->excel, 'Excel5' );
        $objWriter->save( 'php://output' );
    }
}

/*
$obj = new excel();

$head = array(
'테스트1',
'테스트2',
'테스트3',
'테스트4',
'테스트5',
);
$obj->setTitle('테스트', 5);
$obj->setHead($head);
$obj->out('test.xlsx');
*/
?>
