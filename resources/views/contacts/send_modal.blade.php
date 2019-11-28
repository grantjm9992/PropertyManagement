<div id="message" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Send Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="sendMessage">
            <div class="row">
                <input type="text" name="id_user" value="{{ $contact->id }}" hidden>
                <div class="form-group col-12">
                    <input type="text" readonly value="{{  $contact->name }} {{ $contact->surname }}" class="form-control">
                </div>
                <div class="form-group col-12">
                    <input type="text" readonly value="{{ $contact->email }}" class="form-control">
                </div>
                <div class="form-group col-12">
                  <textarea name="message" id="message" cols="30" rows="7" class="form-control"></textarea>
                </div>
            </div>
            <input name="modal" value="1" hidden type="text"/>
          </form>          
      </div>
      <div class="modal-footer">
        <div onclick="submitMessage()" class="btn btn-primary">Submit</div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
  <script>
      $(document).ready( function() {
          $('#message').modal('show');
      })
  </script>
</div>