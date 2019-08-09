@inject('translator', 'App\Providers\TranslationProvider')
<style>
    .navbar-number{
        transition: 500ms ease-in-out;
        background: rgba(0,0,0,0.2);
    }
    .scrolled
    {
        transition: 500ms ease-in-out;
        background: black;
    }
    .splash
    {
        position: relative;
        width: 100%;
        height: 100vh;
        background-image: url({{ asset('archivos/img/hospederia.jpg') }});
        background-size: cover;
        background-repeat: none;
        background-position: center;
    }
    .banner {
        position: absolute;
        bottom: 0;
        width: 100%;
        text-align: center;
        height: 30px;
        background: rgba(0,0,0,0.6);
        color: #fff;
        cursor: pointer;
    }
    .navbar
    {
        z-index: 10;
        position: fixed;
        width: 100%;
    }
    html
    {
        scroll-behavior: smooth;
    }
    .form
    {
        position: absolute;
        top: calc(100vh - 100px);
        width: 800px;
        left: calc(50% - 400px);
    }
</style>
<script>
$(document).ready( function() {
    $('#date_from').datepicker();
    $('#date_to').datepicker();
})
$(window).scroll(function() {
    $('nav').toggleClass('scrolled', $(this).scrollTop() > 90);
})
</script>
<div class="splash">
    <div class="form row">
        <div class="form-group col-12 col-md-4">
            <input type="text" id="date_from" name="date_from" class="form-control">
        </div>
        <div class="form-group col-12 col-md-4">
            <input type="text" id="date_to" name="date_to" class="form-control">
        </div>
        <div class="form-group col-12 col-md-4">
            <input type="submit" class="btn btn-primary form-control" value="Check dates">
        </div>
    </div>
    <a href="#firstSection" class="banner" >
        <i class="fas fa-chevron-down"></i>
    </a>
</div>
<div id="firstSection" class="container-fluid padding50" style="height: 100%;">
    <div class="center-box row">
        <div class="col-12 col-md-9 order-md-2">
            <h1 class="titulo">
                {{ $translator->get('los_balc_hosp_rural') }}
            </h1>
        </div>
        <div class="col-12 col-md-3 order-md-1">

        </div>
    </div>
</div>

