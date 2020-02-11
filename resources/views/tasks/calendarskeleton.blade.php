
<div class="card">
    <div class="card-header">
        <h3 class="card-title"> My calendar</h3>
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
        <div id="usertaskcalendar"></div>
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
                right: 'month,agendaWeek,agendaDay, listMonth'
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