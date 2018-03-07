<?
include_once ("./_common.php");
$g4_path = __root__ . "/board"; // common.php 의 상대 경로

if ($_REQUEST['mode'] == "excel") {
 $excelName =  date("Ymd") . "-강의시간표";
 
 header( "Content-type: application/vnd.ms-excel; charset=euc-kr");
 header( "Content-Disposition: attachment; filename=" . $excelName . ".xls" );
 header( "Content-Description: PHP4 Generated Data" );
 print("<meta http-equiv=\"Content-Type\" content=\"application/vnd.ms-excel; charset=euc-kr\">");
 
}


include_once (__root__ . "/include/header.php");

// 교양강의동 층별 강의실 구분코드
$roomArray = Array (
									"교양4320", "교양4319", "교양4318", "교양4317", "교양4329", "교양4324", "교양4325",
									"교양4227", "교양4226", "교양4225", "교양4224", "교양4236", "교양4231", "교양4232",
									"교양4130", "교양4129", "교양4128", "교양4127", "교양4136", "교양4133", "교양4134"
									);

?>

<style>
	
	/* 리스트 - 테이블 공통 부분 */
	.pgTable {width:99%;border-collapse:collapse;margin:0px auto;}
	
	.pgTable th {height:30px;padding:2px 5px;background:#FFF;text-align:center;color:#656565;font-weight:100;font-size:11px;}
	.pgTable th {border-top:2px solid #2F2F2F;border-bottom:1px solid #C3C3C3;}
	
	.pgTable td {min-width:50px;font-size:11px;}
	.pgTable td {text-align:center;padding:10px 5px;background:#FFF;border:1px dotted #CCC;}
	
	.pgTable td .firstTD {width:30px;}
</style>

<script>
function pagePrint() {
	document.getElementById("divBtn").style.display = "none";
	self.print();
	document.getElementById("divBtn").style.display = "block";
}

function sformSubmit() {
	f = document.sform;
	f.mode.value = "view";
	f.action = "<?=$_SERVER['PHP_SELF'];?>";
	f.submit();
}

function pageExcel() {
	f = document.sform;
	f.mode.value = "excel";
	f.action = "<?=$_SERVER['PHP_SELF'];?>";
	f.submit();
}
</script>

<div id="divBtn" style="text-align:center;height:30px;padding-top:20px;">
	<input type="button" name="btnp" value="  인쇄하기  " onclick="pagePrint();">
	<input type="button" name="btnp" value="  엑셀변환  " onclick="pageExcel();">
	<input type="button" name="btnp" value="  창닫기  " onclick="window.close();">
</div>

<div id="pageCont">

<?

/* CULT_ROOM_TIME_V 가져오는 값
Array
(
    [CURRI_YEAR] => 2008
    [TERM_GB] => 10					10:1학기, 20:2학기
    [TERM_NM] => 1학기
    [ROOM_CD] => 00015			
    [DAY_GB] => 2						1:일, 2:월 ~ 7:토
    [DAY_NM] => 월요일
    [LESSON_TIME_GB] => 01
    [LESSON_TIME_NM] => 1교시
    [SUBJECT_NM] => 기초영어문법과해석
    [EMP_NM] => 원종섭
    [SUBEMP_NM] => 기초영어문법과해석(원종섭)
    [LEC_ROOM_NM] => 교양4231			강의실구분 요놈으로 리스트 가져오기
)
*/

$oci_user = "ctl";
$oci_pw = "ctl09";
$oci_host = "cnu_tis";

$oci_dbcon = oci_connect($oci_user, $oci_pw, $oci_host);
if ( !($oci_dbcon) ) {
	$e = oci_error();
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

//=================================================================
$choiceYear = $_REQUEST['choiceYear'];		// 선택한 년도
if ( !($choiceYear) ) $choiceYear = date("Y");

$choiceTerm = $_REQUEST['choiceTerm'];		// 선택한 학기
if ( !($choiceTerm) ) $choiceTerm = 10;			// 10:1학기, 20:2학기

$choiceRoom = $_REQUEST['choiceRoom'];		// 선택한 강의실
if ( !($choiceRoom) ) $choiceRoom = $roomArray[0];			// 10:1학기, 20:2학기
if ($choiceRoom == "4320" || $choiceRoom == "4227" || $choiceRoom == "4130") {
	$choiceRoom = "교양" . $choiceRoom;
}

$oci_sql = " select * from CULT_ROOM_TIME_V 
									where LEC_ROOM_NM = '" . $choiceRoom . "' 
									and CURRI_YEAR = '" . $choiceYear . "' 
									and TERM_GB = '" . $choiceTerm . "' 
									
									";
$oci_result = oci_parse($oci_dbcon, $oci_sql);
oci_execute($oci_result);

$icount = 0;
while ( $oci_row = oci_fetch_array($oci_result, OCI_BOTH) ) {
	$icount ++;
	
	$readData[0] = $icount;
	$readData[$icount] = $oci_row;
}

oci_free_statement($oci_result);
oci_close($oci_dbcon);

?>

<div style="text-align:center;font-size:15px;font-weight:bold;height:35px;padding-top:20px;">
<form name="sform" method="get">
<input type="hidden" name="mode" value="">

<? if ($_REQUEST['mode'] != "excel") { ?>
	<select name="choiceYear" onchange="sformSubmit();">
<? for ($i=2005;$i <= (date("Y")+1);$i++) { ?>
			<option value="<?=$i;?>" <? if ($i == $choiceYear) { echo "selected"; } ?>><?=$i;?></option>
<? } ?>
	</select>
	년도 
	<select name="choiceTerm" onchange="sformSubmit();">
		<option value="10" <? if (10 == $choiceTerm) { echo "selected"; } ?>>1학기</option>
		<option value="20" <? if (20 == $choiceTerm) { echo "selected"; } ?>>2학기</option>
	</select>
	
	<select name="choiceRoom" onchange="sformSubmit();">
<? for ($i=0;$i < COUNT($roomArray);$i++) { ?>
			<option value="<?=$roomArray[$i];?>" <? if ($roomArray[$i] == $choiceRoom) { echo "selected"; } ?>><?=$roomArray[$i];?></option>
<? } ?>
	</select>

<? } else { ?>
	<?=$readData[1][CURRI_YEAR] . "년도 ";?>
	<?=$readData[1][TERM_NM];?>
	<?=$readData[1][LEC_ROOM_NM];?>
<? } ?>

	강의실시간표
</form>
</div>

<div style="padding:0px 20px;">
	<div style="float:left;">
		<span style="margin-right:150px;"><?=$choiceRoom;?></span>
		<span>수용인원 명</span>
	</div>
	
	<div style="float:right;"><?=date("Y-m-d");?></div>
</div>

<table style="clear:both;" class="pgTable">
	<tr>
		<th>교시</th>
		<th>월</th>
		<th>화</th>
		<th>수</th>
		<th>목</th>
		<th>금</th>
		<th>토</th>
	</tr>

<? for ($i=1;$i <= 14;$i++) { 	// 교시 ?>
  <tr>
    <td class="firstTD"><?=$i;?></td>

<?
	for ($j=2;$j <= 7;$j++) {		// 요일 월 ~ 토
		
		echo "<td>";

		for ($k=1;$k <= $readData[0];$k++) {
			
			// 교시 체크
			if (intval($readData[$k][LESSON_TIME_GB]) == $i) {		
			
				// 요일 체크
				if (intval($readData[$k][DAY_GB]) == $j) {
					echo $readData[$k][SUBEMP_NM] . "<br>";
				}
			
			}
		}

		echo "</td>";
	}
?>
  </tr>
<?
}
?>

</table>

</div><!-- <div id="pageCont"> //-->
