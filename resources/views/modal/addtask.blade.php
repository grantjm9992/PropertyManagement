<div id="modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="Tasks.add" id="taskForm">
            <div class="row">
              <div class="col-12 form-group">
                <label for="title">Title</label>
                <input type="text" name="title" required class="form-control">
              </div>
              <div class="col-12 form-group">
                <label for="user">Assigned to</label>
                <input type="text" id="user" required class="form-control" autocomplete="off">
                <input type="text" hidden name="id_user" id="id_user" required>
              </div>
              <div class="form-group col-12">
                <label for="">Type of task</label>
                <select name="id_type" id="id_type" class="form-control">
                  @foreach ( $types as $type )
                    <option value="{{ $type->id }}">{{ $type->description }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-12">
                <label for="">Start</label>
                <input type="text" name="date_start" id="date_start" class="form-control" required autocomplete="off">
              </div>
              <div class="form-group col-12">
                <label for="">End</label>
                <input type="text" name="date_end" id="date_end" class="form-control" required autocomplete="off">
              </div>
              <div class="form-group col-12">
                <textarea name="description" id="description" cols="30" rows="3" placeholder="Further details..." class="form-control"></textarea>
              </div>
            </div>
          </form>          
      </div>
      <div class="modal-footer">
        <div onclick="submitTaskForm()" class="btn btn-primary">Submit</div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready( function() {
    var now = new Date();
    $('#modal').modal("show");
    var to = $('#date_start').datetimepicker({
      minDate: now,
      onShow:function( ct ){
        this.setOptions({
          minDate:jQuery('#date_end').val()?jQuery('#date_end').val():false
        })
      }
    });
    var from = $('#date_end').datetimepicker({
      minDate: now,
      onShow:function( ct ){
        this.setOptions({
          minDate:jQuery('#date_start').val()?jQuery('#date_start').val():false
        })
      }
    });
    $('#user').mention({
			url: "Users.getMention",
			selectFunction: selectContact
		});
  });

  function submitTaskForm()
  {
    if ( $("#id_user").val() != "" )
    {
      if ( $("#taskForm").validate() )
      {
        $("#taskForm").submit();
      }
    }
  }

	function selectContact( info )
	{
		$('#id_user').val( info.id );
	}

	function refreshMention()
	{
		$('#id_user').val('');
		$('#user').val('');
		$('#user').show();
		$('.mention-alert').remove();
		$('#mentionAlert').remove();
		$('#user').focus();
	}
</script>