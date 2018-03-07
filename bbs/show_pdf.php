<?php
$_REQUEST['bo_table'] = 'scholarship';
include_once('./_common.php');
require_once '../lib/dompdf/autoload.inc.php';

$req_id = $_GET['id'];

if (!$req_id) {
    alert("정상적인 접근이 아닙니다.", G5_URL);
}

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$sql = "
    SELECT 
        a.*, 
        b.*,
        (SELECT member_group.name FROM member_group WHERE member_group.id=a.group) AS m_group,
        IF(b.wr_10=a.group, c.wr_1, c.wr_2) AS point
    FROM 
        program_req a 
            LEFT JOIN 
        g5_write_programreq b 
            ON 
                a.program_id=b.wr_id 
            LEFT JOIN
        g5_write_setting_1 c
            ON
                b.wr_9=c.wr_id
    WHERE 
        a.id='".$req_id."'
    ";
$program_data = sql_fetch($sql);

if (!$program_data || $program_data['scholarship_id'] < 1) {
    //print_r($program_data);exit;
    alert("정상적인 접근이 아닙니다.", G5_URL);
}

if ($member['mb_no'] != $program_data['member_id'] && $member['mb_level'] < 5) {
    alert("정상적인 접근이 아닙니다.", G5_URL);
}

ob_start();

include_once(G5_PATH.'/head.sub.php');

$wr_id = $program_data['scholarship_id'];
$write = sql_fetch(" select * from $write_table where wr_id = '$wr_id' ");

if ($_GET['pdf'] != 'Y') {
include_once(G5_BBS_PATH.'/board_head.php');
}

include_once(G5_BBS_PATH.'/view.php');

//print_r($view);

if ($_GET['pdf'] != 'Y') {
include_once(G5_BBS_PATH.'/board_tail.php');
}

include_once(G5_PATH.'/tail.sub.php');

$html = ob_get_contents();
if ($_GET['pdf'] == 'Y') {
    ob_end_clean();

    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $filename = '장학금신청서_'.$view['wr_name'].'.pdf';
    //$dompdf->stream('scholarship.pdf');
    $dompdf->stream($filename);
}
?>
