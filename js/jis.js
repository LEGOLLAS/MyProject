/*
 * JQuery Plugin
 * 제작자: 최종욱 (2014.09.04) ㅋㅋㅋ
 * 버전: 0.1
 * 용도: 탭메뉴, 롤링배너 등등에 쓰임
 *
 * 사용법
 * 탭메뉴, 롤링배너 : $('selector').jis([optioins]);
 * options: default
 * {
 *		type: 'show', //보여줄 형태 slide, show, fade
 *		rolling: false, //자동전환 여부
 *		rollingSpeed: 3000, //자동 전환 시간
 *		animateSpeed: 400, //type이 fade, slide일시 애니메이션속도
 *		autoReverse: true, //자동반복 여부
 *		slideWay: 'left' //슬라이드 방향, left, down
 * }
 *
 * 좌우이동 컨텐츠 : $('selector').jim([options]);
 * options: default
 * {
 *		type: 'show', //보여줄 형태 slide, show, fade
 *		animateSpeed: 400, //type이 fade, slide일시 애니메이션속도
 * }
 *
 * - 셀렉터 안에 컨텐츠 영역과 네비게이션 영역이 필요함
 * - 영역구분은 section으로 함.
 *   컨텐츠 영역 : section="content"
 *   네비게이션 영역 : section="navi"
 * - 각 영역안에 구분은 no="숫자"로 함. 1부터 1씩 증가.
 *
 */
