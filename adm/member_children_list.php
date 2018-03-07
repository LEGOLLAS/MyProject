<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from g5_member_children ";

$sql_search = " where (1) ";
$sql_search .= " and mb_id = '".$_REQUEST['mb_id']."' ";
if ($stx) {
    $sql_search .= " and ( ";
    $sql_search .= " ({$sfl} like '%{$stx}%') ";
    $sql_search .= " ) ";
}

if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if (!$sst) {
    $sst = "mb_children_no";
    $sod = "ASC";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'?sst='.$sst.'&sod='.$sod.'&sfl='.$sfl.'&stx='.$stx.'&page='.$page.'&mb_id='.$_REQUEST['mb_id'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '회원 - 자녀정보관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";

$result = sql_query($sql);

$colspan = 16;

$sql = "SELECT * FROM member_group";
$res = sql_query($sql);
while ($row2 = sql_fetch_array($res)) {
    $group_list[$row2['id']] = $row2['name'];
}
?>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총 회원-자녀수 <?php echo number_format($total_count) ?>명
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
<input type="hidden" name="mb_id" value="<?=$_REQUEST['mb_id']?>" />

<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="mb_children_birth"<?php echo get_selected($_GET['sfl'], "mb_children_birth"); ?>>생년월일</option>
    <option value="mb_children_name"<?php echo get_selected($_GET['sfl'], "mb_children_name"); ?>>자녀이름</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">

</form>

<div class="local_desc01 local_desc">
    <p>
        회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.
    </p>
</div>

<?php if ($is_admin == 'super') { ?>
<div class="btn_add01 btn_add">
    <a href="./member_children_form.php?mb_id=<?=$_REQUEST['mb_id']?>" id="member_add">회원 - 자녀추가</a>
	<a href="./member_list.php">회원 목록으로</a>
</div>
<?php } ?>

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl_head02 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col" id="mb_list_chk" style="width:5%;">
            <label for="chkall" class="sound_only">회원 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col" id="mb_list_id" style="width:15%;"><?php echo subject_sort_link('mb_id') ?>아이디</a></th>
        <th scope="col" id="mb_list_name" style="width:15%;"><?php echo subject_sort_link('mb_children_name') ?>자녀이름</a></th>
        <th scope="col" id="mb_list_auth" style="width:15%;"><?php echo subject_sort_link('mb_children_birth', '', 'desc') ?>생년월일</a></th>
        <th scope="col" id="mb_list_email" style="width:15%;"><?php echo subject_sort_link('mb_children_sex', '', 'desc') ?>성별</a></th>
        <th scope="col" id="mb_list_mng">관리</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $s_mod = '<a href="./member_children_form.php?'.$qstr.'&amp;w=u&amp;mb_id='.$row['mb_id'].'&mb_children_no='.$row['mb_children_no'].'">수정</a>';
        $s_del = "<a href=\"#\" onclick=\"javascript:childrenDelete('".$row['mb_id']."', '".$row['mb_children_no']."')\">삭제</a>";
        $bg = 'bg'.($i%2);
    ?>

    <tr class="<?php echo $bg; ?>">
        <td headers="mb_list_chk" class="td_chk" style="text-align:center !important;">
            <input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['mb_name']); ?> <?php echo get_text($row['mb_nick']); ?>님</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        <td headers="mb_list_id" class="td_name sv_use" style="text-align:center !important;"><?php echo $row['mb_id'] ?></td>
        <td headers="mb_list_name" class="td_mbname" style="text-align:center !important;"><?php echo $row['mb_children_name']; ?></td>
        <td headers="mb_list_auth" class="td_mbstat" style="text-align:center !important;">
            <?php echo $row['mb_children_birth']; ?>
        </td>
        <td headers="mb_list_email" class="td_email" style="text-align:center !important;"><?php if($row['mb_children_sex'] == "M") { ?>남자<? } ?><?php if($row['mb_children_sex'] == "F") { ?>여자<? } ?></td>
        <td headers="mb_list_mng" class="td_mngsmall"><?php echo $s_mod ?> <?php echo $s_del ?></td>
    </tr>
    <?php
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>

<script>
function childrenDelete(mb_id, mb_children_no) {
	if(mb_id != "" && mb_children_no != "") {
		if(confirm("정말로 삭제하시겠습니까?")) {
			location.href = "./member_children_delete.php?mb_id="+mb_id+"&mb_children_no="+mb_children_no+"";
		}
	}
}
</script>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
function fmemberlist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}
</script>

<?php
include_once ('./admin.tail.php');
?>
