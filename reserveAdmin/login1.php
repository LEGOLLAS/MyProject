<?php 
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/db_conn.php"); 
	
	if(isset($_SESSION['memberId'])) {
		session_start();
?>
	<script>
	window.onload = function() {
		location.href = "/reserveAdmin/";
		return;
	}
	</script>
<?
	} else {
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>

<link rel="stylesheet" type="text/css" href="/reserveAdmin/resources/css/admin.css"/>
<style>
#loginAllArea {
	padding-top:30px; padding-left:30px; padding-right:30px; padding-bottom:30px;
	width:700px; margin:0px auto;
}

#loginAllArea #loginLogo {
	padding-top:30px; padding-bottom:30px;
	text-align:center;
}


#loginArea {
	width:500px;
	margin:0px auto;
}

#loginButton {
	width:100px; height:65px; background: #faa61a; color: #ffffff; border:1px solid #faa61a; cursor:pointer; font-weight:bold; font-size:16px;
}

</style>

<script>
function frmLoginSubmit() {
	
	var adminLoginForm = document.getElementById("adminLoginForm");
	var member_id = document.getElementById("member_id");
	var member_password = document.getElementById("member_password");
	
	if(member_id.value == "") {
		alert("아이디를 입력해주세요.");
		member_id.focus();
		return;
	}

	if(member_password.value == "") {
		alert("패스워드를 입력해주세요.");
		member_password.focus();
		return;
	}

	adminLoginForm.submit();

}

function searchEnterSubmit(ev) {
	var evt_code = (window.netscape) ? ev.which : event.keyCode; // 파이어폭스에서 엔터키 안되는 현상 수정

	if (evt_code == 13) {
		frmLoginSubmit();
	}
}
</script>

<title>:: 제주 비자숲힐링센터 - 예약시스템 관리자 ::</title>
</head>
<body topmargin="0" leftmargin="0">

<div id="loginAllArea">
	<div id="loginLogo"><img src="/reserveAdmin/resources/images/common/logo.png" /></div>
	<form id="adminLoginForm" name="adminLoginForm" method="post" action="login_proc.php">
	<input type="hidden" name="mode" id="mode" value="login" />
	
	<div id="loginArea">
		<table width="500px" align="center">
		<tr height="40px" align="center">
			<td width="100px" valign="top">ID</td>
			<td width="300px" valign="top">
				<input type="text" name="member_id" id="member_id" style="width:94%;" class="form-control" tabindex="1" onkeyup="javascript:searchEnterSubmit(event);" />
			</td>
		</tr>
		<tr align="center">
			<td>PW</td>
			<td>
				<input type="password" name="member_password" id="member_password" style="width:94%;" class="form-control" tabindex="2" onkeyup="javascript:searchEnterSubmit(event);" />
			</td>
		</tr>
		<tr align="right">
			<td>&nbsp;</td>
			<td colspan="2" style="padding-top:10px; padding-right:5px;"><input id="loginButton" type="button" value="LOGIN" tabindex="3" onclick="javascript:frmLoginSubmit();" /></td>
		</tr>
		</table>
	</div>
	</form>
</div>


</body>
</html>

<? } ?>
