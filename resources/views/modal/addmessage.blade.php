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
          <form action="Messages.add" id="taskForm">
            <div class="row">
              <div class="col-12 form-group">
                <label for="user">To</label>
                <input type="text" id="user" required class="form-control">
                <input type="text" hidden name="id_user" id="id_user" required>
              </div>
              <div class="form-group col-12">
                <textarea name="message" id="message" cols="30" rows="5" placeholder="Message" class="form-control"></textarea>
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
    $('#modal').modal("show");
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