<?
include_once ("./_common.php");
include_once ("../include/header.php");

$contLeftMain = "3";
$contLeftSub = "5";
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
                    <li><img src="/images/common/icon_left.gif" alt="icon" title="icon" /> â�۰���'â��'</li>
              </ul>

                <span><img src="/base/images/conttitle/edu5.gif" alt="â�۰���'â��'" title="â�۰���'â��" /></span>
                <span><img src="/base/images/sub_s_title.gif" alt="�������ſ��,����ħ�̽Ÿ��°�!���ʱ������Դϴ�." title="�������ſ��,����ħ�̽Ÿ��°�!���ʱ������Դϴ�." /></span>
            </div>
 
 <div><img src="/base/images/c_title/edu05_ctitle01.gif" alt="â�۰���'â��'" title="â�۰���'â��" /></div><br />
<span><img src="/base/images/c_title/edu05_03_ctitle01.gif" alt="��û�ϱ�'" title="��û�ϱ�" /></span><br />


<!--table width="100%" border="0" cellpadding="0" cellspacing="0" background="/base/images/common/tab_bg.gif" summary="��">
<caption></caption>
  <tr>
    <td width="11%" height="29" valign="top"><a href="/base/edu/05.php"><img src="/base/images/edu_tab05_01_ov.gif" alt="�Ұ�" border="0" title="�Ұ�" ></a></td>
    <td width="11%" valign="top"><a href="/base/edu/05_01.php"><img src="/base/images/edu_tab05_02_out.gif" alt="��Ʈ������" border="0" title="��Ʈ������" ></a></td>
    <td width="78%" valign="top"><a href="/base/edu/05_021.php"><img src="/base/images/edu_tab05_03_out.gif" alt="â���ǹ�" border="0" title="â���ǹ�" ></a></td>
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