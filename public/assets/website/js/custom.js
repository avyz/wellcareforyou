(function ($) {

	'use strict';
	// Mean Menu
	$('.mean-menu').meanmenu({
		meanScreenWidth: "991"
	});

	// Click Event JS
	$('.go-top').on('click', function () {
		$("html, body").animate({ scrollTop: "0" }, 50);
	});

	// Count Time JS
	function makeTimer() {
		var endTime = new Date("november  30, 2022 17:00:00 PDT");
		var endTime = (Date.parse(endTime)) / 1000;
		var now = new Date();
		var now = (Date.parse(now) / 1000);
		var timeLeft = endTime - now;
		var days = Math.floor(timeLeft / 86400);
		var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
		var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
		var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));
		if (hours < "10") { hours = "0" + hours; }
		if (minutes < "10") { minutes = "0" + minutes; }
		if (seconds < "10") { seconds = "0" + seconds; }
		$("#days").html(days + "<span>Day</span>");
		$("#hours").html(hours + "<span>Hours</span>");
		$("#minutes").html(minutes + "<span>Minutes</span>");
		$("#seconds").html(seconds + "<span>Seconds</span>");

		$("#dayss").html(days + "<span>d</span>");
		$("#hourss").html(hours + "<span>h</span>");
		$("#minutess").html(minutes + "<span>m</span>");
		$("#secondss").html(seconds + "<span>s</span>");
	}
	setInterval(function () { makeTimer(); }, 300);

	// Preloader
	$(window).on('load', function () {
		$('.preloader').addClass('preloader-deactivate');
	})

	// Others Option For Responsive JS
	$(".others-option-for-responsive .dot-menu").on("click", function () {
		$(".others-option-for-responsive .container .container").toggleClass("active");
	});

	// Hero Slide JS
	var swiper = new Swiper(".hero-slide", {
		autoHeight: true, //enable auto height
		pagination: {
			el: ".swiper-pagination",
			clickable: true,
			renderBullet: function (index, className) {
				return '<span class="' + className + '">' + (index + 1) + "</span>";
			},
		},
		autoplay: {
			delay: 5000,
		},
	});

	// Urgent Slide JS
	$('.urgent-slide').owlCarousel({
		loop: true,
		margin: 30,
		nav: false,
		dots: true,
		autoplay: true,
		smartSpeed: 1000,
		autoplayHoverPause: true,
		navText: [
			"<i class='ri-arrow-left-line'></i>",
			"<i class='ri-arrow-right-line'></i>",
		],
		responsive: {
			0: {
				items: 1,
			},
			414: {
				items: 2,
			},
			576: {
				items: 2,
			},
			768: {
				items: 3,
			},
			992: {
				items: 4,
			},
			1200: {
				items: 4,
			},
		},
	});

	// Client Slide JS
	$('.client-slide').owlCarousel({
		items: 1,
		loop: true,
		margin: 30,
		nav: true,
		dots: false,
		autoplay: true,
		smartSpeed: 1000,
		autoplayHoverPause: true,
		navText: [
			"<i class='ri-arrow-left-line'></i>",
			"<i class='ri-arrow-right-line'></i>",
		],
	});

	// Partner Slide JS
	$('.partner-slide').owlCarousel({
		loop: true,
		margin: 30,
		nav: false,
		dots: false,
		autoplay: true,
		smartSpeed: 1000,
		autoplayHoverPause: true,
		responsive: {
			0: {
				items: 2,
			},
			414: {
				items: 2,
			},
			576: {
				items: 3,
			},
			768: {
				items: 4,
			},
			992: {
				items: 4,
			},
			1200: {
				items: 5,
			},
		},
	});

	// Subscribe form JS
	$(".newsletter-form").validator().on("submit", function (event) {
		if (event.isDefaultPrevented()) {
			// handle the invalid form...
			formErrorSub();
			submitMSGSub(false, "Please enter your email correctly.");
		} else {
			// everything looks good!
			event.preventDefault();
		}
	});
	function callbackFunction(resp) {
		if (resp.result === "success") {
			formSuccessSub();
		}
		else {
			formErrorSub();
		}
	}
	function formSuccessSub() {
		$(".newsletter-form")[0].reset();
		submitMSGSub(true, "Thank you for subscribing!");
		setTimeout(function () {
			$("#validator-newsletter, #validator-newsletter-2").addClass('hide');
		}, 4000)
	}
	function formErrorSub() {
		$(".newsletter-form").addClass("animated shake");
		setTimeout(function () {
			$(".newsletter-form").removeClass("animated shake");
		}, 1000)
	}
	function submitMSGSub(valid, msg) {
		if (valid) {
			var msgClasses = "validation-success";
		} else {
			var msgClasses = "validation-danger";
		}
		$("#validator-newsletter, #validator-newsletter-2").removeClass().addClass(msgClasses).text(msg);
	}

	// AJAX MailChimp JS
	$(".newsletter-form").ajaxChimp({
		url: "", // Your url MailChimp
		callback: callbackFunction
	});

	// Odometer JS
	$('.odometer').appear(function (e) {
		var odo = $(".odometer");
		odo.each(function () {
			var countNumber = $(this).attr("data-count");
			$(this).html(countNumber);
		});
	});

	// WOW Animation
	if ($('.wow').length) {
		var wow = new WOW({
			boxClass: 'wow',
			animateClass: 'animated',
			offset: 0,
			mobile: false,
			live: true,
		});
		wow.init();
	}

	// PDF Dowonload
	var doc = new jsPDF();
	var specialElementHandlers = {
		'#editor': function (element, renderer) {
			return true;
		}
	};

	$('#cmd').click(function () {
		doc.fromHTML($('#content').html(), 15, 15, {
			'width': 170,
			'elementHandlers': specialElementHandlers
		});
		doc.save('wellcare.pdf');
	});

	// Search Popup JS
	$('.close-btn').on('click', function () {
		$('.search-overlay').fadeOut();
		$('.search-btn').show();
		$('.close-btn').removeClass('active');
	});
	$('.search-btn').on('click', function () {
		$(this).hide();
		$('.search-overlay').fadeIn();
		$('.close-btn').addClass('active');
	});

	// Input Plus & Minus Number JS
	$('.input-counter').each(function () {
		var spinner = jQuery(this),
			input = spinner.find('input[type="text"]'),
			btnUp = spinner.find('.plus-btn'),
			btnDown = spinner.find('.minus-btn'),
			min = input.attr('min'),
			max = input.attr('max');

		btnUp.on('click', function () {
			var oldValue = parseFloat(input.val());
			if (oldValue >= max) {
				var newVal = oldValue;
			} else {
				var newVal = oldValue + 1;
			}
			spinner.find("input").val(newVal);
			spinner.find("input").trigger("change");
		});
		btnDown.on('click', function () {
			var oldValue = parseFloat(input.val());
			if (oldValue <= min) {
				var newVal = oldValue;
			} else {
				var newVal = oldValue - 1;
			}
			spinner.find("input").val(newVal);
			spinner.find("input").trigger("change");
		});
	});

	var currentUrl = window.location.href;
	var origin = window.location.origin;

	// console.log(currentUrl.replace("#_=_", '').split("/"));
	currentUrl = origin + "/" + currentUrl.split("/")[3]



	// Menemukan elemen <a> yang sesuai dengan path URL
	var navLinks = $('.menu-link');
	navLinks.map((index, link) => {

		// // Memeriksa apakah path URL cocok dengan link URL
		if (currentUrl === link.href) {
			link.classList.add('active');
		}
	})

	$('.select-lang').select2({
		templateResult: formatResult,
		templateSelection: formatResult,
		escapeMarkup: function (m) {
			return m;
		} // Disable escaping HTML in the result text
	});

	// Hide search input using Select2 method
	$('.select-lang').on('select2:open', function () {
		$('.select2-search').hide();
	});

	function formatResult(result, container, query, escapeMarkup) {
		if (!result.id) {
			return result.text;
		}

		var $result = $(
			'<span><img src="' + result.element.dataset.imgSrc + '" class="rounded-circle" style="width:25px;height:25px"/> ' + result.text + '</span>'
		);

		return $result;
	}

	const date = new Date();
	$("#c-year").text(date.getFullYear());
})(jQuery);

