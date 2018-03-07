<?php
include_once('./_common.php');

if (!$is_member || $member['mb_level'] <= 1) {
    echo json_encode(array('status'=>'error','msg'=>'회원만 가능합니다.'));
    exit;
}

$wr_id = $_REQUEST['req_id'];

$sql = "SELECT * FROM g5_write_programreq WHERE wr_id='".$wr_id."'";
$row = sql_fetch($sql);

if (!$row) { 
    echo json_encode(array('status'=>'error','msg'=>'잘못된 프로그램 입니다.'));
    exit;
}

if ($row['wr_2'] > date('Ymd') || $row['wr_3'] < date('Ymd')) { 
    echo json_encode(array('status'=>'error','msg'=>'접수기간이 아닙니다.'));
    exit;
}

$sql = "SELECT * FROM program_req WHERE program_id='".$wr_id."' AND member_id='".$member['mb_no']."'";
$req_info = sql_fetch($sql);

$sql = "select count(*) cnt from program_req where program_id='".$wr_id."' AND status='D'";
$req_cnt = sql_fetch($sql);

if ($req_cnt['cnt'] >= $row['wr_1']) {
    echo json_encode(array('status'=>'error','msg'=>'정원이 초과 되었습니다.'));
    exit;
}

if ($req_info['status'] == 'X') {
    echo json_encode(array('status'=>'error','msg'=>'신청이 불가능합니다.'));
    exit;
}

/*
if ($req_info['status'] != 'F') {
    echo json_encode(array('status'=>'error','msg'=>'이미 신청 하였습니다.'));
    exit;
}
*/

if (!$req_info) {
    $sql = "insert into program_req set status='S', program_id='".$wr_id."', member_id='".$member['mb_no']."', program_req.group='".$member['mb_2']."', ctime=now()";
    sql_query($sql);
} else if ($req_info['status'] == 'F') {
    $sql = "update program_req set status='S' where program_id='".$wr_id."' and member_id='".$member['mb_no']."'";
    sql_query($sql);
}

echo json_encode(array('status'=>'success','msg'=>'신청되었습니다.'));
exit;
?>
