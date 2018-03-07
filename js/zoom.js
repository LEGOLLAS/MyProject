///// ZonnInOut //////////////////////////////////////////////////////////////////////////////	
	var nowZoom = 100; // 현재비율
	var maxZoom = 200; // 최대비율
	var minZoom = 80; // 최소비율(현재와 같아야 함)

	// +, - 키를 입력하면 화면 확대, 축소를 한다.
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

        //화면 키운다.
	function zoomIn() {
		if (nowZoom < maxZoom) {
			nowZoom += 5; // 25%씩 커진다.
		} else {
			return;
		}

		zoomRun(nowZoom);
	}
	
	//화면 줄인다.
	function zoomOut() {
		if (nowZoom > minZoom) {
			nowZoom -= 5; // 25%씩 작아진다.
		} else {
			return;
		}

		zoomRun(nowZoom);
	}
	
	//화면 원래대로 
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
