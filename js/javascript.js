
// http ���ӽ� https �� ���������ϰ� �ϱ�
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
// â ������ ����, ��â ����
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

// ������ ���� ��ưŬ���� 
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
// â�ݰų� �̵��� ��
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
// �Է½�, �̹��� ��ü ����

// �̹��� ��ü��, üũ�Ǿ� ������, �̹��� ���ö� Ȱ��ȭ, üũ�� �ȵǾ� ������ ��Ȱ��ȭ
// data1 : üũ�ڽ�, data2 : Ȱ��/��Ȱ��ȭ�� input �±�
function F_img_chk(data1, data2) {
	if (data1.checked) {
		data2.disabled = false;
	} else {
		data2.disabled = true;
	}
}

// ���� �̹��� �̸� �����ֱ�
// data1 : �̹��� �̸�, data2 : ���� ���� input �±�
function F_img_choice(data1, data2) {
	data1.src = data2.value;
	data1.width = 100;
	data1.height = 100;
}

// data1 : �̹���id, data2 : ��ü�� �̹��� ���
function F_img_change(data1, data2) {
	data1.src = data2;
}

// �̹����� ��â���� ����� ũ�� ����
// data1 : imgview.asp �� ��ġ�� �����, data2 : �̹������
function imgview(data1, data2) {
	new_window(data1+"lib/imgview.asp?imgURL="+data2,"img",500,500);
}
//===============================================================
//===============================================================
// iframe �ڵ����� ũ�� �����ϱ�

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
// �Է±��� üũ
function FLenCHK(obj, objT, len) {		// obj:object, objT:obj �̸�, len: üũ�� ����
	if (obj.value.length < len) {
		alert(objT + "�� �Է����ּ���. ");
		obj.focus();
		return true;
	} else {
		return false;
	}
}


//===============================================================
// QUICKMENU Ŭ��
function quickmenuView() {
	document.getElementById("quickMenu").style.display="block";
	document.getElementById("quickMenu").style.visibility = "visible";
}

// ��ü���� Ŭ��
function quickmenuViewClose() {
	document.getElementById("quickMenu").style.display="none";
	document.getElementById("quickMenu").style.visibility="hidden";
}

// �˻�
function swordSubmit(data) {
	var keyValue = event.keyCode;
	
	if (keyValue == 13) {
		location.href="/search/search.php?sword="+data;
	}
}
 
//===============================================================
//===============================================================
// ���ο��� ����ϴ� ��ũ��Ʈ
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