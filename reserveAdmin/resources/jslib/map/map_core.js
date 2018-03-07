// MAP
var container = document.getElementById('map'), 
mapOption = {
	center: new daum.maps.LatLng(33.4558972228, 126.5617941072), 
    level: 3
};

var map = new daum.maps.Map(container, mapOption); 
var infowindow = new daum.maps.InfoWindow({removable: true});
var geocoder = new daum.maps.services.Geocoder();
var myLocation;

map.relayout();

var MyPosition = function(){
	var x = '';
	var y = '';
	var lat_val = '';
	var lon_val = '';
};

var WCONGNAMULCoords = function(){
	var x = '';
	var y = '';
};

var current_lat_val = '';
var current_lon_val = '';

var current_x = '';
var current_y = '';

var geocoder = new daum.maps.services.Geocoder();

var startMarkerImage  =  new daum.maps.MarkerImage(
	'/web/common/images/flag_start.png',
    //new daum.maps.Size(29, 29),
    new daum.maps.Size(35, 35),
    {
		offset: new daum.maps.Point(15, 43)
	}
);

var startMarkerDragImage  =  new daum.maps.MarkerImage(
	'/web/common/images/flag_start.png',
	//new daum.maps.Size(29, 29),
    new daum.maps.Size(35, 35),
    {
		offset: new daum.maps.Point(15, 54)
	}
);

var arriveMarkerImage  =  new daum.maps.MarkerImage(
	'/web/common/images/flag_arrive.png',
	//new daum.maps.Size(29, 29),
    new daum.maps.Size(35, 35),
    {
		offset: new daum.maps.Point(15, 43)
	}
);

var arriveMarkerDragImage  =  new daum.maps.MarkerImage(
	'/web/common/images/flag_arrive.png',
	//new daum.maps.Size(29, 29),
    new daum.maps.Size(35, 35),
    {
		offset: new daum.maps.Point(15, 54)
	}
);

var myPositionMarkerImage  =  new daum.maps.MarkerImage(
	'/m/img/marker/here.png',
    new daum.maps.Size(20, 20));

var spotMarkerImage  =  new daum.maps.MarkerImage(
	'/m/img/marker/flag_spot.png',
    new daum.maps.Size(20, 20), new daum.maps.Point(23,47));

var busStationImage  =  new daum.maps.MarkerImage(
	 '/m/img/marker/marker_facilities_busstop_nor.png',
	 new daum.maps.Size(20, 20));

var shuttleBusStationImage  =  new daum.maps.MarkerImage(
	 '/m/img/marker/marker_facilities_busstop_nor.png',
    new daum.maps.Size(20, 20));

var facilitiesImage  =  new daum.maps.MarkerImage(
	 '/m/img/marker/marker_facilities_default_nor.png',
    new daum.maps.Size(20, 20));

var geteImage  =  new daum.maps.MarkerImage(
	 '/m/img/marker/marker_facilities_gate_nor.png',
	 //'/mob/img/marker/gate_marker.png',
    new daum.maps.Size(20, 20));

var upperParkingLotImage  =  new daum.maps.MarkerImage(
		 '/m/img/marker/marker_facilities_parking_nor.png',
	    new daum.maps.Size(20, 20));

var underParkingLotImage  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_parking_nor.png',
		 //'/mob/img/marker/parking_b.png',
	    new daum.maps.Size(20, 20));

var libraryImage  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_library_nor.png',
		new daum.maps.Size(20, 20));

var informationImage  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_information_retrieval_nor.png',
	    new daum.maps.Size(20, 20));

var supportcenterImage  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_supportcenter_nor.png',
	    new daum.maps.Size(20, 20));

var restaurantImage  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_restaurant_nor.png',
	    new daum.maps.Size(20, 20));

var cafeImage  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_cafe_nor.png',
	    new daum.maps.Size(20, 20));

var bankImage  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_bank_nor.png',
	    new daum.maps.Size(20, 20));

