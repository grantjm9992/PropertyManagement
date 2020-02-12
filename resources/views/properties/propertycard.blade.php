<!-- Property Block -->
<div class="property-block col-xl-4 col-lg-6 col-md-6 col-sm-12">
    <div class="inner-box">
        <div class="image-box">
            <figure class="image"><img src="{{ $property->image }}" alt=""></figure>
            <span class="featured">FEATURED</span>
            <ul class="option-box">
                <li><a href="{{ $property->image }}" class="lightbox-image" data-fancybox="property"><i class="la la-camera"></i></a></li>
                <li><a href="#"><i class="la la-heart"></i></a></li>
                <li><a href="#"><i class="la la-retweet"></i></a></li>
            </ul><!--
            <ul class="info clearfix">
                <li><a href="properties.html"><i class="la la-calendar-minus-o"></i>2 Years Ago</a></li>
            </ul>-->
        </div>
        <div class="lower-content">
            <!--<ul class="tags">
                <li><a href="property-detail.html">Apartment</a>,</li>
                <li><a href="property-detail.html">Bar</a>,</li>
                <li><a href="property-detail.html">House</a>,</li>
            </ul>-->
            <div class="thumb"><img src="{{ $property->image }}" alt=""></div>
            <h3><a href="Properties.detail?id={{ base64_encode( $property->id ) }}">{{ $property->public_title }}</a></h3>
            <div class="lucation"><i class="la la-map-marker"></i> {{ $property->resort }}</div>
            <ul class="property-info clearfix">
                <li><i class="flaticon-dimension"></i> 356 Sq-Ft</li>
                <li><i class="flaticon-bed"></i> {{ $property->bedrooms }} Bedrooms</li>
                <li><i class="flaticon-car"></i> {{ $property->sleeps }} Sleeps</li>
                <li><i class="flaticon-bathtub"></i> {{ $property->bath }} Bathroom</li>
            </ul>
            <div class="property-price clearfix">
                <div class="read-more"><a href="Properties.detail?id={{ base64_encode( $property->id ) }}" class="theme-btn">More Detail</a></div>
            </div>
        </div>
    </div>
</div>