// JavaScript Document

//===============================================================
// html5 �������ϴ� ���������� �±׸����� �ϱ�
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
// png �����̹��� �����. ie8 ���Ϲ����� �����ϱ�
function setPng24(obj) {
 obj.width = obj.height = 1;
    obj.className = obj.className.replace(/\bpng24\b/i,'');
    obj.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+ obj.src +"',sizingMethod='image');"
    obj.src='';
    return '';
}

//===============================================================
// http ���ӽ� https �� ���������ϰ� �ϱ�
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
function jsiframeBoard(f) {		// iframe �����¡ �ϱ�
	$("#"+f).height(500);
	h = $("#"+f).contents().find("body").prop("scrollHeight");
	
	$("#"+f).height(h);
	
	//setTimeout("jsiframeBoard('"+f+"')", 1000);
}

function jsiframe(f) {		// iframe �����¡ �ϱ�
	
	h = $("#"+f).contents().find("body").prop("scrollHeight");
	if (/MSIE/.test(navigator.userAgent)) {
		//h = h + 50;
	} 
	
	//h = $("#"+f).contents().find("body").height();
	$("#"+f).height(h);
	
	setTimeout("jsiframe('"+f+"')", 1000);
}

//=====================================================
// Ű���� Ű�� ��������
function key_press() {
	var keyValue = event.keyCode;
	if (keyValue == 13) {	// ���͸� ������		
	}
}

//===============================================================
// â ������ ����, ��â ����
function funcBlankWindow(data1) {
    window.open(data1,'','');
}

function funcCenterWindow(data1, data2, data3, data4) {
    w = screen.width /  2 - data3 / 2;
    h = screen.Height / 2 - data4 / 2;
    data3 = "left=" + w + ",top=" + h + ",width=" + data3 + ",height=" + data4 + ",scrollbars=yes";
    window.open(data1, data2, data3);
}


function move_url(data) {		// �ϴ� ī�Ƕ���Ʈ�� �޺��ڽ� �̵���ũ��Ʈ
	if(data.length > 0) {
		if((data != "") && (data != "#")) {
			window.open(data,'','');
		}
	}
}


// �ϸ�ũ��ũ��Ʈ
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
	        alert(" ������ : CTRL+D \r\n\r\n linux�� �� : Command+D \r\n\r\n ������ ���ã�⸦ �߰��Ͻ� �� �ֽ��ϴ�.");
	}
}

function funcStartPage(url){
	startpage.style.behavior='url(#default#homepage)';
	startpage.setHomePage(url);
}