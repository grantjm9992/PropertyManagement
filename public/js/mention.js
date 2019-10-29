/**
 * 	Author: Grant MacDonald
 * 	Allow autofill of <input> elements from ajax or JSON data.
 * 
 * 	Hay que definir lo siguiente:
 * 			*La función refreshMention(); que se ejecuta al pulsar sobre la [X] en el alert cuando hayas seleccionado un valor
 * 			*{selectFuncion:  string} : Para determinar lo que debería hacer con el resultado. Cuando definas la función, hay que incluir la respuesta como
 * 									parametro. Viene de un array de forma {id: int, titulo: string}
 * 			*Si es AJAX, {url: string }
 * 			*Si es JSON, 	{
 * 								dataType: "json",
 * 								data: variable(json)
 * 							}
 * 
 *  Se puede definir las distintas clases también cómo están en el var settings.
 * 	
 * 	Parametro pasado al backend: title ( $_REQUEST['title'] )
 * 	Una vez ejecutado, no se ejecutará de nuevo hastá la primera ha terminado.
 *	Una vez terminada, si hay una diferencia entre el parametro pasado la primera vez, y lo que hay en el input ahora, llamará de nuevo
 *	
 */



(function($) {
	$.fn.mention = function( options ){

		$(this).unbind();

		var status = 200;
		var ignoreKeys = [12, 20, 17, 91, 92, 16, 93, 9, 36, 45, 34, 33, 37, 39, 27, 44, 145, 19, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126, 127, 128, 129, 130, 131, 131, 132, 133, 134, 135];

		var hash = "#"+$(this).prop('id');

		var currentRequest = null;

		var settings = $.extend({
			data: null,
			dataType: "ajax",
			url: "",
			ajaxDataSource: null,
			background: "#fff",
			visibleItems: 6,
			display: "below",
			/* Definir las clases */
			className: "mention",
			selector: ".mention",
			activeClassName: "active-mention",
			activeSelector: ".active-mention",
			alertClass: "mention-alert",
			alertSelector: ".mention-alert",
			alertId: 'mentionAlert',
			alertHash: '#mentionAlert',
			selectFunction: null
		}, options);

		$(this).on( "keydown", function(e) {
			if ( e.keyCode === 38 || e.keyCode === 40 )
			{
				e.preventDefault();
			}
		})

		$('body').on( "click", function(e) {
			if ( e.target.id != "mentionBox" || e.target.id != this.id )
			{
				$(settings.selector).remove();
			}
		});

		var alert = document.createElement("div");
		alert.id = settings.alertId;
		$(alert).addClass('alert');
		$(alert).addClass('alert-primary');
		$(alert).addClass(settings.alertClass);
		$(alert).html("<i onclick='refreshMention()' class='fas fa-times-circle'></i>");
		$(alert).css({
			display: "none"
		});
		$(this).after(alert);

	
		$(this).on( "keyup", function(e) {
			if ( $(this).val().length < 3 )
			{
				$(settings.selector).remove();
				$('#select_organizacion').val("");
				return false;
			}

			if ( $(settings.alertHash).length === 0 )
			{
				var alert = document.createElement("div");
				alert.id = settings.alertId;
				$(alert).addClass('alert');
				$(alert).addClass('alert-primary');
				$(alert).addClass(settings.alertClass);
				$(alert).html("<i onclick='refreshMention()' class='fas fa-times-circle'></i>");
				$(alert).css({
					display: "none"
				});
				$(this).after(alert);
			}

			var results = $('#mentionBox').find('div');
			var active = $('#mentionBox').find(settings.activeSelector);
			var index = $('#mentionBox').find('div').index( active );
			
			if ( e.keyCode === 38 )
			{
				/**
				 * Si usa las flechas, permite que naveguen con ellas
				 */
				e.preventDefault();
				if ( index > 0 )
				{
					$(results[index]).removeClass(settings.activeClassName);
					index--;
					$(results[index]).addClass(settings.activeClassName)
				}
			}
			else if ( e.keyCode === 40 )
			{
				/**
				 * Si usa las flechas, permite que naveguen con ellas
				 */
				e.preventDefault();
				if ( index < ( results.length - 1) )
				{
					$(results[index]).removeClass(settings.activeClassName);
					index++;
					$(results[index]).addClass(settings.activeClassName)
				}
			}
			else if ( e.keyCode === 13 )
			{
				/**
				 * Si le da a [Enter], si hay algo seleccionado 
				 * con la clase mention-active, seleccionalo
				 */
				console.log(active);
				if ( active.length === 1 )
				{
					var information = new Array();
					information.id = $(active).attr('mention-id');
					information.title = $(active).text();
					/**
					 * Pasar los parametros del elemento seleccionado
					 * por la función definida en los settings
					 */
					settings.selectFunction( information );
					$(settings.selector).remove();
					var al = $(settings.alertHash).html();
					al = "<div>"+information.title+"</div>&nbsp;&nbsp;"+al;
					$(settings.alertHash).html( al );
					$(settings.alertHash).show();
					$(this).hide();
				}
			}
			else if ( !ignoreKeys.includes( e.keyCode ) )
			{
				if ( settings.dataType == "ajax" )
				{
					callAjax(this);
				}
				if ( settings.dataType == "json" )
				{
					useJSON( this );
				}
			}
		});

		function callAjax( e )
		{
			var position = $(e).offset();
			var title = $(e).val();
			var div = document.createElement("div");
			div.id = "mentionBox";
			$(div).addClass(settings.className);
			currentRequest = $.ajax({
				type: "POST",
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				beforeSend: function() {
					if ( status === null )
					{
						return false;
					}
					else
					{
						status = null;
					}
				},
				url: settings.url,
				data: {
					title: title
				},
				success: function(data)
				{
					status = 200;
					$(settings.selector).remove();
					settings.data = jQuery.parseJSON( data );
					$.each(settings.data, function(i, item ) {
						var childDiv = document.createElement("div");
						if ( i === 0 ) $(childDiv).addClass(settings.activeClassName);
						$(childDiv).html( item.title );
						$(childDiv).attr( "mention-id", item.id );
						div.append( childDiv );
					});
					console.log(position.top);
					$(div).css({
						top: position.top+32,
						left: position.left+3,
						position: 'absolute',
						zIndex: 1150
					});
					$('body').css({
						position: 'relative'
					});
					$(settings.selector).remove();
					$('body').append(div);
					
					$('[mention-id]').on("click", function() {
						var information = new Array();
						information.id = $(this).attr('mention-id');
						information.title = $(this).text();
						settings.selectFunction( information );
						$(settings.selector).remove();
						var al = $(settings.alertHash).html();
						al = "<div>"+information.title+"</div>&nbsp;&nbsp;"+al;
						$(settings.alertHash).html( al );
						$(settings.alertHash).show();
						$(hash).hide();
					});

					$(div).find("div").on("mouseenter", function() {
						$(div).find("div").removeClass(settings.activeClassName);
						$(this).addClass(settings.activeClassName);
					});
					if ( ( $(div).height() + position.top + 32 ) > $(window).height() )
					{
						$(div).css({
							top: "unset",
							bottom: ($(window).height() - position.top )
						});
					}

					if ( title != $(e).val() ) callAjax(e);
				}
			});
		}

		function useJSON( e )
		{
			var position = $(e).offset();
			$(settings.selector).remove();
			var title = $(e).val();
			var div = document.createElement("div");
			div.id = "mentionBox";
			$(div).addClass(settings.className);
			console.log(settings.data);
			var data = settings.data;

			var filtered= data.filter(function(item){
				return item.title.toUpperCase().includes(title.toUpperCase() );
			});

			$.each(filtered, function(i, item ) {
				var childDiv = document.createElement("div");
				if ( i === 0 ) $(childDiv).addClass(settings.activeClassName);
				$(childDiv).html( item.title.toUpperCase() );
				$(childDiv).attr( "mention-id", item.id );
				div.append( childDiv );
			});
			$(div).css({
				top: position.top+32,
				left: position.left+3,
				position: 'absolute',
				zIndex: 1150
			});
			$('body').css({
				position: 'relative'
			});
			$(settings.selector).remove();
			$('body').append(div);
			
			$('[mention-id]').on("click", function() {
				var information = new Array();
				information.id = $(this).attr('mention-id');
				information.title = $(this).text();
				settings.selectFunction( information );
				$(settings.selector).remove();
				var al = $(settings.alertHash).html();
				al = "<div>"+information.title+"</div>&nbsp;&nbsp;"+al;
				$(settings.alertHash).html( al );
				$(settings.alertHash).show();
				$(hash).hide();
			});

			$(div).find("div").on("mouseenter", function() {
				$(div).find("div").removeClass(settings.activeClassName);
				$(this).addClass(settings.activeClassName);
			});
			if ( ( $(div).height() + position.top + 32 ) > $(window).height() )
			{
				$(div).css({
					top: "unset",
					bottom: ($(window).height() - position.top )
				});
			}
		}

	}	
})(jQuery);


