<form action="AdminProperties.save" id="form">
    <div class="container-fluid">
        <div class="row">
            <input type="text" name="id" value="{{ $property->id }}" hidden>
            @isset( $specialurl )
            <div class="col-12">
                <h6>
                    Encoded URL:
                    <input type="text" id="encoded" value="{{ $specialurl }}" hidden>
                    <a  target="_blank" href="{{ $specialurl }}" class="btn btn-success">
                        {{ $specialurl }}
                    </a>
                    <div onclick="copyLink()" class="btn btn-warning">
                        <i class="far fa-copy"></i>
                    </div>
                </h6>
            </div>
            @endisset
            <div class="col-12 col-lg-6 form-group">
                <label for="">Title</label>
                <input type="text" name="title" value="{{ $property->title }}" class="form-control">
            </div>
            <div class="col-12 col-lg-6 form-group">
                <label for="">Resort</label>
                <select name="id_resort" id="id_resort" class="form-control">
                    @foreach ( $resorts as $resort )
                        <option value="{{ $resort->id }}">{{ $resort->name }}</option>
                    @endforeach
                </select> 
            </div>
            <div class="col-12 col-lg-6 form-group">
                <label for="">Property type</label>
                <select name="id_property_type" id="id_property_type" class="form-control">
                    @foreach ( $propertytypes as $type )
                        <option value="{{ $type->id }}">{{ $type->title }}</option>
                    @endforeach
                </select> 
            </div>
            <div class="col-12 col-lg-6 form-group">
                <label for="">Information section</label>
                <select name="id_info_section" id="id_info_section" class="form-control">
                    @foreach ( $sections as $section )
                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                    @endforeach
                </select> 
            </div>
            <div class="col-6 col-lg-3 form-group">
                <label for="">Sleeps</label>
                <input type="number" name="sleeps" value="{{ $property->sleeps }}" class="form-control">
            </div>
            <div class="col-6 col-lg-3 form-group">
                <label for="">Beds</label>
                <input type="number" name="bed" value="{{ $property->bed }}" class="form-control">
            </div>
            <div class="col-6 col-lg-3 form-group">
                <label for="">Bedrooms</label>
                <input type="number" name="bedrooms" value="{{ $property->bedrooms }}" class="form-control">
            </div>
            <div class="col-6 col-lg-3 form-group">
                <label for="">Bathrooms</label>
                <input type="number" name="bath" value="{{ $property->bath }}" class="form-control">
            </div>
            <div class="col-12 col-lg-6 form-group">
                <label for="">Location</label>
                <input type="text" name="location" value="{{ $property->location }}" class="form-control" placeholder="Town, Country">
            </div>
            <div class="col-12 col-lg-6 form-group">
                <label for="">Property owner</label>
                <input type="text" name="id_property_owner" id="id_property_owner" hidden value="{{ $property->id_property_owner }}" />
                @if ( $property->id_property_owner != "" )
                <input type="text" id="owner" style="display:none;" class="form-control" autocomplete="off">
                <div id="mentionAlert" class="alert alert-primary mention-alert" style=""><div>{{ $property->owner }}</div>&nbsp;&nbsp;<i onclick="refreshMention()" class="fas fa-times-circle"></i></div>
                @else
                <input type="text" id="owner" style="" class="form-control" autocomplete="off">
                @endif
            </div>
            <div class="col-12 form-group">
                <label for="">Assigned to</label>
                <input type="text" name="id_assigned_to" id="id_assigned_to" hidden value="{{ $property->id_assigned_to }}" />
                @if ( $property->id_assigned_to != "" )
                <input type="text" id="user" style="display:none;" class="form-control" autocomplete="off">
                <div id="mentionAlert" class="alert alert-primary mention-alert" style=""><div>{{ $property->assigned_to }}</div>&nbsp;&nbsp;<i onclick="refreshMentionAssign()" class="fas fa-times-circle"></i></div>
                @else
                <input type="text" id="user" style="" class="form-control" autocomplete="off">
                @endif
            </div>
            <div class="col-12 form-group">
                <label for="">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control">{!! $property->description !!}</textarea>
            </div>
        </div>
    </div>
