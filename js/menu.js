// JavaScript Document
var allChoice = 1;
function allmenuClick() {
	if (allChoice == 1) {
		document.getElementById("AllMenu").className = "AllOver";
		document.getElementById("AllMenuLayout").style.display = "block";
		document.getElementById("AllBtnImg").src = "/images/top/all_close.gif";
		allChoice = 0;
	
	} else {
		document.getElementById("AllMenu").className = "AllOut";
		document.getElementById("AllMenuLayout").style.display = "none";
		document.getElementById("AllBtnImg").src = "/images/top/all.gif";
		allChoice = 1;
	}
}


// 메인에서 부서별로 메인컨텐츠 보여지는 부분
function mainLoading (choice) {
	if (choice.length < 1) {
		choice = "1";
	}
	
	for (i=1;i <= 4;i++) {
		switch (i) {
			case 1 : tt = " 기초교육원 "; break;
			case 2 : tt = " 교양교육부 "; break;
			case 3 : tt = " 교수학습지원부 "; break;
			case 4 : tt = " 제주대문화광장 "; break;
		}
		
		//document.getElementById("mainLayout"+i).style.width = "75px";
		document.getElementById("mainLayout"+i).className = "mainL1";
		document.getElementById("mainLayout"+i).innerHTML = 
		"<a href=\"javascript:mainLoading('"+i+"');\"><img src='images/main/cont" + i + ".gif' alt='" + tt + "' title='" + tt + "' /></a>";
	}
	
	
	//document.getElementById("mainLayout"+choice).style.width = "774px";
	document.getElementById("mainLayout"+choice).className = "mainL2";	
	document.getElementById("mainLayout"+choice).innerHTML = "<iframe src=main"+choice+".php frameborder=0 scrolling=no name=viewFrame"+choice+" width='100%' height='529' id=viewFrame"+choice+"></iframe>";
	
	changeLine(choice);
}

// 각 부서별로 라인색깔바꾸기
function changeLine(choice) {
	document.getElementById("pageTop").style.background = "#FFF url(/images/top/bg"+choice+".gif) top left repeat-x";
	document.getElementById("pageBanner").style.background = "#FFF url(/images/copyright/bannerbg"+choice+".gif)  top left repeat-x";	
}