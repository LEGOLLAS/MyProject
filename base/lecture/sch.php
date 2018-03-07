<?
include_once ("./_common.php");
$g4_path = __root__ . "/board"; // common.php �� ��� ���

if ($_REQUEST['mode'] == "excel") {
 $excelName =  date("Ymd") . "-���ǽð�ǥ";
 
 header( "Content-type: application/vnd.ms-excel; charset=euc-kr");
 header( "Content-Disposition: attachment; filename=" . $excelName . ".xls" );
 header( "Content-Description: PHP4 Generated Data" );
 print("<meta http-equiv=\"Content-Type\" content=\"application/vnd.ms-excel; charset=euc-kr\">");
 
}


include_once (__root__ . "/include/header.php");

// ���簭�ǵ� ���� ���ǽ� �����ڵ�
$roomArray = Array (
									"����4320", "����4319", "����4318", "����4317", "����4329", "����4324", "����4325",
									"����4227", "����4226", "����4225", "����4224", "����4236", "����4231", "����4232",
									"����4130", "����4129", "����4128", "����4127", "����4136", "����4133", "����4134"
									);

?>

<style>
	
	/* ����Ʈ - ���̺� ���� �κ� */
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
	<input type="button" name="btnp" value="  �μ��ϱ�  " onclick="pagePrint();">
	<input type="button" name="btnp" value="  ������ȯ  " onclick="pageExcel();">
	<input type="button" name="btnp" value="  â�ݱ�  " onclick="window.close();">
</div>

<div id="pageCont">

<?

/* CULT_ROOM_TIME_V �������� ��
Array
(
    [CURRI_YEAR] => 2008
    [TERM_GB] => 10					10:1�б�, 20:2�б�
    [TERM_NM] => 1�б�
    [ROOM_CD] => 00015			
    [DAY_GB] => 2						1:��, 2:�� ~ 7:��
    [DAY_NM] => ������
    [LESSON_TIME_GB] => 01
    [LESSON_TIME_NM] => 1����
    [SUBJECT_NM] => ���ʿ�������ؼ�
    [EMP_NM] => ������
    [SUBEMP_NM] => ���ʿ�������ؼ�(������)
    [LEC_ROOM_NM] => ����4231			���ǽǱ��� ������� ����Ʈ ��������
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
$choiceYear = $_REQUEST['choiceYear'];		// ������ �⵵
if ( !($choiceYear) ) $choiceYear = date("Y");

$choiceTerm = $_REQUEST['choiceTerm'];		// ������ �б�
if ( !($choiceTerm) ) $choiceTerm = 10;			// 10:1�б�, 20:2�б�

$choiceRoom = $_REQUEST['choiceRoom'];		// ������ ���ǽ�
if ( !($choiceRoom) ) $choiceRoom = $roomArray[0];			// 10:1�б�, 20:2�б�
if ($choiceRoom == "4320" || $choiceRoom == "4227" || $choiceRoom == "4130") {
	$choiceRoom = "����" . $choiceRoom;
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
	�⵵ 
	<select name="choiceTerm" onchange="sformSubmit();">
		<option value="10" <? if (10 == $choiceTerm) { echo "selected"; } ?>>1�б�</option>
		<option value="20" <? if (20 == $choiceTerm) { echo "selected"; } ?>>2�б�</option>
	</select>
	
	<select name="choiceRoom" onchange="sformSubmit();">
<? for ($i=0;$i < COUNT($roomArray);$i++) { ?>
			<option value="<?=$roomArray[$i];?>" <? if ($roomArray[$i] == $choiceRoom) { echo "selected"; } ?>><?=$roomArray[$i];?></option>
<? } ?>
	</select>

<? } else { ?>
	<?=$readData[1][CURRI_YEAR] . "�⵵ ";?>
	<?=$readData[1][TERM_NM];?>
	<?=$readData[1][LEC_ROOM_NM];?>
<? } ?>

	���ǽǽð�ǥ
</form>
</div>

<div style="padding:0px 20px;">
	<div style="float:left;">
		<span style="margin-right:150px;"><?=$choiceRoom;?></span>
		<span>�����ο� ��</span>
	</div>
	
	<div style="float:right;"><?=date("Y-m-d");?></div>
</div>

<table style="clear:both;" class="pgTable">
	<tr>
		<th>����</th>
		<th>��</th>
		<th>ȭ</th>
		<th>��</th>
		<th>��</th>
		<th>��</th>
		<th>��</th>
	</tr>

<? for ($i=1;$i <= 14;$i++) { 	// ���� ?>
  <tr>
    <td class="firstTD"><?=$i;?></td>

<?
	for ($j=2;$j <= 7;$j++) {		// ���� �� ~ ��
		
		echo "<td>";

		for ($k=1;$k <= $readData[0];$k++) {
			
			// ���� üũ
			if (intval($readData[$k][LESSON_TIME_GB]) == $i) {		
			
				// ���� üũ
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
