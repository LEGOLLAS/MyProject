var CAR = false;
var PUBTRANS = false;
var  WALK = false;

var sName;
var sX;
var sY;

var eName;
var eX;
var eY;

var markers = [];
var polyline;
var transRoutes;

var wcong  = {};

var polygon;

var geocoder = new daum.maps.services.Geocoder();

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


var spotMarkerImage  =  new daum.maps.MarkerImage(
	'/mob/img/marker/flag_spot.png',
	//'http://i1.daumcdn.net/localimg/localimages/07/mapjsapi/default_marker.png',
    new daum.maps.Size(48, 48), new daum.maps.Point(23,47));


var publicBusStationImage  =  new daum.maps.MarkerImage(
	 '/mob/img/marker/gate_marker.png',
    new daum.maps.Size(48, 48));

var shuttleBusStationImage  =  new daum.maps.MarkerImage(
    'http://i1.daumcdn.net/localimg/localimages/07/mapapidoc/markerStar.png',
    new daum.maps.Size(24, 35), new daum.maps.Point(13, 34));

var upperParkingLotImage  =  new daum.maps.MarkerImage(
		 '/mob/img/marker/parking_f.png',
	    new daum.maps.Size(48, 48));

var underParkingLotImage  =  new daum.maps.MarkerImage(
		 '/mob/img/marker/parking_b.png',
	    new daum.maps.Size(48, 48));

var upperParkingLotImage2  =  new daum.maps.MarkerImage(
		 '/m/img/marker/marker_facilities_parking_nor.png',
	    //new daum.maps.Size(30, 30));
		 new daum.maps.Size(25, 25));

var underParkingLotImage2  =  new daum.maps.MarkerImage(
		'/m/img/marker/marker_facilities_parking_nor.png',
	    //new daum.maps.Size(30, 30));
		new daum.maps.Size(25, 25));

var gateImage  =  new daum.maps.MarkerImage(
	'/m/img/marker/marker_facilities_gate_nor.png',
    //new daum.maps.Size(30, 30));
	new daum.maps.Size(25, 25));

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

function transFromWGS84ToWCONGNAMUL (x, y) {

	var callback = function(status, result) {
		if (status === daum.maps.services.Status.OK) {
			wcong = {};
			wcong.x = result.x;
			wcong.y = result.y;
		}
	};

	geocoder.transCoord(x, y, daum.maps.services.Coords.WGS84, daum.maps.services.Coords.WCONGNAMUL, callback);
}

function searchDetailAddrFromCoords(coords, flag) {
    var callback = function(status, result) {
    	if (status === daum.maps.services.Status.OK) {

    		var detailAddr = !!result[0].roadAddress.name ? result[0].roadAddress.name : '';
            detailAddr += result[0].jibunAddress.name;

    		if(flag == 'S'){
    			sName =  detailAddr;
    		}else if(flag == 'E'){
    			eName =  detailAddr;
    		}
        }
    };

    geocoder.coord2detailaddr(coords, callback);
}

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

function setMarkers(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}

function removeMarkersAndPolyLine() {
	 if(markers){
		 setMarkers(null);
	 }

	 if(polyline){
		 polyline.setMap(null);
	 }
}

function getCentroidOfPolygonByWGS84(path) {

	var latlng = {};
    var centerX = 0;
    var centerY = 0;
    var area = 0;
    //var firstIndex = 0;
    var firstIndex, secondIndex, sizeOfVertexs = path.length;
    var factor  = 0;

    for (firstIndex = 0; firstIndex < sizeOfVertexs; firstIndex++) {
	     secondIndex = (firstIndex + 1) % sizeOfVertexs;

	     //factor = ((path[firstIndex].getLat() * path[secondIndex].getLng()) - (path[secondIndex].getLat() * path[firstIndex].getLng()));
	     factor = ((path[firstIndex].getLng() * path[secondIndex].getLat()) - (path[secondIndex].getLng() * path[firstIndex].getLat()));

	     area += factor;

	     centerY += (path[firstIndex].getLat() + path[secondIndex].getLat()) * factor;
	     centerX += (path[firstIndex].getLng() + path[secondIndex].getLng()) * factor;
     }

	area /= 2.0;
	area *= 6.0;

     factor = 1 / area;

     centerY *= factor;
     centerX *= factor;

     latlng.lat = centerY;
     latlng.lng = centerX;

     return latlng;
}


function getCentroidOfPolygonByWCONGNAMUL(path) {

    var centerX = 0;
    var centerY = 0;
    var area = 0;
    var firstIndex = 0;
    var sizeOfVertexs = path.length;
    var factor  = 0;


    for (firstIndex = 0; firstIndex < sizeOfVertexs; firstIndex++) {
	     secondIndex = (firstIndex + 1) % sizeOfVertexs;

	     factor = ((path[firstIndex].ab * path[secondIndex].$a) - (path[secondIndex].ab * path[firstIndex].$a));

	     area += factor;

	     centerY += (path[firstIndex].ab + path[secondIndex].ab) * factor;
	     centerX += (path[firstIndex].$a + path[secondIndex].$a) * factor;
    }

	area /= 2.0;
	area *= 6.0;

     factor = 1 / area;

     centerY *= factor;
     centerX *= factor;

     return new daum.maps.Coords(centerX, centerY );
}

function zoomIn() {
    map.setLevel(map.getLevel() - 1, {animate: true});
}

function zoomOut() {
    map.setLevel(map.getLevel() +1 , {animate: true});
}

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
	/*alert("Latitude: " + position.coords.latitude +
		    "Longitude: " + position.coords.longitude);*/
	var myLocation = new daum.maps.Marker({
	    map: map,
	    position: new daum.maps.LatLng(position.coords.latitude, position.coords.longitude)
	});
}

$(document).ready(function() {
	$('.position_btn').on('click', function(){
		getLocation();

	});
});