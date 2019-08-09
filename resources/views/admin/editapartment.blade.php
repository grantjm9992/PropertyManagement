@inject('translator', 'App\Providers\TranslationProvider')
<div class="container-fluid">
    <div class="sp-pad spad">
		<form action="AdminApartments.save" id="form">
			<div class="row">
			<input type="text" name="id" hidden value="{{ $apartment->id }}">
				<div class="form-group col-12 col-md-6">
					<label for="id_resort">Resort</label>
					<select name="id_resort" id="id_resort" class="form-control">
						@foreach ( $resorts as $resort )
							<option value="{{ $resort->id }}">{{ $resort->title }}</option>
						@endforeach
					</select>
				</div>
				<!--
				<div class="form-group col-12 col-md-6">
					<label for="id_resort">Property Type</label>
					<select name="id_property_type" id="id_property_type" class="form-control">
						@foreach ( $propertyTypes as $type )
							<option value="{{ $type->id }}">{{ $type->title }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group col-12 col-md-6">
					<label for="code">Code</label>
					<input type="text" class="form-control" value="{{ $apartment->code }}" readonly>
				</div>
				-->
				<div class="form-group col-12 col-md-6">
					<label for="level">Floor</label>
					<input type="text" class="form-control" value="{{ $apartment->level }}" name="level" required>
				</div>
				<div class="form-group col-12 col-md-6">
					<label for="bed">Bed</label>
					<input type="text" class="form-control" value="{{ $apartment->bed }}" name="bed" required>
				</div>
				<div class="form-group col-12 col-md-6">
					<label for="bath">Bath</label>
					<input type="number" class="form-control" value="{{ $apartment->bath }}" name="bath" required>
				</div>
				<div class="form-group col-12 col-md-6">
					<label for="phase">Phase</label>
					<input type="text" class="form-control" value="{{ $apartment->phase }}" name="phase" required>
				</div>
				<div class="form-group col-12 col-md-6">
					<label for="price">Price from</label>
					<input type="number" class="form-control" value="{{ $apartment->price }}" name="price" required>
				</div>
				<div class="form-group col-12 col-md-6">
					<label for="area">Area m2</label>
					<input type="number" class="form-control" value="{{ $apartment->area }}" name="area">
				</div>
				<div class="form-group col-12 col-md-6">
					<label for="terrace_area">Terrace area m2</label>
					<input type="number" class="form-control" value="{{ $apartment->terrace_area }}" name="terrace_area">
				</div>
				<div class="form-group col-12 col-md-4">
					<label for="community_fees">Community fees (€/month)</label>
					<input type="text" class="form-control" value="{{ $apartment->community_fees }}" name="community_fees">
				</div>
				<div class="form-group col-12 col-md-4">
					<label for="app_mortgage">Approx Mortgage</label>
					<input type="text" class="form-control" value="{{ $apartment->app_mortgage }}" name="app_mortgage">
				</div>
				<!--
				<div class="col-12 col-md-4  form-group">
					<label for="sold">Status</label>
					<select name="sold" id="sold" class="form-control">
						<option value="0">Available</option>
						<option value="1">Sold</option>
						<option value="2">Reserved</option>
					</select>
				</div>
				<div class="col-12 col-md-4  form-group">
					<label for="rental_potential">Rental Potential</label>
					<input type="text" name="rental_potential" value="{{ $apartment->rental_potential }}" class="form-control">
				</div>
				-->
				<div class="col-12 col-md-4 form-group">
					<label for="id_info_section">Information section</label>
					<select name="id_info_section" id="id_info_section" class="form-control">
						<option value="0">None</option>
						@foreach ( $sections as $row )
						<option value="{{ $row->id }}">{{ $row->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group col-12">
					<label for="description">Description</label>
					<textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
				</div>
				<button id="submit" type="submit" hidden></button>
			</div>
		</form>
		<div class="row" style="margin: 10px auto;">
			<h3 style="width: 100%; padding-bottom: 8px; border-bottom: 1px solid;">
				Features
				<div class="buttons">
					<div class="btn btn-outline-primary" onclick="manageFeatures()">
						<i class="fas fa-list"></i> Manage features
					</div>
				</div>
			</h3>
			<div class="col-12" id="features">
				{!! $featuresGrid !!}
			</div>
		</div>
		<h3 style="width: 100%; padding-bottom: 8px; border-bottom: 1px solid;">
		Images
		</h3>
		<form maxFiles="1" action="AdminApartments.uploadImage" class="dropzone" id="my-awesome-dropzone">
			<input type="text" name="id" hidden value="{{ $apartment->id }}">
			@csrf()
		</form>
		<div style="width: 100%; margin-top: 10px;" id="sortable">
		@foreach ( $images as $image )
			<div imageId="{{ $image->id }}" style="display: inline-block; margin-right: 15px; border-radius: 4px; box-shadow: 0 0 6px 0 rgba(0,0,0,0.4); position: relative; width: 150px; height: 130px; background: url({{ $image->ruta }}); background-size: cover; background-repeat: no-repeat; background-position: center;">
				<i style="font-size: 20px; color: red; position: absolute; top: 4px; right: 4px; cursor: pointer;" onclick="deleteImage({{ $image->id }})" class="fas fa-times-circle"></i>
			</div>
		@endforeach
		</div>
		<h3 style="width: 100%; padding-bottom: 8px; border-bottom: 1px solid; margin-top: 20px;">
		Floorplans
		</h3>
		<form action="AdminApartments.uploadFloorplan" class="dropzone" id="my-awesome-dropzone2">
			<input type="text" name="id" hidden value="{{ $apartment->id }}">
			@csrf()
		</form>
		<div style=" display: inline-flex; justify-content: space-between; margin-top: 20px;">
			@if ( file_exists( $apartment->floorplan ) )
			<div style="margin: 0 10px; text-align: center;" floorplan>
				<a download href="{{ $apartment->floorplan }}"><img src="img/pdf.png" style="height: 130px;" alt=""></a>
				<div>
					<div class="btn btn-danger" onclick="removeFloorplan()" style="margin-top: 20px;">
						<i class="fas fa-minus-circle"></i> Remove floorplan
					</div>
				</div>
			</div>
			@endif
			@foreach ( $floorplanImg as $img )
			<div style="margin: 0 10px; text-align: center;" floorplanImg="{{ $img->id }}">
				<a download href="{{ $img->ruta }}"><img src=" {{ $img->ruta }} " style="height: 130px;" alt=""></a>
				<div>
					<div class="btn btn-danger" onclick="removeFloorplanImg({{ $img->id }})" style="margin-top: 20px; font-size: 14px;">
						<i class="fas fa-minus-circle"></i> Remove floorplan image
					</div>
				</div>
			</div>
			@endforeach
		</div>
    </div>
</div>

<script>

function removeFloorplanImg(id)
{
	$.ajax({
		type: "POST",
		url: "AdminApartments.removeFloorplanImg",
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		data:
		{
			id: id
		},
		success: function(data)
		{
			$('[floorplanImg="'+id+'"]').remove();
		}
	})
}

function removeFloorplan()
{
	$.ajax({
		type: "POST",
		url: "AdminApartments.removeFloorplanPDF",
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		data:
		{
			id: '{{ $apartment->id }}'
		},
		success: function(data)
		{
			$('[floorplan]').remove();
		}
	})
}

function deleteImage(id)
{
	$.ajax({
		type: "POST",
		url: "AdminApartments.removeImage",
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		data:
		{
			id: id
		},
		success: function(data)
		{
			$('[imageId="'+id+'"]').remove();
		}
	})
}

function updateOrder()
{
	var elements = $('[imageId]');
	var ids = "";
	for ( var i = 0; i < elements.length; i++ ) {
		ids += $(elements[i]).attr('imageId')+"@#";
	}
	$.ajax({
		type: "POST",
		url: "AdminApartments.updateImageOrder",
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		data: {
			ids: ids
		},
		success: function(data)
		{
			if ( data == "OK" )
			{                    
				$.notify( "Order updated successfully", {
					position: "bottom-left",
					className: "success"
				} );
			}
		}
	})
}
$(document).ready( function()
{
	$('#sortable').sortable({
		update: function() {
			updateOrder();
		}
	});
	$('#description').summernote({
		height: 250
	});
	var html = '{!! $apartment->description !!}';
	$('#description').summernote('code', html);

	$('#id_info_section').val('{{ $apartment->id_info_section }}');

	var sold = "{{ $apartment->sold }}";
	if ( sold == "1" )
	{
		$('.switch').click();
	}
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
			textAlign: "center",
			zIndex: 100000
		});
		$(holder).html('<img src="'+url+'" style="max-height: 100%; max-width: 100%;">');
		$('body').append(holder);
		$(holder).click( function() {
			closeHolder();
		});
	});
	document.addEventListener("keydown", function(event) {
		if ( event.which === 27 )
		{
			closeHolder();
		}
	});
})

