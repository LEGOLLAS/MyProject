<?
include_once ("./_common.php");
include_once ("../include/header.php");

$contLeftMain = "3";
$contLeftSub = "5";
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
                    <li><img src="/images/common/icon_left.gif" alt="icon" title="icon" /> 창작공간'창공'</li>
              </ul>

                <span><img src="/base/images/conttitle/edu5.gif" alt="창작공간'창공'" title="창작공간'창공" /></span>
                <span><img src="/base/images/sub_s_title.gif" alt="배움이즐거운곳,가르침이신명나는곳!기초교육원입니다." title="배움이즐거운곳,가르침이신명나는곳!기초교육원입니다." /></span>
            </div>
 
 <div><img src="/base/images/c_title/edu05_ctitle01.gif" alt="창작공간'창공'" title="창작공간'창공" /></div><br />
<span><img src="/base/images/c_title/edu05_03_ctitle01.gif" alt="신청하기'" title="신청하기" /></span><br />


<!--table width="100%" border="0" cellpadding="0" cellspacing="0" background="/base/images/common/tab_bg.gif" summary="탭">
<caption></caption>
  <tr>
    <td width="11%" height="29" valign="top"><a href="/base/edu/05.php"><img src="/base/images/edu_tab05_01_ov.gif" alt="소개" border="0" title="소개" ></a></td>
    <td width="11%" valign="top"><a href="/base/edu/05_01.php"><img src="/base/images/edu_tab05_02_out.gif" alt="포트폴리오" border="0" title="포트폴리오" ></a></td>
    <td width="78%" valign="top"><a href="/base/edu/05_021.php"><img src="/base/images/edu_tab05_03_out.gif" alt="창공의방" border="0" title="창공의방" ></a></td>
  </tr>
</table-->

            <div id="contView">
<?
$bo_table = "contents_base";
//$wr_id = $_GET[wr_id];
$wr_id = "";

include (__root__ . "/include/iframe.php");
?>
            </div><!-- <div id="contView"> //-->
            
        </div><!-- <div id="contR"> //-->
	</div><!-- <div id="contLayout"> //-->
    
</div><!-- <div id="pageCont"> //-->

<?
include_once ("../include/footer.php");
?>