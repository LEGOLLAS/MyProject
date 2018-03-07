<?

// 1단계 메뉴, 1단계 메뉴 갯수만큼 $contMenuSub1 ~ 갯수만큼 변수가 있어야 한다.
$contMenu = Array (
				4,
				Array("학점과정", "/edu/intro/01.php", "_self"),
				Array("비학점과정", "/edu/intro/02.php", "_self"),
				Array("자격증취득과정", "/edu/intro/03.php", "_self"),
				Array("스마트관광과정", "/edu/intro/04.php", "_self")
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
					<img src="/resource/images/sub/menu/leftmenu_02_0<?=$cmi?>_ov.png" />
				<? } else { ?>
					<img src="/resource/images/sub/menu/leftmenu_02_0<?=$cmi?>_off.png" />
				<? } ?>
				</a>
            </li>
<? } ?>

        </ul>