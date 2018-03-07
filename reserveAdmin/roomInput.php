<!DOCTYPE HTML>
<HTML>
 <HEAD>
  <TITLE> New Document </TITLE>
  <META charset="utf-8">
 </HEAD>

 <BODY>
<? include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/header.php"); ?>
 <h1>객실정보 입력페이지</h1>
 <div>
	<form id="" method="post" action="">
		<div>
			<span>객실ID:</span><input type="text" name="room_id"/>
		</div>
		<div>
			<span>객실명:</span><input type="text" name="room_name"/>
		</div>
		<div>
			<span>정원</span><select name="user_num" id="" style="height:30px;">
					<? for($num=0;$num<51;$num++){ ?>
						<option value="<?=$num?>"><? echo $num ?></option>
					<? } ?>
						</select>
		</div>
		<div>
			<span>금액:</span><input type="text" name="room_price"/>
		</div>
		<div>
			<input type="submit" value="확인"/><input type="reset" value="취소"/>
		</div>
</form>
 </div>

 </BODY>
</HTML>


