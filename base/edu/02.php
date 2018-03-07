<?
include_once ("./_common.php");
include_once ("../include/header.php");

$contLeftMain = "3";
$contLeftSub = "2";
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
                    <li><img src="/images/common/icon_left.gif" alt="icon" title="icon" /> 멀티미디어제작 길잡이</li>
                </ul>

                <span><img src="/base/images/conttitle/edu2.gif" alt="멀티미디어제작 길잡이" title="멀티미디어제작 길잡이" /></span>
                <span><img src="/base/images/sub_s_title.gif" alt="배움이즐거운곳,가르침이신명나는곳!기초교육원입니다." title="배움이즐거운곳,가르침이신명나는곳!기초교육원입니다." /></span>
            </div>
 
 <div><img src="/base/images/c_title/edu02_ctitle01.gif" alt="멀티미디어제작길잡이" title="멀티미디어제작길잡이" /></div><br />

            
<table width="100%" border="0" cellpadding="0" cellspacing="0" background="/base/images/common/tab_bg.gif" summary="탭">
<caption></caption>
  <tr>
    <td width="11%" height="29" valign="top"><a href="/base/edu/02.php"><img src="/base/images/edu_tab02_01_ov.gif" alt="매체TIP" border="0" title="매체TIP" ></a></td>
    <td width="89%" valign="top"><a href="/base/edu/02_01.php"><img src="/base/images/edu_tab02_02_out.gif" alt="특강&워크숍" border="0" title="특강&워크숍" ></a></td>
  </tr>
</table><br />
            

            <div id="contView">
<?
//$bo_table = "contents_base";
//$wr_id = "7";

$bo_table = "base_edu_02";
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