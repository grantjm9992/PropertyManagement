
    <!-- Property Search Section -->
    <section class="property-search-section">
        <div class="auto-container">
            <div class="property-search-tabs tabs-box">
                <ul class="tab-buttons">
                    <li data-tab="#rent" class="tab-btn active-btn">Rent</li>
                </ul>
                <div class="tabs-content">
                    <!--Tab -->
                    <div class="tab active-tab" id="rent">
                        <div class="property-search-form">
                            <form method="post" action="Properties">
                                <div class="row">@csrf
                                    <!-- Form Group -->
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label>property type</label>
                                        <select class="custom-select-box" name="id_property_type">
                                            <option value="">All</option>
                                            @foreach ( $types as $type )
                                            <option value="{{ $type->id }}">{{ $type->title }}</option>                                            
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label>bedrooms</label>
                                        <select class="custom-select-box" name="bedrooms">
                                            <option value="">All</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5+">5 +</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label>sleeps</label>
                                        <select class="custom-select-box" name="sleeps">
                                            <option value="">All</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5+">5 +</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <button type="submit" class="theme-btn btn-style-two">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Property Search Section -->