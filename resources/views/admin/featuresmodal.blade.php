<div class="modal fade" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog large-modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Manage features</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" id="modal_table">
                        {!! $table !!}
                    </div>                
                </div>
            </div>
            <div class="modal-footer">
                <input type="text" hidden id="values" value="">
                <div class="btn btn-outline-primary" onclick="updateFeatures()">Update</div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function () {
        $('#modal').on('show.bs.modal', function () {
            $(this).find('.modal-body').css({
                    width:'auto', //probably not needed
                    height:'auto', //probably not needed 
                    'max-height':'100%'
            });
        });
        $('#modal').modal();
        $('#modal').removeClass('fade');
    });
</script> 
</div>
