<?
include_once ("./_common.php");
include_once ("../include/header.php");

$contLeftMain = "3";
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
                    <li><img src="/images/common/icon_left.gif" alt="icon" title="icon" /> 교육매체지원</li>
                    <li><img src="/images/common/icon_left.gif" alt="icon" title="icon" /> 템플릿자료실</li>
                </ul>

                <span><img src="/base/images/conttitle/edu3.gif" alt="템플릿자료실" title="템플릿자료실" /></span>
                <span><img src="/base/images/sub_s_title.gif" alt="배움이즐거운곳,가르침이신명나는곳!기초교육원입니다." title="배움이즐거운곳,가르침이신명나는곳!기초교육원입니다." /></span>
            </div>
 
<?
$bo_table = "contents_base";
//$wr_id = $_GET[wr_id];
$wr_id = "34";

include (__root__ . "/include/iframe.php");
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0" background="/base/images/common/tab_bg.gif" summary="탭">
<caption></caption>
  <tr>
    <td width="7%" height="29" valign="top"><a href="/base/edu/03.php"><img src="/base/images/edu_tab03_01_out.gif" alt="개요" border="0" title="개요" ></a></td>
    <td width="7%" valign="top"><a href="/base/edu/03_01.php"><img src="/base/images/edu_tab03_02_out.gif" alt="PPT템플릿" border="0" title="PPT템플릿" ></a></td>
    <td width="7%" valign="top"><a href="/base/edu/03_02.php"><img src="/base/images/edu_tab03_03_out.gif" alt="PPT다이어그램" border="0" title="PPT다이어그램" ></a></td>
    <td width="7%" valign="top"><a href="/base/edu/03_03.php"><img src="/base/images/edu_tab03_04_out.gif" alt="제주대템플릿" border="0" title="제주대템플릿" ></a></td>
    <td width="8%" valign="top"><a href="/base/edu/03_04.php"><img src="/base/images/edu_tab03_05_out.gif" alt="이미지자료실" border="0" title="이미지자료실" ></a></td>
    <td width="64%" valign="top"><a href="/base/edu/03_05.php"><img src="/base/images/edu_tab03_06_ov.gif" alt="나눔의방" border="0" title="나눔의방" ></a></td>
  </tr>
</table><br />

            <div id="contView">
<?
//$bo_table = "contents_base";
//$wr_id = "";

$bo_table = "base_edu_03_05";
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