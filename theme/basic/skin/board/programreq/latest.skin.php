<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
global $member;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>

<!-- <?php echo $bo_subject; ?> 최신글 시작 { -->
<div class="p_lt">
    <ul>
    <?php for ($i=0; $i<count($list); $i++) {  ?>
        <li>
            <?php
            //echo $list[$i]['icon_reply']." ";
            if ($member['mb_level'] < 5) { 

            //echo "<a href=\"".$list[$i]['href']."\">";
            echo '<span class="title get_content" no="'.$list[$i]['wr_id'].'">';
            if ($list[$i]['is_notice'])
                echo "<strong>".$list[$i]['subject']."</strong>";
            else
                echo $list[$i]['subject'];

            //if ($list[$i]['comment_cnt'])
                //echo $list[$i]['comment_cnt'];

            //echo "</a>";
            echo "</span>";

            } else {
                echo "<a href=\"".$list[$i]['href']."\">";
                echo $list[$i]['subject'];
                echo "</a>";
            }

            // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
            // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

            //if (isset($list[$i]['icon_new'])) echo " " . $list[$i]['icon_new'];
            //if (isset($list[$i]['icon_hot'])) echo " " . $list[$i]['icon_hot'];
            //if (isset($list[$i]['icon_file'])) echo " " . $list[$i]['icon_file'];
            //if (isset($list[$i]['icon_link'])) echo " " . $list[$i]['icon_link'];
            //if (isset($list[$i]['icon_secret'])) echo " " . $list[$i]['icon_secret'];
            $req = 0;
            if($member['mb_no']) {
                $xx = sql_fetch("select count(*) cnt from program_req where program_id=".$list[$i]['wr_id']." and member_id='".$member['mb_no']."' and status not in ('F')");
                //echo "select count(*) from program_req where program_id=".$list[$i]['wr_id']." and member_id='".$member['mb_no']."' and status not in ('F')";
                $req = $xx['cnt'];
            }
            ?>
            <?php 
            if ($list[$i]['wr_2'] <= date('Ymd') && $list[$i]['wr_3'] >= date('Ymd') && $req < 1 && $member['mb_level'] < 5) { 
                $sql = "select count(*) cnt from program_req where program_id='".$list[$i]['wr_id']."' AND status='D'";
                $req_cnt = sql_fetch($sql);
                if ($req_cnt['cnt'] >= $list[$i]['wr_1']) {
            ?>
                <span class="btn_b03">신청마감</span>
            <?php
                } else {
            ?>
                <input no="<?php echo $list[$i]['wr_id']; ?>" class="btn_submit get_content" type="button" value="신청하기">
            <?php 
                }
            } else if ($req > 0) { 
            ?>
                <span class="btn_b02">신청완료</span>
            <?php } else if ($list[$i]['wr_2'] > date('Ymd')) { ?>
                <span class="btn_b03">신청준비</span>
            <?php } else if ($list[$i]['wr_3'] < date('Ymd')) { ?>
                <span class="btn_b03">신청마감</span>
            <?php } ?>
        </li>
    <?php }  ?>
    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
    <li class="no_item"><span>게시물이 없습니다.</span></li>
    <?php }  ?>
    </ul>
</div>

<!-- } <?php echo $bo_subject; ?> 최신글 끝 -->
<script>
$(document).ready(function() {
    $('.get_content').click(function() {
        $(this).attr('disabled', 'disabled');
        var t = $(this);
        $.ajax({
            type: "POST",
            url: g5_bbs_url+"/ajax.get_program_content.php",
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
                    $('.programreq_disable_bg').show();
                    $('#programreq_info').html(data.data).show();
                    //alert(data.msg);
                    //window.location.reload();
                    $('.cancel').on('click', function() {
                        t.removeAttr('disabled');
                        $('.programreq_disable_bg').hide();
                        $('#programreq_info').hide();
                    });

                    $('.req').on('click', function() {
                        return false;
                        <?php if($member['mb_level'] > 1) { ?>
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
                                    window.location.reload();
                                }
                                //console.log(data);
                            }
                        });
                        <?php } else { ?>
                        alert("로그인 후 이용하세요.\n회원이시라면 운영자의 회원가입 승인 후 이용하세요.");
                        <?php } ?>
                    });
                }
                //console.log(data);
            }
        });
        <?php if($member['mb_level'] > 1) { ?>
        <?php } else { ?>
        //alert("로그인 후 이용하세요.\n회원이시라면 운영자의 회원가입 승인 후 이용하세요.");
        <?php } ?>
    });
});
</script>
