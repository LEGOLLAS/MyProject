///// ZonnInOut //////////////////////////////////////////////////////////////////////////////	
	var nowZoom = 100; // �������
	var maxZoom = 200; // �ִ����
	var minZoom = 80; // �ּҺ���(����� ���ƾ� ��)

	// +, - Ű�� �Է��ϸ� ȭ�� Ȯ��, ��Ҹ� �Ѵ�.
	document.onkeypress = getKey;

	function getKey(keyStroke) {
		isNetscape = (document.layers);
		eventChooser = (isNetscape) ? keyStroke.which : event.keyCode;
		which = String.fromCharCode(eventChooser).toLowerCase();
		which2 = eventChooser;

		var el = event.srcElement;

		if ((el.tagName != "INPUT") && (el.tagName != "TEXTAREA")) {
			if (which == "+") {
				zoomIn();
			} else if (which == "-") {
				zoomOut();
			}
		}
	}

        //ȭ�� Ű���.
	function zoomIn() {
		if (nowZoom < maxZoom) {
			nowZoom += 5; // 25%�� Ŀ����.
		} else {
			return;
		}

		zoomRun(nowZoom);
	}
	
	//ȭ�� ���δ�.
	function zoomOut() {
		if (nowZoom > minZoom) {
			nowZoom -= 5; // 25%�� �۾�����.
		} else {
			return;
		}

		zoomRun(nowZoom);
	}
	
	//ȭ�� ������� 
    function zoomDefault() { 
    	nowZoom = 100; 
    	zoomRun(nowZoom);
    }
    
    function zoomRun(nowZoom) {
    	//document.body.style.zoom = nowZoom + "%"; 
    	document.getElementById("pageBody").style.zoom = nowZoom + "%"; 
    	//document.getElementById("pageLayout").style.zoom = nowZoom + "%"; 
    	
    	
		//if (document.getElementById("divLeftdiv") != null) {
		//	document.getElementById("divLeftdiv").style.zoom = nowZoom + "%";
		//	document.getElementById("divMFlash").style.zoom = nowZoom + "%";
		//}
    //
		//if (document.getElementById("menuLeftdiv") != null) {
		//	document.getElementById("menuLeftdiv").style.zoom = nowZoom + "%";
		//}
    } 
//--> 
