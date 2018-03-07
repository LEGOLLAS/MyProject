
// http 접속시 https 로 강제접속하게 하기
var sPRTC=window.location['protocol'];
var sHREF=window.location['href'];
var shost =window.location['host'];
//var sport=window.location['port'];
var spn =window.location['pathname'];

//alert (sPRTC + "-" + sHREF + "-" + shost + "-" + sport + "-" + spn);

/*
if(sPRTC.toUpperCase() != 'HTTPS:') {
	//sport = "449";
	var sURL = "https://" + shost + spn;	
	window.location.replace(sURL);
}
*/

//===============================================================
// 창 띄위기 관련, 새창 띄우기
function new_window(data1, data2, data3, data4) {
	w = screen.width /  2 - data3 / 2;
	h = screen.Height / 2 - data4 / 2;
	data3 = "left=" + w + ",top=" + h + ",width=" + data3 + ",height=" + data4 + ",scrollbars=yes";	
	window.open(data1, data2, data3);
}

function CenterWindow(data1, data2, data3, data4) {
	w = screen.width /  2 - data3 / 2;
	h = screen.Height / 2 - data4 / 2;
	data3 = "left=" + w + ",top=" + h + ",width=" + data3 + ",height=" + data4 + ",scrollbars=yes";	
	window.open(data1, data2, data3);
}

// 컨텐츠 수정 버튼클릭시 
function editWindow(bo_table, wr_id) {
	window.open('/board/bbs/write.php?w=u&bo_table='+bo_table+'&wr_id='+wr_id,'edit','width=720,height=700,scrollbars=yes');
}

function loginWindow() {
	w = screen.width /  2 - 550 / 2;
	h = screen.Height / 2 - 273 / 2;
	data3 = "left=" + w + ",top=" + h + ",width=550,height=273,scrollbars=no";	
	window.open('/member/login.new.php','login', data3);
}

//===============================================================
//===============================================================
// 창닫거나 이동할 때
function F_move(data) {
	switch (data) {
		case "-1" : history.go(-1); break;
		case "opener_focus" : opener.window.focus(); window.close(); break;
		case "opener_reload" : opener.window.focus();opener.window.location.reload(); window.close();break;
		default : location.href=data; break;
	}
}

//===============================================================
//===============================================================
// 입력시, 이미지 교체 관련

// 이미지 교체시, 체크되어 있으면, 이미지 선택란 활성화, 체크가 안되어 있으면 비활성화
// data1 : 체크박스, data2 : 활성/비활성화될 input 태그
function F_img_chk(data1, data2) {
	if (data1.checked) {
		data2.disabled = false;
	} else {
		data2.disabled = true;
	}
}

// 선택 이미지 미리 보여주기
// data1 : 이미지 이름, data2 : 파일 선택 input 태그
function F_img_choice(data1, data2) {
	data1.src = data2.value;
	data1.width = 100;
	data1.height = 100;
}

// data1 : 이미지id, data2 : 교체할 이미지 경로
function F_img_change(data1, data2) {
	data1.src = data2;
}

// 이미지를 새창으로 띄워서 크게 보기
// data1 : imgview.asp 가 위치한 웹경로, data2 : 이미지경로
function imgview(data1, data2) {
	new_window(data1+"lib/imgview.asp?imgURL="+data2,"img",500,500);
}
//===============================================================
//===============================================================
// iframe 자동으로 크기 조정하기

function getReSize(FName, FWsize) {
 	try {
  		var objFrame = document.all[FName]; //document.getElementById(FName);
		var objBody = eval(FName).document.body; 

		ifrmHeight = objBody.scrollHeight + (objBody.offsetHeight - objBody.clientHeight) ; 

  		if (ifrmHeight < 10) { 
      		//ifrmHeight = 300;
      		document.all[FName].reload();
  		} else {
	   		objFrame.style.height = ifrmHeight + 50;
   			objFrame.style.width = FWsize;   		
   		}

 	} catch(e) {
   };

   setTimeout("getReSize('"+FName+"','"+FWsize+"')",500);
} 
//===============================================================
// 입력길이 체크
function FLenCHK(obj, objT, len) {		// obj:object, objT:obj 이름, len: 체크할 길이
	if (obj.value.length < len) {
		alert(objT + "를 입력해주세요. ");
		obj.focus();
		return true;
	} else {
		return false;
	}
}


//===============================================================
// QUICKMENU 클릭
function quickmenuView() {
	document.getElementById("quickMenu").style.display="block";
	document.getElementById("quickMenu").style.visibility = "visible";
}

// 전체보기 클릭
function quickmenuViewClose() {
	document.getElementById("quickMenu").style.display="none";
	document.getElementById("quickMenu").style.visibility="hidden";
}

// 검색
function swordSubmit(data) {
	var keyValue = event.keyCode;
	
	if (keyValue == 13) {
		location.href="/search/search.php?sword="+data;
	}
}
 
//===============================================================
//===============================================================
// 메인에서 사용하는 스크립트
noticeLink = "/comm/01.php";
function noticeOver(data) {
	document.getElementById("noticeList1").style.display = "none";
	document.getElementById("noticeList2").style.display = "none";
	
	document.getElementById("noticeList"+data).style.display = "block";
	
	document.getElementById("noticeimg1").src = "/images/notice1_out.gif";
	document.getElementById("noticeimg2").src = "/images/notice2_out.gif";
	
	document.getElementById("noticeimg"+data).src = "/images/notice"+data+"_over.gif";

	switch(data) {
		case "comm01" : noticeLink = "/comm/01.php"; break;
		case "comm02" : noticeLink = "/comm/02.php"; break;
	}
}

function noticeMore() {
	location.href = noticeLink;
}
//===============================================================
//===============================================================