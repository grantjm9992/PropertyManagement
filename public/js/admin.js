;(function () {
	
	'use strict';

	var openViewer = function()
	{
		$('.blog-img').on('click', function() {
			$.ajax({
				type: "POST",
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				url: "Events.returnImage",

				data: {
					id: $(this).attr('data-id')
				},
				success: function(data)
				{
					$('#imgViewer').remove();
					$('body').append(data);
				}
			})
		});
	}
	$(function(){
		openViewer();
	});


}());

function getUploadSection(id)
{
	var hash = "#"+id;
	$.ajax({
		type: "POST",
		url: "Admin.getUploadImageSection",
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		success: function(data)
		{
			$(hash).html(data);
		}		
	});
}


$(document).ready( function() {
	checkNotifications();
	setInterval( function() {
		checkNotifications();
	}, 15000);
});

function checkNotifications()
{
	$.ajax({
		type: "POST",
		url: "Admin.notifications",
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		success: function(data)
		{
			if ( data != "KO" )
			{
				$.notify("There is a new reservation request", {
					clickToHide: true,
					autoHide: false,
					position: "bottom-left",
					className: "success"
				})
			}
		}		
	});
}