var hospitalImage  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_hospital_nor.png',
	    new daum.maps.Size(20, 20));

var bookstoreImage  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_bookstore_nor.png',
	    new daum.maps.Size(20, 20));

var disabled_supportImage  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_disabled_support_nor.png',
	    new daum.maps.Size(20, 20));

var disabledImage  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_disabled_amenities_nor.png',
	    new daum.maps.Size(20, 20));

var officeImage  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_administration_office_nor.png',
	    new daum.maps.Size(20, 20));

var webBustStationImage  =  new daum.maps.MarkerImage(
		'/m/img/map/greenbus.png',
	    new daum.maps.Size(30, 30));
var searchBustStationImage  =  new daum.maps.MarkerImage(
		'/m/img/map/greenbus.png',
	    new daum.maps.Size(20, 20));
var searchWalkingImage  =  new daum.maps.MarkerImage(
		'/m/img/map/graybus.png',
	    new daum.maps.Size(20, 20));

var webShuttleBusStationImage  =  new daum.maps.MarkerImage(
		'/m/img/map/graybus.png',
	    new daum.maps.Size(30, 30));

var webClickBusStationImage  =  new daum.maps.MarkerImage(
		'/m/img/ico/red_pin.png',
	    new daum.maps.Size(24, 32));

var libraryImage2  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_library_nor.png',
		new daum.maps.Size(25, 25));

var informationImage2  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_information_retrieval_nor.png',
		new daum.maps.Size(25, 25));

var supportcenterImage2  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_supportcenter_nor.png',
		new daum.maps.Size(25, 25));

var restaurantImage2  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_restaurant_nor.png',
		new daum.maps.Size(25, 25));

var cafeImage2  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_cafe_nor.png',
		new daum.maps.Size(25, 25));

var bankImage2  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_bank_nor.png',
		new daum.maps.Size(25, 25));

var hospitalImage2  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_hospital_nor.png',
		new daum.maps.Size(25, 25));

var bookstoreImage2  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_bookstore_nor.png',
		new daum.maps.Size(25, 25));

var disabled_supportImage2  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_disabled_support_nor.png',
		new daum.maps.Size(25, 25));

var disabledImage2  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_disabled_amenities_nor.png',
		new daum.maps.Size(25, 25));

var officeImage2  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_administration_office_nor.png',
		new daum.maps.Size(25, 25));

var facilitiesImage2  =  new daum.maps.MarkerImage(
	 '/m/img/marker/marker_facilities_default_nor.png',
	 new daum.maps.Size(25, 25));

var gateImage2  =  new daum.maps.MarkerImage(
	 '/m/img/marker/marker_facilities_gate_nor.png',
	 new daum.maps.Size(25, 25));

var upperParkingLotImage2  =  new daum.maps.MarkerImage(
		 '/m/img/marker/marker_facilities_parking_nor.png',
		 new daum.maps.Size(25, 25));

var underParkingLotImage2  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_parking_nor.png',
		new daum.maps.Size(25, 25));


var disabled_supportImage_red  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_disabled_support_red.png',
	    new daum.maps.Size(20, 20));

var disabled_restroomImage_red  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_disabled_restroom_red.png',
	    new daum.maps.Size(20, 20));

var disabled_restaurantImage_red  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_disabled_restaurant_red.png',
	    new daum.maps.Size(20, 20));

var disabled_atmImage_red  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_disabled_atm_red.png',
	    new daum.maps.Size(20, 20));


var upperPolygonOption = {
    strokeWeight: 3,
    strokeColor: '#074096',
    strokeOpacity: 1,
    strokeStyle: 'solid',
    fillColor: '#2d72d9',
    fillOpacity: 0.8
};

  var underPolygonOption  = {
    strokeWeight: 3,
    strokeColor: '#1e7c1a',
    strokeOpacity: 1,
    strokeStyle: 'solid',
    fillColor: '#64cf30',
    fillOpacity: 0.8
};

