// JavaScript Document

// ����ȭ�� �˾��� 
function funcPopzone (index) {	
	var $pi = $("#popzoneImg li");
	var $icon = $("#mainLPopzone dl dd ul li");
	
	if ( index == $pi.size() ) {
		index = 0;	// ���� 5, ��������Ҵ� 4
		backIndex = ($pi.size() - 1);
	} else {
		if (index > 0) { 
			backIndex = index - 1;
		} else {
			backIndex = $pi.size() - 1;
		}
	}
		
	// �̹��� �ٲٱ�
	//$pi.eq(backIndex).css("display", "none");
	$pi.hide().eq(index).slideDown();
	
	// ������ �ٲٱ�
	listicon = $icon.children("a").children("img");	
	listicon.attr("src", "/html5/resource/images/popzone/out.jpg");
	nowicon = $icon.eq(index).children("a").children("img");
	nowicon.attr("src", "/html5/resource/images/popzone/ove.jpg");
	
	index++;
	
	popTime = setTimeout("funcPopzone(" + index + ")", 3000);
}

// ������ ����
function funcMovieZone (index) {	
	var $movie = $("#mainMove li");
	
	if (index == $movie.size()) {
		index = 0;
		backIndex = ($movie.size() - 1);
	} else {
		if (index > 0) { 
			backIndex = index - 1;
		} else {
			backIndex = $movie.size() - 1;
		}		
	}
	
	// �̹��� �ٲٱ�
	$movie.hide().eq(index).show();
	
	index++;
	
	setTimeout("funcMovieZone(" + index + ")", 3000);
}



// ��������, �̴��� ���α׷�, Ȱ������ �� ���� 
function funcTabNotice(index) {
	$("#secNotice ul").hide();
	$("#secNotice ul").eq(index).show();
	
	$("#contNoticeL .ulNoticeBox1 li").removeClass("active");
	$("#contNoticeL .ulNoticeBox1 li").eq(index).addClass("active");
}

function funcTabNoticeC(index) {
	$("#secInfo ul").hide();
	$("#secInfo ul").eq(index).show();
	
	$("#contNoticeC .ulNoticeBox1 li").removeClass("active");
	$("#contNoticeC .ulNoticeBox1 li").eq(index).addClass("active");
}


// ����ȭ�鿡���� ���α׷� �˻�
function funcStxPress (e) {
	var evcode = (window.netscape) ? e.which : e.keyCode;
	if (evcode == 13) programFormSubmit();
}

function programFormSubmit() {
	f = document.programForm;

	if (f.dates.value.length < 10 && f.stx.value.length < 1) {
		alert(" �Ⱓ �Ǵ� ���α׷����� �Է��ϼž� �մϴ�. ");
		f.stx.focus();
		return false;
	}
	
	if (f.dates.value.length == 10) {
		if (f.dates.value > f.datee.value) {
			alert(" �������ڴ� �����ں��� �۾ƾ� �մϴ�. ");
			return false;
		}
	}
	
	/*
	switch(f.bo_table.value) {
		case "info" : url = "/html5/page/data/11.php"; break;
		case "youth_02" : url = "/html5/page/youth/02.php";break;
		case "group" : url = "/html5/page/data/11.php"; break;
		case "action" : url = "/html5/page/active/10.php";break;
		case "comm03" : url = "/html5/page/info/01.php";break;
		default :
			alert(" ���α׷� ������ ���� �������ּ���. ");
			f.bo_table.focus();
			return false; 
			break;
	}
	*/
	url = "/html5/page/member/search.php";
	f.action = url;
	f.submit();
}
