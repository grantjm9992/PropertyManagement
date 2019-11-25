@if ( $i % 2 )
<div class="container-fluid bg-white">
    <div class="section">
        <div class="row">
            <div class="col-12">
                <h3 class="section-title">
                {!! $section->title !!}
                </h3>
                <div class="section-divider"></div>
                @if ( $section->subtitle != "" )
                <div class="section-description">
                {!! $section->subtitle !!}
                </div>
                @endif
            </div>
            @if ( $section->image != "" && $section->description != "" )
            <div class="col-12 order-2 col-lg-6 order-lg-1">
                <div class="medium-image" data-aos=""
                data-aos-easing="ease-out-cubic"
                data-aos-duration="2000" style="background-image: url({{ $section->image }})">
                </div>
            </div>
            <div class="col-12 order-1 col-lg-6 order-lg-2">
                {!! $section->description !!}
            </div>
            @elseif( $section->description != "" )
            <div class="col-12">
                {!! $section->description !!}
            </div>
            @else
            <div class="col-12">
                <div class="medium-image" data-aos=""
                data-aos-easing="ease-out-cubic"
                data-aos-duration="2000" style="background-image: url({{ $section->image }})">
                </div>
            </div>
            @endif
        </div>
    </div>    
</div>
@else
<div class="container-fluid">
    <div class="section">
        <div class="row">
            <div class="col-12">
                <h3 class="section-title">
                {!! $section->title !!}
                </h3>
                <div class="section-divider"></div>
                @if ( $section->subtitle != "" )
                <div class="section-description">
                {!! $section->subtitle !!}
                </div>
                @endif
            </div>
            @if ( $section->image != "" && $section->description != "" )
            <div class="col-12 order-1 col-lg-6 order-lg-2">
                {!! $section->description !!}
            </div>
            <div class="col-12 order-2 col-lg-6 order-lg-1">
                <div class="medium-image" data-aos=""
                data-aos-easing="ease-out-cubic"
                data-aos-duration="2000" style="background-image: url({{ $section->image }})">
                </div>
            </div>
            @elseif( $section->description != "" )
            <div class="col-12">
                {!! $section->description !!}
            </div>
            @else
            <div class="col-12">
                <div class="medium-image" data-aos=""
                data-aos-easing="ease-out-cubic"
                data-aos-duration="2000" style="background-image: url({{ $section->image }})">
                </div>
            </div>
            @endif
        </div>
    </div>    
</div>
@endif