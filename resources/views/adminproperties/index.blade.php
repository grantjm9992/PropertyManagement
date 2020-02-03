<form id="form">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-ld-6 form-group">
                <label for="">Title</label>
                <input type="text" class="form-control" name="title" id="title">
            </div>
            @if ( $user->role == "SA" )
                <div class="col-12 col-lg-6 form-group">
                    <label for="">Company</label>
                    <select name="id_company" id="id_company" class="form-control">
                        <option value="">All</option>
                        @foreach ( $companies as $company )
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div class="col-12 col-lg-6 form-group">
                <label for="">Resort</label>
                <select name="id_resort" id="id_resort" class="form-control">
                    <option value="">All</option>
                    @foreach ( $resorts as $resort )
                        <option value="{{ $resort->id }}">{{ $resort->name }}</option>
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
    })
</script>