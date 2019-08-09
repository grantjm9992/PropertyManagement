@inject('translator', 'App\Providers\TranslationProvider')
<script src="js/scroll-menu.js"></script>
<!--<section class="hero-section">
	<div class="hero-slider owl-carousel">
		{!! $pageHTML !!}
		<div class="hs-item set-bg sp-pad" data-setbg="img/hero-slider/4.jpg">
		</div>
	</div>
	<div class="hs-text">
		<h2 class="hs-title">Gallery</h2>
		<p class="hs-des">
			<a href="{{ url('Gallery') }}" style="font-size: 24px;" class="btn btn-outline-white">
				Explore
			</a>
		</p>
	</div>
</section>
-->

<section style="position: relative;" id="top">

	<div class="hero-slider owl-carousel">
		<div class="hs-item set-bg sp-pad" data-setbg="img/hero-slider/Home1.jpg">
		</div>
		<div class="hs-item set-bg sp-pad" data-setbg="img/hero-slider/Home2.jpg">
		</div>
		<div class="hs-item set-bg sp-pad" data-setbg="img/footer.jpg">
		</div>
		<div class="hs-item set-bg sp-pad" data-setbg="img/hero-slider/Home4.jpg">
		</div>
	</div>
	<div class="newheader">
		<h1 style="font-weight: bold;color: #fff;">Nueva Ribera Beach Club</h1>
		<h4 style="margin-top: 20px; color: #fff;">
			Properties from €80,000
		</h4>
		<p>
			<a style="margin-top: 20px;" id="heroScroll" class="btn btn-resort btn-extra-padding caps">More info</a>
		</p>
	</div>
</section>
<div class="search-banner">
	<form action="Availability" id="searchForm">
		<div class="row">
			<div class="col-12" style="margin-bottom: 1rem;">
				<div class="md-hidden btn btn-resort-green width-100" onclick="toggleSearch()">
					Find apartments
				</div>
			</div>
			<div class="col-12 col-md-3 form-group">
				<select name="id_type" id="id_type" class="form-control">
					<option value="">All types</option>
					@foreach ( $types as $type )
						<option value="{{ $type->id }}">{{ $type->title }}</option>
					@endforeach
				</select>
			</div>
			<div class="col-12 col-md-3 form-group">
				<select name="beds" id="beds" class="form-control">
					<option value="">Any beds</option>
					<option value="1">1 bed</option>
					<option value="2">2 beds</option>
					<option value="3">3 beds</option>
					<option value="4">4 beds</option>
					<option value="5">5 beds</option>
					<option value="6">6 beds</option>
					<option value="7">7 beds</option>
				</select>
			</div>
			<div class="col-12 col-md-3 form-group">
				<select name="max_price" id="max_price" class="form-control">
					<option value="">Any price</option>
					<option value="50000">€50,000</option>
					<option value="100000">€100,000</option>
					<option value="150000">€150,000</option>
					<option value="200000">€200,000</option>
					<option value="250000">€250,000</option>
					<option value="300000">€300,000</option>
					<option value="400000">€400,000</option>
					<option value="500000">€500,000</option>
					<option value="1000000">€1,000,000</option>
				</select>
			</div>
			<div class="col-12 col-md-3 form-group">
				<button type="submit" class=" btn btn-resort width-100">
					Search
				</button>
			</div>
		</div>
	</form>
