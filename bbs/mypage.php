<?php
include_once('./_common.php');
if (!$is_member) {
    alert('로그인 후 이용해주세요.', G5_BBS_URL.'/login.php?url=/bbs/mypage.php');
    exit;
}
$g5['title'] = '마이페이지';
include_once('_head.php');

$group_row = sql_fetch("select * from member_group where id='".$member['mb_2']."'");


$isNew = $_REQUEST['isNew'];
$isNewStr = "";

if($isNew == "Y") {
	$isNewStr = "&isNew=Y";
}
?>

<div style="margin:0;text-align: right;">
<a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php<?php echo $isNewStr; ?>" class="btn_b01">회원정보수정</a>
</div>
<div class="my_page">
<table>
    <tr>
        <th>아이디</th>
        <td><?php echo $member['mb_id']; ?></td>
    </tr>
    <tr>
        <th>성명</th>
        <td><?php echo $member['mb_name']; ?></td>
    </tr>
    <tr>
        <th>생년월일</th>
        <td><?php echo substr($member['mb_5'],0,4)."년 ".substr($member['mb_5'],4,2)."월 ".substr($member['mb_5'],6,2).'일'; ?></td>
    </tr>
    <tr>
        <th>휴대폰번호</th>
        <td><?php echo $member['mb_hp']; ?></td>
    </tr>
    <tr>
        <th>E-mail</th>
        <td><?php echo $member['mb_email']; ?></td>
    </tr>
</table>
</div>

<?php
$sql = "
    SELECT 
        a.*, 
        b.*,
        c.wr_1 AS point_1,
        c.wr_2 AS point_2
    FROM 
        program_req a 
            LEFT JOIN 
        g5_write_programreq b 
            ON 
                a.program_id=b.wr_id 
            LEFT JOIN
        g5_write_setting_1 c
            ON
                b.wr_9=c.wr_id
    WHERE 
        a.member_id='".$member['mb_no']."'
        AND
        a.status not in ('X', 'F')
    ";
$result = sql_query($sql);
$ing_list = array();
$done_list = array();
while ($row = sql_fetch_array($result))
{
    if($row['wr_4'] == 'Y') {
        $done_list[] = $row;
    } else {
        $ing_list[] = $row;
    }
}
?>

<!--
<div class="my_page2">
    <div class="title">진행 중인 프로그램</div>
    <table>
        <tr>
            <th>프로그램</th>
            <th style="width:100px;">마일리지</th>
            <th style="width:100px;">신청상태</th>
            <th style="width:100px;"></th>
        </tr>
<?php
//참여 중인 프로그램
/*
foreach ($ing_list as $list) {
?>
        <tr>
            <td><?php echo $list['wr_subject']; ?></td>
            <td class="center"><?php echo $member['mb_2'] == $list['wr_10'] ? $list['point_1'] : $list['point_2']; ?>점</td>
            <td class="center"><?php echo $g5['status'][$list['status']]; ?></td>
            <td>
<?php
if($list['status'] == 'S') {
?>
                <input no="<?php echo $list['id']; ?>" class="btn_cancel cancel" type="button" value="취소하기">
<?php
} else {
}
?>
            </td>
        </tr>
<?php
}*/
?>
    </table>
    <div class="title">완료된 프로그램</div>
    <table>
        <tr>
            <th>프로그램</th>
            <th style="width:100px;">마일리지</th>
            <th style="width:100px;">신청상태</th>
            <th style="width:100px;">장학금</th>
        </tr>
<?php
//완료된 프로그램
/*
foreach ($done_list as $list) {
?>
        <tr>
            <td><?php echo $list['wr_subject']; ?></td>
            <td class="center"><?php echo $member['mb_2'] == $list['wr_10'] ? $list['point_1'] : $list['point_2']; ?>점</td>
            <td class="center"><?php echo $g5['status'][$list['status']]; ?></td>
            <td>
                <?php
                if($list['status'] == 'A') {
                    if($list['status2'] == 'S') {
                ?>
                <a href="/bbs/req.php?id=<?php echo $list['id']; ?>" class="btn_submit2">신청하기</a>
                <?php
                    } else if ($list['status2'] == 'A' || $list['status2'] == 'D') {
                ?>
                <a href="/bbs/show_pdf.php?id=<?php echo $list['id']; ?>" class="btn_view" target="_blank"><?php echo $g5['status2'][$list['status2']]; ?></a>
                <?php
                    }
                }
                ?>
            </td>
        </tr>
<?php
}*/
?>
    </table>
-->

</div>
<script>
$(document).ready(function() {
    $('.cancel').click(function() {
        $(this).attr('disabled', 'disabled');
        var t = $(this);
        $.ajax({
            type: "POST",
            url: g5_bbs_url+"/ajax.cancel_program_req.php",
            data: {
                "req_id": $(this).attr('no')
            },
            cache: false,
            async: true,
            dataType: 'json',
            success: function(data) {
                if(data.status == 'error') {
                    alert(data.msg);
                    t.removeAttr('disabled');
                } else {
                    alert(data.msg);
                    window.location.reload();
                }
                //console.log(data);
            }
        });
    });
});
</script>
<?php
include_once('_tail.php');
?>
