<?php
include_once('./_common.php');

if (!$is_member || $member['mb_level'] < 5) {
    alert('관리자만 가능합니다.', '/');
    exit;
}

$id = $_POST['id'];
$status1 = $_POST['s1'];
$status2 = $_POST['s2'];
$status = $_POST['status'];

if (!$id || !$status || !$status1 || !$status2) {
    goto_url('/bbs/board.php?bo_table=programreq&wr_id='.$id);
    exit;
}

if ($status == 'N') {
    if (!array_key_exists($status1, $g5['status']) || !array_key_exists($status2, $g5['status'])) {
        alert('정보가 부적절합니다.', '/bbs/board.php?bo_table=programreq&wr_id='.$id);
        exit;
    }
} elseif ($status == 'Y') {
    if (!array_key_exists($status1, $g5['status2']) || !array_key_exists($status2, $g5['status2'])) {
        alert('정보가 부적절합니다.', '/bbs/board.php?bo_table=programreq&wr_id='.$id);
        exit;
    }
} else {
    alert('정보가 부적절합니다.', '/bbs/board.php?bo_table=programreq&wr_id='.$id);
    exit;
}

$sql = "SELECT * FROM g5_write_programreq WHERE wr_id='".$id."'";
$row = sql_fetch($sql);

if (!$row) { 
    alert('잘못된 프로그램 입니다.', '/bbs/board.php?bo_table=programreq&wr_id='.$id);
    exit;
}

if ($row['wr_4'] != $status) {
    alert('종료상태가 일치하지 않습니다.', '/bbs/board.php?bo_table=programreq&wr_id='.$id);
    exit;
}

if ($row['mb_id'] != $member['mb_id'] && !$is_admin) { 
    alert('수정권한이 없습니다.', '/bbs/board.php?bo_table=programreq&wr_id='.$id);
    exit;
}

if ($status == 'N') {
    $sql = "update program_req set status='".$status2."' where program_id='".$id."' and status='".$status1."'";
} else {
    $sql = "update program_req set status2='".$status2."' where program_id='".$id."' and status2='".$status1."'";
}
sql_query($sql);

alert('수정되었습니다.', '/bbs/board.php?bo_table=programreq&wr_id='.$id);
exit;
?>
