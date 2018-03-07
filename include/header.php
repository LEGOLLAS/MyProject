<?
if (!($g4_path)) $g4_path = "./board"; // common.php 의 상대 경로

include_once("$g4_path/common.php");
include_once("$g4[path]/lib/latest.lib.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>제주대학교 지역선도대학 육성사업</title>

<? if ($g4[path] == "./board") { // 메인화면?>
<link rel="stylesheet" type="text/css" href="/css/main.css">
<? } else {?>
<link rel="stylesheet" type="text/css" href="/css/sub.css">
<? } ?>

<script src="/js/FlashActivex.js" type="text/javascript"></script>
<script src="/js/javascript.js" type="text/javascript"></script>
<script src="/js/iframeResize.js" type="text/javascript"></script>
<script src="/js/menu.js" type="text/javascript"></script>
<script src="/js/zoom.js" type="text/javascript"></script>

<script>
	function loginWindowNew() {
		w = screen.width /  2 - 550 / 2;
		h = screen.Height / 2 - 273 / 2;
		data3 = "left=" + w + ",top=" + h + ",width=550,height=273,scrollbars=no";	
		window.open('/member/login.new_new.php','login', data3);
	}
</script>

<style>
#pageTopLayout {
    width: 1010px;
    height: 87px;
    margin: 0px auto;
    padding-top:0px;
}

#pageTopLayout div {
    float: right;
    padding-top: 0px;
    text-align: right;
}

#pageSubBg {
    width: 100%;
    height: 389px;
    overflow: hidden;
    position: relative;
}

#pageSubImgBg {
    width: 1920px;
    height: 389px;
    left: 50%;
    margin-left: -960px;
    overflow: hidden;
    position: relative;
}
</style>
</head>

<body>