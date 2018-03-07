
var menu_bar_mode = 1;

$(document).ready(function(){

	$('.expand_btn').click(function(){

		if ( menu_bar_mode == 1 ){
			$('#mobile_header').hide();
			
			/* 전체메뉴가 열려 있는 상태에서 모두 닫을 때, 좌측을 0px로 위치시킴 */
			$(".top").css("left", "0px");
			$("#mobile_header").css("left", "0px");
			$(".container").css("left","0px");
			/* */

			$('#mobile_menu').hide();
			$('#top_search_bar').hide();
			$('.position_btn').css('top', '-103px');
			$('.expand_btn').css('top', '-103px');
			$('.bottom_btn_group').hide();
			
			menu_bar_mode = 2;
		}
		else{
			$('#mobile_header').show();
			$('#top_search_bar').show();
			$('.position_btn').css('top', '55px');
			$('.expand_btn').css('top', '55px');
			$('.bottom_btn_group').show();
			
			menu_bar_mode = 1;
		}
	});

});
