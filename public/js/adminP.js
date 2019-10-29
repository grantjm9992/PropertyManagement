
function addTask()
{
	$.ajax({
		type: "POST",
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		url: "Tasks.addModal",
		success: function(data)
		{
			$('#modal').remove();
			$('body').append( data );
		}
	})
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


$(document).ready ( function() {
	
})