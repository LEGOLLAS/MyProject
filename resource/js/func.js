// JavaScript Document

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