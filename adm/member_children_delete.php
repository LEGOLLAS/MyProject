<?
$sub_menu = "200100";
include_once("./_common.php");

check_demo();

auth_check($auth[$sub_menu], "d");

$mb_id = $_REQUEST['mb_id'];
$mb_children_no = $_REQUEST['mb_children_no'];

$sql = "DELETE FROM g5_member_children WHERE mb_id = '".$mb_id."' AND mb_children_no = '".$mb_children_no."'";
sql_query($sql);

$update_sql = "UPDATE g5_member SET mb_children_re_cnt = mb_children_re_cnt - 1 WHERE mb_id = '".$mb_id."'";
sql_query($update_sql);

goto_url("./member_children_list.php?$qstr&amp;mb_id=$mb_id");
?>
