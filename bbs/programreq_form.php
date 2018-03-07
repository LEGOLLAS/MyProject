<?php
include_once('./_common.php');

$_REQUEST['co_id'] = 'programreq';

$url = '';
if(!empty($_SERVER['HTTP_REFERER'])) {
    $url = $_SERVER['HTTP_REFERER'];
} else {
    $url = G5_URL;
}

if (!$is_member || $member['mb_level'] <= 1) {
    alert('회원만 접근 가능합니다.', $url);
    exit;
}

$wr_id = $_REQUEST['id'];

$sql = "SELECT * FROM g5_write_programreq WHERE wr_id='".$wr_id."'";
$row = sql_fetch($sql);

if (!$row) { 
    alert('잘못된 프로그램 입니다.', $url);
    exit;
}

if ($row['wr_2'] > date('Ymd') || $row['wr_3'] < date('Ymd')) { 
    alert('접수기간이 아닙니다.', $url);
    exit;
}

$sql = "SELECT * FROM program_req WHERE program_id='".$wr_id."' AND member_id='".$member['mb_no']."'";
$req_info = sql_fetch($sql);

$sql = "select count(*) cnt from program_req where program_id='".$wr_id."' AND status='D'";
$req_cnt = sql_fetch($sql);

if ($req_cnt['cnt'] >= $row['wr_1']) {
    alert('정원이 초과 되었습니다.', $url);
    exit;
}

if ($req_info) {
    if ($req_info['status'] == 'X') {
        alert('신청이 불가능 합니다.', $url);
        exit;
    }

    if ($req_info['status'] != 'F') {
        alert('이미 신청 하였습니다.', $url);
        exit;
    }
}

//$g5['title'] = '프로그램 참여 신청';
$g5['title'] = '예약신청';

include_once('./_head.php');
?>
<style>
.dl_style_10 {
color: #666;
line-height: 21px;
}
.dl_style_10 dt {
font-size: 14px;
font-weight: 700;
margin: 15px 0 5px 15px;
}
.dl_style_10 dt.t0 {
    color: #333;
    font-size: 16px;
    text-align:center;
    margin-left: 0;
}
.dl_style_10 dt.t1 {
    color: #333;
    margin-left: 0;
}
.dl_style_10 dd {
    display: list-item;
    margin-left: 15px;
}
.dl_style_10 dd > div {
margin-left: 15px;
}
</style>

<div style="text-align: center; font-size: 16px;">
개인정보 수집·이용·3자 제공 동의서
</div>

<div style="padding: 30px 0;">
    <div style="height: 200px; overflow-Y:scroll;border: 1px solid #e9e9e9;padding: 10px;">

        <div class="dl_style_10">
            <dl>
                <dt class="t0">개인정보의 수집․이용 동의</dt>
                <dt class="t1">개인정보의 수집․이용 동의</dt>
                <dd>개인정보의 수집․이용 목적 : 정부재정지원사업 활동 참여 및 사업비 집행 내역 관리</dd>
                <dd>개인정보의 수집 항목 : 성명, 주민등록번호, 주소, 전화번호, 이메일, 계좌번호<br>(※학사정보 연동으로 자동 수집가능)</dd>
                <dd>보유 및 이용기간 : 과제종료 후 5년</dd>
                <dd>거부권 및 불이익<br>신청자는 개인정보 수집 동의에 거부할 권리가 있습니다. 다만 개인정보 수집을 거부할 경우 정부재정지원사업 참여 제한 및 사업비를 수령 받지 못 할 수 있습니다.</dd>
            </dl>
        </div>

    </div>
    <fieldset class="fregister_agree">
        <label for="agree11">개인정보의 수집․이용 내용에 동의합니다.</label>
        <input type="checkbox" name="agree" value="1" id="agree11">
    </fieldset>
</div>
<div style="padding: 20px 0;">
    <div style="height: 200px; overflow-Y:scroll;border: 1px solid #e9e9e9;padding: 10px;">
        <div class="dl_style_10">
            <dl>
                <dt class="t0">개인정보 제3자 제공 동의</dt>
                <dt class="t1">개인정보 제3자 제공 동의</dt>
                <dd>개인정보를 제공받는 자 : 제1금융권, 제주세무서, 국민연금공단, 법률 및 계약상 요청할 수 있는 기관</dd>
                <dd>개인정보 3자 제공 목적 : 사업비(인건비/수당 등) 지급</dd>
                <dd>제공하는 개인정보 항목
                    <div>
                    · 제1금융권  : 성명, 계좌번호<br>
                    · 제주세무서 : 성명, 주민번호, 주소, 인건비, 결정세액(소득세법 제164조)<br>
                    · 국민연금   : 성명, 주민번호(국민연금법 제10조, 동업 제77조)</br>
                    · (전문(지원))기관 : 성명, 계좌번호, 주민번호, 인건비(계약에 의한 정산시)<br>
                    </div>
                </dd>
                <dd>보유 및 이용 기간 : 과제종료 후 5년</dd>
                <dd>거부권 및 불이익<br>신청자는 개인정보 3자 제공 동의에 거부할 권리가 있습니다. 다만 개인정보 3자 제공 동의를 거부할 경우 사업비 지급을 받지 못 할 수 있습니다.</dd>
            </dl>
        </div>
    </div>
    <fieldset class="fregister_agree">
        <label for="agree12">개인정보 제3자 제공 내용에 동의합니다.</label>
        <input type="checkbox" name="agree2" value="1" id="agree12">
    </fieldset>
</div>
<div>
<관련 법령 개인정보 보호법 제 15조, 제 17조, 제 24조>
</div>

<div style="margin-top: 20px;text-align:center;">
    <input no="<?php echo $wr_id; ?>" type="button" class="btn_submit req" value="신청하기">
    <input type="button" class="btn_b03 cancel" value="취소">
</div>

<script>
$(document).ready(function() {
    $('.cancel').on('click', function() {
        window.history.back();
    });

    $('.req').on('click', function() {
        <?php if($member['mb_level'] > 1) { ?>
        if(!$('#agree11').is(':checked')) {
            alert('개인정보의 수집․이용 내용에 동의하여야 신청 가능합니다.');
            return false;
        }
        if(!$('#agree12').is(':checked')) {
            alert('개인정보 제3자 제공 내용에 동의하여야 신청 가능합니다.');
            return false;
        }

        $(this).attr('disabled', 'disabled');
        var t = $(this);
        $.ajax({
            type: "POST",
            url: g5_bbs_url+"/ajax.program_req.php",
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
                    //window.location.reload();
                    //window.history.back();
                    window.location.replace('<?php echo $url; ?>');
                }
                //console.log(data);
            }
        });
        <?php } else { ?>
        alert("로그인 후 이용하세요.\n회원이시라면 운영자의 회원가입 승인 후 이용하세요.");
        <?php } ?>
    });
});
</script>

<?php
include_once('./_tail.php');
?>
