<?

// 1�ܰ� �޴�, 1�ܰ� �޴� ������ŭ $contMenuSub1 ~ ������ŭ ������ �־�� �Ѵ�.
$contMenu = Array (
				4,
				Array("��������", "/edu/intro/01.php", "_self"),
				Array("����������", "/edu/intro/02.php", "_self"),
				Array("�ڰ���������", "/edu/intro/03.php", "_self"),
				Array("����Ʈ��������", "/edu/intro/04.php", "_self")
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
					<img src="/resource/images/sub/menu/leftmenu_02_0<?=$cmi?>_ov.png" />
				<? } else { ?>
					<img src="/resource/images/sub/menu/leftmenu_02_0<?=$cmi?>_off.png" />
				<? } ?>
				</a>
            </li>
<? } ?>

        </ul>