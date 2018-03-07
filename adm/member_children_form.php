<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

if ($w == '')
{
    $html_title = ' - 자녀정보 추가';
}
else if ($w == 'u')
{
    $sql = "SELECT * FROM g5_member_children WHERE mb_id = '".$_REQUEST['mb_id']."' AND mb_children_no = '".$_REQUEST['mb_children_no']."'";	
	$result = sql_query($sql);
	$row = sql_fetch_array($result);

	$html_title = ' - 자녀정보 수정';
}

$g5['title'] .= '회원 '.$html_title;
include_once('./admin.head.php');

add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>

<form name="fmember" id="fmember" action="./member_children_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="mb_children_no" value="<?php echo $_REQUEST['mb_children_no'] ?>">
<input type="hidden" name="mb_id" value="<?php echo $_REQUEST['mb_id']; ?>">

<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col class="grid_4">
        <col>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th scope="row"><label for="mb_chlidren_name">자녀이름<strong class="sound_only">필수</strong></label></th>
        <td colspan="3"><input type="text" name="mb_children_name" value="<?php echo $row['mb_children_name'] ?>" id="mb_children_name" required class="required frm_input" size="15" minlength="2" maxlength="20"></td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_children_birth">생년월일</label></th>
        <td colspan="3"><input type="text" name="mb_children_birth" id="mb_children_birth" value="<?php echo $row['mb_children_birth'] ?>" class="required frm_input" size="15" minlength="2" maxlength="20" /></td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_children_sex">성별</label></th>
        <td colspan="3">
			<select name="mb_children_sex" id="mb_children_sex">
			<option value="M"<?php if($row['mb_children_sex'] == "M") { ?> selected<?php } ?>>남자</option>
			<option value="F"<?php if($row['mb_children_sex'] == "F") { ?> selected<?php } ?>>여자</option>
			</select>
		</td>
    </tr>
    </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="확인" class="btn_submit" accesskey='s'>
    <a href="./member_children_list.php?<?php echo $qstr ?>&mb_id=<?=$_REQUEST['mb_id']?>">목록</a>
</div>
</form>

<script>
function fmember_submit(f)
{
    if (!f.mb_icon.value.match(/\.gif$/i) && f.mb_icon.value) {
        alert('아이콘은 gif 파일만 가능합니다.');
        return false;
    }

    return true;
}
</script>

<?php
include_once('./admin.tail.php');
?>
