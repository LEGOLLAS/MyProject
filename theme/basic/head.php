<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');

?>

<script type="text/javascript">
$(document).ready(function(){
	$(".floorArea li").click(function(){
		var indexVal = $(this).index();

		for(var i=0; i<4; i++) {
			if(i == indexVal) {
				$(".floorArea li:eq("+i+")").css("background-color", "#faa61a");
				$("#imageArea0" + (i + 1)).css("display", "block");
			} else {
				$(".floorArea li:eq("+i+")").css("background-color", "#929292");
				$("#imageArea0" + (i + 1)).css("display", "none");
			}
		}
	});

	$("#imageArea01 .imageArea div").click(function(){
		var indexVal = $(this).index();
		for(var i=0; i<7; i++) {
			if(i == indexVal) {
				$("#imageArea01 .imageArea div:eq("+i+")").css("background", "#6eb644");
				$("#imageBigArea01_" + (i + 1)).css("display", "block");
			} else {
				$("#imageArea01 .imageArea div:eq("+i+")").css("background", "#bce6a4");
				$("#imageBigArea01_" + (i + 1)).css("display", "none");
			}
		}
	});

	$(".soImage01_1").click(function(){
		$("#bigImage01_1").attr("src", $(this).attr("src"));
	});

	$(".soImage01_2").click(function(){
		$("#bigImage01_2").attr("src", $(this).attr("src"));
	});

	$(".soImage01_3").click(function(){
		$("#bigImage01_3").attr("src", $(this).attr("src"));
	});

	$(".soImage01_4").click(function(){
		$("#bigImage01_4").attr("src", $(this).attr("src"));
	});

	$(".soImage01_5").click(function(){
		$("#bigImage01_5").attr("src", $(this).attr("src"));
	});

	$(".soImage01_6").click(function(){
		$("#bigImage01_6").attr("src", $(this).attr("src"));
	});

	$(".soImage01_7").click(function(){
		$("#bigImage01_7").attr("src", $(this).attr("src"));
	});

	$("#imageArea02 .imageArea div").click(function(){
		var indexVal = $(this).index();
		for(var i=0; i<3; i++) {
			if(i == indexVal) {
				$("#imageArea02 .imageArea div:eq("+i+")").css("background", "#6eb644");
				$("#imageBigArea02_" + (i + 1)).css("display", "block");
			} else {
				$("#imageArea02 .imageArea div:eq("+i+")").css("background", "#bce6a4");
				$("#imageBigArea02_" + (i + 1)).css("display", "none");
			}
		}
	});

	$(".soImage02_1").click(function(){
		$("#bigImage02_1").attr("src", $(this).attr("src"));
	});

	$(".soImage02_2").click(function(){
		$("#bigImage02_2").attr("src", $(this).attr("src"));
	});

	$(".soImage02_3").click(function(){
		$("#bigImage02_3").attr("src", $(this).attr("src"));
	});

	$("#imageArea03 .imageArea div").click(function(){
		var indexVal = $(this).index();
		for(var i=0; i<7; i++) {
			if(i == indexVal) {
				$("#imageArea03 .imageArea div:eq("+i+")").css("background", "#6eb644");
				$("#imageBigArea03_" + (i + 1)).css("display", "block");
			} else {
				$("#imageArea03 .imageArea div:eq("+i+")").css("background", "#bce6a4");
				$("#imageBigArea03_" + (i + 1)).css("display", "none");
			}
		}
	});

	$(".soImage03_1").click(function(){
		$("#bigImage03_1").attr("src", $(this).attr("src"));
	});

	$(".soImage03_2").click(function(){
		$("#bigImage03_2").attr("src", $(this).attr("src"));
	});

	$(".soImage03_3").click(function(){
		$("#bigImage03_3").attr("src", $(this).attr("src"));
	});

	$(".soImage03_4").click(function(){
		$("#bigImage03_4").attr("src", $(this).attr("src"));
	});

	$(".soImage03_5").click(function(){
		$("#bigImage03_5").attr("src", $(this).attr("src"));
	});

	$(".soImage03_6").click(function(){
		$("#bigImage03_6").attr("src", $(this).attr("src"));
	});

	$(".soImage03_7").click(function(){
		$("#bigImage03_7").attr("src", $(this).attr("src"));
	});

	$("#imageArea04 .imageArea div").click(function(){
		var indexVal = $(this).index();
		for(var i=0; i<2; i++) {
			if(i == indexVal) {
				$("#imageArea04 .imageArea div:eq("+i+")").css("background", "#6eb644");
				$("#imageBigArea04_" + (i + 1)).css("display", "block");
			} else {
				$("#imageArea04 .imageArea div:eq("+i+")").css("background", "#bce6a4");
				$("#imageBigArea04_" + (i + 1)).css("display", "none");
			}
		}
	});

	$(".soImage04_1").click(function(){
		$("#bigImage04_1").attr("src", $(this).attr("src"));
	});

	$(".soImage04_2").click(function(){
		$("#bigImage04_2").attr("src", $(this).attr("src"));
	});
});
</script>


