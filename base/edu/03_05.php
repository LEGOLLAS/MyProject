<?
include_once ("./_common.php");
include_once ("../include/header.php");

$contLeftMain = "3";
$contLeftSub = "3";
?>

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
                    <li><img src="/images/common/icon_left.gif" alt="icon" title="icon" /> ������ü����</li>
                    <li><img src="/images/common/icon_left.gif" alt="icon" title="icon" /> ���ø��ڷ��</li>
                </ul>

                <span><img src="/base/images/conttitle/edu3.gif" alt="���ø��ڷ��" title="���ø��ڷ��" /></span>
                <span><img src="/base/images/sub_s_title.gif" alt="�������ſ��,����ħ�̽Ÿ��°�!���ʱ������Դϴ�." title="�������ſ��,����ħ�̽Ÿ��°�!���ʱ������Դϴ�." /></span>
            </div>
 
<?
$bo_table = "contents_base";
//$wr_id = $_GET[wr_id];
$wr_id = "34";

include (__root__ . "/include/iframe.php");
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0" background="/base/images/common/tab_bg.gif" summary="��">
<caption></caption>
  <tr>
    <td width="7%" height="29" valign="top"><a href="/base/edu/03.php"><img src="/base/images/edu_tab03_01_out.gif" alt="����" border="0" title="����" ></a></td>
    <td width="7%" valign="top"><a href="/base/edu/03_01.php"><img src="/base/images/edu_tab03_02_out.gif" alt="PPT���ø�" border="0" title="PPT���ø�" ></a></td>
    <td width="7%" valign="top"><a href="/base/edu/03_02.php"><img src="/base/images/edu_tab03_03_out.gif" alt="PPT���̾�׷�" border="0" title="PPT���̾�׷�" ></a></td>
    <td width="7%" valign="top"><a href="/base/edu/03_03.php"><img src="/base/images/edu_tab03_04_out.gif" alt="���ִ����ø�" border="0" title="���ִ����ø�" ></a></td>
    <td width="8%" valign="top"><a href="/base/edu/03_04.php"><img src="/base/images/edu_tab03_05_out.gif" alt="�̹����ڷ��" border="0" title="�̹����ڷ��" ></a></td>
    <td width="64%" valign="top"><a href="/base/edu/03_05.php"><img src="/base/images/edu_tab03_06_ov.gif" alt="�����ǹ�" border="0" title="�����ǹ�" ></a></td>
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