function getNumberSpotImage (a) {
	var b = Math.floor((a - 1) / 10) * 30;
	b < 0 && (b = 0);
	a = (a - 1) % 10 * 30;
	return new daum.maps.MarkerImage("/m/img/marker/ico_num_map.png",
		new daum.maps.Size(20, 20), {
			offset: new daum.maps.Point(10, 10),
			spriteSize: new daum.maps.Size(320, 920),
			spriteOrigin: new daum.maps.Point(a, b)
		});
};

function getRoadSearchNumber (a) {
	var b = Math.floor((a - 1) / 10) * 30;
	b < 0 && (b = 0);
	a = (a - 1) % 10 * 30;
	return new daum.maps.MarkerImage("/m/img/marker/ico_num_map2.png",
		new daum.maps.Size(20, 20), {
			offset: new daum.maps.Point(10, 10),
			spriteSize: new daum.maps.Size(320, 920),
			spriteOrigin: new daum.maps.Point(a, b)
		});

};

function getLocation() {
	// HTML5의 geolocation으로 사용할 수 있는지 확인합니다 
	if (navigator.geolocation) {
		
		// GeoLocation을 이용해서 접속 위치를 얻어옵니다
		navigator.geolocation.getCurrentPosition(function(position) {
			var lat = position.coords.latitude, // 위도
				lon = position.coords.longitude; // 경도
			
			var locPosition = new daum.maps.LatLng(lat, lon), // 마커가 표시될 위치를 geolocation으로 얻어온 좌표로 생성합니다
				message = '<div style="padding:5px; width:100px;">현재 나의위치</div>'; // 인포윈도우에 표시될 내용입니다
				
			// 마커와 인포윈도우를 표시합니다
			displayMarker(locPosition, message);
		});
		
	} else { // HTML5의 GeoLocation을 사용할 수 없을때 마커 표시 위치와 인포윈도우 내용을 설정합니다			
		var locPosition = new daum.maps.LatLng(33.4558972228, 126.5617941072),    
			message = 'geolocation을 사용할수 없어요..'
			
		displayMarker(locPosition, message);
	}
}

// 지도에 마커와 인포윈도우를 표시하는 함수입니다
function displayMarker(locPosition, message) {
	// 마커를 생성합니다
	var marker = new daum.maps.Marker({  
		map: map, 
		position: locPosition
	}); 
	
	var iwContent = message, // 인포윈도우에 표시할 내용
		iwRemoveable = true;
	
	// 인포윈도우를 생성합니다
	var infowindow = new daum.maps.InfoWindow({
		content : iwContent,
		removable : iwRemoveable
	});
	
	// 인포윈도우를 마커위에 표시합니다 
	infowindow.open(map, marker);
	
	// 지도 중심좌표를 접속위치로 변경합니다
	map.setCenter(locPosition);      
}

function showPosition(position) {

	if( requestEqInfo.appType == 'APP' ){
		requestEqInfo = appScript.getRequestEqInfo();
		current_lat_val = requestEqInfo.cur_lat;
		current_lon_val = requestEqInfo.cur_lon;
	}else{
		/*current_lat_val = position.coords.latitude;
		current_lon_val = position.coords.longitude;*/
	}

	if(myLocation){
		myLocation.setMap(null);
		myLocation = null;
	}


	myLocation = new daum.maps.Marker({
		map: map,
		position: new daum.maps.LatLng(current_lat_val, current_lon_val),
		image : myPositionMarkerImage
	});


	map.relayout();

	map.setCenter(new daum.maps.LatLng(current_lat_val, current_lon_val));

}

$('.position_btn').on('click', function(){		
	if(myLocation){
		myLocation.setMap(null);
		myLocation = null;
	}

	getLocation();
});

var myPosition = new MyPosition();

function getMyPositionWithWCONGNAMUL(){
	 if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPositionWithWCONGNAMUL);
    } else {
    	alert("Geolocation is not supported by this browser.");
    }
}

