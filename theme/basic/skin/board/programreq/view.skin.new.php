<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
//include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$sql = "SELECT * from g5_write_setting_1 where wr_id='".$view['wr_9']."'";
$row = sql_fetch($sql);

$sql = "SELECT * from member_group where id='".$view['wr_10']."'";
$row_1 = sql_fetch($sql);

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 게시물 읽기 시작 { -->
<article id="bo_v" style="width:<?php echo $width; ?>">
    <ul>
        <li>주관대학 : <?php echo $row_1['name']; ?></li>
        <li>평가기준 : <?php echo $row['wr_subject']; ?></li>
        <li>프로그램명 : <?php echo $view['wr_subject']; ?></li>
        <li>정원 : <?php echo $view['wr_1']; ?></li>
        <li>접수기간 : <?php echo $view['wr_2'].' ~ '.$view['wr_3']; ?></li>
        <li>종료여부 : <?php echo $view['wr_4']; ?></li>
        <li>소속이외학생점수 : <?php echo $row['wr_2']; ?></li>
        <li>소속학생점수 : <?php echo $row['wr_1']; ?></li>
    </ul>
<?php /*
    <header>
        <h1 id="bo_v_title">
            <?php
            if ($category_name) echo $view['ca_name'].' | '; // 분류 출력 끝
            echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력
            ?>
        </h1>
    </header>

    <section id="bo_v_info">
        <h2>페이지 정보</h2>
        작성자 <strong><?php echo $view['name'] ?><?php if ($is_ip_view) { echo "&nbsp;($ip)"; } ?></strong>
        <span class="sound_only">작성일</span><strong><?php echo date("y-m-d H:i", strtotime($view['wr_datetime'])) ?></strong>
        조회<strong><?php echo number_format($view['wr_hit']) ?>회</strong>
        댓글<strong><?php echo number_format($view['wr_comment']) ?>건</strong>
    </section>

    <?php
    if ($view['file']['count']) {
        $cnt = 0;
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
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
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
         ?>
            <li>
                <a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
                    <img src="<?php echo $board_skin_url ?>/img/icon_file.gif" alt="첨부">
                    <strong><?php echo $view['file'][$i]['source'] ?></strong>
                    <?php echo $view['file'][$i]['content'] ?> (<?php echo $view['file'][$i]['size'] ?>)
                </a>
                <span class="bo_v_file_cnt"><?php echo $view['file'][$i]['download'] ?>회 다운로드</span>
                <span>DATE : <?php echo $view['file'][$i]['datetime'] ?></span>
            </li>
        <?php
            }
        }
         ?>
        </ul>
    </section>
    <!-- } 첨부파일 끝 -->
    <?php } ?>

    <?php
    if ($view['link']) {
     ?>
     <!-- 관련링크 시작 { -->
    <section id="bo_v_link">
        <h2>관련링크</h2>
        <ul>
        <?php
        // 링크
        $cnt = 0;
        for ($i=1; $i<=count($view['link']); $i++) {
            if ($view['link'][$i]) {
                $cnt++;
                $link = cut_str($view['link'][$i], 70);
         ?>
            <li>
                <a href="<?php echo $view['link_href'][$i] ?>" target="_blank">
                    <img src="<?php echo $board_skin_url ?>/img/icon_link.gif" alt="관련링크">
                    <strong><?php echo $link ?></strong>
                </a>
                <span class="bo_v_link_cnt"><?php echo $view['link_hit'][$i] ?>회 연결</span>
            </li>
        <?php
            }
        }
         ?>
        </ul>
    </section>
    <!-- } 관련링크 끝 -->
    <?php } ?>

    <section id="bo_v_atc">
        <h2 id="bo_v_atc_title">본문</h2>

        <?php
        // 파일 출력
        $v_img_count = count($view['file']);
        if($v_img_count) {
            echo "<div id=\"bo_v_img\">\n";

            for ($i=0; $i<=count($view['file']); $i++) {
                if ($view['file'][$i]['view']) {
                    //echo $view['file'][$i]['view'];
                    echo get_view_thumbnail($view['file'][$i]['view']);
                }
            }

            echo "</div>\n";
        }
         ?>

        <!-- 본문 내용 시작 { -->
        <div id="bo_v_con"><?php echo get_view_thumbnail($view['content']); ?></div>
        <?php//echo $view['rich_content']; // {이미지:0} 과 같은 코드를 사용할 경우 ?>
        <!-- } 본문 내용 끝 -->

        <?php if ($is_signature) { ?><p><?php echo $signature ?></p><?php } ?>

        <!-- 스크랩 추천 비추천 시작 { -->
        <?php if ($scrap_href || $good_href || $nogood_href) { ?>
        <div id="bo_v_act">
            <?php if ($scrap_href) { ?><a href="<?php echo $scrap_href;  ?>" target="_blank" class="btn_b01" onclick="win_scrap(this.href); return false;">스크랩</a><?php } ?>
            <?php if ($good_href) { ?>
            <span class="bo_v_act_gng">
                <a href="<?php echo $good_href.'&amp;'.$qstr ?>" id="good_button" class="btn_b01">추천 <strong><?php echo number_format($view['wr_good']) ?></strong></a>
                <b id="bo_v_act_good"></b>
            </span>
            <?php } ?>
            <?php if ($nogood_href) { ?>
            <span class="bo_v_act_gng">
                <a href="<?php echo $nogood_href.'&amp;'.$qstr ?>" id="nogood_button" class="btn_b01">비추천  <strong><?php echo number_format($view['wr_nogood']) ?></strong></a>
                <b id="bo_v_act_nogood"></b>
            </span>
            <?php } ?>
        </div>
        <?php } else {
            if($board['bo_use_good'] || $board['bo_use_nogood']) {
        ?>
        <div id="bo_v_act">
            <?php if($board['bo_use_good']) { ?><span>추천 <strong><?php echo number_format($view['wr_good']) ?></strong></span><?php } ?>
            <?php if($board['bo_use_nogood']) { ?><span>비추천 <strong><?php echo number_format($view['wr_nogood']) ?></strong></span><?php } ?>
        </div>
        <?php
            }
        }
        ?>
        <!-- } 스크랩 추천 비추천 끝 -->
    </section>

    <?php
    //include_once(G5_SNS_PATH."/view.sns.skin.php");
    ?>

    <?php
    // 코멘트 입출력
    //include_once(G5_BBS_PATH.'/view_comment.php');
     ?>
*/ ?>

    <!-- 링크 버튼 시작 { -->
    <div id="bo_v_bot">
        <?php if ($prev_href || $next_href) { ?>
        <ul class="bo_v_nb">
            <?php if ($prev_href) { ?><li><a href="<?php echo $prev_href ?>&isNew=Y" class="btn_b01">이전글</a></li><?php } ?>
            <?php if ($next_href) { ?><li><a href="<?php echo $next_href ?>&isNew=Y" class="btn_b01">다음글</a></li><?php } ?>
        </ul>
        <?php } ?>

        <ul class="bo_v_com">
            <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>&isNew=Y" class="btn_b01">수정</a></li><?php } ?>
            <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>&isNew=Y" class="btn_b01" onclick="del(this.href); return false;">삭제</a></li><?php } ?>
            <?php if ($copy_href) { ?><li><a href="<?php echo $copy_href ?>&isNew=Y" class="btn_admin" onclick="board_move(this.href); return false;">복사</a></li><?php } ?>
            <?php if ($move_href) { ?><li><a href="<?php echo $move_href ?>&isNew=Y" class="btn_admin" onclick="board_move(this.href); return false;">이동</a></li><?php } ?>
            <?php if ($search_href) { ?><li><a href="<?php echo $search_href ?>&isNew=Y" class="btn_b01">검색</a></li><?php } ?>
            <li><a href="<?php echo './programreq.php?bo_table='.$bo_table.'&amp;page='.$page ?>&isNew=Y" class="btn_b01">목록</a></li>
            <?php /* if ($reply_href) { ?><li><a href="<?php echo $reply_href ?>&isNew=Y" class="btn_b01">답변</a></li><?php } */ ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>&isNew=Y" class="btn_b02">글쓰기</a></li><?php } ?>
        </ul>
    </div>
    <!-- } 링크 버튼 끝 -->

</article>
<!-- } 게시판 읽기 끝 -->

