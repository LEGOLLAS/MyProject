<?php
include_once('./_common.php');

if (!$is_member || $member['mb_level'] <= 1) {
//    echo json_encode(array('status'=>'error','msg'=>'회원만 가능합니다.'));
//    exit;
    $check = false;
}

$wr_id = $_REQUEST['req_id'];

$sql = "SELECT * FROM g5_write_programreq WHERE wr_id='".$wr_id."'";
$row = sql_fetch($sql);

if (!$row) { 
    echo json_encode(array('status'=>'error','msg'=>'잘못된 프로그램 입니다.'));
    exit;
}

$check = true;

if ($row['wr_2'] > date('Ymd') || $row['wr_3'] < date('Ymd')) { 
    //echo json_encode(array('status'=>'error','msg'=>'접수기간이 아닙니다.'));
    //exit;
    $check = false;
}

$sql = "SELECT * FROM program_req WHERE program_id='".$wr_id."' AND member_id='".$member['mb_no']."'";
$req_info = sql_fetch($sql);

if ($req_info['status'] == 'X') {
//    echo json_encode(array('status'=>'error','msg'=>'신청이 불가능합니다.'));
//    exit;
    $check = false;
}

$sql = "SELECT * from member_group where id='".$row['wr_10']."'";
$row_1 = sql_fetch($sql);

$sql = "SELECT * from g5_write_setting_1 where wr_id='".$row['wr_9']."'";
$row_2 = sql_fetch($sql);

if ($member['mb_no']) {
    $sql = "SELECT * FROM program_req WHERE program_id='".$wr_id."' AND member_id='".$member['mb_no']."'";
    $req_info = sql_fetch($sql);
}

$html = '
    <ul>
        <li>프로그램명 :  '.$row['wr_subject'].'</li>
        <li>정원 :  '.$row['wr_1'].'명</li>
        <li>접수기간 :  '.$row['wr_2'].' ~ '.$row['wr_3'].'</li>
    </ul>
    <div style="text-align:center;">
    ';

if($check && (!$req_info || $req_info['status'] == 'F')) {
        //<input no="'.$row['wr_id'].'" type="button" class="btn_submit req" value="신청하기">
$html .= '
        <a href="/bbs/programreq_form.php?id='.$row['wr_id'].'" class="btn_submit" style="color:#fff;">신청하기</a>
        <input type="button" class="btn_b03 cancel" value="취소">
    ';
} else {
$html .= '
        <input type="button" class="btn_b03 cancel" value="닫기">
    ';
}

$html .= '
    </div>
';
echo json_encode(array('status'=>'success','data'=>$html));
exit;
?>
