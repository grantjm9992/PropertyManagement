<div class="col-12 col-lg-6 my-3">
    <div class="panel p-3">
        <div class="panel-body">
            <div class="row">
                <div class="col-xl-4 text-center mb-3 mb-xl-0" style="min-height: 250px; background-image: url(https://lorempixel.com/200/200/city/2/); background-size: cover; background-repeat: no-repeat; background-position: center center;">
                </div>
                <div class="col-xl-8">
                    <h4 class="title-real-estates">
                        <strong><a href="MyProperties.detail?id={{ $property->id }}">{{ $property->title }}</a></strong> <span class="pull-right">{{ $property->resort }}</span>
                        <div class="buttons">
                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?href={{ $url }}">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <a href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>
                    </h4>
                    <hr>
                    <p>
                        {{ $rentals }} rentals this year
                    </p>
                    <p>
                        {{ $tasksPending }} tasks pending
                    </p>
                    <p>
                        {{ $tasks }} tasks completed this year
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>