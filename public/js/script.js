(function ($) {
	'use strict';
	var $window = $(window);
	var $body = $('body');
	var Unicom = {
		init: function () {
			Unicom.Menu();
			Unicom.Form();
			Unicom.Button();
			Unicom.Background();
			Unicom.Tooltip();
			Unicom.Customizer();
			$window.on('load', function () {
				Unicom.Animation();
			});
		},
		Menu: function () {
			var $headerNavWrap = $('#header.header-nav-bottom .navigation-wrap');
			var $navigation = $('#navigation, #customize');
			if ($body.hasClass('body-header-nav-bottom')) {
				$headerNavWrap.waypoint(function () {
					$navigation.removeClass('affix');
				}, {
					offset: 1
				});
				$headerNavWrap.waypoint(function () {
					$navigation.addClass('affix');
				});
			} else {
				if ($body.hasClass('body-header-2') || $body.hasClass('body-header-4') || $body.hasClass('body-header-5') || $body.hasClass('body-header-transparent')) {
					$body.waypoint(function () {
						$navigation.removeClass('affix');
					}, {
						offset: -1
					});
					$body.waypoint(function () {
						$navigation.addClass('affix');
					}, {
						offset: -2
					});
				} else if ($body.hasClass('body-header-3')) {
					$body.waypoint(function () {
						$navigation.removeClass('affix');
					}, {
						offset: -140
					});
					$body.waypoint(function () {
						$navigation.addClass('affix');
					}, {
						offset: -141
					});
				} else {
					$body.waypoint(function () {
						$navigation.removeClass('affix');
					}, {
						offset: -40
					});
					$body.waypoint(function () {
						$navigation.addClass('affix');
					}, {
						offset: -41
					});
				}
			}
			var timeout;
			$('#navigation .navbar-menu .nav li').on('mouseover', function () {
				var $elem = $('.sub-menu', $(this)).first();
				if ($elem.length > 0) {
					if ($elem.offset().left + $elem.outerWidth() > $window.width()) {
						$elem.addClass('sub-menu-left');
					}
				}
				clearTimeout(timeout);
			});
			$('#navigation .navbar-menu .nav').on('mouseleave', function () {
				timeout = setTimeout(function (elem) {
					$('.sub-menu.sub-menu-left', elem).removeClass('sub-menu-left');
				}, 200);
			});
			$('#nav-mobile .scrollbar-inner, #nav-shop-filter .scrollbar-inner').scrollbar();
		},
		
		Form: function () {
			var pattern = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i;
			$('.affa-form-subscribe input[type="text"], .affa-form-subscribe input[type="email"]').on('focus keypress', function () {
				var $input = $(this);
				if ($input.hasClass('error')) {
					$input.val('').removeClass('error');
				}
				if ($input.hasClass('success')) {
					$input.val('').removeClass('success');
				}
			});
			$('.affa-form-contact input[type="text"], .affa-form-contact input[type="email"], .affa-form-contact textarea, .affa-form-signup input[type="text"], .affa-form-signup input[type="email"], .affa-form-signup input[type="password"], .affa-form-signup textarea, .affa-form-signup select, .affa-form-signup2 input[type="text"], .affa-form-signup2 input[type="email"], .affa-form-signup2 input[type="password"], .affa-form-signup2 textarea, .affa-form-signup2 select, .affa-form-signup3 input[type="text"], .affa-form-signup3 input[type="email"], .affa-form-signup3 input[type="password"], .affa-form-signup3 textarea, .affa-form-signup3 select').on('focus keypress', function () {
				var $input = $(this);
				if ($input.hasClass('error')) {
					$input.removeClass('error');
				}
			});
			$('.affa-form-subscribe').submit(function () {
				var $email = $(this).find('input[name="email"]');
				var $submit = $(this).find('input[name="submit"]');
				if (pattern.test($email.val()) === false) {
					$email.val('Please enter a valid email address!').addClass('error');
				} else {
					var submitData = $(this).serialize();
					$email.attr('disabled', 'disabled');
					$submit.attr('disabled', 'disabled');
					$.ajax({
						type: 'POST',
						url: 'includes/mailchimp/process-subscribe.php',
						data: submitData + '&action=add',
						dataType: 'html',
						success: function (msg) {
							if (parseInt(msg, 0) !== 0) {
								var msg_split = msg.split('|');
								if (msg_split[0] === 'success') {
									$submit.removeAttr('disabled');
									$email.removeAttr('disabled').val(msg_split[1]).addClass('success');
								} else {
									$submit.removeAttr('disabled');
									$email.removeAttr('disabled').val(msg_split[1]).addClass('error');
								}
							}
						}
					});
				}
				return false;
			});
			$('.affa-form-contact').submit(function () {
				var $form = $(this);
				var submitData = $form.serialize();
				var $name = $form.find('input[name="name"]');
				var $email = $form.find('input[name="email"]');
				var $subject = $form.find('input[name="subject"]');
				var $message = $form.find('textarea[name="message"]');
				var $submit = $form.find('input[name="submit"]');
				var status = true;
				if ($email.val() === '' || pattern.test($email.val()) === false) {
					$email.addClass('error');
					status = false;
				}
				if ($message.val() === '') {
					$message.addClass('error');
					status = false;
				}
				if (status) {
					$name.attr('disabled', 'disabled');
					$email.attr('disabled', 'disabled');
					$subject.attr('disabled', 'disabled');
					$message.attr('disabled', 'disabled');
					$submit.attr('disabled', 'disabled');
					$.ajax({
						type: 'POST',
						url: 'includes/process-contact.php',
						data: submitData + '&action=add',
						dataType: 'html',
						success: function (msg) {
							if (parseInt(msg, 0) !== 0) {
								var msg_split = msg.split('|');
								if (msg_split[0] === 'success') {
									$name.val('').removeAttr('disabled').removeClass('error');
									$email.val('').removeAttr('disabled').removeClass('error');
									$subject.val('').removeAttr('disabled').removeClass('error');
									$message.val('').removeAttr('disabled').removeClass('error');
									$submit.removeAttr('disabled');
									$form.find('.submit-status').html('<div class="submit-status-text"><span class="success"><i class="ion ion-ios-checkmark-outline"></i> ' + msg_split[1] + '</span></div>').fadeIn(300).delay(3000).fadeOut(300);
								} else {
									$name.removeAttr('disabled').removeClass('error');
									$email.removeAttr('disabled').removeClass('error');
									$subject.removeAttr('disabled').removeClass('error');
									$message.removeAttr('disabled').removeClass('error');
									$submit.removeAttr('disabled').removeClass('error');
									$form.find('.submit-status').html('<div class="submit-status-text"><span class="error"><i class="ion ion-ios-close-outline"></i> ' + msg_split[1] + '</span></div>').fadeIn(300).delay(3000).fadeOut(300);
								}
							}
						}
					});
				}
				status = true;
				return false;
			});
			$('.affa-form-signup').submit(function () {
				var $form = $(this);
				var submitData = $form.serialize();
				var $name = $form.find('input[name="name"]');
				var $email = $form.find('input[name="email"]');
				var $submit = $form.find('input[name="submit"]');
				var status = true;
				if ($email.val() === '' || pattern.test($email.val()) === false) {
					$email.addClass('error');
					status = false;
				}
				if (status) {
					$name.attr('disabled', 'disabled');
					$email.attr('disabled', 'disabled');
					$submit.attr('disabled', 'disabled');
					$.ajax({
						type: 'POST',
						url: 'includes/process-signup.php',
						data: submitData + '&action=add',
						dataType: 'html',
						success: function (msg) {
							if (parseInt(msg, 0) !== 0) {
								var msg_split = msg.split('|');
								if (msg_split[0] === 'success') {
									$name.val('').removeAttr('disabled');
									$email.val('').removeAttr('disabled');
									$submit.removeAttr('disabled');
									$form.parents('.header-content-form').find('.submit-status').html('<span class="success"><i class="ion ion-ios-checkmark-outline"></i> ' + msg_split[1] + '</span>').fadeIn(300).delay(3000).fadeOut(300);
								} else {
									$name.removeAttr('disabled');
									$email.removeAttr('disabled');
									$submit.removeAttr('disabled');
									$form.parents('.header-content-form').find('.submit-status').html('<span class="error"><i class="ion ion-ios-close-outline"></i> ' + msg_split[1] + '</span>').fadeIn(300).delay(3000).fadeOut(300);
								}
							}
						}
					});
				}
				status = true;
				return false;
			});
			$('.affa-form-signup2').submit(function () {
				var $form = $(this);
				var submitData = $form.serialize();
				var $name = $form.find('input[name="name"]');
				var $email = $form.find('input[name="email"]');
				var $phone = $form.find('input[name="phone"]');
				var $message = $form.find('textarea[name="message"]');
				var $agree = $form.find('input[name="agree"]');
				var $submit = $form.find('input[name="submit"]');
				var status = true;
				if ($email.val() === '' || pattern.test($email.val()) === false) {
					$email.addClass('error');
					status = false;
				}
				if ($message.val() === '') {
					$message.addClass('error');
					status = false;
				}
				if (status) {
					$name.attr('disabled', 'disabled');
					$email.attr('disabled', 'disabled');
					$phone.attr('disabled', 'disabled');
					$message.attr('disabled', 'disabled');
					$agree.attr('disabled', 'disabled');
					$submit.attr('disabled', 'disabled');
					$.ajax({
						type: 'POST',
						url: 'includes/process-signup2.php',
						data: submitData + '&action=add',
						dataType: 'html',
						success: function (msg) {
							if (parseInt(msg, 0) !== 0) {
								var msg_split = msg.split('|');
								if (msg_split[0] === 'success') {
									$name.val('').removeAttr('disabled');
									$email.val('').removeAttr('disabled');
									$phone.val('').removeAttr('disabled');
									$message.val('').removeAttr('disabled');
									$agree.attr('checked', false).removeAttr('disabled');
									$submit.removeAttr('disabled');
									$form.siblings('.submit-status').html('<span class="success"><i class="ion ion-ios-checkmark-outline"></i> ' + msg_split[1] + '</span>').fadeIn(300).delay(3000).fadeOut(300);
								} else {
									$name.removeAttr('disabled');
									$email.removeAttr('disabled');
									$phone.removeAttr('disabled');
									$message.removeAttr('disabled');
									$agree.removeAttr('disabled');
									$submit.removeAttr('disabled');
									$form.siblings('.submit-status').html('<span class="error"><i class="ion ion-ios-close-outline"></i> ' + msg_split[1] + '</span>').fadeIn(300).delay(3000).fadeOut(300);
								}
							}
						}
					});
				}
				status = true;
				return false;
			});
			$('.affa-form-signup3').submit(function () {
				var $form = $(this);
				var submitData = $form.serialize();
				var $name = $form.find('input[name="name"]');
				var $email = $form.find('input[name="email"]');
				var $phone = $form.find('input[name="phone"]');
				var $message = $form.find('textarea[name="message"]');
				var $submit = $form.find('input[name="submit"]');
				var status = true;
				if ($email.val() === '' || pattern.test($email.val()) === false) {
					$email.addClass('error');
					status = false;
				}
				if ($message.val() === '') {
					$message.addClass('error');
					status = false;
				}
				if (status) {
					$name.attr('disabled', 'disabled');
					$email.attr('disabled', 'disabled');
					$phone.attr('disabled', 'disabled');
					$message.attr('disabled', 'disabled');
					$submit.attr('disabled', 'disabled');
					$.ajax({
						type: 'POST',
						url: 'includes/process-signup3.php',
						data: submitData + '&action=add',
						dataType: 'html',
						success: function (msg) {
							if (parseInt(msg, 0) !== 0) {
								var msg_split = msg.split('|');
								if (msg_split[0] === 'success') {
									$name.val('').removeAttr('disabled');
									$email.val('').removeAttr('disabled');
									$phone.val('').removeAttr('disabled');
									$message.val('').removeAttr('disabled');
									$submit.removeAttr('disabled');
									$form.siblings('.submit-status').html('<span class="success"><i class="ion ion-ios-checkmark-outline"></i> ' + msg_split[1] + '</span>').fadeIn(300).delay(3000).fadeOut(300);
								} else {
									$name.removeAttr('disabled');
									$email.removeAttr('disabled');
									$phone.removeAttr('disabled');
									$message.removeAttr('disabled');
									$submit.removeAttr('disabled');
									$form.siblings('.submit-status').html('<span class="error"><i class="ion ion-ios-close-outline"></i> ' + msg_split[1] + '</span>').fadeIn(300).delay(3000).fadeOut(300);
								}
							}
						}
					});
				}
				status = true;
				return false;
			});
		},
		Button: function () {
			var menuOpenProcess = false;
			$('#header .navbar-btn-toggle').on('click', function () {
				menuOpenProcess = true;
				if ($body.hasClass('nav-mobile-open')) {
					$body.removeClass('nav-mobile-open');
				} else {
					$body.addClass('nav-mobile-open');
				}
				setTimeout(function () {
					menuOpenProcess = false;
				}, 100);
			});
			$('#nav-mobile .navbar-btn-close').on('click', function () {
				$body.removeClass('nav-mobile-open');
			});
			$('#nav-mobile .nav li.menu-item-has-children > span').on('click', function () {
				menuOpenProcess = true;
				if ($(this).hasClass('in')) {
					$(this).siblings('ul').slideUp(200, function () {
						$(this).removeClass('in').siblings('span').removeClass('in').text('+');
						menuOpenProcess = false;
					});
				} else {
					$(this).addClass('in').text('-').siblings('ul').slideDown(200, function () {
						$(this).addClass('in');
						menuOpenProcess = false;
					});
				}
			});
			var filterOpenProcess = false;
			$('.products-nav .products-nav-filter').on('click', function (e) {
				filterOpenProcess = true;
				if ($body.hasClass('nav-shop-filter-open')) {
					$body.removeClass('nav-shop-filter-open');
				} else {
					$body.addClass('nav-shop-filter-open');
				}
				setTimeout(function () {
					filterOpenProcess = false;
				}, 100);
				e.preventDefault();
			});
			$('#nav-shop-filter .navbar-btn-close').on('click', function () {
				$body.removeClass('nav-shop-filter-open');
			});
			$('#body-wrap').on('click', function () {
				if ($body.hasClass('nav-mobile-open') && menuOpenProcess === false || $body.hasClass('nav-shop-filter-open') && filterOpenProcess === false) {
					$body.removeClass('nav-mobile-open').removeClass('nav-shop-filter-open');
				}
			});
			$('#navigation .navbar-secondary .btn-cart, #navigation .navbar-secondary .navbar-cart').on('mouseenter', function () {
				var $cart = $(this).parents('.navbar-secondary').find('.navbar-cart');
				if (!$cart.hasClass('in')) {
					$cart.addClass('in');
				}
			});
			$('#navigation .navbar-secondary .btn-cart, #navigation .navbar-secondary .navbar-cart').on('mouseleave', function () {
				$(this).parents('.navbar-secondary').find('.navbar-cart').removeClass('in');
			});
			$('#nav-mobile-top .navbar-secondary .btn-cart').on('click', function (e) {
				var $cart = $(this).parents('.navbar-secondary').find('.navbar-cart');
				if ($cart.hasClass('in')) {
					$cart.removeClass('in');
				} else {
					$cart.addClass('in');
				}
				e.preventDefault();
			});
			$('#navigation .navbar-secondary .btn-search, #nav-mobile-top .navbar-secondary .btn-search').on('click', function (e) {
				var $form = $(this).parents('.navbar-btn').next();
				$form.addClass('in');
				setTimeout(function () {
					$form.find('input[type="text"]').focus();
				}, 200);
				if ($(this).parents('#header.header-transparent').length > 0) {
					$(this).parents('.navbar').addClass('bg-white');
				}
				e.preventDefault();
			});
			$('#navigation .navbar-secondary .btn-close, #nav-mobile-top .navbar-secondary .btn-close').on('click', function () {
				$(this).parents('form').removeClass('in');
				if ($(this).parents('#header.header-transparent').length > 0) {
					$(this).parents('.navbar').removeClass('bg-white');
				}
			});
			$('.panel-group a[data-toggle="collapse"], .nav-tabs a').on('click', function () {
				setTimeout(function () {
					$window.trigger('resize.px.parallax');
				}, 400);
			});
			$('.panel-group-toggle .panel-heading a').each(function () {
				$(this).on('click', function () {
					var $elem = $(this);
					var $tab_id = $($elem.attr('href'));
					if ($tab_id.hasClass('in')) {
						$elem.addClass('collapsed');
						$tab_id.slideUp(300, function () {
							$(this).removeClass('in');
						});
					} else {
						$elem.removeClass('collapsed');
						$tab_id.slideDown(300, function () {
							$(this).addClass('in');
						});
					}
					return false;
				});
			});
			$('.products-nav .products-nav-options .option-selected').on('click', function () {
				if ($(this).hasClass('active')) {
					$(this).removeClass('active').siblings('.options-list').removeClass('in');
				} else {
					$(this).addClass('active').siblings('.options-list').addClass('in');
				}
			});
			$('.products-nav .products-nav-options .options-list li').on('click', function () {
				$(this).parents('.options-list').removeClass('in').find('li').removeClass('current');
				$(this).addClass('current');
				$(this).parents('.options-list').siblings('.option-selected').html($(this).html()).removeClass('active');
			});
			var $scrollUp = $('.scrollup');
			$body.waypoint(function () {
				$scrollUp.removeClass('visible');
			}, {
				offset: -130
			});
			$body.waypoint(function () {
				$scrollUp.addClass('visible');
			}, {
				offset: -131
			});
			$scrollUp.click(function () {
				$('html, body').stop().animate({
					scrollTop: 0
				}, 2000, 'easeOutExpo');
				return false;
			});
		},
		Background: function () {
			$window.resize(function () {
				setTimeout(function () {
					$window.trigger('resize.px.parallax');
				}, 400);
			});
		},
		Tooltip: function () {
			$('.btn-tooltip').tooltip();
			var $btnPopover = $('.btn-popover');
			$btnPopover.popover();
			$btnPopover.on('click', function (e) {
				e.preventDefault();
			});
		},
		Animation: function () {
			$('.animation, .animation-visible').each(function () {
				var $element = $(this);
				$element.waypoint(function () {
					var delay = 0;
					if ($element.data('delay')) {
						delay = parseInt($element.data('delay'), 0);
					}
					if (!$element.hasClass('animated')) {
						setTimeout(function () {
							$element.addClass('animated ' + $element.data('animation'));
						}, delay);
					}
					delay = 0;
				}, {
					offset: '80%'
				});
			});
		},
		Customizer: function () {
			$('#customize .popup-open').click(function () {
				var $parent = $(this).parents('#customize');
				if ($parent.hasClass('in')) {
					$parent.removeClass('in');
				} else {
					$parent.addClass('in');
				}
			});
			$('#customize .scrollbar-inner').scrollbar();
			$('#customize .customize-color a').click(function (e) {
				var $color = $(this).attr('class');
				$('head').append('<link rel="stylesheet" type="text/css" href="css/colors/' + $color + '/color.css">');
				e.preventDefault();
			});
		}
	};
	$(function () {
		Unicom.init();
	});
})(window.jQuery);