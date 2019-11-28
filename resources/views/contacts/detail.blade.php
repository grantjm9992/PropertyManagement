

<div id="contact" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Contact info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
            <div class="row" style="font-weight: 500;">
                <div class="col-12 p-4">
                    <i class="fas fa-user"></i>&nbsp;&nbsp;&nbsp;{{ $contact->name }} {{ $contact->surname }}
                </div>
                <div class="col-12 p-4">
                    <i class="fas fa-phone"></i>&nbsp;&nbsp;&nbsp;<a style="color:#222;" href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a>
                </div>
                <div class="col-12 p-4">
                    <i class="fas fa-envelope"></i>&nbsp;&nbsp;&nbsp;<a style="color:#222;" href="mailto:{{ $contact->phone }}">{{ $contact->email }}</a>
                </div>
                <div class="col-12 p-4">
                    <i class="fas fa-user-clock"></i>&nbsp;&nbsp;&nbsp;Last seen: {{ $contact->last_seen }}
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
  <script>
      $(document).ready( function() {
          $('#contact').modal('show');
      })
  </script>
</div>