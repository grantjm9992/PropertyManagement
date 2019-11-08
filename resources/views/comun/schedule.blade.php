<div class="container-fluid" id="rentals">
@if ( count( $rentals ) > 0 )
    @foreach ( $rentals as $row )
        <a href="Reservations.detail?id={{ $row->id }}">
            <div rental="{{ $row->id}}" class="rental row">
                <div class="col-12 col-xl-4">
                    Rental for: {{ $row->name }} {{ $row->surname }}
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <i class="fas fa-clock"></i> From: {{ $row->date_start }}
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <i class="fas fa-clock"></i> To: {{ $row->date_end }}
                </div>
            </div>
        </a>
    @endforeach
@else
    <div class="alert alert-warning">
        <h5>
            <i class="fas fa-thumbs-down text-light"></i> There are no reservations for this property
        </h5>
    </div>
@endif
</div>