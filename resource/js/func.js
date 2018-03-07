// JavaScript Document

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