<style type="text/css">
.soTitle {
	font-size:15px; color:#5e5e5e; border:0px; text-align: left; padding: 10px 10px 10px 0px; font-weight: 700; color: #686868; word-break: keep-all;
}

.soTitle01 {
	font-size:15px; color:#ffffff; border:0px; text-align:center; padding: 10px 10px; font-weight: 700; word-break: keep-all; background:#faa61a; width:66px;
}

.soContent01 {
	font-size:15px; color:#5e5e5e; border:1px solid #dcdcdc; text-align:left; padding: 10px 10px; font-weight: 700; word-break: keep-all; background:#ffffff; width:650px;
}

.floorArea {
	border-top:1px solid #ebebeb; padding-top:10px;
}

.floorArea ul {
	list-style-type:none; margin:0px 0px 0px 0px; padding:0px;
}

.floorArea .ov {
	background:#faa61a; float:left; width:116px; padding:10px 10px; text-align:center; font-size:15px; color:white; font-weight:bold; cursor:pointer;
}

.floorArea .off {
	background:#929292; float:left; margin-left:5px; width:116px; padding:10px 10px; text-align:center; font-size:15px; color:white; font-weight:bold; cursor:pointer;
}

.left_ov {
	color:white; background:#6eb644; width:137px; padding:10px; text-align:center; font-size:15px;
}

.left_off {
	color:white; background:#bce6a4; width:137px; padding:10px; text-align:center; font-size:15px;
}

#imageArea01 .imageArea div {
	cursor:pointer;
}

#imageArea02 .imageArea div {
	cursor:pointer;
}

#imageArea03 .imageArea div {
	cursor:pointer;
}

#imageArea04 .imageArea div {
	cursor:pointer;
}

#topRight {
	 padding-top:25px; font-weight:bold;
}

#topRight .nick {
	 color:#6e6e6e;
}

#topRight a {
	 color:#6e6e6e;
}
</style>

<!-- 상단 시작 { -->
<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>
	<!--
	<div class="tmp_bg"></div>
	-->
    <div id="hd_wrapper">
		<div>
			<div id="logo">
				<a href="<?php echo G5_URL ?>"><img src="/images/Logo.png" alt="<?php echo $config['cf_title']; ?>"></a>
			</div>

			<div id="topRight" style="float:right;">
				<?php if ($is_member) {  ?>
				<?php if ($is_admin) {  ?>
				<a href="<?php echo G5_ADMIN_URL ?>" style="margin-left:15px;"><b>관리자</b></a><span style="padding:0px 5px 0px 5px"> | </span>
				<?php }  ?>
				<a href="/" style="color:#faa61a;">HOME</a><span style="padding:0px 5px 0px 5px"> | </span><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a><span style="padding:0px 5px 0px 5px"> | </span><a href="<?php echo G5_BBS_URL ?>/mypage.php">마이페이지</a><span style="padding:0px 5px 0px 5px"> | </span>
				<?php } else {  ?>
				<a href="/" style="color:#faa61a;">HOME</a><span style="padding:0px 5px 0px 5px"> | </span><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a><span style="padding:0px 5px 0px 5px"> | </span><a href="<?php echo G5_BBS_URL ?>/login.php?url=<?php echo $_SERVER['REQUEST_URI']; ?>">로그인</a><span style="padding:0px 5px 0px 5px"> | </span>
				<?php }  ?>
				<a href="/bbs/content.php?co_id=sitemap_introduce">SITEMAP</a>
			</div>

				<div style=" margin:0px auto; overflow:hidden;">
					<div style="width:1000px; margin:0px auto;">
						<div id="top_menus">
							<nav id="gnb">
								<h2>메인메뉴</h2>
								<ul id="gnb_menu">
									<?php
									$sql = " select *
												from {$g5['menu_table']}
												where me_use = '1'
												  and length(me_code) = '2'
												order by me_order, me_id ";
									$result = sql_query($sql, false);

									$menu_code = array();
									for ($i=0; $row=sql_fetch_array($result); $i++) {
										$gnb_menus[] = $row;
									?>
									<li class="main_menu_<?php echo $i; ?>" data-no="<?php echo $i; ?>">
										<a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>"><?php echo $row['me_name'] ?></a></li>
									<?php
									}
									?>
								</ul>
							</nav>
						</div>
					</div>
				</div>

			<div style="clear:both; display:none;"></div>
		</div>
    </div>
    <div class="submenu_bg">
        <div id="submenu">
            <?php
            $type = basename($_SERVER['PHP_SELF'], '.php');
            $now_menu_id = empty($_REQUEST['bo_table']) ? $_REQUEST['co_id'] : $_REQUEST['bo_table'];

            foreach ($gnb_menus as $_k=>$_v) {
                $sql2 = " select *
                            from {$g5['menu_table']}
                            where me_use = '1'
                              and length(me_code) = '4'
                              and substring(me_code, 1, 2) = '{$_v['me_code']}'
                            order by me_order, me_id ";
                $result2 = sql_query($sql2);

                $submenu = array();
                for ($k=0; $row2=sql_fetch_array($result2); $k++) {
                    $submenu[] = $row2;
                }

                foreach ($submenu as $s_k=>$s_v) {

                    if ($s_v['m_code'] == $now_menu_id) {
                        $menu_no = $_k;
                        $title = $_v['me_name'];
                        $sub_title = $s_v['me_name'];
                        $sub_me_sub_img = $s_v['me_sub_img'];
                        $select_submenu_list = $submenu;
                    }

                    if($s_k == 0)
                        echo '<ul data-no="'.$_k.'" class="submenu submenu_'.$_k.'">'.PHP_EOL;
            ?>
                <li><a<?php if ($s_v['m_code'] == $now_menu_id) { echo ' class="active"'; } ?> href="<?php echo $s_v['me_link']; ?>" target="_<?php echo $s_v['me_target']; ?>"> <?php echo $s_v['me_name'] ?></a></li>
            <?php
                }

                if($k > 0) echo '</ul>'.PHP_EOL;
            }
            ?>
        </div>
    </div>
</div>
<!-- } 상단 끝 -->

