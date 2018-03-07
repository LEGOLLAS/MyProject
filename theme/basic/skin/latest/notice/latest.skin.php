<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>

<!-- <?php echo $bo_subject; ?> 최신글 시작 { -->
<div class="n_lt">
    <ul style="width:317px; margin:0px; padding-left:10px; list-style-type:none; height:215px;">
    <?php for ($i=0; $i<count($list); $i++) {  ?>
        <li style="float:left; padding-top:5px; padding-bottom:5px; width:240px; height:14px;">
            <?php
            echo "<a href=\"".$list[$i]['href']."\">";
            if ($list[$i]['is_notice'])
                echo "<strong>".$list[$i]['subject']."</strong>";
            else
                echo "<strong>·</strong> ". $list[$i]['subject'];

            echo "</a>";

            if (isset($list[$i]['icon_new'])) echo " " . $list[$i]['icon_new'];
             ?>
        </li>
		<li style="float:left; padding-top:5px; padding-bottom:5px; padding-right:10px; height:14px; ">
			<?=str_replace("-", ".", $list[$i]['datetime'])?>
			<div style="clear:both; height:0px; display:none;"></div>
		</li>
    <?php }  ?>
    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
    <li class="no_item"><span>게시물이 없습니다.</span></li>
    <?php }  ?>
    </ul>
</div>
<!-- } <?php echo $bo_subject; ?> 최신글 끝 -->
