<div class="modal fade" id="submitPropertyDialog" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Submit Property</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="Home.register">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-12 form-group">
                        <label for="">Surname</label>
                        <input type="text" name="surname" class="form-control" required>
                    </div>
                    <div class="col-12 form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-control" required>
                    </div>
                    <input type="text" hidden name="subject" value="Submit Property">
                    <div class="col-12 form-group">
                        <label for="">Phone</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="col-12 form-group">
                        <label for="">Property details (Location, property type, bedrooms etc.)</label>
                        <textarea name="message" id="message" cols="30" rows="4" class="form-control" required></textarea>
                    </div>
                    <button type="submit" id="submitPropertyForm" class="d-none"></button>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="theme-btn btn-style-two" data-dismiss="modal">Close</button>
        <div onclick="submitProperty()" class="theme-btn btn-style-five">Save</div>
      </div>
    </div>
  </div>
    <script>
        $(document).ready(function() {
            $('#submitPropertyDialog').modal("show");
        })
        function submitProperty() {
            $("#submitPropertyForm").click();
        }
    </script>
</div>