<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<?php if ($is_admin == 'super') {  ?><!-- <div style='float:left; text-align:center;'>RUN TIME : <?php echo get_microtime()-$begin_time; ?><br></div> --><?php }  ?>

<!-- ie6,7에서 사이드뷰가 게시판 목록에서 아래 사이드뷰에 가려지는 현상 수정 -->
<!--[if lte IE 7]>
<script>
$(function() {
    var $sv_use = $(".sv_use");
    var count = $sv_use.length;

    $sv_use.each(function() {
        $(this).css("z-index", count);
        $(this).css("position", "relative");
        count = count - 1;
    });
});
</script>
<![endif]-->

<style>
#ft {
    min-width: 1000px;
    border-top: 0px;
    margin-top: 0px;
    background: url(/images/copyright_sub_background.png) no-repeat;
}

#pageMainBgArea {
    width: 100%;
    height: 383px;
    overflow: hidden;
    position: absolute;
	z-index:1;
}

#pageMainImgBg {
    width: 1920px;
    height: 383px;
    left: 50%;
    margin-left: -960px;
    overflow: hidden;
    position: absolute;
}
</style>

<div>&nbsp;</div>
<div id="pageMainBgArea">
	<div id="pageMainImgBg">
		<div id="ft" style="height:383px;">
			<div id="ft_copy">
				<div>
					<div style="padding-top: 245px; color:white; padding-left:155px; width:545px; float:left; line-height:160%;">
						<div style="color:white;">
							개인정보보호정책&nbsp;&nbsp;|&nbsp;&nbsp;<a href="/bbs/content.php?co_id=greeting" style="color:white;">센터소개</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:alert('작업중입니다.');" style="color:white;">시설안내</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="/bbs/content.php?co_id=location_introduce" style="color:white;">오시는길</a>
						</div>
						
						(우) 63351 제주특별자치도 제주시 구좌읍 다랑쉬북로 68-92 Tel. 064)782-8963 Fax. 064)782-8964<br>
						Copyright(c)2010 by Freegine Company. All right Reserved.
					</div>

					<div style="padding-top: 245px; color:white; width:200px; float:left;">
						<div style="color:white;">
							<select name="" style="width:151px; height:31px;">
							<option value="">주요 사이트</option>
							</select>
						</div>

						<?=visit('basic');?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
</html>
<?php echo html_end(); // HTML 마지막 처리 함수 : 반드시 넣어주시기 바랍니다. ?>