<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$week_name = array(
0=> '일요일',
1=> '월요일',
2=> '화요일',
3=> '수요일',
4=> '목요일',
5=> '금요일',
6=> '토요일'
);

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>

<div class="schedule_summary">
<?php if (count($list) > 0) { ?>
    <ul>
    <?php for ($i=0; $i<count($list); $i++) {  ?>
        <li>
            <div class="y_w">
                <?php 
                $week = date('w', mktime(0,0,0,substr($list[$i]['wr_1'],4,2),substr($list[$i]['wr_1'],6,2),substr($list[$i]['wr_1'],0,4))); 
                echo sprintf("%d", substr($list[$i]['wr_1'],4,2)).'/'.$week_name[$week];
                ?>
            </div>
            <div class="con">
                <span class="day"><?php echo sprintf("%d", substr($list[$i]['wr_1'],6,2)); ?></span>
            <?php
            echo '<span class="title">';
            if ($list[$i]['is_notice'])
                echo "<strong>".$list[$i]['subject']."</strong>";
            else
                echo $list[$i]['subject'];
            echo '</span>';
             ?>
                <span class="more_cnt">+<?php echo $list[$i]['cnt'] - 1; ?>개</span>
            </div>
        </li>
    <?php }  ?>
    </ul>
<?php } else { ?>
    <div class="no_item">등록된 일정이 없습니다.</div>
<?php } ?>
</div>
