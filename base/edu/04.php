<?
include_once ("./_common.php");
include_once ("../include/header.php");

$contLeftMain = "3";
$contLeftSub = "4";
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
                    <li><img src="/images/common/icon_left.gif" alt="icon" title="icon" /> ������ü������</li>
                </ul>

                <span><img src="/base/images/conttitle/edu4.gif" alt="������ü������" title="������ü������" /></span>
                <span><img src="/base/images/sub_s_title.gif" alt="�������ſ��,����ħ�̽Ÿ��°�!���ʱ������Դϴ�." title="�������ſ��,����ħ�̽Ÿ��°�!���ʱ������Դϴ�." /></span>
            </div>
 
 <div><img src="/base/images/c_title/edu04_ctitle01.gif" alt="������ü������" title="������ü������" /></div><br />


            <div id="contView">
<?
//$bo_table = "contents_base";
//$wr_id = $_GET[wr_id];
//$wr_id = "9";

$cpd_code = 1011;		// ���ʱ�����/Ư�� �� ��ũ�� : 5
$iframeURL = "/program/list.php?cpd_code=" . $cpd_code;
include (__root__ . "/include/iframe.php");

?>
            </div><!-- <div id="contView"> //-->
            
        </div><!-- <div id="contR"> //-->
	</div><!-- <div id="contLayout"> //-->
    
</div><!-- <div id="pageCont"> //-->

<?
include_once ("../include/footer.php");
?>