/**
 * ?�용?? ?�근 ?�보
 * */
var RequestEqInfo = function(){
	var appType = ''; // ?�용?? ?�말 ?�속 경로     WEB/APP
	var os = ''; // ?�바?�스 OS                         IOS/ANDROID
	var uuid = ''; // ?�바?�스 UUID                  212A3123D11
	var version = ''; // app 버전                         v1.0
	var type = '';// �? ?�문 종류                            KOR/ENG
	var cur_menu_no = '';// ?�재 ?�출 메뉴?�번   1
	var disabled_yn = ''; // ?�애?? 모드 ?��?        Y/N
	var cur_lat = ''; // ?�재 좌표 ?�도
	var cur_lon = ''; // ?�재 좌표 경도
	var cur_url = ''; // ?�청 받�? ?�이�?
};

var AppScript = function(){

	var defulatRequestInfo = new RequestEqInfo();
	var debugMode = 'C';     // Alert/Console/None

	this.showMessage = function( message ){
		if( debugMode == 'C' ){
			console.log( message );
		}else if( debugMode == 'A' ){
			alert( message );
		}
	};

	/**
	 * ?�용?? ?�근 ?�보 �??�오�?
	 */
	this.getRequestEqInfo = function(){
		var requestInfo = new RequestEqInfo();
		try{
			var appJsonResult = JSON.parse(scm.getAppStatusInfo());
			if( appJsonResult != null && appJsonResult != '' ){
				requestInfo.appType            = 'APP';
				requestInfo.os                     = appJsonResult.os;
				requestInfo.uuid                  = appJsonResult.uuid;
				requestInfo.type                  = appJsonResult.type;
				requestInfo.cur_menu_no    = appJsonResult.cur_menu_no;
				requestInfo.disabled_yn       = appJsonResult.disabled_yn;
				requestInfo.cur_lat              = appJsonResult.cur_lat;
				requestInfo.cur_lon              = appJsonResult.cur_lon;
			}else{
				requestInfo.appType = "WEB";
			}
		}catch(e){
			//this.showMessage( e.message );
			requestInfo.appType = "WEB";
		}

		this.defulatRequestInfo = requestInfo;
		this.hideAppArea();
		return requestInfo;
	};

	/**
	 * ?�을 ?�한 �??? ?�동
	 */
	this.getLocationFromApp = function( lat , lon ){
		if( this.defulatRequestInfo.appType == 'APP' ){
			try{

				if(myLocation){
					myLocation.setMap(null);
					myLocation = null;
				}


				myLocation = new daum.maps.Marker({
				       map: map,
				       position: new daum.maps.LatLng(lat, lon),
				       image : myPositionMarkerImage
				});
				map.setCenter(new daum.maps.LatLng(lat, lon));

				requestEqInfo.cur_lat              = appJsonResult.cur_lat;
				requestEqInfo.cur_lon              = appJsonResult.cur_lon;
			}catch(e){
				this.showMessage( e.message );
			}
		}else{
			this.showMessage( 'Not App mode but getLocationFromApp called' );
		}
	};

	/**
	 * ?�을 ?�한 ?�애?? ?�설 ?�보 ?�출
	 */
	this.viewDisabled = function( type , mode ){
		if( this.defulatRequestInfo.appType == 'APP' ){
			if( mode == "on" ){
				 try{
		        	 customOverlay.setMap(null);
		         }
		         catch(exception){
		         }
				if( type == "1" ){
					disabledSupport(); //?�애?? �??�시??
				}else if( type == "2" ){
					disabledRestroom(); //?�애?? ?�장??
				}else if( type == "3" ){
					disabledRestaurant(); //?�애?? ?�당
				}else if( type == "4" ){
					disabledATM(); //?�애?? ATM
				}
			}else{
				marker_delete();
			}

		}else{
			this.showMessage( 'Not App mode but viewDisabled called' );
		}
	};

	/**
	 * ?? ?�게 북마?? ?�청
	 */
	this.bookmark = function( type , title , subTitle , url , lat , lon , lat_c , lon_c , date_info ){
		if( this.defulatRequestInfo.appType == 'APP' ){
			try{
				scm.bookmark( type , title , subTitle , url , lat , lon , lat_c , lon_c , date_info );
			}catch(e){
				this.showMessage(e.message);
			}
		}else{
			this.showMessage( 'Not App mode but bookmark called' );
		}
	};

	/**
	 * ?�에�? ?�보공유 ?�청
	 */
	this.shareData = function( title , url ){
		if( this.defulatRequestInfo.appType == 'APP' ){
			try{
				scm.shareData( title , url );
			}catch(e){
				this.showMessage(e.message);
			}

		}else{
			this.showMessage( 'Not App mode but shareData called' );
		}
	};

	/**
	 * ?�른?�이�?�? ?�동
	 */
	this.moveNextPage = function( title , subTitle , url , isNew ){
		if( this.defulatRequestInfo.appType == 'APP' ){
			scm.moveNextPage( title , subTitle , url , isNew );
		}else{
			if( isNew == 'Y' ){
				window.open( url , title );
			}else{
				location.href = url;
			}
		}
	};

	/**
	 * ?? ?�류?�보 ?�고 ?�출
	 */
	this.moveErrSendPage = function( errType , title , subTitle , dong_no , url ){
		if( this.defulatRequestInfo.appType == 'APP' ){
			try{
				scm.moveErrSendPage( errType , title , subTitle , dong_no );
			}catch(e){
				this.showMessage( e.message );
			}
		}else{
			location.href = url;
		}
	};

	/**
	 * ?? 길찾�? 즐겨찾기 ?�록
	 */
	this.setRoadBookmark = function( s_lat_c , s_lon_c , s_name , e_lat_c , e_lon_c , e_name , type ){
		if( this.defulatRequestInfo.appType == 'APP' ){
			try{
				scm.setRoadBookmark( s_lat_c , s_lon_c , s_name , e_lat_c , e_lon_c , e_name , type );
			}catch(e){
				this.showMessage( e.message );
			}
		}else{
			this.showMessage( 'Not App mode but setRoadBookmark called' );
		}
	};

	/**
	 * 비콘?? ?�한 ?�팟?�보 ?�공
	 */
	this.getTourSpot = function( tour_seq , tour_ord ){
		if( this.defulatRequestInfo.appType == 'APP' ){
			try{
				var idx = (parseInt( tour_ord ) -1) * 2;
				actPage = idx;
				guideViewPage( idx , 'Y');
			}catch(e){
				this.showMessage( e.message );
			}
		}else{
			this.showMessage( 'Not App mode but getTourSpot called' );
		}
	};


	this.setTourStatus = function( tour_seq , status ){
		if( this.defulatRequestInfo.appType == 'APP' ){
			try{
				scm.setTourStatus( tour_seq , status );
			}catch(e){
				this.showMessage( e.message );
			}
		}else{
			this.showMessage( 'Not App mode but setTourStatus called' );
		}
	};

	this.hideAppArea = function(){
		if( this.defulatRequestInfo.appType == 'APP' ){
			$('.hideAppArea').hide();
			$('.hideWebArea').show();
		}else{
			$('.hideAppArea').show();
			$('.hideWebArea').hide();
		}

	};

	/**
	 * 길찾�? �??? ?�택
	 */
	this.setMapDataToApp = function( lat, lon, lat_c, lon_c, addr ){
		if( this.defulatRequestInfo.appType == 'APP' ){
			try{
				scm.setMapDataToApp( lat, lon, lat_c, lon_c, addr );
			}catch(e){
				this.showMessage( e.message );
			}
		}else{
			location.href = url;
		}
	};

	this.getRequestCurMapData = function(){
		var lat = map.getCenter().getLat();
		var lng = map.getCenter().getLng();

		var lat_c;
		var lon_c;
		var addr;

		var callback = function(status, result) {
			if (status === daum.maps.services.Status.OK) {

				lat_c = result.x;
				lon_c = result.y;

				var callback2 = function(status, result) {
					if (status === daum.maps.services.Status.OK) {

						var detailAddr = '';
						if( !!result[0].roadAddress.name ){
							detailAddr = result[0].roadAddress.name;
						}else{
							detailAddr = result[0].jibunAddress.name;
						}
						addr = detailAddr;
						scm.setMapDataToApp(lat, lng, lat_c, lon_c, addr);
					}
				};

				var latlng = new daum.maps.LatLng(lat, lng);
				geocoder.coord2detailaddr(latlng, callback2);
			}
		};

		//WGS84 좌표�? CONGNAMUL 좌표계의 좌표�? �??�한??
		geocoder.transCoord(lng, lat, daum.maps.services.Coords.WGS84, daum.maps.services.Coords.WCONGNAMUL, callback);
	};


	this.getTransCoordCongnamul = function( lat , lon ){
		geocoder.transCoord( lon , lat , daum.maps.services.Coords.WGS84, daum.maps.services.Coords.WCONGNAMUL, transCoordToWCONGNAMUL);
	};

	this.returnTransCoord = function( status, result ){
		if (status === daum.maps.services.Status.OK) {
			scm.setLocationTransCoordResult ( result.x , result.y )
		}
	};

	this.showMyLocationBtn = function(){
		if( this.defulatRequestInfo.appType == 'APP' ){
			try{
				scm.showMyLocationBtn( 'Y' );
			}catch(e){
				this.showMessage(e.message);
			}
		}
	};

	this.searchRoadMove1 = function(eName , eX , eY , url){
		if( this.defulatRequestInfo.appType == 'APP' ){
			scm.searchRoadMove(eName , eX , eY );
		}else{
			location.href = url;
		}

	};

	this.campus_history_back = function(){
		if(actPage == 0){
			alert('?�어 ?�작 ?�팟?�니??.');
		}else{
			actPage--;
			if (actPage < 0) {
				actPage = 0;
			}
			guideViewPage(actPage);
		}
	};

	// 북마?? ?�인
	this.checkBookmark = function( url ){
		try{
			if( this.defulatRequestInfo.appType == 'APP' && scm.checkBookmark( url ) == 1 ){
				$('.addBookmarkBtnImg').attr('src' , '/m/img/btn/like_star.png');
			}else{
				$('.addBookmarkBtnImg').attr('src' , '/m/img/btn/unlike_star.png');
			}
		}catch(e){
			this.showMessage(e.massage);
		}
	};

	this.checkRoadBookmark = function( s_lat_c , s_lon_c , s_name , e_lat_c , e_lon_c , e_name , type ){
		try{
			if( this.defulatRequestInfo.appType == 'APP' && scm.checkRoadBookmark( s_lat_c , s_lon_c , s_name , e_lat_c , e_lon_c , e_name , type ) == 1 ){
				$('.addRoadBookmarkBtnImg').attr('src' , '/m/img/ico/star_select.png');
			}else{
				$('.addRoadBookmarkBtnImg').attr('src' , '/m/img/ico/star_normal.png');
			}
		}catch(e){
			this.showMessage(e.massage);
		}
	};

	this.showTourBeaconIcon = function( show_yn ){
		if(show_yn == 'Y'){
			$('.audio_left').show();
		}else{
			$('.audio_left').hide();
		}
	};

	this.marker_delete = function(){
		for ( var i=0; i<marker_arr.length; i++ ){
			marker_arr[i].setMap(null);
		}

		marker_arr = [];

		closeOverlay();
	};

	this.backKeyFromApp = function(){
		if( this.defulatRequestInfo.appType == 'APP' ){
			if( $('#road_detail_area_map').css('display') == 'none' ){
				scm.callBackRoadSearch( "0" );
			}else{
				scm.showMyLocationBtn( 'N' );
				pageBack();
				scm.callBackRoadSearch( "1" );
			}
		}else{
		}
	};

	this.setCurAddrFromWebToApp = function( app_search_type ,  lat_c , lon_c ){

		var lat = '';
		var lng = '';

		var addr;

		var callback = function(status, result) {
			if (status === daum.maps.services.Status.OK) {

				lat = result.y;
				lng = result.x;

				var callback2 = function(status, result) {
					if (status === daum.maps.services.Status.OK) {

						var detailAddr = '';
						if( !!result[0].roadAddress.name ){
							detailAddr = result[0].roadAddress.name;
						}else{
							detailAddr = result[0].jibunAddress.name;
						}
						addr = detailAddr;

						if( !addr ){
							addr = "?? ?�치";
						}
						scm.setCurAddrFromWebToApp(addr);

						if( app_search_type == "1" ){
							sName = addr;
							$('#start_input').val(sName);
						}else if( app_search_type == "2" ){
							eName = addr;
							$('#end_input').val(eName);
						}else if( app_search_type == "3" ){
							sName = addr;
							eName = addr;
							$('#start_input').val(sName);
							$('#end_input').val(eName);
						}
					}
				};

				try{
					var latlng = new daum.maps.LatLng(lat, lng);
					geocoder.coord2detailaddr(latlng, callback2);
				}catch(e){
				}
			}
		};

		//WGS84 좌표�? CONGNAMUL 좌표계의 좌표�? �??�한??
		geocoder.transCoord(lon_c, lat_c, daum.maps.services.Coords.WCONGNAMUL, daum.maps.services.Coords.WGS84 , callback);

	};
};