</div>
<section class="residence-section" style="background: #fff; margin-top: 3px;" id="first_section" data-aos="fade-up"  
     data-aos-duration="2000">
	<div class="container-fluid">
		<div class="row text-center">
			<div class="col-12 col-lg-4 order-1 order-lg-1" data-aos="fade-up"  
     data-aos-duration="5000">
				<div style="border-radius: 50%; width: 230px; height: 230px; margin: 0 auto 15px auto; background-image: url(img/beachline.jpg); background-size: cover; background-position: center; background-repeat: no-repeat;"></div>
				<div>
					<h3 style="margin: 10px auto; text-align: center;">Golden Beaches</h3>
					<p style="margin: 10px auto; text-align: center;">
					On your doorstep is a fantastic coastline stretching for 7km of golden sandy beaches, which merges with the warm waters of the Mar Menor. 
					</p>
				</div>
			</div>
			<div class="col-12 col-lg-4 order-3 order-lg-2" data-aos="fade-up"  
     data-aos-duration="2000">
				<div style="border-radius: 50%; width: 230px; height: 230px; margin: 0 auto 15px auto; background-image: url(img/footer.jpg); background-size: cover; background-position: center; background-repeat: no-repeat;"></div>
				<div>
					<h3 style="margin: 10px auto; text-align: center;">Local Attractions </h3>
					<p style="margin: 10px auto; text-align: center;">
					In Los Alcazares you are only a short walk or drive from a variety of attractions, landmarks, cities, family activities, restaurants and fun things to do for all ages.
					</p>
				</div>
			</div>
			<div class="col-12 col-lg-4 order-5 order-lg-3" data-aos="fade-up"  
     data-aos-duration="5000">
				<div style="border-radius: 50%; width: 230px; height: 230px; margin: 0 auto 15px auto;background-image: url(img/Entrance1.jpg); background-size: cover; background-position: center; background-repeat: no-repeat;"></div>
				<div>
					<h3 style="margin: 10px auto; text-align: center;">Private Beach Resort</h3>
					<p style="margin: 10px auto; text-align: center;">
					Beautifully designed beachfront properties, 30 m from the beach, communal pool, 24-hour security and private parking. The resort is set in the perfect base for every type of holiday.					</p>
				</div>
			</div>
			<div class="col-12 col-lg-4 order-2 order-lg-4 md-mg-btm">
					<a href="Resort" style="margin-top: 20px;" class="btn btn-resort">See the Resort</a>			
			</div>
			<div class="col-12 col-lg-4 order-4 order-lg-5 md-mg-btm">
					<a href="Location" style="margin-top: 20px;" class="btn btn-resort">Discover the Area</a>			
			</div>
			<div class="col-12 col-lg-4 order-6 order-lg-6 md-mg-btm">
				<a href="Properties" style="margin-top: 20px;" class="btn btn-resort">Property for Sale</a>			
			</div>
		</div>
	</div>
</section>
<section class="residence-section bg-light" data-aos="fade-up"  
     data-aos-duration="2000">
	<div class="container-fluid">
		<div class="row" style="padding-top: 20px; padding-bottom: 20px;">
			<div class="col-12 order-2 col-lg-6 order-lg-1" data-aos="flip-right"  
     data-aos-duration="3000">
				<div style="background-image: url(img/Fore-sale.jpg); background-repeat: no-repeat; background-size: cover; background-position: center; width: 92%; margin: 0 auto; height: 300px;">
				</div>
			</div>
			<div class="col-12 order-1 col-lg-6 order-lg-2" data-aos="flip-left"  
     data-aos-duration="3000">
				<h3 style="margin: 10px auto; text-align: center;">Prices from €80,000</h3>
				<p style="margin: 10px auto; text-align: center;">
				Allow Nueva Rivera Beach Club to captivate you in their stunning surroundings. Comprising of 64 beautifully designed apartments, terraced housing or bungalows, the resort has everything to offer for a Mediterranean lifestyle or Holiday retreat. 				</p>
				<p style="margin: 10px auto; text-align: center;">
					<a href="Properties" class="btn btn-resort btn-extra-padding caps">
						Show me
					</a>
				</p>
			</div>
		</div>
		<div class="row" style="padding-top: 20px; padding-bottom: 20px;">
			<div class="col-12 order-2 col-lg-6 order-lg-2" data-aos="flip-left"  
     data-aos-duration="3000">
				<div style="background-image: url(img/swimming.jpg); background-repeat: no-repeat; background-size: cover; background-position: center; width: 92%; margin: 0 auto; height: 300px;">
				</div>
			</div>
			<div class="col-12 order-1 col-lg-6 order-lg-1" data-aos="flip-right"  
     data-aos-duration="3000">
				<h3 style="margin: 10px auto; text-align: center;">Excellent Rental Returns</h3>
				<p style="margin: 10px auto; text-align: center;">
					These stunning apartments are perfectly located for holiday rentals and we can help you manage your property. Rent starts at 800€ per week in high season.
				</p>
				<p style="margin: 10px auto; text-align: center;">
					<a href="Properties" class="btn btn-resort btn-extra-padding caps">
						Tell me more
					</a>
				</p>
			</div>
		</div>
		<div class="row" style="padding-top: 20px; padding-bottom: 20px;">
			<div class="col-12 order-2 col-lg-6 order-lg-1" data-aos="flip-right"  
     data-aos-duration="3000">
				<div style="background-image: url(img/viewingtrip1.jpg); background-repeat: no-repeat; background-size: cover; background-position: center; width: 92%; margin: 0 auto; height: 300px;">
				</div>			
			</div>
			<div class="col-12 order-1 col-lg-6 order-lg-2" data-aos="flip-left"  
     data-aos-duration="3000">
				<h3 style="margin: 10px auto; text-align: center;">Book a Viewing Trip Today</h3>
				<p style="margin: 10px auto; text-align: center;">
					Call or leave your details and we can help arrange your viewing of  this stunning resort now.
				</p>
				<p style="margin: 10px auto; text-align: center;">
					<a href="Contact?type=1#contact" class="btn btn-resort btn-extra-padding caps">
						Yes please
					</a>
				</p>
			</div>
		</div>
	</div>
