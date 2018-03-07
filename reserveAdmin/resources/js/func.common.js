// JavaScript Document

//===============================================================
// html5 지원안하는 브라우저에서 태그먹히기 하기
document.createElement('address');
document.createElement('article');
document.createElement('aside');
document.createElement('figure');
document.createElement('footer');
document.createElement('header');
document.createElement('hgroup');
document.createElement('menu');
document.createElement('nav');
document.createElement('section');
// png 투명이미지 만들기. ie8 이하버전에 적용하기
function setPng24(obj) {
 obj.width = obj.height = 1;
    obj.className = obj.className.replace(/\bpng24\b/i,'');
    obj.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+ obj.src +"',sizingMethod='image');"
    obj.src='';
    return '';
}

//===============================================================
// http 접속시 https 로 강제접속하게 하기
var sPRTC=window.location['protocol'];
var sHREF=window.location['href'];
var shost =window.location['host'];
//var sport=window.location['port'];
var spn =window.location['pathname'];
//alert (sPRTC + "-" + sHREF + "-" + shost + "-" + sport + "-" + spn);

function httpsConnect() {
	if(sPRTC.toUpperCase() != 'HTTPS:') {
	 //sport = "449";
	 var sURL = "https://" + shost  + spn; 
	 window.location.replace(sURL);
	}
}


function httpsConnect() {
	if(sPRTC.toUpperCase() != 'HTTPS:') {
		//sport = "449";
		//var sURL = "https://" + shost + ":" + sport + spn; 
		var sURL = "https://" + shost + spn; 
			window.location.replace(sURL);
	}
		
} 

//=====================================================
function jsiframeBoard(f) {		// iframe 라사이징 하기
	$("#"+f).height(500);
	h = $("#"+f).contents().find("body").prop("scrollHeight");
	
	$("#"+f).height(h);
	
	//setTimeout("jsiframeBoard('"+f+"')", 1000);
}

function jsiframe(f) {		// iframe 라사이징 하기
	
	h = $("#"+f).contents().find("body").prop("scrollHeight");
	if (/MSIE/.test(navigator.userAgent)) {
		//h = h + 50;
	} 
	
	//h = $("#"+f).contents().find("body").height();
	$("#"+f).height(h);
	
	setTimeout("jsiframe('"+f+"')", 1000);
}

//=====================================================
// 키보드 키값 가져오기
function key_press() {
	var keyValue = event.keyCode;
	if (keyValue == 13) {	// 엔터를 쳤을때		
	}
}

//===============================================================
// 창 띄위기 관련, 새창 띄우기
function funcBlankWindow(data1) {
    window.open(data1,'','');
}

function funcCenterWindow(data1, data2, data3, data4) {
    w = screen.width /  2 - data3 / 2;
    h = screen.Height / 2 - data4 / 2;
    data3 = "left=" + w + ",top=" + h + ",width=" + data3 + ",height=" + data4 + ",scrollbars=yes";
    window.open(data1, data2, data3);
}


function move_url(data) {		// 하단 카피라이트의 콤보박스 이동스크립트
	if(data.length > 0) {
		if((data != "") && (data != "#")) {
			window.open(data,'','');
		}
	}
}


// 북마크스크립트
function funcBookmark (name,url) {
	
	if (document.all) {
		window.external.AddFavorite(url,name);
		
	} else if(window.opera && window.print) { 
	        var e=document.createElement('a');
	        e.setAttribute('href',url);
	        e.setAttribute('title',name);
	        e.setAttribute('rel','sidebar');
	        e.click();
	        
	} else {
	        alert(" 윈도우 : CTRL+D \r\n\r\n linux와 맥 : Command+D \r\n\r\n 누르면 즐겨찾기를 추가하실 수 있습니다.");
	}
}

function funcStartPage(url){
	startpage.style.behavior='url(#default#homepage)';
	startpage.setHomePage(url);
}