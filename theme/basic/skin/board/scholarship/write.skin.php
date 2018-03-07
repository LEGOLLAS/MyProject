<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$sql = "
    SELECT 
        a.*, 
        b.*,
        (SELECT member_group.name FROM member_group WHERE member_group.id=a.group) AS m_group,
        IF(b.wr_10=a.group, c.wr_1, c.wr_2) AS point
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
        a.id='".$req_id."'
    ";
$program_data = sql_fetch($sql);
//print_rr($program_data);

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<section id="bo_w">

    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="wr_1" value="<?php echo $req_id; ?>">

    <div class="tbl_frm01 tbl_wrap">
        <table style="border:2px solid #999">
        <tbody>
            <tr>
                <th>장학금 종류</th>
                <td>참여학생 마일리지 장학금</td>
                <th>금 액(원)</th>
                <td><?php echo number_format($program_data['point'] * 10000);?></td>
            </tr>
            <tr>
                <th>해 당 년 도</th>
                <td colspan="3">20<input type="text" name="year" value="<?php echo $wr_9; ?>" required class="frm_input required" size="3" maxlength="2"> 년도 제 <input type="text" name="hk" value="<?php echo $wr_10; ?>" required class="frm_input required" size="2" maxlength="1"> 학기</td>
            </tr>
            <tr>
                <th>대학 / 학과</th>
                <td><?php echo $program_data['m_group'].' / '.$member['mb_3']; ?></td>
                <th>학 년</th>
                <td><?php echo $member['mb_4']; ?></td>
            </tr>
            <tr>
                <th>성 명</th>
                <td><?php echo $member['mb_name']; ?></td>
                <th>학 번</th>
                <td><?php echo $member['mb_1']; ?></td>
            </tr>
            <tr>
                <th>연 락 처</th>
                <td colspan="3"><?php echo $member['mb_hp']; ?></td>
            </tr>
            <tr>
                <th>장학금 지급 기준 및 점수</th>
                <td colspan="3">
                예) 교과과정(학점 과정)이수 - 본인 소속 이외 대학<br>
                - 점수 : <?php echo $program_data['point'];?>점<br>
                - 금액 : <?php echo $program_data['point'];?>점 × 10,000원 = <?php echo number_format($program_data['point'] * 10000);?>원
                </td>
            </tr>
            <tr>
                <th>첨 부 서 류</th>
                <td colspan="3">
                1. 신분증 및 본인통장사본 각 1부(공통).<br>
                2. 관련 증빙자료 각 1부(출석확인서, 성적표, 자격증, 방명록 등).<br>
                3. 장학생 추천서 1부(특별장학금 동의 관련 증빙자료가 없을시 첨부).<br><br>
        <?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
                <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
                <?php if($w == 'u' && $file[$i]['file']) { ?>
                <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                <?php } ?>
        <?php } ?>
                <div style="color:red">* 압축하여 10MB이하 사이즈로 업로드하세요</div>
                </td>
            </tr>

            <tr>
                <th>은 행 명</th>
                <td colspan="3"><input type="text" name="wr_11" value="<?php echo $wr_11; ?>" required class="frm_input required" size="30" maxlength="50"></td>
            </tr>
            <tr>
                <th>계 좌 번 호</th>
                <td colspan="3"><input type="text" name="wr_12" value="<?php echo $wr_12; ?>" required class="frm_input required" size="30" maxlength="50"></td>
            </tr>

            <tr>
                <td colspan="4" style="border:0;padding: 20px;">
                위와 같이 장학금을 지급받고자 서류를 첨부하여 신청하며, 만일 위 사실과 다를 경우 지급받은 장학금을 환불할 것을 서약합니다.
                </td>
            </tr>
            <tr>
                <td colspan="4" style="border:0;text-align:center;">
                <?php echo $write['wr_datetime'] ? date('Y년 n월 j일', strtotime($write['wr_datetime'])) : date('Y년 n월 j일'); ?>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="border:0;text-align: right;padding: 20px 30px;">
                신 청 인 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $member['mb_name'];?> &nbsp;&nbsp;&nbsp;(서명 또는 인)
                </td>
            </tr>
            <tr>
                <td colspan="4" style="border:0;padding: 30px 20px;font-size: 14px;font-weight: 700;">
                제주대학교 기획처장 귀하
                </td>
            </tr>

        </tbody>
        </table>
    </div>

    <div class="btn_confirm">
        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit">
        <a href="/bbs/mypage.php" class="btn_cancel">취소</a>
    </div>
    </form>

    <script>
    <?php if($write_min || $write_max) { ?>
    // 글자수 제한
    var char_min = parseInt(<?php echo $write_min; ?>); // 최소
    var char_max = parseInt(<?php echo $write_max; ?>); // 최대
    check_byte("wr_content", "char_count");

    $(function() {
        $("#wr_content").on("keyup", function() {
            check_byte("wr_content", "char_count");
        });
    });

    <?php } ?>
    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "html2";
            else
                obj.value = "html1";
        }
        else
            obj.value = "";
    }

    function fwrite_submit(f)
    {
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.wr_subject.value,
                "content": f.wr_content.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });

        if (subject) {
            alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
            f.wr_subject.focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_wr_content) != "undefined")
                ed_wr_content.returnFalse();
            else
                f.wr_content.focus();
            return false;
        }

        if (document.getElementById("char_count")) {
            if (char_min > 0 || char_max > 0) {
                var cnt = parseInt(check_byte("wr_content", "char_count"));
                if (char_min > 0 && char_min > cnt) {
                    alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                    return false;
                }
                else if (char_max > 0 && char_max < cnt) {
                    alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                    return false;
                }
            }
        }

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->