</section>
<section class="residence-section" style="background: #109fe1; color: #fff !important; width: 100% !important; margin: 0;" data-aos="fade-up"  
     data-aos-duration="2000">
	<h3 style="width: 100%; text-align: center; color: #fff;">Meet Our Team</h3>
	<div class="container-fluid">
	<div class="row" style="margin-top: 40px;">
		<div class="col-12 col-lg-4" data-aos="flip-right"  
     data-aos-duration="3000">
			<div class="meet-us-card lg-lower">
				<div style="border-radius: 50%; width: 180px; height: 180px; margin: 0 auto 15px auto; background-image: url(img/team/1.jpg); background-size: cover; background-position: center; background-repeat: no-repeat;"></div>
				<p>
					<h3 class="width100 text-center" style="margin-bottom: 20px; color: #fff; font-size: 30px;">
						Jack Finnigan, CEO
					</h3>
					<div>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
					</div>
				</p>
			</div>
		</div>	
		<div class="col-12 col-lg-4" data-aos="fade-up"  
     data-aos-duration="3000">
			<div class="meet-us-card">
				<div style="border-radius: 50%; width: 180px; height: 180px; margin: 0 auto 15px auto; background-image: url(img/team/2.jpg); background-size: cover; background-position: center; background-repeat: no-repeat;"></div>
				<p>
					<h3 class="width100 text-center" style="margin-bottom: 20px; color: #fff; font-size: 30px;">
						Aatik Tasneem, Sales					
					</h3>
					<div>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
					</div>
				</p>
			</div>

		</div>	
		<div class="col-12 col-lg-4" data-aos="flip-left"  
     data-aos-duration="3000">
			<div class="meet-us-card lg-lower">
				<div style="border-radius: 50%; width: 180px; height: 180px; margin: 0 auto 15px auto; background-image: url(img/team/3.jpg); background-size: cover; background-position: center; background-repeat: no-repeat;"></div>
				<p>
					<h3 class="width100 text-center" style="margin-bottom: 20px; color: #fff; font-size: 30px;">
						Joe Gardner, Customer Service					
					</h3>
					<div>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
					</div>
				</p>
			</div>
		</div>
	</div>
	
	</div>

</section>
<section class="home-section" data-aos="fade-up"  
     data-aos-duration="2000">
	<h3 style="width: 100%; text-align: center;">Latest Beach Front Properties For Sale</h3>
	<div class="row" style="margin-top: 40px;">
		<div id="properties" class="col-12 col-md-11 col-lg-10 mx-auto">
			@foreach ( $properties as $row )
				@if ( $row->image != "" )
					<a href="Apartment?ref={{ $row->code }}" style="border-radius: 4px; width: 100%; height: 500px; background-image: url({{$row->image}}); background-repeat: no-repeat; background-size: cover; background-position: center;">
						<div style="width: 100%; height: 100%; position: relative;">
							<div class="apt-banner">
								<div>
								{{ $row->phase }}								
								</div>
								<div>
								{{ $row->featureone }}								
								</div>
							</div>
							<div style="position: absolute; bottom: 20px; left: 20px; padding: 20px; border-radius: 4px; background-color: rgba(0,0,0,.7); color: #fff; font-weight: bold;">
								€{{ $row->price }}
							</div>
						</div>
					</a>
				@endif
			@endforeach
		</div>
	</div>
	<div class="row">
		<div style="width: 100%; text-align: center; margin-top: 40px; margin-bottom: 25px;">
			<a href="Availability" class="btn btn-resort-outline">See All Available Beach Front Properties</a>
		</div>
	</div>
</section>
<div class="welcome">
	<img src="img/logo.png" style="width: 250px; height: auto;" alt="">
</div>
<script>
$(document).ready( function() 
{
	$('#heroScroll').on('click', function(e) {
		$('html, body').animate({
			scrollTop: $('#top').height() - 100
		}, 1200);
	});
	setTimeout(() => {
		$('.welcome').fadeOut(500);
	}, 250);

	$('#properties').slick({
		infinite: true,
		speed: 300,
		slidesToShow: 1,
		nextArrow: '<span class="grey-icon" style="box-shadow: 0 0px 6px 0 rgba(0,0,0,.9); position: absolute; top: 50%; right: 2px; z-index: 2; color: #fff; cursor: pointer;"><i class="fa fa-arrow-circle-right"></i></span>',
		prevArrow: '<span class="grey-icon" style="box-shadow: 0 0px 6px 0 rgba(0,0,0,.9); position: absolute; top: 50%; left: 0px; z-index: 2; color: #fff; cursor: pointer;"><i class="fa fa-arrow-circle-left"></i></span>'
	});
});
function toggleSearch()
{
	$('#searchForm').find('.form-group').toggle(500);
}
</script>