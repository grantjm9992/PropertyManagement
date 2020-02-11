<div id="modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Send message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="" id="msgForm">
            <div class="row">
              <div class="col-12 form-group">
                <label for="user">To</label>
                <select class="form-control select2" name="id_user" id="id_user" data-dropdown-css-class="select2-purple" style="width: 100%;">
                    @foreach( $users as $user )
                    <option value="{{ $user->id }}">{{ $user->name }} {{ $user->surname }}</option>
                    @endforeach
                </select>
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
    $('.select2').select2();
    $('#modal').modal("show");
  });

  function submitTaskForm()
  {
    if ( $("#id_user").val() != "" )
    {
      if ( $('#message').val() != "" )
      {
        $.ajax({
          type: "POST",
          url: "Messages.add",
          data: $("#msgForm").serialize(),
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
          success: function(data)
          {
            $('#modal').modal("hide");
            md.showNotification("top", "center", "Message sent successfully");
          }
        });
      }
    }
  }
</script>