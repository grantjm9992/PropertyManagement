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
          <form action="Home.register">
            <div class="row">
                <div class="form-group col-12">
                    <input type="text" class="form-control" required name="forename" placeholder="Forename*">
                </div>
                <div class="form-group col-12">
                    <input type="text" class="form-control" required name="surname" placeholder="Surname*">
                </div>
                <div class="form-group col-12">
                    <input type="text" class="form-control" required name="email" placeholder="Email*">
                </div>
                <div class="form-group col-12">
                    <input type="text" class="form-control" required name="telephone" placeholder="Telephone*">
                </div>
                <div class="form-group col-12">
                    <label for="forername">Max. price</label>
                    <select name="value" id="value" class="form-control">
                      <option value="">Any</option>
                      <option value="50000">€50000</option>
                      <option value="100000">€100000</option>
                      <option value="150000">€150000</option>
                      <option value="200000">€200000</option>
                      <option value="250000">€250000</option>
                      <option value="300000">€300000</option>
                    </select>
                </div>
                <div class="form-group col-12">
                    <label for="type">Interested in</label>
                    <select name="type" id="type" class="form-control">
                      <option value="Villa with Pool">Villa with Pool</option>
                      <option value="Apartments">Apartments</option>
                      <option value="Golf Property">Golf Property</option>
                      <option value="Beach-front Property">Beach-front Property</option>
                      <option value="Properties on a Resort">Properties on a Resort</option>
                      <option value="Bank Repossessions">Bank Repossessions</option>
                    </select>
                </div>
                <div class="form-check col-12" style="padding-left: 2rem;">
                  <input type="text" name="subscribe" id="subscribe" hidden value="0">
                  <input type="checkbox" class="form-check-input" id="check">
                  <label class="form-check-label" for="check">Subscribe to receive information about the hottest properties in Spain at the best price.</label>
                </div>
                <button type="submit" id="submit" hidden></button>
            </div>
          </form>          
      </div>
      <div class="modal-footer">
        <div onclick="$('#submit').click()" class="btn btn-primary">Submit</div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
  <script>
      $(document).ready( function() {
          $('#register').modal('show');
          $('#check').change( function() {
            if ( $(this).is(':checked') )
            {
              $('#subscribe').val(1);
            }
            else
            {
              $('#subscribe').val(0);
            }
          })
      })
  </script>
</div>