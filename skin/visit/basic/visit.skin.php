<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

global $is_admin;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
//add_stylesheet('<link rel="stylesheet" href="'.$visit_skin_url.'/style.css">', 0);
?>
<style>
#divVisit {float: left; width:151px !important; font-size:1em; text-align:right;}

#divVisit dl {
    float: left;
    width: 100%;
	margin:0px;
}
#divVisit dl dt {
    width: 37px;
	float:left;
	padding:1px 1px;
	border-radius:5px;
	font-weight:bold;
	color: white;
}
#divVisit dl dd {
    float: left;
    padding: 0px;
    margin: 0px;
	color: white;
	width:151px !important;
}
</style>

<div id="divVisit" style="padding:0px; line-height:160%;">
    <dl>
        <dd>Today : <?=number_format($visit[1])?></dd>
    </dl>
    <dl>
        <dd>Total : <?=number_format($visit[4])?></dd>
    </dl>
</div>