function showPositionWithWCONGNAMUL(position) {
	geocoder.transCoord(position.coords.longitude, position.coords.latitude, daum.maps.services.Coords.WGS84, daum.maps.services.Coords.WCONGNAMUL, transCoordToWCONGNAMUL);
	myPosition.lat_val = position.coords.latitude;
	myPosition.lon_val = position.coords.longitude;
}

var transCoordToWCONGNAMUL = function(status, result) {
	if (status === daum.maps.services.Status.OK) {
		myPosition.x = result.x;
		myPosition.y = result.y;
		return myPosition;
	}
};

var upperPolygonOption = {
    strokeWeight: 3,
    strokeColor: '#074096',
    strokeOpacity: 1,
    strokeStyle: 'solid',
    fillColor: '#2d72d9',
    fillOpacity: 0.8
};

  var underPolygonOption  = {
    strokeWeight: 3,
    strokeColor: '#1e7c1a',
    strokeOpacity: 1,
    strokeStyle: 'solid',
    fillColor: '#64cf30',
    fillOpacity: 0.8
};


 var wcongnamulCoords = new WCONGNAMULCoords();

 function transFromWGS84ToWCONGNAMUL (lat, lng) {
  	geocoder.transCoord(lng, lat, daum.maps.services.Coords.WGS84, daum.maps.services.Coords.WCONGNAMUL, WCONGNAMULCallback);
  }

var WCONGNAMULCallback = function(status, result) {
	if (status === daum.maps.services.Status.OK) {
		wcongnamulCoords.x = result.x;
		wcongnamulCoords.y = result.y;
	}
};

  var carPolyline = {
  	strokeWeight: 2,
  	strokeColor: '#0000FF',
  	strokeOpacity: 0.8,
  	strokeStyle: 'solid'
  };

  var pubtransPolyline = {
  	strokeWeight: 2,
  	strokeColor: '#FF00FF',
  	strokeOpacity: 0.8,
  	strokeStyle: 'solid'
  };

  var walkPolyline = {
  	strokeWeight: 2,
  	strokeColor: '#FF0000',
  	strokeOpacity: 0.8,
  	strokeStyle: 'solid'
  };

  var carDashLine = {
      strokeWeight: 3,
      strokeColor: '#0000FF',
      strokeOpacity: 1,
      strokeStyle: 'longdash'
  };

  var pubtransDashLine = {
      strokeWeight: 3,
      strokeColor: '#FF00FF',
      strokeOpacity: 1,
      strokeStyle: 'longdash'
  };

  var walkDashLine = {
      strokeWeight: 3,
      strokeColor: '#FF0000',
      strokeOpacity: 1,
      strokeStyle: 'longdash'
  };

 function drawPolyline(path, mode){
  	polyline = new daum.maps.Polyline({
  	    map: map,
  	    path: path
  	});

  	if(mode == 'car'){
  		polyline.setOptions(carPolyline);
  	}else if(mode == 'pubtrans'){
  		polyline.setOptions(pubtransPolyline);
  	}else if(mode == 'walk'){
  		polyline.setOptions(walkPolyline);
  	}else{
  		polyline.setOptions(carPolyline);
  	}
  }

function initLocation() {
	if( requestEqInfo.appType == 'APP' ){
		current_lat_val = requestEqInfo.cur_lat;
		current_lon_val = requestEqInfo.cur_lon;
	}else{
		/*if (navigator.geolocation) {
	        navigator.geolocation.getCurrentPosition(initPosition);
	    } else {
	    	alert("Geolocation is not supported by this browser.");
	    }*/
	}
}

function initPosition(position) {
	if( requestEqInfo.appType == 'APP' ){
		current_lat_val = requestEqInfo.cur_lat;
		current_lon_val = requestEqInfo.cur_lon;
	}else{
		current_lat_val = position.coords.latitude;
		current_lon_val = position.coords.longitude;
	}

	if ( typeof current_my_lat != undefined || current_my_lat != undefined){
		current_my_lat = position.coords.latitude;
	}

	if ( typeof current_my_lon != undefined || current_my_lon != undefined){
		current_my_lon = position.coords.longitude;
	}

	if ( typeof start_lat != undefined || start_lat != undefined ){
		start_lat = position.coords.latitude;
	}

	if ( typeof start_lon != undefined || start_lon != undefined ){
		start_lon = position.coords.longitude;
	}
}

