<section class="intro-section">
    <div class="container bg-white p-5">
        <div class="native-holder">
            <h3 class="w-100 p-4 native-left">
            Contact us
            </h3>
        </div>
    </div>
</section>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAs6KdmD9OYa2BHZb734w7dmA0QWWa5Dk&callback=initMap">
</script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.3&appId=1339131149476537&autoLogAppEvents=1"></script>
<section class="intro-section">
  <div class="container bg-white p-5">
    <div id="map" style="width: 100%; height: 400px;"></div>
  </div>
</section>
<script>
      var map;
            function initMap() {
              map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 37.7597716, lng: -0.8267409},
                zoom: 15,
                scrollwheel:  false,
                mapTypeControl: true, 
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
                    "visibility": "true"
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
                position: {lat: 37.7597716, lng: -0.8267409}, // lat/long of marker 51.567052 0.051306
                map: map,
                animation: google.maps.Animation.DROP, // drops marker in from top
                title: 'We´re here', // title on hover over marker
                icon: {
                        url: '{{ url("img/mapicon.png") }}',
                        size: new google.maps.Size(70,70),
                        scaledSize: new google.maps.Size(70,70)
                          }
            
                });
            }
    
$(document).ready( function()
{
    initMap();
})
</script>
<section class="intro-section">
  <div class="container bg-white p-5">
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="">
                <div class="detail-section-title">
                    contact us
                </div>
                <div class="detail-section-info">
                    <form action="Home.register">
                        <div class="row">
                            <div class="form-group col-12 col-md-4">
                                <input type="text" class="form-control" name="name" placeholder="Name">
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <input type="text" class="form-control" name="phone" placeholder="Phone">
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <input type="email" class="form-control" name="email" placeholder="Email">
                            </div>
                            <div class="form-group col-12">
                                <textarea name="text" id="" cols="30" rows="10" class="form-control" placeholder="Your message here..."></textarea>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <button class="btn btn-primary width-100" type="submit">
                                    Request information                            
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
          <div class="d-block p-3">
            <div class="d-inline-flex w-100">
              <div class="contact-icon">
                <i class="fas fa-paper-plane"></i>
              </div>
              <div class="contact-info">
                <h4>
                  Contact information
                </h4>
                @if ( $company->email != "" )
                <p class="mt-2">
                  Email: {{ $company->email }}
                </p>
                @endif
                @if ( $company->phone != "" )
                <p class="mb-2">
                  Phone: {{ $company->phone }}
                </p>
                @endif
              </div>
            </div>
          </div>
          <div class="d-block p-3">
            <div class="d-inline-flex w-100">
              <div class="contact-icon">
                <i class="fas fa-compass"></i>
              </div>
              <div class="contact-info">
                <h4>
                  Address
                </h4>
                <p class="mt-2">
                  {!! $company->addresss !!}
                </p>
              </div>
            </div>
          </div>
          <div class="d-block p-3">
            <div class="d-inline-flex w-100">
              <div class="contact-icon">
                <i class="fas fa-share-alt"></i>
              </div>
              <div class="contact-info">
                <h4
                  >Social
                </h4>
                <p class="mt-2 justify-content-between w-100 d-inline-flex ">
                  @if ( $company->link_facebook != "" )
                    <a style="color: rgba(0,0,0,.8); font-size: 2.1rem;" target="_blank"  href="{{ $company->link_facebook }}"><i class="fab fa-facebook"></i></a>
                  @endif
                  @if ( $company->link_twitter != "" )
                    <a style="color: rgba(0,0,0,.8); font-size: 2.1rem;" target="_blank"  href="{{ $company->link_twitter }}"><i class="fab fa-twitter"></i></a>
                  @endif
                  @if ( $company->link_instagram != "" )
                    <a style="color: rgba(0,0,0,.8); font-size: 2.1rem;" target="_blank"  href="{{ $company->link_instagram }}"><i class="fab fa-instagram"></i></a>
                  @endif
                  @if ( $company->link_linkdin != "" )
                    <a style="color: rgba(0,0,0,.8); font-size: 2.1rem;" target="_blank"  href="{{ $company->link_linkdin }}"><i class="fab fa-linkedin"></i></a>
                  @endif
                  @if ( $company->link_google != "" )
                    <a style="color: rgba(0,0,0,.8); font-size: 2.1rem;" target="_blank"  href="{{ $company->link_google }}"><i class="fab fa-google-plus-g"></i></a>
                  @endif
                  @if ( $company->link_youtube != "" )
                    <a style="color: rgba(0,0,0,.8); font-size: 2.1rem;" target="_blank"  href="{{ $company->link_youtube }}"><i class="fab fa-youtube"></i></a>
                  @endif
                </p>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</section>