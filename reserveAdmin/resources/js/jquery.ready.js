
var popTime;	// 팝업존에서 사용하는 setTimeout 를 기억

$(document).ready(function(){
	
	$("#dates, #datee").datepicker({
		dateFormat:'yy-mm-dd',
		    prevText: '이전 달',
		    nextText: '다음 달',
		    monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
		    monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
		    dayNames: ['일','월','화','수','목','금','토'],
		    dayNamesShort: ['일','월','화','수','목','금','토'],
		    dayNamesMin: ['일','월','화','수','목','금','토'],
		    showMonthAfterYear: true,
		    yearSuffix: '년'
	});

	$("#dates1, #datee1").datepicker({
		dateFormat:'yy-mm-dd',
		    prevText: '이전 달',
		    nextText: '다음 달',
		    monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
		    monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
		    dayNames: ['일','월','화','수','목','금','토'],
		    dayNamesShort: ['일','월','화','수','목','금','토'],
		    dayNamesMin: ['일','월','화','수','목','금','토'],
		    showMonthAfterYear: true,
		    yearSuffix: '년'
	});
	/*			   
	$("#MainMenu > dl > dd > ul > li").mouseover(function(){
		$(this).children("dl").slideDown('fast');
	}).mouseleave(function(){
		$(this).children("dl").slideUp('fast');
	});
	*/

	function MenuView() {
		$("#menubg1").slideDown("fast");
	}

	function MenuHidden() {
		$("#menubg1").slideUp("fast");
	}
	
	funcPopzone(0);		// 팝업존의 이미지 보여주기
	$("#mainLPopzone dl dd ul li").bind("mouseenter", function() {
		clearTimeout(popTime);		// 기존에 작동되는 것을 중지
		index = $(this).index();
		funcPopzone(index);
	});
	
	funcMovieZone(0);
	
	//funcTabNotice(0); 		// 메인 공지사항의 탭	
	$("#contNoticeL .ulNoticeBox1 li").bind("mouseenter", function (e) {
		num = $(this).parent().children().size()  - 1;		// 마지막은 more라서 bind 안시킴
		if ($(this).index() < num) funcTabNotice( $(this).index() );
		
		$("#idNoticeMore").attr("href", $(this).children("a").attr("href"));
		
	});
	$("#contNoticeL .ulNoticeBox1 li:first").trigger("mouseenter");
	
	// 메인 정보마당	
	$("#contNoticeC .ulNoticeBox1 li").bind("mouseenter", function (e) {
		num = $(this).parent().children().size()  - 1;		// 마지막은 more라서 bind 안시킴
		if ($(this).index() < num) funcTabNoticeC( $(this).index() );
		
		$("#idInfoMore").attr("href", $(this).children("a").attr("href"));		
	});
	$("#contNoticeC .ulNoticeBox1 li:first").trigger("mouseenter");	
	
});


