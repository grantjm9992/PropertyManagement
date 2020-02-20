
     <!-- Main Header-->
     <header class="main-header header-style-four">
        <!--Header Top-->
        <div class="header-top">
            <div class="auto-container">
                <div class="inner-container clearfix">
                    <div class="top-left">
                        <ul class="contact-list clearfix">
                            <li><i class="la la-envelope-o"></i><a href="#">{{ $company->email }}</a></li>
                        </ul>
                    </div>
                    <div class="top-right">
                        <ul class="social-icon-one clearfix">
                            <li><a href="https://www.facebook.com/condado1handyman/" target="_blank"><i class="la la-facebook-f"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Top -->

        <!-- Header Lower -->
        <div class="header-lower">
            <div class="main-box">
                <div class="auto-container">
                    <div class="inner-container clearfix">
                        <div class="logo-box">
                            <div class="logo"><a href="{{ url('') }}"><img style="width: 155px; max-height: 60px;" src="{{ $logo }}" alt="" title=""></a></div>
                        </div>

                        <div class="nav-outer clearfix">
                            <!-- Main Menu -->
                            <nav class="main-menu navbar-expand-md navbar-dark">
                                <div class="navbar-header">
                                    <!-- Toggle Button -->      
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="icon flaticon-menu"></span>
                                    </button>
                                </div>
                                
                                <div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
                                    <ul class="navigation clearfix">
                                        <li class="">
											<a href="Home">Home</a>
                                        </li>
                                        <li class="dropdown"><a href="#">Services</a>
                                            <ul>
                                                <li><a href="PropertyManagement">Property Management</a></li>
                                                <li><a href="PropertyRentals">Property Rentals</a></li>
                                                <li><a href="PropertyMaintenance">Property Maintenance</a></li>
                                            </ul>
                                        </li>
                                        <li class="">
											<a href="Properties">Properties</a>
                                        </li>
                                        <li class="">
											<a href="About">About us</a>
                                        </li>
                                        <li class="">
											<a href="Contact">Contact us</a>
                                        </li>
                                    </ul>              
                                </div>
                            </nav><!-- Main Menu End-->
                                
                            <!-- Main Menu End-->
                            <div class="outer-box">
                               <div class="btn-box">
                                   <a href="#" class="theme-btn btn-style-five">Submit Property</a>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Header Lower-->

        <!-- Sticky Header  -->
        <div class="sticky-header">
            <div class="auto-container clearfix">
                <!--Logo-->
                <div class="logo pull-left">
                    <a href="{{ url('/') }}" title=""><img src="{{ $logo }}" style="width: 150px; max-height: 60px;" alt="" title=""></a>
                </div>
                <!--Right Col-->
                <div class="pull-right">
                    <!-- Main Menu -->
                    <nav class="main-menu">
                        <div class="navbar-collapse show collapse clearfix">
                            <ul class="navigation clearfix">
                                <li class="">
									<a href="Home">Home</a>
                                </li>
                                <li class="dropdown"><a href="#">Services</a>
                                    <ul>
                                        <li><a href="PropertyManagement">Property Management</a></li>
                                        <li><a href="PropertyRentals">Property Rentals</a></li>
                                        <li><a href="PropertyMaintenance">Property Maintenance</a></li>
                                    </ul>
                                </li>
                                <li class="">
									<a href="Properties">Properties</a>
                                </li>
                                <li>
									<a href="About">About</a>
								</li>
                                <li>
									<a href="Contact">Contact us</a>
								</li>
                            </ul>
                        </div>
                    </nav><!-- Main Menu End-->
                </div>
            </div>
        </div><!-- End Sticky Menu -->
    </header>