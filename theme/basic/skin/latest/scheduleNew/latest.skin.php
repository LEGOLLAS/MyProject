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

<style>
.schedule_summary > ul > li {
    padding: 5px 0 0 5px;
    border-left: 0px;
    border-bottom: 1px solid #e5e5e5;
    margin: 5px 10px 0 10px;
}

.schedule_summary > ul > li > div.con {
    color: #757575;
	padding-top:5px;
	padding-bottom:5px;
}
</style>

<div class="schedule_summary">
<?php if (count($list) > 0) { ?>
    <ul>
    <?php for ($i=0; $i<count($list); $i++) {  ?>
        <li>
            <div class="con">
                <span class="day"><?php echo sprintf("%d", substr($list[$i]['wr_1'],4,2)).'/'; ?><?php echo sprintf("%d", substr($list[$i]['wr_1'],6,2)); ?></span>
            <?php
            //echo $list[$i]['icon_reply']." ";
            //echo "<a href=\"".$list[$i]['href']."\">";
            echo '<span class="title">';
            if ($list[$i]['is_notice'])
                echo "<strong>".$list[$i]['subject']."</strong>";
            else
                echo $list[$i]['subject'];

            /*
            if ($list[$i]['comment_cnt'])
                echo $list[$i]['comment_cnt'];
            */

            //echo "</a>";
            echo '</span>';

            // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
            // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

            //if (isset($list[$i]['icon_new'])) echo " " . $list[$i]['icon_new'];
            //if (isset($list[$i]['icon_hot'])) echo " " . $list[$i]['icon_hot'];
            //if (isset($list[$i]['icon_file'])) echo " " . $list[$i]['icon_file'];
            //if (isset($list[$i]['icon_link'])) echo " " . $list[$i]['icon_link'];
            //if (isset($list[$i]['icon_secret'])) echo " " . $list[$i]['icon_secret'];
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
