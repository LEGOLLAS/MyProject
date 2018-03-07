<?
include_once ("./_common.php");
include_once ("../include/header.php");

$contLeftSub = "3";
?>

<div id="pageCont">

    <div id="contL">
    	
        <ul>
           	<li><img src="/base/images/common/cont_left_title.gif" alt="기초교양교육원소개" title="기초교양교육원소개" /></li>
            <li class="height30"></li>
        </ul>
        
		<? include_once ("../include/leftmenu.php"); ?>
        
	</div><!-- <div id="contL"> //-->
   	
    <div id="contLayout">
    	<div id="contR">
	        
            <div id="contSubject">
            	<? include_once(__root__ . "/include/notice.php"); ?>
                
                <ul>
                	<li><img src="/images/common/icon_home.gif" alt="HOME" title="HOME" /> HOME</li>
                    <li><img src="/images/common/icon_left.gif" alt="icon" title="icon" /> 기초교양교육원소개</li>
                    <li><img src="/images/common/icon_left.gif" alt="icon" title="icon" /> 열린공간</li>
                    <li><img src="/images/common/icon_left.gif" alt="icon" title="icon" /> 자유게시판</li>
                </ul>

                <span><img src="/base/images/conttitle/open3.gif" alt="자유게시판" title="자유게시판" /></span>
                <span><img src="/base/images/sub_s_title.gif" alt="배움이즐거운곳,가르침이신명나는곳!기초교육원입니다." title="배움이즐거운곳,가르침이신명나는곳!기초교육원입니다." /></span>
            </div>

            <div id="contView">
<!--
<a href="http://jile.jejunu.ac.kr:10780/board/bbs/board.php?bo_table=free" target="viewFrame"><img src="/images/b_board.gif" alt="이전게시판가기" title="이전게시판가기" /></a>
<br>
//-->
<?
//$bo_table = "contents_base";
//$wr_id = "";

$bo_table = "base_open_03";
$sca = "기초교양교육원"; // 기초교육원
$wr_id = $_GET[wr_id];


include (__root__ . "/include/iframe.php");
?>
            </div><!-- <div id="contView"> //-->
            
        </div><!-- <div id="contR"> //-->
	</div><!-- <div id="contLayout"> //-->
    
</div><!-- <div id="pageCont"> //-->

<?
include_once ("../include/footer.php");
?>