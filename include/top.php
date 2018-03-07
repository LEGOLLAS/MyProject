    
<div id="pageTop" style="height:120px; background: #FFF">
  <div id="pageTopLayout" style="height:120px;">
    <div style="float:left; width:20%; text-align:left;"><a href="/"><img src="/resource/images/common/logo.png" alt="제주대학교 지역선도대학 육성사업 로고" border="0" title="제주대학교 지역선도대학 육성사업 로고" /></a></div>
    <div style="float:right; text-align:right; width:78%;">
		<div style="height:45px;">홍길동 님이 로그인하셨습니다.</div>
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
				$tmImgOver[$ti] = $tmImg[$ti] .  "_ov.png";		// 오버이미지 만들기
				$tmImg[$ti] .= $topmenuImg[$ti] . "_off.png";		// 기본이미지
			}
			?>
				  <ul style="width:786px; height:55px; text-align:right; margin:0px; ">
					<li><a href="/base/index.php"><img src="<?=$tmImg[1];?>" alt="사업소개" title="사업소개" onmouseover="F_img_change(this,'<?=$tmImgOver[1];?>');" onmouseout="F_img_change(this,'<?=$tmImg[1];?>');" /></a></li>
					<li><a href="/edu/index.php"><img src="<?=$tmImg[2];?>" alt="교육과정" title="교육과정" onmouseover="F_img_change(this,'<?=$tmImgOver[2];?>');" onmouseout="F_img_change(this,'<?=$tmImg[2];?>');" /></a></li>
					<li><a href="/study/support/03.php"><img src="<?=$tmImg[3];?>" alt="현장실습 & 학습프로그램" title="현장실습 & 학습프로그램" onmouseover="F_img_change(this,'<?=$tmImgOver[3];?>');" onmouseout="F_img_change(this,'<?=$tmImg[3];?>');" /></a></li>
					<li><a href="/culture/index.php"><img src="<?=$tmImg[4];?>" alt="소통·공감 프로그램" title="소통·공감 프로그램" onmouseover="F_img_change(this,'<?=$tmImgOver[4];?>');" onmouseout="F_img_change(this,'<?=$tmImg[4];?>');" /></a></li>
					<li><a href="/dream/index.php"><img src="<?=$tmImg[5];?>" alt="마일리지 & 인증 프로그램" title="마일리지 & 인증 프로그램" onmouseover="F_img_change(this,'<?=$tmImgOver[5];?>');" onmouseout="F_img_change(this,'<?=$tmImg[5];?>');" /></a></li>
					<li><a href="/dream/index.php"><img src="<?=$tmImg[6];?>" alt="커뮤니티" title="커뮤니티" onmouseover="F_img_change(this,'<?=$tmImgOver[6];?>');" onmouseout="F_img_change(this,'<?=$tmImg[6];?>');" /></a></li>
				  </ul>
		</div>
	</div>
	<div style="clear:both;"></div>    
  </div><!-- <div id="pageTopLayout"> //-->
</div><!-- <div id="pageTop"> //-->
