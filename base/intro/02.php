<?
include_once ("./_common.php");
include_once ("../include/header.php");

$contLeftMain = "2";
?>

<div id="pageSubBg">
	<div id="pageSubImgBg">
		<img src="/resource/images/sub/common/sub_background.png" />
	</div>
</div>

<div id="pageCont">

    <div id="contL">
    	
        <ul>
           	<li><img src="/resource/images/sub/menu/subLeftTitle01.png" alt="사업소개" title="사업소개" /></li>
        </ul>
        
		<? include_once ("../include/leftmenu.php"); ?>
        
	</div><!-- <div id="contL"> //-->
   	
    <div id="contLayout">
    	<div id="contR">
			 <div id="contSubject">                
                <ul>
                	<li><img src="/resource/images/sub/title/home.png" alt="HOME" title="HOME" /> HOME</li>
                    <li>&gt; 사업소개</li>
                    <li>&gt; <span style="color:#1699dc">지역선도대학 육성사업 소개</span></li>
                </ul>

                <span><img src="/resource/images/sub/title/subTitle01_02.png" alt="지역선도대학 육성사업 소개" title="지역선도대학 육성사업 소개" /></span>
            </div>

            <div id="contView">
<?
$bo_table = "contents_base";
//$wr_id = $_GET[wr_id];
$wr_id = "2";

include (__root__ . "/include/iframe.php");
?>
            </div><!-- <div id="contView"> //-->
            
        </div><!-- <div id="contR"> //-->
	</div><!-- <div id="contLayout"> //-->
    
</div><!-- <div id="pageCont"> //-->

<?
include_once ("../include/footer.php");
?>