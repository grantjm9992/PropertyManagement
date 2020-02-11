<div class="card widget-s" widget-id="{{ $widgetId }}">
    <div class="card-header">
        <h3 class="card-title"> My property calendar</h3>
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
        <div id="taskcalendar"></div>
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
                url: 'Tasks.getPropertyOwnerCalendar?id={{ $user->id }}',
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