<?
include_once ("./_common.php");
include_once ("../include/header.php");

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
                    <li>&gt; ��������</li>
                    <li>&gt; <span style="color:#1699dc">��ü����</span></li>
                </ul>

                <span><img src="/base/images/c_title/new/title_01_04_01.png" alt="�ü��� �̿�ȳ�" title="�ü��� �̿�ȳ�"></span>
            </div>


			
			<div id="contView">
<br>

<?
//$bo_table = "contents_base";
//$wr_id = "";

$bo_table = "base_open_01";
//$sca = "���ʱ��米����"; // ���ʱ�����
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