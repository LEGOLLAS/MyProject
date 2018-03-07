<?php
$_REQUEST['bo_table'] = 'programs';

include_once('./_common.php');
/*
 * 프로그램 한눈에보기를 사용하기 위해 제작함
 * 2017.01.17 최종욱
*/

if (!$board['bo_table']) {
   alert('존재하지 않는 게시판입니다.', G5_URL);
}

check_device($board['bo_device']);


$isNew = $_REQUEST['isNew'];

if (isset($write['wr_is_comment']) && $write['wr_is_comment']) {
    goto_url('./board.php?bo_table='.$bo_table.'&amp;wr_id='.$write['wr_parent'].'#c_'.$wr_id);
}

if (!$bo_table) {
    $msg = "bo_table 값이 넘어오지 않았습니다.\\n\\nboard.php?bo_table=code 와 같은 방식으로 넘겨 주세요.";
    alert($msg);
}

$query = sql_query(" select * from $write_table where wr_3 = 'Y' order by wr_id asc ");

include_once(G5_PATH.'/head.php');

?>
<?php if ($is_admin) { ?>
<div><a href="/bbs/board.php?bo_table=<?php echo $bo_table; ?>" class="btn_admin">프로그램관리</a></div>
<?php } ?>

<style>
.btn_submit {
    padding: 10px;
    border: 0;
    background: #faa61a;
    color: #fff;
    cursor: pointer;
	font-size:14px;
	font-weight:bold;
}
</style>

<div id="one_show_program">
<table cellspacing="0" cellpadding="0" width="100%">
    <thead>
    <tr height="50">
        <th style="background:#fff1d9; color:#5e5e5e; font-size:15px; border-top:1px solid #e2dfd8; border-bottom:1px solid #e2dfd8;">프로그램명</th>
        <th style="background:#fff1d9; color:#5e5e5e; font-size:15px; border-top:1px solid #e2dfd8; border-bottom:1px solid #e2dfd8;">예약 신청</th>
    </tr>
    </thead>
    <tbody>
<?php
	while ($_l = sql_fetch_array($query)) {
?>
    <tr>
        <td class="col_3" style="font-size:15px; border-bottom:1px solid #e2dfd8; text-align:left;"><?php echo $_l['wr_subject']; ?></td>
        <td class="col_5" style="font-size:15px; border-bottom:1px solid #e2dfd8;">
			<input type="button" value="예약신청" class="btn_submit" onclick="location.href = '/bbs/program_view.php?bo_table=programs&wr_id=<?php echo $_l['wr_id']; ?>';" />
		</td>
    </tr>
<?php
        }
?>
    </tr>
    </tbody>
</table>
</div>

<?php
	include_once(G5_PATH.'/tail.php');
?>
