
var popTime;	// �˾������� ����ϴ� setTimeout �� ���

$(document).ready(function(){
	
	$("#dates, #datee").datepicker({
		dateFormat:'yy-mm-dd',
		    prevText: '���� ��',
		    nextText: '���� ��',
		    monthNames: ['1��','2��','3��','4��','5��','6��','7��','8��','9��','10��','11��','12��'],
		    monthNamesShort: ['1��','2��','3��','4��','5��','6��','7��','8��','9��','10��','11��','12��'],
		    dayNames: ['��','��','ȭ','��','��','��','��'],
		    dayNamesShort: ['��','��','ȭ','��','��','��','��'],
		    dayNamesMin: ['��','��','ȭ','��','��','��','��'],
		    showMonthAfterYear: true,
		    yearSuffix: '��'
	});

	$("#dates1, #datee1").datepicker({
		dateFormat:'yy-mm-dd',
		    prevText: '���� ��',
		    nextText: '���� ��',
		    monthNames: ['1��','2��','3��','4��','5��','6��','7��','8��','9��','10��','11��','12��'],
		    monthNamesShort: ['1��','2��','3��','4��','5��','6��','7��','8��','9��','10��','11��','12��'],
		    dayNames: ['��','��','ȭ','��','��','��','��'],
		    dayNamesShort: ['��','��','ȭ','��','��','��','��'],
		    dayNamesMin: ['��','��','ȭ','��','��','��','��'],
		    showMonthAfterYear: true,
		    yearSuffix: '��'
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
	
	funcPopzone(0);		// �˾����� �̹��� �����ֱ�
	$("#mainLPopzone dl dd ul li").bind("mouseenter", function() {
		clearTimeout(popTime);		// ������ �۵��Ǵ� ���� ����
		index = $(this).index();
		funcPopzone(index);
	});
	
	funcMovieZone(0);
	
	//funcTabNotice(0); 		// ���� ���������� ��	
	$("#contNoticeL .ulNoticeBox1 li").bind("mouseenter", function (e) {
		num = $(this).parent().children().size()  - 1;		// �������� more�� bind �Ƚ�Ŵ
		if ($(this).index() < num) funcTabNotice( $(this).index() );
		
		$("#idNoticeMore").attr("href", $(this).children("a").attr("href"));
		
	});
	$("#contNoticeL .ulNoticeBox1 li:first").trigger("mouseenter");
	
	// ���� ��������	
	$("#contNoticeC .ulNoticeBox1 li").bind("mouseenter", function (e) {
		num = $(this).parent().children().size()  - 1;		// �������� more�� bind �Ƚ�Ŵ
		if ($(this).index() < num) funcTabNoticeC( $(this).index() );
		
		$("#idInfoMore").attr("href", $(this).children("a").attr("href"));		
	});
	$("#contNoticeC .ulNoticeBox1 li:first").trigger("mouseenter");	
	
});


