<?php
include_once('./_common.php');

if (!$is_member || $member['mb_level'] < 5) {
    echo json_encode(array('status'=>'error','msg'=>'관리자만 가능합니다.'));
    exit;
}

$id = $_REQUEST['id'];
$status = $_REQUEST['status'];
if (!$id || !$status || !array_key_exists($status, $g5['status2'])) {
    echo json_encode(array('status'=>'error','msg'=>'정보가 부적절합니다.'));
    exit;
}

$sql = "SELECT * FROM program_req WHERE id='".$id."'";
$req_info = sql_fetch($sql);

$sql = "SELECT * FROM g5_write_programreq WHERE wr_id='".$req_info['program_id']."'";
$row = sql_fetch($sql);

if (!$row) { 
    echo json_encode(array('status'=>'error','msg'=>'잘못된 프로그램 입니다.'));
    exit;
}
if ($row['mb_id'] != $member['mb_id'] && !$is_admin) { 
    echo json_encode(array('status'=>'error','msg'=>'수정권한이 없습니다.'));
    exit;
}

$sql = "update program_req set status2='".$status."' where id='".$id."'";
sql_query($sql);

echo json_encode(array('status'=>'success','msg'=>'수정되었습니다.'));
exit;
?>
