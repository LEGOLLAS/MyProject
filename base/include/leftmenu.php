<?

// 1�ܰ� �޴�, 1�ܰ� �޴� ������ŭ $contMenuSub1 ~ ������ŭ ������ �־�� �Ѵ�.
$contMenu = Array (
				4,
				Array("������ �λ縻", "/base/intro/01.php", "_self"),
				Array("������������ ������� �Ұ�", "/base/intro/02.php", "_self"),
				Array("����", "/base/intro/03.php", "_self"),
				Array("�Ѵ��� ���� ���α׷�", "/base/intro/04.php", "_self")
			);
?>
        <ul>
        
<? 
for ($cmi=1;$cmi <= $contMenu[0];$cmi++) { 	// 1�ܰ� �޴�
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