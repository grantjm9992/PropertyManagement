<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="buttons">
                <a href="PropertyInformation?id_property={{ $property->id }}" class="btn btn-primary">
                    <i class="fas fa-clipboard"></i>  Update property information
                </a>
                <div onclick="newRental()" class="btn btn-success">
                    <i class="fas fa-calendar-plus"></i>  New rental request
                    <div class="ripple-container"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-7">
            <div class="card">
                <div class="card-header card-header-primary">
                    <span>
                        <h4>
                        <i class="fas fas fa-home"></i>  Rentals for {{ $property->title }}
                        </h4>
                    </span>
                </div>
                <div class="card-body">
                    {!! $calendar !!}
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-5">
            <div class="card">
                <div class="card-header card-header-primary">
                    <span>
                        <h4>
                        <i class="fas fas fa-calendar"></i>  Tasks for {{ $property->title }}
                        </h4>
                    </span>
                </div>
                <div class="card-body">
                    {!! $taskcalendar !!}
                </div>
            </div>
        </div>
    </div>
</div>

<script>

function newRental()
    {
        $.ajax({
            type: "POST",
		    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "Reservations.addModal",
            data: {
                id_property: "25",
                id_type: "3"
            },
            success: function( data ) 
            {
                $('#modal').remove();
                $('body').append(data);
                $('#modal').show();
            }
        })
    }
</script>