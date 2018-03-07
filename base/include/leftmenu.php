<?

// 1단계 메뉴, 1단계 메뉴 갯수만큼 $contMenuSub1 ~ 갯수만큼 변수가 있어야 한다.
$contMenu = Array (
				4,
				Array("위원장 인사말", "/base/intro/01.php", "_self"),
				Array("지역선도대학 육성사업 소개", "/base/intro/02.php", "_self"),
				Array("조직", "/base/intro/03.php", "_self"),
				Array("한눈에 보는 프로그램", "/base/intro/04.php", "_self")
			);
?>
        <ul>
        
<? 
for ($cmi=1;$cmi <= $contMenu[0];$cmi++) { 	// 1단계 메뉴
	$viewSelect = "";
	if ($contLeftMain == $cmi) {
		$viewSelect = "dtSelect";
	}
	
	$tmp = "contMenuSub".$cmi;
	$contSubmenu = $$tmp;
?>
           	<li>
           	  <a href="<?=$contMenu[$cmi][1];?>" target="<?=$contMenu[$cmi][2];?>">
				<? if($viewSelect) { ?>
					<img src="/resource/images/sub/menu/leftmenu_01_0<?=$cmi?>_ov.png" />
				<? } else { ?>
					<img src="/resource/images/sub/menu/leftmenu_01_0<?=$cmi?>_off.png" />
				<? } ?>
				</a>		
            </li>
<? } ?>

        </ul>