<hr>

<div class="programreq_disable_bg"></div>
<div id="programreq_info"></div>
<script>
$(document).ready(function() {
    $('#gnb_menu>li[data-no=<?php echo $menu_no; ?>]').addClass('sel');
});
</script>

<!-- 콘텐츠 시작 { -->
<?php
if (defined("_INDEX_")) {
    //메인일 경우 상단 배너를 띄운다
?>
<div id="main_banner_zone">
    <div class="main_banner" section="content">
        <div no="1" style="background-image: url(/images/main.png);">&nbsp;</div>
    </div>
</div>
<?php } else {
	if($sub_me_sub_img == "") {
		$sub_me_sub_img = "1";
	}
?>
<div id="sub_banner_zone">
    <div class="sub_banner" style="background: url(/images/sub_center0<?=$sub_me_sub_img?>.png) no-repeat 50% 50%;">

    </div>
</div>
<?php } ?>
<?php
if (defined("_INDEX_")) {
?>
<div id="main_wrapper">
<div style="background-color: #ffffff; ">

<div id="wrapper" style="margin: 0 auto; width: 1000px; zoom: 1; position: relative; background-color: #ffffff; z-index:9999999;">
    <div id="main_container">
<?php } else { ?>
<div id="sub_wrapper">
<div id="wrapper">
    <div id="aside">
        <dl>
		<?php if (empty($title)) { ?>
			<dt><div style="padding-top:50px; text-align:left; padding-left:15px;"><?php echo empty($board['bo_subject'])? $g5['title'] : $board['bo_subject']; ?></div></dt>
		<?php
			} else {
		?>
            <dt><div style="padding-top:50px; text-align:left; padding-left:15px;"><?php echo str_replace('<br>', ' ', $title); ?></div></dt>
            <?php
				foreach ($select_submenu_list as $_v) {
			?>
			<dd><a<?php if ($_v['m_code'] == $now_menu_id) { echo ' class="active"'; } ?> href="<?php echo $_v['me_link']; ?>" target="_<?php echo $_v['me_target']; ?>"><?php echo str_replace('<br>', ' ', $_v['me_name']); ?></a></dd>
			<?php } ?>
		<?php } ?>
        </dl>

    </div>
    <div id="container">
        <div id="ctt">
            <div id="container_title">
                <h1><?php echo empty($board['bo_subject']) ? $g5['title'] : $board['bo_subject']; ?></h1>
                <div id="now_loc">
				<a href="/"><img src="/images/icon_home.png" /></a>
                <?php if (empty($title)) { ?>
                        <span class="loc_sub now"> &gt; <?php echo empty($board['bo_subject']) ? $g5['title'] : $board['bo_subject']; ?></span>
                <?php } else { ?>
                        <span class="loc_sub"> &gt; <?php echo $title; ?> &gt; </span>
                        <span class="loc_sub now"><?php echo str_replace('<br>', ' ', $sub_title); ?></span>
                <?php } ?>
            </div>
        </div>
<?php } ?>
