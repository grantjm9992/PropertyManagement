<form action="Reservations.update" id="form">
<input type="text" name="id" value="{{ $data->id }}" hidden>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h6>
                    Encoded URL:
                    <input type="text" id="encoded" value="{{ $specialurl }}" hidden>
                    <a  target="_blank" href="{{ $specialurl }}" class="btn btn-success">
                        {{ $specialurl }}
                    </a>
                    <div onclick="copyLink()" class="btn btn-warning">
                        <i class="far fa-copy"></i>
                    </div>
                </h6>
            </div>
            <div class="col-12 form-group">
                <label for="">Confirmed</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="{{ $data->is_confirmed }}" name="is_confirmed" id="is_confirmed">
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>
            </div>
            <div class="col-12 col-lg-6 form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $data->name }}">
            </div>
            <div class="col-12 col-lg-6 form-group">
                <label for="">Surname</label>
                <input type="text" class="form-control" name="surname" value="{{ $data->surname }}">
            </div>
            <div class="col-12 col-lg-6 form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" name="email" value="{{ $data->email }}">
            </div>
            <div class="col-12 col-lg-6 form-group">
                <label for="">Phone</label>
                <input type="text" class="form-control" name="phone" value="{{ $data->phone }}">
            </div>
            <div class="col-12 col-lg-4 form-group">
                <label for="">From</label>
                <input type="text" class="form-control" name="date_start" id="date_start">
            </div>
            <div class="col-12 col-lg-4 form-group">
                <label for="">To</label>
                <input type="text" class="form-control" name="date_end" id="date_end">
            </div>
            <div class="col-12 col-lg-4 form-group">
                <label for="">Arrival time</label>
                <input type="text" class="form-control" name="arrival_time" id="arrival_time" >
            </div>
            <div class="col-12 form-group">
                <label for="">Arrival notes</label>
                <textarea name="arrival_notes" id="" cols="30" rows="10" class="form-control">{{ $data->arrival_notes }}</textarea>
            </div>
        </div>
    </div>
</form>

<script>

$(document).ready( function() {
    @if ( (int)$data->is_confirmed === 1 )
    $('#is_confirmed').click();
    @endif
    $('#is_confirmed').on("click", function() {
        if ( $('#is_confirmed').is(":checked") )
        {
            $("#is_confirmed").val(1);
        }
        else
        {
            $("#is_confirmed").val(0);
        }
    })
    
    $("#date_start").datepicker({
  dateFormat: "yy-mm-dd"
});
    $("#date_start").datepicker("setDate", "{{ $data->date_start }}");
    $("#date_end").datepicker({
  dateFormat: "yy-mm-dd"
});
    $("#date_end").datepicker("setDate", "{{ $data->date_end }}");
})
    function copyLink()
    {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($("#encoded").val()).select();
        document.execCommand("copy");
        $temp.remove();
        md.showNotification("top", "center", "Copied to clipboard");
    }
$('#arrival_time').timepicker()
$('#arrival_time').timepicker("setTime", "{{ $data->arrival_time }}");


function addReservationTask()
{
    $.ajax({
        type: "POST",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "Tasks.addModal",
        data:
        {
            id_reservation: "{{ $data->id }}",
            id_property: "{{ $data->id_property }}"
        },
        success: function( data ) 
        {
            $('#modal').remove();
            $('body').append(data);
            $('#modal').show();
        }
    })
}

function submitForm()
{
    $('#form').submit();
}
</script>