<script>
<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
    $("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }

        var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

        if(confirm(msg)) {
            var href = $(this).attr("href")+"&js=on";
            $(this).attr("href", href);

            return true;
        } else {
            return false;
        }
    });
});
<?php } ?>

function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
</script>

<script>
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 추천, 비추천
    $("#good_button, #nogood_button").click(function() {
        var $tx;
        if(this.id == "good_button")
            $tx = $("#bo_v_act_good");
        else
            $tx = $("#bo_v_act_nogood");

        excute_good(this.href, $(this), $tx);
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
});

function excute_good(href, $el, $tx)
{
    $.post(
        href,
        { js: "on" },
        function(data) {
            if(data.error) {
                alert(data.error);
                return false;
            }

            if(data.count) {
                $el.find("strong").text(number_format(String(data.count)));
                if($tx.attr("id").search("nogood") > -1) {
                    $tx.text("이 글을 비추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                } else {
                    $tx.text("이 글을 추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                }
            }
        }, "json"
    );
}
</script>
<!-- } 게시글 읽기 끝 -->

<style>
    form > dl {
        margin: 0;
        padding: 0;
    }
    form > dl:after {
    display:block;visibility:hidden;clear:both;content:""
    }
    form > dl > dd {
        float: left;
        margin-left: 15px;
    }
    form > dl > dd:first-child {
        margin-left: 0px;
    }
</style>
<div style="border-top: 1px solid #e5e5e5;border-bottom: 1px solid #e5e5e5;margin-bottom: 5px;padding: 10px;">
    <form method="get" action="/bbs/board.php">
		<input type="hidden" name="isNew" value="Y">
        <input type="hidden" name="bo_table" value="programreq">
        <input type="hidden" name="wr_id" value="<?php echo $view['wr_id']; ?>">
        <dl>
            <dd>
                신청상태  
                <select name="s1">
                    <option value="">전체</option>
                    <?php foreach($g5['status'] as $_key=>$_val) { ?>
                        <option value="<?php echo $_key; ?>"<?php if($_key == $_GET['s1']) { echo ' selected'; } ?>><?php echo $_val; ?></option>
                    <?php } ?>
                </select>
            </dd>

            <dd>
                장학금상태  
                <select name="s2">
                    <option value="">전체</option>
                    <?php foreach($g5['status2'] as $_key=>$_val) { ?>
                        <option value="<?php echo $_key; ?>"<?php if($_key == $_GET['s2']) { echo ' selected'; } ?>><?php echo $_val; ?></option>
                    <?php } ?>
                </select>
            </dd>
        </dl>
        <div style="text-align:center;margin-top: 5px;padding-top: 5px;">
            <input type="submit" value="검색" class="btn_submit">
            <a href="/bbs/board.php?bo_table=programreq&wr_id=<?php echo $view['wr_id']; ?>&isNew=Y" class="btn_b03">초기화</a>
        </div>
    </form>
</div>

<div style="text-align:right;">
<a class="btn_admin" href="/excel/excel_program_req.php?wr_id=<?php echo $view['wr_id']; ?>&s1=<?php echo $_GET['s1']; ?>&s2=<?php echo $_GET['s2']; ?>">Excel</a>
</div>
<?php
$sql = "SELECT * FROM member_group";
$result = sql_query($sql);
while ($row = sql_fetch_array($result)) {
    $group_list[$row['id']] = $row['name'];
}

$wheres = [];
if ($_GET['s1']) {
    $wheres[] = "a.status='".$_GET['s1']."'";
}
if ($_GET['s2']) {
    $wheres[] = "a.status2='".$_GET['s2']."'";
}

if ($wheres) {
    $wh = ' and '.implode(' and ', $wheres);
}

$sql = "SELECT * FROM program_req a left join g5_member b on (a.member_id=b.mb_no) WHERE a.program_id='".$view['wr_id']."'".$wh;

$result = sql_query($sql);
$req_list = array();
while ($row = sql_fetch_array($result)) {
    $req_list[] = $row;
}
//echo '<pre>';
//print_r($req_list);
//echo '</pre>';

?>
<div class="programreq">
<table>
    <tr>
        <th style="width:50px;">No</th>
        <th style="width:100px;">이름</th>
        <th style="width:180px;">학교</th>
        <th style="width:150px;">학과</th>
        <th style="width:120px;">학번</th>
        <th style="width:100px;">학년</th>
        <th style="width:100px;">생년월일</th>
        <th style="width:180px;">연락처</th>
        <th style="width:200px;">이메일</th>
        <th style="width:100px;">신청상태</th>
        <th style="width:100px;">장학금</th>
        <th style="width:50px;"></th>
    </tr>
<?
$cnt = 1;
if(count($req_list) > 0) {
if($member['mb_id'] == $view['mb_id'] || $is_admin) {
    foreach($req_list as $_v) {
?>
    <tr>
        <td><?php echo $cnt++; ?></td>
        <td><?php echo $_v['mb_name']; ?></td>
        <td><?php echo $group_list[$_v['mb_2']]; ?></td>
        <td><?php echo $_v['mb_3']; ?></td>
        <td><?php echo $_v['mb_1']; ?></td>
        <td><?php echo $_v['mb_4']; ?></td>
        <td><?php echo $_v['mb_5']; ?></td>
        <td><?php echo $_v['mb_hp']; ?></td>
        <td><?php echo $_v['mb_email']; ?></td>
        <td>
        <select class="status" no="<?php echo $_v['id']; ?>">
        <?php foreach($g5['status'] as $_key=>$_val) { ?>
            <option value="<?php echo $_key; ?>"<?php if($_key == $_v['status']) { echo ' selected'; } ?>><?php echo $_val; ?></option>
        <?php } ?>
        </select>
        </td>
        <td>
        <select class="status2" no="<?php echo $_v['id']; ?>">
        <?php foreach($g5['status2'] as $_key=>$_val) { ?>
            <option value="<?php echo $_key; ?>"<?php if($_key == $_v['status2']) { echo ' selected'; } ?>><?php echo $_val; ?></option>
        <?php } ?>
        </select>
        </td>
        <td>
        <?php 
		/*
        if (in_array($_v['status2'], array('D', 'A'))) {
            echo '<a href="/bbs/show_pdf.php?id='.$_v['id'].'" target="_blank">보기</a>';
        } 
		*/
        ?>
			<nobr><a href="/print/programreq_info.php?wr_id=<?=$wr_id?>&mb_id=<?=$_v['mb_no']?>" target="_blank">신청서</a></nobr>
        </td>
    </tr>
<?php
    }
} else {
    foreach($req_list as $_v) {
?>
    <tr>
        <td><?php echo $cnt++; ?></td>
        <td><?php echo $_v['mb_name']; ?></td>
        <td><?php echo $group_list[$_v['mb_2']]; ?></td>
        <td><?php echo $_v['mb_3']; ?></td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td><?php echo $g5['status'][$_v['status']]; ?></td>
        <td><?php echo $g5['status2'][$_v['status2']]; ?></td>
        <td></td>
    </tr>
<?php
    }
}
} else {
?>
    <tr>
        <td colspan="12">신청리스트가 없습니다.</td>
    </tr>
<?php } ?>
</table>
</div>
<?php
if(count($req_list) > 0) {
    if($member['mb_id'] == $view['mb_id'] || $is_admin) {
?>

<div style="margin-top: 15px;">
    <form method="post" action="/bbs/change_status.php">
        <input type="hidden" name="id" value="<?php echo $view['wr_id']; ?>">
        <input type="hidden" name="status" value="<?php echo $view['wr_4']; ?>">
        <input type="hidden" name="isNew" value="Y">
        <?php 
        if ($view['wr_4'] == 'N') { 
            //프로그램 진행중일 경우 신청상태만 변경 가능
        ?>
        <div style="text-align:center;">
            신청상태  
            <select name="s1">
                <option value=""></option>
                <?php foreach($g5['status'] as $_key=>$_val) { ?>
                    <option value="<?php echo $_key; ?>"><?php echo $_val; ?></option>
                <?php } ?>
            </select>
            를
            <select name="s2">
                <option value=""></option>
                <?php foreach($g5['status'] as $_key=>$_val) { ?>
                    <option value="<?php echo $_key; ?>"><?php echo $_val; ?></option>
                <?php } ?>
            </select>
            로 일괄 변경하기
        </div>
        <?php 
        } else { 
            //프로그램 진행 종료일 경우 장학금상태만 변경 가능
        ?>
        <div style="text-align:center;">
            장학금상태  
            <select name="s1">
                <option value=""></option>
                <?php foreach($g5['status2'] as $_key=>$_val) { ?>
                    <option value="<?php echo $_key; ?>"><?php echo $_val; ?></option>
                <?php } ?>
            </select>
            를
            <select name="s2">
                <option value=""></option>
                <?php foreach($g5['status2'] as $_key=>$_val) { ?>
                    <option value="<?php echo $_key; ?>"><?php echo $_val; ?></option>
                <?php } ?>
            </select>
            로 일괄 변경하기
        </div>
        <?php 
        } 
        ?>
        <div style="margin-top: 10px; text-align: center;">
            <input type="submit" value="변경하기" class="btn_submit">
        </div>
    </form>
</div>

<?php
    }
}
?>

<script>
$(document).ready(function() {
    $('select.status').change(function() {
        $.ajax({
            type: "POST",
            url: g5_bbs_url+"/ajax.program_req_change_status.php",
            data: {
                "id": $(this).attr('no'),
                "status": $(this).val()
            },
            cache: false,
            async: true,
            dataType: 'json',
            success: function(data) {
                if(data.status == 'error') {
                    alert(data.msg);
                } else {
                    //alert(data.msg);
                }
                //console.log(data);
            }
        });
    });

    $('select.status2').change(function() {
        $.ajax({
            type: "POST",
            url: g5_bbs_url+"/ajax.program_req_change_status2.php",
            data: {
                "id": $(this).attr('no'),
                "status": $(this).val()
            },
            cache: false,
            async: true,
            dataType: 'json',
            success: function(data) {
                if(data.status == 'error') {
                    alert(data.msg);
                } else {
                    //alert(data.msg);
                }
                //console.log(data);
            }
        });
    });
});
</script>
