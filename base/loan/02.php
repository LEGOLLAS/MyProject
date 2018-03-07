<?
include_once ("./_common.php");
include_once ("../include/header.php");

$contLeftSub = "2";
?>

<div style="clear:both; background:url('/images/sub/new/sub_background.png'); background-size:100% 100%;">
	<div style="width:1000px; margin:0px auto;">
		<img src="/images/sub/new/sub_background_center.png" />
	</div>
</div>

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
                    <li><img src="/images/common/icon_left.gif" alt="icon" title="icon" /> 대여서비스</li>
                    <li><img src="/images/common/icon_left.gif" alt="icon" title="icon" /> 도서대여 안내</li>
                </ul>

                <span><img src="/base/images/conttitle/loan2.gif" alt="도서대여 안내" title="도서대여 안내" /></span>
                <span><img src="/base/images/sub_s_title.gif" alt="배움이즐거운곳,가르침이신명나는곳!기초교육원입니다." title="배움이즐거운곳,가르침이신명나는곳!기초교육원입니다." /></span>
            </div>

<table width="100%" border="0" cellpadding="0" cellspacing="0" background="/base/images/common/tab_bg.gif" summary="탭">
<caption></caption>
  <tr>
    <td width="11%" height="29" valign="top"><a href="/base/loan/02.php"><img src="/base/images/loan_tab02_01_ov.gif" alt="서비스안내" border="0" title="서비스안내" ></a></td>
    <td width="11%" valign="top"><a href="/base/loan/02_01.php"><img src="/base/images/loan_tab02_02_out.gif" alt="보유도서" border="0" title="보유도서" ></a></td>
    <td width="78%" valign="top"><a href="/base/loan/02_02.php"><img src="/base/images/loan_tab02_03_out.gif" alt="보유영상" border="0" title="보유영상" ></a></td>
  </tr>
</table>  <br />
              

            <div id="contView">
<?
$bo_table = "contents_base";
//$wr_id = $_GET[wr_id];
$wr_id = "14";

include (__root__ . "/include/iframe.php");
?>
            </div><!-- <div id="contView"> //-->
            
        </div><!-- <div id="contR"> //-->
	</div><!-- <div id="contLayout"> //-->
    
</div><!-- <div id="pageCont"> //-->

<?
include_once ("../include/footer.php");
?>