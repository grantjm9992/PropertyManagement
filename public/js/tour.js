
$(document).ready(function() {
	setTimeout(function() {
		var d = document.createElement("div");
		$(d).addClass("tour-background");
		$("body").append(d);
		var div = document.createElement("div");
		div.id = "tour";
		var position = $("#new_message").position();
		$("#new_message").addClass("glow");

		var clone = $('#new_message').clone();
		$(clone).prop("id", "new_message_clone");
		$(clone).css({
			position: "absolute",
			top: position.top,
			left: position.left	
		});
		$(clone).addClass("glow");
		$('#main-panel').append(clone);
		$(div).css({
			top: position.top,
			left: position.left - 200 + $('#new_message').width() + 10,
			zIndex: 101000001,
			width: "400px",
			background: "#222",
			color: "#fff",
			position: "absolute",
			padding: "20px"
		});
		$(div).html('<h5>Create a new message</h5><div class="w-100">Click here to send a new message</div>');
		$("body").append(div);
		$("#tour").on("click", function() {
			nextStep();
		});
	}, 1000)
});

var i = 0;

var ids = ["new_task", "navbarDropdownMenuMessages", "navbarDropdownMenuLink", "navbarDropdownProfile"];
var texts = ['<h5>Create a new task</h5><div class="w-100">Click here to create a new task</div>'
			, '<h5>Messages</h5><div class="w-100">Here, all of your unread messages will be displayed</div>'
			, '<h5>Notifications</h5><div class="w-100">Here you will find all of your unseed notifications</div>'
			, '<h5>Profile</h5><div class="w-100">This is your profile menu. Logout or change your profile from here</div>'];

function nextStep()
{
	if ( i > ids.length -1 )
	{
		$('.tour-background').remove();
		$("#"+ids[i-1]).removeClass("glow");
	}
	var position = $("#"+ids[i]).position();
	$("#"+ids[i-1]+"_clone").remove();
	if ( i === 0 ) $('#new_message_clone').remove();
	var clone = $('#'+ids[i]).clone();
	$(clone).prop("id", ids[i]+"_clone");
	$(clone).css({
		position: "absolute",
		top: position.top,
		left: position.left
	});
	$(clone).addClass("glow");
	$('#main-panel').append(clone);
	$("#"+ids[i]).addClass("glow");
	$('#tour').css({
		top: position.top,
		left: position.left - 210 + $('#'+ids[i]).width()
	});
	$('#tour').html(
		texts[i]
	);
	i++
}