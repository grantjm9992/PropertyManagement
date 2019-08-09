<script src="js/set-menu.js"></script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAs6KdmD9OYa2BHZb734w7dmA0QWWa5Dk&callback=initMap">
</script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.3&appId=1339131149476537&autoLogAppEvents=1"></script>
<div id="map" style="width: 100%; height: 500px;"></div>
<script>

      // NOTE: The actual working javascript code for this pen is located in the settings. I also include it here for display purposes. 

      var map;
            function initMap() {
              map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 37.7597716, lng: -0.8267409}, // lat/long of center of map
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
                position: {lat: 37.7597716, lng: -0.8267409}, // lat/long of marker 51.567052 0.051306
                map: map,
                animation: google.maps.Animation.DROP, // drops marker in from top
                title: 'Costa Calida Properties', // title on hover over marker
                icon: {
                        url: '{{ url("img/mapicon.png") }}',
                        size: new google.maps.Size(70,90),
                        scaledSize: new google.maps.Size(70,90)
                          }
            
                });
            }
    
$(document).ready( function()
{
    initMap();
})
</script>
<div class="container-fluid">
    <div class="row paddingBIG text-center" id="contact">
        <div class="col-12 col-md-6">
            <i class="fas fa-location-arrow"></i>
            <br> Nueva Ribera Beach Club
            <br> Los Alcazares
            <br> Murcia
            <br> 30710 
        </div>
        <div class="col-12 col-md-6">
            <i class="fas fa-envelope"></i>
            <br>
            info@calidainternationalproperties.com
            <br>
            <i class="fas fa-phone"></i>
            <br>
            UK +44 1442 620 800
            <br>
            Spain +34 960 461 468            
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="detail-section">
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
                                <button class="btn btn-resort width-100" type="submit">
                                    Request information                            
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
        <div class="detail-section fb-page" data-width="320" data-href="https://www.facebook.com/CasaCalidaProperty/" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/CasaCalidaProperty/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/CasaCalidaProperty/">Calida International Properties</a></blockquote></div>
        </div>
    </div>
</div>