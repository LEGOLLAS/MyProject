<?php
include_once('./_common.php');

if (!$is_member) {
    echo json_encode(array('status'=>'error','msg'=>'로그인회원만 가능합니다.'));
    exit;
}

$id = $_REQUEST['req_id'];

$sql = "SELECT * FROM program_req WHERE id='".$id."'";
$req_info = sql_fetch($sql);

$sql = "SELECT * FROM g5_write_programreq WHERE wr_id='".$req_info['program_id']."'";
$row = sql_fetch($sql);

if ($req_info['status'] != 'S') { 
    echo json_encode(array('status'=>'error','msg'=>'취소할 수 없습니다.'));
    exit;
}

if (!$row) { 
    echo json_encode(array('status'=>'error','msg'=>'잘못된 프로그램 입니다.'));
    exit;
}
if ($req_info['member_id'] != $member['mb_no']) { 
    echo json_encode(array('status'=>'error','msg'=>'권한이 없습니다.'));
    exit;
}

$sql = "update program_req set status='F' where id='".$id."'";
sql_query($sql);

echo json_encode(array('status'=>'success','msg'=>'취소되었습니다.'));
exit;
?>
