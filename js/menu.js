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


// ���ο��� �μ����� ���������� �������� �κ�
function mainLoading (choice) {
	if (choice.length < 1) {
		choice = "1";
	}
	
	for (i=1;i <= 4;i++) {
		switch (i) {
			case 1 : tt = " ���ʱ����� "; break;
			case 2 : tt = " ���米���� "; break;
			case 3 : tt = " �����н������� "; break;
			case 4 : tt = " ���ִ빮ȭ���� "; break;
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

// �� �μ����� ���λ���ٲٱ�
function changeLine(choice) {
	document.getElementById("pageTop").style.background = "#FFF url(/images/top/bg"+choice+".gif) top left repeat-x";
	document.getElementById("pageBanner").style.background = "#FFF url(/images/copyright/bannerbg"+choice+".gif)  top left repeat-x";	
}