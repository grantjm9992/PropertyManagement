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
                <input type="text" id="user_modal" required class="form-control" autocomplete="off">
                <input type="text" hidden name="id_user" id="id_user_modal" required>
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
                <input type="text" name="date_start" id="date_startTask" class="form-control" required autocomplete="off">
              </div>
              <div class="form-group col-12">
                <label for="">End</label>
                <input type="text" name="date_end" id="date_endTask" class="form-control" required autocomplete="off">
              </div>
              <div class="form-group col-12">
                <textarea name="description" id="description" cols="30" rows="3" placeholder="Further details..." class="form-control"></textarea>
              </div>
            </div>
            @isset( $_REQUEST["id_property"] )
              <input name="id_property" value="{{ $_REQUEST['id_property'] }}" hidden/>
            @endisset
            @isset( $_REQUEST["id_reservation"] )
              <input name="id_reservation" value="{{ $_REQUEST['id_reservation'] }}" hidden/>
            @endisset
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
    $('#user_modal').mention({
			url: "Users.getMention",
			selectFunction: selectContact,
			alertId: 'mentionAlertModal',
			alertHash: '#mentionAlertModal'
		});
    var now = new Date();
    $('#modal').modal("show");
    var to = $('#date_startTask').datetimepicker({
      minDate: now,
      onShow:function( ct ){
        this.setOptions({
          minDate:jQuery('#date_endTask').val()?jQuery('#date_endTask').val():false
        })
      }
    });
    var from = $('#date_endTask').datetimepicker({
      minDate: now,
      onShow:function( ct ){
        this.setOptions({
          minDate:jQuery('#date_startTask').val()?jQuery('#date_startTask').val():false
        })
      }
    });
  });

  function submitTaskForm()
  {
    if ( $("#id_user_modal").val() != "" )
    {
      if ( $("#taskForm").validate() )
      {
        $("#taskForm").submit();
      }
    }
  }

	function selectContact( info )
	{
		$('#id_user_modal').val( info.id );
	}

	function refreshMention()
	{
		$('#id_user_modal').val('');
		$('#user_modal').val('');
		$('#user_modal').show();
		$('#mentionAlertModal').remove();
		$('#user_modal').focus();
	}
</script>