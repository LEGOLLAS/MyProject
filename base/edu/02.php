<?
include_once ("./_common.php");
include_once ("../include/header.php");

$contLeftMain = "3";
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
                    <li><img src="/images/common/icon_left.gif" alt="icon" title="icon" /> ������ü����</li>
                    <li><img src="/images/common/icon_left.gif" alt="icon" title="icon" /> ��Ƽ�̵������ ������</li>
                </ul>

                <span><img src="/base/images/conttitle/edu2.gif" alt="��Ƽ�̵������ ������" title="��Ƽ�̵������ ������" /></span>
                <span><img src="/base/images/sub_s_title.gif" alt="�������ſ��,����ħ�̽Ÿ����°�!���ʱ������Դϴ�." title="�������ſ��,����ħ�̽Ÿ����°�!���ʱ������Դϴ�." /></span>
            </div>
 
 <div><img src="/base/images/c_title/edu02_ctitle01.gif" alt="��Ƽ�̵�����۱�����" title="��Ƽ�̵�����۱�����" /></div><br />

            
<table width="100%" border="0" cellpadding="0" cellspacing="0" background="/base/images/common/tab_bg.gif" summary="��">
<caption></caption>
  <tr>
    <td width="11%" height="29" valign="top"><a href="/base/edu/02.php"><img src="/base/images/edu_tab02_01_ov.gif" alt="��üTIP" border="0" title="��üTIP" ></a></td>
    <td width="89%" valign="top"><a href="/base/edu/02_01.php"><img src="/base/images/edu_tab02_02_out.gif" alt="Ư��&��ũ��" border="0" title="Ư��&��ũ��" ></a></td>
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