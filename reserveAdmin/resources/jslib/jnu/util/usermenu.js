$(document).ready(function(){

	requestEqInfo = appScript.getRequestEqInfo();

	//requestEqInfo.type = 'ENG';

	//menu();
	//boardTotal();
});

menu = function(){
	var ajax_url = '/mobile/api/menu.php';
	var param = '';
	$.ajax({
        'type': 'GET',
        'url': ajax_url,
        'contentType': 'text/plain; charset=utf-8',
        'data': param,
        'dataType': 'json',
        'beforeSend':function(request){
        	request.setRequestHeader('access_token', '111');
        },
        'error':function(request,status,error){
        	menuListFailCallback(request,status,error); //?¤íŒ¨ ì½œë°±?¨ìˆ˜ ?¸ì¶œ
        },
        'success': function(data){
        	menuListSuccessCallbackNew(data); //?±ê³µ ì½œë°±?¨ìˆ˜ ?¸ì¶œ
        }
    });
};

menuListSuccessCallback = function(data){
	var menu = data.children;

	var html = '';

	for ( var i=0; i<menu.length; i++ ){
		var data = menu[i];

		html += '<li>';
		if ( data.icon == null || data.icon == '' || data.icon == 'null' ){
			html += '';
		}
		else{
			html += '';
		}

		if (data.eng_url == '/m/road_search.action') {
			data.url = 'javascript:daummapsAppCall();';
			data.eng_url = 'javascript:daummapsAppCall();';
		}
		if ( requestEqInfo.type == 'ENG' ){
			html += '<a href="'+data.eng_url+'">'+data.eng_text+'</a></li>';
		}
		else{
			html += '<a href="'+data.url+'">'+data.text+'</a></li>';
		}


		if ( data.children != null ){
			var children = data.children;
			html += '<ul class="depth2">';
			for ( var j=0; j<children.length; j++ ){
				if ( requestEqInfo.type == 'ENG' ){
					html += '<li><a href="'+data.eng_url+'">'+data.eng_text+'</a></li>';
				}
				else{
					html += '<li><a href="'+data.url+'">'+data.text+'</a></li>';
				}
			}
			html += '</ul>';
		}
		html += '</li>';
	}

	$('.snb ul').html(html);
};

menuListSuccessCallbackNew = function(data){
	var menu = data.children;

	var html = '';

	for ( var i=0; i<menu.length; i++ ){
		var data = menu[i];

		html += '<li>';
		if ( data.icon == null || data.icon == '' || data.icon == 'null' ){
			html += '<img src="/m/img/ico/map_see.png" />';
		}
		else{
			html += '';
		}

		if (data.eng_url == '/m/road_search.action') {
			data.url = 'javascript:daummapsAppCall();';
			data.eng_url = 'javascript:daummapsAppCall();';
		}
		if ( requestEqInfo.type == 'ENG' ){
			html += '<a href="'+data.eng_url+'">'+data.eng_text+'</a></li>';
		}
		else{
			html += '<a href="'+data.url+'">'+data.text+'</a></li>';
		}


		if ( data.children != null ){
			var children = data.children;
			html += '<ul class="depth2">';
			for ( var j=0; j<children.length; j++ ){
				if ( requestEqInfo.type == 'ENG' ){
					html += '<li><a href="'+data.eng_url+'">'+data.eng_text+'</a></li>';
				}
				else{
					html += '<li><a href="'+data.url+'">'+data.text+'</a></li>';
				}
			}
			html += '</ul>';
		}
		html += '</li>';
	}

	$('.snb ul').html(html);
};

menuListFailCallback = function(request, status, error){
	console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
};

boardTotal = function(){
	var ajax_url = '/api/board/total.action';
	var param = '';
	$.ajax({
        'type': 'GET',
        'url': ajax_url,
        'contentType': 'text/plain; charset=utf-8',
        'data': param,
        'dataType': 'json',
        'beforeSend':function(request){
        	request.setRequestHeader('access_token', '111');
        },
        'error':function(request,status,error){
        	boardTotalFailCallback(request,status,error);
        },
        'success': function(data){
        	boardTotalSuccessCallback(data);
        }
    });
};

boardTotalSuccessCallback = function(data){

	if ( data.total != 0 ){
		$('.setting').append('&nbsp;&nbsp;'+data.total);
	}

};

boardTotalFailCallback = function(request, status, error){
	console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
};