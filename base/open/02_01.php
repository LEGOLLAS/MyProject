<?
include_once ("./_common.php");
include_once ("../include/header.php");

$contLeftSub = "2";
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
                    <li><img src="/images/common/icon_left.gif" alt="icon" title="icon" /> ��������</li>
                    <li><img src="/images/common/icon_left.gif" alt="icon" title="icon" /> JILE �ٹ�</li>
                </ul>

                <span><img src="/base/images/conttitle/open2.gif" alt="JILE �ٹ�" title="JILE �ٹ�" /></span>
                <span><img src="/base/images/sub_s_title.gif" alt="�������ſ��,����ħ�̽Ÿ��°�!���ʱ������Դϴ�." title="�������ſ��,����ħ�̽Ÿ��°�!���ʱ������Դϴ�." /></span>
            </div>

<table width="100%" border="0" cellpadding="0" cellspacing="0" background="/base/images/common/tab_bg.gif" summary="��">
<caption></caption>
  <tr>
    <td width="11%" height="29" valign="top"><a href="/base/open/02.php"><img src="/base/images/open_tab02_01_out.gif" alt="����" border="0" title="����" /></a></td>
    <td width="89%" valign="top"><a href="/base/open/02_01.php"><img src="/base/images/open_tab02_02_ov.gif" alt="������" border="0" title="������"/></a></td>
  </tr>
</table><br />

            <div id="contView">
<a href="http://jile.jejunu.ac.kr:10780/board/bbs/board.php?bo_table=album2&page=1&style=webzine" target="viewFrame"><img src="/images/b_board.gif" alt="�����Խ��ǰ���" title="�����Խ��ǰ���" /></a>
<br>
<?
//$bo_table = "contents_base";
//$wr_id = "";

$bo_table = "base_open_02_01";
$sca = "���ʱ��米����"; // ���ʱ�����
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