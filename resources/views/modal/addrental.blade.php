<div id="modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Rental</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="Reservations.add" id="taskForm">
            <div class="row">
              <input type="text" name="id_type" value="{{ $id_type }}" hidden >
              <input type="text" name="id_property" value="{{ $id_property }}" hidden >
              <div class="form-group col-12">
                <label for="">Name</label>
                <input type="text" name="name" class="form-control">
              </div>
              <div class="form-group col-12">
                <label for="">Surname</label>
                <input type="text" name="surname" class="form-control">
              </div>
              <div class="form-group col-12">
                <label for="">Email</label>
                <input type="text" name="email" class="form-control">
              </div>
              <div class="form-group col-12">
                <label for="">Phone</label>
                <input type="text" name="phone" class="form-control">
              </div>
              <div class="form-group col-12">
                <label for="">Start</label>
                <input type="text" name="date_start" id="date_start" class="form-control" required autocomplete="off">
              </div>
              <div class="form-group col-12">
                <label for="">End</label>
                <input type="text" name="date_end" id="date_end" class="form-control" required autocomplete="off">
              </div>
            </div>
          </form>          
      </div>
      <div class="modal-footer">
        <div onclick="submitRental()" class="btn btn-primary">Submit</div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready( function() {
    var now = new Date();
    var jsondates = '{!! $unavailable_dates !!}';
    var dates = jQuery.parseJSON( jsondates );
    $('#modal').modal("show");
    var to = $('#date_start').datepicker({
      minDate: now,
      dateFormat: "yy-mm-dd",
      beforeShowDay: function(date)
      {
        var str = jQuery.datepicker.formatDate('yy-mm-dd', date);

        return [$.inArray(str, dates) === -1 ];
      },
      onSelect: function(dt)
      {
        console.log(dt)
        setFrom(dt);
      }
    });
  });

  function setFrom(str)
  {
    $.ajax({
        type: "POST",
        url: "Reservations.getUntiWhen",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{
          id_property: "{{ $id_property }}",
          date: str
        },
        success: function(data)
        {
          var ff = new Date($('#date_start').val());
          ff.setDate( ff.getDate() + 1 );
          var until = new Date(data);
          var from = $('#date_end').datepicker({
            dateFormat: "yy-mm-dd",
            minDate: ff,
            maxDate: new Date("'"+data+"'")
          });
        }
    })
  }


  function submitRental()
  {
    $("#taskForm").submit();
  }
</script>