function closeHolder()
{
	$('#img_holder').remove();
}

function manageFeatures()
{
	$('#modal').remove();
	$.ajax({
		type: "POST",
		url: "AdminApartments.featuresModal",
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		data:
		{
			id: "{{ $apartment->id }}"
		},
		success: function(data)
		{
			$('body').append(data);
		}
	})
}

function updateFeatures()
{
        
        $('#modal').modal("hide");
        $.ajax({
            type: "POST",
            url: "AdminApartments.updateFeatures",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: {{ $apartment->id }},
                ids: $('#modal_tabla_selectIds').val()
            },
            success: function(data)
            {
                if ( data == "OK" )
                {
                    var options = Array();
                    options.text = 'Features updated successfully';
                    options.title = "Success";
                    options.icon = "success";
                    sweetAlert(options);
                    updateFeatureTable();
                }
                else
                {
                    sweetAlert('There has been an error', "error");
                }
            }
        });

}

function updateFeatureTable()
{
        $.ajax({
            type: "POST",
            url: "AdminApartments.featuresGrid",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: {{ $apartment->id }}
            },
            success: function(data)
            {
                $('#features').html(data);
            }
        });
}

function deleteApartment()
{
        var options = Array();
        options.title = "Warning";
        options.text = "Are you sure you want to delete this property? This action is irreversible.";
        options.icon = "warning";
        options.type = "confirm";
        options.thenFunction = confirmedToDelete;
        sweetAlert( options );
}

function confirmedToDelete()
{
	$.ajax({
		type: "POST",
		url: "AdminApartments.delete",
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		data: {
			id: "{{ $apartment->id }}"
		},
		success: function(data)
		{
			if ( data == "OK" )
			{
				window.location = "AdminApartments";
			}
		}
	})
}
</script>