<?
include_once ("./_common.php");
include_once ("../include/header.php");

$contLeftMain = "3";
$contLeftSub = "1";
?>

<div style="clear:both; background:url('/images/sub/new/sub_background.png'); background-size:100% 100%;">
	<div style="width:1000px; margin:0px auto;">
		<img src="/images/sub/new/sub_background_center.png" />
	</div>
</div>

<div id="pageCont">

    <div id="contL">
    	
        <ul>
           	<li><img src="/base/images/leftmenu/new/sub_left_01.png" alt="���ʱ�����" title="���ʱ�����" /></li>
            <li class="height30"></li>
        </ul>
        
		<? include_once ("../include/leftmenu.php"); ?>
        
	</div><!-- <div id="contL"> //-->
   	
    <div id="contLayout">
    	<div id="contR">
	        
            <div id="contSubject">
                
                <ul>
                	<li><img src="/images/sub/new/home.png" alt="HOME" title="HOME" align="absmiddle" /> HOME</li>
                    <li>&gt; ���ʱ��米���� �Ұ�</li>
                    <li>&gt; <span style="color:#1699dc">������뿩�ȳ�</span></li>
                </ul>

                <span><img src="/base/images/c_title/new/title_01_03_01.png" alt="�ü��� �̿�ȳ�" title="�ü��� �̿�ȳ�"></span>
            </div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" summary="��û���ٿ�ε�">
<caption></caption>
  <tr>
    <td align="right"><a href="/download/loan_01.hwp" target="_blank"><img src="/base/images/loan_01_bt_out.gif" 
	onmouseout="F_img_change(this,'/base/images/loan_01_bt_out.gif');"
	onmouseover="F_img_change(this,'/base/images/loan_01_bt_ov.gif');"
	alt="������뿩��û��" border="0" title="������뿩��û��" /></a></td>
  </tr>
</table>
            <div id="contView">
<?
$bo_table = "contents_base";
//$wr_id = $_GET[wr_id];
$wr_id = "12";

include (__root__ . "/include/iframe.php");
?>
            </div><!-- <div id="contView"> //-->
            
        </div><!-- <div id="contR"> //-->
	</div><!-- <div id="contLayout"> //-->
    
</div><!-- <div id="pageCont"> //-->

<?
include_once ("../include/footer.php");
?>