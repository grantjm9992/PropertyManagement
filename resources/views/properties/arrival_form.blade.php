<div id="modal" class="modal" tabindex="-1" role="dialog">
    <form action="Home.addArrival">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add arrival information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" name="id" value="{{ $id_reserva }}" hidden>
                <input type="text" name="p" value="{{ $p }}" hidden>
                <div class="form-group">
                    <label for="">Arrival time</label>
                    <input type="text" id="arrival_time" name="arrival_time" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Arrival notes</label>
                    <textarea name="arrival_notes" id="" cols="30" rows="5" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready( function() {
        $('#modal').modal("show");
        $('#arrival_time').timepicker({});
    });
</script>

<div class="floating-icon" onclick="$('#modal').modal('show');">
    Add arrival info
</div>