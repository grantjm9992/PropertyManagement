<div class="col-12 col-lg-6">
    <div class="card">
        <div class="card-header card-header-tabs card-header-primary">
            My team's taks
        </div>
        <div class="card-body">
            <div id="taskcalendar"></div>
        </div>
    </div>
</div>

<script>
    $(document).ready( function() {
        $('#taskcalendar').fullCalendar({
            defaultView: 'listMonth',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,listMonth'
            },
            eventSources: [
            {
                url: 'Tasks.getTeamCalendar?id={{ $user->id_company }}',
                type: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            }
            ],
            eventClick: function(calEvent, jsEvent, view) {
                window.location.href = "Tasks.edit?id="+calEvent.id;
            }
        });
    })
</script>