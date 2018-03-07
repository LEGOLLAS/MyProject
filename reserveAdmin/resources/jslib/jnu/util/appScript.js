/**
 * ?¨Ïö©?? ?ëÍ∑º ?ïÎ≥¥
 * */
var RequestEqInfo = function(){
	var appType = ''; // ?¨Ïö©?? ?®Îßê ?ëÏÜç Í≤ΩÎ°ú     WEB/APP
	var os = ''; // ?îÎ∞î?¥Ïä§ OS                         IOS/ANDROID
	var uuid = ''; // ?îÎ∞î?¥Ïä§ UUID                  212A3123D11
	var version = ''; // app Î≤ÑÏ†Ñ                         v1.0
	var type = '';// Íµ? ?ÅÎ¨∏ Ï¢ÖÎ•ò                            KOR/ENG
	var cur_menu_no = '';// ?ÑÏû¨ ?úÏ∂ú Î©îÎâ¥?úÎ≤à   1
	var disabled_yn = ''; // ?•Ïï†?? Î™®Îìú ?¨Î?        Y/N
	var cur_lat = ''; // ?ÑÏû¨ Ï¢åÌëú ?ÑÎèÑ
	var cur_lon = ''; // ?ÑÏû¨ Ï¢åÌëú Í≤ΩÎèÑ
	var cur_url = ''; // ?îÏ≤≠ Î∞õÏ? ?òÏù¥Ïß?
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
	 * ?¨Ïö©?? ?ëÍ∑º ?ïÎ≥¥ Í∞??∏Ïò§Í∏?
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
	 * ?±ÏùÑ ?µÌïú Ïß??? ?¥Îèô
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
	 * ?±ÏùÑ ?µÌïú ?•Ïï†?? ?úÏÑ§ ?ïÎ≥¥ ?úÏ∂ú
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
					disabledSupport(); //?•Ïï†?? Ïß??êÏãú??
				}else if( type == "2" ){
					disabledRestroom(); //?•Ïï†?? ?îÏû•??
				}else if( type == "3" ){
					disabledRestaurant(); //?•Ïï†?? ?ùÎãπ
				}else if( type == "4" ){
					disabledATM(); //?•Ïï†?? ATM
				}
			}else{
				marker_delete();
			}

		}else{
			this.showMessage( 'Not App mode but viewDisabled called' );
		}
	};

	/**
	 * ?? ?êÍ≤å Î∂ÅÎßà?? ?îÏ≤≠
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
	 * ?±ÏóêÍ≤? ?ïÎ≥¥Í≥µÏú† ?îÏ≤≠
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
	 * ?§Î•∏?òÏù¥Ïß?Î°? ?¥Îèô
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
	 * ?? ?§Î•ò?ïÎ≥¥ ?†Í≥† ?∏Ï∂ú
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
	 * ?? Í∏∏Ï∞æÍ∏? Ï¶êÍ≤®Ï∞æÍ∏∞ ?±Î°ù
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
	 * ÎπÑÏΩò?? ?µÌïú ?§Ìåü?ïÎ≥¥ ?úÍ≥µ
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
	 * Í∏∏Ï∞æÍ∏? Ïß??? ?†ÌÉù
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

		//WGS84 Ï¢åÌëúÎ•? CONGNAMUL Ï¢åÌëúÍ≥ÑÏùò Ï¢åÌëúÎ°? Î≥??òÌïú??
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
			alert('?¨Ïñ¥ ?úÏûë ?§Ìåü?ÖÎãà??.');
		}else{
			actPage--;
			if (actPage < 0) {
				actPage = 0;
			}
			guideViewPage(actPage);
		}
	};

	// Î∂ÅÎßà?? ?ïÏù∏
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
							addr = "?? ?ÑÏπò";
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

		//WGS84 Ï¢åÌëúÎ•? CONGNAMUL Ï¢åÌëúÍ≥ÑÏùò Ï¢åÌëúÎ°? Î≥??òÌïú??
		geocoder.transCoord(lon_c, lat_c, daum.maps.services.Coords.WCONGNAMUL, daum.maps.services.Coords.WGS84 , callback);

	};
};

