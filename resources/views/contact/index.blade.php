
    <!--Page Title-->
    <section class="page-title" style="background-image:url(img/about-5.jpg);">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <h1>Contact Us</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="index.html">Home</a></li>
                    <li>Contact Us</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!-- Contact Section -->
    <section class="contact-section style-two">
        <div class="auto-container">
            <div class="row">
                <!-- Form Column -->
                <div class="form-column col-lg-8 col-md-6 col-sm-12">
                    <div class="inner-column">
                        <div class="title-box">
                            <span class="title">How To</span>
                            <h2>Contact Us</h2>
                            <div class="text">Don’t Hesitate to Contact with us for any kind of information</div>
                        </div>

                        <!-- Contact Form -->
                        <div class="contact-form">
		                    <form method="post" action="Home.sendMail" id="contact-form">
                                <div class="form-group">
                                    <input type="text" name="username" placeholder="Name" required>
                                </div>
                                
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Email" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="subject" placeholder="Subject" required>
                                </div>

                                <div class="form-group">
                                    <textarea name="message" placeholder="Massage"></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <button class="theme-btn btn-style-one" type="submit" name="submit-form">Send Now</button>
                                </div> 
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Info Column -->
                <div class="info-column col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-column">
                        <!-- Info Box -->
                        <div class="contact-info-box">
                            <div class="inner-box">
                                <span class="icon la la-phone"></span>
                                <h4>Phone</h4>
                                <ul>
                                    <li>{{ $company->phone }}</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Info Box -->
                        <div class="contact-info-box">
                            <div class="inner-box">
                                <span class="icon la la-envelope-o"></span>
                                <h4>Emails</h4>
                                <ul>
                                    <li>{{ $company->email }}</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Info Box -->
                        <div class="contact-info-box">
                            <div class="inner-box">
                                <span class="icon la la-globe"></span>
                                <h4>Address</h4>
                                <ul>
                                    <li>
                                        {!! $company->address !!}
                                    </li>
                                </ul> 
                            </div>
                        </div>

                        <!-- Info Box -->
                        <div class="contact-info-box follow-us">
                            <div class="inner-box">
                                <h4>Follow Us:</h4>
                                <ul class="social-icon-three">
                                    @if ( $company->link_facebook != "" )
                                    <li><a href="{{ $company->link_facebook }}"><span class="la la-facebook-f"></span></a></li>
                                    @endif
                                    @if ( $company->link_twitter != "" )
                                    <li><a href="{{ $company->link_twitter }}"><span class="la la-twitter"></span></a></li>
                                    @endif
                                    @if ( $company->link_google != "" )
                                    <li><a href="{{ $company->link_google }}"><span class="la la-google-plus"></span></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </section>
    <!--End Contact Section -->

    <!-- Map Section -->
    <section class="map-section">
        <div class="map-outer">
            <!--Map Canvas-->
            <div class="map-canvas"
                data-zoom="9"
                data-lat="{{ $company->latitude }}"
                data-lng="{{ $company->longitude }}"
                data-type="roadmap"
                data-title="Contact Us!"
                data-icon-path="images/icons/map-marker.png"
                data-content="{!! $company->address !!}<br><a href='mailto:{{ $company->email }}'>{{ $company->email }}</a>">
            </div>
        </div>
    </section>
    <!-- End Map Section -->