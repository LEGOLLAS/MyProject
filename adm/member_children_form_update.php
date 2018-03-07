<?php
$sub_menu = "200100";
include_once("./_common.php");
include_once(G5_LIB_PATH."/register.lib.php");

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], 'w');

check_admin_token();

$mb_id = trim($_REQUEST['mb_id']);
$mb_children_no = trim($_REQUEST['mb_children_no']);

$sql_common = "  mb_children_name = '{$_POST['mb_children_name']}',
                 mb_children_birth = '{$_POST['mb_children_birth']}',
                 mb_children_sex = '{$_POST['mb_children_sex']}' ";

if ($w == '')
{
    sql_query(" insert into g5_member_children set mb_id = '{$mb_id}', {$sql_common} ");
}
else if ($w == 'u')
{
    $sql = " update g5_member_children
                set {$sql_common}
                where mb_id = '{$mb_id}' and mb_children_no = '{$mb_children_no}' ";
    sql_query($sql);
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

goto_url('./member_children_list.php?'.$qstr.'&mb_id='.$mb_id, false);
?>
