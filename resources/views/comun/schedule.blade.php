<div class="container-fluid bg-light">
    <div class="container-fluid">
        <div class="row">
            
        </div>
    </div>
    <div class="container-fluid">            
        <div class="row">
            <div class="col-12 col-xl-6">
                <div class="card">
                    <div class="card-header card-header-tabs card-header-primary">
                        <h4>
                            <i class="fas fa-calendar"></i> Property tasks
                        </h4>
                        <div onclick="newPropertyTask()" class="btn btn-success">
                            <i class="fas fa-calendar-plus"></i>  New task
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="usertaskcalendar"></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6">
                <div class="card">
                    <div class="card-header card-header-tabs card-header-primary">
                        <h4>
                            <i class="fas fa-suitcase-rolling"></i> Property rentals
                        </h4>
                        <div onclick="newRental()" class="btn btn-success">
                            <i class="fas fa-calendar-plus"></i>  New rental
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="propertyrentalcalendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input id="type" hidden />
<script>
    $(document).ready( function() {
        $('#usertaskcalendar').fullCalendar({
            defaultView: 'month',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listMonth'
            },
            eventSources: [
            {
                url: 'Tasks.getPropertyCalendar',
                type: 'POST',
                data : function () { return { id_type : $("#type").val(), id: "{{ $property->id }}" }; },
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            }
            ],
            eventClick: function(calEvent, jsEvent, view) {
                console.log(calEvent);
                window.location.href = "Tasks.edit?id="+calEvent.id;
            }
        });
        $('#propertyrentalcalendar').fullCalendar({
            defaultView: 'month',
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
                window.location.href = "Tasks.edit?id="+calEvent.id;
            }
        });
    })
</script>