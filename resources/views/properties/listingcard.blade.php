<div class="col-12 col-lg-6 my-3">
    <div class="panel p-3">
        <div class="panel-body">
            <div class="row">
                <div class="col-xl-4 text-center mb-3 mb-xl-0" style="min-height: 250px; background-image: url(https://lorempixel.com/200/200/city/2/); background-size: cover; background-repeat: no-repeat; background-position: center center;">
                </div>
                <div class="col-xl-8">
                    <h4 class="title-real-estates">
                        <strong><a href="Properties.detail?id={{ $property->id }}">{{ $property->public_title }}</a></strong> <span class="pull-right">{{ $property->resort }}</span>
                    </h4>
                    <hr>
                    <p>{{ $property->description }}</p>
                    <p><span class="label alert-green-outline">{{ $property->bed }} beds</span> | <span class="label alert-green-outline">{{ $property->bedrooms }} bedrooms</span> | <span class="label alert-green-outline">Sleeps {{ $property->sleeps }}</span></p>
                </div>
            </div>
        </div>
    </div>
</div>