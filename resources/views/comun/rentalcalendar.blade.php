<div id="calendar"></div>

<script>
    $(document).ready( function() {
        $('#calendar').fullCalendar({
            defaultView: 'month',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month'
            },
            eventSources: [
            {
                url: 'PropertyCalendar.getForCalendar?id={{ $property->id }}',
                type: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            }
            ]
        });
    })
</script>