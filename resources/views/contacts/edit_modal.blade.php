<div id="register" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Contact</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="addContact">
            <div class="row">
              <input type="text" hidden name="id" id="id" value="{{ $contact->id }}">
                <div class="form-group col-12">
                    <input type="text" name="name" value="{{ $contact->name }}" required class="form-control">
                </div>
                <div class="form-group col-12">
                    <input type="text" name="surname" value="{{ $contact->surname }}" required class="form-control">
                </div>
                <div class="form-group col-12">
                    <input type="text" name="email" value="{{ $contact->email }}" required class="form-control">
                </div>
                <div class="form-group col-12">
                    <input type="text" name="phone" value="{{ $contact->phone }}" class="form-control">
                </div>
                <div class="form-group col-12">
                    <select name="type" id="type" class="form-control">
                        <option value="">Type of contact</option>
                        @foreach ( $types as $type )
                            <option value="{{ $type->id }}">{{ $type->type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
          </form>          
      </div>
      <div class="modal-footer">
        <div onclick="submitContact()" class="btn btn-primary">Submit</div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
  <script>
      $(document).ready( function() {
          $('#register').modal('show');
          $('#type').val('{{ $contact->type }}');
      })
  </script>
</div>