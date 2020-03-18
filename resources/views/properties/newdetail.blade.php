
    <!--Page Title-->
    <section class="page-title" style="background-image:url(img/about-5.jpg);">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <h1>Property Detail</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="index.html">Home</a></li>
                    <li>Property Detail</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!-- Sidebar Page Container -->
    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="upper-info-box">
                <div class="row">
                    <div class="about-property col-lg-8 col-md-12 col-sm-12">
                        <h2>{{ $property->public_title }}</h2>
                        <div class="location"><i class="la la-map-marker"></i> {{ $property->resort }}</div>
                        <ul class="property-info clearfix">
                            <li><i class="flaticon-bed"></i> {{ $property->bedrooms }} Bedrooms</li>
                            <li><i class="flaticon-house-5"></i> {{ $property->sleeps }} Sleeps</li>
                            <li><i class="flaticon-bathtub"></i> {{ $property->bath }} Bathroom</li>
                        </ul>
                    </div>
                    <div class="price-column col-lg-4 col-md-12 col-sm-12">
                        <!--
                        <span class="title">Start From</span>
                        <div class="price">$ 13,65,000</div>
                        <span class="status">For Sale</span>
                        -->
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <!--Content Side-->
                <div class="content-side col-lg-8 col-md-12 col-sm-12">
                    <div class="property-detail">
                        <div class="upper-box">
                            <div class="carousel-outer">
                                <ul class="image-carousel owl-carousel owl-theme">
                                    @foreach ( $images as $row )
                                    <li><a href="{{ $row->path }}" class="lightbox-image" title="Image Caption Here"><img style="max-height: 570px;" src="{{ $row->path }}" alt=""></a></li>
                                    @endforeach
                                </ul>
                                
                                <ul class="thumbs-carousel owl-carousel owl-theme">
                                    @foreach ( $images as $row )
                                    <li><img style="max-height: 230px;" src="{{ $row->path }}" alt=""></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="lower-content">
                            <h3>Description</h3>
                            {!! $property->description !!}
                        </div>

                        <!-- Property Features -->
                        <div class="property-features">
                            <h3>Essential Information</h3>
                            <ul class="list-style-one">
                                <li>Property Types: {{ $property->type }}</li>
                                <li>Bedrooms: {{ $property->bedrooms}} </li>
                                <li>Sleeps: {{$property->sleeps}} </li>
                                <li>Bathrooms: {{$property->bath}} </li>
                            </ul>
                        </div>

                        <!-- Property Features -->
                        <div class="property-features">
                            <h3>Home Amenities</h3>
                            <ul class="list-style-one">
                                @foreach ( $features as $row )
                                <li>{{ $row->title }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Nearest Places -->
                        <div class="nearest-places">
                            <h3>Near By Place</h3>
                            <div class="outer-box clearfix">
                                @if (!is_null($nearby))
                                <div class="places-column">
                                    <ul class="places-list">
                                        @foreach ( $nearby as $row )
                                        <li>
                                            <strong>
                                            @if ($row->iconClass != "")
                                            <i class="{{$row->iconClass}}"></i>
                                            @endif
                                            {{$row->type}}
                                            </strong>
                                            @foreach ( $row->examples as $example )
                                                <div class="text">
                                                    <b>
                                                    @if ($example->link != "")
                                                        <a href="{{ $example->link }}" target="_blank">
                                                            {{ $example->name}}
                                                        </a>
                                                    @else
                                                        {{ $example->name}}
                                                    @endif
                                                    </b>
                                                    <span>
                                                        {{$example->distance}}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="map-column">
                                    <div class="map-outer">
                                        <!--Map Canvas-->
                                        <div class="map-canvas"
                                            data-zoom="8"
                                            data-lat="{{ $resort->latitude }}"
                                            data-lng="{{ $resort->longitude }}"
                                            data-type="roadmap"
                                            data-hue="#ffc400"
                                            data-title="{!! $resort->title !!}"
                                            data-icon-path="images/icons/map-marker.png"
                                            data-content="{!! $resort->address !!}">
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="map-column w-100">
                                    <div class="map-outer">
                                        <!--Map Canvas-->
                                        <div class="map-canvas"
                                            data-zoom="8"
                                            data-lat="{{ $resort->latitude }}"
                                            data-lng="{{ $resort->longitude }}"
                                            data-type="roadmap"
                                            data-hue="#ffc400"
                                            data-title="{!! $resort->title !!}"
                                            data-icon-path="images/icons/map-marker.png"
                                            data-content="{!! $resort->address !!}">
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Review Box 
                        <div class="review-area">
                            <div class="reviews-container">
                                <h3>Reviews For Costomer</h3>
                                <article class="review-box">
                                    <div class="thumb-box">
                                        <figure class="thumb"><img src="images/resource/review-thumb-1.jpg" alt=""></figure>
                                        <a href="#" class="reply-btn">Reply Now</a>
                                    </div>
                                    <div class="content-box">
                                        <div class="name">Monija Moro</div>
                                        <span class="date"><i class="la la-calendar"></i> 5 December, 2018</span>
                                        <div class="rating"><span class="la la-star"></span><span class="la la-star"></span><span class="la la-star"></span><span class="la la-star"></span><span class="la la-star"></span></div>
                                        <div class="text">Accusantium aut, consequatur, culpa dolorum est facilis illo magnam numquam officia omnis qui recusandae sit, tempora ullam unde velit veniam voluptatem!.</div>
                                    </div>
                                </article>
                                
                                <article class="review-box reply">
                                    <div class="thumb-box">
                                        <figure class="thumb"><img src="images/resource/review-thumb-2.jpg" alt=""></figure>
                                        <a href="#" class="reply-btn theme-btn">Reply Now</a>
                                    </div>
                                    <div class="content-box">
                                        <div class="name">Mibano Rests</div>
                                        <span class="date"><i class="la la-calendar"></i> 5 December, 2018</span>
                                        <div class="rating"><span class="la la-star"></span><span class="la la-star"></span><span class="la la-star"></span><span class="la la-star"></span><span class="la la-star"></span></div>
                                        <div class="text">Accusantium aut, consequatur, culpa dolorum est facilis illo magnam numquam officia omnis qui recusandae sit, tempora ullam unde velit veniam voluptatem!.</div>
                                    </div>
                                </article>

                                <article class="review-box">
                                    <div class="thumb-box">
                                        <figure class="thumb"><img src="images/resource/review-thumb-3.jpg" alt=""></figure>
                                        <a href="#" class="reply-btn theme-btn">Reply Now</a>
                                    </div>
                                    <div class="content-box">
                                        <div class="name">Cojari Barna</div>
                                        <span class="date"><i class="la la-calendar"></i> 5 December, 2018</span>
                                        <div class="rating"><span class="la la-star"></span><span class="la la-star"></span><span class="la la-star"></span><span class="la la-star-o"></span><span class="la la-star-o"></span></div>
                                        <div class="text">Accusantium aut, consequatur, culpa dolorum est facilis illo magnam numquam officia omnis qui recusandae sit, tempora ullam unde velit veniam voluptatem!.</div>
                                    </div>
                                </article>
                            </div>
                        </div>

                        <div class="review-comment-form"> 
                            <h3>Leave A Review</h3>
                            <form method="post" action="contact.html">
                                <div class="row">
                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                        <input type="text" name="username" placeholder="Full Name" required>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                        <input type="text" name="number" placeholder="Email Address" required>
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <textarea name="message" placeholder="Massage"></textarea>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                        <div class="rating-box">
                                            <div class="text"> Your Rating:</div>
                                            <div class="rating"><a href="#"><span class="la la-star-o"></span></a><a href="#"><span class="la la-star-o"></span></a><a href="#"><span class="la la-star-o"></span></a><a href="#"><span class="la la-star-o"></span></a><a href="#"><span class="la la-star-o"></span></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 text-right">
                                        <button class="theme-btn btn-style-one" type="submit" name="submit-form">Submit now</button>
                                    </div>
                                </div>
                            </form>
                        </div>-->
                    </div>
                </div>

                <!--Sidebar Side-->
                <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
                    <aside class="sidebar default-sidebar">

                        <!-- Categories -->
                        <div class="sidebar-widget search-properties">
                            <div class="sidebar-title"><h3>Search Properties</h3></div>
                            <!-- Property Search Form -->
                            <div class="property-search-form style-three">
                                <form method="post" action="Properties">
                                    <div class="row no-gutters">
                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <select class="custom-select-box" name="id_property_type">
                                                <option value="">Property type</option>
                                                @foreach ( $types as $type )
                                                <option value="{{ $type->id }}">{{ $type->title }}</option>                                            
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <select class="custom-select-box" name="sleeps">
                                                <option value="">Sleeps</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5 +</option>
                                            </select>
                                        </div>

                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <select class="custom-select-box" name="bedrooms">
                                                <option value="">Bedrooms</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5 +</option>
                                            </select>
                                        </div>
                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <button type="submit" class="theme-btn btn-style-one">Search</button>
                                        </div>
                                    </div>@csrf
                                </form>
                            </div>
                            <!-- End Form -->
                        </div>

                         <!-- Categories -->
                        <div class="sidebar-widget categories">
                            <div class="sidebar-title"><h3>Category Properties</h3></div>
                            <ul class="cat-list">
                                @foreach ( $types as $row )
                                <li><a href="Properties?id_property_type={{ $row->id }}">{{$row->title}}s <span>{{ $row->total }}</span></a></li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Recent Properties -->
                        <div class="sidebar-widget recent-properties">
                            <div class="sidebar-title"><h3>Recent Properties</h3></div>
                            <div class="widget-content">
                                <!-- Post -->
                                @foreach ( $properties as $row )
                                <article class="post">
                                    <div class="post-thumb">
                                        <a href="Properties.detail?id={{ base64_encode($row->id) }}">
                                            @if (file_exists($row->image) )
                                            <img src="{{ $row->image }}" alt="">
                                            @else
                                            <img src="img/no-image.png" alt="">
                                            @endif
                                        </a>
                                    </div>
                                    <span class="location">{{ $row->resort }}</span>
                                    <h3><a href="Properties.detail?id={{ base64_encode($row->id) }}">{{ $row->public_title }}</a></h3>
                                </article>
                                @endforeach
                            </div>
                        </div>
                    </aside>
                </div>
                <div class="col-12">
    		<!-- Form Column -->
    		<div class="form-column">
    			<div class="inner-column">
    				<div class="title-box">
    					<h2>Contact Us</h2>
    					<div class="text">Interested in renting this apartment? Get in touch</div>
    				</div>

    				<!-- Contact Form -->
		            <div class="contact-form">
		                <form method="post" action="Home.register" id="contact-form" class="row">
                            @csrf()
                            <input type="text" name="id_property" value="{{ $property->id }}" hidden>
                            <input type="text" id="subject" name="subject" value="Property Enquiry" hidden>
	                        <div class="form-group col-12">
	                            <input type="text" name="name" placeholder="Name" required>
	                        </div>
	                        <div class="form-group col-12">
	                            <input type="text" name="surname" placeholder="Surname" required>
	                        </div>
	                        <div class="form-group col-12">
	                            <input type="email" name="email" placeholder="Email" required>
	                        </div>
	                        <div class="col-6 form-group">
                                <input type="text" autocomplete="off" placeholder="From" name="date_start" id="date_start">
	                        </div>
                            <div class="col-6 form-group">
                                <input type="text" autocomplete="off" placeholder="To" name="date_end" id="date_end">
                            </div>
	                        <div class="form-group col-12">
	                            <textarea name="message" placeholder="Message"></textarea>
	                        </div>
	                        
	                        <div class="form-group col-12">
	                            <button hidden class="theme-btn btn-style-one" type="submit" id="submitProperty" name="submit-form">Send Now</button>
	                            <div class="theme-btn btn-style-one" onclick="submitPropertyForm()" name="submit-form">Send Now</div>
	                        </div> 
		                </form>
		            </div>
    			</div>
    		</div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Sidebar Container -->
    <script>
        $(document).ready( function() {
            $("#date_start").datepicker();
            $("#date_end").datepicker();
        })
        function submitPropertyForm() {
            $("#subject").val($("#subject").val()+": "+$("#date_start").val()+" - "+$("#date_end").val() );
            $("#submitProperty").click();
        }
    </script>