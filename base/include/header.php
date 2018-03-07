<?
$topmenuImg[1] = "";						// 상단 메인메뉴 선택하기

$g4_path = __root__ . "/board"; // common.php 의 상대 경로
include_once (__root__ . "/include/header.php");
include_once (__root__ . "/include/top.php");
?>
<link rel="stylesheet" type="text/css" href="/base/css/sub.css">
<link rel="stylesheet" type="text/css" href="/base/css/content.css">

<style>
#contL {
    position: absolute;
    width: 50%;
    min-width: 500px;
    margin-left: -282px;
    text-align: right;
    background: #FFF;
}

#contR {
    margin-left: 218px;
    min-height: 200px;
    background: #FFF;
}

#pageCont {
    background: #FFF;
	padding-top:20px;
}

#contL ul li.height30 {
    height: 30px;
    background:#FFF repeat-y;
}

#contLayout {
    width: 1000px;
    margin: 0px auto;
    min-height: 500px;
    background: #FFF top left repeat-y;
}

#contSubject {
    margin-bottom: 35px;
    padding-top: 30px;
}

#contSubject ul {
    text-align: right;
    width: 400px;
    list-style: none;
    height: 20px;
    float: right;
    padding-top: 3px;
}

#contSubject ul li {
    display: inline;
    margin-right: 0px;
    font-size: 95%;
}
</style>
