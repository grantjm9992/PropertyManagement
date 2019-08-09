/* =================================
------------------------------------
	HALO - Photography Portfolio
	Version: 1.0
 ------------------------------------ 
 ====================================*/



'use strict';

$(window).on('load', function() {
	/*------------------
		Preloder
	--------------------*/
	$(".loader").fadeOut(); 
	$("#preloder").delay(400).fadeOut("slow");

});

(function($) {

	
	AOS.init();

	/*------------------
		Navigation
	--------------------*/
	$('.nav-switch').on('click', function(event) {
		$('.main-menu').slideToggle(400);
		event.preventDefault();
	});


	/*------------------
		PORTFOLIO
	--------------------*/
	if($('.portfolio-warp').length > 0 ) {
		var containerEl = document.querySelector('.portfolio-warp');
		var mixer = mixitup(containerEl);
	}


	/*------------------
		Background set
	--------------------*/
	$('.set-bg').each(function() {
		var bg = $(this).data('setbg');
		$(this).css('background-image', 'url(' + bg + ')');
	});



	/*------------------
		Hero Slider
	--------------------*/
	
	var owl = $('.hero-slider').owlCarousel({
		animateOut: 'slideOutDown',
		animateIn: 'slideInDown',
		loop: true,
		nav: true,
		dots: true,
		mouseDrag: false,
		navText: [' ', ''],
		items: 1,
		autoplay: true
	});

	var dot = $('.hero-slider .owl-dot');
	dot.each(function() {
		var index = $(this).index() + 1;
		if(index < 10){
			$(this).html('0').append(index);
			$(this).append('<span>.</span>');
		}else{
			$(this).html(index);
			$(this).append('<span>.</span>');
		}
	});


	/*------------------
		Review Slider
	--------------------*/
	$('.review-slider').owlCarousel({
		margin: 10,
		loop: true,
		nav: false,
		dots: false,
		items: 1,
		autoplay: true,
	});


	/*------------------
		Work Slider
	--------------------*/
	$('.work-slider').owlCarousel({
		margin: 0,
		loop: true,
		nav: true,
		dots: false,
		items: 1,
		autoplay: true,
		animateOut: 'fadeOut',
    	animateIn: 'fadeIn',
	});


	/*------------------
		Circle progress
	--------------------*/
	$('.circle-progress').each(function() {
		var cpvalue = $(this).data("cpvalue");
		var cpcolor = $(this).data("cpcolor");
		var cptitle = $(this).data("cptitle");
		var cpid 	= $(this).data("cpid");

		$(this).append('<div class="'+ cpid +'"></div><div class="progress-info"><h2>'+ cpvalue +'%</h2><p>'+ cptitle +'</p></div>');

		if (cpvalue < 100) {

			$('.' + cpid).circleProgress({
				value: '0.' + cpvalue,
				size: 240,
				thickness: 3,
				fill: cpcolor,
				emptyFill: "rgba(0, 0, 0, 0)"
			});
		} else {
			$('.' + cpid).circleProgress({
				value: 1,
				size: 240,
				thickness: 3,
				fill: cpcolor,
				emptyFill: "rgba(0, 0, 0, 0)"
			});
		}

	});


	/*------------------
		Accordions
	--------------------*/
	$('.panel-link').on('click', function (e) {
		$('.panel-link').parent('.panel-header').removeClass('active');
		var $this = $(this).parent('.panel-header');
		if (!$this.hasClass('active')) {
			$this.addClass('active');
		}
		e.preventDefault();
	});

	$('.single-portfolio').click( function() {
		closeHolder();
		var url = $(this).attr('data-setbg');
		var holder = document.createElement('div');
		holder.id = "img_holder";
		$(holder).css({
			height: "100vh",
			width: "100vw",
			background: "rgba(0,0,0,0.75)",
			position: "fixed",
			top: 0,
			left: 0,
			padding: "50px",
			lineHeight: "calc(100vh - 100px)",
			textAlign: "center"
		});
		$(holder).html('<img src="'+url+'" style="max-height: 100%; max-width: 100%;">');
		$('body').append(holder);
		$(holder).click( function() {
			closeHolder();
		});
	});
	$('.openimg').click( function() {
		var url = $(this).attr('src');
		var holder = document.createElement('div');
		holder.id = "img_holder";
		$(holder).css({
			height: "100vh",
			width: "100vw",
			background: "rgba(0,0,0,0.75)",
			position: "fixed",
			top: 0,
			left: 0,
			padding: "50px",
			zIndex: "1000",
			lineHeight: "calc(100vh - 100px)",
			textAlign: "center"
		});
		$(holder).html('<img src="'+url+'" style="max-height: 100%; max-width: 100%;">');
		$('body').append(holder);
		$(holder).click( function() {
			closeHolder();
		});
	})
	document.addEventListener("keydown", function(event) {
		if ( event.which === 27 )
		{
			closeHolder();
		}
	});


})(jQuery);

function closeHolder()
{
	$('#img_holder').remove();
}


function register()
{
	$('#register').remove();
	$.ajax({
		type: "POST",
		url: "Home.registerModal",
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		success: function(data)
		{
			$('body').append(data);
		}
	})
}

function acceptCookies()
{
	$('#cookies').remove();
	$.ajax({
		type: "POST",
		url: "Home.acceptCookies",
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		success: function(data)
		{
		}
	})
}



$(document).ready( function() {
	window.swalOptions = Array();
	window.swalOptions.title = "Error";
	window.swalOptions.text = "";
	window.swalOptions.icon = "";
	window.swalOptions.className = "";
	window.swalOptions.closeOnClickOutside = true;
	window.swalOptions.dangerMode = false;
	window.swalOptions.timer = null;
	window.swalOptions.thenParameters = null;
	window.swalOptions.thenFunction = null;
	window.swalOptions.buttons = {
		cancel: {
			text: "Accept",
			value: null,
			visible: true,
			closeModal: true
		}
	}

	window.swalOptions.className = "";
	window.swalOptions.closeOnClickOutside = true;
	window.swalOptions.dangerMode = false;
	window.swalOptions.timer = null;

	window.swalConfirmOptions = Array();
	window.swalConfirmOptions.title = "Warning";
	window.swalConfirmOptions.text = "";
	window.swalConfirmOptions.icon = "warning";
	window.swalConfirmOptions.thenFunction = null;
	window.swalConfirmOptions.thenParameters = null;
	window.swalConfirmOptions.buttons = {
		confirmar: {
			text: "Confirm",
			value: 1,
			className: "btn-success"
		},
		cancelar: {
			text: "Cancel",
			value: null,
			className: "btn-danger"
		}
	};
})
function sweetAlert( options, icon = null )
{
	var config = window.swalOptions;
	if ( typeof options === "string" )
	{
		config.title = options;
		config.icon = icon;
	}
	else
	{
		if ( options.type && options.type == "confirm" )
		{
			config = window.swalConfirmOptions;
		}
		$.extend ( config, options );
	}
	swal( 
		{
			title: config.title,
			text: config.text,
			icon: config.icon,
			buttons: config.buttons,
			content: config.content,
			className: config.className,
			closeOnClickOutside: config.closeOnClickOutside,
			dangerMode: config.dangerMode,
			timer: config.timer
		}
	 ).then((result) => {
		window.result = result;
		if (result) {
			config.thenFunction(config.thenParameters);
		} else {

		}
	});
}