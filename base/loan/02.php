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
           	<li><img src="/base/images/common/cont_left_title.gif" alt="���ʱ��米�����Ұ�" title="���ʱ��米�����Ұ�" /></li>
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
                    <li><img src="/images/common/icon_left.gif" alt="icon" title="icon" /> ���ʱ��米�����Ұ�</li>
                    <li><img src="/images/common/icon_left.gif" alt="icon" title="icon" /> �뿩����</li>
                    <li><img src="/images/common/icon_left.gif" alt="icon" title="icon" /> �����뿩 �ȳ�</li>
                </ul>

                <span><img src="/base/images/conttitle/loan2.gif" alt="�����뿩 �ȳ�" title="�����뿩 �ȳ�" /></span>
                <span><img src="/base/images/sub_s_title.gif" alt="�������ſ��,����ħ�̽Ÿ��°�!���ʱ������Դϴ�." title="�������ſ��,����ħ�̽Ÿ��°�!���ʱ������Դϴ�." /></span>
            </div>

<table width="100%" border="0" cellpadding="0" cellspacing="0" background="/base/images/common/tab_bg.gif" summary="��">
<caption></caption>
  <tr>
    <td width="11%" height="29" valign="top"><a href="/base/loan/02.php"><img src="/base/images/loan_tab02_01_ov.gif" alt="���񽺾ȳ�" border="0" title="���񽺾ȳ�" ></a></td>
    <td width="11%" valign="top"><a href="/base/loan/02_01.php"><img src="/base/images/loan_tab02_02_out.gif" alt="��������" border="0" title="��������" ></a></td>
    <td width="78%" valign="top"><a href="/base/loan/02_02.php"><img src="/base/images/loan_tab02_03_out.gif" alt="��������" border="0" title="��������" ></a></td>
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