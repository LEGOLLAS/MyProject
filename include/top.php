    
<div id="pageTop" style="height:120px; background: #FFF">
  <div id="pageTopLayout" style="height:120px;">
    <div style="float:left; width:20%; text-align:left;"><a href="/"><img src="/resource/images/common/logo.png" alt="���ִ��б� ������������ ������� �ΰ�" border="0" title="���ִ��б� ������������ ������� �ΰ�" /></a></div>
    <div style="float:right; text-align:right; width:78%;">
		<div style="height:45px;">ȫ�浿 ���� �α����ϼ̽��ϴ�.</div>
		<div>
		<?
			$tmImg = Array (6, 
						"/resource/images/common/top_menu_01",
						"/resource/images/common/top_menu_02",
						"/resource/images/common/top_menu_03",
						"/resource/images/common/top_menu_04",
						"/resource/images/common/top_menu_05",
						"/resource/images/common/top_menu_06"
			);
			
			for ($ti=1;$ti <= 6;$ti++) {	
				$tmImgOver[$ti] = $tmImg[$ti] .  "_ov.png";		// �����̹��� �����
				$tmImg[$ti] .= $topmenuImg[$ti] . "_off.png";		// �⺻�̹���
			}
			?>
				  <ul style="width:786px; height:55px; text-align:right; margin:0px; ">
					<li><a href="/base/index.php"><img src="<?=$tmImg[1];?>" alt="����Ұ�" title="����Ұ�" onmouseover="F_img_change(this,'<?=$tmImgOver[1];?>');" onmouseout="F_img_change(this,'<?=$tmImg[1];?>');" /></a></li>
					<li><a href="/edu/index.php"><img src="<?=$tmImg[2];?>" alt="��������" title="��������" onmouseover="F_img_change(this,'<?=$tmImgOver[2];?>');" onmouseout="F_img_change(this,'<?=$tmImg[2];?>');" /></a></li>
					<li><a href="/study/support/03.php"><img src="<?=$tmImg[3];?>" alt="����ǽ� & �н����α׷�" title="����ǽ� & �н����α׷�" onmouseover="F_img_change(this,'<?=$tmImgOver[3];?>');" onmouseout="F_img_change(this,'<?=$tmImg[3];?>');" /></a></li>
					<li><a href="/culture/index.php"><img src="<?=$tmImg[4];?>" alt="���롤���� ���α׷�" title="���롤���� ���α׷�" onmouseover="F_img_change(this,'<?=$tmImgOver[4];?>');" onmouseout="F_img_change(this,'<?=$tmImg[4];?>');" /></a></li>
					<li><a href="/dream/index.php"><img src="<?=$tmImg[5];?>" alt="���ϸ��� & ���� ���α׷�" title="���ϸ��� & ���� ���α׷�" onmouseover="F_img_change(this,'<?=$tmImgOver[5];?>');" onmouseout="F_img_change(this,'<?=$tmImg[5];?>');" /></a></li>
					<li><a href="/dream/index.php"><img src="<?=$tmImg[6];?>" alt="Ŀ�´�Ƽ" title="Ŀ�´�Ƽ" onmouseover="F_img_change(this,'<?=$tmImgOver[6];?>');" onmouseout="F_img_change(this,'<?=$tmImg[6];?>');" /></a></li>
				  </ul>
		</div>
	</div>
	<div style="clear:both;"></div>    
  </div><!-- <div id="pageTopLayout"> //-->
</div><!-- <div id="pageTop"> //-->