</form>
<div class="container-fluid">
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
    <form maxFiles="1" action="AdminProperties.uploadImage" class="dropzone" id="my-awesome-dropzone">
        <input type="text" name="id" hidden value="{{ $property->id }}">
        @csrf()
    </form>
    <div style="width: 100%; margin-top: 10px;" id="sortable">
    @foreach ( $images as $image )
        <div imageId="{{ $image->id }}" style="display: inline-block; margin-right: 15px; border-radius: 4px; box-shadow: 0 0 6px 0 rgba(0,0,0,0.4); position: relative; width: 150px; height: 130px; background: url({{ $image->path }}); background-size: cover; background-repeat: no-repeat; background-position: center;">
            <i style="font-size: 20px; color: red; position: absolute; top: 4px; right: 4px; cursor: pointer;" onclick="deleteImage({{ $image->id }})" class="fas fa-times-circle"></i>
        </div>
    @endforeach
</div>


<script>
    function submitForm()
    {
        $('#form').submit();
    }


    function manageFeatures()
    {
        $('#modal').remove();
        $.ajax({
            type: "POST",
            url: "AdminProperties.featuresModal",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data:
            {
                id: "{{ $property->id }}"
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
            url: "AdminProperties.updateFeatures",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: "{{ $property->id }}",
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
            url: "AdminProperties.featuresGrid",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: "{{ $property->id }}"
            },
            success: function(data)
            {
                $('#features').html(data);
            }
        });
    }

    

    function deleteImage(id)
    {
        $.ajax({
            type: "POST",
            url: "AdminProperties.removeImage",
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


    $(document).ready( function() {
        $('#owner').mention({
            url: "Users.getMention?role=PO",
            selectFunction: selectContact
        });
        $('#user').mention({
            url: "Users.getMention?assignproperty=1",
            selectFunction: selectUser,
            alertHash: "#userAlert",
            alertId: "userAlert"
        });
    });
	function refreshMention()
	{
		$('#id_property_owner').val('');
		$('#owner').val('');
		$('#owner').show();
		$('.mention-alert').remove();
		$('#mentionAlert').remove();
		$('#owner').focus();
	}
	function refreshMentionAssign()
	{
		$('#id_assigned_to').val('');
		$('#user').val('');
		$('#user').show();
		$('.mention-alert').remove();
		$('#userAlert').remove();
		$('#user').focus();
    }
    
    function selectUser( info )
    {
		$('#id_assigned_to').val( info.id );        
    }

	function selectContact( info )
	{
		$('#id_property_owner').val( info.id );
	}

    function copyLink()
    {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($("#encoded").val()).select();
        document.execCommand("copy");
        $temp.remove();
        md.showNotification("top", "center", "Copied to clipboard");
    }


    function addPropertyTask()
    {
        $.ajax({
            type: "POST",
		    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "Tasks.addModal",
            data:
            {
                id_property: "{{ $property->id }}"
            },
            success: function( data ) 
            {
                $('#modal').remove();
                $('body').append(data);
                $('#modal').show();
            }
        })
    }

    
function deleteModel()
{
	var options = Array();
	options.icon = "warning";
	options.text = "Are you sure that you want to delete this property? This can't be undone";
	options.title = "Warning";
	options.type = "confirm";
	options.thenFunction = confirmDelete;
	sweetAlert( options );
}

function confirmDelete()
{
	$.ajax({
		type: "POST",
		url: "AdminProperties.delete",
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		data:
		{
			id: "{{ $property->id }}"
		},
		success: function(data)
		{
			var s = jQuery.parseJSON( data );
			if ( s.success === 1 )
			{
				window.location.href = "AdminProperties";
			}
			else
			{
				var options = Array();
				options.icon = "error";
				options.text = s.error;
				options.title = "Error";
				sweetAlert( options );
			}
		}
	})
}

</script>