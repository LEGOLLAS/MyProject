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

$query = sql_query(" select * from $write_table where wr_3 = 'Y' AND wr_id = '".$_REQUEST['wr_id']."' order by wr_id desc ");
$_l = sql_fetch_array($query);

include_once(G5_PATH.'/head.php');

/*
echo '<pre>';
print_r($p_l);
echo '</pre>';
exit;
*/
?>
<?php if ($is_admin) { ?>
<div><a href="/bbs/board.php?bo_table=<?php echo $bo_table; ?>" class="btn_admin">프로그램관리</a></div>
<?php } ?>

<style type="text/css">
.btn_submit {
    padding: 8px;
    border: 0;
    background: #faa61a;
    color: #fff;
    cursor: pointer;
	font-size:14px;
	font-weight:bold;
}

#one_show_program .thColor {
    background: #f4f4f4;
    color: #5e5e5e;
    padding: 5px 0;
	font-size:15px;
	padding:10px; 
}

#one_show_program .w89 {
	width:89px;
}

#one_show_program .w86 {
	width:86px;
}

#one_show_program .borT {
	border-top:1px solid #e2dfd8; 
}

#one_show_program .borL {
	border-left:1px solid #e2dfd8; 
}

#one_show_program .borB {
	border-bottom:1px solid #e2dfd8; 
}

#one_show_program .borR {
	border-right:1px solid #e2dfd8;
}
</style>

<div id="one_show_program">

<table cellspacing="1" cellpadding="0" bgcolor="#e2dfd8" width="100%">
<tr height="50">
	<td class="col_3" style="font-size:15px; color:#faad38;"><img src="/images/bullet_content.png" /> <?php echo $_l['wr_subject']; ?> <img src="/images/bullet_content.png" /></td>
</tr>
</table>

<div>&nbsp;</div>

<table cellspacing="0" cellpadding="0" width="100%" style="table-layout:fixed; border-collapse:collapse;">
    <tr height="50">
        <td class="thColor w89 borL borT borB borR"><nobr>대상 및 정원</nobr></td>
        <td class="thColor borT borB borR">내   용</td>
        <td class="thColor w86 borT borB borR">참가비(원)</td>
    </tr>
    <tr>
        <td class="col_2" style="background:#ffffff; font-size:15px; border-left:1px solid #e2dfd8; border-right:1px solid #e2dfd8; border-bottom:1px solid #e2dfd8;">
			<div><?php echo $_l['wr_1']; ?></div>
			<?php if($_l['wr_6'] != "") { ?>
			<div>//</div>
			<div><?php echo $_l['wr_6']; ?></div>
			<? } ?>
		</td>
        <td align="left" class="col_3" style="font-size:15px; font-weight:normal; padding:4px; border-bottom:1px solid #e2dfd8; border-right:1px solid #e2dfd8;">
			<?php echo $_l['wr_content']; ?>
		</td>
        <td class="col_4" style="font-size:15px; border-bottom:1px solid #e2dfd8; border-right:1px solid #e2dfd8;"><?php echo $_l['wr_4']; ?></td>
    </tr>
    </tbody>
</table>
</div>

<?php
	include_once(G5_PATH.'/tail.php');
?>
