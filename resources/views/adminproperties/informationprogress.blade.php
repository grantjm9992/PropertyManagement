
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-home"></i>  Property information</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                <i class="fas fa-expand"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <h3 class="w-100 text-center">
        Do you want to Rent your Property? 
        </h3>
        <h5 class="w-100 text-center">
Complete the Rental Information Form to get Started
        </h5>
        <div  style="max-width: 400px;margin: 0 auto;">
        <div id="container"></div>
        </div>
        <div class="mt-2 w-100 text-center">
            <a href="PropertyInformation?id_property={{ $property->id }}" class="btn btn-primary">
                Let's go!
            </a>
        </div>
    </div>
</div>
<script>
    $(document).ready( function() {

        var bar = new ProgressBar.Circle(container, {
        color: '#ff9e0f',
        // This has to be the same size as the maximum width to
        // prevent clipping
        strokeWidth: 4,
        trailWidth: 1,
        easing: 'easeInOut',
        duration: 1400,
        text: {
            autoStyleContainer: false
        },
        from: { color: '#ff9e0f', width: 1 },
        to: { color: '#ff9e0f', width: 4 },
        // Set default step function for all animate calls
        step: function(state, circle) {
        circle.path.setAttribute('stroke', state.color);
            circle.path.setAttribute('stroke-width', state.width);

            var value = Math.round(circle.value() * 100);
            if (value === 0) {
            circle.setText("You haven't entered any information for your property<br/><i class='mt-3 far fa-frown'></i>");
            } else {
            circle.setText('Your are already '+value+'% of the way there!');
            }

        }
        });
        bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
        bar.text.style.fontSize = '2rem';

        bar.animate({{ $property->information_complete }}/100);  // Number from 0.0 to 1.0
    })
</script>