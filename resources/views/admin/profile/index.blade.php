<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <i class="fas fa-user-circle"></i> My Information
        </button>
      </h2>
    </div>
    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        <form action="MyProfile.save" id="form">
            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                </div>
                <div class="col-12 col-lg-6 form-group">
                    <label for="surname">Surname</label>
                    <input type="text" name="surname" value="{{ $user->surname }}" class="form-control">
                </div>
                <div class="col-12 col-lg-6 form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                </div>
                <div class="col-12 col-lg-6 form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
                </div>
                <div class="col-12 col-lg-6 form-group">
                    <label for="password">Password</label>
                    <input type="text" name="password" id="password" class="form-control">
                </div>
                <div class="col-12 col-lg-6 form-group">
                    <label for="phone">Repeat password</label>
                    <input type="text" idº="password1" class="form-control">
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <i class="fas fa-cubes"></i> My Widgets
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        <div class="row">
            <div class="col-12">
                <h3>
                    <select name="widgets" id="widgets" class="form-control">
                        @foreach ( $widgets_select as $row )
                            <option value="{{ $row->id }}">{{ $row->description }}</option>
                        @endforeach
                    </select>
                    <div onclick="addWidget()" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add widget
                    </div>
                </h3>
            </div>
        </div>
        <div id="holder" class="row">
            {!! $widgets !!}
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready( function() {
    $('#holder').sortable({
      
      placeholder: "ui-state-highlight",
      update: function() {
        updateOrder();
      }
    });
  });
  
  function updateOrder()
    {        
        var elements = $('.cc-sortable');
        var ids = "";
        for ( var i = 0; i < elements.length; i++ ) {
            ids += $(elements[i]).attr('data-id')+"@#";
        }
        $.ajax({
            type: "POST",
            url: "MyProfile.updateWidgetOrder",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                ids: ids,
                id: '{{ $user->id }}'
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

    function addWidget()
    {
        var id = $('#widgets').val();
        $.ajax({
            type: "POST",
            url: "MyProfile.addWidget",
            data: {id: $('#widgets').val() },
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(data)
            {
                $('option[value="'+id+'"]').remove();
                $('#holder').append(data);
            }
        })
    }
</script>