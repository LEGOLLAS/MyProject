<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>

<div class="g_lt">
    <?php if (count($list) > 0) { ?>
    <ul style="padding: 20px 14px;">
        <?php for ($i=0; $i<count($list); $i++) {  ?>
        <li <?php if($i > 0) { ?>style="margin-left:15px;"<?php } ?>>
        <?php
        echo "<a href=\"".$list[$i]['href']."&isNew=Y\">";
        $thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], '160', '110');
        if($thumb['src']) {
            $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="190px" height="120px">';
        } else {
            $img_content = '<span style="width:'.$board['bo_gallery_width'].'px;height:'.$board['bo_gallery_height'].'px">no image</span>';
        }
        echo $img_content;
        echo "</a>";
        ?>
        <div class="title"><a href="<?php echo $list[$i]['href']; ?>&isNew=Y"><?php echo $list[$i]['subject']; ?></a></div>
        </li>
        <?php } ?>
    </ul>
    <?php } else { ?>
    <div style="margin-top: 20px; text-align:center;font-size: 14px;">등록된 사진이 없습니다.</div>
    <?php } ?>
</div>
