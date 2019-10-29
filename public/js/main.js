'use strict';

$(window).on('load', function() {
	/*------------------
		Preloder
	--------------------*/
	$(".loader").fadeOut(); 
	$("#preloder").delay(400).fadeOut("slow");

});

(function($) {
	$('.set-bg').each(function() {
		var bg = $(this).data('setbg');
		$(this).css('background-image', 'url(' + bg + ')');
	});
	$('.nav-switch').on('click', function(event) {
		$('.main-menu').slideToggle(400);
		event.preventDefault();
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
	window.onscroll = function() {myFunction()};
	
	var navbar = document.getElementById("navbar");
	var sticky = navbar.offsetTop;
	function myFunction() {
	  if (window.pageYOffset >= 90) {
		navbar.classList.add("default-color")
	  } else {
		navbar.classList.remove("default-color");
	  }
	}

	$('.drop-tag').on("click", function() {
		var toggle = $(this).attr('toggle');
		$("[toggleAtt='"+toggle+"']").toggle();
	});

})(jQuery);

function closeHolder()
{
	$('#img_holder').remove();
}


function changeLanguage(locale)
{
	$.ajax({
		type: "POST",
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		url: "Home.changeLanguage",
		data: {
			locale: locale
		},
		success: function(data)
		{
			if ( data == "OK" )
			{
				window.location.reload();
			}
		}
	})
}

function addTask()
{
	$.ajax({
		type: "POST",
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		url: "Tasks.addModal",
		data: {
			locale: locale
		},
		success: function(data)
		{
			$('#modal').remove();
			$('body').append( data );
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