<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
		 </div>
    </div>
</div>

<!-- } 콘텐츠 끝 -->

<hr>

<!-- 하단 시작 { -->

<?php
	if(defined('_INDEX_') == '1') {
?>

<style>
#pageMainBgArea {
    width: 100%;
    height: 694px;
    overflow: hidden;
    position: absolute;
	top:970px;
	z-index:1;
}

#pageMainImgBg {
    width: 1920px;
    height: 694px;
    left: 50%;
    margin-left: -960px;
    overflow: hidden;
    position: absolute;
}
</style>

<div id="pageMainBgArea">
	<div id="pageMainImgBg">
		<div style="width:100%;">
			<div id="ft" style="height:694px;">
				<div id="ft_copy">
					<div>
						<div style="padding-top: 545px;color:white;width: 700px;float:left;line-height:160%;">
							<div style="color:white;">
								개인정보보호정책&nbsp;&nbsp;|&nbsp;&nbsp;<a href="/bbs/content.php?co_id=greeting" style="color:white;">센터소개</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:alert('작업중입니다.');" style="color:white;">시설안내</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="/bbs/content.php?co_id=location_introduce" style="color:white;">오시는길</a>
							</div>
							
							(우) 63351 제주특별자치도 제주시 구좌읍 다랑쉬북로 68-92 Tel. 064)782-8963 Fax. 064)782-8964<br>
							Copyright(c)2010 by Freegine Company. All right Reserved.
						</div>

						<div style="padding-top: 545px; color:white; width:200px; float:left;">
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
</div>
<?php
if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<!-- } 하단 끝 -->

<?php
} else {
	include_once(G5_THEME_PATH."/tail.sub.php");
}
?>
