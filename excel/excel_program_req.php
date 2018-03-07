<?php
$_REQUEST['bo_table'] = 'programreq';
require_once('../common.php');

require_once(G5_LIB_PATH.'/excel.php');

if ($member['mb_level'] < $board['bo_read_level']) {
    if ($is_member)
        alert('권한이 없습니다.', G5_URL);
    else
        alert('권한이 없습니다.\\n\\n회원이시라면 로그인 후 이용해 보십시오.', '/bbs/login.php?wr_id='.$wr_id.$qstr.'&amp;url='.urlencode(G5_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id.$qstr));
}

$sql = "SELECT * FROM ".$write_table." WHERE wr_id=".$wr_id;
$board_info = sql_fetch($sql);

$sql = "SELECT * FROM member_group";
$result = sql_query($sql);
while ($row = sql_fetch_array($result)) {
    $group_list[$row['id']] = $row['name'];
}

$wheres = [];
if ($_GET['s1']) {
        $wheres[] = "a.status='".$_GET['s1']."'";
}
if ($_GET['s2']) {
        $wheres[] = "a.status2='".$_GET['s2']."'";
}

if ($wheres) {
        $wh = ' and '.implode(' and ', $wheres);
}

$sql = "
SELECT 
    a.*, 
    b.*,
    c.wr_11 as bank_name,
    c.wr_12 as bank_account_number,
    c.wr_2 as price
FROM 
    program_req a 
        left join 
    g5_member b 
        on 
            (a.member_id=b.mb_no) 
        left join
    g5_write_scholarship c
        on
            (a.scholarship_id = c.wr_id)
WHERE 
    a.program_id='".$wr_id."'".$wh;
$result = sql_query($sql);

$head = array( 'No', '이름', '학교', '학과', '학번', '학년', '생년월일', '연락처', '이메일', '상태', '장학금' );
$widths = array( 10, 15, 25, 25, 15, 8, 10, 15, 25, 9, 9 );

$list = array();
$i = 1;

if ($member['mb_id'] == $board_info['mb_id'] || $is_admin) {
    $head[] = '은행명';
    $head[] = '계좌번호';
    $head[] = '금액';
    $widths[] = '12';
    $widths[] = '18';
    $widths[] = '10';

    while ($row = sql_fetch_array($result)) {
        if ($row['status2'] != 'D' && $row['status2'] != 'A') {
            $row['bank_name'] = '';
            $row['bank_account_number'] = '';
            $row['price'] = '';
        }
        $list[] = array(
            $i++,
            $row['mb_name'],
            $group_list[$row['mb_2']],
            $row['mb_3'],
            $row['mb_1'],
            $row['mb_4'],
            $row['mb_5'],
            $row['mb_hp'],
            $row['mb_email'],
            $g5['status'][$row['status']],
            $g5['status2'][$row['status2']],
            $row['bank_name'],
            $row['bank_account_number'],
            number_format($row['price']),
        );
    }
} else {
    while ($row = sql_fetch_array($result)) {
        $list[] = array(
            $i++,
            $row['mb_name'],
            $group_list[$row['mb_2']],
            $row['mb_3'],
            '-',
            '-',
            '-',
            '-',
            '-',
            $g5['status'][$row['status']],
            $g5['status2'][$row['status2']],
        );
    }
}

$filename = mb_convert_encoding(str_replace(' ', '_', $board_info['wr_subject']).'_'.date('Ymd').'.xls', 'EUC-KR', 'UTF-8');
$obj = new excel();

$obj->setTitle($board_info['wr_subject']);
$obj->setHead($head);
$obj->setBody($list);
$obj->setwidth($widths);
$obj->out($filename);
?>
