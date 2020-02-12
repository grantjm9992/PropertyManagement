<form id="form">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-ld-6 form-group">
                <label for="">Title</label>
                <input type="text" class="form-control" name="title" id="title">
            </div>
            <div class="col-12 col-lg-6 form-group">
                <label for="">Resort</label>
                <select name="id_resort" id="id_resort" class="form-control select2">
                    <option value="">All</option>
                    @foreach ( $resorts as $resort )
                        <option value="{{ $resort->id }}">{{ $resort->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-lg-6 form-group">
                <label for="">Property Owner</label>
                <select name="id_property_owner" id="id_property_owner" class="form-control select2">
                    <option value="">All</option>
                    @foreach ( $property_owners as $resort )
                        <option value="{{ $resort->id }}">{{ $resort->name }} {{ $resort->surname }}</option>
                    @endforeach
                </select>
            </div>
            <div id="properties" class="col-12">
                {!! $listado !!}
            </div>
        </div>
    </div>
</form>

<script>


function searchContacts()
    {
        $.ajax({
            type: "POST",
            url: "AdminProperties.listado",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: $("#form").serialize(),
            success: function(data)
            {
                $('#properties').html(data);
            }
        })
    }

    $(document).ready ( function() {
        $('#form input').on("keyup", function() {
            searchContacts();
        });
        $('#form select').on("change", function() {
            searchContacts();
        });
        $(".select2").select2();
    })
</script>