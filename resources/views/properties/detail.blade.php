<section class="intro-section p-5">
    <div class="container">
        <div class="native-holder">
            <div class="buttons">
                <a href="Properties" class="label alert-green-outline">
                    <i class="fas fa-arrow-left"></i> Back to property list
                </a>
            </div>
            <h3 class="w-100 p-4 native-under">
                {{ $property->public_title }}
            </h3>
        </div>
    </div>
</section>
<section>
    <div class="container my-3">
        <div class="row">
            <div class="col-12">
                <div id="carousel" class="owl-carousel">
                    @foreach ( $images as $image )
                        <img src="{{ $image->path }}" style="width: 100%;" alt="">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container py-5">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3">
                <div class="native-holder">
                    <h3 class="native-under">
                        Summary
                    </h3>
                </div>
                <div class="d-block">
                    <div class="detail-section-info">
                        <div>
                            <b>
                            Location:
                            </b> {{ $property->location }}
                        </div>
                        <div>
                            <b>
                            Sleeps:
                            </b> {{ $property->sleeps }}
                        </div>
                        <div>
                            <b>
                            Beds:
                            </b> {{ $property->bed }}
                        </div>
                        <div>
                            <b>
                            Bedrooms:
                            </b> {{ $property->bedrooms }}
                        </div>
                        <div>
                            <b>
                            Bathrooms:
                            </b> {{ $property->bath }}
                        </div>
                    </div>
                </div>            
            </div>
            <div class="col-12 col-md-8 col-lg-9">
                <div class="native-holder">
                    <h3 class="native-under">
                        Property description
                    </h3>
                </div>
                <div class="d-block">
                    {!! $property->description !!}
                </div>
            </div>
            <div class="col-12 mt-5">
                <div class="native-holder">
                    <h3 class="native-under">
                        Property features
                    </h3>
                </div>
                <div class="detail-section-info">
                    <ul>
                    @foreach ( $features as $feature )
                        <li>
                            <i class="fas fa-check"></i> {{ $feature->title }}
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-12 mt-5">
                <ul class="nav tabby" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                            <div class="native-holder">
                                <h5 class="tabby">
                                    Location
                                </h5>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                            <div class="native-holder">
                                <h5 class="tabby">
                                    {{ $resort->name }}
                                </h5>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">
                            <div class="native-holder">
                                <h5 class="tabby">
                                    Points of interest
                                </h5>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div id="map" style="width: 100%; height: 400px;"></div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        {!! $resort->description !!}
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    $(document).ready( function() {
        $('#carousel').owlCarousel({
            loop: true,
            margin: -1,
            items: 1,
            nav: true,
            navText: ['<i class="fas fa-chevron-left" aria-hidden="true"></i>', '<i class="fas fa-chevron-right" aria-hidden="true"></i>'],
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true
        });
    })
</script>

<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAs6KdmD9OYa2BHZb734w7dmA0QWWa5Dk&callback=initMap">
</script>
<script>

// NOTE: The actual working javascript code for this pen is located in the settings. I also include it here for display purposes. 

var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 51.5154, lng: -0.08441}, // lat/long of center of map
          zoom: 15, // 8 or 9 is typical zoom 
          scrollwheel:  false, // prevent mouse scroll from zooming map. 
          mapTypeControl: true, //default
          mapTypeControlOptions: {
              style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
              position: google.maps.ControlPosition.BOTTOM_CENTER
          },
          zoomControl: true, //default
          zoomControlOptions: {
              position: google.maps.ControlPosition.LEFT_CENTER
          },
          streetViewControl: false, //default
          streetViewControlOptions: {
              position: google.maps.ControlPosition.LEFT_TOP
          }, 
          fullscreenControl: false,
          styles: [
        {
          "featureType": "administrative.neighborhood",
          "stylers": [
            {
              "visibility": "off"
            }
          ]
        },
        {
          "featureType": "poi",
          "stylers": [
            {
              "visibility": "off"
            }
          ]
        },
        {
          "featureType": "poi.business",
          "stylers": [
            {
              "visibility": "off"
            }
          ]
        },
        {
          "featureType": "poi.park",
          "stylers": [
            {
              "visibility": "simplified"
            }
          ]
        },
        {
          "featureType": "poi.school",
          "stylers": [
            {
              "visibility": "off"
            }
          ]
        },
        {
          "featureType": "transit.station",
          "stylers": [
            {
              "visibility": "simplified"
            }
          ]
        }
]
        });
              // create custom marker, if necessary, with option custom size
              var marker = new google.maps.Marker({
                position: {lat: 51.5154, lng: -0.08441}, // lat/long of marker 51.567052 0.051306
                map: map,
                animation: google.maps.Animation.DROP, // drops marker in from top
                title: 'Crestwave Solutions', // title on hover over marker
                icon: {
                        url: 'assets/images/placeholder.png',
                        size: new google.maps.Size(60,60),
                        scaledSize: new google.maps.Size(60,60)
                }
            
                });
      }

$(document).ready( function()
{
initMap();
})
</script>
@isset($arrivalForm)
    {!! $arrivalForm !!}
@endisset