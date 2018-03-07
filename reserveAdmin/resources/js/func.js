// JavaScript Document

// 메인화면 팝업존 
function funcPopzone (index) {	
	var $pi = $("#popzoneImg li");
	var $icon = $("#mainLPopzone dl dd ul li");
	
	if ( index == $pi.size() ) {
		index = 0;	// 갯수 5, 마지막요소는 4
		backIndex = ($pi.size() - 1);
	} else {
		if (index > 0) { 
			backIndex = index - 1;
		} else {
			backIndex = $pi.size() - 1;
		}
	}
		
	// 이미지 바꾸기
	//$pi.eq(backIndex).css("display", "none");
	$pi.hide().eq(index).slideDown();
	
	// 아이콘 바꾸기
	listicon = $icon.children("a").children("img");	
	listicon.attr("src", "/html5/resource/images/popzone/out.jpg");
	nowicon = $icon.eq(index).children("a").children("img");
	nowicon.attr("src", "/html5/resource/images/popzone/ove.jpg");
	
	index++;
	
	popTime = setTimeout("funcPopzone(" + index + ")", 3000);
}

// 동영상 영역
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
	
	// 이미지 바꾸기
	$movie.hide().eq(index).show();
	
	index++;
	
	setTimeout("funcMovieZone(" + index + ")", 3000);
}



// 공지사항, 이달의 프로그램, 활동보고 탭 설정 
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


// 메인화면에서의 프로그램 검색
function funcStxPress (e) {
	var evcode = (window.netscape) ? e.which : e.keyCode;
	if (evcode == 13) programFormSubmit();
}

function programFormSubmit() {
	f = document.programForm;

	if (f.dates.value.length < 10 && f.stx.value.length < 1) {
		alert(" 기간 또는 프로그램명을 입력하셔야 합니다. ");
		f.stx.focus();
		return false;
	}
	
	if (f.dates.value.length == 10) {
		if (f.dates.value > f.datee.value) {
			alert(" 시작일자는 끝일자보다 작아야 합니다. ");
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
			alert(" 프로그램 종류를 먼저 선택해주세요. ");
			f.bo_table.focus();
			return false; 
			break;
	}
	*/
	url = "/html5/page/member/search.php";
	f.action = url;
	f.submit();
}
