<?php
$_REQUEST['bo_table'] = 'programreq';
require_once('../common.php');

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

$list = array();
$i = 1;

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
		a.program_id='".$wr_id."' and a.member_id = '".$_REQUEST['mb_id']."'";
$result = sql_query($sql);
$member_row = sql_fetch_array($result);

if ($member['mb_id'] == $_REQUEST['mb_id'] || $is_admin) {	
	$mb_name = $member_row['mb_name'];
	$mb_2 = $group_list[$member_row['mb_2']];
	$mb_3 = $member_row['mb_3'];
	$mb_1 = $member_row['mb_1'];
	$mb_4 = $member_row['mb_4'];
	$mb_5 = $member_row['mb_5'];
	$mb_hp = $member_row['mb_hp'];
	$mb_email = $member_row['mb_email'];
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
            $g5['status2'][$row['status2']]
        );
    }
}
?>
<html>
<head>
<title>2017년도 지역선도대학 육성사업 참여 신청서</title>
<script>
window.onload = function() {
	alert("인쇄 미리보기 > 설정에 들어가서\r\n배경색 및 이미지 인쇄를 체크 후 인쇄가 가능합니다.");
	window.print();
}
</script>
</head>
<body>
<table align="center" width="625px" cellpadding="0" cellspacing="0" style="table-layout:fixed;">
<tr>
	<td>&nbsp;&nbsp;</td>
</tr>
<tr>
	<td><img src="/print/images/so_title.png" /></td>
</tr>
<tr>
	<td>&nbsp;&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;&nbsp;</td>
</tr>
</table>

<table align="center" width="625px" style="border-left:2px solid black; border-top:2px solid black; border-right:2px solid black; border-bottom:2px solid black; border-collapse:collapse;" cellpadding="0" cellspacing="0">
<tr>
	<td style="background:#e5e5e5; width:167px; height:78px; text-align:center; border-bottom:1px solid black; border-right:1px solid black;">
		<img src="/print/images/th01.png" />
	</td>
	<td colspan="3" style="border-bottom:1px solid black;"></td>
</tr>
<tr>
	<td style="background:#e5e5e5; width:167px; height:78px; text-align:center; border-bottom:1px solid black; border-right:1px solid black;">
		<img src="/print/images/th02.png" />
	</td>
	<td colspan="3" style="border-bottom:1px solid black; background:url('/print/images/td02_background.png');">
		<div style="padding-left:5px; float:left; width:160px; text-align:right;"><?=$mb_2?></div>
		<div style="padding-left:5px; float:right; width:180px;"><?=$mb_3?>&nbsp;</div>
	</td>
</tr>
<tr>
	<td style="background:#e5e5e5; width:167px; height:78px; text-align:center; border-bottom:1px solid black; border-right:1px solid black;">
		<img src="/print/images/th03.png" />
	</td>
	<td style="border-bottom:1px solid black; width:234px;">&nbsp;</td>
	<td style="border-bottom:1px solid black; width:105px; background:#f2f2f2; text-align:center; border-left:1px solid black; border-right:1px solid black;">
		<img src="/print/images/th04.png" />
	</td>
	<td style="border-bottom:1px solid black; text-align:right;">&nbsp;
		<?=$mb_4?><img src="/print/images/td03.png" />
	</td>
</tr>
<tr>
	<td style="background:#e5e5e5; width:167px; height:78px; text-align:center; border-bottom:1px solid black; border-right:1px solid black;">
		<img src="/print/images/th05.png" />
	</td>
	<td colspan="3" style="border-bottom:1px solid black;">
		<div style="padding-left:5px;"><?=$mb_name?></div>
	</td>
</tr>
<tr>
	<td style="background:#e5e5e5; width:167px; height:78px; text-align:center; border-bottom:1px solid black; border-right:1px solid black;">
		<img src="/print/images/th06.png" />
	</td>
	<td colspan="3" style="border-bottom:1px solid black;"></td>
</tr>
<tr>
	<td style="background:#e5e5e5; width:167px; height:78px; text-align:center; border-bottom:1px solid black; border-right:1px solid black;">
		<img src="/print/images/th07.png" />
	</td>
	<td colspan="3" style="border-bottom:1px solid black;"></td>
</tr>
<tr>
	<td style="background:#e5e5e5; width:167px; height:78px; text-align:center; border-right:1px solid black;">
		<img src="/print/images/th08.png" />
	</td>
	<td colspan="3"></td>
</tr>
</table>

<table align="center" width="625px" cellpadding="0" cellspacing="0" style="table-layout:fixed;">
<tr>
	<td>&nbsp;&nbsp;</td>
</tr>
<tr align="center">
	<td style="font-family:'바탕체';">위와 같이 수강을 신청합니다.</td>
</tr>
</table>

<table align="center" width="625px" cellpadding="0" cellspacing="0" style="table-layout:fixed;">
<tr>
	<td>&nbsp;&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;&nbsp;</td>
</tr>
<tr align="center">
	<td style="font-family:'바탕체';">2017. &nbsp;&nbsp;&nbsp;. &nbsp;&nbsp;&nbsp;.</td>
</tr>
<tr align="right">
	<td style="font-weight:bold; font-family:'바탕체';">신청자 : <?=$mb_name?> (서명)</td>
</tr>
</table>

</body>
</html>