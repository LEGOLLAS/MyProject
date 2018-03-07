<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
//include_once(G5_LIB_PATH.'/thumbnail.lib.php');

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
        a.id='".$view['wr_1']."'
    ";
$program_data = sql_fetch($sql);

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 게시물 읽기 시작 { -->

<article id="bo_v" style="width:600px;margin: 30px auto;">

    <h2>지역선도대학 육성사업</h2>
    <h3>장학금 신청서</h3>

    <div class="tbl_frm01 tbl_wrap">
    <?php
    if ($_GET['pdf'] != 'Y') {
    ?>

        <div style="text-align: right;">
            <a href="/bbs/show_pdf.php?id=<?php echo $view['wr_1']; ?>&pdf=Y" style="color: blue;" target="_blank">PDF 다운받기</a>
        </div>
    <?php
    }
    ?>
        <table style="border:2px solid #999">
        <tbody>
            <tr>
                <th>장학금 종류</th>
                <td>참여학생 마일리지 장학금</td>
                <th>금 액(원)</th>
                <td><?php echo number_format($view['wr_2']);?></td>
            </tr>
            <tr>
                <th>해 당 년 도</th>
                <td colspan="3"><?php echo $view['wr_3']; ?></td>
            </tr>
            <tr>
                <th>대학 / 학과</th>
                <td><?php echo $view['wr_4']; ?></td>
                <th>학 년</th>
                <td><?php echo $view['wr_5']; ?></td>
            </tr>
            <tr>
                <th>성 명</th>
                <td><?php echo $view['wr_6']; ?></td>
                <th>학 번</th>
                <td><?php echo $view['wr_7']; ?></td>
            </tr>
            <tr>
                <th>연 락 처</th>
                <td colspan="3"><?php echo $view['wr_8']; ?></td>
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

                <?php
                if ($view['file']['count'] && $_GET['pdf'] != 'Y') {
                    $cnt = 0;
                    for ($i=0; $i<count($view['file']); $i++) {
                        if (isset($view['file'][$i]['source']) && $view['file'][$i]['source']/* && !$view['file'][$i]['view']*/)
                            $cnt++;
                    }
                }
                ?>

                <?php if($cnt) { ?>
                <!-- 첨부파일 시작 { -->
                <section id="bo_v_file">
                    <h2>첨부파일</h2>
                    <ul>
                    <?php
                    // 가변 파일
                    for ($i=0; $i<count($view['file']); $i++) {
                        if (isset($view['file'][$i]['source']) && $view['file'][$i]['source']/* && !$view['file'][$i]['view']*/) {
                     ?>
                        <li>
                            <a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
                                <img src="<?php echo $board_skin_url ?>/img/icon_file.gif" alt="첨부">
                                <strong><?php echo $view['file'][$i]['source'] ?></strong>
                                <?php echo $view['file'][$i]['content'] ?> (<?php echo $view['file'][$i]['size'] ?>)
                            </a>
                        </li>
                    <?php
                        }
                    }
                     ?>
                    </ul>
                </section>
                <!-- } 첨부파일 끝 -->
                <?php } ?>
                </td>
            </tr>

            <tr>
                <th>은 행 명</th>
                <td colspan="3"><?php echo $view['wr_11']; ?></td>
            </tr>
            <tr>
                <th>계 좌 번 호</th>
                <td colspan="3"><?php echo $view['wr_12']; ?></td>
            </tr>

            <tr>
                <td colspan="4" style="border:0;padding: 20px;text-indent: 14px;">
                위와 같이 장학금을 지급받고자 서류를 첨부하여 신청하며, 만일 위 사실과 다를 경우 지급받은 장학금을 환불할 것을 서약합니다.
                </td>
            </tr>
            <tr>
                <td colspan="4" style="border:0;text-align:center;">
                <?php echo date('Y년 n월 j일', strtotime($view['wr_datetime'])); ?>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="border:0;text-align: right;padding: 20px 30px;">
                신 청 인 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $view['wr_6'];?> &nbsp;&nbsp;&nbsp;(서명 또는 인)
                </td>
            </tr>
            <tr>
                <td colspan="4" style="border:0;padding: 30px 20px;font-size: 16px;font-weight: 700;">
                제주대학교 기획처장 귀하
                </td>
            </tr>

        </tbody>
        </table>
    </div>

</article>
<!-- } 게시판 읽기 끝 -->
