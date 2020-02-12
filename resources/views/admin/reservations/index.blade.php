<div class="container-fluid">
    <form id="form">
        <div class="row">
            <div class="form-group col-12">
                <label for="">Search guest</label>
                <input type="text" class="form-control" name="search_guest">
            </div>
            <div class="form-group col-12 col-lg-4">
                <label for="">Resort</label>
                <select class="form-control select2" name="id_resort" style="width: 100%;">
                    <option selected="selected" value="">All</option>
                    @foreach( $resorts as $resort )
                    <option value="{{ $resort->id }}">{{ $resort->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-12 col-lg-4">
                <label for="">From</label>
                <input type="text" name="from" id="from" class="form-control">
            </div>
            <div class="form-group col-12 col-lg-4">
                <label for="">To</label>
                <input type="text" name="to" id="to" class="form-control">
            </div>
        </div>
    </form>
    <div class="row mt-4">
        <div class="col-12" id="reservations">
            {!! $listado !!}
        </div>
    </div>
</div>

<script>
    $(document).ready( function() {
        $('.select2').select2()
        $('#from').datepicker({
            dateFormat: "yy-mm-dd"
        });
        $('#from').datepicker("setDate", new Date());
        $('#to').datepicker({
            dateFormat: "yy-mm-dd"
        });

        $('#form input').on("change", function() {
            $.ajax({
                type: "POST",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: "Reservations.getList",
                data: $("#form").serialize(),
                success: function (data)
                {
                    $('#reservations').html(data);
                }
            })  
        });
        $('#form select').on("change", function() {
            $.ajax({
                type: "POST",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: "Reservations.getList",
                data: $("#form").serialize(),
                success: function (data)
                {
                    $('#reservations').html(data);
                }
            })  
        });
    });
</script>