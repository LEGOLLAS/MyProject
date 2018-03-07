<?php


//넘어오는 년월정보가 없으면 현재 년월을 초기화 시킨다.
if(!$cur_y) $cur_y = date(Y);
if(!$cur_m) $cur_m = date(m);


//윤년
$leap_year=false;
if($cur_y%4==0) $leap_year=true;
if($cur_y%100==0) $leap_year=false;
if($cur_y%400==0) $leap_year=true;

 

//해당 년월의 timestamp값을 구한다.(1일 0시0분0초)
$tstamp = mktime(0,0,0,$cur_m,1,$cur_y);

 

//해당 월의 총 날짜수를 구한다.
$tot_days = date("t",$tstamp);

 

//요일을 구한다.(0~6)
$week = date("w",$tstamp);

$day_end = false;
$dayno = 0;


?>

 

<html>

 

<head>
 <title>php로 만든 달력</title>
</head>

 

<body onload="javascript:document.calendar.cur_y.focus();">

<table width="266" cellspacing="0" cellpadding="5" align="center" border="1" bordercolordark="white" bordercolorlight="darkgreen">
<caption><b><?=$cur_y?>년 <?=$cur_m?>월</b></caption>
<tr align="center">
 <td><font color="red">일</font></td>
 <td>월</td>
 <td>화</td>
 <td>수</td>
 <td>목</td>
 <td>금</td>
 <td><font color="blue">토</font></td>
</tr>
<?
while(!$day_end) {
?>
 <tr align="center">
<?
 for($j=0; $j<7; $j++) {

  if($dayno==0 && $week==$j) $dayno = 1;

  if($dayno>0 && ($dayno<=$tot_days)){
   $colorstr = getDayColor($j, $dayno);
   ?>
   <td><?=$colorstr?></td>
   <?
   $dayno++;
  }
  else {
   ?>
   <td>&nbsp;</td>
   <?
  }

 } //for

 if($dayno>$tot_days)  $day_end = true;
 ?>
 </tr>
<?
} //while
?>
</table>
<br>
<form name="calendar" action="reserve_schedule.php" method="post">
<table width="266" cellpadding="5" border="0" align="center">
<tr align="right">
 <td>
  <input type="text" name="cur_y" size="4" autocomplete="off">년 
  <input type="text" name="cur_m" size="2" autocomplete="off">월
  <input type="submit" value="이동">
 </td>
</tr>
<tr align="right">
<?
 if($leap_year==false) {
 ?>
  <td><?=$cur_y?>년은 윤년이 아닙니다.</font></td>
 <?
 }
 else {
 ?>
  <td><?=$cur_y?>년은 윤년입니다.</td>
 <?
 }
?>
</tr>
</table>
</form>

</body>

 

</html>

 

<?
//토,일요일을 색상으로 구분해준다.
function getDayColor($day, $date) {
 $cstr = "";
 switch($day) {
  case(0) :
   $cstr = "<font color='red'>$date</font>";
   break;
  case(6) :
   $cstr = "<font color='blue'>$date</font>";
   break;
  default :
   $cstr = $date;
   break;
 }
 return $cstr;
}
?>