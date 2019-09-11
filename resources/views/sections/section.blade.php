@if ( $i % 2 )
<div style="margin-top: 30px;" class="row" data-aos="fade-up"  
     data-aos-duration="2000">
    <div class="col-12 col-lg-6">
        <div class="medium-text text-center">
            <h3 class="width100 text-center">
                {!! $section->title !!}            
            </h3>
            <p class="width100 text-center">
                {!! $section->description !!}            
            </p>
            @if ( (int)$section->button === 1 )
            <br>
            <a href="{{ $section->button_link }}" class="btn btn-resort-outline">
                {!! $section->button_text !!}
            </a>
            @endif
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="medium-image" data-aos="flip-left"  
     data-aos-duration="3000" style="background-image: url({{ $section->image }} )">
        </div>
    </div>
</div>
@else
<div style="margin-top: 30px;" class="row" data-aos="fade-up"  
     data-aos-duration="2000">
    <div class="col-12 order-2 col-lg-6 order-lg-1">
        <div class="medium-image" data-aos="flip-left"
     data-aos-easing="ease-out-cubic"
     data-aos-duration="2000" style="background-image: url({{ $section->image }})">
        </div>
    </div>
    <div class="col-12 order-1 col-lg-6 order-lg-2">
        <div class="medium-text text-center">
            <h3 class="width100 text-center">
                {!! $section->title !!}
            </h3>
            <p class="width100 text-center">
                {!! $section->description !!}
            </p>
            @if ( (int)$section->button === 1 )
            <br>
            <a href="{{ $section->button_link }}" class="btn btn-resort-outline">
                {!! $section->button_text !!}
            </a>
            @endif
        </div>
    </div>
</div>
@endif


<div class="section">
    <div class="row">
        <h3 class="section-title">

        </h3>
        <div class="section-divider"></div>
        <div class="section-description">
            
        </div>
    </div>
</div>