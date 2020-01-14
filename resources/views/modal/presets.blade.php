<div id="presetModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add preset section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
              <select name="id_preset" id="id_preset" class="form-control">
                  @foreach ( $presets as $pr )
                    <option value="{{ $pr->id }}">{{ $pr->title }}</option>
                  @endforeach
              </select>
          </div>          
      </div>
      <div class="modal-footer">
        <div onclick="addPreset()" class="btn btn-primary">Submit</div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready( function() {
    $("#presetModal").modal("show");
  });


  function addPreset()
  {
    $.ajax({
        type: "POST",
        url: "Pages.addPresetSection",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{
            id_page: "{{ $id_page }}",
            id_preset_section: $('#id_preset').val()
        },
        success: function(data)
        {
            $("#presetModal").modal("hide");
            $("#presetModal").remove();
            $('#items').append(data);
        }
    })
  }
</script>