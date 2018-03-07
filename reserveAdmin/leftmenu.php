<div id="contBody">
	<div id="leftmenuArea">
		<div class="bigTitle"></div>
			<ul class="leftmenu_UL">
				<li><a href="/reserveAdmin/program_category/list.php"><span id="menu01" >프로그램 카테고리 관리</span></a></li>
				<li><a href="/reserveAdmin/program_manage/list.php"><span id="menu02">프로그램 운영일 관리</span></a></li>
				<li><a href="/reserveAdmin/program/list.php"><span id="menu03">프로그램 관리(개인/단체)</span></a></li>
				<li><a href="/reserveAdmin/sukso/list.php"><span id="menu04">숙소 관리<span></a></li>
				<li><a href="/reserveAdmin/room/list.php"><span id="menu05">객실정보관리<span></a></li>
				<li><a href="/reserveAdmin/member_children/list.php"><span id="menu06">자녀정보관리<span></a></li>
				<li><a href="/reserveAdmin/program_admin/list.php"><span id="menu07">프로그램 운영관리<span></a></li>
				<li><a href="/reserveAdmin/room_rev/list.php"><span id="menu08">프로그램 예약관리<span></a></li>
			</ul>
	</div>

<?
//메뉴 네비 구문
$url = $_SERVER['REQUEST_URI']; 
$now = explode("/", $url);
$img_url="/reserveAdmin/resources/images/main/menu_hover_bg.png";
$menu=array('menu01','menu02','menu03','menu04','menu05','menu06','menu07','menu08');

switch($now[2]){
	case "program_category":	menu_list($menu[0],$img_url);break;
	case "program_manage":	menu_list($menu[1],$img_url); break;
	case "program":					menu_list($menu[2],$img_url);break;
	case "sukso":	 						menu_list($menu[3],$img_url);break;
	case "room":	 						menu_list($menu[4],$img_url);break;
	case "member_children":	 	menu_list($menu[5],$img_url);break;
	case "program_admin":	 	menu_list($menu[6],$img_url);break;
	case "room_rev":	 				menu_list($menu[7],$img_url);break;
}

function menu_list($menu,$img_url){
echo "<script>document.getElementById('".$menu."').style.backgroundImage  = \"url(".$img_url.")\";</script>";	
echo "<script>document.getElementById('".$menu."').style.color = \"#fff\";</script>";
}




?>


