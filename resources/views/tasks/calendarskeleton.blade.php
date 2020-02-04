
<div class="col-lg-6 col-md-12">
    <div class="card">
        <div class="card-header card-header-tabs card-header-primary">
            My calendar
        </div>
        <div class="card-body">
            <div id="usertaskcalendar"></div>
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
                right: 'month,agendaWeek,agendaDay'
            },
            eventSources: [
            {
                url: 'Tasks.getUserCalendar',
                type: 'POST',
                data : function () { return { id_type : $("#type").val() }; },
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            }
            ],
            eventClick: function(calEvent, jsEvent, view) {
                window.location.href = "Tasks.edit?id="+calEvent.id;
            }
        });
    })
</script>