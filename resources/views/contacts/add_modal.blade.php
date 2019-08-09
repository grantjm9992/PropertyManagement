<div id="register" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Register</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="addContact">
            <div class="row">
                <div class="form-group col-12">
                    <input type="text" name="name" placeholder="Name" required class="form-control">
                </div>
                <div class="form-group col-12">
                    <input type="text" name="surname" placeholder="Surname" required class="form-control">
                </div>
                <div class="form-group col-12">
                    <input type="text" name="email" placeholder="email" required class="form-control">
                </div>
                <div class="form-group col-12">
                    <input type="text" name="phone" placeholder="Phone" class="form-control">
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
      })
  </script>
</div>