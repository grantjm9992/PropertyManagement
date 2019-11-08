<section class="mt-4 p-4">
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-lg-10 offset-lg-1">
            <div class="container-fluid pt-4">
                <form action="" id="filter">
                <div class="row">
                    <div class="col-12 col-lg-4 form-group">
                        <label for="">Sleeps</label>
                        <select name="sleeps" id="sleeps" class="form-control">
                            <option value="">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5+</option>
                        </select>
                    </div>
                    <div class="col-12 col-lg-4 form-group">
                        <label for="">Bedrooms</label>
                        <select name="bedrooms" id="bedrooms" class="form-control">
                            <option value="">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5+</option>
                        </select>
                    </div>
                    <div class="col-12 col-lg-4 form-group">
                        <label for="">Beds</label>
                        <select name="beds" id="beds" class="form-control">
                            <option value="">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5+</option>
                        </select>
                    </div>
                    <div class="col-12 col-lg-4 form-group">
                        <label for="">Resort</label>
                        <select name="id_resort" id="id_resort" class="form-control">
                            <option value="">Any</option>
                            @foreach ( $resorts as $resort )
                                <option value="{{ $resort->id }}">{{ $resort->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            </form>
            <div class="container-fluid pt-5">
                <div class="row" id="property-list">
                    {!! $listings !!}
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<script>
    $(document).ready( function() {
        $('#filter select').on( "change", function(data) {
            $.ajax({
                type: "POST",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: "Properties.getListings",
                data: $('#filter').serialize(),
                success: function( data ) 
                {
                    $("#property-list").html(data);
                }
            })
        });
    })
</script>