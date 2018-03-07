<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>
<div id="main_content">
	<!-- 공지사항 -->
	<div class="notice">
		<div class="header">
			<img src="/images/main_bullet.png" /> 
			<a href="/bbs/content.php?co_id=greeting" class="btn_more">+</a>
		</div>
		
		<div class="notice_content show">
			<a href="/bbs/content.php?co_id=greeting"><img src="/images/jejuatopy_center_01.png" /></a>
		</div>
	</div>
	<!-- 프로그램 참여 신청 -->
	<div class="program">
		<div class="header">
			<img src="/images/main_bullet.png" /> 추천프로그램 안내
			<a href="javascript:alert('준비중입니다.');" class="btn_more">+</a>
		</div>
		<div class="notice_content show">
			<a href="javascript:alert('준비중입니다.');"><img src="/images/jejuatopy_center_02.png" /></a>
		</div>
	</div>
	<!-- 자료실 -->
	<div class="file">
		<div class="header">
			<img src="/images/main_bullet.png" /> 온라인예약하기
			<a href="javascript:alert('준비중입니다.');" class="btn_more">+</a>
		</div>

		<div class="notice_content show">
			<a href="javascript:alert('준비중입니다.');"><img src="/images/jejuatopy_center_03.png" /></a>
		</div>
	</div>
	<!-- 공지사항 -->
	<div class="notice">
		<div class="header">
			<img src="/images/main_bullet.png" /> 공지사항
			<a href="/bbs/board.php?bo_table=notice" class="btn_more">+</a>
		</div>
		
		<div class="notice_content show"><?php echo latest("theme/notice", "notice", 7, 18); ?></div>
	</div>
	<!-- 이러닝 링크 -->
	<div class="program">
		<div class="header">
			<img src="/images/main_bullet.png" /> 숲치유 프로그램
			<a href="/bbs/program_view.php?bo_table=programs&wr_id=5" class="btn_more">+</a>
		</div>
		<div class="notice_content show">
			<a href="/bbs/program_view.php?bo_table=programs&wr_id=5"><img src="/images/jejuatopy_center_04.png" /></a>
		</div>
	</div>
	<!-- Q&A -->
	<div class="file">
		<div class="header">
			<img src="/images/main_bullet.png" /> 어떻게 가요?
			<a href="/bbs/content.php?co_id=location_introduce" class="btn_more">+</a>
		</div>

		<div class="notice_content show">
			<a href="/bbs/content.php?co_id=location_introduce"><img src="/images/jejuatopy_center_05_new.png" /></a>
		</div>
	</div>
</div>
    </div>
</div>

</div>
<div class="link_zone">
    <div>
        <p class="baLink">
            <a href="#" onclick="banL2.direction = 0; banL2.resume(); return false;"><img src="/images/il_stop.png" style="border:1px solid #ebebeb;" /></a><a href="#" onclick="banL2.direction = 2; banL2.resume(); return false;"><img src="/images/banner_right_button.png" style="border:1px solid #ebebeb;" /></a>
        </p>
        <p class="baList" id="banList2">
			<a href="http://www.me.go.kr/home/web/main.do" target="_blank"><img src="/images/banner_01.png" /></a>
			<img src="/images/banner_02.png" />
			<a href="http://www.kaaf.org/" target="_blank"><img src="/images/banner_03.png" /></a>
			<a href="http://www.kapard.or.kr/" target="_blank"><img src="/images/banner_04.png" /></a>
			<a href="http://www.allergy.or.kr/" target="_blank"><img src="/images/banner_05.png" /></a>
        </p>

<script type="text/javascript" src="/js/rolling.js"></script>
<script type="text/javascript" src="/js/jis.js"></script>
<script>

var banL2 = null;
$(document).ready(function() {
    banL2 = new js_rolling('banList2');
    banL2.set_direction(4);
    banL2.time_dealy = 20;
    banL2.time_dealy_pause = 0;
    setTimeout('banL2.start()', 2000);

    $('div.notice > div.header > ul.tabBar > li > a').click(function() {
        $('div.notice > div.header > ul.tabBar > li > a').removeClass('nowTab');
        $(this).addClass('nowTab');
        var index = $( 'div.notice > div.header > ul.tabBar > li ' ).index( $(this).parent() );
        $('div.notice > div.notice_content').hide();
        $('div.notice > div.notice_content').eq(index).show();
        return false;
    });

    $('div.file > div.header > ul.tabBar > li > a').click(function() {
        $('div.file > div.header > ul.tabBar > li > a').removeClass('nowTab');
        $(this).addClass('nowTab');
        var index = $( 'div.file > div.header > ul.tabBar > li ' ).index( $(this).parent() );
        $('div.file > div.notice_content').hide();
        $('div.file > div.notice_content').eq(index).show();
        return false;
    });
});

</script>
<script>
$(document).ready(function() {
    $('#main_banner_zone').jis({'rolling':true, 'type':'fade'});
});
</script>
<?php

if(defined('_INDEX_') == '1') {
	include_once(G5_THEME_PATH.'/tail.php');
}
?>