function zoomIn() {
    map.setLevel(map.getLevel() - 1, {animate: true});
}

function zoomOut() {
    map.setLevel(map.getLevel() +1 , {animate: true});
}


var webLocation = {};
var webLocationCallBack;


function webMyLocation(){
	if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(webInitPosition);
    } else {
    	alert("Geolocation is not supported by this browser.");
    }
}

function webInitPosition(position) {
	webLocation.lat = position.coords.latitude;
	webLocation.lon = position.coords.longitude;

	geocoder.transCoord(webLocation.lon, webLocation.lat, daum.maps.services.Coords.WGS84, daum.maps.services.Coords.WCONGNAMUL, webInitPositionCallback);
}

webInitPositionCallback = function(status, result) {
	if (status === daum.maps.services.Status.OK) {
		webLocation.congX = result.x;
		webLocation.congY = result.y;
	}
	var coord = new daum.maps.LatLng(webLocation.lat, webLocation.lon);
	geocoder.coord2detailaddr(coord, webInitPositionCallback2);
};

webInitPositionCallback2 = function(status, result) {
	if (status === daum.maps.services.Status.OK) {
		var detailAddr = !!result[0].roadAddress.name ? result[0].roadAddress.name : '';
        //detailAddr += result[0].jibunAddress.name;
        webLocation.addr = detailAddr;

        try{
        	webLocationCallBack( webLocation );
        }catch(e){

        }

    }
};

daummapsAppCall = function(eX, eY) {
	var url;
	var intentUrl;
	var appStoreUrl = "http://itunes.apple.com/us/app/id304608425?mt=8";
	//var playStoreUrl = "https://play.google.com/store/apps/details?id=net.daum.android.map";
	var playStoreUrl = "market://details?id=net.daum.android.map";

	var userAgent = navigator.userAgent.toLowerCase();
	var visitedAt = (new Date()).getTime(); // 諛⑸Ц �쒓컙

	if (eX && eY) {
		url = "daummaps://route?sp=&ep=" + eX + "," + eY + "&by=FOOT";
		intentUrl= "intent://route?sp=&ep=" + eX + "," + eY + "&by=FOOT#Intent;scheme=daummaps;action=android.intent.action.VIEW;category=android.intent.category.BROWSABLE;package=net.daum.android.map;end";
	} else {
		url = "daummaps://open";
		intentUrl= "intent://open#Intent;scheme=daummaps;action=android.intent.action.VIEW;category=android.intent.category.BROWSABLE;package=net.daum.android.map;end";
	}

	if (userAgent.match(/iphone|ipad|ipod/)) { // iOS
		alert("카카오맵으로 이동합니다.");
		return false;
		setTimeout(function() {
			if ((new Date()).getTime() - visitedAt < 6000) {
				appScript.moveNextPage('', '', appStoreUrl, 'N');
			}
		}, 5000);

		appScript.moveNextPage('', '', url, 'N');
	} else if (userAgent.match(/android/)) { 
		if (confirm("카카오맵으로 이동합니다.")) {
			if (userAgent.match(/chrome/)) {
				appScript.moveNextPage('', '', intentUrl, 'N');
			} else {
				setTimeout(function() {
					if ((new Date()).getTime() - visitedAt < 6000) {
						appScript.moveNextPage('', '', playStoreUrl, 'N');
					}
				}, 5000);

				var iframe = document.createElement('iframe');
				iframe.style.visibility = 'hidden';
				iframe.src = url;
				document.body.appendChild(iframe);
				document.body.removeChild(iframe); 
			}
		}
	}
};