(function($) {
	$.fn.extend({
		jim: function(opt) {
			var defaults = {
				type: 'show', //보여줄 형태 slide, show, fade
				animateSpeed: 400, //type이 fade, slide일시 애니메이션속도
				usetitle: false
			};
			var options = $.extend(defaults, opt);

			return this.each(function() {
				var content = $(this).find('[section="content"]');
				var contents = content.find('[no]');
				var navi = $(this).find('[section="navi"]');
				var navis = navi.find('[arrow]');
				contents.hide();
				$(contents[0]).show();
				navis.removeClass('sel');
				$(navis[0]).addClass('sel');

				var total = $(this).find('[section="total"]');
				var nowPage = $(this).find('[section="nowPage"]');
				var no = 1;

				if (options.usetitle === true) {
					total.html($(contents[1]).attr('j_title'));
					nowPage.html($(contents[0]).attr('j_title'));
				} else {
					total.html(contents.length);
					nowPage.html(no);
				}

				if (options.type == 'fade' || options.type == 'slide') {
					contents.css({'position': 'absolute', 'z-index': '100'});
					var parent_obj = $(contents[0]).parent();
					if (!parent_obj.height()) {
						var force_height = true;
						parent_obj.height($(contents[0]).height());
					}
				}

				navis.click(function() {
					switch($(this).attr('arrow')) {
						case 'left':
							change((no - 1), 'left');
							break;
						case 'right':
							change((no + 1), 'right');
							break;
					}
				});

				var change = function(page, way) {
					var tmp_no = no;
					if (contents.length < page) {
						page = 1;
					} else if (page < 1) {
						page = contents.length;
					}

					no = page;

					if (options.usetitle === true) {
						nowPage.html($(contents[(page - 1)]).attr('j_title'));
						if (page >= contents.length) {
							page = 0;
						}
						total.html($(contents[page]).attr('j_title'));
					} else {
						nowPage.html(page);
					}

					switch (options.type) {
						case 'slide':
							switch (way) {
								case 'left':
									if (force_height === true && parent_obj.height() < content.find('[no="'+no+'"]').height()) {
										parent_obj.height(content.find('[no="'+no+'"]').height());
									}
									content.find('[no="'+tmp_no+'"]').stop().animate({"left": "100%"}, options.animateSpeed, function() {
										$(this).hide();
									});
									content.find('[no="'+no+'"]').stop().css({'left': '-100%'}).show().animate({"left": "0"}, options.animateSpeed, function() {
										if (force_height === true && parent_obj.height() > content.find('[no="'+no+'"]').height()) {
											parent_obj.height(content.find('[no="'+no+'"]').height());
										}
									});
									break;
								case 'right':
									if (force_height === true && parent_obj.height() < content.find('[no="'+no+'"]').height()) {
										parent_obj.height(content.find('[no="'+no+'"]').height());
									}
									content.find('[no="'+tmp_no+'"]').stop().animate({"left": "-100%"}, options.animateSpeed, function() {
										$(this).hide();
									});
									content.find('[no="'+no+'"]').stop().css({'left': '100%'}).show().animate({"left": "0"}, options.animateSpeed, function() {
										if (force_height === true && parent_obj.height() > content.find('[no="'+no+'"]').height()) {
											parent_obj.height(content.find('[no="'+no+'"]').height());
										}
									});
									break;
							}
							break;
						case 'fade':
							if (force_height === true && parent_obj.height() < content.find('[no="'+no+'"]').height()) {
								parent_obj.height(content.find('[no="'+no+'"]').height());
							}
							content.find('[no="'+tmp_no+'"]').stop().fadeOut(options.animateSpeed);
							content.find('[no="'+no+'"]').stop().css({'z-index': '110'}).fadeIn(options.adimateSpeed, function(){
								$(this).css({'z-index': '100'});
								if (force_height === true && parent_obj.height() > content.find('[no="'+no+'"]').height()) {
									parent_obj.height(content.find('[no="'+no+'"]').height());
								}
							});
							break;
						case 'show': default:
							contents.hide();
							content.find('[no="'+no+'"]').show();
							break;
					}
				};
			});
		},

		jis: function(opt) {
			var defaults = {
				type: 'show', //보여줄 형태 slide, show, fade
				rolling: false, //자동전환 여부
				rollingSpeed: 3000, //자동 전환 시간
				animateSpeed: 800, //type이 fade, slide일시 애니메이션속도
				autoReverse: true, //자동반복 여부
				slideType: 'cicle', //슬라이드 롤링시 순환방법 cicle, first
				slideWay: 'left', //슬라이드 방향, left, down
				controlButton: '',
				play: '',
				stop: ''
			};
			var options = $.extend(defaults, opt);

			return this.each(function() {
				var content = $(this).find('[section="content"]');
				var navi = $(this).find('[section="navi"]');
				var contents = content.find('[no]');
				var navis = navi.find('[no]');
				var no = $(navis[0]).attr('no');
				contents.hide();
				$(contents[0]).show();
				navis.removeClass('sel');
				$(navis[0]).addClass('sel');

				navis.click(function() {
					changeSet($(this));
				});

				if (options.type == 'fade' || options.type == 'slide') {
					navi.css('z-index', '200');
					contents.css({'position': 'absolute', 'z-index': '100'});
				}

				var changeSet = function(obj) {
					var tmp_no = no;
					no = obj.attr('no');
					if (tmp_no == no) {
						return false;
					}
					navis.removeClass('sel');
					obj.addClass('sel');
					switch (options.type) {
						case 'slide':
							switch (options.slideWay) {
								case 'down':
									content.find('[no="'+tmp_no+'"]').stop().animate({'bottom': '-103%'}, options.animateSpeed, function() {
										$(this).hide().css('bottom', 'auto');
									});
									content.find('[no="'+no+'"]').stop().css({'bottom': '100%'}).show().animate({'bottom': '0'}, options.animateSpeed);
									break;
								case 'up':
									//content.find('[no="'+no+'"]').stop().css('bottom', '0').slideDown(options.animateSpeed);
									break;
								case 'right':
									break;
								case 'left': default:
									content.find('[no="'+tmp_no+'"]').stop().animate({"left": "-100%"}, options.animateSpeed, function() {
										$(this).hide();
									});
									content.find('[no="'+no+'"]').stop().css({'left': '100%'}).show().animate({"left": "0"}, options.animateSpeed);
									break;
							}
							break;
						case 'fade':
							content.find('[no="'+no+'"]').stop().css('z-index', '110').fadeIn(options.adimateSpeed);
							content.find('[no="'+tmp_no+'"]').stop().css('z-index', '100').fadeOut(options.animateSpeed);
							break;
						case 'show': default:
							contents.hide();
							content.find('[no="'+no+'"]').show();
							break;
					}
				};

				var setTimer = function() {
					if (play === true) {
						timer = setInterval(function() {
							var tmp_no = parseInt(no);

							if (navis.length <= tmp_no) {
								tmp_no = 0;
							}
							changeSet($(navis[tmp_no]));

							if (options.autoReverse === false && navis.length <=  parseInt(no)) {
								clearInterval(timer);
								navis.off('mouseenter');
								navis.off('mouseleave');
							}
						}, options.rollingSpeed);
					}
				};

				if (options.rolling === true) {
					var timer = null;
					var play = true;

					setTimer();

					navis.hover(function() {
						clearInterval(timer);
					}, function() {
						if (play === true) {
							setTimer();
						}
					});

					$(options.controlButton).click(function() {
						if (play === true) {
							play = false;
							clearInterval(timer);
							$(this).find('img').attr('src', function() {
								$(this).attr('alt', '재생');
								return $(this).attr('src').replace(options.stop, options.play);
							});
						} else {
							play = true;
							setTimer();
							$(this).find('img').attr('src', function() {
								$(this).attr('alt', '일시정지');
								return $(this).attr('src').replace(options.play, options.stop);
							});
						}

						return false;
					});
				}
			});
		}
	});
})(jQuery);
/*
 * JQuery Plugin 끝!!!!!
 */

