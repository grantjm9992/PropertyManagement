
<link href='fullcalendar/core/main.css' rel='stylesheet' />
<link href='fullcalendar/daygrid/main.css' rel='stylesheet' />
<link href='fullcalendar/timegrid/main.css' rel='stylesheet' />

<script src='fullcalendar/core/main.js'></script>
<script src='fullcalendar/daygrid/main.js'></script>
<script src='fullcalendar/timegrid/main.js'></script>

<script>

    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    $(function () {            
            $.ajax({
                type: "POST",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: "PropertyCalendar.getCalendar",
                data: {
                    id: "{{ $property->id }}"
                },
                success: function(data)
                {
                    var s = jQuery.parseJSON( data );
                    
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        events: s,
                        plugins: [ 'timeGrid' ],
                        defaultView: 'timeGridWeek'
                    });
                    calendar.render();
                }
            })
        });
    });

</script>
<div id="calendar"></div>