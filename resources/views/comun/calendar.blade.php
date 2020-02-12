<div class="card">
    <div class="card-header">
        <h3 class="card-title">Rentlas for {{ $property->title }}</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                <i class="fas fa-expand"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div id="propertyrentalcalendar"></div>
    </div>
</div>
<script>
    $(document).ready( function() {
        
        $('#propertyrentalcalendar').fullCalendar({
            defaultView: 'listMonth',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,listMonth'
            },
            eventSources: [
            {
                url: 'PropertyCalendar.getForCalendar',
                type: 'POST',
                data : function () { return { id: "{{ $property->id }}" }; },
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            }
            ],
            eventClick: function(calEvent, jsEvent, view) {
                window.location.href = "Reservations.detail?id="+calEvent.id;
            }
        });
    })
    function newRental()
    {
        $.ajax({
            type: "POST",
		    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "Reservations.addModal",
            data: {
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
</script>