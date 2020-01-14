
    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/16.jpg);">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <h1>Properties</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Properties</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->
    {!! $search !!}
    
    <!-- Property Filter Section -->
    <section class="property-filter-section">
        <div class="auto-container">
            <!--MixitUp Galery-->
            <div class="mixitup-gallery">
                <div class="upper-box clearfix">
                    <div class="sec-title">
                        <span class="title">FIND YOUR HOUSE IN YOUR CITY</span>
                        <h2>PROPERTY TYPES</h2>
                    </div>

                    <!--Filter-->
                    <div class="filters">
                        <ul class="filter-tabs filter-btns clearfix">
                        </ul>                                    
                    </div>
                </div>

                <div class="filter-list row" id="properties">
                    {!! $properties !!}
                </div>

                <!-- Load More 
                <div id="loadMore" class="load-more-btn text-center">
                    <div onclick="loadMore()" class="theme-btn btn-style-two">Load More</div>
                </div>-->
            </div>
        </div>
    </section>
    <!--End Property Filter Section -->